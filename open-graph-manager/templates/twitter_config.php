<?php $this->layout('form', array('OGM_BUTTON_SAVE' => $OGM_BUTTON_SAVE)) ?>
<h3><?php echo $OGM_HEADLINE_TWITTER_CONFIGURATION; ?></h3>
<div class="option">
    <label for="twitter_site"><?php echo $OGM_LABEL_TWITTER_SITE ?></label>
    <input type="text" name="twitter_site" value="<?php echo $twitter_site ?>"/>
</div>
<div class="option">
    <label for="twitter_creator"><?php echo $OGM_LABEL_TWITTER_CREATOR ?></label>
    <input type="text" name="twitter_creator" value="<?php echo $twitter_creator ?>" />
</div>