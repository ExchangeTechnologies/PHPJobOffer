<?php
/**
 * @var Accounts $model
 * @var Accounts $data
 */
$script = '$(".checkServerBtn").on("click", function(event){$.getJSON("index.php/main/check/", {id:$(event.target).attr("server_number")}, function(data){alert("Статут сервера: "+data.response.status)})})';
echo CHtml::label('Page Rows = ', 'pageSize');
echo CHtml::dropDownList(
    'pageSize',
    $pageSize,
    array(10=>10, 5=>5, 3=>3),
    array('onchange' => "$.fn.yiiGridView.update('main-accounts-grid',{ data:{size: $(this).val() }})")
);

$this->widget(
    'zii.widgets.grid.CGridView',
    array(
        'id'=>'main-accounts-grid',
        'dataProvider' => $dataProvider,
        'enableSorting' => true,
        'filter' => $filter,
        'afterAjaxUpdate'=> "function(){{$script}}",
        'columns' => array(
            array(
                'name' => 'account',
                'header' => 'Server account',
                'value' => function($data){
                        return $data['account'];
                    },
                'filter' => CHtml::activeTextField($filter, 'account'),
            ),
            array(
                'name' => 'group',
                'header' => 'Group',
                'value' => function ($data){
                        return $data['group'];
                    },
                'filter' => CHtml::activeDropDownList(
                        $filter,
                        'group_id',
                        Accounts::model()->groupsList,
                        array('empty' => 'All')
                    ),
            ),
            array(
                'name' => 'server',
                'header' => 'Server name (Server type)',
                'value' => function ($data) {
                        return $data['server'];
                    },
                'filter' => CHtml::activeDropDownList(
                        $filter,
                        'server_id',
                        Accounts::model()->serversList,
                        array('empty' => 'All')
                    ),
            ),
            array(
                'name' => 'validation',
                'header' => 'Validation',
                'value' => function ($data) {
                        return $data['validation'];
                    },
                'filter' => CHtml::activeDropDownList(
                        $filter,
                        'validation',
                        Accounts::model()->validationList,
                        array('empty' => 'All')
                    ),
            ),
            array(
                'type' => 'raw',
                'value' => function($data){
                        return CHtml::button('Проверить соединение', array('class'=>'checkServerBtn', 'server_number'=>$data['id']));
                    }
            ),
        ),
    )
);
echo CHtml::script($script);