<?php

namespace Wagento\Surveymonkey\Controller\Adminhtml\Survey;

use Magento\Backend\App\Action;

class Massdelete extends Action {

    protected $filter;

    /**
     * @var \Wagento\Surveymonkey\Helper\Surveys
     */
    protected $surveys;

    public function __construct(
        \Wagento\Surveymonkey\Helper\Surveys $surveys,
        Action\Context $context
    )
    {
        parent::__construct($context);
        $this->surveys = $surveys;
    }

    public function execute()
    {
        // TODO: Implement execute() method.
        if ($selectedIds = $this->getRequest()->getParam('selected')) {
            foreach ($selectedIds as $id) {
                $this->surveys->deleteSurvey($id);
            }
            $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', count($selectedIds)));
        }

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');

    }
}