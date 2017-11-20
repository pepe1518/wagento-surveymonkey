<?php

/**
 * https://github.com/SurveyMonkey/public_api_docs/blob/master/includes/_collectors.md
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
     *
     */
    const SURVEY_COLLECTOR_MESSAGE = '/v3/collectors/%s/messages';

    /**
     *
     */
    const COLLECTOR_MESSAGE = '/v3/collectors/%d/messages/%s';

    /**
     *
     */
    const SEND_COLLECTOR_MESSAGE = '/v3/collectors/%d/messages/%s/send';

    /**
     *
     */
    const BULK_MESSAGE = '/v3/collectors/%d/messages/%s/recipients/bulk';

    /**
     *
     */
    const COLLECTOR_RECIPIENTS = '/v3/collectors/%s/recipients';

    /**
     *
     */
    const RECIPIENTS_DETAILS = '/v3/collectors/%d}/recipients/%s';

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    private $date;

    /**
     * Collectors constructor.
     * @param Context $context
     * @param Data $surveyHelper
     * @param Api\Source\Client $client
     */
    public function __construct
    (
        Context $context,
        \Wagento\Surveymonkey\Helper\Data $surveyHelper,
        \Wagento\Surveymonkey\Helper\Api\Source\Client $client,
        \Magento\Framework\Stdlib\DateTime\DateTime $date
    )
    {
        parent::__construct($context, $surveyHelper, $client);
        $this->date = $date;
    }

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

        return $data;
    }

    /**
     * @param $collectorId
     * @return mixed
     */
    public function getMessages($collectorId) {
        $endpoint = sprintf(self::SURVEY_COLLECTOR_MESSAGE, $collectorId);
        $response = $this->get($endpoint);
        $data = json_decode($response);

        return $data;
    }

    /**
     * @param $collectorId
     * @param $params
     * @return mixed
     */
    public function createMessage($collectorId, $params) {
        $endpoint = sprintf(self::SURVEY_COLLECTOR_MESSAGE, $collectorId);
        $response = $this->post($endpoint, json_encode($params));
        $data = json_decode($response);

        return $data;
    }

    /**
     * @param $collectorId
     * @param $messageId
     * @param $params
     * @return mixed
     */
    public function updateMessage($collectorId, $messageId, $params) {
        $endpoint = sprintf(self::COLLECTOR_MESSAGE, $collectorId, $messageId);
        $response = $this->put($endpoint, json_encode($params));
        $data = json_decode($response);

        return $data;
    }

    /**
     * @param $collectorId
     * @param $messageId
     * @return mixed
     */
    public function sendMessage($collectorId, $messageId) {
        $endpoint = sprintf(self::SEND_COLLECTOR_MESSAGE, $collectorId, $messageId);
        $param = [
            'scheduled_date' => $this->date->gmtDate()
        ];
        $response = $this->post($endpoint, json_encode($param));
        $data = json_decode($response);

        return $data;
     }

    /**
     * @param $collectorId
     * @param $messageId
     * @param $params
     * @return mixed
     */
     public function bulkMessage($collectorId, $messageId, $params) {
        $endpoint = sprintf(self::BULK_MESSAGE, $collectorId, $messageId);
        $response = $this->post($endpoint, json_encode($params));
        $data = json_decode($response);

        return $data;
     }

    /**
     * @param $collectorId
     * @return mixed
     */
     public function getRecipients($collectorId) {
         $endpoint = sprintf(self::COLLECTOR_RECIPIENTS, $collectorId);
         $response = $this->get($endpoint);
         $data = json_decode($response);

         return $data;
     }

    /**
     * @param $collectorId
     * @param $recipientId
     * @return mixed
     */
     public function getRecipientDetail($collectorId, $recipientId) {
         $endpoint = sprintf(self::RECIPIENTS_DETAILS, $collectorId, $recipientId);
         $response = $this->get($endpoint);
         $data = json_decode($response);

         return $data;
     }
}