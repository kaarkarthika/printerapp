<?php

use yii\helpers\Html;
use backend\models\Product;
 require ('../../vendor/tcpdf/tcpdf.php');
		
		require ('../../vendor/tcpdf/tcpdf_barcodes_2d.php');
		
		 $batchno=$model->batchnumber;
		 $expdate=date("d/m/Y",strtotime($model->expiredate));
		 $brandcode=$model->stockmaster->brandcode;$totalqty=$model->total_no_of_quantity;
		 $pid=$model->stockmaster->productid;
		 $pdata=Product::find()->where(['productid'=>$pid])->one();
		$productname=$pdata->productname;
		$stockcode=$model->stockcode;
		 $adata=array("Batch No"=>$batchno,"Expiredate"=>$expdate,"Stock"=>$productname,"Brandcode"=>$brandcode,"Stock Code"=>$stockcode);
	   $qrcode=json_encode($adata);
	   
	   $barcodeobj=new TCPDF2DBarcode($qrcode, 'QRCODE,L', 633, 244, 1000, 2200, $style, 'J',true);
	   
	   
	   
	   $qrcode_view='<div>';
	   $qrcode_view.='<span >Batch No  : '.$batchno.'</span><br>';
	   $qrcode_view.='<span >Expire Date  : '.$expdate.'</span><br>';
	   $qrcode_view.='<span >Stock   :  '.$productname.'</span><br>';
	   $qrcode_view.='<span >Brand Code</span> : '.$brandcode.'</span><br>' ;
	   $qrcode_view.='<span >Stock Code</span> : '.$stockcode.'</span><br>' ;
	   $qrcode_view.= '</div>';
		$qr_data=  $barcodeobj->getBarcodeHTML("2","2");

?>
<style>
	@page {
    margin: 0;
}
</style>
<div style="height: 75px;border: 0px solid #000;width: 350px; ">
<div style="width: 80px;height: 75px;float: left;">
	<?php echo $qr_data;   ?>
</div>
<div style=" width: 250px;height: 75px;float: left;margin-left:0px;margin-top: 5px;font-size:12px;font-weight:bold;border:0px solid #000; ">
	<?php echo $qrcode_view;   ?>
</div>
</div><p style="page-break-before: always"><?php die;  ?>