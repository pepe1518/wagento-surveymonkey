<?php
/**
 * https://github.com/SurveyMonkey/public_api_docs/blob/master/includes/_surveys.md
 */
namespace Wagento\Surveymonkey\Helper;

use Magento\Framework\App\Helper\Context;
use Wagento\Surveymonkey\Helper\Api\Api;

class Surveys extends Api {
    // surveymonkey: surveys, pages an questions endpoints
    /**
     * endoint for surveys
     */
    const SURVEYS = '/v3/surveys';
    /**
     * @var \Wagento\Surveymonkey\Helper\Users
     */
    private $userName;

    public function __construct
    (
        Context $context,
        \Wagento\Surveymonkey\Helper\Data $surveyHelper,
        \Magento\Framework\HTTP\Client\Curl $client,
        \Wagento\Surveymonkey\Helper\Users $users
    )
    {
        parent::__construct($context, $surveyHelper, $client);
        $this->userName = $users->getUserMe();
    }

    /**
     * Returns a list of surveys owned or shared with the authenticated user
     * @return mixed
     *
     */
    public function getSurveys() {
        $response = $this->get(self::SURVEYS);
        $data = json_decode($response);

        return $data;
    }

    public function createEmptySurvey($surveyTitle, $nickname = false) {
        if($nickname) {
            $this->userName = $nickname;
        }

        $params = [
            'title' => $surveyTitle,
            'nickname' => $this->userName,
        ];

        $response = $this->post(self::SURVEYS, $params);
        $data = json_decode($response, ture);

        return $data;
    }
}