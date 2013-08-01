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

        // search for date/datetime columns. Convert it to dateformat used in database (Y-m-d)
        foreach ($event->sender->tableSchema->columns as $columnName => $column) {

            if (($column->dbType != 'date') and ($column->dbType != 'datetime'))
                continue;

            if (!strlen($event->sender->$columnName)) {
                $event->sender->$columnName = null;
                continue;
            }

            $event->sender->$columnName = date($this->dateTimeYiiFormat, strtotime($event->sender->$columnName));

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

            $event->sender->$columnName =
                Yii::app()->dateFormatter->formatDateTime(
                    strtotime($event->sender->$columnName), 'medium', ($column->dbType != 'date') ? 'medium' : '');

        }
        return true;
    }

}