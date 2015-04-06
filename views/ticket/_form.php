<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Problems;
use app\models\User;
use app\models\Status;
use app\models\Clients;

/* @var $this yii\web\View */
/* @var $model app\models\Ticket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-12">
<div class="row">
    <div class="form-group">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'data-ajax'=>'false']]) ?>

     <?php
        // var_dump($model);die();
        if(Yii::$app->user->getIdentity()->role == 1){ 
     ?>

        <div class="col-md-6">
            <div class="row">
            
            <?= $form->field($model, 'client')->dropDownList(ArrayHelper::map(Clients::find()->all(), 'id', "name"))?>
            
            </div>    
        </div>    

        <div class="col-md-6">
            <div class="row">

            <?= $form->field($model, 'keeper')->dropDownList(ArrayHelper::map(User::find()->all(), 'id', "email"))?>

            </div>    
        </div>    

     <?php }?>

     <?= $form->field($model, 'status_id')->dropDownList(ArrayHelper::map(Status::find()->all(), 'id', "name"))?>

    <?= $form->field($model, 'duration_time')->textInput(['maxlength' => 50]) ?>
    
     <?= $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(Problems::find()->all(), 'id', "problem"))?>
    

     <?= $form->field($model, 'description')->textarea(['rows' => 6, 'class' => 'form-control editor']) ?>


    <?= $form->field($model, 'files[first][]')->fileInput(['multiple' => true]) ?>

    <?= $form->field($model, 'files[second][]')->fileInput(['multiple' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

</div>
</div>
</div>
