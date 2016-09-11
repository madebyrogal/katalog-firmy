<?php
    $pictures = $gallery->getPicturesWithoutDefault();
?>

<?php if(count($pictures) > 0): ?>
    <?php foreach($pictures as $picture): ?>
        <table style="float: left; margin-right: 20px;" cellspacing="10">
            <tr>
                <td><img src="/uploads/thumbnails/logo/<?php echo $picture->getFile(); ?>" /></td>
                <td><a class="deletePicture" href="<?php echo url_for('panel_delete_picture', $picture); ?>">usuń</a></td>
            </tr>
        </table>
    <?php endforeach; ?>
<?php else: ?>
  brak zdjęć
<?php endif; ?>

<div style="clear: both;"></div>