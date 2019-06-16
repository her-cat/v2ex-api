<?php

namespace HerCat\V2exApi\Tests;


use GuzzleHttp\ClientInterface;
use HerCat\V2exApi\V2exApi;
use PHPUnit\Framework\TestCase;

/**
 * Class V2exApiTest.
 */
class V2exApiTest extends TestCase
{
    public function testGetHttpClient()
    {
        $api = new V2exApi();

        $this->assertInstanceOf(ClientInterface::class, $api->getHttpClient());
    }

    public function testSetGuzzleOptions()
    {
        $api = new V2exApi();

        $this->assertNull($api->getHttpClient()->getConfig('timeout'));

        $api->setGuzzleOptions(['timeout' => 6000]);

        $this->assertSame(6000, $api->getHttpClient()->getConfig('timeout'));

        $base_uri = (string)$api->getHttpClient()->getConfig('base_uri');
        $this->assertSame('https://www.v2ex.com/api/', $base_uri);
    }
}