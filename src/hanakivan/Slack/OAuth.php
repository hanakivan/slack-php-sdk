<?php

/*
 * (c) Ivan Hanak <packagist@ivanhanak.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace hanakivan\Slack;

/**
 * Class OAuth
 * @package hanakivan\Slack
 * Slack's OAuth2 is used - the older version is not supported and is also discouraged to be used by the Slack community
 */
class OAuth {
    const BASE_LOGIN_URL = "https://slack.com/oauth/v2/authorize";

    public $clientId;
    public $clientSecret;
    public $redirectUri;

    public function __construct(string $clientId, string $clientSecret, string $redirectUri)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUri = $redirectUri;
    }

    public function getLoginUrl(array $scope = null, array $userScope = null, string $state = null): string
    {
        $params = [
            "client_id" => $this->clientId,
            "redirect_uri" => $this->redirectUri,
        ];

        if(is_array($scope)) {
            $params["scope"] = implode(" ", $scope);
        }

        if(is_array($userScope)) {
            $params["user_scope"] = implode(" ", $userScope);
        }

        if($state !== null) {
            $params["state"] = $state;
        }

        return self::BASE_LOGIN_URL."?".http_build_query($params);
    }
}