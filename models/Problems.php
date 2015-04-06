<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%problems}}".
 *
 * @property integer $id
 * @property string $problem
 *
 * @property Ticket[] $tickets
 */
class Problems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%problems}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['problem'], 'required'],
            [['problem'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'problem' => Yii::t('app', 'Problem'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['type_id' => 'id']);
    }
}
