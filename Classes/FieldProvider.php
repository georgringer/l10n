<?php

namespace GeorgRinger\L10n;

class FieldProvider
{
    protected $configurationFields = [
        'tt_content' => ['editlock', 'CType', 'layout', 'shortcut_mode', 'header_layout', 'linktotop', 'starttime', 'endtime', 'hidden', 'fe_group', 'imageheight', 'imagewidth', 'imageborder', 'imagecols', 'imageorient', 'sectionIndex', 'linkToTop', 'colPos', 'image_zoom'],
        'pages_language_overlay' => ['hidden', 'doktype', 'starttime', 'endtime'],
        'tx_news_domain_model_news' => ['type', 'datetime', 'starttime', 'endtime', 'hidden']
    ];

    /**
     * @param string $table
     * @return array
     */
    public function getFields(string $table):array
    {
        return $this->tableAvailable($table) ? $this->configurationFields[$table] : [];
    }

    /**
     * @param string $table
     * @return bool
     */
    public function tableAvailable(string $table) : bool
    {
        return isset($this->configurationFields[$table]);

    }
}