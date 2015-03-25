<?php

return CMap::mergeArray(
	array(
		'defaultController' => 'main',
		'components' => array(
			'urlManager' => array(
				'urlFormat' => 'path',
				'showScriptName' => false,
				'rules' => array(
					'gii' => 'gii',
					'gii/<controller:\w+>' => 'gii/<controller>',
					'gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',
				),
			),
			'Servertype1Ext' => array(
				'class' => 'ext.Servertype1Ext',
			),
			'Servertype2Ext' => array(
				'class' => 'ext.Servertype2Ext',
			),      
			'CustomDataProvider' => array(
				'class' => 'ext.CustomDataProvider',
			),
		),
		'import' => array(
			'application.models.*',
			'application.models.base.*',
      'application.components.*',
			'application.components.extended.web.*',
			'application.providers.*',
      'application.extensions.*',
		),
    'params' => array(
      'defaultPageSize'=>5,
    ),
	),
	require(dirname(__FILE__) . '/local.php')
);