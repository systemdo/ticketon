<?php

namespace app\controllers;

use Yii;
use app\models\Ticket;
use app\models\User;
use app\models\Status;
use app\models\Problems;
use app\models\Clients;
use app\models\TicketSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Files;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use app\models\Interation;





/**
 * TicketController implements the CRUD actions for Ticket model.
 */
class TicketController extends Controller
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
     * Lists all Ticket models.
     * @return mixed
     */
    public function actionList()
    {
        $ticket = new Ticket();
        
        $createdticket = $ticket->listTicketByUser();
        $assignedticket =$ticket->listTicketByKeeper();
        return $this->render('list', [
            'c_t' => $createdticket,
            'a_s' => $assignedticket,
        ]);
    }


    /**
     * Lists all Ticket models.
     * @return mixed
     */
    public function actionIndex()
    {
        $ticket = new Ticket();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $models = Ticket::find()->orderBy('date desc')->all();
        // echo '<pre>';
        // var_dump($models);
        return $this->render('index', [
           'models' => $models,
           'ticket' => $ticket,
        ]);
    }

    /**
     * Displays a single Ticket model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $files = new Files();
        $interation = new Interation();
        // echo "<pre>";
        // var_dump(Yii::$app->user);
        // var_dump(Yii::$app->request->post());
        // $interation->user = Yii::$app->user;
        if ($interation->load(Yii::$app->request->post())) {
            $interation->user_id = Yii::$app->user->id;
            $interation->ticket_id = $id;
            $interation->save();
            // var_dump($interation->getErrors()); die();
            if($interation->save()){
                return $this->redirect(['view', 'id' => $id]);
            }
            
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'files' => $files,
            'interation' => $interation,
        ]);
    }

    /**
     * Creates a new Ticket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ticket();
        $files = new Files();
        $keeper = new User(); 

        if(Yii::$app->request->post()){

            $post = Yii::$app->request->post('Ticket');
            $model->user_id = Yii::$app->user->id;
            $model->keeper = $keeper->findOne($post['keeper'])->id;
            $model->client = (int) $post['client'];
            $model->description = $post['description'];
            $model->duration_time = $post['duration_time'];
            $model->status_id = (int) $post['status_id'];
            $model->type_id = (int) $post['type_id'];

            if ($model->save()) {
                
                $model->files_upload = UploadedFile::getInstances($model, 'files');
                if ($model->files_upload) {

                
                 $dir = $files->setDir($model);
                foreach ($model->files_upload as $file){
                    $files = new Files(); 
                     $files->name =  $file->baseName . '.' . $file->extension; 
                     $files->ticket =  $model->id;
                
                     if(!is_dir($dir)){
                        mkdir($dir, 0777);
                    }
                    $file->saveAs($dir.$files->name);
                
                    $files->save();
                }
                
                 return $this->redirect(['view', 'id' => $model->id]);
                }
            } 
        }
        return $this->render('_form', [
            'model' => $model,
            'files' => $files,
        ]);

    }

    /**
     * Updates an existing Ticket model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $files = new Files();
        $keeper = new User(); 

            if(Yii::$app->request->post()){

            $post = Yii::$app->request->post('Ticket');
            // $model->user_id = Yii::$app->user->id;
            $model->keeper = $keeper->findOne($post['keeper'])->id;
            $model->client = (int) $post['client'];
            $model->description = $post['description'];
            $model->duration_time = $post['duration_time'];
            $model->status_id = (int) $post['status_id'];
            $model->type_id = (int) $post['type_id'];

            if ($model->save()) {
                // echo '<pre>';
                 // var_dump(UploadedFile::getInstances($model, 'files'));//die();   
                $model->files_upload = UploadedFile::getInstances($model, 'files');
                if ($model->files_upload) {

                 // $dir = 'uploads/tickets/ticket'.$model->id.'/';
                 $dir = $files->setDir($model);
                foreach ($model->files_upload as $file){
                    $files = new Files(); 
                     $files->name =  $file->baseName . '.' . $file->extension; 
                     $files->ticket =  $model->id;
                     // var_dump($model->id);
                     if(!is_dir($dir)){
                        mkdir($dir, 0777);
                    }
                    $file->saveAs($dir.$files->name);
                    // var_dump($files);
                    $files->save();
                }
                // die();
                 return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('_form', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Ticket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $ticket = $this->findModel($id);
        $ticket->deleteAllFiles();
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionInterationdelete($id, $id_ticket)
    {
        
        $interation = Interation::findOne($id);
        $interation->delete();
        // die('hola');
        return $this->redirect(['view?id='.$id_ticket]);
    }

    /**
     * Finds the Ticket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ticket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ticket::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
