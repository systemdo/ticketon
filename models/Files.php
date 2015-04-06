<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "files".
 *
 * @property integer $id
 * @property string $name
 * @property integer $ticket
 *
 * @property Ticket $tickets
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $files = array();
    public $dir = "uploads/tickets/ticket";
    

    public static function tableName()
    {
        return 'files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['files'], 'file', 'extensions' => 'pdf'],
            [['ticket'], 'integer'],
            [['name'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'ticket' => Yii::t('app', 'Ticket'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket']);
    }

    public function getFiles($model){
        if(is_dir($this->dir.$model->id.'/')){
            return $this->findOne(['ticket' => $model->id]);
        }
        return  false;
    }

    public function getPathFile(){
        return $this->dir.$this->ticket.'/'.$this->name;
    }

    public function setDir($model){
        return $this->dir.$model->id.'/';
    }

    public function deleteFile(){
        if(is_file($this->dir.$this->tickets->id.'/'.$this->name))
            return unlink($this->dir.$this->tickets->id.'/'.$this->name);  
    }
    public function deleteDir(){
        // var_dump(is_dir($this->dir.$this->tickets->id));
        // var_dump(rmdir($this->dir.$this->tickets->id));
        if(is_dir($this->dir.$this->tickets->id))
            return rmdir($this->dir.$this->tickets->id);  
    }



}
