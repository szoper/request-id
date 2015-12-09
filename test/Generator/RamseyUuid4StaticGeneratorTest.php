<?php

namespace PhpMiddlewareTestTest\RequestId\Generator;

use PhpMiddleware\RequestId\Generator\RamseyUuid4StaticGenerator;
use PHPUnit_Framework_TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class RamseyUuid4StaticGeneratorTest extends PHPUnit_Framework_TestCase
{
    protected $generator;


    protected function setUp()
    {
        $this->generator = new RamseyUuid4StaticGenerator();
    }

    public function testGenerateId()
    {
        $uuidString = $this->generator->generateRequestId();

        $uuid = Uuid::fromString($uuidString);

        $this->assertInstanceOf(UuidInterface::class, $uuid);
    }
}
