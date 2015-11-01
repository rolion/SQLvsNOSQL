<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model app\models\Pregunta */

$this->title = 'Documentos de '.$documento->nombre_documento;
$this->params['breadcrumbs'][] = ['label' => 'Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pregunta-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <h1><?= Html::encode($mensaje) ?></h1>
    <p>
        <?= Html::a('Update', ['update', 'id' => $documento->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $documento->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= 
//        GridView::widget([
//        'dataProvider' => $dataProvider,
//        'columns' => [
//           'fecha_creacion',
//           'nombre_documento',
//           [
//                'attribute' => 'direccion_archivo',
//                'format' => 'html',    
//                'value' => function ($data) {
//                    return  Html::img($data->imageUrl,['width'=>'100','height'=>'100']);
//                },
//            ]
//
//            ]
//    ])
            DetailView::widget([
            'model' => $documento,
            'attributes' => [
                'id',
                'fecha_creacion',
                'nombre_documento',
//            [
//                'attribute' => 'direccion_archivo',
//                'format' => 'html',    
//                'value' => function ($data) {
//                    return  Html::img($data->imageUrl,['width'=>'100','height'=>'100']);
//                },
//            ]
              [
                    'attribute'=>'direccion_archivo',
                    'value'=>$documento->imageUrl,
                    'format' => ['image',
                            ['width'=>'400','height'=>'200']
                                ],
                ],
            ],
            
        ]);                        
    ?>


</div>
