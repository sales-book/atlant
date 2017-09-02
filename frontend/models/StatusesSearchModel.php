<?php

namespace frontend\models\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StatusesModel;
use frontend\components\ModalListSearchModelInterface;

/**
 * StatusSearchModel represents the model behind the search form about `common\models\StatusModel`.
 */
class StatusesSearchModel extends StatusesModel implements ModalListSearchModelInterface
{

    public function getGridColumns()
    {
        return [
            ['class' => 'yii\grid\SerialColumn'],

            'recordName' => [
                'attribute' => self::$nameField,
            ],

            'GUID' => [
                'attribute' => self::$idField,
                'contentOptions' =>['style'=>'display:none;'],
                'filterOptions' =>['style'=>'display:none;'],
                'headerOptions' => ['style'=>'display:none;'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'Deleted'], 'integer'],
            [['StatusName'], 'safe'],
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
        $query = StatusesModel::find();

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
            'user_id' => $this->user_id,
            'CreateDate' => $this->CreateDate,
            'Deleted' => $this->Deleted,
        ]);

        $query->andFilterWhere(['like', 'StatusName', $this->StatusName]);

        return $dataProvider;
    }
}
