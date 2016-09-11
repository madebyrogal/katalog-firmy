<?php if($objects && count($objects) > 0): ?>

<?php 
  $cnt = count($objects);
  $tab = array();
  for($i = 0; $i < 4; $i++)
  {
    $tab[$i] = ceil($cnt/(4-$i));
    $cnt = $cnt - $tab[$i];
  }
?>
<div class="subcateogry_box">
    <?php 
    $start = 0;
    for($i = 0; $i < 4; $i++)
    {
      $cnt = $cnt + $tab[$i];
      
      echo '<ul>';
      $j = $start;
      for($j; $j < $cnt; $j++)
      {
        echo '<li>';
        echo '<a class="';
        echo ($objects[$j]->isCurentUrl()) ? "active" : "";
        echo '" href="'.url_for('category', $objects[$j]).'">';
        echo '<span>'.$objects[$j]->getName().'</span>';
        echo '</a>';
        echo '</li>';
        $start++;
      }
      echo '</ul>';
      
    }
    ?>
      
    <!--<ul>
    <?php /*foreach($objects as $object): ?>
        <li>
            <a class="<?php echo ($object->isCurentUrl()) ? 'active' : ''; ?>" href="<?php echo url_for('category', $object); ?>">
                <span>
                    <?php echo $object->getName(); ?>
                </span>
            </a>
        </li>
    <?php endforeach;*/ ?>
    </ul>-->
</div>
<?php endif; ?>
