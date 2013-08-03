<?php

/**
 * This is the model class for table "event_member".
 *
 * The followings are the available columns in table 'event_member':
 * @property integer $event_id
 * @property integer $member_id
 * @property integer $archetype
 * @property string $date_signed
 */
class EventMember extends CActiveRecord
{
    public $cnt;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EventMember the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'event_member';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, member_id, archetype, date_signed', 'required'),
			array('event_id, member_id, archetype', 'numerical', 'integerOnly'=>true),
            array('notes', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('event_id, member_id, archetype', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
            'event' => array(self::BELONGS_TO, 'Event', 'event_id'),
            'member' => array(self::BELONGS_TO, 'Member', 'member_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'event_id' => 'Event',
			'member_id' => 'Member',
			'archetype' => 'Archetype',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('archetype',$this->archetype);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}