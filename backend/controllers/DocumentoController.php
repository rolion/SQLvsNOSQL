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
    public function actionIndex()
    {
        $searchModel = new DocumentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Documento model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Documento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionViewpd($id){
        $persona=  Persona::findOne($id);
        $dataProvider=new ActiveDataProvider([
                'query' => Documento::find()
                ->where(['id_persona'=>$id])
                ->orderBy('id'),]);
        
        return $this->render('viewpd', 
                ['dataProvider' => $dataProvider,
                'persona'=>$persona]);
    }
    public function actionCreate()
    {
        $model = new Documento();
            //echo Yii::$app->request->post()[];
        
        if ($model->load(Yii::$app->request->post())  ) {
            $model->docFile=  UploadedFile::getInstances($model, 'docFile');
            foreach ($model->docFile as $i=>$file){
                $documento=new Documento();
                $documento->id_persona=$model->id_persona;
                $documento->direccion_archivo=
                        $file->baseName.'.'.
                        $file->extension;
                $path=Yii::$app->basePath .'/web/imagenes/'.$documento->direccion_archivo;
                $documento->nombre_documento=$file->baseName;
                $documento->fecha_creacion=date('Y-m-d H:i:s');
                $documento->save();
                $file->saveAs($path);
            }
//            $dataProvider=new ActiveDataProvider([
//                'query' => Documento::find()->where(['id_persona'=>$model->id_persona])->orderBy('id'),]);
            $this->redirect(['viewpd','id'=>$model->id_persona]);
//            return $this->render('viewpd', 
//                ['dataProvider' => $dataProvider,
//                'persona'=>$model->idPersona]);
        } else {
            return $this->render('create', [
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
