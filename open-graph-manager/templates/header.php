<?php $this->layout('wrapper') ?>
<div class="tabs">
    <form action="<?php echo $formUrl ?>" ononSubmit="window.location.reload()" value="refresh" method="post">
        <button type="submit" name="tab" value="general" <?php if(!$this->isTab('twitter') && !$this->isTab('facebook')): ?>class="active" disabled<?php endif; ?>>General</button>
        <button type="submit" name="tab" value="facebook" <?php if($this->isTab('facebook')): ?>class="active" disabled<?php endif; ?>>Facebook</button>
        <button type="submit" name="tab" value="twitter" <?php if($this->isTab('twitter')): ?>class="active" disabled<?php endif; ?>>Twitter</button>
    </form>
</div>
<h1>Open Graph Manager - <?php echo $OGM_OPTIONS ?></h1>
<p><?php echo $OGM_TEXT_INTRODUCTION ?></p>
<?php if(isset($_POST['save'])): ?>
    <div class="sys-msg-success"><?php echo $OGM_SAVE_SUCCESS ?></div>
<?php endif; ?>

