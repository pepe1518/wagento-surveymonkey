<?php

namespace Wagento\Surveymonkey\Controller\Index;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\Context;

class Test extends \Magento\Framework\App\Action\Action
{

    /**
     * @var \Wagento\Surveymonkey\Helper\Data
     */
    private $helper;

    private $api;

    private $connector;

    private $users;

    private $survey;
    /**
     * Test constructor.
     * @param Context $context
     */
    public function __construct
    (
        Context $context,
        \Wagento\Surveymonkey\Helper\Data $helper,
        \Wagento\Surveymonkey\Helper\Api\Api $api,
        \Wagento\Surveymonkey\Helper\Api\Connector $connector,
        \Wagento\Surveymonkey\Helper\Users $users,
        \Wagento\Surveymonkey\Helper\Surveys $surveys
    )
    {
        parent::__construct($context);
        $this->helper = $helper;
        $this->api = $api;
        $this->connector = $connector;
        $this->users = $users;
        $this->survey = $surveys;
    }

    /**
     *
     */
    public function execute()
    {
        // TODO: Implement execute() method.
        $num = 5;
        $location = 456;

        $format = 'There are %d monkeys in the %s';
        echo sprintf($format, $num, $location);

        $data = $this->survey->listSurveys();
        \Zend_Debug::dump($data);  die;
//        $survey = $this->survey->createEmptySurvey('test from magetno ce x2 jose', 'pepe1518');
//        $survey = $this->survey->listSurveys();
//        \Zend_Debug::dump($survey);

//        $suveryDeleted = $this->survey->deleteSurvey('126338263');
//        $suveryDeleted = $this->survey->listSurveys();
//        \Zend_Debug::dump($suveryDeleted);
        die('enter to my controller');
    }
}
