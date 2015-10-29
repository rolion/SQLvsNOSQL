<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\assets\AppAsset;
use yii\web\VIEW;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DocumentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Documentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h1><?= Html::encode($mensaje)?></h1>

    <p>
        <?= Html::a('Create Documento', ['create'], ['class' => 'btn btn-success']) ?>
        
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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

            ['class' => 'yii\grid\ActionColumn', ],
        ],
    ]); ?>

</div>
<?php 
    AppAsset::register($this);
    $this->registerJs('myscript.js',VIEW::EVENT_AFTER_RENDER);
?>
