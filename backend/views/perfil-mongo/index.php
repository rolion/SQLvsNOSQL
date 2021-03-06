<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\assets\AppAsset;
use yii\web\VIEW;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PerfilMongoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Persona Mongo';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="perfil-mongo-index">

    
    <h1><?= Html::encode($this->title) ?></h1>
     <h1 id="id-men"><?= Html::encode($mensaje) ?></h1>
    <?php Pjax::begin(['timeout'=>5000,'id'=>'id-pjax-mongo']); ?>
    <p>
         <?= Html::a('Crear Persona', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cargar', ['perfil-mongo/cargar',], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Eliminar Seleccion', ['',], ['class' => 'btn btn-success'
            ,'id'=>'id-mongo-link']) ?>
        <?= Html::a('Borrar todo', ['perfil-mongo/delete-all',], ['class' => 'btn btn-success'
            ,'id'=>'id-mongo-link']) ?>
    </p>
    
    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'id'=>'id-grid-mongo',
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                '_id',
                'nombre_completo',
                'pais',
                'email',
                [
                    'class'=>'yii\grid\CheckboxColumn',
                    'name'=>'id-grid-mongo',
                    'checkboxOptions' => function ($model, $key, $index, $column) {
                        return ['id'=>'selection-id',];
                    }
                    ],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
  
   
    <?php Pjax::end(); ?>
</div>
<?php 
AppAsset::register($this);
$this->registerJs('MyScript.js',VIEW::POS_READY);
?>