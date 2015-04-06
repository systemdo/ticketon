<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property integer $id
 * @property integer $type_contact_id
 * @property string $email
 * @property string $phone
 * @property string $second_phone
 * @property integer $client
 *
 * @property TypeContact $typeContact
 * @property Clients $client0
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_contact_id', 'email', 'phone', 'client'], 'required'],
            [['type_contact_id', 'client'], 'integer'],
            [['email'], 'string', 'max' => 150],
            [['phone', 'second_phone'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type_contact_id' => Yii::t('app', 'Type Contact ID'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'second_phone' => Yii::t('app', 'Second Phone'),
            'client' => Yii::t('app', 'Client'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeContact()
    {
        return $this->hasOne(TypeContact::className(), ['id' => 'type_contact_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client']);
    }
    public function isContactAdmin()
    {
        return ($this->typeContact->id == 1);
    }
    public function isContactTec()
    {
        return ($this->typeContact->id == 2);
    }
}
