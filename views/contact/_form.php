<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type_contact_id')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'second_phone')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
