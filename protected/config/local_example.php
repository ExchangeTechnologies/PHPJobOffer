<?

return array(
	'modules' => array(/*'gii' => array(
			'class' => 'system.gii.GiiModule',
			'password' => '123456',
			'ipFilters' => array(),
		),*/
	),
	'components' => array(
		'db' => array(
			'connectionString' => 'mysql:host=database_host;dbname=database_name',
			'username' => 'database_user',
			'password' => 'database_pass',
			'enableProfiling' => false,
		),
	),
	'params' => array(
		'debugMode' => false,
		'debugTraceLevel' => 3,
		'defaultPageSize'=>5,
	),
);