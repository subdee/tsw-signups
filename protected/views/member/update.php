<?php
$this->menu=array(
	array('label'=>'List Member','url'=>array('index')),
	array('label'=>'Create Member','url'=>array('create')),
	array('label'=>'View Member','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Member','url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>