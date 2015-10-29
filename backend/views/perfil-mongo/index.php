<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PerfilMongoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Perfil Mongos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perfil-mongo-index">

    <h1><?= Html::encode($this->title) ?></h1>
     <h1><?= Html::encode($mensaje) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Perfil Mongo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('Cargar', ['perfil-mongo/cargar',], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('Eliminar Todo', ['perfil-mongo/eliminartodo',], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            '_id',
            'nombre_completo',
            'pais',
            'email',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
