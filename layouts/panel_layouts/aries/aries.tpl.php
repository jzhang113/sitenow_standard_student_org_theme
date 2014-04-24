<?php
/**
 * @file
 * Template for the Aries layout.
 *
 * Variables:
 * - $css_id: An optional CSS id to use for the layout.
 * - $content: An array of content, each item in the array is keyed to one
 * panel of the layout.
 */
?>

<?php $banner = array_shift($content); ?>

<div<?php print $attributes ?>>
  <?php if(!empty($banner)): ?>
    <div class="aries-full-width-wrapper">
      <div<?php print drupal_attributes($region_attributes_array['first'])?>>
        <?php print $banner ?>
      </div>
    </div>
  <?php endif; ?>
  <div class="aries-max-width-wrapper">
    <?php foreach($content as $name => $item): ?>
      <?php if (!empty($item)): ?>
        <div<?php print drupal_attributes($region_attributes_array[$name])?>>
          <?php print $item ?>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
</div>
