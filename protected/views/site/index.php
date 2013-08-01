<?php
/* @var $this SiteController */
?>

    <div class="row text-center">
        <h3><?php echo Yii::t('default', "Welcome to {cabal}'s event signup", array('{cabal}' => $cabal->name)); ?></h3>

        <h4><?php echo Yii::t('default', 'Select an event to signup'); ?></h4>
    </div>
    <div class="row index-events">
        <p class="hint">All times are based on GMT</p>
        <?php foreach ($events as $event) : ?>
            <div class="index-event span-4">
                <h4><?php echo $event->instance->name; ?></h4>
                <?php echo CHtml::image(Yii::app()->baseUrl . '/images/instances/' . $event->instance->image); ?>
                <p>Starts at <span class="event-start-date"><?php echo $event->start_date; ?></span></p>
                <?php if ($event->end_date) : ?>
                    <p>Ends at <span class="event-end-date"><?php echo $event->end_date; ?></span></p>
                <?php endif; ?>
                <hr>
                <p><strong>Classes needed</strong></p>
                <?php foreach ($event->archetypes as $arch => $count) : ?>
                    <?php $mcount = $count - $event->getMembersSignedByArchetype($arch); ?>
                    <p>
                        <?php echo Archetype::toText($arch); ?>
                        <?php echo $mcount ? CHtml::tag('span', array('class' => 'event-no-signed'), $mcount) :
                            CHtml::tag('span', array('class' => 'event-signed'), $mcount); ?></span>
                    </p>
                <?php endforeach; ?>
                <hr>
                <div class="text-center">
                    <?php if (Yii::app()->user->member->hasSignedUp($event->id)) : ?>
                        <p>You are signed up for this event!</p>
                        <?php $this->widget('bootstrap.widgets.TbButton', array(
                            'label' => 'Unsign',
                            'type' => 'primary',
                            'url' => Yii::app()->createUrl('site/unsign', array('id' => $event->id)),
                        )); ?>
                    <?php else : ?>
                        <?php $this->widget('bootstrap.widgets.TbButton', array(
                            'label' => 'Sign up',
                            'type' => 'primary',
                            'buttonType' => 'ajaxButton',
                            'size' => 'large',
                            'url' => Yii::app()->createUrl('site/signup', array('id' => $event->id)),
                            'ajaxOptions' => array(
                                'success' => 'function(data) {
                            if (data.success) {
                                $("#signup-modal .modal-body p").html(data.body);
                                $("#signup-modal .modal-header h4").html(data.header);
                                $("#signup-modal").modal({"show": true});
                            }
                        }'
                            ),
                        )); ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'signup-modal')); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4></h4>
    </div>

    <div class="modal-body">
        <p></p>
    </div>

<?php $this->endWidget(); ?>