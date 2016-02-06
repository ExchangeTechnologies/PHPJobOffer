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

					// https://github.com/yiisoft/yii/issues/3216#issuecomment-34585743
					'<controller:\w+>/<action:\w+>' => '<controller>/<action>'
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