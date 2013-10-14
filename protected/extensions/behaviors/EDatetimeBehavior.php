<?php
/**
 * User: subdee
 * Date: 8/1/13
 * Time: 8:22 AM
 */

class EDatetimeBehavior extends CActiveRecordBehavior {

    public $dateTimeYiiFormat = 'Y-m-d H:i:s';

    /*
    * The beforeSave event is raised before the record is saved to database.
    * Converts input dateformat into yiis dateformat (for example: 31.12.2013 to 2013-12-31) .
    */
    public function beforeSave($event) {

        foreach ($event->sender->tableSchema->columns as $columnName => $column) {

            if (($column->dbType != 'date') and ($column->dbType != 'datetime'))
                continue;

            if (!strlen($event->sender->$columnName)) {
                $event->sender->$columnName = null;
                continue;
            }

            $event->sender->$columnName = $this->parseDateTime($event->sender->$columnName);

            if (isset(Yii::app()->user->member->timezone))
                $date = new DateTime($event->sender->$columnName, new DateTimeZone(Yii::app()->user->member->timezone->timezone));
            else
                $date = new DatTime($event->sender->$columnName);
            $event->sender->$columnName = $date->setTimezone(new DateTimeZone('UTC'))->format('Y-m-d H:i:s');

        }
        return true;
    }

    /*
    * This event is raised after the record is instantiated (loaded from database)
    * Converts yiis database dateformat to input dateformat (for example: 2013-12-31 to 31.12.2013) .
    */
    public function afterFind($event) {

        foreach ($event->sender->tableSchema->columns as $columnName => $column) {

            if (($column->dbType != 'date') and ($column->dbType != 'datetime'))
                continue;

            if (!strlen($event->sender->$columnName)) {
                $event->sender->$columnName = null;
                continue;
            }

            $date = new DateTime($event->sender->$columnName, new DateTimeZone('UTC'));

            if (isset(Yii::app()->user->member->timezone))
                $event->sender->$columnName = $date->setTimezone(new DateTimeZone(Yii::app()->user->member->timezone->timezone))->format('Y-m-d H:i:s');
            else
                $event->sender->$columnName = $date->format('Y-m-d H:i:s');

            $event->sender->$columnName =
                Yii::app()->dateFormatter->format("EEEE, d MMMM HH:mm", strtotime($event->sender->$columnName));

        }
        return true;
    }

    private function parseDateTime($datetime) {
        if (date_create($datetime) instanceof DateTime)
            return $datetime;

        list($day, $datetime) = explode(',', $datetime);
        list($empty, $date, $month, $time) = explode(' ', $datetime);
        list($hour, $minute) = explode(':', $time);

        return $date . '-' . $month . '-' . date('Y') . ' ' . $hour . ':' . $minute . ':00';
    }

}