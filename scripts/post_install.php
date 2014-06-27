<?php
if (!defined('sugarEntry')) {
    define('sugarEntry', true);
}

require_once('modules/Administration/QuickRepairAndRebuild.php');

function post_install()
{
    $randc = new RepairAndClear();
    $randc->clearDashlets();
    $randc->clearAdditionalCaches();
    $randc->repairAndClearAll(array('clearAll'), array(translate('LBL_ALL_MODULES')), false, false);

    $fileNameBase = 'modules/Connectors/metadata/display_config.php';
    $fileName = get_custom_file_if_exists($fileNameBase);
    include($fileName);
    $moduleList = array(
        'Accounts',
        'Opportunities',
        'Cases',
    );

    $mapping = array(
        'beans' => array(),
    );

    foreach ($moduleList as $moduleName) {
        $mapping['beans'][$moduleName] = true;
    }

    require_once 'include/connectors/sources/SourceFactory.php';
    $source = SourceFactory::getSource('ext_eapm_connections');
    $source->saveMappingHook($mapping);
}

