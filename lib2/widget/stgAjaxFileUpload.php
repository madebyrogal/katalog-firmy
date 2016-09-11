<?php

/**
 * Widget do ładowania AJAXowego plików wyświetlający pasek postępu
 * 
 * Co robi php_callback?
 * To jest skrypt php, który ma wykonać upload i zapis na serwerze
 *
 * Co robi js_callback?
 * js_callback to funkcja java script wywoływana po zakończeniu uploadu pliku.
 * Można w niej umieścić np. wyświetlanie dodanego elementu, dodanie tego elementu do kolekcji elementów, itd.
 * 
 * Nagłowke js_callback: function(id, fileName, responseJSON)
 * Parametry js_callback:
 *  - id - liczony od 0 indeks dodawanego pliku
 *  - fileName - nazwa wgrywanego pliku
 *  - responseJSON - odpowiedź z serwera w postaci JSON
 *    Sukces: {"success" : true } lub {"success" : true [, wlasne dane] }
 *    UWAGA: sukces musi koniecznie zwracać przynajmniej "success" : true
 * 
 *    Porażka: {"error": [komunikat o błędzie]}
 * 
 * 
 * 
 * @package    stgcms2
 * @subpackage widget
 * @author     Bartek Tomżyński <bartekt@studiotg.pl>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class stgAjaxFileUpload extends sfWidgetForm {

    public function configure($options = array(), $attributes = array()) {

        $this->addRequiredOption('php_callback');
        $this->addOption('js_callback', '');
        $this->addOption('parent_id', '');
        $this->addOption('allowed_extensions', array(
            'jpg', 'jpeg', 'gif', 'png'
        ));
    }

    public function getStylesheets() {
        return array(
            sfConfig::get('sf_web_dir_name') . '/backend/themes/css/fileuploader.css' => 'all'
        );
    }

    public function getJavaScripts() {
        return array(sfConfig::get('sf_web_dir_name') . '/backend/themes/js/fileuploader.js');
    }

    public function render($name, $value = null, $attributes = array(), $errors = array()) {

        $url = $this->getOption('php_callback');

        $js_callback = $this->getOption('js_callback');
        
        if ($this->getOption('js_callback') != '')
            $js_callbackFunction = $js_callback . '(id, fileName, responseJSON);';
        else
            $js_callbackFunction = '';
        
        $extensions = '';
        
        foreach($this->getOption('allowed_extensions') as $ext) {
            $extensions .= "'$ext',";
        }
        
        if($extensions != '')
            $extensions = trim ($extensions, ',');

        $html = "<script type=\"text/javascript\">
    
                    jQuery(document).ready(function() {   
                        jQuery('input.jbutton').button();

                        createUploader();
                    });
        
                    function formatSize(bytes){
                        var i = -1;                                    
                        do {
                            bytes = bytes / 1024;
                            i++;  
                        } while (bytes > 99);

                        return Math.max(bytes, 0.1).toFixed(1) + ['kB', 'MB', 'GB', 'TB', 'PB', 'EB'][i];          
                    }

                    function createUploader() {

                        var uploader = new qq.FileUploader({
                            element: document.getElementById('file-uploader'),
                            action: '$url',
                            allowedExtensions: [$extensions],        
                            sizeLimit: 0, // max size   
                            minSizeLimit: 0, // min size
                            params: {
                                parent_id: '{$this->options['parent_id']}'
                            },

                            // set to true to output server response to console
                            debug: false,
                                
                            onSubmit: function(id, fileName){
                                
                            },
                            onProgress: function(id, fileName, loaded, total){

                                var el = $('.upload_file_wrap:eq(' + id + ')');
                                var progressbar_wrap = el.find('.progressbar_wrap');
                                progressbar_wrap.css('display', 'inline-block');
                                progressbar = el.find('.progressbar');
                                
                                progressbar.css('width', progressbar_wrap.width() * (loaded/total) + 'px');
                                
                                var progress = Math.round(loaded / total * 100);
                                
                                if(progress != 100) {
                                    el.find('.progress').html(Math.round(loaded / total * 100) + '% (' + formatSize(loaded) + ' z ' + formatSize(total) + ')');
                                } else {
                                    el.find('.progress').html('100% (przetwarzanie pliku)');
                                }
                            },
                            onComplete: function(id, fileName, responseJSON){
                                if(responseJSON.error != undefined) {
                                    $('.upload_failed_text').html(responseJSON.error);
                                } else {
                                    var el = $('.upload_file_wrap:eq(' + id + ')');

                                    el.find('.progress').html('100%');                                    
                                }
                                
                                // wywolanie js_callback
                                $js_callbackFunction
                            },
                            onCancel: function(id, fileName){},

                            // wyglad
                            template: '<div class=\"file_uploader\">' + 
                                '<div class=\"qq-upload-drop-area\"><span>Drop files here to upload</span></div>' +
                                '<a id=\"add_new_file\" class=\"add_new_file\"><span>Dodaj pliki</span></a>' +
                                '<ul class=\"upload_file_list\"></ul>' + 
                                '</div>',

                            // template for one item in file list
                            fileTemplate: '<li class=\"upload_file_wrap\">' +
                                '<div>' +
                                '<span class=\"upload_file\"></span>' +
                                '<span class=\"upload_file_size\"></span>' +
                                '<a class=\"upload_file_cancel\" href=\"#\">Anuluj</a>' +
                                '<span class=\"ajax_loader\"></span>' +
                                '<span class=\"upload_failed_text\"></span>' +
                                '</div>' +
                                '<div class=\"progressbar_wrap\">' +
                                '<div class=\"progressbar\"></div>' +
                                '</div>' +
                                '<div class=\"progress\"></div>' +
                                '<div class=\"clear\"></div>' +
                                '</li>',        

                            classes: {
                                // used to get elements from templates
                                button: 'add_new_file',
                                drop: 'qq-upload-drop-area',
                                dropActive: 'qq-upload-drop-area-active',
                                list: 'upload_file_list',

                                file: 'upload_file',
                                spinner: 'ajax_loader',
                                size: 'upload_file_size',
                                cancel: 'upload_file_cancel',

                                // added to list item when upload completes
                                // used in css to hide progress spinner
                                success: 'success',
                                fail: 'error'
                            },
                                
                            messages: {
                                typeError: \"Plik {file} jest niewłaściwego formatu. Dozwolone formaty: {extensions}.\",
                                sizeError: \"Plik {file} jest za duzy, maksymalny rozmiar to {sizeLimit}.\",
                                minSizeError: \"Plik {file} jest za mały, minimalny rozmiar to {minSizeLimit}.\",
                                emptyError: \"Plik {file} jest pusty, proszę wybrać inny plik.\",
                                onLeave: \"Trwa przesyłanie plików. Jeżeli opuścisz tą stronę to przesyłanie zostanie anulowane.\"               
                            },
                            showMessage: function(message){ 
                                alert(message);
                            }

                        });
                    }

                </script>
        
                <div id=\"multiupload\" style=\"clear: left;\">
                    <div id=\"file-uploader\"></div>
                </div>";

        return $html;
    }

}