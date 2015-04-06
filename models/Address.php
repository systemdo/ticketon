<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property string $street
 * @property integer $number
 * @property string $ciudad
 * @property string $complement
 * @property string $postcode
 * @property integer $country
 * @property integer $client
 *
 * @property Clients $clients
 * @property Country $countrys
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'country'], 'integer'],
            [['country', 'client'], 'required'],
            [['street'], 'string', 'max' => 70],
            [['ciudad', 'complement', 'postcode'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'street' => Yii::t('app', 'Street'),
            'number' => Yii::t('app', 'Number'),
            'ciudad' => Yii::t('app', 'City'),
            'complement' => Yii::t('app', 'Complement'),
            'postcode' => Yii::t('app', 'CEP'),
            'country' => Yii::t('app', 'País'),
            'client' => Yii::t('app', 'Client'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountrys()
    {
        return $this->hasOne(Country::className(), ['id' => 'country']);
    }
}
