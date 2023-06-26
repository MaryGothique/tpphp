<?php

class head
{
    protected $isPublicPage=false;
    public $model = 'DashboardModel';
    public function actionIndex()
    {

        $model = New $this->model;
        $msg = $model->getWelcomeMsg();
        $temp = $model->getTemp();
        $this->view->render('dashboard/index', [
            'pageHeadTitle' => 'Dashboard',
            'pageTitle' => 'Dashboard',
            'msg' => $msg,
            'temp' => $temp

        ]);
    }

}