<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\assets\AppAsset;
use yii\web\VIEW;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DocumentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Documentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h1><?= Html::encode($mensaje)?></h1>

    <?php Pjax::begin(['timeout' => 5000, 'id' => 'id-pjax-mongo']); ?>
    <p>
        <?= Html::a('Create Documento', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cargar', ['cargar'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Borrar Seleccion', [''], ['class' => 'btn btn-success', 'id' => 'id-documento-link']) ?>
        <?= Html::a('Borrar Todo', ['delete-all'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => 'id-grid-documento-mongo',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre_documento',
            'fecha_creacion',
            [
                'attribute' => 'direccion_archivo',
                'format' => 'html',    
                'value' => function ($data) {
                    return  Html::img($data->imageUrl,['width'=>'100','height'=>'100']);
                },
            ],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'name' => 'id-grid-documento-mongo',
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['id' => 'selection-id',];
                }
            ],

            ['class' => 'yii\grid\ActionColumn', ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<?php 
    AppAsset::register($this);
    $this->registerJs('MyScript.js', VIEW::POS_READY);
?>
