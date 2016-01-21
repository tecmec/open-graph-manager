<?php $this->layout('form', array('OGM_BUTTON_SAVE' => $OGM_BUTTON_SAVE)) ?>
<h3><?php echo $OGM_HEADLINE_FACEBOOK_CONFIGURATION ?></h3>
<div class="option">
    <label for="facebook_page_id"><?php echo $OGM_LABEL_FACEBOOK_PAGE_ID ?></label>
    <input type="text" name="facebook_page_id" value="<?php echo $facebook_page_id ?>"/>
</div>
<div class="option">
    <label for="facebook_admins"><?php echo $OGM_LABEL_FACEBOOK_ADMINS?></label>
    <input type="text" name="facebook_admins" value="<?php echo $facebook_admins ?>" />
</div>
