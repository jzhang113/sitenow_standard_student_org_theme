<?php

/**
 * Implements hook_preprocess_page().
 */
function uiowa_student_org_preprocess_page(&$variables) {
  $variables['hero_image'] = theme_get_setting('uiowa_student_org_toggle_front_page_hero');
  $variables['hero_image_full_path'] = $GLOBALS['base_url'] . '/' . variable_get('file_public_path') . '/theme/hero_image/hero'; 
  $variables['hero_image_link1'] = NULL;
  $variables['hero_image_link2'] = NULL;

  if (theme_get_setting('link1_url')) {
    $variables['hero_image_link1'] = l(theme_get_setting('link1_title'), theme_get_setting('link1_url'));
  }
  if (theme_get_setting('link2_url')) {
    $variables['hero_image_link2'] = l(theme_get_setting('link2_title'), theme_get_setting('link2_url'));
  }
}
