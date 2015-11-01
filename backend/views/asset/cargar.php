<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model backend\models\Documento */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= FileInput::widget(
           [
           'model'=>$model,
           'attribute' => 'file[]',
           'options' => [
                       'accept' => 'image/*',
                       'multiple' => true
               ],
           ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton('Cargar', [ 'btn btn-success' ]) ?>
    </div>
<?php ActiveForm::end(); ?>