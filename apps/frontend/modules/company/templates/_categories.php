<?php

    foreach($categories as $category)
    {
        echo '<div class="category_choose">'.CategoryTable::getTreeCategories($category).'</div>';
    }
?>

