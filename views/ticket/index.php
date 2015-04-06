<?php

use yii\helpers\Html;
use yii\helpers\Url;

 
/* @var $this yii\web\View */
/* @var $searchModel app\models\modelsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

    <p><a href="<?php echo Url::to(['/ticket/create'])?>">
          <button type="button" class="btn btn-success">
              <span class="glyphicon glyphicon-plus"><?php echo Yii::t('app', 'Open Ticket')?></span> 
          </button>
    </a>
    </p>
    
   <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th ><?php echo $ticket->attributeLabels()['number']?></th>
          <th ><?php echo $ticket->attributeLabels()['date']?></th>
          <th ><?php echo Yii::t('app', 'Accions')?></th>
        <tr>
      </thead>   
      <tbody>
    <?php 
        $x = 1;
        foreach ($models as $key => $model) {
     ?>   
        
        <tr>
          <td><?php echo $x ?></td>
          <td><?php echo $model->id ?></td>
          <td><?php echo $model->date ?></td>
          <td>
            
                 
                  <a class="btn btn-info" href="<?php echo Url::to(['ticket/view', 'id' => $model->id])?>">
                    <span class="glyphicon glyphicon-zoom-in"></span>
                    View
                  </a>

                  <a class="btn btn-success" href="<?php echo Url::to(['ticket/update', 'id' => $model->id])?>">
                   <span class="glyphicon glyphicon-cog"></span> 
                  Edit
                  </a>

                  <a  class="btn btn-danger" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0" href="<?php echo Url::to(['ticket/delete', 'id' => $model->id])?>">
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

