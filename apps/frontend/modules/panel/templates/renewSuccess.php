<?php include_partial('panel/menu', array('active' => 'payable', 'company' => $company)); ?>

<div class="panel_box">
    <div class="box_form">

     
     <!--
     Kwota: <?php /*
        $price = new StgPrice($packet->getPriceBrutto());
        echo $price->asReal(); */
     ?>
     <br /><br />
     Przedłużenie do: 
     <?php
        /*$rent_to = strToTime($company->getRentTo());
        
        $new = $rent_to + (60*60*24*$packet->getPeriod());
        echo date('Y-m-d', $new);*/
     ?>
     <br /><br />-->
     <div style="text-align: center">
       
       <h3>Wybierz pakiet:</h3>
       
       <form method="post" action="<?php echo url_for('@add_renew', $company); ?>"> 
       
       <div style="float: left; margin-left: 210px;">
         <img class="choose_packet" style="padding: 10px;" src="/images/90.png" />
         <br />
         <strong>90zł</strong>
         <br />
         <input checked="checked" type="radio" name="packet" value="<?php echo $packets[1]->getPrimaryKey(); ?>" /> 
       </div>
       <div style="float: left">
         <img class="choose_packet" style="padding: 10px;" src="/images/180.png" />
         <br />
         <strong>180zł</strong>
         <br />
         <input type="radio" name="packet" value="<?php echo $packets[2]->getPrimaryKey(); ?>" /> 
       </div>
       <div style="float: left">
         <img class="choose_packet" style="padding: 10px;" src="/images/180.png" />
         <br />
         <strong>360zł</strong>
         <br />
         <input type="radio" name="packet" value="<?php echo $packets[3]->getPrimaryKey(); ?>" /> 
       </div>
       
       <div style="clear: both"></div>
       <br /><br />
       <input type="submit" value="Przedłuż pakiet" />
       
       </form>
     </div>
    
    </div>
</div>    

<script type="text/javascript">
  jQuery('.choose_packet').click(function() {
    jQuery(this).parent('div:first').children('input').attr('checked', 'checked');    
  });
</script>  