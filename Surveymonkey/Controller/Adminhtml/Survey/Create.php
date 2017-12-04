<?php

namespace Wagento\Surveymonkey\Controller\Adminhtml\Survey;

use Magento\Backend\App\Action;

class Create extends Action {
    /**
     * @var \Wagento\Surveymonkey\Helper\Surveys
     */
    private $survey;

    public function __construct(Action\Context $context)
    {
        parent::__construct($context);
    }

    public function execute()
    {
        // TODO: Implement execute() method.
    }
}