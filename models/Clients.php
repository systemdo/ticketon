<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property integer $id
 * @property string $name
 * @property integer $fiscal_number
 * @property string $begin_contract
 * @property string $end_contract
 *
 * @property Address[] $addresses
 * @property Contact[] $contacts
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'fiscal_number', 'begin_contract', 'end_contract'], 'required'],
            [['fiscal_number'],'string', 'max' => 18],
            [['begin_contract', 'end_contract'], 'safe'],
            [['name'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Razão Social'),
            'fiscal_number' => Yii::t('app', 'CNPJ'),
            'begin_contract' => Yii::t('app', 'Contrato Inicial '),
            'end_contract' => Yii::t('app', 'Contrato Final'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasOne(Address::className(), ['client' => 'id']);
    }

    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['client' => 'id'])->with();
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contact::className(), ['client' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactAdministration()
    {
        return $this->hasMany(Contact::className(), ['client' => 'id']);
    }

    public function getContactTechnician()
    {
        return $this->hasMany(Contact::className(), ['client' => 'id']);
    }

    public function getContactAdmin()
    {
        $admin = '';
        foreach ($this->contacts as $key => $contact) {
            if($contact->isContactAdmin()){
                $admin = $contact;
            }
        }
        return $admin;
    }
    public function getContactTec()
    {
        $tec = '';
        foreach ($this->contacts as $key => $contact) {
            if($contact->isContactTec()){
                $tec = $contact;
            }
        }
        return $tec;
    }
}
