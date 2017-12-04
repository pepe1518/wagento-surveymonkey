<?php

namespace Wagento\Surveymonkey\Block\Adminhtml\Survey\Edit;

use Magento\Backend\Block\Widget\Context;

class GenericButton {
    /**
     * @var context
     */
    protected $context;

    /**
     * GenericButton constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = []) {

        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}