<?php
$loader = require_once __DIR__ . '/vendor/autoload.php';
$loader->add('FabMailerAdapter', __DIR__ . '/src/');

$mailQueue = [
    [
        'connection' => ['host' => 'smtp.live.com', 'port' => '587', 'user' => 'your@hotmail.com', 'pass' => '', 'encryption' => 'tls'],
        'emails' => [
            ['from' => 'from@hotmail.com', 'to' => 'to@url.com', 'message' => 'Hotmail Email Content']
        ]
    ],
    [
        'connection' => ['host' => '', 'port' => '', 'user' => '', 'pass' => ''],
        'emails' => [
            ['from' => 'from@url.com', 'to' => 'to@url.com', 'message' => 'Local Email Content', 'encryption' => '']
        ]
    ],
    [
        'connection' => ['host' => 'smtp.gmail.com', 'port' => '465', 'user' => 'your@gmail.com', 'pass' => '', 'encryption' => 'tls'],
        'emails' => [
            ['from' => 'from@gmail.com', 'to' => 'your@url.com', 'message' => 'gMail Email Content'],
            ['from' => 'from@gmail.com', 'to' => 'your@url.com', 'message' => 'gMail Email Content 2']
        ]
    ]
];