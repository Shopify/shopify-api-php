<?php

namespace ShopifyTest\Clients;

use PHPUnit\Framework\MockObject\MockObject;
use Shopify\Clients\Curl;
use PHPUnit\Framework\TestCase;

class CurlTest extends TestCase
{

    public function testSetMethod()
    {
        /** @var Curl|MockObject $curl */
        $curl = $this->getMockBuilder(Curl::class)
            ->onlyMethods(['sendRequest', 'setCurlOption'])
            ->getMock();

        $curl->expects($this->exactly(3))
            ->method('setCurlOption')
            ->withConsecutive(
                [$this->equalTo(CURLOPT_CUSTOMREQUEST), $this->equalTo("PUT")],
                [$this->equalTo(CURLOPT_CUSTOMREQUEST), $this->equalTo("DELETE")],
                [$this->equalTo(CURLOPT_POST), $this->equalTo(true)]
            );

        $curl->setMethod("PUT");
        $curl->setMethod("DELETE");
        $curl->setMethod("POST");
        $curl->setMethod("GET"); # GET doesn't set any options
    }


    public function testInitializeRequest()
    {
        /** @var Curl|MockObject $curl */
        $curl = $this->getMockBuilder(Curl::class)
            ->onlyMethods(['sendRequest', 'setCurlOption'])
            ->getMock();

        $curl->expects($this->once())
            ->method('setCurlOption')
            ->with($this->equalTo(CURLOPT_RETURNTRANSFER), $this->equalTo(true));


        $curl->initializeRequest("https://some_url");

        $this->assertEquals("https://some_url", $curl->getUrl());
    }

    public function testSetBody()
    {
        $body = "some data";
        /** @var Curl|MockObject $curl */
        $curl = $this->getMockBuilder(Curl::class)
            ->onlyMethods(['sendRequest', 'setCurlOption'])
            ->getMock();

        $curl->expects($this->once())
            ->method('setCurlOption')
            ->with($this->equalTo(CURLOPT_POSTFIELDS), $this->equalTo($body));

        $curl->setBody($body);
    }

    public function testSetUserAgent()
    {
        $userAgent = "some user agent";
        /** @var Curl|MockObject $curl */
        $curl = $this->getMockBuilder(Curl::class)
            ->onlyMethods(['sendRequest', 'setCurlOption'])
            ->getMock();

        $curl->expects($this->once())
            ->method('setCurlOption')
            ->with($this->equalTo(CURLOPT_USERAGENT), $this->equalTo($userAgent));

        $curl->setUserAgent($userAgent);
    }

    public function testSetHeader()
    {
        $headers = ["header1", "header2"];
        /** @var Curl|MockObject $curl */
        $curl = $this->getMockBuilder(Curl::class)
            ->onlyMethods(['sendRequest', 'setCurlOption'])
            ->getMock();

        $curl->expects($this->once())
            ->method('setCurlOption')
            ->with($this->equalTo(CURLOPT_HTTPHEADER), $this->equalTo($headers));

        $curl->setHeader($headers);
    }
}
