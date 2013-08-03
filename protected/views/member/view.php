<p>
    <h1><?php echo $model->name; ?></h1>
    <p>
        <?php echo CHtml::image(Yii::app()->baseUrl . "/images/avatars/{$model->avatar}"); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label' => 'Edit',
            'type' => 'success',
            'type' => 'info',
            'size' => 'small',
            'url' => Yii::app()->createUrl('member/update', array('id' => $model->id)),
            'htmlOptions' => array('style' => 'float: right;')
        )); ?>
    </p>
</p>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'type' => 'condensed',
    'attributes' => array(
        array(
            'name' => 'role',
            'value' => Role::toText($model->role),
        ),
        'real_name',
        'forum_name',
        array(
            'type' => 'raw',
            'name' => 'main_archetype',
            'value' => CHtml::tag("span", array("class" => "label " . Archetype::cssClass($model->main_archetype)), Archetype::toText($model->main_archetype))
        ),
        array(
            'type' => 'raw',
            'name' => 'secondary_archetype',
            'value' => CHtml::tag("span", array("class" => "label " . Archetype::cssClass($model->secondary_archetype)), Archetype::toText($model->secondary_archetype))
        ),
        array(
            'type' => 'raw',
            'name' => 'third_archetype',
            'value' => CHtml::tag("span", array("class" => "label " . Archetype::cssClass($model->third_archetype)), Archetype::toText($model->third_archetype))
        ),
        'avg_weapon_ql',
        'avg_talisman_ql',
        'avg_glyph_ql',
        array(
            'type' => 'url',
            'name' => 'chronicle_url',
        ),
        'notes',
    ),
)); ?>
