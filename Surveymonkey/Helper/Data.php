<?php

namespace Wagento\Surveymonkey\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper {

    /**
     * MAGENTO CONFIG PATH CONSTANTS
     */
    const DOMAIN = 'wagento/surveymonkey/endpoint';
    const PATH_CLIENT_ID = 'wagento/surveymonkey/client_id';
    const PATH_SECRET = 'wagento/surveymonkey/secret';
    const PATH_TOKEN = 'wagento/surveymonkey/token';

    /**
     * @var \Magento\Framework\App\Config\Storage\WriterInterface
     */
    private $configWriter;

    /**
     * Data constructor.
     * @param Context $context
     * @param \Magento\Framework\App\Config\Storage\WriterInterface $configWriter
     */
    public function __construct(
        Context $context,
        \Magento\Framework\App\Config\Storage\WriterInterface $configWriter)
    {
        parent::__construct($context);
        $this->configWriter = $configWriter;
    }

    /**
     * @return string
     */
    public function getDomain() {
        return $this->scopeConfig->getValue(
            self::DOMAIN,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return string
     */
    public function getClient() {
        return $this->scopeConfig->getValue(
            self::PATH_CLIENT_ID,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return string
     */
    public function getSecret() {
        return $this->scopeConfig->getValue(
            self::PATH_SECRET,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return string
     */
    public function getToken() {
        return $this->scopeConfig->getValue(
            self::PATH_TOKEN,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}