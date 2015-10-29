<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Persona;

/* @var $this yii\web\View */
/* @var $model app\models\Pregunta */

$this->title = 'Documentos';
$this->params['breadcrumbs'][] = ['label' => 'Documentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pregunta-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
   <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?> 
    <?= $form->field($model, 'id_persona')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Persona::find()->all(), 'id', 'nombre_completo'),
        'language' => 'en',
        'options' => ['placeholder' => 'nombre ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
        //'pluginLoading'=>false,
    ])?>
    <div class="form-group">
        <?= Html::submitButton( 'Buscar', ['btn btn-primary']) ?>
    </div>
    <?php if($dataProvider!=NULL):?>
         
         <?=GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                   'fecha_creacion',
                   'nombre_documento',
                   [
                        'attribute' => 'direccion_archivo',
                        'format' => 'html',    
                        'value' => function ($data) {
                            return  Html::img($data->imageUrl,['width'=>'100','height'=>'100']);
                        },
                    ]

                    ]
                ])
        ?>
    <?php endif?>
    <br>
    

    <?php ActiveForm::end(); ?>


</div>