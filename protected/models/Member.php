<?php

/**
 * This is the model class for table "member".
 *
 * The followings are the available columns in table 'member':
 * @property integer $id
 * @property string $name
 * @property integer $role
 * @property string $real_name
 * @property string $forum_name
 * @property string $avatar
 * @property integer $main_archetype
 * @property integer $secondary_archetype
 * @property integer $third_archetype
 * @property integer $avg_weapon_ql
 * @property integer $avg_talisman_ql
 * @property integer $avg_glyph_ql
 * @property string $notes
 *
 * @property Event[] $events
 */
class Member extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Member the static model class
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
		return 'member';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('name, role, avatar, main_archetype, avg_weapon_ql, avg_talisman_ql, avg_glyph_ql', 'required'),
			array('role, main_archetype, secondary_archetype, third_archetype, avg_weapon_ql, avg_talisman_ql, avg_glyph_ql', 'numerical', 'integerOnly'=>true),
			array('name, real_name, forum_name, avatar', 'length', 'max'=>255),
			array('notes', 'safe'),
			array('id, name, role, real_name, forum_name, avatar, main_archetype, secondary_archetype, third_archetype, avg_weapon_ql, avg_talisman_ql, avg_glyph_ql, notes', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
            'events' => array(self::MANY_MANY, 'Event', 'event_member(member_id, event_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'role' => 'Role',
			'real_name' => 'Real Name',
			'forum_name' => 'Forum Name',
			'avatar' => 'Avatar',
			'main_archetype' => 'Main Archetype',
			'secondary_archetype' => 'Secondary Archetype',
			'third_archetype' => 'Third Archetype',
			'avg_weapon_ql' => 'Avg Weapon Ql',
			'avg_talisman_ql' => 'Avg Talisman Ql',
			'avg_glyph_ql' => 'Avg Glyph Ql',
			'notes' => 'Notes',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('role',$this->role);
		$criteria->compare('real_name',$this->real_name,true);
		$criteria->compare('forum_name',$this->forum_name,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('main_archetype',$this->main_archetype);
		$criteria->compare('secondary_archetype',$this->secondary_archetype);
		$criteria->compare('third_archetype',$this->third_archetype);
		$criteria->compare('avg_weapon_ql',$this->avg_weapon_ql);
		$criteria->compare('avg_talisman_ql',$this->avg_talisman_ql);
		$criteria->compare('avg_glyph_ql',$this->avg_glyph_ql);
		$criteria->compare('notes',$this->notes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function hasSignedUp($eventID) {
        return EventMember::model()->exists(
            'event_id = :event AND member_id = :member',
            array(':event' => $eventID, ':member' => $this->id)
        );
    }
}