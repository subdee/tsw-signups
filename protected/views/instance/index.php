<?php

$this->menu=array(
	array('label'=>'Create Instance','url'=>array('create')),
	array('label'=>'Manage Instance','url'=>array('admin')),
);
?>

<h1>Instances</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
