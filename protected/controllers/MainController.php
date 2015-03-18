<?php

class MainController extends CController
{

    public function actionIndex()
    {
        $size = Yii::app()->request->getParam('size', 10);

        $rows = Accounts::model()->with('group.server')->findAll();
        $list = array();
        foreach($rows as $data){
            $list[] = array(
                'id' => $data->id,
                'account' => $data->server_account,
                'group_id' => $data->group_id,
                'group' => $data->group->name,
                'server_id' => $data->group->server_id,
                'server' => $data->group->server->name . ' (' . $data->group->server->server_type . ')',
                'validation' => $data->validation
            );
        }
        $filter = new FiltersGrid;
        if (isset($_GET['FiltersGrid'])) {
            $filter->filters = $_GET['FiltersGrid'];
        }
        $list = $filter->filter($list);

        $dataProvider = new CArrayDataProvider($list, array(
            'sort' => array(
                'attributes' => array(
                    'account',
                    'group',
                    'server',
                    'validation'
                ),
            ),
            'pagination' => array('pageSize' => $size),
        ));

        $this->render('/main', array(
            'dataProvider' => $dataProvider,
            'filter' => $filter,
            'pageSize' => $size
        ));
    }

    public function actionCheck($id=null)
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        if(!$id){
            echo CJSON::encode(array('error'=>'error'));
            Yii::app()->end();
        }
        $model = Accounts::model()->with('group.server')->findByPk($id);
        $status = $model->group->server->check($model->server_account);
        echo CJSON::encode(array('response'=>array('server'=>$id, 'status'=>$status)));
    }

}