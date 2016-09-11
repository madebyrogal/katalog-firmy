var IE = document.all ? true : false;
if (!IE) document.captureEvents(Event.MOUSEMOVE);
document.onmousemove = getMouseXY;
var tempX = 0;
var tempY = 0;

function getMouseXY(e) {
    if (IE) {
        tempX = event.clientX + (document.documentElement||document.body).scrollLeft;
        tempY = event.clientY + (document.documentElement||document.body).scrollTop;
    } else {
        tempX = e.pageX;
        tempY = e.pageY;
    }
    if (tempX < 0){
        tempX = 0;
    }
    if (tempY < 0){
        tempY = 0;
    }
    return true;
}

function getWindowHeight() {
    if( typeof( window.innerWidth ) == 'number' ) {
        return window.innerHeight;
    } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
        return document.documentElement.clientHeight;
    } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
        return document.body.clientHeight;
    } else {
        return 0;
    }
}

function getWindowWidth() {
    var myWidth = 0;
    if( typeof( window.innerWidth ) == 'number' ) {
        myWidth = window.innerWidth;
    }
    else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
        myWidth = document.documentElement.clientWidth;
    } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
        myWidth = document.body.clientWidth;
    }
    return myWidth;
}

function hideImage() {
    var oDisImage = document.getElementById('disImage');
    oDisImage.style.display =  'none';
}

function disImage(theme) {
    var oDisImage = document.getElementById('disImage');
    oDisImage.style.display =  'block';
    var srcY = (tempY + 10) + 'px';
    var srcX = (tempX + 10) + 'px';
    
    oDisImage.style.top = srcY;
    oDisImage.style.left = srcX;    

    var oImg = document.createElement("img");
    oImg.src = '/themes/' + theme + '/img/layout.png';    

    oDisImage.innerHTML = "";

    oDisImage.appendChild(oImg);

}

jQuery(function() {
    jQuery('.tagbox .remove').click(function(e) {

        e.preventDefault();

        tag = jQuery(this).next('.tag').html();
        remove_list = jQuery('#articles_Tags_remove_tags');

        if(remove_list.val() == '') {
            remove_list.val(tag);
        } else {
            remove_list.val(remove_list.val() + ',' + tag);
        }

        jQuery(this).parent().hide();
       
        remove_list_hint = jQuery("#remove_tag_help #remove_list");
       
        if(remove_list_hint.html() == '')
            remove_list_hint.html(tag);
        else
            remove_list_hint.html(remove_list_hint.html() + ', ' + tag);

        jQuery("#remove_tag_help").show();
    });
});

jQuery(function() {
    jQuery('#sf_fieldset_obrazek').parent('form').submit(function() {
        jQuery('#bgTransparent').show();
        jQuery('#infoBox').show();
        var H = getWindowHeight() / 2;
        H = H - 100;
        H = H + 'px';
        var W = getWindowWidth() / 2;
        W = W - 150;
        W = W + 'px';
        jQuery('#infoBox').css('top', H);
        jQuery('#infoBox').css('left', W);
        jQuery('#infoText').html('Trwa ładowanie obrazka <br /> Proszę czekać');
    //return false;
    });
});

jQuery(function() {
    jQuery('#sf_fieldset_plik').parent('form').submit(function() {
        jQuery('#bgTransparent').show();
        jQuery('#infoBox').show();
        var H = getWindowHeight() / 2;
        H = H - 100;
        H = H + 'px';
        var W = getWindowWidth() / 2;
        W = W - 150;
        W = W + 'px';
        jQuery('#infoBox').css('top', H);
        jQuery('#infoBox').css('left', W);
        jQuery('#infoText').html('Trwa ładowanie pliku <br /> Proszę czekać');
    //return false;
    });
});

function hideCustomFields(category) {
    $('*[name*=ArticleCustomField]').parents('tr').hide();
    //    customFieldsTab = $('h5#tab_4');
    customFieldsTab = $("h5:contains('Właściwości')");

    if(cat_fields[category] == undefined) {
        customFieldsTab.hide();
    } else {
        customFieldsTab.show();

        for(field in cat_fields[category]) {
            $('*[name*="'+cat_fields[category][field]+'"]').parents('tr').show();
        }
    }
}

function deleteImage(id) {
    if(confirm('Na pewno usunąć obrazek?')) {
        
        $('#' + id).parents('.back_image').replaceWith('<div class="ajax_loader" id="loader-' + id + '"></div>');
        
        $.ajax({
            type: 'GET',
            url: '/backend.php/delete_picture_from_gallery/' + id,
            success: function(msg){
                
                msg = JSON.parse(msg);
                
                $('#loader-' + id).remove();

                if($('#picture-' + msg.defaultId + ' .default_image').size() == 0) {
                    $('#picture-' + msg.defaultId + ' #set-default-' + msg.defaultId).replaceWith('<span class="default_image">To obrazek domyślny</span>')
                    $('#picture-' + msg.defaultId + ' .check_picture').parent().remove();
                }
            }
        })
    }
}

function deleteImages(ids) {
    if(confirm('Na pewno chcesz usunąć obrazki?')) {
        
        for(id in ids) {
            $('#' + ids[id]).parents('.back_image').replaceWith('<div class="ajax_loader" id="loader-' + ids[id] + '"></div>');
        
            $.ajax({
                type: 'GET',
                url: '/backend.php/delete_picture_from_gallery/' + ids[id],
                success: function(msg){ 
                    
                    msg = JSON.parse(msg);
                    
                    $('#loader-' + msg.id).remove();
                    
                    if($('#picture-' + msg.defaultId + ' .default_image').size() == 0) {
                        $('#picture-' + msg.defaultId + ' #set-default-' + msg.defaultId).replaceWith('<span class="default_image">To obrazek domyślny</span>');
                        $('#picture-' + msg.defaultId + ' .check_picture').parent().remove();
                    }
                }
            });
        }
    }
}

jQuery(function() {
    $('#articles_artcategory_id').change(function() {
        hideCustomFields($(this).val());
    });
    
    $('.deleteImage').click(function(e) {
        e.preventDefault();
        deleteImage($(this).attr('id')); 
    });
    
    $('#delete_selected_pictures_link').click(function(e) {
        e.preventDefault();
        deleteImages($(this).attr('href').toString().replace(/[^(\d,?)]/g, '').split(','));       
    });
});