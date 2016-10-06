<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Aneks;
use common\models\User;

/**
 * AneksSearch represents the model behind the search form about `\common\models\Aneks`.
 */
class AneksSearch extends Aneks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'category_id', 'is_visible'], 'integer'],
            [['text', 'user', 'image', 'publish_time'], 'safe'],
        ];
    }

    public function setUser($username)
    {
        if ($user = User::findByUsername($username))
        {
            $this->user_id = $user->id;
        }
        else
        {
            $this->user_id = null;
        }

        return true;
    }

    public function getUser()
    {
        if ($user = User::findOne($this->user_id))
        {
            return $user->username;
        }
        else
        {
            return null;
        }

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
        $query = Aneks::find()->with('user');

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
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'publish_time' => $this->publish_time,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
