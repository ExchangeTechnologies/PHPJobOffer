<?php

class Accounts extends MainAccounts
{

    public $server;
    public $validation;
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     *
     * @param string $className active record class name.
     *
     * @return MainAccounts the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    protected function afterFind()
    {
        $this->validation = $this->group->server->check($this->server_account);
    }

    /**
     * @return array full list of validation results for filters.
     */
    protected function getValidationList()
    {
        return array(
            'good' => 'good',
            'bad' => 'bad',
            'error' => 'error',
        );
    }

    /**
     * @return array full groups list for filters.
     */
    protected function getGroupsList()
    {
        $rows = Groups::model()->findAll();
        $list = array();
        foreach ($rows as $row)
            $list[$row->id] = $row->name;

        return $list;
    }

    /**
     * @return array full servers list for filters.
     */
    protected function getServersList()
    {
        $rows = Servers::model()->findAll();
        $list = array();
        foreach ($rows as $row)
            $list[$row->id] = $row->name. ' ('.$row->server_type.')';

        return $list;
    }
}