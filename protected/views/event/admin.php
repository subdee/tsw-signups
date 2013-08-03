<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Create new event',
    'type'=>'success',
)); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

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
