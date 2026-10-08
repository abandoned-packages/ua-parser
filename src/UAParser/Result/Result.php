<?php

namespace UAParser\Result;

use Doctrine\Common\Inflector\Inflector;
use Doctrine\Inflector\InflectorFactory;

/**
 * @author Benjamin Laugueux <benjamin@yzalis.com>
 */
class Result implements ResultInterface
{
    private $browser = null;

    private $operatingSystem = null;

    private $device = null;

    private $emailClient = null;

    private $renderingEngine = null;

    public function getBrowser()
    {
        return $this->browser;
    }

    public function getOperatingSystem()
    {
        return $this->operatingSystem;
    }

    public function getDevice()
    {
        return $this->device;
    }

    public function getEmailClient()
    {
        return $this->emailClient;
    }

    public function getRenderingEngine()
    {
        return $this->renderingEngine;
    }

    /**
     * {@inheritDoc}
     */
    public function fromArray(array $data = array())
    {
        $inflector = InflectorFactory::create()->build();

        foreach (get_class_vars(get_class($this)) as $name => $value) {
            if (isset($data[$inflector->tableize($name)])) {
                $class = "\\UAParser\\Result\\" . $inflector->classify($name) . 'Result';
                $this->{$name} = new $class();
                $this->{$name}->fromArray($data[$inflector->tableize($name)]);
            }
        }
    }
}
