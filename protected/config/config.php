<?php

return CMap::mergeArray(
	array(
		'defaultController' => 'main',
		'components' => array(
			'urlManager' => array(
				'urlFormat' => 'path',
				'showScriptName' => true,
				'rules' => array(
					'main'=> 'main',
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
		),
		'import' => array(
			'application.models.*',
			'application.models.base.*',
			'application.components.extended.web.*',
		),
	),
	require(dirname(__FILE__) . '/local.php')
);