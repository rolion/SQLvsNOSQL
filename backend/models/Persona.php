<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "persona".
 *
 * @property integer $id
 * @property string $nombre_completo
 * @property string $pais
 * @property string $email
 *
 * @property Documento[] $documentos
 */
class Persona extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $selected;
    public static function tableName()
    {
        return 'persona';
    }
    public function getSelected(){
        return $this->selected;
    }
    public function setSelected($value){
        $this->selected=$value;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_completo', 'pais', 'email'], 'required'],
            [['nombre_completo', 'pais', 'email'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_completo' => 'Nombre Completo',
            'pais' => 'Pais',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documento::className(), ['id_persona' => 'id']);
    }
}
