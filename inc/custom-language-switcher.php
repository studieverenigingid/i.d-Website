<?php
  function custom_language_switcher(){
    if(function_exists('icl_object_id')){
      $languages = icl_get_languages('skip_missing=0&orderby=code');
      if(!empty($languages)){
          echo '<ul class="primary-menu__language-switch">';
          foreach($languages as $l){
              echo '';
                if(!$l['active']){?>
                  <li class="menu-item menu-item--language-switch">
                    <span class="primary-menu__language-switch__context"><?php echo esc_attr_x( 'Switch to: ', 'Language Switch Text', 'svid-theme-domain'); ?></span>
                    <a class="primary-menu__language-switch__link" href="<?=$l['url']?>">
                      <?=$l['language_code']?>
                    </a>
                  </li>
              <?php }
          }
          echo '</ul>';
      }
    }
  }
