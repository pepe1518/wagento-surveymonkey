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

//        $data = $this->survey->getSurveys();
//        \Zend_Debug::dump($data);
        $survey = $this->survey->createEmptySurvey('test from magetno ce x2 jose', 'pepe1518');
        \Zend_Debug::dump($survey);
        die('enter to my controller');
    }
}
