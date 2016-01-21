<?php
/**
 * Plugin Name: Open Graph Manager
 * Description: Add open graph meta tags to your site
 * Version: 0.0.1
 * Author: Danilo Puchelt
 * Author URI: http://www.github.com/tecmec
*/

if(!defined('IN_GS')){ die('you cannot load this page directly.'); }

/*************************************
 * Global Vars
 */
# define subfolder path
define('OGM_SUB_FOLDER','open-graph-manager');

# define subfolder path
define('OGM_SETTINGS_FILE','open-graph-manager.xml');

# get correct id for plugin
$thisFile = basename(__FILE__, ".php");

/*************************************
 * Register Plugin
 */
register_plugin(
    $thisFile, //Plugin id
    'Open Graph Manager', 	//Plugin name
    '0.0.1', 		//Plugin version
    'Danilo Puchelt',  //Plugin author
    'http://www.github.com/tecmec', //author website
    'Add open graph meta tags to your site', //Plugin description
    'plugins', //page type - on which admin tab to display
    'openGraphConfigure'  //main function (administration)
);

/*************************************
 * Merge langugage files
 */
i18n_merge(OGM_SUB_FOLDER, $LANG);
i18n_merge(OGM_SUB_FOLDER, "en_US");

/*************************************
 * Include BE Stylesheet
 */
register_style('ogm', $SITEURL.'plugins/'.OGM_SUB_FOLDER.'/css/ogm-styles.css', '0.2', 'screen');
queue_style('ogm',GSBACK);

/*************************************
 * Add sidebar action
 */
add_action('plugins-sidebar', 'createSideMenu', array( $thisFile, 'Open Graph Manager'));

function openGraphConfigure(){
    require(GSPLUGINPATH.OGM_SUB_FOLDER.'/configure.php');
}

/*************************************
 * Add meta tags to header
 */
add_action('theme-header', 'addMetaTagsToHeader');

function addMetaTagsToHeader(){
    require(GSPLUGINPATH.OGM_SUB_FOLDER.'/output.php');
}








