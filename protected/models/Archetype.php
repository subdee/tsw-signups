<?php
/**
 * User: subdee
 * Date: 8/1/13
 * Time: 7:16 AM
 */

class Archetype {
    const ARCHETYPE_TANK = 1;
    const ARCHETYPE_HEALER = 2;
    const ARCHETYPE_DPS = 4;
    const ARCHETYPE_SUPPORT = 8;

    public static function getArray() {
        return array(
            self::ARCHETYPE_TANK => Yii::t('default', 'Tank'),
            self::ARCHETYPE_HEALER => Yii::t('default', 'Healer'),
            self::ARCHETYPE_DPS => Yii::t('default', 'DPS'),
            self::ARCHETYPE_SUPPORT => Yii::t('default', 'Support'),
        );
    }

    public static function toText($archetype) {
        switch ($archetype) {
            case self::ARCHETYPE_TANK:
                return Yii::t('default', 'Tank');
            case self::ARCHETYPE_HEALER:
                return Yii::t('default', 'Healer');
            case self::ARCHETYPE_DPS:
                return Yii::t('default', 'DPS');
            case self::ARCHETYPE_SUPPORT:
                return Yii::t('default', 'Support');
            default:
                return false;
                break;
        }
    }
}