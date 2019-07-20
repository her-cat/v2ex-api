<?php

/*
 * This file is part of the her-cat/v2ex-api.
 *
 * (c) her-cat <i@her-cat.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace HerCat\V2exApi\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
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

        $base_uri = (string) $api->getHttpClient()->getConfig('base_uri');
        $this->assertSame('https://www.v2ex.com/api/', $base_uri);
    }

    public function testRequest()
    {
        $response = new Response(200, [], '{"success": true}');

        $client = \Mockery::mock(Client::class);
        $client->allows()->get('topics/hot.json', [])->andReturn($response);

        $api = \Mockery::mock(V2exApi::class)->makePartial();
        $api->allows()->getHttpClient()->andReturn($client);

        $this->assertSame(['success' => true], $api->request('topics/hot.json', [], true));
    }

    public function testGetHotTopics()
    {
        $api = \Mockery::mock(V2exApi::class)->makePartial();

        $api->allows()->request('topics/hot.json', [], true)->andReturn(['success' => true]);

        $this->assertSame(['success' => true], $api->getHotTopics());
    }

    public function testGetLatestTopics()
    {
        $api = \Mockery::mock(V2exApi::class)->makePartial();

        $api->allows()->request('topics/latest.json', [], true)->andReturn(['success' => true]);

        $this->assertSame(['success' => true], $api->getLatestTopics());
    }

    public function testGetNode()
    {
        $api = \Mockery::mock(V2exApi::class)->makePartial();

        $api->allows()
            ->request('nodes/show.json', ['name' => 'python'], true)
            ->andReturn(['success' => true]);

        $this->assertSame(['success' => true], $api->getNode('python'));
    }

    public function testGetMemberByUsername()
    {
        $api = \Mockery::mock(V2exApi::class)->makePartial();

        $api->allows()
            ->request('members/show.json', ['username' => 'hercat'], true)
            ->andReturn(['success' => true]);

        $this->assertSame(['success' => true], $api->getMemberByUsername('hercat'));
    }

    public function testGetMemberByID()
    {
        $api = \Mockery::mock(V2exApi::class)->makePartial();

        $api->allows()
            ->request('members/show.json', ['id' => 336714], true)
            ->andReturn(['success' => true]);

        $this->assertSame(['success' => true], $api->getMemberByID(336714));
    }
}
