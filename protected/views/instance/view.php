<?php
$this->menu=array(
	array('label'=>'List Instance','url'=>array('index')),
	array('label'=>'Create Instance','url'=>array('create')),
	array('label'=>'Update Instance','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Instance','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Instance','url'=>array('admin')),
);
?>

<h1>View Instance #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'image',
		'min_weapon_ql',
		'min_talisman_ql',
		'min_glyph_ql',
		'notes',
	),
)); ?>
