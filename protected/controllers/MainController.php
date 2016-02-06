<?php

class MainController extends CController
{
	public function actionIndex()
	{
		$model = new Accounts('search');
		
		if (isset($_REQUEST['Accounts'])) {
			$model->attributes = $_REQUEST['Accounts'];
		}
		$pageSize = (isset($_REQUEST['pageSize']))?$_REQUEST['pageSize']: 3;

		$this->render('/main', array('model' => $model,'pageSize' => $pageSize));
	}
}