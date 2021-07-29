<?php

namespace ShopifyTest;

use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

class HttpRequestMatcherTest extends TestCase
{
    /** @var RequestInterface */
    private $request;

    protected function setUp(): void
    {
        parent::setUp();
        $this->request = new Request('GET', 'https://hello-world.com/something?q1=v1&q2=v2', [], 'Request-body');
    }

    public function testMatchesExactMethodAndUrlAndRegexUserAgentAndBody()
    {
        $this->assertThat(
            $this->request,
            new HttpRequestMatcher(
                'https://hello-world.com/something?q1=v1&q2=v2',
                'GET',
                '//',
                [],
                'Request-body'
            )
        );
        $this->assertThat(
            $this->request,
            $this->logicalNot(
                new HttpRequestMatcher(
                    'https://hello-world.com/something?q1=v1&q2=v2',
                    'GET',
                    '//',
                    [],
                    'Wrong-request-body'
                )
            )
        );
        $this->assertThat(
            $this->request,
            $this->logicalNot(
                new HttpRequestMatcher('https://hello-world.com/something?q1=v1&q2=v2', 'POST', '//')
            )
        );

        $this->assertThat(
            $this->request,
            $this->logicalNot(
                new HttpRequestMatcher('https://hello-world.com/something?q1=v1&q2=v2', 'GET', '/k/')
            )
        );

        $this->assertThat(
            $this->request,
            $this->logicalNot(
                new HttpRequestMatcher('https://hello-world.com/something?q1=v1&q2=v', 'GET', '//')
            )
        );
    }

    public function testMatcherMatchesRegexUserAgent()
    {
        $request = $this->request->withHeader('User-Agent', 'some-user-agent');
        $this->assertThat(
            $request,
            new HttpRequestMatcher(
                'https://hello-world.com/something?q1=v1&q2=v2',
                'GET',
                '/user/',
                [],
                'Request-body'
            )
        );

        $request = $this->request->withHeader('User-Agent', 'some-user-agent');
        $this->assertThat(
            $request,
            $this->logicalNot(
                new HttpRequestMatcher(
                    'https://hello-world.com/something?q1=v1&q2=v2',
                    'GET',
                    '/^user$/',
                    [],
                    'Request-body'
                )
            )
        );
    }

    public function testMatcherMatchesHeaderIgnoringUserAgentHeader()
    {
        $request = $this->request
            ->withHeader('User-Agent', 'some-user-agent')
            ->withHeader('test-header', 'test-header-value');
        $this->assertThat(
            $request,
            new HttpRequestMatcher(
                'https://hello-world.com/something?q1=v1&q2=v2',
                'GET',
                '/user/',
                [
                    'test-header: test-header-value',
                    'Host: hello-world.com',
                ],
                'Request-body',
                false
            )
        );
    }

    public function testForHeaderContainsIfAllowOtherHeadersIsSet()
    {
        $request = $this->request
            ->withHeader('User-Agent', 'some-user-agent')
            ->withHeader('test-header', 'test-header-value')
            ->withHeader('another-test-header', 'another-test-header-value');
        $this->assertThat(
            $request,
            new HttpRequestMatcher(
                'https://hello-world.com/something?q1=v1&q2=v2',
                'GET',
                '/user/',
                ['test-header: test-header-value'],
                'Request-body',
            )
        );
    }
}
