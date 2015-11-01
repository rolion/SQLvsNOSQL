<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\web\VIEW;
use backend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Documento Mongo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h1><?= Html::encode($mensaje) ?></h1>
    <p>
        <?= Html::a('Create Asset', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('Cargar', ['asset/cargar'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('Borrar Todo', ['asset/delete-all'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(['timeout' => 5000, 'id' => 'id-pjax-mongo']); ?>
    <p>
        <?= Html::a('Borrar Seleccion', [''], ['class' => 'btn btn-success', 'id' => 'id-asset-link']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'id' => 'id-grid-asset-mongo',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            '_id',
            'filename',
            'contentType',
            'description',
            [
                'attribute' => 'file',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img(Url::to(['asset/get', 'id' => (string) $data->_id]), ['width' => '100', 'height' => '100']);
                },
            ],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'name' => 'id-grid-asset-mongo',
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['id' => 'selection-id',];
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
<?php
    AppAsset::register($this);
    $this->registerJs('MyScript.js', VIEW::POS_READY);
?>
