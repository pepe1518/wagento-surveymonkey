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
        \Wagento\Surveymonkey\Helper\Users $users
    )
    {
        parent::__construct($context);
        $this->helper = $helper;
        $this->api = $api;
        $this->connector = $connector;
        $this->users = $users;
    }

    /**
     *
     */
    public function execute()
    {
        // TODO: Implement execute() method.
        $user = $this->users->getGroups();
        \Zend_Debug::dump($user);

        $endpoint = '/v3/users/me';
        echo 'entro para hacer la conexxion de prueba';
        echo '</br>';
        $response = $this->api->get($endpoint);
        $data = json_decode($response, true);
        \Zend_Debug::dump($data);

//        echo  $this->connector->oauthDialog('https://api.surveymonkey.com/api_console/oauth2callback', 'dBbtd7ofSnaLJ9nbp45Kpw');
        echo  $this->connector->oauthDialog('https://www.surveymonkey.com', 'dBbtd7ofSnaLJ9nbp45Kpw');
        $code = 'code';
        $clientId = 'dBbtd7ofSnaLJ9nbp45Kpw';
        $clientSecret = '125699914029469241349669471812850604842';
        $redirectUri = 'https://www.surveymonkey.com';
        $endpoint = '/oauth/token';


        echo '</br>';
        echo $this->connector->getToken($code, $clientId, $clientSecret, $redirectUri, $endpoint);
        echo '</br>';
        die('enter to my controller');
    }
}
