<?php

namespace GeorgRinger\L10n\Hooks;

use GeorgRinger\L10n\FieldProvider;
use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class DataHandlerHook
{
    /** @var FieldProvider */
    protected $fieldProvider;

    public function __construct()
    {
        $this->fieldProvider = GeneralUtility::makeInstance(FieldProvider::class);
    }

    public function processDatamap_afterDatabaseOperations($status, $table, $id, $fieldArray, DataHandler $parentObject)
    {

        if (!$this->checkBasicRequirements($table, $status)) {
            return;
        }
        $fieldsToCare = $this->getChangedFields($table, $fieldArray);
        // no fields touched, nothing todo
        if (empty($fieldsToCare)) {
            return;
        }

        if (isset($GLOBALS['TCA'][$table]['ctrl']['transForeignTable'])) {
            $where = 'pid=' . ($id);
            $this->getDatabaseConnection()->exec_UPDATEquery($GLOBALS['TCA'][$table]['ctrl']['transForeignTable'], $where, $fieldsToCare);
        } else {
            $where = $GLOBALS['TCA'][$table]['ctrl']['transOrigPointerField'] . '=' . ($id)
                . ' AND ' . $GLOBALS['TCA'][$table]['ctrl']['languageField'] . '>0';
            $this->getDatabaseConnection()->exec_UPDATEquery($table, $where, $fieldsToCare);
        }

    }

    /**
     * @param string $table
     * @param string $status
     * @return bool
     */
    protected function checkBasicRequirements(string $table, string $status):bool
    {
        if (!isset($GLOBALS['TCA'][$table]['ctrl']['transOrigPointerField'])) {
            return false;
        }
        // @todo what about other states like new?
        if ($status !== 'update') {
            echo 'y';
            return false;
        }
        if (!$this->fieldProvider->tableAvailable($table)) {
            echo 'z';
            return false;
        }

        return true;
    }

    /**
     * @param string $table
     * @param array $fieldArray
     * @return array
     */
    protected function getChangedFields(string $table, array $fieldArray):array
    {
        $fieldsToCare = [];
        $fieldsWhichMustBeUpdated = $this->fieldProvider->getFields($table);
        foreach ($fieldArray as $key => $_value) {
            if (in_array($key, $fieldsWhichMustBeUpdated)) {
                $fieldsToCare[$key] = $_value;
            }
        }
        return $fieldsToCare;
    }

    /**
     * @return DatabaseConnection
     */
    protected function getDatabaseConnection():DatabaseConnection
    {
        return $GLOBALS['TYPO3_DB'];
    }
}