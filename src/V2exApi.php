<?php

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
            'base_uri' => 'https://www.v2ex.com/api/'
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
     * @param array $params
     * @param bool $format
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
}