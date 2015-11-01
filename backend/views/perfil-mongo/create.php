<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PerfilMongo */

$this->title = 'Crear Persona Mongo';
$this->params['breadcrumbs'][] = ['label' => 'Perfil Mongos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perfil-mongo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
