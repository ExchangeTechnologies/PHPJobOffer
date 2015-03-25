<?php
/**
 * @var Accounts $model
 * @var Accounts $data
 */
$this->widget(
	'zii.widgets.grid.CGridView',
	array(
    'id' => 'test-grid',
    'ajaxUrl' => 'main/index',
		'dataProvider' => $model->search(),
    'filter'=>$model, 
		'columns' => array(
      array(
        'name'=>'server_account',
        'sortable'=>true,
      ),
			array(
				'name' => 'group_name',
        'value' => '$data->group->name',
				'header' => 'Group name',
        'sortable'=>true,
			),
			array(
        'name' => 'server_name',
				'header' => 'Server name (Server type)',
        'sortable'=>true,
				'value' => function ($data) {
						return $data->group->server->name . ' (' . $data->group->server->server_type . ')';
					},
			),
			array(
        'name' => 'validation_search',
				'header' => 'Validation',
        'sortable'=>true,
				'value' => function ($data) {
            return $data->group->server->check($data->server_account);

					},
			),
		),
	)
);
          
$pageSize = Yii::app()->user->getState( 'page_size', Yii::app()->params['defaultPageSize'] );
$pageSizeDropDown = CHtml::dropDownList(
  'page_size',
  $pageSize,
  array(3 => 3, 5 => 5, 10 => 10),
  array(
    'class'    => 'change-pagesize',
    'onchange' => "$.fn.yiiGridView.update('test-grid',{url: $('.keys').attr('title'), data:'&page_size=' + $(this).val() });",
  )
);
//
?>
<div style="text-align: right;">
	<span>Display by:</span><?= $pageSizeDropDown; ?>
</div>
