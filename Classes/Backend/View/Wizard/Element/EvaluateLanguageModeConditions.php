<?php

namespace GeorgRinger\L10n\Backend\View\Wizard\Element;

use GeorgRinger\L10n\FieldProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class EvaluateLanguageModeConditions implements \TYPO3\CMS\Backend\Form\FormDataProviderInterface
{
    /** @var FieldProvider */
    protected $fieldProvider;

    public function __construct()
    {
        $this->fieldProvider = GeneralUtility::makeInstance(FieldProvider::class);
    }

    /**
     * @param array $result
     * @return array
     */
    public function addData(array $result):array
    {
        return $this->hideStructureFields($result);
    }

    /**
     * @param array $result
     * @return array
     */
    protected function hideStructureFields(array $result):array
    {
        if ($this->fieldsShouldBeHidden($result)) {
            $fields = $this->fieldProvider->getFields($result['tableName']);
            foreach ($fields as $name) {
                unset($result['processedTca']['columns'][$name]);
            }
        }
        return $result;
    }

    /**
     * @param array $result
     * @return bool
     */
    protected function fieldsShouldBeHidden(array $result):bool
    {
        return $this->fieldProvider->tableAvailable($result['tableName']) && (int)$result['databaseRow']['sys_language_uid'][0] === 1;
    }

}