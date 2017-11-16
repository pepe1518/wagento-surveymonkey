<?php

namespace Wagento\Surveymonkey\Helper;

use Wagento\Surveymonkey\Helper\Api\Api;

/**
 * Class Users
 * @package Wagento\Surveymonkey\Helper
 */
class Users extends Api {


    // SURVEY MONKEY user and teams endpoints

    /**
     *  GET Returns the current user’s account details including their plan
     */
    const USER_ME = "/v3/users/me";

    /**
     * GET: Returns a team if the user account belongs to a team (users can only belong to one team)
     */
    const LIST_GROUPS = "/v3/groups";

    /**
     * GET: Returns a teams’s details including the teams’s owner and email address
     */
    const GROUP_TEAM = "/v3/groups/%s";

    /**
     * GET: Returns a list of users who have been added as members of the specified group
     */
    const MEMBERS_GROUP = "/v3/groups/%s/members";

    /**
     * @return mixed
     */
    public function getUserMe() {
        $response = $this->get(self::USER_ME);
        $data = json_decode($response, true);

        return $data;
    }

    /**
     * @return mixed
     */
    public function getGroups() {
        $response = $this->get(self::LIST_GROUPS);
        $data = json_decode($response, true);

        return $data;
    }

    /**
     * @param $idTeam
     * @return mixed
     */
    public function getTeam($teamId) {
        $endpoint = sprintf(self::GROUP_TEAM, $teamId);
        $response = $this->get($endpoint);
        $data = json_decode($response, true);

        return $data;
    }

    /**
     * @param $groupId
     * @return mixed
     */
    public function getMembersGroup($groupId) {
        $endpoint = sprintf(self::MEMBERS_GROUP, $groupId);
        $response = $this->get($endpoint);
        $data = json_decode($response, true);

        return $data;
    }
}