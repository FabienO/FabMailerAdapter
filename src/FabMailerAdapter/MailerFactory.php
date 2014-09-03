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
    public function __construct($class)
    {
        if (class_exists($class))
        {
            $this->reflector = new \ReflectionClass($class);
        }
        else
        {
            throw new \Exception('Mailer class not found');
        }
    }

    public function setClass($class)
    {
        if (class_exists($class))
        {
            $this->reflector = new \ReflectionClass($class);
        }
        else
        {
            throw new \Exception('Mailer class not found');
        }
    }

    public function create()
    {
            return $this->reflector->newInstanceArgs(func_get_args());
    }
} 