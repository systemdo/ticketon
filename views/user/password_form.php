<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Role;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
<?php if($error){?>
<div class="">
	Token inexistente
</div>
<?php }?> 
    <?php $form = ActiveForm::begin(['action' =>'create-password' ]); ?>

    <?= $form->field($model, 'password')->passwordInput()?>
    
    <?= $form->field($model, 'confirm_password')->passwordInput()?>

    

    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create') , ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
