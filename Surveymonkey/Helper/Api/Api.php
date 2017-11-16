<?php

namespace Wagento\Surveymonkey\Helper\Api;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Api extends AbstractHelper {

    /**
     * @var \Wagento\Surveymonkey\Helper\Data
     */

    protected $surveyHelper;

    /**
     * @var \Wagento\Surveymonkey\Helper\Api\Source\Client
     */
    protected $client;

    public function __construct(
        Context $context,
        \Wagento\Surveymonkey\Helper\Data $surveyHelper,
        \Wagento\Surveymonkey\Helper\Api\Source\Client $client
    )
    {
        parent::__construct($context);
        $this->surveyHelper = $surveyHelper;
        $this->client = $client;
    }

    /**
     * Prepare Header request once api is available
     */
    private function prepareAuth() {
        $this->client->setHeaders(
            [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->surveyHelper->getToken()
            ]
        );
    }

    /**
     * @param $endpoint
     * @param array $params
     * @return string
     */
    public function post($endpoint, $params = []) {
        $this->prepareAuth();
        $this->client->send('POST', $this->buildUrl($endpoint), $params);

        return $this->client->getBody();
    }

    /**
     * @param $endpoint
     * @param array $params
     * @return string
     */
    protected function oauthPost($endpoint, $params = []) {
        $this->client->send('POST', $this->buildUrl($endpoint), $params);

        return $this->client->getBody();
    }

    /**
     * @param $endpoint
     * @return string
     */
    public function get($endpoint) {
        $this->prepareAuth();
        $this->client->send('GET', $this->buildUrl($endpoint));

        return $this->client->getBody();
    }

    /**
     * @param $endpoint
     * @return string
     */
    public function put($endpoint) {
        $this->prepareAuth();
        $this->client->send('PUT', $this->buildUrl($endpoint));

        return $this->client->getBody();
    }

    /**
     * @param $endpoint
     * @return string
     */
    public function options($endpoint) {
        $this->prepareAuth();
        $this->client->send('OPTIONS', $this->buildUrl($endpoint));

        return $this->client->getBody();
    }

    /**
     * @param $endpoint
     * @param $params
     * @return string
     */
    public function patch($endpoint, $params) {
        $this->prepareAuth();
        $this->client->send('PATCH',$this->buildUrl($endpoint), $params);

        return $this->client->getBody();
    }

    public function delete($endpoint) {
        $this->prepareAuth();
        $this->client->send('DELETE', $this->buildUrl($endpoint));

        return $this->client->getBody();
    }

    /**
     * @param $endpoint
     * @return string
     */
    private function buildUrl($endpoint) {
        return $this->surveyHelper->getDomain() . $this->buildUrl($endpoint);
    }
}
