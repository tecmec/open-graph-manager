<?php
/**
 * Plugin Name: Open Graph Manager
 * Description: Add open graph meta tags to your site
 * Version: 0.0.1
 * Author: Danilo Puchelt
 * Author URI: http://www.github.com/tecmec
 */

/*************************************
 * Load Plates Tpl Engine Classes
 */
require_once(GSPLUGINPATH . OGM_SUB_FOLDER . '/plates/Engine.php');
require_once(GSPLUGINPATH . OGM_SUB_FOLDER . '/plates/Template/Data.php');
require_once(GSPLUGINPATH . OGM_SUB_FOLDER . '/plates/Template/Directory.php');
require_once(GSPLUGINPATH . OGM_SUB_FOLDER . '/plates/Template/FileExtension.php');
require_once(GSPLUGINPATH . OGM_SUB_FOLDER . '/plates/Template/Folder.php');
require_once(GSPLUGINPATH . OGM_SUB_FOLDER . '/plates/Template/Folders.php');
require_once(GSPLUGINPATH . OGM_SUB_FOLDER . '/plates/Template/Func.php');
require_once(GSPLUGINPATH . OGM_SUB_FOLDER . '/plates/Template/Functions.php');
require_once(GSPLUGINPATH . OGM_SUB_FOLDER . '/plates/Template/Name.php');
require_once(GSPLUGINPATH . OGM_SUB_FOLDER . '/plates/Template/Template.php');
require_once(GSPLUGINPATH . OGM_SUB_FOLDER . '/plates/Extension/ExtensionInterface.php');
require_once(GSPLUGINPATH . OGM_SUB_FOLDER . '/plates/Extension/Asset.php');
require_once(GSPLUGINPATH . OGM_SUB_FOLDER . '/plates/Extension/URI.php');

/*************************************
 * Init Plates Tpl Engine
 */
$platesTpl = new League\Plates\Engine(GSPLUGINPATH . OGM_SUB_FOLDER . '/templates');

/*************************************
 * Register Tpl Helper Function
 */
$platesTpl->registerFunction('isTab', function ($string) {
    if (@$_POST['tab'] == $string) {
        return true;
    }
    return false;
});

/*************************************
 * Get & save data
 */
$params = $_REQUEST;

$allowedXmlVars = array(
    "general_author",
    "general_publisher",
    "general_image_path",
    "twitter_site",
    "twitter_creator",
    "facebook_page_id",
    "facebook_admins"
);

foreach ($params as $key => $value) {
    if (!in_array($key, $allowedXmlVars)) {
        unset($params[$key]);
    }
}

if (file_exists(GSDATAOTHERPATH . OGM_SETTINGS_FILE)) {
    $data = getXML(GSDATAOTHERPATH . OGM_SETTINGS_FILE);
    if ($data) {
        foreach ($data->children() as $child) {
            if (!array_key_exists($child->getName(), $params)) {
                $params[$child->getName()] = (string)$child;
            }
        }
    }
}

if (isset($_POST['save'])) {
    $data = @new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><settings></settings>');
    foreach ($params as $key => $value) {
        $node = $data->addChild($key);
        $node->addCData((string)$value);
    }
    XMLsave($data, GSDATAOTHERPATH . OGM_SETTINGS_FILE);
}

/*************************************
 * Header Text Tpl
 */
$templateVars = array(
    'OGM_OPTIONS' => i18n('open-graph-manager/OGM_OPTIONS', false),
    'OGM_TEXT_INTRODUCTION' => i18n('open-graph-manager/OGM_TEXT_INTRODUCTION', false),
    'OGM_SAVE_SUCCESS' => i18n('open-graph-manager/OGM_SAVE_SUCCESS', false),
    'formUrl' => $_SERVER['REQUEST_URI'],
);
$headerTemplate = $platesTpl->make('header');
$headerTemplate->data($templateVars);
echo $headerTemplate->render();

/*************************************
 * General Config Form Tpl
 */
if (!isset($_POST['tab']) || $_POST['tab'] == 'general') {
    $templateVars = array(
        'OGM_BUTTON_SAVE' => i18n('open-graph-manager/OGM_BUTTON_SAVE', false),
        'OGM_GENERAL_AUTHOR' => i18n('open-graph-manager/OGM_GENERAL_AUTHOR', false),
        'OGM_GENERAL_PUBLISHER' => i18n('open-graph-manager/OGM_GENERAL_PUBLISHER', false),
        'OGM_GENERAL_IMAGE_PATH' => i18n('open-graph-manager/OGM_GENERAL_IMAGE_PATH', false),
        'OGM_HEADLINE_GENERAL_CONFIGURATION' => i18n('open-graph-manager/OGM_HEADLINE_GENERAL_CONFIGURATION', false),
        'formUrl' => $_SERVER['REQUEST_URI'],
        'general_author' => $params['general_author'],
        'general_publisher' => $params['general_publisher'],
        'general_image_path' => $params['general_image_path'],
    );
    $generalTemplate = $platesTpl->make('general_config');
    $generalTemplate->data($templateVars);
    echo $generalTemplate->render();
}

/*************************************
 * Facebook Config Form Tpl
 */
if (isset($_POST['tab']) && $_POST['tab'] == 'facebook') {
    $templateVars = array(
        'OGM_BUTTON_SAVE' => i18n('open-graph-manager/OGM_BUTTON_SAVE', false),
        'OGM_HEADLINE_FACEBOOK_CONFIGURATION' => i18n('open-graph-manager/OGM_HEADLINE_FACEBOOK_CONFIGURATION', false),
        'OGM_LABEL_FACEBOOK_PAGE_ID' => i18n('open-graph-manager/OGM_LABEL_FACEBOOK_PAGE_ID', false),
        'OGM_LABEL_FACEBOOK_ADMINS' => i18n('open-graph-manager/OGM_LABEL_FACEBOOK_ADMINS', false),
        'formUrl' => $_SERVER['REQUEST_URI'],
        'facebook_page_id' => $params['facebook_page_id'],
        'facebook_admins' => $params['facebook_admins'],
    );
    $facebookTemplate = $platesTpl->make('facebook_config');
    $facebookTemplate->data($templateVars);
    echo $facebookTemplate->render();
}

/*************************************
 * Twitter Config Form Tpl
 */
if (isset($_POST['tab']) && $_POST['tab'] == 'twitter') {
    $templateVars = array(
        'OGM_BUTTON_SAVE' => i18n('open-graph-manager/OGM_BUTTON_SAVE', false),
        'OGM_HEADLINE_TWITTER_CONFIGURATION' => i18n('open-graph-manager/OGM_HEADLINE_TWITTER_CONFIGURATION', false),
        'OGM_LABEL_TWITTER_SITE' => i18n('open-graph-manager/OGM_LABEL_TWITTER_SITE', false),
        'OGM_LABEL_TWITTER_CREATOR' => i18n('open-graph-manager/OGM_LABEL_TWITTER_CREATOR', false),
        'OGM_HEADLINE_TWITTER_CONFIGURATION' => i18n('open-graph-manager/OGM_HEADLINE_TWITTER_CONFIGURATION', false),
        'formUrl' => $_SERVER['REQUEST_URI'],
        'twitter_site' => $params['twitter_site'],
        'twitter_creator' => $params['twitter_creator'],
    );
    $twitterTemplate = $platesTpl->make('twitter_config');
    $twitterTemplate->data($templateVars);
    echo $twitterTemplate->render();
}

