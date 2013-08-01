<?php
/* @var $this MemberController */
/* @var $data Member */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('role')); ?>:</b>
	<?php echo CHtml::encode($data->role); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('real_name')); ?>:</b>
	<?php echo CHtml::encode($data->real_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forum_name')); ?>:</b>
	<?php echo CHtml::encode($data->forum_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avatar')); ?>:</b>
	<?php echo CHtml::encode($data->avatar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('main_archetype')); ?>:</b>
	<?php echo CHtml::encode($data->main_archetype); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('secondary_archetype')); ?>:</b>
	<?php echo CHtml::encode($data->secondary_archetype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('third_archetype')); ?>:</b>
	<?php echo CHtml::encode($data->third_archetype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avg_weapon_ql')); ?>:</b>
	<?php echo CHtml::encode($data->avg_weapon_ql); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avg_talisman_ql')); ?>:</b>
	<?php echo CHtml::encode($data->avg_talisman_ql); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avg_glyph_ql')); ?>:</b>
	<?php echo CHtml::encode($data->avg_glyph_ql); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
	<?php echo CHtml::encode($data->notes); ?>
	<br />

	*/ ?>

</div>