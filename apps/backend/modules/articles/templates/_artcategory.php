
<?php

$artcategory = $articles->getArtCategories();

echo $artcategory->getLevel() ? $artcategory : '';

?>