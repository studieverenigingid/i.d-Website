<?php
  function custom_language_switcher(){
      $languages = icl_get_languages('skip_missing=0&orderby=code');
      if(!empty($languages)){
          echo '<ul class="primary-menu__language-switch">';
          foreach($languages as $l){
              echo '<li class="menu-item menu-item--language-switch">';
                if(!$l['active']) echo '<a href="'.$l['url'].'">';
                  echo strtoupper($l['language_code']);
                if(!$l['active']) echo '</a>';
              echo '</li>';
          }
          echo '</ul>';
      }
  }
