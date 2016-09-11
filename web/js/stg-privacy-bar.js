$(function() {

	$('#stg-privacy-bar').css('display', 'none');		  		  		    

	var stgcookie = getCookie("stg-privacy-bar");
	if(stgcookie != 'accept')
	{

		$('#stg-privacy-bar').css('z-index', '1000');
		$('#stg-privacy-bar').css('width', '100%');
		$('#stg-privacy-bar').css('background', '#fbf4b5');		    
		$('#stg-privacy-bar').css('padding', '10px');		    
		$('#stg-privacy-bar').css('font-size', '16px');		    	    
		$('#stg-privacy-bar').css('font-weight', '400');		    
		$('#stg-privacy-bar').css('color', '#000');		    
		$('#stg-privacy-bar').css('text-shadow', '1px 1px 1px #fff');		    
		$('#stg-privacy-bar').css('border', '1px solid #ddd');
		$('#stg-privacy-bar').css('position', 'fixed');		    		    
		$('#stg-privacy-bar').css('bottom', '0px');		  		   		    
		$('#stg-privacy-bar').css('left', '0px');		  				    
		$('#stg-privacy-bar').css('text-align', 'center');		  		  		    

		$('#stg-privacy-bar').show();		
	}

	$('#stg-privacy-bar .stg-close-bar').click(function() 
	{
		var exdate=new Date();
		exdate.setDate(exdate.getDate() + 1000);
		document.cookie = "stg-privacy-bar=" + escape("accept") + "; expires="+exdate.toUTCString();
		$('#stg-privacy-bar').hide();	
		return false;	
	});

	function getCookie(name) 
	{
	    if (document.cookie!="") 
	    {
	    	var toCookie=document.cookie.split("; ");
	        for (i=0; i<toCookie.length; i++) 
	        {
	            var nameCookie=toCookie[i].split("=")[0];
	            var valueCookie=toCookie[i].split("=")[1];
	            if (nameCookie==name) return unescape(valueCookie);
	        }
	    }
	}   



});





