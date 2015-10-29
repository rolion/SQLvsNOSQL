<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PerfilMongo;

/**
 * PerfilMongoSearch represents the model behind the search form about `backend\models\PerfilMongo`.
 */
class PerfilMongoSearch extends PerfilMongo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_id', 'nombre_completo', 'pais', 'email'], 'safe'],
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
        $query = PerfilMongo::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', '_id', $this->_id])
            ->andFilterWhere(['like', 'nombre_completo', $this->nombre_completo])
            ->andFilterWhere(['like', 'pais', $this->pais])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
