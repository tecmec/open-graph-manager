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
require_once(GSPLUGINPATH.OGM_SUB_FOLDER.'/plates/Engine.php');
require_once(GSPLUGINPATH.OGM_SUB_FOLDER.'/plates/Template/Data.php');
require_once(GSPLUGINPATH.OGM_SUB_FOLDER.'/plates/Template/Directory.php');
require_once(GSPLUGINPATH.OGM_SUB_FOLDER.'/plates/Template/FileExtension.php');
require_once(GSPLUGINPATH.OGM_SUB_FOLDER.'/plates/Template/Folder.php');
require_once(GSPLUGINPATH.OGM_SUB_FOLDER.'/plates/Template/Folders.php');
require_once(GSPLUGINPATH.OGM_SUB_FOLDER.'/plates/Template/Func.php');
require_once(GSPLUGINPATH.OGM_SUB_FOLDER.'/plates/Template/Functions.php');
require_once(GSPLUGINPATH.OGM_SUB_FOLDER.'/plates/Template/Name.php');
require_once(GSPLUGINPATH.OGM_SUB_FOLDER.'/plates/Template/Template.php');
require_once(GSPLUGINPATH.OGM_SUB_FOLDER.'/plates/Extension/ExtensionInterface.php');
require_once(GSPLUGINPATH.OGM_SUB_FOLDER.'/plates/Extension/Asset.php');
require_once(GSPLUGINPATH.OGM_SUB_FOLDER.'/plates/Extension/URI.php');

/*************************************
 * Init Plates Tpl Engine
 */
$platesTpl = new League\Plates\Engine(GSPLUGINPATH.OGM_SUB_FOLDER.'/templates');

/*************************************
 * Register Tpl Helper Function
 */
$platesTpl->registerFunction('imageExists', function ($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($code == 200){
        $status = true;
    }else{
        $status = false;
    }
    curl_close($ch);
    return $status;
});

/*************************************
 * Load saved data
 */
$params = array();
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

/*************************************
 * Fill in data and render tpl
 */
$openGraphTemplate = $platesTpl->make('open_graph_data');
$openGraphTemplate->data($params);
$output = $openGraphTemplate->render();
$output = trim(preg_replace('/^\s+|\s+$/m', '', $output));
echo $output;