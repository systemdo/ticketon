<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\models\Interation;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;



/* @var $this yii\web\View */
/* @var $model app\models\Clients */
?>
<div class="button-group col-md-6">
      <a class="btn btn-info" href="<?php echo Url::to(['ticket/create'])?>">
        <span class="glyphicon glyphicon-plus"></span>
        <?php echo Yii::t('app', 'Open Ticket')?>
      </a>

      <a class="btn btn-success" href="<?php echo Url::to(['ticket/update', 'id' => $model->id])?>">
       <span class="glyphicon glyphicon-cog"></span> 
      Edit
      </a>

      <a  class="btn btn-danger" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0" href="<?php echo Url::to(['ticket/delete', 'id' => $model->id])?>">
      <span class="glyphicon glyphicon-remove"></span> 
      Delete
      </a>
</div>

<div class="content-view col-md-8">
<div class="row">
<div class="tabs">
  <ul>
    <li><a href="#clients"><?php echo $model->attributeLabels()['number'].': 00'.$model->id?></a></li>
    <?php if ($model->files){?>
    <li><a href="#files"><?php echo Yii::t('app', 'Attached`s Files')?></a></li>
    <?php }?>
  </ul>
  <div id="clients">
    <table class="table table-bordered">
        <tr>
          <td><?php echo Yii::t('app', 'Beginning Day')?></td>
          <td><?php echo $model->date?></td>
        </tr>
        <tr>
          <td><?php echo $model->attributeLabels()['status_id']?></td>
          <td><?php echo $model->status->name?></td>
        </tr>
        <tr>
          <td><?php echo Yii::t('app', 'Task Assigned for:')?></td>
          <td><?php echo $model->user->username?></td>
        </tr>
        <tr>
          <td><?php echo Yii::t('app', 'Task Assigned to:')?></td>
          <td><?php echo $model->keepers->username?></td>
        </tr>
        <tr>
          <td><?php echo Yii::t('app', 'Problems Description:')?></td>
          <td><?php echo $model->description?></td>
        </tr>
        <tr>
          <td><?php echo $model->attributeLabels()['type_id']?></td>
          <td><?php echo $model->type->problem?></td>
        </tr>
        <tr>
          <td><?php echo $model->attributeLabels()['duration_time']?></td>
          <td><?php echo $model->duration_time?></td>
        </tr>
        <tr>
          <td><?php echo Yii::t('app', 'Company/Client:')?></td>
          <td><?php echo $model->clients->name?></td>
        </tr>
    </table>
  </div>
  <?php if ($model->files){?>
  <div id="files">
    <table class="table table-bordered">
    <?php foreach ($model->files as $file){?>
        <tr>
          <td><?php echo $file->name?></td>
          <td><a class="btn btn-info" target="_blank" href="/<?php echo $file->getPathFile()?>"><?php echo Yii::t('app', 'See')?></a></td>
        <tr>
    <?php } ?>
    </table>
  </div>
  <?php } ?>
</div>
</div>
</div>

<div class="content-view col-md-8">
  <div class="row">
    <div class="panel panel-info">
      <div class="panel-heading"><?php echo Yii::t('app', 'Interation')?></div>
      <div class="panel-body">
      <?php foreach ($model->interation as $key => $interation) { ?>
        <div class="panel panel-info">
          <div class="panel-heading">
          <div class="row">
            <div class="col-md-6 text-left"><?php echo $interation->user->username?></div>
            <div class="col-md-6 text-right">
              <?php echo $interation->date?>
            </div>
          </div>
          </div>
          <div class="panel-body">
            <?php echo $interation->message?>
            <br/>
            <?php if(Yii::$app->user->id == $interation->user->id){?>
                  <div class="col-md-12 text-right">
                  <a  class="btn btn-danger" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0"  href="<?php echo Url::to(['ticket/interationdelete', 'id' => $interation->id, 'id_ticket' => $model->id])?>">
                      <span class="glyphicon glyphicon-remove"></span> 
                      Delete
                  </a>
                  </div>             
              <?php } ?>
          </div>
        </div>
    <?php }?>
     
    
        <?php $form = ActiveForm::begin(); ?>
      
        <?= $form->field($interation, 'message')->textarea(['rows' => 6, 'class' => 'form-control editor']) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Send') , ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>
      </div>
    </div>

  </div>
</div>