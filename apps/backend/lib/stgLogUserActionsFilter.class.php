<?php
class stgLogUserActionsFilter extends sfFilter
{
  private $log = null;
  
  public function execute($filterChain)
  {
    $context = $this->getContext();
    if (stgConfig::get('enable_log_user_actions'))
    {
      $this->log();
    }
    // Execute next filter
    $filterChain->execute();
  }

  private function log()
  {
    $this->getLogMessage()->save();
  }

  /**
   * Creates log message object
   *
   * @return <type>
   */
  private function getLogMessage()
  {
    $this->log = new StgLogUserActions(); //create new log message
    
    $context = $this->getContext(); //grab context
    $params = $context->getRequest()->getParameterHolder()->getAll(); //grab params
    //if user is authenticated - we've got he's name
    if($this->getContext()->getUser()->isAuthenticated())
    {
      $this->log->setUser($context->getUser()->getGuardUser()->getUsername());
    }
    else  //we gotta gues
    {
      if(isset($params['signin']['username']))  //if he tries to log in
      {
        //theres signin array available
        $this->log->setUser($params['signin']['username']);
      }
      else  //else
      {
        //we can't guess who he is
        $this->log->setUser('UNAUTHENTICATED');
      }
    }
    $other_params = array();  //define parameter trash - we'll use it later :)
    foreach($params as $name => $param) //foreach parameters
    {
      //if they fit in default categories
      if(in_array($name,array('module','action','sf_format')))
      {
        $this->log[$name] = $param; //just set them
      }
      else  //else
      {
        $other_params[$name] = $param;  //rewrite them to other array
      }      
    }
    if(count($other_params) > 0)  //if there's something in other parameters
    {
      //write it as one-liner
      $this->log['params'] = '';
      foreach($other_params as $name => $param)
      {
        $this->log['params'] .= $name.'='.$param.' ';
      }
      $this->log['params'] = trim($this->log['params']);  //trim trailing space
    }
    return $this->log;  //return log object
  }
}
?>
