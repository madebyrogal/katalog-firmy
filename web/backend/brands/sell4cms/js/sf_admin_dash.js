var image_dir = '../images/sf_admin/';

//adjust table to fit filters if they exist
jQuery(function() {
    if (jQuery('#sf_admin_bar').size()) {
        var filter_width = jQuery('#sf_admin_bar').width() + 25;

        jQuery('.sf_admin_list').css('padding-right', filter_width);

        //add filter header
        jQuery('#sf_admin_bar table tbody').before("<thead><tr><th colspan='2'>Filters</th></tr></thead>");
    }
});

//menu
jQuery(function(){
    jQuery('li.node').hover(
        function() {
            jQuery('ul', this).css('display', 'block');
            jQuery(this).addClass('nodehover');
        },
        function() {
            jQuery('ul', this).css('display', 'none');
            jQuery(this).removeClass('nodehover');
        });

    jQuery('li.node a[href=#]').click(function() {
        return false;
    });
});

jQuery(tabs);

//zakladki
function tabs() {

//    var div = '';
    var div = jQuery('#sf_admin_header').html();

    var tabs = jQuery('.sf_admin_form fieldset');
    var tabsCnt = jQuery(tabs).length;
    for(i = 0; i < tabsCnt; i++)
    {
        if(i > 0) {
            jQuery(tabs[i]).hide();
        }

        jQuery(tabs[i]).addClass('formtab_' + i);
        var t = jQuery(tabs[i]).children('h2').text();
        jQuery(tabs[i]).children('h2').html('');
        if(i == 0)
            var cl = ' active';
        else
            var cl = '';
        div += '<h5 class="tabsLink'+ cl  +'" id="tab_'+ i +'">' + t + '</h5>';
    }

    // ukrywanie naglowka
    jQuery('#sf_admin_header').html(div);


    jQuery('.tabsLink').click(function() {
//        jQuery('.sf_admin_form fieldset').hide();
        jQuery('.sf_admin_form fieldset').not('.never_hide').not('.active_fieldset').hide();
        jQuery('#sf_admin_header').children('h5').removeClass('active');
        var link = jQuery(this).attr('id');
        link = link.split('_');
        link = link[1];
        for(i = 0; i < tabsCnt; i++)
        {
            var form = jQuery(tabs[i]).attr('class');
            form = form.split('_');
            form = form[1];
            if(form == link)
            {
                jQuery(tabs[i]).show();
                jQuery(this).addClass('active');
            }
        }
    });

};

/* dla wersji jezykowych (ukrycie labela Pl) */
//jQuery(function() {
//    jQuery('.sf_admin_form_field_pl label:first').hide();
//});


//metatagi
jQuery(function()
{

//    jQuery('.sf_admin_form_field_Metas div.content table table').prepend('<h3 class="metas_lang_caption">' + 'Meta:' + '</h3>');
//    jQuery('document').ready(function() {
//      jQuery('.metas_lang_caption').each(function() {
//        label = jQuery(this).next().find('input:first').attr('id');
//        label = label.replace('articles_Metas_', '');
//        label = label.replace('_generate', '');
//        label = label + ':';
//        jQuery(this).html(label);
//      })
//    })


    //jQuery('.sf_admin_form_field_Metas div.content table tbody th').not('.sf_admin_form_field_Metas div.content table td table th').hide();
    jQuery('.sf_admin_form_field_Metas div.content table td table th').css('text-align', 'left');

    jQuery('#articles_Metas_generate').parent('td').prepend('<span class="generate">Generuj metatagi</span>');
    jQuery('#art_categories_Metas_generate').parent('td').prepend('<span class="generate">Generuj metatagi</span>');
    jQuery('#galleries_Metas_generate').parent('td').prepend('<span class="generate">Generuj metatagi</span>');
    jQuery('#products_Metas_generate').parent('td').prepend('<span class="generate">Generuj metatagi</span>');
    jQuery('#products_categories_Metas_generate').parent('td').prepend('<span class="generate">Generuj metatagi</span>');

    var metas = jQuery('.sf_admin_form_field_Metas div div.content table tbody tr td table tbody tr');
    
    if(metas[0])
    {
        metas.hide();
        for( i = 0; i < 4; i++)
        {
            jQuery(metas[i]).show();
        }

        var link = '<a href="#" class="showDetailsMetas">Zaawansowane metatagi</a>';
        jQuery('.sf_admin_form_field_Metas').append(link);

        jQuery('.showDetailsMetas').click(function() {
            var metas = jQuery('.sf_admin_form_field_Metas div table tbody tr');
            metas.show();
            return false;
        });
        //jQuery(metas[1]).children('td tbody table tr').hide();
        jQuery(metas[1]).addClass('default_metas');
        var tr = jQuery('.default_metas td table tbody tr');
        tr.hide();
        for( i = 0; i < 5; i++)
        {
            jQuery(tr[i]).show();
        }


    }


    function displayMetas(f)
    {
        var metas = jQuery('.sf_admin_form_field_Metas div.content table tbody tr');
        for(i = 2; i < 5; i++)
        {
            if(f == true)
            {
                jQuery(metas[i]).children('td').children('input').attr('disabled', '');
            }
            else
            {
                jQuery(metas[i]).children('td').children('input').attr('disabled', 'disabled');
            }
        }
    }


    //var metas = jQuery('.sf_admin_form_field_Metas div.content table tbody tr');
    if(jQuery(metas[0]).children('td').children('input').attr('checked'))
    {
        displayMetas(false);
    }

    jQuery(metas[0]).children('td').children('input').click(function()
    {
        if(jQuery(this).attr('checked'))
        {
            displayMetas(false);
        }
        else
        {
            displayMetas(true);
        }
    });

});
