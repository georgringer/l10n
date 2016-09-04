<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'L10n',
    'description' => 'L10n approach',
    'category' => 'backend',
    'author' => 'TYPO3 Core team',
    'state' => 'alpha',
    'clearCacheOnLoad' => true,
    'version' => '1.0.0',
    'constraints' =>
        [
            'depends' => [
                'typo3' => '8.3.0-8.9.99'
            ],
            'conflicts' => [],
            'suggests' => [],
        ]
];