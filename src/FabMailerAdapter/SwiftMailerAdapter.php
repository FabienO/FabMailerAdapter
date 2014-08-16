<?php
/**
 * fabMailerAdapter
 *
 * @author      Fabien Oram <fab@lamephp.com>
 * @copyright   Copyright (c) 2014 Fabien Oram
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace FabMailerAdapter;

class SwiftMailerAdapter implements MailerInterface 
{
    protected $mailer;
    protected $transport;
    protected $message;
    private $html;

    /**
    * Set transport layer settings
    *
    * @param $host
    * @param $port
    * @param $user
    * @param $pass
    * @param string $encryption
    * @return mixed|\Swift_SmtpTransport
    */
    public function setTransport($host, $port, $user, $pass, $encryption = '')
    {
        $this->transport = new \Swift_SmtpTransport();

        if($encryption !== '') {
            $this->transport->setEncryption($encryption);
        }

        $this->transport->newInstance($host, $port)
        ->setUsername($user)
        ->setPassword($pass);
    }

    /**
    * Instantiate message
    *
    * @return mixed
    */
    public function createMail()
    {
        $this->message = new \Swift_Message();
    }

    /**
    * Set mail service (SendMail)
    *
    * @param $exchanger
    * @return mixed
    */
    public function setMailExchanger($exchanger = 'SendMail')
    {
    }

    /**
    * Set if HTML
    *
    * @param $bool
    * @return mixed|string
    */
    public function isHTML($bool)
    {
        if($bool)
        {
            $this->html = 'text/html';
        }
        else
        {
            $this->html = 'text/plain';
        }

        $this->html;
    }

    /**
    * Set Subject
    *
    * @param $subject
    * @return mixed
    */
    public function setSubject($subject)
    {
        $this->message->setSubject($subject);
    }

    /**
    * Set From Address
    *
    * @param $name
    * @param $from
    * @return mixed
    */
    public function setFrom($from, $name = '')
    {
        $this->message->setFrom($from, $name);
    }

    /**
    * Set to Address
    *
    * @param $to
    * @param $name
    * @return mixed
    */
    public function setTo($to, $name = '')
    {
        $this->message->addTo($to, $name);
    }

    /**
    * @param array $headers
    */
    public function setHeaders(array $headers = array())
    {
        foreach($headers as $k => $v)
        {
            $this->message->getHeaders()->addTextHeader($k, $v);
        }
    }

    /**
    * Set Body
    *
    * @param $body
    * @return mixed
    */
    public function setBody($body)
    {
        $this->message->setBody($body, $this->html);
    }

    /**
    * Add plaintext version
    *
    * @param $body
    * @return mixed|void
    */
    public function addPart($body)
    {
        $this->message->addPart($body, 'text/plain');
    }

    /**
    * Attach files
    *
    * @param array $filePaths
    * @return mixed|void
    */
    public function attachFiles(array $filePaths = [])
    {
        foreach($filePaths as $filePath) {
            $this->message->attach(\Swift_Attachment::fromPath($filePath));
        }
    }

    /**
    * Set Blind Carbon Copy
    *
    * @param $bcc
    * @return mixed
    */
    public function setBcc($bcc)
    {
        $this->message->setBcc($bcc);
    }

    /**
    * Set Carbon Copy
    *
    * @param $cc
    * @return mixed
    */
    public function setCc($cc)
    {
        $this->message->setCc($cc);
    }

    /**
    * Set Bounce Path
    *
    * @param $returnPath
    * @return mixed
    */
    public function setReturnPath($returnPath)
    {
        $this->message->setReturnPath($returnPath);
    }

    /**
    * Send mail
    *
    * @return int|mixed
    * @throws UninstantiatedClassException
    */
    public function send()
    {
        if(!($this->transport instanceof \Swift_Transport)) {
            throw new uninstantiatedClassException('Transport layer not set');
        }

        $this->mailer = new \Swift_Mailer($this->transport);
        return $this->mailer->send($this->message);
    }
} 