<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Clients */
?>
<div class="clients-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'address' => $address,
    ]) ?>

</div>
