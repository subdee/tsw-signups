<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'member-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->dropDownListRow($model, 'role', Role::getArray(), array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'real_name', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'forum_name', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->fileFieldRow($model, 'avatar', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->dropDownListRow($model, 'main_archetype', Archetype::getArray(), array('class' => 'span5', 'prompt' => 'Select one')); ?>

<?php echo $form->dropDownListRow($model, 'secondary_archetype', Archetype::getArray(), array('class' => 'span5', 'prompt' => 'Select one')); ?>

<?php echo $form->dropDownListRow($model, 'third_archetype', Archetype::getArray(), array('class' => 'span5', 'prompt' => 'Select one')); ?>

<?php echo $form->textFieldRow($model, 'avg_weapon_ql', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'avg_talisman_ql', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'avg_glyph_ql', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'chronicle_url', array('class' => 'span5')); ?>

<?php echo $form->dropDownListRow($model, 'timezone_id', CHtml::listData(Timezone::model()->findAll(), 'id', 'timezone'), array('class' => 'span5', 'prompt' => 'Select one')); ?>

<?php echo $form->textAreaRow($model, 'notes', array('rows' => 6, 'cols' => 50, 'class' => 'span8')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    )); ?>
</div>

<?php $this->endWidget(); ?>
