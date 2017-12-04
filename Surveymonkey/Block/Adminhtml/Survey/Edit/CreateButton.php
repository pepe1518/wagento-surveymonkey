<?php

namespace Wagento\Surveymonkey\Block\Adminhtml\Survey\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Wagento\Surveymonkey\Block\Adminhtml\Survey\Edit\GenericButton;

class CreateButton extends GenericButton implements ButtonProviderInterface {

    public function getButtonData()
    {
        return [
            'label' => __('Create Survey'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}