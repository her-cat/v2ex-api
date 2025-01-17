<?php

/*
 * This file is part of the her-cat/v2ex-api.
 *
 * (c) her-cat <i@her-cat.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace HerCat\V2exApi;

use GuzzleHttp\Client;
use HerCat\V2exApi\Exceptions\HttpException;

/**
 * Class V2exApi.
 */
class V2exApi
{
    /**
     * @var array
     */
    protected $guzzleOptions = [];

    /**
     * V2exApi constructor.
     */
    public function __construct()
    {
        $this->setGuzzleOptions([
            'base_uri' => 'https://www.v2ex.com/api/',
        ]);
    }

    /**
     * @return Client
     */
    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    /**
     * @param array $options
     */
    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = \array_merge($this->guzzleOptions, $options);
    }

    /**
     * @param string $api
     * @param array  $params
     * @param bool   $format
     *
     * @return mixed|string
     *
     * @throws HttpException
     */
    public function request($api, $params = [], $format = true)
    {
        $options = [];

        if (!empty($params)) {
            $options['query'] = http_build_query($params);
        }

        try {
            $response = $this->getHttpClient()
                ->get($api, $options)
                ->getBody()
                ->getContents();

            return $format ? \json_decode($response, true) : $response;
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 获取最热主题.
     *
     * @param bool $format
     *
     * @return mixed|string
     *
     * @throws HttpException
     */
    public function getHotTopics($format = true)
    {
        return $this->request('topics/hot.json', [], $format);
    }

    /**
     * 获取最新主题.
     *
     * @param bool $format
     *
     * @return mixed|string
     *
     * @throws HttpException
     */
    public function getLatestTopics($format = true)
    {
        return $this->request('topics/latest.json', [], $format);
    }

    /**
     * 获取节点信息.
     *
     * @param string $name
     * @param bool   $format
     *
     * @return mixed|string
     *
     * @throws HttpException
     */
    public function getNode($name, $format = true)
    {
        return $this->request('nodes/show.json', ['name' => $name], $format);
    }

    /**
     * 根据用户名获取用户信息.
     *
     * @param string $username
     * @param bool   $format
     *
     * @return mixed|string
     */
    public function getMemberByUsername($username, $format = true)
    {
        return $this->request('members/show.json', ['username' => $username], $format);
    }

    /**
     * 根据用户 ID 获取用户信息.
     *
     * @param int  $id
     * @param bool $format
     *
     * @return mixed|string
     */
    public function getMemberByID($id, $format = true)
    {
        return $this->request('members/show.json', ['id' => $id], $format);
    }
}
