<?php
/**
 * Copyright Wagento Creative LLC ©, All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Wagento\Surveymonkey\Controller\Adminhtml\Survey;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action {

    public function execute()
    {
        // TODO: Implement execute() method.

        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $result->getConfig()->getTitle()->set(__('Surveys'));
        return $result;
    }

}
