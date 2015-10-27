<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "documento".
 *
 * @property integer $id
 * @property string $nombre_documento
 * @property string $fecha_creacion
 * @property resource $direccion_archivo
 * @property integer $id_persona
 *
 * @property Persona $idPersona
 */
class Documento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $docFile;
    public static function tableName()
    {
        return 'documento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'id_persona',], 'required'],
            [['fecha_creacion',], 'safe'],
            [['docFile'],'file'],
            [['direccion_archivo'], 'string'],
            [['id_persona'], 'integer'],
            [['nombre_documento'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_documento' => 'Nombre Documento',
            'fecha_creacion' => 'Fecha Creacion',
            'direccion_archivo' => 'Imagen',
            'id_persona' => 'Persona',
            'docFile'=>'Documento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPersona()
    {
        return $this->hasOne(Persona::className(), ['id' => 'id_persona']);
    }
    public function getImageUrl(){
        $path=Yii::$app->request->baseUrl.'/imagenes/'.$this->direccion_archivo;
        return $path;
    }
}
