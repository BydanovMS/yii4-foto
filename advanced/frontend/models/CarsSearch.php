<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Cars;

/**
 * CarsSearch represents the model behind the search form about `frontend\models\Cars`.
 */
class CarsSearch extends Cars
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['car_id', 'car_sel_id', 'car_year'], 'integer'],
            [['car_manufacture', 'car_model', 'car_info'], 'safe'],
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
        $query = Cars::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'car_id' => $this->car_id,
            'car_sel_id' => $this->car_sel_id,
            'car_year' => $this->car_year,
        ]);

        $query->andFilterWhere(['like', 'car_manufacture', $this->car_manufacture])
            ->andFilterWhere(['like', 'car_model', $this->car_model])
            ->andFilterWhere(['like', 'car_info', $this->car_info]);

        return $dataProvider;
    }
}
