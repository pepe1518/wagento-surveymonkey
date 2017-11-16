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
     * @var \Magento\Framework\HTTP\Client\Curl
     */
    protected $client;

    public function __construct(
        Context $context,
        \Wagento\Surveymonkey\Helper\Data $surveyHelper,
        \Magento\Framework\HTTP\Client\Curl $client
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
        $this->client->post($this->buildUrl($endpoint), $params);
        return $this->client->getBody();
    }

    /**
     * @param $endpoint
     * @param array $params
     * @return string
     */
    protected function oauthPost($endpoint, $params = []) {
        $this->client->post($this->buildUrl($endpoint), $params);
        return $this->client->getBody();
    }

    /**
     * @param $endpoint
     * @return string
     */
    public function get($endpoint) {
        $this->prepareAuth();
        $this->client->get($this->buildUrl($endpoint));
        return $this->client->getBody();
    }

    /**
     * @param $endpoint
     * @return string
     */
    private function buildUrl($endpoint) {
        return $this->surveyHelper->getDomain() . $endpoint;
    }
}
