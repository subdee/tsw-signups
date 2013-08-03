<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/styles.css"/>
    <?php Yii::app()->bootstrap->register(); ?>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<?php
$memberID = isset(Yii::app()->user->member) ? Yii::app()->user->member->id : 0;
$items = CMap::mergeArray(array(
    array('label' => 'Events', 'url' => array('/event/admin'), 'visible' => !Yii::app()->user->isGuest && (Yii::app()->user->member->role == Role::ROLE_ADMIN)),
    array('label' => 'Instances', 'url' => array('/instance/admin'), 'visible' => !Yii::app()->user->isGuest && (Yii::app()->user->member->role == Role::ROLE_ADMIN)),
    array('label' => 'Members', 'url' => array('/member/admin'), 'visible' => !Yii::app()->user->isGuest && (Yii::app()->user->member->role == Role::ROLE_ADMIN)),
    array('label' => 'Profile', 'url' => array('/member/view/' . $memberID), 'visible' => !Yii::app()->user->isGuest),
    array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
    array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
//), $this->menu);
), array());
$this->widget('bootstrap.widgets.TbNavbar', array(
    'items' => array(
        array(
            'class' => 'bootstrap.widgets.TbMenu',
            'items' => $items
        ),
    ),
));
?>

<div class="container" id="page">
    <?php echo $content; ?>

    <div class="clear"></div>
    <div id="footer">
        Copyright &copy; <?php echo date('Y'); ?> by Subdee Studio<br/>
    </div>
</div>

</body>
</html>
