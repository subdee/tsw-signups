<?php

/**
 * This is the model class for table "loot".
 *
 * The followings are the available columns in table 'loot':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property integer $ql
 *
 * @property Event[] $events
 */
class Loot extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Loot the static model class
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
		return 'loot';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('name', 'required'),
			array('ql', 'numerical', 'integerOnly'=>true),
			array('name, image', 'length', 'max'=>255),
			array('description', 'safe'),
			array('id, name, description, image, ql', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
            'events' => array(self::MANY_MANY, 'Event', 'event_loot(loot_id, event_id)'),
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
			'description' => 'Description',
			'image' => 'Image',
			'ql' => 'Ql',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('ql',$this->ql);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}