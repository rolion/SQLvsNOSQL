<?php

namespace backend\controllers;

use Yii;
use backend\models\PerfilMongo;
use backend\models\PerfilMongoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use  \yii\helpers\Json;
/**
 * PerfilMongoController implements the CRUD actions for PerfilMongo model.
 */
class PerfilMongoController extends Controller
{
    private static $idsEliminar=array();
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    public function actionSetIdsEliminar(){
        self::$idsEliminar=Yii::$app->request->post('ids');
    }
    /**
     * Lists all PerfilMongo models.
     * @return mixed
     */
    public function actionCargar(){
       // $model=new PerfilMongo();
        $cantidad=1000;
//        $mensaje='cantidad de objetos insertados'.$cantidad.' '.
//                $negocio->generarInsercionesDinamicas($cantidad);
    $tiempo_inicio = microtime(true);
        for($i=0;$i<$cantidad;$i++){
            $model=new PerfilMongo();
            $model->nombre_completo='Nombre Perfil '.$i;
            $model->pais='Pais Perfil '.$i;
            $model->email='email'.$i.'@correo.com';
            $model->save();
        }
     $tiempo_fin = microtime(true);
     $mensaje='Tiempo empleado para cargar '.$cantidad.' tuplas: '.($tiempo_fin-$tiempo_inicio);
        return $this->redirect(['index','mensaje'=>$mensaje]);
    }
    public function actionIndex($mensaje="")
    {
        $searchModel = new PerfilMongoSearch();
        $dataProvider = new ActiveDataProvider([
                    'query' => PerfilMongo::find()->orderBy('_id'),
                        
                    'pagination' => [
                        'pageSize' => 100,
                    ],
                ]);
                //$searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'mensaje'=>$mensaje,
        ]);
    }
    public function actionEliminartodo(){
        $tiempo_inicio = microtime(true);
        $cantidad=  PerfilMongo::find()->count();
        PerfilMongo::deleteAll();
        $tiempo_fin = microtime(true);
        $mensaje='Tiempo empleado para eliminar '.$cantidad.' tuplas: '
                .($tiempo_fin-$tiempo_inicio);
        $this->redirect(['index','mensaje'=>$mensaje]);
    }

    /**
     * Displays a single PerfilMongo model.
     * @param integer $_id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PerfilMongo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PerfilMongo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => (string)$model->_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PerfilMongo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $_id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => (string)$model->_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PerfilMongo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $_id
     * @return mixed
     */
    public function actionDeleteFew(){
        
        $ids=Yii::$app->request->post('ids');
        $tiempo_inicio = microtime(true);
        foreach($ids as $id){
            
            PerfilMongo::findOne($id)->delete();
            //$model->delete();
        }
        $tiempo_fin = microtime(true);
        $mensaje='Tiempo empleado para eliminar '.  count($ids).' tuplas: '
                .($tiempo_fin-$tiempo_inicio);
        echo Json::encode($mensaje);
       // Yii::$app->user->setState('param1', $mensaje);
       //return $this->redirect(['index','mensaje'=>$mensaje]);
    }
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PerfilMongo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $_id
     * @return PerfilMongo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PerfilMongo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
