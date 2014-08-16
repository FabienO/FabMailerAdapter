<?php
/**
 * fabMailerAdapter
 * 
 * @author      Fabien Oram <fab@lamephp.com>
 * @copyright   Copyright (c) 2014 Fabien Oram
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace FabMailerAdapter;

class PhpMailerAdapter implements MailerInterface
{
    protected $mailer;
    protected $encryption;

    public function __construct()
    {
        $this->mailer = new \PHPMailer;
    }

    /**
     * @param $host
     * @param $port
     * @param $user
     * @param $pass
     * @param $encryption
     * @return mixed|void
     */
    public function setTransport($host, $port, $user, $pass, $encryption = '')
    {
        $this->mailer->isSMTP();
        $this->mailer->Host = $host;
        $this->mailer->Username = $user;
        $this->mailer->Password = $pass;

        $this->encryption = $encryption;

        if($encryption !== '') {
            $this->mailer->SMTPAuth = true;
            $this->mailer->SMTPSecure = $encryption;
        }
    }

    /**
     * Check instantiated
     *
     * @return mixed|void
     * @throws UninstantiatedClassException
     */
    public function createMail()
    {
        if(!($this->mailer instanceof \PHPMailer))
        {
            throw new UninstantiatedClassException('PHP Mailer class not started');
        }
        else
        {
            // Reset mailer because a new email without encryption has come through.
            if($this->mailer->SMTPAuth && $this->encryption === '')
            {
                $this->mailer = new \PHPMailer;
            }
        }
    }

    /**
     * Not supported
     *
     * @param $exchanger
     * @return mixed|void
     * @throws FeatureMissingException
     */
    public function setMailExchanger($exchanger)
    {
        throw new FeatureMissingException('Exchanger settings are not supported in PHP Mailer');
    }

    /**
     * Set if HTML
     *
     * @param $bool
     * @return mixed
     */
    public function isHTML($bool)
    {
        $this->mailer->isHTML($bool);
    }

    /**
     * Set Subject
     *
     * @param $subject
     * @return mixed
     */
    public function setSubject($subject)
    {
        $this->mailer->Subject = $subject;
    }

    /**
     * Set From Address
     *
     * @param $from
     * @param $name
     * @return mixed
     */
    public function setFrom($from, $name = '')
    {
        $this->mailer->From = $from;
        $this->mailer->FromName = $name;
    }

    public function setHeaders($headers)
    {
        foreach($headers as $k => $v)
        {
            $this->mailer->addCustomHeader($k .': '. $v);
        }
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
        $this->mailer->addAddress($to, $name);
    }

    /**
     * Set Body
     *
     * @param $body
     * @return mixed
     */
    public function setBody($body)
    {
        $this->mailer->Body = $body;
    }

    /**
     * Set plaintext version
     *
     * @param $part
     * @return mixed
     */
    public function addPart($part)
    {
        $this->mailer->AltBody = $part;
    }

    /**
     * Attach file
     *
     * @param $filePaths
     * @return mixed
     */
    public function attachFiles($filePaths = [])
    {
        foreach($filePaths as $filePath)
        {
            $this->mailer->addAttachment($filePath);
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
        $this->mailer->addBCC($bcc);
    }

    /**
     * Set Carbon Copy
     *
     * @param $cc
     * @return mixed
     */
    public function setCc($cc)
    {
        $this->mailer->addCC($cc);
    }

    /**
     * Set Bounce Path
     *
     * @param $returnPath
     * @return mixed
     */
    public function setReturnPath($returnPath)
    {
        $this->mailer->addReplyTo($returnPath);
    }

    /**
     * Send Mail
     *
     * @return mixed
     */
    public function send()
    {
        $sent = $this->mailer->send();
        echo $this->mailer->ErrorInfo;
        return $sent;
    }

} 