<?php

/**
 * @file
 * Theme settings file for the uiowa_student_org theme.
 */

require_once dirname(__FILE__) . '/template.php';

/**
 * Implements hook_form_FORM_alter().
 */
function uiowa_student_org_form_system_theme_settings_alter(&$form, &$form_state) {
  // Custom option for toggling the hero image on the front page.
  $form['theme_settings']['uiowa_student_org_toggle_front_page_hero'] = array(
    '#type' => 'checkbox',
    '#title' => t('Front page hero image'),
    '#description' => t('Allow a hero image to be rendered on the front page.'),
    '#default_value' => theme_get_setting('uiowa_student_org_toggle_front_page_hero'),
  );

  // Configuration options for the hero image on the front page.
  $form['uiowa_student_org_front_page_hero_config'] = array(
    '#type' => 'fieldset',
    '#title' => t('Front page hero image settings'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['uiowa_student_org_front_page_hero_config']['site_slogan_info'] = array(
    '#markup' => t('<b>Note:</b> If enabled for display, the site slogan will be displayed over the hero image.'),
  );
  $form['uiowa_student_org_front_page_hero_config']['image'] = array(
    '#type' => 'fieldset',
    '#title' => t('Image configuration'),
    '#description' => t('Configure the image to display.'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['uiowa_student_org_front_page_hero_config']['links'] = array(
    '#type' => 'fieldset',
    '#title' => t('Links configuration'),
    '#description' => t('Configure links to display over the hero image.'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  // Image settings
  // Helpful text showing the (original) file name, disabled to avoid the user thinking it
  // can be used for any purpose.
  $form['uiowa_student_org_front_page_hero_config']['image']['image_path'] = array(
    '#type' => 'textfield',
    '#title' => 'Hero image file name',
    '#default_value' => theme_get_setting('image_path'),
    '#disabled' => TRUE,
  );
  // Upload field.
  $form['uiowa_student_org_front_page_hero_config']['image']['image_upload'] = array(
    '#type' => 'file',
    '#title' => t('Upload hero image'),
    '#description' => t('Only files with the following extensions are allowed: jpg jpeg gif png.'),
    '#default_value' => theme_get_setting('image_upload'),
  );

  // Link 1 settings
  $form['uiowa_student_org_front_page_hero_config']['links']['link1'] = array(
    '#type' => 'fieldset',
    '#title' => t('Link 1'),
  );
  $form['uiowa_student_org_front_page_hero_config']['links']['link1']['link1_title'] = array(
    '#type' => 'textfield',
    '#title' => t('Title'),
    '#description' => t('Enter the link text'),
    '#default_value' => theme_get_setting('link1_title'),
  );
  $form['uiowa_student_org_front_page_hero_config']['links']['link1']['link1_url'] = array(
    '#type' => 'textfield',
    '#title' => t('URL'),
    '#description' => t('Enter a full URL. Example: http://uiowa.edu'),
    '#default_value' => theme_get_setting('link1_url'),
  );

  // Link 2 settings
  $form['uiowa_student_org_front_page_hero_config']['links']['link2'] = array(
    '#type' => 'fieldset',
    '#title' => t('Link 2'),
  );
  $form['uiowa_student_org_front_page_hero_config']['links']['link2']['link2_title'] = array(
    '#type' => 'textfield',
    '#title' => t('Title'),
    '#description' => t('Enter the link text'),
    '#default_value' => theme_get_setting('link2_title'),
  );
  $form['uiowa_student_org_front_page_hero_config']['links']['link2']['link2_url'] = array(
    '#type' => 'textfield',
    '#title' => t('URL'),
    '#description' => t('Enter a full URL. Example: http://uiowa.edu'),
    '#default_value' => theme_get_setting('link2_url'),
  );

  // We need a custom form submit handler for processing the hero image.
  $form['#submit'][] = 'uiowa_student_org_theme_settings_form_submit';
}

/**
 * Form submit handler for the theme settings form.
 */
function uiowa_student_org_theme_settings_form_submit($form, &$form_state) {
  // Check the destination folder for the hero image, and attempt to create it
  // if it does't exist.
  $directory_path = 'public://theme/hero_image';
  file_prepare_directory($directory_path, FILE_CREATE_DIRECTORY);

  // Store the current hero image path.
  $path = $form_state['values']['image_path'];

  // Define the validation settings.
  $validate = array(
    'file_validate_is_image' => array(),
  );

  // Check for a new uploaded hero image, and use that instead.
  if ($file = file_save_upload('image_upload', $validate)) {
    // Use the same filename for all images so that we can call the image from
    // a css file.
    $filename = 'hero';
    $destination = $directory_path . '/' . $filename;

    file_unmanaged_copy($file->uri, $destination, FILE_EXISTS_REPLACE);

    // Display the file name to users since the full path doesn't mean
    // anything to them.
    $parts = pathinfo($file->filename);
    $form_state['values']['image_path'] = $parts['basename'];
  }
}
