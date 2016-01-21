<?php $this->layout('form', array('OGM_BUTTON_SAVE' => $OGM_BUTTON_SAVE)) ?>
<h3><?php echo $OGM_HEADLINE_GENERAL_CONFIGURATION ?></h3>
<div class="option">
    <label for="general_author"><?php echo $OGM_GENERAL_AUTHOR ?></label>
    <input type="text" name="general_author" value="<?php echo $general_author ?>"/>
</div>
<div class="option">
    <label for="general_publisher"><?php echo $OGM_GENERAL_PUBLISHER ?></label>
    <input type="text" name="general_publisher" value="<?php echo $general_publisher ?>"/>
</div>
<div class="option">
    <label for="general_image_path"><?php echo $OGM_GENERAL_IMAGE_PATH ?></label>
    <input type="text" name="general_image_path" value="<?php echo $general_image_path ?>" />
</div>