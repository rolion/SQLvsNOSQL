<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    'mongodb' => [
        'class' => '\yii\mongodb\Connection',
        'dsn' => 'mongodb://localhost:27017/documentos',
        ],
    ],
];
