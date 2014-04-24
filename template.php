<?php

/**
 * @file
 * Template overrides as well as (pre-)process and alter hooks for the
 * uiowa_student_org theme.
 */

function uiowa_student_org_breadcrumb($vars) {
  $output = '';

  if (!empty($vars['breadcrumb'])) {

    if ($vars['breadcrumb_current']) {
      $vars['breadcrumb'][] = l(drupal_get_title(), current_path(), array('html' => TRUE));
    }

    $output = '<div id="breadcrumb" class="clearfix"><ul class="breadcrumb">';
    $switch = array('odd' => 'even', 'even' => 'odd');
    $zebra = 'even';
    $last = count($vars['breadcrumb']) - 1;
    $seperator = '<span class="breadcrumb-seperator">&#9656;</span>';

    foreach ($vars['breadcrumb'] as $key => $item) {
      $zebra = $switch[$zebra];
      $attributes['class'] = array('depth-' . ($key + 1), $zebra);
      if ($key == 0) {
        $attributes['class'][] = 'first';
      }
      if ($key == $last) {
        $attributes['class'][] = 'last';
        $output .= '<li' . drupal_attributes($attributes) . '>' . $item . '</li>' . '';
      }
      else
        $output .= '<li' . drupal_attributes($attributes) . '>' . $item . '</li>' . $seperator;
      }

    $output .= '</ul></div>';
    return $output;
  }
}
