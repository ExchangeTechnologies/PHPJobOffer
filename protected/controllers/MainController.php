<?php

class MainController extends CController
{
	public function actionIndex()
	{
    $model = new Accounts('search');
    $model->unsetAttributes();
    if (isset($_GET['Accounts'])) {
      $model->attributes = $_GET['Accounts'];
    } 
    
    if(isset($_GET['page_size'])) {
			Yii::app()->user->setState('page_size', (int)$_GET['page_size'] );
			unset($_GET['page_size']);
		}

		$this->render('/main', array('model' => $model));
	}
  
  /*
  public function actionCheck()
	{
    // $.ajax({type:'GET', 'url':'http://localhost/job/main/check', data: {'server_account':103}, success: function(data) {alert(data);}})
    
    $server_account = $_GET['server_account'];
    $condition = "t.server_account=:server_account";
    $params = array(':server_account' => $server_account);
    echo Accounts::model()->with('group.server')->find($condition, $params)->group->server->check($server_account);
	}*/
}