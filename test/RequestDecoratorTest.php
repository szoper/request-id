<?php

namespace PhpMiddlewareTestTest\RequestId;

use PhpMiddleware\RequestId\RequestDecorator;
use PhpMiddleware\RequestId\RequestIdProviderInterface;
use Psr\Http\Message\RequestInterface;

class RequestDecoratorTest extends \PHPUnit_Framework_TestCase
{
    const CUSTOM_HEADER_NAME = 'custom-header-name';

    protected $decorator;

    protected function setUp()
    {
        $requestIdProvider = $this->getMock(RequestIdProviderInterface::class);
        $requestIdProvider->expects($this->once())->method('getRequestId')->willReturn('boo');
        $this->decorator = new RequestDecorator($requestIdProvider, self::CUSTOM_HEADER_NAME);
    }

    public function testIsRequestDecorated()
    {
        $request = $this->getMock(RequestInterface::class);
        $request->expects($this->once())->method('withHeader')->willReturnCallback(function($name, $value) use ($request) {
            $this->assertSame(self::CUSTOM_HEADER_NAME, $name);
            $this->assertSame('boo', $value);

            return clone $request;
        });

        $decoratedRequest = $this->decorator->decorate($request);

        $this->assertNotSame($decoratedRequest, $request);
    }
}
