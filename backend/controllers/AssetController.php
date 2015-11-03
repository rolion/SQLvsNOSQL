<?php

namespace backend\controllers;

use Yii;
use backend\models\Asset;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use  \yii\helpers\Json;
/**
 * AssetController implements the CRUD actions for Asset model.
 */
class AssetController extends Controller
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
        ];
    }

    /**
     * Lists all Asset models.
     * @return mixed
     */
    public function actionIndex($mensaje="")
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Asset::find(),
            'pagination' => [
                        'pageSize' => 100,
                    ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'mensaje'=>$mensaje
        ]);
    }

    /**
     * Displays a single Asset model.
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
     * Creates a new Asset model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
          $model = new Asset;
        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model,'file');
            $model->filename=$file->name;
            $model->contentType=$file->type;
            $model->file=$file;
            if($model->save()){
                return $this->redirect(['view', 'id' => (string)$model->_id]);
            }
        }else{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionCargar(){
        $model=new Asset;
        $mensaje='';
        if($model->load(\Yii::$app->request->post())){
            $files=  UploadedFile::getInstances($model, 'file');
            $tiempo_de_inicio=  microtime(true);
            foreach ($files as $i=> $file){
                $doc=new Asset;
                $doc->load(\Yii::$app->request->post());
                $doc->filename=$file->name;
                $doc->contentType=$file->type;
                $doc->description="description ".$i;
                $doc->file=$file;
                $doc->save();
            }
            $tiempo_fin=  microtime(true);
            $mensaje="Tiempo empleado para cargar ".  count($files)." datos: " .($tiempo_fin - $tiempo_de_inicio);
            $this->redirect(['index','mensaje'=>$mensaje]);
        }else{
            return $this->render('cargar', [
                'model' => $model,
            ]);
        }
        
        
    }
    public function actionGet($id)
    {
        $model=$this->findModel($id);
        header('Content-type: '.$model->contentType);
        echo $model->file->getBytes();
    }

    /**
     * Updates an existing Asset model.
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
     * Deletes an existing Asset model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $_id
     * @return mixed
     */
    public function actionDeleteAll(){
        $tiempo_de_inicio=  microtime(true);
        $model=Asset::find()->all();
        foreach ($model as $file){
            $file->delete();
        }
        $tiempo_fin=  microtime(true);
        $mensaje="Tiempo empleado para eliminar ".  count($model)." datos: " .($tiempo_fin - $tiempo_de_inicio);
        $this->redirect(['index','mensaje'=>$mensaje]);
        
    }
    public function actionDeleteSelected(){
        $ids=Yii::$app->request->post('ids');
        if(!empty($ids)){
            $tiempo_inicio = microtime(true);
            foreach($ids as $id){
                Asset::findOne($id)->delete();
            }
            $tiempo_fin = microtime(true);
            $mensaje='Tiempo empleado para eliminar '.  count($ids).' tuplas: '
                    .($tiempo_fin-$tiempo_inicio);
            echo Json::encode($mensaje);
        }
    }
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Asset model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $_id
     * @return Asset the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Asset::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
