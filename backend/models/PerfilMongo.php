<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for collection "PerfilMongo".
 *
 * @property \MongoId|string $_id
 * @property mixed $nombre_completo
 * @property mixed $pais
 * @property mixed $email
 */
class PerfilMongo extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['documentos', 'PerfilMongo'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'nombre_completo',
            'pais',
            'email',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_completo', 'pais', 'email'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'nombre_completo' => 'Nombre Completo',
            'pais' => 'Pais',
            'email' => 'Email',
        ];
    }
}
