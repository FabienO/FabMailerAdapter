<?php
/**
 * fabMailerAdapter
 *
 * @author      Fabien Oram <fab@lamephp.com>
 * @copyright   Copyright (c) 2014 Fabien Oram
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace FabMailerAdapter;

interface MailerInterface
{
    /**
     * @param $host
     * @param $port
     * @param $user
     * @param $pass
     * @param $encryption
     * @return mixed
     */
    public function setTransport($host, $port, $user, $pass, $encryption = '');

    /**
     * Instantiate mailer
     *
     * @return mixed
     */
    public function createMail();

    /**
     * Set mail service (SendMail)
     *
     * @param $exchanger
     * @return mixed
     */
    public function setMailExchanger($exchanger);

    /**
     * Set if HTML
     *
     * @param $bool
     * @return mixed
     */
    public function isHTML($bool);

    /**
     * Set Subject
     *
     * @param $subject
     * @return mixed
     */
    public function setSubject($subject);

    /**
     * Set From Address
     *
     * @param $from
     * @param $name
     * @return mixed
     */
    public function setFrom($from, $name = '');

    public function setHeaders(array $headers = []);

    /**
     * Set to Address
     *
     * @param $to
     * @param $name
     * @return mixed
     */
    public function setTo($to, $name = '');

    /**
     * Set Body
     *
     * @param $body
     * @return mixed
     */
    public function setBody($body);


    /**
     * Set plaintext version
     *
     * @param $part
     * @return mixed
     */
    public function addPart($part);

    /**
     * Attach file
     *
     * @param array $filePaths
     * @return mixed
     */
    public function attachFiles(array $filePaths = []);

    /**
     * Set Blind Carbon Copy
     *
     * @param $bcc
     * @return mixed
     */
    public function setBcc($bcc);

    /**
     * Set Carbon Copy
     *
     * @param $cc
     * @return mixed
     */
    public function setCc($cc);

    /**
     * Set Bounce Path
     *
     * @param $returnPath
     * @return mixed
     */
    public function setReturnPath($returnPath);

    /**
     * Send Mail
     *
     * @return mixed
     */
    public function send();
} 