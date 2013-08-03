<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Create new event',
    'type'=>'success',
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'event-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'start_date',
		'end_date',
		'instance_id',
		'completed_in',
		'notes',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
