<?php
namespace ShoppingFeed\CodeStyle;

return [
    'console' => [
        'dependencies' => [
            'invokables' => [
                Console\PHPCSCommand::class => Console\PHPCSCommand::class
            ]
        ],
        'apps' => [
            'test' => [
                'name'     => 'Run PHPCS validation check and eventually autofix CS violations',
                'commands' => [
                    'phpcs' => Console\PHPCSCommand::class,
                ]
            ]
        ]
    ]
];
