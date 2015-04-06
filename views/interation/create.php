<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Interation */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Interation',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Interations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="interation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
