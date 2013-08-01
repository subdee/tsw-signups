<?php

/**
 * This is the model class for table "instance".
 *
 * The followings are the available columns in table 'instance':
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property integer $min_weapon_ql
 * @property integer $min_talisman_ql
 * @property integer $min_glyph_ql
 * @property string $archetypes_needed
 * @property string $notes
 */
class Instance extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Instance the static model class
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
		return 'instance';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, image, min_weapon_ql, min_talisman_ql, min_glyph_ql', 'required'),
			array('min_weapon_ql, min_talisman_ql, min_glyph_ql', 'numerical', 'integerOnly'=>true),
			array('name, image', 'length', 'max'=>255),
			array('notes', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, image, min_weapon_ql, min_talisman_ql, min_glyph_ql, notes', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
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
			'image' => 'Image',
			'min_weapon_ql' => 'Min Weapon Ql',
			'min_talisman_ql' => 'Min Talisman Ql',
			'min_glyph_ql' => 'Min Glyph Ql',
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
		$criteria->compare('image',$this->image,true);
		$criteria->compare('min_weapon_ql',$this->min_weapon_ql);
		$criteria->compare('min_talisman_ql',$this->min_talisman_ql);
		$criteria->compare('min_glyph_ql',$this->min_glyph_ql);
		$criteria->compare('notes',$this->notes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}