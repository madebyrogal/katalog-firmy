<div id="search">
  <div class="search_left"></div>
  <div class="search_center">

      <span class="search_text">Znajdź <br /><span> firmę</span></span>
      <form id="formSearch" action="<?php echo url_for('@search') ?>" method="post">
          <input type="text" id="search_name" name="name" value="<?php echo ($sf_params->get('name')) ? $sf_params->get('name') : 'Czego szukasz?';  ?>" onfocus="if(this.value=='Czego szukasz?') this.value='';" onblur="if(this.value=='') this.value='Czego szukasz?';" />
          <span class="search_text_e search_text_1">np. restauracja, organizacja przyjęć</span>
          <input type="text" id="search_place" name="place" value="<?php echo ($sf_params->get('place')) ? $sf_params->get('place') : 'Gdzie?';  ?>" onfocus="if(this.value=='Gdzie?') this.value='';" onblur="if(this.value=='') this.value='Gdzie?';" />
          <span class="search_text_e search_text_2">np. śląskie, Katowice</span>
          <input type="submit" value="" />
      </form>

  </div>
  <div class="search_right"></div>
</div>