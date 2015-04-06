<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ticket".
 *
 * @property integer $id
 * @property string $date
 * @property integer $status_id
 * @property integer $user_id
 * @property string $description
 * @property integer $type_id
 * @property string $duration_time
 * @property integer $client
 *
 * @property Files[] $files
 * @property Interation[] $interation
 * @property Status $status
 * @property User $keepers
 * @property Problems $type
 * @property User $user
 * @property Clients $clients
 */
class Ticket extends \yii\db\ActiveRecord
{
    public $files_upload; 

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            // [['keeper', 'type_id'], 'required'],
            // [['status_id', 'user_id', 'type_id'], 'integer'],
            [['files'], 'file', 'extensions' => ['pdf', 'jpg']],

            [['description'], 'string'],
            [['duration_time'], 'string', 'max' => 50],
            // [['user_id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'number' => Yii::t('app', 'Number'),
            'date' => Yii::t('app', 'Date'),
            'status_id' => Yii::t('app', 'Qual é o seu estado?'),
            'user_id' => Yii::t('app', 'Created for'),
            'keeper' => Yii::t('app', 'Assignar Tarefa a?'),
            'description' => Yii::t('app', 'Descreva seu problema para a gente'),
            'type_id' => Yii::t('app', 'Qual é o seu Problema?'),
            'duration_time' => Yii::t('app', 'Tempo de Execução'),
            'client' => Yii::t('app', 'Qual a é empresa?'),
            'files' => Yii::t('app', 'Coloque Arquivos'),
        ];
    }

    public function deleteAllFiles(){
        foreach ($this->files as $file) {
            $file->deleteFile();
            @$file->deleteDir();
        }
        // die();
    }

    public function listTicketByUser(){
        return $this->find()->where(['user_id' => Yii::$app->user->id])->orderBy('date desc')->all();   
    }
    public function listTicketByKeeper(){
        return $this->find()->where(['keeper' => Yii::$app->user->id])->orderBy('date desc')->all();   
    }

    public function listTicketByClient($client_id){
        $this->find()->where(['client' => $client_id])->all();   
    }

    public function getColorTicket(){
        switch ($this->status_id) {
            case '2':
                return 'closed';
                break;
            
            default:
                return 'opened';
                break;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['ticket' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInteration()
    {
        return $this->hasMany(Interation::className(), ['ticket_id' => 'id']);
    }

    public function setStatus(Status $status){
        $this->status = $status;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
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
    public function getKeeper()
    {
        return $this->hasOne(User::className(), ['id' => 'keeper']);
    }
    public function getKeepers()
    {
        return $this->hasOne(User::className(), ['id' => 'keeper']);
    }

    public function setType(Problems $type){
        $this->type = $type;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Problems::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
