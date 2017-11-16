<?php

namespace Wagento\Surveymonkey\Helper\Api;

class Connector extends \Wagento\Surveymonkey\Helper\Api\Api {

    /**
     * suver monkeys constants
     */
    const OAUTH_NEW = "https://api.surveymonkey.net/oauth/authorize";
    const GET_TOKEN = "url token new";
    const HANLER = "url handler new";

    /**
     * @param $redirectUri
     * @param $clientId
     * @return string
     */
    public function oauthDialog($redirectUri , $clientId) {
        $params = [
            "redirect_uri" =>  $redirectUri,
            "client_id" => $clientId,
            "response_type" => "code"
        ];

        $url = self::OAUTH_NEW . "?";
        $url .= http_build_query(array_filter($params));

        return $url;
    }

    public function getToken($code, $clientId, $clientSecret, $redirectUri, $endpoint) {
        $params = [
            "client_secret"=> $clientSecret,
		    "code" => $code,
    		"redirect_uri" => $redirectUri,
	    	"client_id" => $clientId,
		    "grant_type" => "authorization_code"
        ];

        $response = $this->oauthPost($endpoint, $params);

        return $response;
    }

}