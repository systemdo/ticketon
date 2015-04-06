<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Country;

/* @var $this yii\web\View */
/* @var $model app\models\Clients */
/* @var $form yii\widgets\ActiveForm */
?>


    <?php $form = ActiveForm::begin(); ?>
    <div data-role="tabs" id="tabs">
      <div data-role="navbar">
        <ul>
          <li><a href="#one" data-ajax="false">one</a></li>
          <li><a href="#address" data-ajax="false"><?php echo Yii::t('app', 'Address')?></a></li>
          <li><a href="#contact_admin" data-ajax="false"><?php echo Yii::t('app', 'Administration Contact')?></a></li>
          <li><a href="#contact_tec" data-ajax="false"><?php echo Yii::t('app', 'Technician Contact')?></a></li>
        </ul>
      </div>
      <div id="one" class="ui-body-d ui-content">
            <?= $form->field($model, 'name')->textInput(['maxlength' => 150]) ?>

            <?= $form->field($model, 'fiscal_number')->textInput() ?>

            <?= $form->field($model, 'begin_contract')->textInput(['data-role' => "date", 'class' => 'datepicker']) ?>

            <?= $form->field($model, 'end_contract')->textInput(['data-role' => "date", 'class' => 'datepicker']) ?>

      </div>
      <div id="address">
        <?= $form->field($address, 'street')->textInput() ?>
        
        <?= $form->field($address, 'number')->textInput() ?>
        
        <?= $form->field($address, 'ciudad')->textInput() ?>
        
        <?= $form->field($address, 'complement')->textInput() ?>
        
        <?= $form->field($address, 'postcode')->textInput() ?>
        
        <?= $form->field($address, 'country')->dropDownList(ArrayHelper::map(Country::find()->all(), 'id', "country")) ?>    
    </div>


      
     <div id="contact_admin">
        <?= $form->field($contact_admin, 'email')->textInput(['name' => 'contact_admin[email]']) ?>
        
        <?= $form->field($contact_admin, 'phone')->textInput(['name'=>'contact_admin[phone]']) ?>
        
        <?= $form->field($contact_admin, 'second_phone')->textInput(['name' => 'contact_admin[second_phone]']) ?>
      </div>
    <div id="contact_tec">
        <?= $form->field($contact_tec, 'email')->textInput(['name' => 'contact_tec[email]']) ?>
        
        <?= $form->field($contact_tec, 'phone')->textInput(['name'=>'contact_tec[phone]']) ?>
        
        <?= $form->field($contact_tec, 'second_phone')->textInput(['name' => 'contact_tec[second_phone]']) ?>
    </div>
</div>
   
    
    <?php //$form->field($model, 'contact_technician_id')->textInput() ?>

    <?php //$form->field($model, 'contact_admin_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


