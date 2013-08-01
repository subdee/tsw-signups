<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::encode($data->image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('min_weapon_ql')); ?>:</b>
	<?php echo CHtml::encode($data->min_weapon_ql); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('min_talisman_ql')); ?>:</b>
	<?php echo CHtml::encode($data->min_talisman_ql); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('min_glyph_ql')); ?>:</b>
	<?php echo CHtml::encode($data->min_glyph_ql); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('archetypes_needed')); ?>:</b>
	<?php echo CHtml::encode($data->archetypes_needed); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
	<?php echo CHtml::encode($data->notes); ?>
	<br />

	*/ ?>

</div>