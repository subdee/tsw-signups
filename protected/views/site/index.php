<?php
/* @var $this SiteController */
?>

    <div class="row text-center">
        <h3><?php echo Yii::t('default', "Welcome to {cabal}'s event signup", array('{cabal}' => $cabal->name)); ?></h3>

        <h4><?php echo Yii::t('default', 'Select an event to signup'); ?></h4>
    </div>
    <div class="row index-events">
        <p class="hint">
            Event times are adjusted to your timezone. Edit your timezone in your
            <a href="<?php echo Yii::app()->createUrl('member/update/' . Yii::app()->user->member->id); ?>">profile</a>
        </p>
        <?php foreach ($events as $event) : ?>
            <?php if (!$event->is_private or ($event->is_private and $event->isUserInEvent())) : ?>
                <div class="index-event span-4">
                <h4><strong><?php echo $event->instance->name; ?></strong></h4>

                <p class="hint"><?php echo $event->notes; ?></p>
                <?php echo CHtml::image(Yii::app()->baseUrl . '/images/instances/' . $event->instance->image); ?>
                <p>Starts at <span class="event-start-date"><?php echo $event->start_date; ?></span></p>
                <?php if ($event->end_date) : ?>
                    <p>Ends at <span class="event-end-date"><?php echo $event->end_date; ?></span></p>
                <?php endif; ?>
                <hr>
                <?php if ($event->is_private) : ?>
                    <p><strong>Members joining</strong></p>
                    <?php foreach ($event->members as $member) : ?>
                        <p>
                            <?php echo CHtml::tag('span', array('class' => 'event-private-member-name'), $member->name); ?>
                            <?php echo CHtml::tag('span', array('style' => 'float: right;', 'class' => 'label ' . Archetype::cssClass($member->main_archetype)), Archetype::toText($member->main_archetype)); ?>
                        </p>
                    <?php endforeach; ?>
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'label' => 'Unsign',
                        'type' => 'danger',
                        'url' => Yii::app()->createUrl('site/unsign', array('id' => $event->id)),
                    )); ?>
                    <p class="hint">If you un-sign from this private event, only an officer can sign you up again.</p>
                <?php else : ?>
                    <p><strong>Classes needed</strong></p>
                    <?php foreach ($event->archetypes as $arch => $count) : ?>
                        <?php $mcount = $count - $event->getMembersSignedByArchetype($arch); ?>
                        <p>
                            <?php if ($mcount > 0) : ?>
                                <?php echo CHtml::tag('span', array('class' => 'label ' . Archetype::cssClass($arch)), Archetype::toText($arch)); ?>
                                <?php echo CHtml::tag('span', array('class' => 'event-signed'), $mcount); ?>
                            <?php else : ?>
                                <?php echo CHtml::tag('span', array('class' => 'label'), Archetype::toText($arch)); ?>
                                <?php echo CHtml::tag('span', array('class' => 'event-no-signed'), 0); ?>
                            <?php endif; ?>
                        </p>
                    <?php endforeach; ?>
                    <hr>
                    <div class="text-center">
                        <?php if (!$event->meetsRequirements()) : ?>
                            <small>You cannot sign up for this event<br>
                                because you don't meet the minimum<br>
                                QL requirements!
                            </small>
                        <?php elseif (Yii::app()->user->member->hasSignedUp($event->id)) : ?>
                            <p>You are signed up for this event!</p>
                            <?php $this->widget('bootstrap.widgets.TbButton', array(
                                'label' => 'Unsign',
                                'type' => 'danger',
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
                        <p class="hint"><?php echo CHtml::link('View ' . count($event->members) . ' signups for this event', Yii::app()->createUrl('event/view', array('id' => $event->id))); ?></p>
                    </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
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