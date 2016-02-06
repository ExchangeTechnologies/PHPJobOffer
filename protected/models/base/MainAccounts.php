<?php

/**
 * This is the model class for table "accounts".
 * The followings are the available columns in table 'accounts':
 * @property integer $id
 * @property integer $server_account
 * @property integer $group_id
 * The followings are the available model relations:
 * @property Groups $group
 */
class MainAccounts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'accounts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('server_account, group_id', 'required'),
			array('server_account, group_id', 'numerical', 'integerOnly' => true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, server_account, group_id,server_name', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'group' => array(self::BELONGS_TO, 'Groups', 'group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'server_account' => 'Server Account',
			'group_id' => 'Group',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search($pageSize)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.


		$criteria = new CDbCriteria;

		$criteria->with = 'group.server';
		$criteria->compare('id', $this->id);
		$criteria->compare('server_account', $this->server_account);
		$criteria->compare('group_id', $this->group_id);
		$criteria->compare('server.name',$this->server_name);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination' => ['pageSize' => $pageSize],
			'sort' => array(
				'attributes'=>array(
				    'group_id'=>'group.name',
					'server_name' => 'server.name'
				)
			)
		));
	}

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

	public $server_name;
}
