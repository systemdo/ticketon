<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

 
/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

    <p><a href="<?php echo Url::to(['/clients/create'])?>">
          <button type="button" class="btn btn-success">
              <span class="glyphicon glyphicon-plus"><?php echo Yii::t('app', 'Create')?></span> 
          </button>
    </a>
    </p>
    
   <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th ><?php echo $clients->attributeLabels()['name']?></th>
          <th ><?php echo $clients->attributeLabels()['fiscal_number']?></th>
          <th ><?php echo Yii::t('app', 'Accions')?></th>
        <tr>
      </thead>   
      <tbody>
    <?php 
        $x = 1;
        foreach ($model as $key => $client) {
     ?>   
        
        <tr>
          <td><?php echo $x ?></td>
          <td><?php echo $client->name ?></td>
          <td><?php echo $client->fiscal_number ?></td>
          <td>
            
                 
                  <a class="btn btn-info" href="<?php echo Url::to(['clients/view', 'id' => $client->id])?>">
                    <span class="glyphicon glyphicon-zoom-in"></span>
                    View
                  </a>

                  <a class="btn btn-success" href="<?php echo Url::to(['clients/update', 'id' => $client->id])?>">
                   <span class="glyphicon glyphicon-cog"></span> 
                  Edit
                  </a>

                  <a  class="btn btn-danger" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0"  href="<?php echo Url::to(['clients/delete', 'id' => $client->id])?>">
                  <span class="glyphicon glyphicon-remove"></span> 
                  Delete
                  </a>
         </td>
        </tr>
    <?php    
        $x++;
    }
    ?>
    </tbody>
    </table>

