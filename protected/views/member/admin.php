<?php
/* @var $this MemberController */
/* @var $model Member */
$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Add new member',
    'type'=>'success',
    'url' => Yii::app()->createUrl('member/create'),
));

$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'member-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'name',
		array(
            'name' => 'role',
            'value' => 'Role::toText($data->role)',
        ),
		'real_name',
		'forum_name',
		array(
            'name' => 'avatar',
            'type' => 'image',
            'value' => 'Yii::app()->baseUrl . "/images/avatars/{$data->avatar}"'
        ),
        array(
            'type' => 'raw',
            'name' => 'main_archetype',
            'value' => 'CHtml::tag("span", array("class" => "label " . Archetype::cssClass($data->main_archetype)), Archetype::toText($data->main_archetype))'
        ),
        array(
            'type' => 'raw',
            'name' => 'secondary_archetype',
            'value' => 'CHtml::tag("span", array("class" => "label " . Archetype::cssClass($data->secondary_archetype)), Archetype::toText($data->secondary_archetype))'
        ),
        array(
            'type' => 'raw',
            'name' => 'third_archetype',
            'value' => 'CHtml::tag("span", array("class" => "label " . Archetype::cssClass($data->third_archetype)), Archetype::toText($data->third_archetype))'
        ),
		'avg_weapon_ql',
		'avg_talisman_ql',
		'avg_glyph_ql',
		'notes',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
