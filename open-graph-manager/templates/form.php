<div class="ogm">
    <form id="twitter-config" action="<?php echo $formUrl ?>" ononSubmit="window.location.reload()" value="refresh" method="post">
        <?php echo $this->section('content'); ?>
        <input type="hidden" name="save" value="1" />
        <?php if($this->isTab('facebook')): ?><input type="hidden" name="tab" value="facebook" /><?php endif; ?>
        <?php if($this->isTab('twitter')): ?><input type="hidden" name="tab" value="twitter" /><?php endif; ?>
        <button type="submit" class="button save-btn"><?php echo $OGM_BUTTON_SAVE ?></button>
    </form>
</div>

