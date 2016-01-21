<?php // general open graph meta tags ?>
<meta property="og:title" content="<?php echo get_page_clean_title() ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo get_page_url() ?>" />
<meta property="og:description" content="<?php echo get_page_meta_desc() ?>" />

<?php // general dynamic stuff ?>
<meta property="og:site_name" content="<?php echo get_site_name() ?>" />
<?php if($this->imageExists(get_theme_url(false) . "/" . $general_image_path . return_page_slug().'.jpg')): ?>
    <meta property="og:image" content="<?php echo get_theme_url(false) . "/" . $general_image_path . return_page_slug().'.jpg' ?>" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
<?php endif; ?>
<?php if($general_author): ?>
    <meta property="article:author" content="<?php echo $general_author ?>" />
<?php endif; ?>
<?php if($general_publisher): ?>
    <meta property="article:publisher" content="<?php echo $general_publisher ?>" />
<?php endif; ?>

<?php // facebook stuff ?>
<?php if($facebook_page_id): ?>
    <meta property="fb:app_id" content="<?php echo $facebook_page_id ?>" />
<?php endif; ?>
<?php if($facebook_admins): ?>
    <meta property="fb:admins" content="<?php echo $facebook_admins ?>" />
<?php endif; ?>

<?php // twitter stuff ?>
<meta name="twitter:card" content="summary" />
<?php if($twitter_site): ?>
    <meta name="twitter:site" content="@<?php echo $twitter_site ?>" />
<?php endif; ?>
<?php if($twitter_creator): ?>
    <meta name="twitter:creator" content="@<?php echo $twitter_creator ?>" />
<?php endif; ?>
<meta name="twitter:title" content="<?php echo get_page_clean_title() ?>" />
<meta name="twitter:description" content="<?php echo get_page_meta_desc() ?>" />
<?php if($this->imageExists(get_theme_url(false) . "/" . $general_image_path . return_page_slug().'.jpg')): ?>
    <meta name="twitter:image" content="<?php echo get_theme_url(false) . "/" . $general_image_path . return_page_slug().'.jpg' ?>" />
<?php endif; ?>

