<?php
declare(strict_types=1);

namespace App\Model;

class UserGroup {
    const UNREGISTER = 0;
    const REGISTER = 1;
    const SILVER = 2;
    const GOLD = 3;

    private $groupName = [
        self::UNREGISTER => 'UNREGISTER',
        self::REGISTER => 'REGISTER',
        self::SILVER => 'SILVER',
        self::GOLD => 'GOLD',
    ];

    /**
     * Get user group name by group Id
     *
     * @param int $groupId
     * @return string
     */
    public function getGroupNameById(int $groupId) : string
    {
        if ($this->groupName[$groupId]) {
            return $this->groupName[$groupId];
        }

        return '';
    }
}