<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:l10n/Configuration/TsConfig/l10n_ts.ts">');

$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['formDataGroup']['tcaDatabaseRecord'][\GeorgRinger\L10n\Backend\View\Wizard\Element\EvaluateLanguageModeConditions::class] = [
    'depends' => [
        \TYPO3\CMS\Backend\Form\FormDataProvider\EvaluateDisplayConditions::class
    ]
];

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][]
    = \GeorgRinger\L10n\Hooks\DataHandlerHook::class;