<?php
/**
 * @var Accounts $model
 * @var Accounts $data
 */

echo CHtml::dropDownList(
		                'pageSize',
		                $pageSize,
		                array(3=>3,5=>5,10=>10),
		                array('class'=>'change-pagesize')
	            	) 
	. ' rows per page';

$this->widget(
	'zii.widgets.grid.CGridView',
	array(
		'id' => 'account',
		'dataProvider' => $model->search($pageSize),
		'filter' => $model,
		'enableSorting' => true,
		'columns' => array(
			array(
				'name' => 'server_account',
			),
			array(
				'name' => 'group_id',
				'value' => '$data->group->name',
				'header' => 'Group name',
				'filter' => CHtml::listData(Groups::model()->findAll(), 'id', 'name'),
			),
			array(
				'name' => 'server_name',
				'header' => 'Server name (Server type)',
				'value' => function ($data) {
						return $data->group->server->name . ' (' . $data->group->server->server_type . ')';
					},
			),
			array(
				'header' => 'Validation',
				'value' => function ($data) {
						$serverExt = 'Server' . $data->group->server->server_type . 'Ext';

						return Yii::app()->$serverExt->check($data->group->server->settings, $data->server_account);
					},
			),
			
		),
	)
);

Yii::app()->clientScript->registerScript('initPageSize',<<<EOD
    $('.change-pagesize').on('change', function() {
        $.fn.yiiGridView.update('account',{ data:{ pageSize: $(this).val() }})
    });
EOD
,CClientScript::POS_READY); ?>