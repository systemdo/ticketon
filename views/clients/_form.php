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

<div class="col-md-12">
  <div class="row">
<div class="col-md-6">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading"><h3><?php echo Yii::t('app', 'Client')?></h3></div>
      <div class="panel-body">
        <div class="form-group">

            <?= $form->field($model, 'name')->textInput(['maxlength' => 150]) ?>

            <?= $form->field($model, 'fiscal_number')->textInput() ?>

            <?= $form->field($model, 'begin_contract')->textInput(['data-role' => "date", 'class' => 'datepicker form-control']) ?>

            <?= $form->field($model, 'end_contract')->textInput(['data-role' => "date", 'class' => 'datepicker form-control']) ?>
          </div>    
  </div>
</div>
</div>
</div>

<div class="col-md-6">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading"><h3><?php echo Yii::t('app', 'Address')?></h3></div>
      <div class="panel-body">
        <div class="form-group">
            <?= $form->field($address, 'street')->textInput() ?>
        <div class="col-md-6">
            <div class="row">
              <?= $form->field($address, 'number')->textInput() ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <?= $form->field($address, 'postcode')->textInput() ?>
            </div>
          </div>
          <?= $form->field($address, 'complement')->textInput() ?>
          <div class="col-md-6">
            <div class="row">
             <?= $form->field($address, 'ciudad')->textInput() ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <?= $form->field($address, 'country')->dropDownList(ArrayHelper::map(Country::find()->all(), 'id', "country")) ?>    
            </div>
          </div>
        
      </div>
    </div>
      </div>
    </div>
  </div>
</div>
</div>

<div class="col-md-12">
<div class="row">
    <div class="col-md-6">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading"><h3><?php echo Yii::t('app', 'Administration Contact')?></h3></div>
      <div class="panel-body">
        <div class="form-group">
            <input type="hidden" id="contact-type_contact_id" value="1" name="contact_admin[type_contact_id]">

            <?= $form->field($contact_admin, 'email')->textInput(['name' => 'contact_admin[email]']) ?>
        
                <?= $form->field($contact_admin, 'phone')->textInput(['name'=>'contact_admin[phone]', 'class'=>'phone form-control', 'id'=> 'contact-phone-admin']) ?>
        
            <?= $form->field($contact_admin, 'second_phone')->textInput(['name' => 'contact_admin[second_phone]', 'class'=>'phone form-control', 'id'=> 'contact-second-phone']) ?>


          </div>
    </div>
  </div>
</div>
</div>
<div class="col-md-6">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading"><h3><?php echo Yii::t('app', 'Technician Contact')?></h3></div>
      <div class="panel-body">
        <div class="form-group">
        <input type="hidden" id="contact-type_contact_id" value="2" name="contact_tec[type_contact_id]">
         
        <?= $form->field($contact_tec, 'email')->textInput(['name' => 'contact_tec[email]']) ?>
        
         <?= $form->field($contact_tec, 'phone')->textInput(['name'=>'contact_tec[phone]', 'class'=>'phone form-control', 'id'=> 'contact-phone-admin']) ?>
        
        <?= $form->field($contact_tec, 'second_phone')->textInput(['name' => 'contact_tec[second_phone]', 'class'=>'phone form-control', 'id'=> 'contact-second-phone']) ?>


    </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>



