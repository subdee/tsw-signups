<?php
/* @var $this MemberController */
/* @var $model Member */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'role'); ?>
		<?php echo $form->textField($model,'role'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'real_name'); ?>
		<?php echo $form->textField($model,'real_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'forum_name'); ?>
		<?php echo $form->textField($model,'forum_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'avatar'); ?>
		<?php echo $form->textField($model,'avatar',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'main_archetype'); ?>
		<?php echo $form->textField($model,'main_archetype'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'secondary_archetype'); ?>
		<?php echo $form->textField($model,'secondary_archetype'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'third_archetype'); ?>
		<?php echo $form->textField($model,'third_archetype'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'avg_weapon_ql'); ?>
		<?php echo $form->textField($model,'avg_weapon_ql'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'avg_talisman_ql'); ?>
		<?php echo $form->textField($model,'avg_talisman_ql'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'avg_glyph_ql'); ?>
		<?php echo $form->textField($model,'avg_glyph_ql'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->