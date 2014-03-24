<?php
/**
 * User: subdee
 * Date: 8/1/13
 * Time: 7:16 AM
 */

class Role {
    const ROLE_MEMBER = 1;
    const ROLE_ADMIN = 9;

    public static function toText($role) {
        switch ($role) {
            case self::ROLE_ADMIN:
                return 'Admin';
            case self::ROLE_MEMBER:
                return 'User';
            default:
                return false;
        }
    }

    public static function getArray() {
        return array(
            self::ROLE_MEMBER => self::toText(self::ROLE_MEMBER),
            self::ROLE_ADMIN => self::toText(self::ROLE_ADMIN),
        );
    }
}