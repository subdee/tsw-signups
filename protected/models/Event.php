<?php

/**
 * This is the model class for table "event".
 *
 * The followings are the available columns in table 'event':
 * @property integer $id
 * @property string $start_date
 * @property string $end_date
 * @property integer $instance_id
 * @property string $completed_in
 * @property array $archetypes
 * @property string $notes
 *
 * The followings are the available model relations:
 * @property Instance $instance
 * @property Loot[] $loots
 * @property Member[] $members
 */
class Event extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Event the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'event';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('start_date, instance_id, archetypes', 'required'),
            array('instance_id', 'numerical', 'integerOnly' => true),
            array('end_date, completed_in, notes', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, start_date, end_date, instance_id, completed_in, notes', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'loots' => array(self::MANY_MANY, 'Loot', 'event_loot(event_id, loot_id)'),
            'members' => array(self::MANY_MANY, 'Member', 'event_member(event_id, member_id)'),
            'instance' => array(self::BELONGS_TO, 'Instance', 'instance_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'instance_id' => 'Instance',
            'completed_in' => 'Completed In',
            'notes' => 'Notes',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('start_date', $this->start_date, true);
        $criteria->compare('end_date', $this->end_date, true);
        $criteria->compare('instance_id', $this->instance_id);
        $criteria->compare('completed_in', $this->completed_in, true);
        $criteria->compare('notes', $this->notes, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function behaviors() {
        return array(
            'datetimebehavior' => array('class' => 'ext.behaviors.EDatetimeBehavior'),
        );
    }

    public function scopes() {
        return array(
            'available' => array(
                'condition' => 'start_date > DATE("NOW", "+15 MINUTE")',
                'limit' => 3,
                'order' => 'start_date ASC'
            )
        );
    }

    public function beforeSave() {
        $this->archetypes = json_encode($this->archetypes);
        return parent::beforeSave();
    }

    public function afterFind() {
        $this->archetypes = json_decode($this->archetypes, true);
        return parent::afterFind();
    }

    public function getMembersSignedByArchetype($archetype) {
        return EventMember::model()->countByAttributes(array(
            'event_id' => $this->id,
            'archetype' => $archetype,
        ));
    }

    public function getArchetypeMembersSigned() {
        $cr = new CDbCriteria();
        $cr->select = 'archetype, COUNT(event_id) AS cnt';
        $cr->condition = 'event_id = :event';
        $cr->params = array(':event' => $this->id);
        $cr->group = 'archetype';
        return CHtml::listData(EventMember::model()->findAll($cr), 'archetype', 'cnt');
    }

    public function getBackups() {
        return EventMember::model()->countByAttributes(array(
            'event_id' => $this->id,
            'archetype' => Archetype::ARCHETYPE_BACKUP,
        ));
    }
}