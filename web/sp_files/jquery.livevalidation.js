/***
@title:
Live Validation

@version:
2.0

@author:
Andreas Lagerkvist

@date:
2008-08-31

@url:
http://andreaslagerkvist.com/jquery/live-validation/

@license:
http://creativecommons.org/licenses/by/3.0/

@copyright:
2008 Andreas Lagerkvist (andreaslagerkvist.com)

***/
jQuery.fn.liveValidation = function (conf, addedFields) {
	var config = jQuery.extend({
		validIco:		'img/ok_ico.png',
		invalidIco:		'img/bad_ico.png',
		valid:			' Poprawnie',
		invalid:		' Niepoprawnie',
		validClass:		'valid',
		invalidClass:	'invalid',
		required:		['height','name', 'pass', 'url', 'email', 'user', 'num_id', 'po_width', 'po_height'],
		optional:		[],
		fields:			{foo: /^\S.*$/}
	}, conf);

	var fields = jQuery.extend({
		name: 			/^\S.{4,12}$/,			
		pass:			/^\S.{4,12}$/,
		content: 		/^\S.*$/m,				
		dimensions:		/^\d+x\d+$/,			
		price:			/^\d+$/,				
		height: 		/^([2-9]|[1-9][0-9]{1,2})(px|%){1}$/,
		po_width:		/^([1-8][0-9]{2}|9[0-4][0-9]|950)px{1}/,
		po_height: 		/^([1-8][0-9]{2}|9[0-4][0-9]|950)px{1}/,
		num_id: 		/^\S.{1,300}$/,
		user:			/^\S.{2,42}$/,
		url: 			/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/,
		email: 			/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/	
	}, config.fields);
	
	fields.website = fields.url;
	fields.title = fields.author = fields.name;
	fields.message = fields.comment = fields.description = fields.content;

	var formControls = jQuery.merge(config.required, config.optional);

	if (!formControls.length) {
		return this;
	}

	for (var i in formControls) {
		formControls[i] = ':input[name="' + formControls[i] + '"]:not([disabled])';
	}

	formControls = formControls.join(',');

	return this.each(function () {
		jQuery(formControls, this).each(function () {
			var t			= jQuery(this);
			var isOptional	= false;
			var fieldName	= t.attr('name');
			var fieldID		= t.attr('id');
			var fieldVALUE	= t.attr('value'); 

			for (var i in config.optional) {
				if (fieldName == config.optional[i]) {
					isOptional = true;
					break;
				}
			}

			if (t.is('.jquery-live-validation-on')) {
				return;
			}
			else {
				t.addClass('jquery-live-validation-on');
			}

			// Add (in)valid icon
			var imageType = isOptional ? 'valid' : 'invalid';
			var validator = jQuery('<img id="validation_icon" src="' + config[imageType + 'Ico'] + '" alt="' + config[imageType] + '" />').insertAfter(t.addClass(config[imageType + 'Class']));

			// This function is run now and on key up
			var validate = function () {
				var key = t.attr('name');
				var val = t.val();
				var tit = t.attr('title');

				// If value and title are the same it is assumed formHints is used
				// set value to empty so validation isn't done on the hint
				val = tit == val ? '' : val;

				// Make sure the value matches
				if ((isOptional && val == '') || val.match(fields[key])) {
					// If it's not already valid
					if (validator.attr('alt') != config.valid) {
						validator.attr('src', config.validIco);
						validator.attr('alt', config.valid);
						t.removeClass(config.invalidClass).addClass(config.validClass);
						jQuery(".komunikat").html(""); 
					}
					
					if(fieldID == "height" || fieldID == "user" || fieldID == "pass" || fieldID == "email") { 
					
						jQuery("#zaw_tabs li a[href$='#ustawienia']").css("color","#21759B");
						
					} else if (fieldID == "fb_url") {
					
						jQuery("#zaw_tabs li a[href$='#facebook']").css("color","#21759B");
						
					} else if (fieldID == "tw_url") {
					
						jQuery("#zaw_tabs li a[href$='#twitter']").css("color","#21759B");
						
					} else if (fieldID == "gp_url") {
					
						jQuery("#zaw_tabs li a[href$='#googleplus']").css("color","#21759B");
						
					} else if (fieldID == "gg_url") {
					
						jQuery("#zaw_tabs li a[href$='#gg']").css("color","#21759B");
						
					} else if (fieldID == "po_width" || fieldID == "po_height") {
					
						jQuery("#zaw_tabs li a[href$='#polecamy']").css("color","#21759B");
						
					} else if (fieldID == "all_url") {
					
						jQuery("#zaw_tabs li a[href$='#allegro']").css("color","#21759B");
					
					} else if (fieldID == "yt_url") {
					
						jQuery("#zaw_tabs li a[href$='#youtube']").css("color","#21759B");
					
					} else if (fieldID == "nk_url") {
					
						jQuery("#zaw_tabs li a[href$='#nk']").css("color","#21759B");
					
					}
					
				}
				// It didn't validate
				else {
					// If it's not already invalid 
					if (validator.attr('alt') != config.invalid) {
						validator.attr('src', config.invalidIco);
						validator.attr('alt', config.invalid);
						t.removeClass(config.validClass).addClass(config.invalidClass);
					}
					
					if(fieldID == "height" || fieldID == "user" || fieldID == "pass" || fieldID == "email") { 
					
						jQuery("#zaw_tabs li a[href$='#ustawienia']").css("color","#cd2226");
						
					} else if (fieldID == "fb_url") {
					
						jQuery("#zaw_tabs li a[href$='#facebook']").css("color","#cd2226");
						
					} else if (fieldID == "tw_url") {
					
						jQuery("#zaw_tabs li a[href$='#twitter']").css("color","#cd2226");
						
					} else if (fieldID == "gp_url") {
					
						jQuery("#zaw_tabs li a[href$='#googleplus']").css("color","#cd2226");
						
					} else if (fieldID == "gg_url") {
					
						jQuery("#zaw_tabs li a[href$='#gg']").css("color","#cd2226");
						
					} else if (fieldID == "po_width" || fieldID == "po_height") {
					
						jQuery("#zaw_tabs li a[href$='#polecamy']").css("color","#cd2226");
						
					} else if (fieldID == "all_url") {
					
						jQuery("#zaw_tabs li a[href$='#allegro']").css("color","#cd2226");
					
					} else if (fieldID == "yt_url") {
					
						jQuery("#zaw_tabs li a[href$='#youtube']").css("color","#cd2226");
					
					} else if (fieldID == "nk_url") {
					
						jQuery("#zaw_tabs li a[href$='#nk']").css("color","#cd2226");
					
					}
					
					if(fieldName == "name") {
					
						jQuery(".komunikat").css("color","#cd2226");
						jQuery(".komunikat").html('<b>Popraw to pole</b>. Nazwa powinna zawierać 4-60 znaków.');
					
					} else if(fieldName == "height") {
					
						jQuery(".komunikat").css("color","#cd2226");
						jQuery(".komunikat").html('<b>Popraw to pole</b>. Wysokość zakładek powinna wynosić 2-99%.');
					
					} else if(fieldName == "pass") {
					
						jQuery(".komunikat").css("color","#cd2226");
						jQuery(".komunikat").html('<b>Popraw to pole</b>. Hasło powinno zawierać 4-12 znaków.');
					
					} else if(fieldName == "po_width") {
					
						jQuery(".komunikat").css("color","#cd2226");
						jQuery(".komunikat").html('<b>Popraw to pole</b>. Długość może być wartością pomiędzy 60-950px');
					
					} else if(fieldName == "po_height") {
					
						jQuery(".komunikat").css("color","#cd2226");
						jQuery(".komunikat").html('<b>Popraw to pole</b>. Szerokość może być wartością pomiędzy 60-950px');
					
					} else if(fieldName == "num_id") {
					
						jQuery(".komunikat").css("color","#cd2226");
						jQuery(".komunikat").html('<b>Popraw to pole</b>. To pole powinno zawierać przynajmniej jeden znak.');
					
					} else if(fieldName == "url") {
					
						jQuery(".komunikat").css("color","#cd2226");
						jQuery(".komunikat").html('<b>Popraw to pole</b>. Wprowadz prawidłowy adres.');
					
					}
				}
			};

			validate();
			t.keyup(validate);
		});

		// If form contains any invalid icon on submission, return false
		
	});
};
