<?php

require_once dirname(__FILE__).'/../lib/contact_queriesGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/contact_queriesGeneratorHelper.class.php';

/**
 * contact_queries actions.
 *
 * @package    stgcms2
 * @subpackage contact_queries
 * @author     Jerzy Biernacki <jurek@studiotg.pl>, Paweł Sałajczyk <pawel@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contact_queriesActions extends autoContact_queriesActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $sorts = $this->getSort();
        if (empty($sorts[0]))
        {
            $sorts[0] = 'created_at';
            $sorts[1] = 'desc';
        }
        $this->setSort($sorts);
        parent::executeIndex($request);
        $this->setTemplate('index');
    }
}
