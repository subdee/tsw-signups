<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'instance-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->fileFieldRow($model,'image',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'min_weapon_ql',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'min_talisman_ql',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'min_glyph_ql',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'notes',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
