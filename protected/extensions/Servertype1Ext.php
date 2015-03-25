<?php

class Servertype1Ext extends CComponent
{
	private $_connections;

	public function init()
	{
	}

	public function check($params, $account)
	{
		if (!isset($this->_connections[md5($params)])) {
			$this->connection($params);
		}

		return $this->check_status($params, $account);
	}

	private function connection($params)
	{
		//do anything
		$this->_connections[md5($params)] = 'opened';
	}

	private function check_status($params, $account)
	{
		$params = json_decode($params);
		$returns = array(
			'127.0.0.1' => array(
				'100' => 'good',
				'101' => 'bad',
				'102' => 'bad',
				'103' => 'good',
				'104' => 'bad',
			),
			'192.168.0.1' => array(
				'105' => 'good',
				'105' => 'good',
				'106' => 'bad',
			),
		);
    
		return (isset($returns[$params->host]) && isset($returns[$params->host][$account])) ? $returns[$params->host][$account] : 'error';
	}
}