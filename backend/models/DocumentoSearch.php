<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Documento;

/**
 * DocumentoSearch represents the model behind the search form about `backend\models\Documento`.
 */
class DocumentoSearch extends Documento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_persona'], 'integer'],
            [['nombre_documento', 'fecha_creacion', 'direccion_archivo'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Documento::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                        'pageSize' => 100,
                    ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'fecha_creacion' => $this->fecha_creacion,
            'id_persona' => $this->id_persona,
        ]);

        $query->andFilterWhere(['like', 'nombre_documento', $this->nombre_documento])
            ->andFilterWhere(['like', 'direccion_archivo', $this->direccion_archivo]);

        return $dataProvider;
    }
}
