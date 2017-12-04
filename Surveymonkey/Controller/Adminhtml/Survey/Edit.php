<?php

namespace Wagento\Surveymonkey\Controller\Adminhtml\Survey;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;


class Edit extends Action {

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->set(__('Create Survey'));

        return $resultPage;
    }
}