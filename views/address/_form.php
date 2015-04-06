<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Address */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="address-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'street')->textInput(['maxlength' => 70]) ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'ciudad')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'complement')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'postcode')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'country')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
