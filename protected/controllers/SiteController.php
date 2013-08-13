<?php

class SiteController extends Controller {

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('login'),
                'users' => array('*'),
            ),
            array('allow',
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $this->render('index', array(
            'cabal' => CabalInfo::model()->find(),
            'events' => Event::model()->available()->findAll(),
        ));
    }

    public function actionSignup($id) {
        $model = new EventMember();

        if (isset($_POST['EventMember'])) {
            $model->attributes = $_POST['EventMember'];
            $model->event_id = $id;
            $model->member_id = Yii::app()->user->member->id;
            $model->date_signed = date('Y-m-d H:i:s');

            if ($model->save())
                $this->redirect(Yii::app()->createUrl('site/index'));
        }

        $event = Event::model()->findByPk($id);
        $archetypes = array();
        if ($event) {
            $signed = $event->getArchetypeMembersSigned();
            if ($signed) {
                foreach ($event->archetypes as $arch => $count) {
                    if ((isset($signed[$arch]) && $count > 0 && $signed[$arch] < $count) || (!isset($signed[$arch]) && $count > 0))
                        $archetypes[$arch] = Archetype::toText($arch);
                }
                $archetypes[Archetype::ARCHETYPE_BACKUP] = Archetype::toText(Archetype::ARCHETYPE_BACKUP);
            } else if (count($event->members) == array_sum($event->archetypes)) {
                $archetypes = array(Archetype::ARCHETYPE_BACKUP => Archetype::toText(Archetype::ARCHETYPE_BACKUP));
            } else {
                $archetypes = Archetype::getArray();
            }
        }

        $data = array(
            'success' => true,
            'body' => $this->renderPartial('_signup_form', array('model' => $model, 'availableArchetypes' => $archetypes), true, true),
        );

        header('Content-type: application/json');
        echo json_encode($data);
    }

    public function actionUnsign($id) {
        $em = EventMember::model()->findByAttributes(array(
            'event_id' => $id,
            'member_id' => Yii::app()->user->member->id,
        ))->delete();

        $this->redirect(Yii::app()->createUrl('site/index'));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        if (!Yii::app()->user->isGuest)
            $this->redirect(Yii::app()->createUrl('site/index'));

        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}