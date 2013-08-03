<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Create new instance',
    'type'=>'success',
    'url' => Yii::app()->createUrl('instance/create'),
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'instance-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'name',
		'image',
		'min_weapon_ql',
		'min_talisman_ql',
		'min_glyph_ql',
		'notes',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
