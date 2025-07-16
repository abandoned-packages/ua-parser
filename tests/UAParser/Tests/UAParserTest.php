<?php

namespace UAParser\Tests;

use UAParser\UAParser;

/**
 * @author Benjamin Laugueux <benjamin@yzalis.com>
 */
class UAParserTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorLoadsDefaultRegexesPath()
    {
        $uaParser = new UAParser();

        $result = $uaParser->parse('Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.17 Safari/537.36');

        $this->assertSame($result->getBrowser()->getFamily(), 'Chrome');
    }

    public function testConstructorLoadsCustomRegexesPath()
    {
        $uaParser = new UAParser(__DIR__.'/Fixtures/custom_regexes.yml');

        $result = $uaParser->parse('Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.17 Safari/537.36');

        $this->assertSame($result->getBrowser()->getFamily(), 'Chrome Custom Regex Path Test');
    }

    public function testCustomRegexesFileWithMissingCategoryKey()
    {
        $uaParser = new UAParser(__DIR__.'/Fixtures/empty_regexes.yml');

        $result = $uaParser->parse('');

        $this->assertSame('Other', $result->getBrowser()->getFamily());
        $this->assertSame('Other', $result->getOperatingSystem()->getFamily());
        $this->assertSame('Other', $result->getDevice()->getConstructor());
        $this->assertSame('Other', $result->getEmailClient()->getFamily());
        $this->assertSame('Other', $result->getRenderingEngine()->getFamily());
    }

    public function testClass()
    {
        $uaParser = new UAParser();
        $result = $uaParser->parse('');

        $this->assertInstanceOf(\UAParser\UAParser::class, $uaParser);
        $this->assertInstanceOf(\UAParser\UAParserInterface::class, $uaParser);
        $this->assertInstanceOf(\UAParser\Result\DeviceResult::class, $result->getDevice());
        $this->assertInstanceOf(\UAParser\Result\DeviceResultInterface::class, $result->getDevice());
        $this->assertInstanceOf(\UAParser\Result\OperatingSystemResult::class, $result->getOperatingSystem());
        $this->assertInstanceOf(\UAParser\Result\OperatingSystemResultInterface::class, $result->getOperatingSystem());
        $this->assertInstanceOf(\UAParser\Result\BrowserResult::class, $result->getBrowser());
        $this->assertInstanceOf(\UAParser\Result\BrowserResultInterface::class, $result->getBrowser());
        $this->assertInstanceOf(\UAParser\Result\EmailClientResult::class, $result->getEmailClient());
        $this->assertInstanceOf(\UAParser\Result\EmailClientResultInterface::class, $result->getEmailClient());
        $this->assertInstanceOf(\UAParser\Result\RenderingEngineResult::class, $result->getRenderingEngine());
        $this->assertInstanceOf(\UAParser\Result\RenderingEngineResultInterface::class, $result->getRenderingEngine());
    }
}
