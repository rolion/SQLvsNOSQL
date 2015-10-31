<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\assets\AppAsset;
use yii\web\VIEW;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PersonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persona-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h1><?=$mensaje?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Persona', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('Cargar', ['persona/cargar',], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('ELiminar', ['persona/index',], ['class' => 'btn btn-success','id'=>'e-id']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id'=>'grid',
        'tableOptions' =>['class' => 'table table-striped table-bordered',
            'id'=>'grid'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre_completo',
            'pais',
            'email:email',
            [
                'class'=>'yii\grid\CheckboxColumn',
                'name'=>'grid',
                
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['id'=>'selection-id',];
                }
                ],
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php 
AppAsset::register($this);
$this->registerJs('myscript.js',VIEW::POS_READY);
?>

</div>
