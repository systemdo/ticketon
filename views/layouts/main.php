<?php
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;


/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="#">Brand</a>
        </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo Url::to(['/home']) ?>" data-icon="home">Home</a></li>
                <li><a rel="external" href="<?php echo Url::to(['/ticket']) ?>" data-icon="home">Ticket</a></li>

                <!--<li><a href="<?php echo Url::to(['/ticket']) ?>" data-icon="home">Ticket</a></li> -->
                <li><a href="<?php echo Url::to(['/clients']) ?>" class="ui-btn-active" data-icon="home">Clients</a></li>
                <li><a href="<?php echo Url::to(['/problems']) ?>" data-icon="home">Problems</a></li>
                <li><a href="<?php echo Url::to(['/interation']) ?>" data-icon="home">Iterações</a></li>
                 <!--<li><a href="<?php echo Url::to(['/status']) ?>" data-icon="home">Estato Ticket</a></li> -->
                <li><a href="<?php echo Url::to(['/user']) ?>" data-icon="home">Usuarios</a></li>
                <li><a method="post" href="<?php echo Url::to(['/login/logout']) ?>">Logout</a></li>
              </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->


  </div>
</nav>
   <div class="container main">
      <div class="row">
        <?php echo $content ?>
      </div>
    </div>
                
     
      <div class="footer">
            <p class="pull-center">&copy; My Company <?= date('Y') ?> <?= Yii::powered() ?></p>
      </div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

