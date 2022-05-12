<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
use Doctrine\DBAL\Driver\PDOMySql\Driver as PDOMySqlDriver;

return [
    // ...
    'doctrine' => [
      'connection' =>[
            'orm_default' => [
                'driverClass' => PDOMySqlDriver::class,
                'params' => [
                    'host' => 'localhost',
                    'port' => 3306,
                    'user' => 'root',
                    'password' => '',
                    'dbname' => 'delivery',
                    'charset' => 'utf8',
                ]
            ],
            'orm_passport' => [
                'driverClass' => PDOMySqlDriver::class,
                'params' => [
                    'host' => 'localhost',
                    'port' => 3306,
                    'user' => 'root',
                    'password' => '',
                    'dbname' => 'delivery',
                    'charset' => 'utf8',
                ]
            ],
            'entitymanager'=>[
                'orm_passport' => [
                    'connection' => 'orm_passport',
                    'configuration' => 'orm_passport',
                ]
            ],  
      ],  
    ],
];
