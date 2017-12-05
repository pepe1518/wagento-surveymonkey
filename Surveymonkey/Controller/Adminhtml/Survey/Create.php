<?php

namespace Wagento\Surveymonkey\Controller\Adminhtml\Survey;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Create extends Action {
    /**
     * @var \Wagento\Surveymonkey\Helper\Surveys
     */
    private $surveys;

    public function __construct(
        Action\Context $context,
        \Wagento\Surveymonkey\Helper\Surveys $surveys
    )
    {
        parent::__construct($context);
        $this->surveys = $surveys;
    }

    /**
     *
     */
    public function execute()
    {
        // TODO: Implement execute() method.

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        $payload = array();

        if (!$this->_formKeyValidator->validate($this->getRequest())) {
            $this->messageManager->addErrorMessage('Can\' create ticket please try again');
            return $resultRedirect->setPath('*/*/edit');
        }

        $data = $this->getRequest()->getParam('general');

//        if(isset($data["general"])){
//            $data = array_merge($data, $data["general"]);
//            unset($data["general"]);
//        }

        $surveyName = trim($data['survey_name']);

        $payload['title'] = $surveyName;

        if (!empty($data['template_id'])) {
            $payload['from_template_id'] = trim($data['template_id']);
        }

        if ($this->surveys->createSurvey($payload)) {
            $this->messageManager->addSuccessMessage('Survey Created successfully');
        }
        else {
            $this->messageManager->addErrorMessage('Error while you are creating a new survey, Please try again');
        }

        return $resultRedirect->setPath('*/*');

    }
}