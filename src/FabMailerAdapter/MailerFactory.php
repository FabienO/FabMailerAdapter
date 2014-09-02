<?php
/**
 * FabMailerAdapter
 * 
 * @author      Fabien Oram <fab@lamephp.com>
 * @copyright   Copyright (c) 2014 Fabien Oram
 * @license     http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace FabMailerAdapter;

class MailerFactory
{
    public function build($type='')
    {
        if (class_exists($type))
        {

            return new $type();
        }
        else
        {
            throw new \Exception('Mailer class not found');
        }
    }
} 