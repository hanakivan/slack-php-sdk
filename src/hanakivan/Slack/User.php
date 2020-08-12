<?php

/*
 * (c) Ivan Hanak <packagist@ivanhanak.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace hanakivan\Slack;

use App\Library\HttpRequest;

/**
 * Class OAuth
 * @package hanakivan\Slack
 */
class User {

    public function getUser($token, $userId, int $httpTimeout = null): ?array
    {
        $url = "https://slack.com/api/users.info?user={$userId}";

        //TODO:
        $request = HttpRequest::getRequest($url, [
            'Authorization: Bearer ' . $token
        ], $httpTimeout);

        $response = json_decode($request["body"], true);

        if(is_array($response) && isset($response["ok"]) && $response["ok"]) {
            return $response["user"];
        }

        return null;
    }
}