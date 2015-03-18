<?php

class Servers extends MainServers
{
	public $serverExt;
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 *
	 * @param string $className active record class name.
	 *
	 * @return MainServers the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

    protected function instantiate($attributes)
    {
        $class = get_class($this);
        $model = new $class(null);

        $extName = 'Server' . $attributes['server_type'] . 'Ext';
        $model->serverExt = Yii::app()->$extName;

        return $model;
    }
    public function check($account)
    {
        return $this->serverExt->check($this->settings, $account);
    }

}