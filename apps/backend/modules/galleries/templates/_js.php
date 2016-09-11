<script type="text/javascript">
        
    function showUploadedImage(id, fileName, responseJSON) {
        
        if(responseJSON.success) {
            if($('#back_images').size() == 0) {
                $('.sf_admin_form_field_created_at').append('<div id="back_images"></div>');
            }
        
            $('#back_images').append('<div class="ajax_loader" id="loader-' + responseJSON.id + '"></div>')
        
            $.ajax({
                type: "POST",
                url: "/backend.php/pictures/generateBackImage/picture_id/" + responseJSON.id,
                success: function(msg){
                    
                    $('#loader-' + responseJSON.id).after(msg);
                    $('#loader-' + responseJSON.id).remove();
                                        
                    $('.upload_file_wrap:eq(' + id + ')').fadeOut(800);
                    
                    $('#picture-' + responseJSON.id + ' .deleteImage').live('click', function(e) {
                        e.preventDefault();
                        deleteImage($(this).attr('id')); 
                    });
                }
            });
        }
    }
    
</script>
