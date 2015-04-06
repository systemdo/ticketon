<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Role;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-6">
  <div class="row">
  <div class="form-group">
    <?php $form = ActiveForm::begin(); ?>

   <?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>
   
   <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'role')->dropDownList(ArrayHelper::map(Role::find()->all(), 'id', "role"))?>

    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'data-external-page'=> "true"]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
