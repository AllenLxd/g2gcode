<?php

namespace app\modules\product\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\product\models\Product;

/**
 * ProductSearch represents the model behind the search form about `app\modules\product\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'guarantee_time', 'labor_time'], 'integer'],
            [['name', 'pic', 'supply', 'video1', 'video2', 'video3', 'video4', 'content'], 'safe'],
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
        $query = Product::find();

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
            'id' => $this->id,
            'category_id' => $this->category_id,
            'guarantee_time' => $this->guarantee_time,
            'labor_time' => $this->labor_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'pic', $this->pic])
            ->andFilterWhere(['like', 'supply', $this->supply])
            ->andFilterWhere(['like', 'video1', $this->video1])
            ->andFilterWhere(['like', 'video2', $this->video2])
            ->andFilterWhere(['like', 'video3', $this->video3])
            ->andFilterWhere(['like', 'video4', $this->video4])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
