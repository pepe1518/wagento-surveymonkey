<?php
/**
 * https://github.com/SurveyMonkey/public_api_docs/blob/master/includes/_surveys.md
 */
namespace Wagento\Surveymonkey\Helper;

use Magento\Framework\App\Helper\Context;
use Wagento\Surveymonkey\Helper\Api\Api;

/**
 * Class Surveys
 * @package Wagento\Surveymonkey\Helper
 */
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
     *
     */
    const DETAILS_SURVEY = '/v3/surveys/%s/details';

    /**
     *
     */
    const SURVEY_TEMPLATE = '/v3/survey_templates';

    /**
     *
     */
    const SURVEY_LANGUAES = '/v3/survey_languages';

    /**
     * @var \Wagento\Surveymonkey\Helper\Users
     */
    private $userName;

    /**
     * Returns a list of surveys owned or shared with the authenticated user
     * @return mixed
     *
     */
    public function listSurveys() {
        $response = $this->get(self::SURVEYS);
        $data = json_decode($response, true);

        return isset($data['data']) ? $data['data'] : [];
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

    /**
     * @param $surveyId
     * @return mixed
     */
    public function deleteSurvey($surveyId) {
        $endpoint = sprintf(self::SHOW_SURVEY, $surveyId);
        $response = $this->delete($endpoint);
        $data = json_decode($response);

        return $data;
    }

    /**
     * @param $surveId
     * @param $params
     * @return mixed
     */
    public function updateSurvey($surveId, $params) {
        $endpoint = sprintf(self::SHOW_SURVEY, $surveId);
        $response = $this->put($endpoint, json_encode($params));
        $data = json_decode($response);

        return $data;
    }

    /**
     * @param $surveyId
     * @return mixed
     */
    public function getDetailSurvey($surveyId) {
        $endpoint = sprintf(self::DETAILS_SURVEY, $surveyId);
        $response = $this->get($endpoint);
        $data = json_decode($response);

        return $data;
    }

    /**
     * @param $category
     * @return mixed
     */
    public function getSurveyTemplates($category) {
        $params = [
            'category' => $category
        ];

        $response = $this->get(self::SURVEY_TEMPLATE, json_encode($params));
        $data = json_decode($response);

        return $data;
    }

    /**
     * @return mixed
     */
    public function getLanguages() {
        $response = $this->get(self::SURVEY_LANGUAES);
        $data =json_decode($response);

        return $data;
    }
}