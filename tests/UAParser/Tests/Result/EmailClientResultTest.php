<?php

namespace UAParser\Tests\Result;

use UAParser\Result\EmailClientResult;

/**
 * @author Benjamin Laugueux <benjamin@yzalis.com>
 */
class EmailClientResultTest extends \PHPUnit\Framework\TestCase
{
    public function testFromArray()
    {
        $emailClientResult = new EmailClientResult();
        $emailClientResult->fromArray(array(
            'family' => 'Thunderbird',
            'major'  => '3',
            'minor'  => '1',
            'patch'  => '2',
            'type'  => 'desktop',
        ));

        $this->assertInstanceOf(\UAParser\Result\EmailClientResult::class, $emailClientResult);
        $this->assertInstanceOf(\UAParser\Result\EmailClientResultInterface::class, $emailClientResult);

        $this->assertEquals('Thunderbird', $emailClientResult->getFamily());
        $this->assertIsString($emailClientResult->getFamily());

        $this->assertEquals('3', $emailClientResult->getMajor());
        $this->assertIsString($emailClientResult->getMajor());

        $this->assertEquals('1', $emailClientResult->getMinor());
        $this->assertIsString($emailClientResult->getMinor());

        $this->assertEquals('2', $emailClientResult->getPatch());
        $this->assertIsString($emailClientResult->getPatch());

        $this->assertEquals('desktop', $emailClientResult->getType());
        $this->assertIsString($emailClientResult->getType());

        $this->assertEquals('Thunderbird 3.1.2', $emailClientResult->__toString());
        $this->assertIsString($emailClientResult->__toString());
    }
}