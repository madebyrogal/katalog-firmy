<script type="text/javascript">
  function createCookie(name,value,days) {
    if (days) {
      var date = new Date();
      date.setTime(date.getTime()+(days*24*60*60*1000));
      var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
  }

  function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
  }

  function eraseCookie(name) {
    createCookie(name,"",-1);
  }
//
//jQuery(document).ready(function()
//{
//  var speed = '';
//  var bar = jQuery('#sf_admin_bar');
//  var filter = bar.find('.sf_admin_filter');
//  var move_to = jQuery('#filters_move_to');
//  var filters_show = jQuery('#filters_show');
//  var filters_hide = jQuery('#filters_hide');
//  var is_open = false;
//
//  if(bar.html() == null)
//  {
//    move_to.hide();
//    filters_hide.hide();
//    filters_show.hide();
//  }
//  else
//  {
//    is_open = readCookie("filters_show_cookie");
//    move_to.html(filter.html());
//    bar.remove();
//    filters_hide.css('cursor','pointer');
//    filters_show.css('cursor','pointer');
//    if(is_open == 'true')
//    {
//      move_to.show();
//      filters_hide.show();
//      filters_show.hide();
//    }
//    else
//    {
//      move_to.hide();
//      filters_hide.hide();
//      filters_show.show();
//    }
//
//    filters_show.click(function(){
//      move_to.show(speed);
//      filters_show.hide();
//      filters_hide.show();
//      createCookie("filters_show_cookie",true);
//    });
//    filters_hide.click(function(){
//      move_to.hide(speed);
//      filters_show.show();
//      filters_hide.hide();
//      createCookie("filters_show_cookie",false);
//    });
//  }
//
//});

jQuery(document).ready(function()
{
  var speed = 300;

  jQuery('#filters_all').insertAfter('#sf_admin_menu');

  if(jQuery('#sf_admin_bar').html() == null)
  {
    jQuery('#filters_move_to').hide();
    jQuery('#filters_hide').hide();
    jQuery('#filters_show').hide();
    jQuery('#filters_bottom2').hide();
    jQuery('#filters_bottom').hide();
  }
  else
  {
    jQuery('#filters_all').show();
    is_open = readCookie("filters_show_cookie");
    jQuery('#filters_move_to').html(jQuery('#sf_admin_bar').find('.sf_admin_filter').html());
    jQuery('#sf_admin_bar').remove();
    if(is_open == 'true')
    {
      jQuery('#filters_box').show();
      jQuery('#filters_hide').show();
      jQuery('#filters_show').hide();
      jQuery('#filters_bottom').hide();
    }
    else
    {
      jQuery('#filters_box').hide();
      jQuery('#filters_hide').hide();
      jQuery('#filters_show').show();
      jQuery('#filters_bottom').show();
    }

    function show_filters() {
      jQuery('#filters_bottom').hide();
      jQuery('#filters_box').show('slide', {direction: 'up'}, speed);
      jQuery('#filters_show').hide();
      jQuery('#filters_hide').show();
      createCookie("filters_show_cookie",true);
    }

    function hide_filters() {
//      jQuery('#filters_box').hide('slide', {direction: 'up'}, speed);
//      jQuery('#filters_bottom').show();
      jQuery('#filters_box').hide('slide', {direction: 'up'}, speed, function(){jQuery('#filters_bottom').show();});
      jQuery('#filters_show').show();
      jQuery('#filters_hide').hide();
      createCookie("filters_show_cookie",false);
    }

    jQuery('#filters_show').click(show_filters);
    jQuery('#filters_hide').click(hide_filters);


    jQuery('#filters_bottom').click(show_filters);
    jQuery('#filters_bottom2').click(hide_filters);


  }
  
});
</script>
<div style="display: none;" id="filters_all">
  <div id="filters_show"><span>Pokaż filtry</span></div>
  <div id="filters_hide"><span>Schowaj filtry</span></div>
  <div id="filters_box">
    <div id="filters_move_to">&nbsp;</div>
    <div id="filters_bottom2"></div>
  </div>
  <div id="filters_bottom"></div>
</div>
