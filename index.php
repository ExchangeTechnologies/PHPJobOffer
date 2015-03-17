<?php
//директория ядра фреймворка
$frameworkFile = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'YiiBase.php';

//проверяем существование локального конфига
$localConfigFile = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'protected' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'local.php';
(file_exists($localConfigFile) && is_readable($localConfigFile)) or die('Local config file not exist');

//основной конфиг
$mainConfigFile = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'protected' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';


//определяем необходимо ли включать режим дебага или нет. Включить можно перегрузив в local.php директиву params[debugMode]
if (($localConfigFileInclude = require($localConfigFile)) && isset($localConfigFileInclude['params']['debugMode'])) {
	//подключение режима DEBUG для ловли ошибок и исключений
	defined('YII_DEBUG') or define('YII_DEBUG', true);

	//константа уровня трассировки
	defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', isset($localConfigFileInclude['params']['debugTraceLevel']) ? $localConfigFileInclude['params']['debugTraceLevel'] : 3);
}

//подключаем ядро фреймворка
require_once($frameworkFile);

//небольшой хак для автокомплита в шторме
class Yii extends YiiBase
{
	*
	 * @static
	 * @return MyCWebApplication
	 
	public static function app()
	{
		return parent::app();
	}
}

//создаем веб-приложение и запускаем его
Yii::createWebApplication($mainConfigFile)->run();