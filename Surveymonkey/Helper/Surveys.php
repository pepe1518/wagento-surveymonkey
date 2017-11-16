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
     *
     */
    const SHOW_SURVEY = '/v3/surveys/%s';

    /**
     * @var \Wagento\Surveymonkey\Helper\Users
     */
    private $userName;

    /**
     * Surveys constructor.
     * @param Context $context
     * @param Data $surveyHelper
     * @param Api\Source\Client $client
     * @param Users $users
     */
    public function __construct
    (
        Context $context,
        \Wagento\Surveymonkey\Helper\Data $surveyHelper,
        \Wagento\Surveymonkey\Helper\Api\Source\Client $client,
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
    public function listSurveys() {
        $response = $this->get(self::SURVEYS);
        $data = json_decode($response);

        return $data;
    }

    /**
     * Create empty survey
     * @param $surveyTitle
     * @param bool $nickname
     * @return mixed
     */
    public function createEmptySurvey($surveyTitle, $nickname = false) {
        if($nickname) {
            $this->userName = $nickname;
        }

        $params = [
            'title' => $surveyTitle,
            'nickname' => $this->userName
        ];

        $response = $this->post(self::SURVEYS, json_encode($params));
        $data = json_decode($response, true);

        return $data;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function createSurvey($params) {
        $response = $this->post(self::SURVEYS, json_encode($params));
        $data = json_decode($response, true);

        return $data;
    }

    /**
     * @return mixed
     */
    public function getOptionsSurvey() {
        $response = $this->options(self::SURVEYS);
        $data = json_decode($response);

        return $data;
    }

    /**
     * @param $surveyId
     * @return mixed
     */
    public function getSurvey($surveyId) {
        $endpoint = sprintf(self::SHOW_SURVEY, $surveyId);
        $response = $this->get($endpoint);

        $data = json_decode($response);

        return $data;
    }

    public function deleteSurvey($surveyId) {
        $endpoint = sprintf(self::SHOW_SURVEY, $surveyId);
        $response = $this->delete($endpoint);
        $data = json_decode($response);

        return $data;
    }
}