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

  function savePortal(data)
  {
    createCookie('portal_layout',data,null);
  }

  function getPortal()
  {
    var portal_layout = readCookie('portal_layout');
    if(portal_layout != null)
    {
      var columns = portal_layout.split(',');
      jQuery.each(columns,function(index,value){
        var column_id = index+1;
        var vars = value.split('&');
        var column = jQuery('#column_'+column_id);
        jQuery.each(vars,function(index,variable){
          var tmp = variable.split('=');
          var portlet_id = tmp[1];
          var portlet = jQuery('#portlet_'+portlet_id);
//          var portlet = jQuery('#portlet_menu_'+portlet_id);
          if(portlet_id != 'undefined')
          {
            column.append(portlet);
          }
        });
      });
    }
  }

jQuery(document).ready(function()
{
  getPortal();  //draw it from cookie :)

  jQuery(".column").sortable({
    connectWith: '.column',
    stop: function() {
        var data = new Array();
				jQuery(".column").each(function(index,value){
          data[index] = jQuery(this).sortable("serialize");
				});
        savePortal(data);
    }
  });

  jQuery(".portlet").addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
  .find(".portlet-header")
  .addClass("ui-widget-header ui-corner-all")
  .prepend('<span class="ui-icon ui-icon-minusthick"></span>')
  .end()
  .find(".portlet-content");

  jQuery(".portlet-header .ui-icon").click(function() {
    jQuery(this).toggleClass("ui-icon-minusthick").toggleClass("ui-icon-plusthick");
    jQuery(this).parents(".portlet:first").find(".portlet-content").toggle();
  });

  jQuery(".column").disableSelection();

});
</script>