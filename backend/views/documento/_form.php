<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Persona;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model backend\models\Documento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documento-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?> 
    <?= $form->field($model, 'nombre_documento')?>
    <?= FileInput::widget(
        [
        'model'=>$model,
        'attribute' => 'docFile',
        'options' => [
                    'accept' => 'image/*',
                    //'multiple' => true
            ],
        ]);
    ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
