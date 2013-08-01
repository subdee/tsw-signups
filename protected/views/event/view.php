<p>Event: <?php echo $event->instance->name; ?></p>
<p>Start time: <?php echo $event->start_date; ?></p>

<p>Members that have signed up</p>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped condensed',
    'dataProvider' => $model->search(),
    'template' => '{items}',
    'columns' => array(
        'member.name',
        array(
            'name' => 'archetype',
            'value' => 'Archetype::toText($data->archetype)',
        ),
        'notes',
        array(
            'name' => 'date_signed',
            'value' => 'Yii::app()->dateFormatter->formatDateTime(strtotime($data->date_signed))'
        ),
    ),
)); ?>
