<?php

namespace app\controllers;

use Yii;
use app\models\Clients;
use app\models\Address;
use app\models\Contact;
use app\models\TypeContact;
use app\models\ClientsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * ClientsController implements the CRUD actions for Clients model.
 */
class ClientsController extends Controller
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
     * Lists all Clients models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClientsSearch();
        $clients = new Clients();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = Clients::find()->all();    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'clients' => $clients,
        ]);
    }

    /**
     * Displays a single Clients model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'contact_admin' => $model->getContactAdmin(),
            'contact_tec' => $model->getContactTec(),
        ]);
    }

    /**
     * Creates a new Clients model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Clients();
        $address = new Address();
        $contact_admin = new Contact();
        $contact_tec = new Contact();
        //var_dump(Yii::$app->request->post());
        //die();  
        if ($model->load(Yii::$app->request->post()) ) {
             // var_dump(Yii::$app->request->post());die();
            $date_init = date_create($model->begin_contract);
            $model->begin_contract = date_format($date_init, 'Y-m-d');
            
            $date_end = date_create($model->end_contract);
            $model->end_contract = date_format($date_end, 'Y-m-d');
           
            if($model->save())
            {
                $post_addres = Yii::$app->request->post('Address');
                $address->client = $model->id;  
                $address->load(Yii::$app->request->post());
                 // var_dump($address->save());
                if($address->save())
                {
                    $post = Yii::$app->request->post('contact_admin');
                    $contact_admin->client = $model->id;
                    $contact_admin->email = $post['email'];
                    $contact_admin->type_contact_id = $post['type_contact_id'];
                    $contact_admin->phone = $post['phone'];
                    $contact_admin->second_phone = $post['second_phone'];

                    $post = Yii::$app->request->post('contact_tec');
                    $contact_tec->client = $model->id; //die('hol');
                    $contact_tec->email = $post['email'];
                    $contact_tec->type_contact_id = $post['type_contact_id'];
                    $contact_tec->phone = $post['phone'];
                    $contact_tec->second_phone = $post['second_phone'];

                    if($contact_admin->save() && $contact_tec->save()){
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
                // die();    
            }    
        }
            return $this->render('_form', [
                'model' => $model,
                'address' => $address,
                'contact_admin' => $contact_admin,
                'contact_tec' => $contact_tec,
            ]);
        
    }

    /**
     * Updates an existing Clients model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
      
        if(!empty($model->address)){
            $address = Address::findOne($model->address->id);
        }else{
            $address = new Address();
        }

        $contact_tec = new Contact();

        if(!empty($model->getContactAdmin()))
        {
            $contact_admin =  $model->getContactAdmin();
        }else{
            $contact_admin = new Contact();
        }

        if(!empty($model->getContactTec())){

            $contact_tec = $model->getContactTec();
        }else{
            $contact_tec = new Contact();
        }

        if ($model->load(Yii::$app->request->post())) {
            // echo "<pre>";    
            $date_init = date_create($model->begin_contract);
            $model->begin_contract = date_format($date_init, 'Y-m-d');

            $date_end = date_create($model->end_contract);
            $model->end_contract = date_format($date_end, 'Y-m-d');

                 // var_dump($model->save());
                // var_dump($model->getErrors()); die();
             if($model->save())
            {
                $post_addres = Yii::$app->request->post('Address');
                if(!empty($model->address))
                {
                    $address = $model->address;
                    // $address->load($post_addres);
                }else{
                     $address = new Address();
                     // $address->load($post_addres);
                     $address->client = $id;
                }

                $address->street = $post_addres['street'];
                $address->ciudad = $post_addres['ciudad'];
                $address->number = $post_addres['number'];
                $address->complement = $post_addres['complement'];
                $address->postcode = $post_addres['postcode'];
                $address->country = $post_addres['country'];
                 // var_dump($model->address);
                // var_dump(Yii::$app->request->post('Address'));
                 // var_dump($address->save());
                // var_dump($address->getErrors()); die();
             // var_dump($address->getErrors()); die();

                if($address->save())
                {
                    $post = Yii::$app->request->post('contact_admin');
                    $contact_admin->client = $model->id;
                    $contact_admin->email = $post['email'];
                    $contact_admin->type_contact_id = $post['type_contact_id'];
                    $contact_admin->phone = $post['phone'];
                    $contact_admin->second_phone = $post['second_phone'];

                    $post = Yii::$app->request->post('contact_tec');
                    $contact_tec->client = $model->id; //die('hol');
                    $contact_tec->email = $post['email'];
                    $contact_tec->type_contact_id = $post['type_contact_id'];
                    $contact_tec->phone = $post['phone'];
                    $contact_tec->second_phone = $post['second_phone'];

                    if($contact_admin->save() && $contact_tec->save()){
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }

            }
            
        } 
            return $this->render('_form_update', [
                'model' => $model,
                'address' => !empty($model->address)? $model->address : $address,
                'contact_admin' => $contact_admin,
                'contact_tec' => $contact_tec,
            ]);
        
    }

    /**
     * Deletes an existing Clients model.
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
     * Finds the Clients model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Clients the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Clients::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
