<?php
/**
 * @version $Id: ext_localconf.php 40729 2010-12-01 13:45:41Z just2b $
 */

if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
    $_EXTKEY,
    'Pi1',
    array(
        'News' => 'index,list,latest,detail,search,searchResult,archiveMenu,listArchiveMenu',
        'Category' => 'list',
    ),
	array(
        'News' => 'search,searchResult,archiveMenu,listArchiveMenu',
    )
);


	// Page module hook
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['list_type_Info'][$_EXTKEY . '_pi1'][$_EXTKEY] =
	'EXT:' . $_EXTKEY . '/Resources/Private/Backend/class.tx_' . $_EXTKEY . '_cms_layout.php:tx_' . $_EXTKEY . '_cms_layout->getExtensionSummary';

?>