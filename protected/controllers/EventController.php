<?php

class EventController extends Controller {
    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'expression' => '!Yii::app()->user->isGuest && Yii::app()->user->member->role == Role::ROLE_ADMIN',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $event = $this->loadModel($id);
        $member = new EventMember('search');
        $member->event_id = $id;

        $this->render('view', array(
            'event' => $event,
            'model' => $member,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/bootstrap-datetimepicker.min.js');
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/datetimepicker.css');

        $model = new Event;

        if (isset($_POST['Event'])) {
            if (isset($_POST['repeat'])) {
                for ($i = 0; $i < $_POST['number']; ++$i) {
                    $model->attributes = $_POST['Event'];
                    $startDate = new DateTime($model->start_date);
                    $startDate->add(new DateInterval("P{$i}{$_POST['period']}"));
                    $endDate = new DateTime($model->end_date);
                    $endDate->add(new DateInterval("P{$i}{$_POST['period']}"));
                    $model->start_date = $startDate->format('Y-m-d H:i:s');
                    $model->end_date = $endDate->format('Y-m-d H:i:s');
                    $archetypes = array();
                    foreach ($_POST['Arch'] as $arch)
                        $archetypes[$arch['key']] = $arch['count'];
                    $model->archetypes = $archetypes;
                    if ($model->save()) {
                        if (isset($_POST['event_members'])) {
                            foreach ($_POST['event_members'] as $memberID) {
                                $member = Member::model()->findByPk($memberID);
                                $m = new EventMember();
                                $m->event_id = $model->id;
                                $m->member_id = $memberID;
                                $m->archetype = $member->main_archetype;
                                $m->date_signed = date('Y-m-d H:i:s');
                                $m->save();
                            }
                        }
                        $model = new Event;
                    }
                }
                $this->redirect(array('admin'));
            } else {
                $model->attributes = $_POST['Event'];
                $archetypes = array();
                foreach ($_POST['Arch'] as $arch)
                    $archetypes[$arch['key']] = $arch['count'];
                $model->archetypes = $archetypes;
                if ($model->save()) {
                    if (isset($_POST['event_members'])) {
                        foreach ($_POST['event_members'] as $memberID) {
                            $member = Member::model()->findByPk($memberID);
                            $m = new EventMember();
                            $m->event_id = $model->id;
                            $m->member_id = $memberID;
                            $m->archetype = $member->main_archetype;
                            $m->date_signed = date('Y-m-d H:i:s');
                            $m->save();
                        }
                    }
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
            'archetypes' => Archetype::getArray(),
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/bootstrap-datetimepicker.min.js');
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/datetimepicker.css');

        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Event'])) {
            $model->attributes = $_POST['Event'];
            $archetypes = array();
            foreach ($_POST['Arch'] as $arch)
                $archetypes[$arch['key']] = $arch['count'];
            $model->archetypes = $archetypes;
            if ($model->save()) {
                if (isset($_POST['event_members'])) {
                    $model->removeAllMembers();
                    foreach ($_POST['event_members'] as $memberID) {
                        $member = Member::model()->findByPk($memberID);
                        $m = new EventMember();
                        $m->event_id = $model->id;
                        $m->member_id = $memberID;
                        $m->archetype = $member->main_archetype;
                        $m->date_signed = date('Y-m-d H:i:s');
                        $m->save();
                    }
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'archetypes' => Archetype::getArray(),
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Event');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Event('search');
        $model->unsetAttributes();
        if (isset($_GET['Event']))
            $model->attributes = $_GET['Event'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Event::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'event-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
