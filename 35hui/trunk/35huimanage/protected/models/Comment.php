<?php

/**
 * This is the model class for table "{{comment}}".
 *
 * The followings are the available columns in table '{{comment}}':
 * @property integer $c_id
 * @property integer $n_id
 * @property integer $user_id
 * @property string $c_comment
 * @property integer $c_date
 */
class Comment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Comment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{comment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('n_id, user_id, c_date', 'required'),
			array('n_id, user_id, c_date', 'numerical', 'integerOnly'=>true),
			array('c_comment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('c_id, n_id, user_id, c_comment, c_date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'c_id' => '自增ID',
			'n_id' => '新闻ID',
			'user_id' => '评论用户ID',
			'c_comment' => '评论内容',
			'c_date' => '发表时间',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('c_id',$this->c_id);

		$criteria->compare('n_id',$this->n_id);

		$criteria->compare('user_id',$this->user_id);

		$criteria->compare('c_comment',$this->c_comment,true);

		$criteria->compare('c_date',$this->c_date);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}