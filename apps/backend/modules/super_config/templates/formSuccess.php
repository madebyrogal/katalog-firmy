<div id="sf_admin_container">
    <div id="sf_admin_content">
        <h1>Ustawienia</h1>
        <div class="sf_admin_form">
            <form method="post" action="">
                
                <fieldset id="sf_fieldset_settings">
                    <h2>Ustawienia</h2>

                    <?php foreach($form as $field): ?>
                        <div class="sf_admin_form_row">

                            <?php
                                
                                echo $field->renderRow();
                                if($defaults[$field->getName()])
                                {
                                    echo '<a class="is_default" href="'.url_for('@settings_removesettings?setting_name='.$field->getName().'&mod='.$mod.'&id='.$object->getPrimaryKey()).'">Przywróć domyślną wartość</a>';
                                }
                                else
                                {
                                    echo '<span class="is_default">Wartość domyślna</span>';
                                }
                            ?>

                        </div>
                    <?php endforeach; ?>

                                           
                </fieldset>
                <input type="submit" value="Zapisz" />
            </form>

        </div>
    </div>
</div>