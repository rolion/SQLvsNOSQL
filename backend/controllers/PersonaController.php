<?php

namespace backend\controllers;

use Yii;
use backend\models\Persona;
use backend\models\PersonaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\negocio\NegocioPersona;
use yii\data\ActiveDataProvider;
use  \yii\helpers\Json;
/**
 * PersonaController implements the CRUD actions for Persona model.
 */
class PersonaController extends Controller {

    public function behaviors() {
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
     * Lists all Persona models.
     * @return mixed
     */
    public function actionIndex($mensaje = "") {
        $searchModel = new PersonaSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => Persona::find()->orderBy('id'),
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'mensaje' => $mensaje,
        ]);
    }

    public function actionCargar() {
        $negocio = new NegocioPersona();
        $cantidad = 1000;
        $mensaje = 'cantidad de objetos insertados' . $cantidad . ' ' .
                $negocio->generarInsercionesDinamicas($cantidad);
        return $this->render('mensajes', ['mensaje' => $mensaje]);
    }
    public function actionDeleteAll(){
        $tiempo_inicio = microtime(true);
        $model=  Persona::find()->all();
        foreach($model as $i=>$persona){
            $persona->delete();
        }
        $tiempo_fin = microtime(true);
        $mensaje = 'Tiempo empleado para eliminar ' . count($model) . ' tuplas: '
                . ($tiempo_fin - $tiempo_inicio);
        $this->redirect(['index','mensaje'=>$mensaje]);
    }
    public function actionDeleteFew() {

        $ids = Yii::$app->request->post('ids');
        $tiempo_inicio = microtime(true);
        foreach ($ids as $id) {
            Persona::findOne($id)->delete();
        }
        $tiempo_fin = microtime(true);
        $mensaje = 'Tiempo empleado para eliminar ' . count($ids) . ' tuplas: '
                . ($tiempo_fin - $tiempo_inicio);
        echo Json::encode($mensaje);
    }

    /**
     * Displays a single Persona model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Persona model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Persona();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Persona model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
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
     * Deletes an existing Persona model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Persona model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Persona the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Persona::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
