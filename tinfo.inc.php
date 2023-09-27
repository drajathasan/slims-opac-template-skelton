<?php
$sysconf['template']['base'] = 'php';
$sysconf['template']['responsive'] = false;

$sysconf['template']['option'][$sysconf['template']['theme']] = [
    'responsive' => [
        'dbfield' => 'responsive',
        'label' => __('Enable this theme for mobile?'),
        'type' => 'dropdown',
        'default' => 0,
        'data' => [
            [1, __('Yes, please!')],
            [0, __('No, I want use lighweight theme')]
        ]
    ]
];
