# FabMailerAdapter

A simple interface for swapping out mailer clients. Currently included are SwiftMailer and PHPMailer

### Simple Usage

Switch the settings in **init.deployment.php** for your testing purposes. I highly recommend using application passwords for your smtp authentication if using services such as gmail/hotmail. Configure your messages in here too.


```php
require_once __DIR__ . '/init.deployment.php';

$mail = new FabMailerAdapter\PhpMailerAdapter();

foreach($mailQueue as $smtp => $mailers) {
    if(isset($mailers['connection']['host']) && $mailers['connection']['host'] != '') {
        $mail->setTransport(
            $mailers['connection']['host'],
            $mailers['connection']['port'],
            $mailers['connection']['user'],
            $mailers['connection']['pass'],
            $mailers['connection']['encryption']
        );
    }

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
```
