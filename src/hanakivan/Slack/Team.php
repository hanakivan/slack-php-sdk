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
 */
class Team {

    public static function getTeam(string $token): ?array
    {
        $url = "https://slack.com/api/team.info";

        //TODO:
        $request = HttpRequest::getRequest($url, [
            'Authorization: Bearer ' . $token
        ]);

        $response = json_decode($request["body"], true);

        if(is_array($response) && isset($response["ok"]) && $response["ok"] && isset($response["team"])) {
            if(isset($response["team"]["id"]) && isset($response["team"]["name"]) && isset($response["team"]["domain"])) {
                $data = [
                    "id" => $response["team"]["id"],
                    "name" => $response["team"]["name"],
                    "domain" => $response["team"]["domain"],
                    "logo_src" => null,
                ];

                if(isset($response["team"]["icon"]) && isset($response["team"]["icon"]["image_original"])) {
                    $data["logo_src"] = $response["team"]["icon"]["image_original"];
                }

                return [
                    "slack_id" => $data["id"],
                    "name" => $data["name"],
                    "domain" => $data["domain"],
                    "logo_url" => $data["logo_src"],
                ];
            }
        }

        return null;
    }
}