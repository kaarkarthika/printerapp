<?php
namespace backend\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Product;
class ProductSearch extends Product
{
    public $stockcode;
    public function rules()
    {
        return [
            [['productid', 'is_active','manufacturer_id','maxstock','minstock','composition_id','gst'], 'integer'],
            [['productname','product_code','hsn_code', 'product_typeid', 'updatedby', 'updatedon', 'updated_ipaddress'], 'safe'],
           
        ];
    }
  
    public function scenarios()
    {
      
        return Model::scenarios();
    }
  
    public function search($params)
    {
        $query = Product::find();
		$query->joinWith(['taxgrouphsn']);
	//	$query->joinWith(['producttype']);
       // $dataProvider = new ActiveDataProvider([ 'query' => $query,'sort' => ['defaultOrder' => ['product_typeid' => SORT_ASC ]],'pagination' => [  'pageSize'=> isset(Yii::$app->params['defaultPageSize']) ? Yii::$app->params['defaultPageSize'] : 100 ]]);
        
      //  $dataProvider = new ActiveDataProvider([ 'query' => $query,'sort' => ['defaultOrder' => ['product_typeid' => SORT_ASC ]],'pagination' => [  'pageSize'=> 80 ]]);
          $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'productid' => $this->productid,
            'is_active' => $this->is_active,
            'hsn_code'=>$this->hsn_code,
            'gst'=>$this->gst,
        ]);

        $query->andFilterWhere(['like', 'productname', $this->productname])
           
            ->andFilterWhere([ 'product_typeid'=> $this->product_typeid])
			  ->andFilterWhere([ 'composition_id'=> $this->composition_id])
			  ->andFilterWhere([ 'manufacturer_id'=>$this->manufacturer_id])
			 ->andFilterWhere([ 'product_code'=>$this->product_code])
			 ->andFilterWhere([ 'tax'=>$this->taxgrouphsn->tax]);
			// echo $query->createCommand()->getRawSql();die;
        return $dataProvider;
    }
}