<?php
require_once __DIR__ . '/init.deployment.php';

$mailerFactory = new FabMailerAdapter\MailerFactory();
$mail = $mailerFactory->build('FabMailerAdapter\SwiftMailerAdapter');

if(empty($mailQueue)) {
    die('No mail');
}

foreach($mailQueue as $smtp => $mailers) {

    $mail->setTransport($mailers['connection']['host'], $mailers['connection']['port'], $mailers['connection']['user'], $mailers['connection']['pass'], $mailers['connection']['encryption']);

    foreach($mailers['emails'] as $email) {
        $mail->createMail();

        $mail->setFrom($email['from']);
        $mail->setTo($email['to']);
        $mail->setBody($email['message']);
        $mail->addPart($email['message']);
        $mail->setSubject('Test Emails');

        try
        {
            var_dump($mail->send());
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}