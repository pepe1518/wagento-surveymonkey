<?php

/**
 * https://github.com/SurveyMonkey/public_api_docs/blob/master/includes/_surveys.md
 */
namespace Wagento\Surveymonkey\Helper;

use Magento\Framework\App\Helper\Context;
use Wagento\Surveymonkey\Helper\Api\Api;

/**
 * Class Collectors
 * @package Wagento\Surveymonkey\Helper
 */
class Collectors extends Api {

    /**
     *
     */
    const SURVEY_COLLECTORS = '/v3/surveys/%s/collectors';

    /**
     *
     */
    const COLLECTOR_DATA = '/v3/collectors/%s';

    /**
     * @param $surveyId
     * @param $type weblink or email collector
     * @return mixed
     */
    public function getSurveyCollectors($surveyId, $type) {
        $enpoint = sprintf(self::SURVEY_COLLECTOR, $surveyId);
        $param =[
            'type' => $type
        ];

        $response = $this->get($enpoint, json_encode($param));
        $data = json_decode($response);

        return $data;
    }

    /**
     * @param $surveyId
     * @param $data
     * @return mixed
     */
    public function createCollector($surveyId, $data) {
        $endpoint = sprintf(self::SURVEY_COLLECTOR, $surveyId);

        $response = $this->get($endpoint, json_encode($data));
        $data = json_decode($response);

        return $data;
    }

    /**
     * @param $collectorId
     * @return mixed
     */
    public function getCollector($collectorId) {
        $response = sprintf(self::COLLECTOR_DATA, $collectorId);
        $data = json_decode($response);

        return $data;
    }

    /**
     * @param $surveyId
     * @param $data
     * @return mixed
     */
    public function updateCollector($surveyId, $data) {
        $endpoint = sprintf(self::COLLECTOR_DATA, $surveyId);
        $response = $this->put($endpoint, json_encode($data));
        $data = json_decode($response);

        return $data
    }
}