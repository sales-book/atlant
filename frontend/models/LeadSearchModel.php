<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\LeadModel;

/**
 * WorkoutsSearchModel represents the model behind the search form about `common\models\WorkoutsModel`.
 */
class LeadSearchModel extends LeadModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['StatusID'], 'integer'],
            [['StatusName', 'OrgName', 'Name', 'Phone', 'Email', 'City', 'Description',], 'safe'],
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
        $query = LeadModel::find()->orderBy('CreateDate DESC');

        // add conditions that should always apply here
        $query->joinWith(['statuses']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->pagination->pageSize = 50;
        $dataProvider->sort->attributes['StatusName'] = [
            'asc' => ['statuses.StatusName' => SORT_ASC],
            'desc' => ['statuses.StatusName' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'user_id' => Yii::$app->user->id,
        ]);
        $query->andFilterWhere(['like', 'OrgName', $this->OrgName]);
        $query->andFilterWhere(['like', 'Name', $this->Name]);
        $query->andFilterWhere(['like', 'Phone', $this->Phone]);
        $query->andFilterWhere(['like', 'Email', $this->Email]);
        $query->andFilterWhere(['like', 'City', $this->City]);
        $query->andFilterWhere(['like', 'Description', $this->Description]);
        $query->andFilterWhere(['like', 'StatusName', $this->StatusName]);

        return $dataProvider;
    }
}
