<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

?>
<style type="text/css">
    
</style>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
  <div class="col-md-12 view-login">
  <div class="row">
            <?php $form = ActiveForm::begin(
                [ 
                    'id' => 'login-form-inline', 
                    'options' => ['class' => 'form-inline']
                ]); ?>
                <?= $form->field($model, 'email') ?>
                <?php //$form->field($model, 'username') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
</div>    
</div>    
</div>    
</nav>

 