<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\PasswordForm;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        
         $user = new User();
        $models = User::find()->all();
       
        return $this->render('index', [
             'models' => $models,
            'user' => $user,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        // var_dump($this->findModel($id));
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionFirstAccess()
    {
        $model = new User();
        $error = false;
        $session = Yii::$app->session;

        if (Yii::$app->request->post()) {
            // var_dump(Yii::$app->request->post('User'));die();
            $email = Yii::$app->request->post('User')['email'];
            $token = Yii::$app->request->post('User')['password_reset_token'];
            
            $user = User::findOne(['email' => $email]);
            
            if(empty($user->password_reset_token)){
               $error = true; 
            }else{

                    if($user->password_reset_token == $token )
                    {
                        $session->open();
                        $session->set('change_password', array( 'id' => $user->id, 'email' =>  $email));   
                        return $this->render('password_form', [
                            'model' => new PasswordForm(),
                            'error' => $error,
                        ]);
                    }else{
                        $error = "Token invalido";
                    }
                }
            // var_dump($user);die();
        } 
           
            return $this->render('first_form', [
                'model' => $model,
                'error' => $error,
            ]);
        
    }

    public function actionCreatePassword()
    {
        $user = new User();
        $model = new PasswordForm();
        $error = false;
        $session = Yii::$app->session;
          
        //var_dump($session->get('change_password'));die();
        // var_dump(Yii::$app->request->post('PasswordForm'));die();
        if ($session->get('change_password')) {
            
            $session_user = $session->get('change_password');
            $user = User::findOne($session_user['id']);
            
            if(empty($user))
            {
               $error = true; 
            }else{
                    
                    if(Yii::$app->request->post('PasswordForm'))
                    {
                        $password = Yii::$app->request->post('PasswordForm')['password'];
                        $password_confirm = Yii::$app->request->post('PasswordForm')['confirm_password'];

                        // var_dump($password == $password_confirm);die();
                         if($password == $password_confirm)
                         {   
                            // $user->password = $password;
                            $user->setPassword($password);
                            $user->removePasswordResetToken();
                            $user->status = 10;
                            $session->close();
                            $session->destroy();

                            if($user->save()){
                            $sendEmail = Yii::$app->mailer->compose()
                            ->setTo($user->email)
                            ->setFrom(['noreply@mail.com' => 'Confirmação Password'])
                            ->setSubject('Confirmação Password')
                            ->setTextBody($user->email.' '. $password)
                            ->send();
                            }
                            return $this->redirect('login');
                        }else{
                            $error = "Password diferentes, tente outra vez, por favor";
                        }
                    }
                }
             

             return $this->render('password_form', [
                'model' => $model,
                'error' => $error,
            ]);

        }else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();


        if ($model->load(Yii::$app->request->post())) {
            $model->generatePasswordResetToken();
            if($model->save()){
                $sendEmail = Yii::$app->mailer->compose()
            ->setTo($model->email)
            ->setFrom(['noreply@mail.com' => 'Primero Acesso'])
            ->setSubject('Primero Acesso')
            ->setTextBody($model->password_reset_token)
            ->send();
            }   
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('_form', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // echo '<pre>';
        // var_dump($this->findModel($id));
        $model->generatePasswordResetToken();   
        if ($model->load(Yii::$app->request->post())) {
            
            if($model->save()){
                $sendEmail = Yii::$app->mailer->compose()
            ->setTo($model->email)
            ->setFrom(['noreply@mail.com' => 'Primero Acesso'])
            ->setSubject('Primero Acesso')
            ->setTextBody($model->password_reset_token)
            ->send();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('_form', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
