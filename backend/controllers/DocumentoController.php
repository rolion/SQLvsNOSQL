<?php

namespace backend\controllers;

use Yii;
use backend\models\Documento;
use backend\models\DocumentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use backend\models\Persona;
use backend\models\PersonaSearch;
use  \yii\helpers\Json;
/**
 * DocumentoController implements the CRUD actions for Documento model.
 */
class DocumentoController extends Controller
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
     * Lists all Documento models.
     * @return mixed
     */
    public function actionIndex($mensaje="")
    {
        $searchModel = new DocumentoSearch();
        $persona=new Persona();
        $personaSearch=new PersonaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $personaSearch,
            'dataProvider' => $dataProvider,
            'mensaje'=>$mensaje,
        ]);
    }

    /**
     * Displays a single Documento model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $mensaje="")
    {
        $documento=  Documento::findOne($id);
        $dataProvider=new ActiveDataProvider([
                'query' => Documento::find()
//                ->where(['id_persona'=>$id])
//                ->orderBy('id'),
            ]);
        
        return $this->render('view', 
                [
                'documento'=>$documento,
                'mensaje' =>  $mensaje]);
    }

    /**
     * Creates a new Documento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
        public function actionDeleteAll(){
            $tiempo_de_inicio=  microtime(true);
            $model=  Documento::find()->all();
            foreach($model as $i =>$doc){
                $doc->delete();
            }
            $tiempo_fin=  microtime(true);
            $mensaje="Tiempo empleado para eliminar ". count($model)." tuplas: " .($tiempo_fin - $tiempo_de_inicio);
            $this->redirect(['index','mensaje'=>$mensaje]);
        }
        public function actionDeleteSelected(){
            $ids=Yii::$app->request->post('ids');
            $tiempo_inicio = microtime(true);
            foreach($ids as $id){
                Documento::findOne($id)->delete();
            }
            $tiempo_fin = microtime(true);
            $mensaje='Tiempo empleado para eliminar '.  count($ids).' tuplas: '
                    .($tiempo_fin-$tiempo_inicio);
            echo Json::encode($mensaje);
        }
    public function actionCreate(){
        $tiempo_de_inicio=  microtime(true);
        $model = new Documento();
        if ($model->load(Yii::$app->request->post())) {
            $model->docFile = UploadedFile::getInstance($model, 'docFile');
            $model->direccion_archivo = $model->docFile->baseName . '.' .
                        $model->docFile->extension;
            $path = Yii::$app->basePath . '/web/imagenes/' . $model->direccion_archivo;
            $model->fecha_creacion = date('Y-m-d H:i:s');
            $tiempo_de_inicio=  microtime(true);
            $model->save();
            $model->docFile->saveAs($path);
            $tiempo_fin=  microtime(true);
            $mensaje="Tiempo empleado para crear un dato nuevo: " .($tiempo_fin - $tiempo_de_inicio);
            $this->redirect(['view','id'=>$model->id,
                'mensaje'=>$mensaje]);
        }  else {
             return $this->render('create', [
                        'model' => $model,    
            ]);
        }
    }
    public function actionCargar() {
       // set_time_limit(0);
        $tiempo_de_inicio=  microtime(true);
        $model = new Documento();
        if ($model->load(Yii::$app->request->post())) {
            $model->docFile = UploadedFile::getInstances($model, 'docFile');
            foreach ($model->docFile as $i => $file) {
                $documento = new Documento();
               // $documento->id_persona = $model->id_persona;
                $documento->direccion_archivo = $file->baseName . '.' .
                        $file->extension;
                $path = Yii::$app->basePath . '/web/imagenes/' . $documento->direccion_archivo;
               // $documento->nombre_documento = $file->baseName;
                $documento->fecha_creacion = date('Y-m-d H:i:s');
                $documento->save();
                $file->saveAs($path);
            }
            $tiempo_fin=  microtime(true);
            $mensaje="Tiempo empleado para cargar".count($model->docFile)." tuplas: " .($tiempo_fin - $tiempo_de_inicio);
        //return $this->render('Tiempo',['mensaje' =>$mensaje]);
            $this->redirect(['index', 
                'mensaje' =>  $mensaje
                ]);
            
        } else {
            return $this->render('cargar', [
                        'model' => $model,
                
            ]);
        }

    }

    /**
     * Updates an existing Documento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Documento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $tiempo_de_inicio=  microtime(true);
        $documento=Documento::find()->where(['id_persona'=>$id])->all();
        foreach($documento as $i=>$doc){
            $doc->delete();
        }
      //   Documento::deleteAll(['id_persona'=>$id]);//<----es mas rapido
        $tiempo_fin=  microtime(true);
        $mensaje="Tiempo empleado para eliminar: " .($tiempo_fin - $tiempo_de_inicio);
       
                //find()->where(['id_persona' =$id]);
        //$this->findModel($id)->delete();

        return $this->redirect(['index', 'mensaje' =>  $mensaje]);
    }

    /**
     * Finds the Documento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Documento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Documento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
