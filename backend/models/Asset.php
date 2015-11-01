<?php

/**
 * Class Asset
 * @package common\models
 * @property string $_id MongoId
 * @property array $filename
 * @property string $uploadDate
 * @property string $length
 * @property string $chunkSize
 * @property string $md5
 * @property array $file
 * @property string $newFileContent
 * Must be application/pdf, image/png, image/gif etc...
 * @property string $contentType
 * @property string $description
 */
namespace backend\models;
use yii\mongodb\file\ActiveRecord;
class Asset extends ActiveRecord
{
 
    public static function collectionName()
    {
        return ['documentos','asset'];
    }
 
    public function rules()
    {
        return[
            [['description', 'contentType'], 'required'],
        ];
    }
 
    public function attributes()
    {
          return array_merge(
              parent::attributes(),
              ['contentType', 'description']
          );
    }
}