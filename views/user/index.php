<?php

use yii\helpers\Html;
use yii\helpers\Url;

 
/* @var $this yii\web\View */
/* @var $searchModel app\models\modelsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

    <p><a href="<?php echo Url::to(['/user/create'])?>">
          <button type="button" class="btn btn-success">
              <span class="glyphicon glyphicon-plus">create</span> 
          </button>
    </a>
    </p>
    
   <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th ><?php echo $user->attributeLabels()['username']?></th>
          <th ><?php echo $user->attributeLabels()['email']?></th>
          <th ><?php echo $user->attributeLabels()['role']?></th>
          <th ><?php echo $user->attributeLabels()['status']?></th>
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
          <td><?php echo $model->username?></td>
          <td><?php echo $model->email ?></td>
          <td><?php echo $model->roles->role?></td>
          <td><?php echo $model->getStatusName()?></td>
          <td>
            
                 
                  <!--<a class="btn btn-info" href="<?php echo Url::to(['user/view', 'id' => $model->id])?>">
                    <span class="glyphicon glyphicon-zoom-in"></span>
                    View
                  </a>-->

                  <a class="btn btn-success" href="<?php echo Url::to(['user/update', 'id' => $model->id])?>">
                   <span class="glyphicon glyphicon-cog"></span> 
                  Edit
                  </a>

                  <a  class="btn btn-danger" href="<?php echo Url::to(['user/delete', 'id' => $model->id])?>">
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

