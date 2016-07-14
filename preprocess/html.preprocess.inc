<?php

/**
 * Implements hook_preprocess_html().
 */
function uiowa_student_org_preprocess_html(&$variables) {
    // Use fonts from Typkit.
  drupal_add_js('https://use.typekit.net/xbv0ucq.js', 'external');
  drupal_add_js('try{Typekit.load();}catch(e){}', 'inline');
}
