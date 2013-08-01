<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'signup-form',
    'enableAjaxValidation' => false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListRow($model, 'archetype', $availableArchetypes, array('class' => 'span5')); ?>

<hr>

<?php echo $form->textAreaRow($model, 'notes', array('rows' => 6, 'cols' => 50, 'class' => 'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => 'Signup',
    )); ?>
</div>

<?php $this->endWidget(); ?>