<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\Clients */
?>
<div class="button-group col-md-6">
      <a class="btn btn-info" href="<?php echo Url::to(['clients/view', 'id' => $model->id])?>">
        <span class="glyphicon glyphicon-zoom-in"></span>
        View
      </a>

      <a class="btn btn-success" href="<?php echo Url::to(['clients/update', 'id' => $model->id])?>">
       <span class="glyphicon glyphicon-cog"></span> 
      Edit
      </a>

      <a  class="btn btn-danger" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0"  href="<?php echo Url::to(['clients/delete', 'id' => $model->id])?>">
      <span class="glyphicon glyphicon-remove"></span> 
      Delete
      </a>
</div>

<div class="content-view col-md-8">
<div class="row">
<div class="tabs">
  <ul>
    <li><a href="#clients"><?php echo Yii::t('app', 'Clients');?></a></li>
    <li><a href="#address"><?php echo Yii::t('app', 'Address');?></a></li>
    <li><a href="#contact-tec"><?php echo Yii::t('app', 'Technician Contact')?></a></li>
    <li><a href="#contact-admin"><?php echo Yii::t('app', 'Administration Contact')?></a></li>
    
  </ul>
  <div id="clients">
    <table class="table table-bordered">
        <tr>
          <td><?php echo $model->attributeLabels()['name']?></td>
          <td><?php echo $model->name?></td>
   		<tr>
          <td><?php echo $model->attributeLabels()['fiscal_number']?></td>
          <td><?php echo $model->fiscal_number?></td>
   		<tr>
          <td><?php echo $model->attributeLabels()['begin_contract']?></td>
          <td><?php echo $model->begin_contract?></td>
   		<tr>
          <td><?php echo $model->attributeLabels()['end_contract']?></td>
          <td><?php echo $model->end_contract?></td>
   		</tr>
   	</table>
  </div>
  <div id="address">
  <?php if ($model->addresses) { ?>
    <table class="table table-bordered">
        <tr>
          <td><?php echo $model->addresses->attributeLabels()['street']?></td>
          <td><?php echo $model->addresses->street?></td>
        </tr>  
   		<tr>
          <td><?php echo $model->addresses->attributeLabels()['number']?></td>
          <td><?php echo $model->addresses->number?></td>
        </tr>  
   		<tr>
          <td><?php echo $model->addresses->attributeLabels()['ciudad']?></td>
          <td><?php echo $model->addresses->ciudad?></td>
        </tr>  
   		<tr>
          <td><?php echo $model->addresses->attributeLabels()['complement']?></td>
          <td><?php echo $model->addresses->complement?></td>
   		</tr>
   		<tr>
          <td><?php echo $model->addresses->attributeLabels()['postcode']?></td>
          <td><?php echo $model->addresses->postcode?></td>
   		</tr>
   		<tr>
          <td><?php echo $model->addresses->attributeLabels()['country']?></td>
          <td><?php echo $model->addresses->countrys->country?></td>
   		</tr>
   		<!-- <tr>
          <td><?php echo $model->addresses->attributeLabels()['client']?></td>
          <td><?php echo $model->addresses->clients->name?></td>
   		</tr> -->
   	</table>
   	<?php }?>
  </div>
  <div id="contact-admin">
  <?php if ($contact_admin) { ?>
   <table class="table table-bordered">
        <tr>
          <td><?php echo $contact_admin->attributeLabels()['email']?></td>
          <td><?php echo $contact_admin->email?></td>
   		<tr>
          <td><?php echo $contact_admin->attributeLabels()['phone']?></td>
          <td><?php echo $contact_admin->phone?></td>
   		<tr>
          <td><?php echo $contact_admin->attributeLabels()['second_phone']?></td>
          <td><?php echo $contact_admin->second_phone?></td>
   	</table>
   	<?php } ?>
   	</div>
  
  <div id="contact-tec">
  <?php if ($contact_tec) { ?>
   <table class="table table-bordered">
        <tr>
          <td><?php echo $contact_tec->attributeLabels()['email']?></td>
          <td><?php echo $contact_tec->email?></td>
      <tr>
          <td><?php echo $contact_tec->attributeLabels()['phone']?></td>
          <td><?php echo $contact_tec->phone?></td>
      <tr>
          <td><?php echo $contact_tec->attributeLabels()['second_phone']?></td>
          <td><?php echo $contact_tec->second_phone?></td>
    </table>
    <?php } ?>
    </div>
  
</div>
</div>
</div>