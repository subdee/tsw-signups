<p>Event: <?php echo $event->instance->name; ?></p>
<p>Start time: <?php echo $event->start_date; ?></p>

<p>Members that have signed up</p>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'condensed',
    'dataProvider' => $model->search(),
    'template' => '{items}',
    'columns' => array(
        array (
            'name' => 'member.name',
            'htmlOptions' => array('style' => 'font-weight: bold;')
        ),
        array(
            'type' => 'raw',
            'name' => 'archetype',
            'value' => 'CHtml::tag("span", array("class" => "label " . Archetype::cssClass($data->archetype)), Archetype::toText($data->archetype))',
        ),
        'notes',
        array(
            'name' => 'date_signed',
            'value' => 'Yii::app()->dateFormatter->formatDateTime(strtotime($data->date_signed))'
        ),
    ),
)); ?>
