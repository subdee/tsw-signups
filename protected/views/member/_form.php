<?php
/* @var $this MemberController */
/* @var $model Member */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'member-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'role'); ?>
		<?php echo $form->textField($model,'role'); ?>
		<?php echo $form->error($model,'role'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'real_name'); ?>
		<?php echo $form->textField($model,'real_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'real_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'forum_name'); ?>
		<?php echo $form->textField($model,'forum_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'forum_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'avatar'); ?>
		<?php echo $form->textField($model,'avatar',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'avatar'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'main_archetype'); ?>
		<?php echo $form->textField($model,'main_archetype'); ?>
		<?php echo $form->error($model,'main_archetype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'secondary_archetype'); ?>
		<?php echo $form->textField($model,'secondary_archetype'); ?>
		<?php echo $form->error($model,'secondary_archetype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'third_archetype'); ?>
		<?php echo $form->textField($model,'third_archetype'); ?>
		<?php echo $form->error($model,'third_archetype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'avg_weapon_ql'); ?>
		<?php echo $form->textField($model,'avg_weapon_ql'); ?>
		<?php echo $form->error($model,'avg_weapon_ql'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'avg_talisman_ql'); ?>
		<?php echo $form->textField($model,'avg_talisman_ql'); ?>
		<?php echo $form->error($model,'avg_talisman_ql'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'avg_glyph_ql'); ?>
		<?php echo $form->textField($model,'avg_glyph_ql'); ?>
		<?php echo $form->error($model,'avg_glyph_ql'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->