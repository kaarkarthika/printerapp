<?php

namespace backend\controllers;

use Yii;
use backend\models\SubVisit;
use backend\models\SubVisitSearch;
use backend\models\Newpatient;
use backend\models\UploadPicture;
use backend\models\Physicianmaster;
use backend\models\Insurance;
use backend\models\BranchAdmin;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use backend\models\Specialistdoctor;
use backend\models\PaymentType;
use backend\models\Patienttype;
use backend\models\Sales;
use backend\models\Saledetail;
use backend\models\LabPaymentPrime;
use backend\models\Product;
use backend\models\TaxgroupingLog;
/**
 * SubVisitController implements the CRUD actions for SubVisit model.
 */
class SubVisitController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SubVisit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SubVisitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionIndexdemo()
    {
        $searchModel = new SubVisitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexdemo', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SubVisit model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	
	public function actionUcilview($id)
    {
        return $this->renderAjax('ucilview', [
            'model' => $this->findModel($id),
        ]);
    }
	
	
	/*public function actionUpload($id)
    {
        $id=base64_decode(urldecode($id));
		
		$sub_visit=SubVisit::find()->where(['sub_id'=>$id])->asArray()->one();
		
		$upload_picture=UploadPicture::find()->where(['sub_id'=>$id])->one();
		
		if(empty($upload_picture))
		{
			$upload_picture=new UploadPicture();
		}	
			
		if($_POST)
		{
			$folder_name='SUBVISIT_'.$id;
            $path = 'uploads/subvisit/'.$folder_name;
          	$session = Yii::$app->session;
			if (file_exists($path))
			{
				FileHelper::removeDirectory($path);
				
				FileHelper::createDirectory($path);
				
				foreach($_FILES['UploadPicture']['name']['upload_picture'] as $key_file=>$onefile)
				{
					$file_name = preg_replace('/\s+/', '_', $_FILES['UploadPicture']['name']['upload_picture'][$key_file]);
				    $aa6 = $path.'/'.$file_name;
				
				    if(move_uploaded_file($_FILES['UploadPicture']['tmp_name']['upload_picture'][$key_file], $aa6))
					{
						$imgz[]=$file_name;	
						
					}
					else {
						print_r("Not Upload");
					}
				} 
				
				$img_path=json_encode($imgz);
				
				$upload_picture->pat_id =$sub_visit['pat_id'];
				$upload_picture->sub_id =$sub_visit['sub_id'];
				$upload_picture->mr_number =$sub_visit['mr_number'];
				$upload_picture->sub_visit =$sub_visit['sub_visit'];
				$upload_picture->upload_picture =$img_path;
				$upload_picture->created_at =date('Y-m-d H:i:s');
				$upload_picture->user_id = $session['user_id'];
				$upload_picture->updated_ipaddress = $_SERVER['REMOTE_ADDR'];
				if($upload_picture->save())
				{
					Yii::$app->getSession()->setFlash('success', 'Updated Successfully.');  
					return $this->redirect(['index']);
				}
				else {
					print_r($upload_picture->getErrors());die;
					
				}
				
				
			}
			else if (!is_dir($path)) 
            {
             	FileHelper::createDirectory($path);
				$imgz=array();
				foreach($_FILES['UploadPicture']['name']['upload_picture'] as $key_file=>$onefile)
				{
					$file_name = preg_replace('/\s+/', '_', $_FILES['UploadPicture']['name']['upload_picture'][$key_file]);
				    $aa6 = $path.'/'.$file_name;
				
				    if(move_uploaded_file($_FILES['UploadPicture']['tmp_name']['upload_picture'][$key_file], $aa6))
					{
						$imgz[]=$file_name;	
					}
					else {
						print_r("Not Upload");die;
					}
				}
	
				$img_path=json_encode($imgz);
				
				$upload_picture->pat_id =$sub_visit['pat_id'];
				$upload_picture->sub_id =$sub_visit['sub_id'];
				$upload_picture->mr_number =$sub_visit['mr_number'];
				$upload_picture->sub_visit =$sub_visit['sub_visit'];
				$upload_picture->upload_picture =$img_path;
				$upload_picture->created_at =date('Y-m-d H:i:s');
				$upload_picture->user_id = $session['user_id'];
				$upload_picture->updated_ipaddress = $_SERVER['REMOTE_ADDR'];
				if($upload_picture->save())
				{
					Yii::$app->getSession()->setFlash('success', 'Saved Successfully.');  
					return $this->redirect(['index']);
				}
				else {
					print_r($upload_picture->getErrors());die;
					
				} 	 
			}
		}	
		else {
			return $this->render('upload', [
            'model' => $this->findModel($id),
            'upload_picture' => $upload_picture,
        ]);	
		}
		 
    }
	*/
	
	
	public function actionUpload($id)
    {
        $id=base64_decode(urldecode($id));
		
		$sub_visit=SubVisit::find()->where(['sub_id'=>$id])->asArray()->one();
		
		$upload_picture=UploadPicture::find()->where(['sub_id'=>$id])->one();
		
		if(empty($upload_picture))
		{
			$upload_picture=new UploadPicture();
		}	
			
		if($_POST)
		{
			$folder_name='SUBVISIT_'.$id;
            $path = 'uploads/subvisit/'.$folder_name;
          	$session = Yii::$app->session;
			//echo '<pre>';
			//print_r($_FILES);die;
			if (file_exists($path))
			{
				FileHelper::removeDirectory($path);
				
				FileHelper::createDirectory($path);
				
				foreach($_FILES['upload_picture']['name'] as $key_file=>$onefile)
				{
					$file_name = preg_replace('/\s+/', '_', $_FILES['upload_picture']['name'][$key_file]);
				    $aa6 = $path.'/'.$file_name;
				
				    if(move_uploaded_file($_FILES['upload_picture']['tmp_name'][$key_file], $aa6))
					{
						$imgz[]=$file_name;	
						
					}
					else {
						print_r("Not Upload");
					}
				} 
				
				$img_path=json_encode($imgz);
				
				$upload_picture->pat_id =$sub_visit['pat_id'];
				$upload_picture->sub_id =$sub_visit['sub_id'];
				$upload_picture->mr_number =$sub_visit['mr_number'];
				$upload_picture->sub_visit =$sub_visit['sub_visit'];
				$upload_picture->upload_picture =$img_path;
				$upload_picture->created_at =date('Y-m-d H:i:s');
				$upload_picture->user_id = $session['user_id'];
				$upload_picture->updated_ipaddress = $_SERVER['REMOTE_ADDR'];
				if($upload_picture->save())
				{
					Yii::$app->getSession()->setFlash('success', 'Updated Successfully.');  
					return $this->redirect(['index']);
				}
				else {
					print_r($upload_picture->getErrors());die;
					
				}
				
				
			}
			else if (!is_dir($path)) 
            {
             	FileHelper::createDirectory($path);
				$imgz=array();
				foreach($_FILES['upload_picture']['name'] as $key_file=>$onefile)
				{
					$file_name = preg_replace('/\s+/', '_', $_FILES['upload_picture']['name'][$key_file]);
				    $aa6 = $path.'/'.$file_name;
				
				    if(move_uploaded_file($_FILES['upload_picture']['tmp_name'][$key_file], $aa6))
					{
						$imgz[]=$file_name;	
						
					}
					else {
						print_r("Not Upload");
					}
				}
			
				$img_path=json_encode($imgz);
				
				$upload_picture->pat_id =$sub_visit['pat_id'];
				$upload_picture->sub_id =$sub_visit['sub_id'];
				$upload_picture->mr_number =$sub_visit['mr_number'];
				$upload_picture->sub_visit =$sub_visit['sub_visit'];
				$upload_picture->upload_picture =$img_path;
				$upload_picture->created_at =date('Y-m-d H:i:s');
				$upload_picture->user_id = $session['user_id'];
				$upload_picture->updated_ipaddress = $_SERVER['REMOTE_ADDR'];
				if($upload_picture->save())
				{
					Yii::$app->getSession()->setFlash('success', 'Saved Successfully.');  
					return $this->redirect(['index']);
				}
				else {
					print_r($upload_picture->getErrors());die;
					
				} 	 
			}
		}	
		else {
			return $this->render('upload', [
            'model' => $this->findModel($id),
            'upload_picture' => $upload_picture,
        ]);	
		}
		 
    }
	
	
	public function actionTemporaryblock($id,$pat_id)
    {
    	$id=base64_decode(urldecode($id));
		$pat_id=base64_decode(urldecode($pat_id));
		$session = Yii::$app->session;
    	if($_POST)
		{
			$status=Newpatient::updateAll(['temporary_blocked' => 'Y','updated_ipaddress'=> $_SERVER['REMOTE_ADDR'],'user_role'=> $session['user_id']], ['patientid' => $pat_id]);
			if($status == 1)
			{
				return $this->redirect(['ucilindex']);
			}
		}  
		  
	}
	
	public function actionUnblock($id,$pat_id)
    {
    	$id=base64_decode(urldecode($id));
		$pat_id=base64_decode(urldecode($pat_id));
		$session = Yii::$app->session;
    	if($_POST)
		{
			$status=Newpatient::updateAll(['temporary_blocked' => 'N','updated_ipaddress'=> $_SERVER['REMOTE_ADDR'],'user_role'=> $session['user_id']], ['patientid' => $pat_id]);
			if($status == 1)
			{
				return $this->redirect(['ucilindex']);
			}
		}  
		  
	}
	
	
	public function actionUcilupdate($id,$pat_id)
    {
    	$id=base64_decode(urldecode($id));
		$pat_id=base64_decode(urldecode($pat_id));
    	
    	$sub_visit_name=SubVisit::find()->where(['sub_id'=>$id])->one();
		$patient_name=Newpatient::find()->where(['patientid'=>$pat_id])->one();
		$session = Yii::$app->session;
		
    	if($_POST)
		{
			
			$status=Newpatient::updateAll(['patientname' => $_POST['Newpatient']['patientname'],'pat_mobileno' => $_POST['Newpatient']['pat_mobileno'],'par_relationname' => $_POST['Newpatient']['par_relationname'],'updated_ipaddress'=> $_SERVER['REMOTE_ADDR'],'user_role'=> $session['user_id']], ['patientid' => $pat_id]);
		
			if($_POST['SubVisit']['ucil_letter_status'] == '1')
			{
				$sub_visit=SubVisit::updateAll(['ucil_letter_status' => 'YES','ucil_emp_id' => $_POST['SubVisit']['ucil_emp_id'],'patient_date'=>date('Y-m-d',strtotime($_POST['SubVisit']['patient_date'])),'ucil_date' => date('Y-m-d',strtotime($_POST['SubVisit']['ucil_date'])),'updated_ipaddress'=> $_SERVER['REMOTE_ADDR'],'user_id'=> $session['user_id'],'ucil_modified_date' => date('Y-m-d H:i:s')], ['sub_id' => $id]);
				if($sub_visit == '1')
				{
						return $this->redirect(['voucherreceiptpdf', 'id'=>$id,'target'=>'_blank']); 
					Yii::$app->getSession()->setFlash('success', 'UCIL Details Updated successfully.');  
					return $this->redirect(['ucilindex']);
				}
			}
			else if($_POST['SubVisit']['ucil_letter_status'] == '0')
			{
				
				
				Yii::$app->getSession()->setFlash('success', 'Patient Details Updated successfully.'); 
				Yii::$app->getSession()->setFlash('error', 'UCIL Details Not Updated.'); 
				return $this->redirect(['ucilindex']);
			}
				return $this->redirect(['voucherreceiptpdf', 'id'=>$id,'target'=>'_blank']);
		}
		else 
		{
			return $this->render('ucilupdatepage', [
            	'sub_visit_name' => $sub_visit_name,
            	'patient_name' => $patient_name,
        	]);
		}
	}
	

    /**
     * Creates a new SubVisit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SubVisit();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->sub_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SubVisit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->sub_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
	
	public function actionUcilindex()
    {
        
		$searchModel = new SubVisitSearch();
        $dataProvider = $searchModel->ucilsearch(Yii::$app->request->queryParams);

        return $this->render('ucilindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionVoucherreceiptpdf($id)
	{
	   if(is_numeric($id))
	   {
	   	  $id=$id;
	   }
	   else
	   {
	   	  $id=base64_decode(urldecode($id));
	   }	
		
		
		require ('../../vendor/tcpdf/tcpdf.php');
		$pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('Invoice');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setFontSubsetting(true);
		$pdf->SetFont('helvetica', '', 8, '', true);
		$pdf->SetMargins(10, false, 10, true); // set the margins 
		$pdf->AddPage();
		
		$subvisit=SubVisit::find()->where(['sub_id'=>$id])->one();
		
		
		if(!empty($subvisit))
		{
		
			
			$patientdata=Newpatient::find()->where(['patientid'=>$subvisit->pat_id])->one();
			
			$insurancelist=ArrayHelper::index(Insurance::find()->asArray()->all(), 'insurance_typeid');
			$physicianmaster=ArrayHelper::index(Physicianmaster::find()->asArray()->all(), 'id');
			$specialistdoctor=ArrayHelper::index(Specialistdoctor::find()->asArray()->all(), 's_id');
			$paymenttype=ArrayHelper::index(PaymentType::find()->asArray()->all(), 'payment_type_id');
			$patienttype=ArrayHelper::index(Patienttype::find()->asArray()->all(), 'type_id');	
			$userdata=BranchAdmin::find()->where(['ba_autoid'=>$subvisit->user_id])->one();
			
			if($subvisit['insurance_type'] == 1 && $subvisit['ucil_letter_status'] == 'YES')
			{
				$consultant_amount = (!empty($subvisit['due_amt'])) ? $subvisit['due_amt'] : '--NIL--';
			}
			else 
			{
				$consultant_amount = (!empty($subvisit['paid_amt'])) ? $subvisit['paid_amt'] : '--NIL--';
			}
			
			
			
			if($subvisit['insurance_type'] == 1 && $subvisit['ucil_letter_status'] == 'YES')
			{
					
				$issue_date=date_create(date('Y-m-d',strtotime($subvisit['created_at'])));
				date_add($issue_date,date_interval_create_from_date_string("10 days"));
				$expired_date=date_format($issue_date,"Y-m-d");
				
				
				
				
				$tbl1='<html>
				<head>
				</head>
				<body>	<div><h2 style="text-align:center;color:red;">DINESH MEDICAL CENTRE</h2>';
				$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">A Unit Of Carmel HealthCare PVT LTD</p>';
				$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">D.No.3-7-215/1,First Floor,Bakarapuram,Pulivendula-516390,Kadapa Dist,A.P</p>';
				$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">DL NO-20F:AP/11/03/2017-137691,21:Ap/11/03/2017-137690,20:AP/11/03/2017-137689</p>';
				$tbl1.='<p style="text-align:center;line-height:2px;font-size:12px;">TIN.NO :37141115904</p>';
				$tbl1.='<p style="border-top:1px solid #000;"></p>';
				$tbl1.='<p style="text-align:center;font-size:13px;font-weight:bold;"><u>ACKNOWLEDGEMENT SLIP</u></p>';
				$tbl1.='<table style="border:none;padding:2px 10px;font-size:12px;margin-top:250px;" ALIGN="left" ><tr><td style="width:15%;"><b>MR Number</b></td>';
				$tbl1.='<td style="width:35%;"> : '.$patientdata['mr_no'].' </td>';
				$tbl1.='<td style="width:23%;"><b> Register Date </b></td>';
				$tbl1.='<td style="width:35%;"> : '.date('d-m-Y H:i:A',strtotime($subvisit['created_at'])).'</td>';
				$tbl1.='</tr>';
				$tbl1.='<tr><td><b>Patient Name </b></td>';
				$tbl1.='<td> : '.$patientdata['pat_inital_name'].'. '.$patientdata['patientname'].' </td>';
				$tbl1.='<td><b> Reffer Issue</b></td>';
				$tbl1.='<td> : '.date('d-m-Y',strtotime($subvisit['ucil_date'])).'</td>';
				$tbl1.='</tr>';
				$tbl1.='<tr><td><b> UCIL ID</b></td>';
				$tbl1.='<td> : '.$subvisit['ucil_emp_id'].' </td>';
				$tbl1.='<td><b> Reffer Expired </b></td>';
				$tbl1.='<td> : '.date('d-m-Y',strtotime($expired_date)).'</td>';
				$tbl1.='</tr></table>';
				
				$tbl1.='<p></p><div style="text-align:center;font-size:16px;line-height:30px;text-transform: uppercase;"><span style="background-color: #aaa;border:1px solid #000;border:1px solid #000;padding:0 15px"><b>Valid for 10 Days</b></span></div>';
				
				$pdf->writeHTML($tbl1, true, false, false, false, '');
		 		$labincharge='Patient Signature';
				$verifiedby='Collection User Name';
				$pdf->SetXY(10,90,true);
				$pdf->Cell(100, 0, $labincharge, 0, 0);
    			$pdf->SetXY(160,90,true);
				$pdf->Cell(100, 0, $verifiedby, 0, 0);
	
				$tbl1.='</body></html>';
			}

			$pdf->Output('Acknowledgement.pdf');
		}
	}
	
	
	
	public function actionUcilreportstaff()
    {
    	if(Yii::$app->request->post())
		{
			ini_set('max_execution_time', 10000);
			$objPHPExcel = new \PHPExcel();
						
						
		$styleArray = array(
				    	'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 10,
				        'name'  => 'Calibri'
				    	));
				
				
								$styleArray5 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'ffe88c',
						        ),
						        ),
						      
						        
						        
								'alignment' => array(
				        'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
				        'wrap' => true
				    	),
						        
								
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);	
				
				
				
					$styleArray6 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'a9c9f1',
						        ),
						        ),
						     
						        
						        
								'alignment' => array(
				        'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
				       // 'wrap' => true
				    	),
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);
				
				
				$styleArray7 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'a9c9f1',
						        ),
						        ),
						        'borders' => array(
						        'outline' => array(
						            'style' => \PHPExcel_Style_Border::BORDER_DOTTED,
						            'color' => array('argb' => '000000'),
						        ), ),
						        
						         'alignment' => array(
            'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        ),
					
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);
				
				
				
				$styleArray8 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'a9c9f1',
						        ),
						        ),
						        'borders' => array(
						        'outline' => array(
						            'style' => \PHPExcel_Style_Border::BORDER_DOTTED,
						            'color' => array('argb' => '000000'),
						        ), ),
						        
						         'alignment' => array(
            'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        ),
					
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);
				
				
	$styleCalibri = array(
				   	'font'  => array(
				       // 'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 10,
				        'name'  => 'Calibri'
				    	),
				    	
					
						        
									'alignment' => array(
				      //  'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				       'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
				        'wrap' => true
				    	),
						        
						  	);	
				
				
				
							$styledotted = array(
				  
						 'borders' => array(
						        'outline' => array(
						            'style' => \PHPExcel_Style_Border::BORDER_DOTTED,
						            'color' => array('argb' => '000000'),
						        ), ),
						        
									'alignment' => array(
				        'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				       //'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
				        'wrap' => true
				    	),
						        
						  	);
							
							
							$styleArray8 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'f78f8f',
						        ),
						        ),
						   
					
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);
					
					
					
						
							$styleArray9 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => '00FF00',
						        ),
						        ),
						   
					
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);
				
				
				$styleArray10 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'FF6347',
						        ),
						        ),
						   
					
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);
					
					
							
							$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
							$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
							
						$sheet = 0;
						$session = Yii::$app->session;
						$objPHPExcel -> setActiveSheetIndex($sheet);
						$objPHPExcel -> getActiveSheet() -> setTitle("UCIL STATUS REPORT")	
						-> setCellValue('A1', 'SNO')
						-> setCellValue('B1', 'PATIENT NAME')
						-> setCellValue('C1', 'EMPLOYEE ID')
						-> setCellValue('D1', 'CELL NO')
						-> setCellValue('E1', 'RELATIVE NAME')
						-> setCellValue('F1', 'UCIL SUBMIT DATE');
						
						
						
						
						
						$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArray7);
						
						//Date 
						$from_date=date('Y-m-d',strtotime(Yii::$app->request->post('fromDate')));
						$to_date=date('Y-m-d',strtotime(Yii::$app->request->post('toDate')));;
						
						
						
						
						$all_post_key = array("SNO","PATIENT_NAME", "EMPLOYEE_ID", "CELL_NO","RELATIVE_NAME","UCIL_SUBMIT_DATE");
						
						$slno=1;
						
						
						$row = 2;
						
						//UCIL STATUS YES
						
						$sub_visit=SubVisit::find()->where(['ucil_letter_status' => 'YES'])->andWhere(['refund_status'=>'NO'])->andWhere(['BETWEEN','ucil_modified_date',$from_date.' 00:00:00',$to_date.' 23:59:59'])->orderBy(['ucil_modified_date'=>SORT_ASC])->asArray()->all();
		
						$sub_visit_group=SubVisit::find()->select(['ucil_letter_status'=>'COUNT(ucil_letter_status)'])->where(['ucil_letter_status' => 'YES'])->andWhere(['refund_status'=>'NO'])->andWhere(['BETWEEN','ucil_modified_date',$from_date.' 00:00:00',$to_date.' 23:59:59'])->orderBy(['ucil_modified_date'=>SORT_ASC])->groupBy(['date(ucil_modified_date)'])->all();
						
						$sub_visit_group_all=SubVisit::find()->select(['ucil_letter_status'=>'COUNT(ucil_letter_status)'])->where(['ucil_letter_status' => 'YES'])->andWhere(['refund_status'=>'NO'])->andWhere(['BETWEEN','ucil_modified_date',$from_date.' 00:00:00',$to_date.' 23:59:59'])->orderBy(['ucil_modified_date'=>SORT_ASC])->groupBy(['ucil_letter_status'])->one();
					
						
						$inc1=0;
						
						$start_date=date('Y-m-d',strtotime($sub_visit[0]['ucil_modified_date']));
						
						
						
						//Patient Mapping
						$newpetient_map=ArrayHelper::map($sub_visit,'sub_id','pat_id');
						$newpetient=Newpatient::find()->where(['IN','patientid',$newpetient_map])->asArray()->all();
						$newpetient_index=ArrayHelper::index($newpetient,'patientid');
						
						//Physician Name
						$physicianmaster_map=ArrayHelper::map($sub_visit,'sub_id','consultant_doctor');
						$physicianmaster=Physicianmaster::find()->where(['IN','id',$physicianmaster_map])->asArray()->all();
						$physicianmaster_index=ArrayHelper::index($physicianmaster,'id');
						
						//INSURANCE TYPE
						$insurance_map=ArrayHelper::map($sub_visit,'sub_id','insurance_type');
						$insurance=Insurance::find()->where(['IN','insurance_typeid',$insurance_map])->asArray()->all();
						$insurance_index=ArrayHelper::index($insurance,'insurance_typeid');
						
						$user_map=ArrayHelper::map($sub_visit,'sub_id','user_id');
						$usernames=BranchAdmin::find()->where(['IN','ba_autoid',$user_map])->asArray()->all();
						$dataJobMaster = ArrayHelper::index($usernames,'ba_autoid');
							if(!empty($sub_visit))
							{					
							foreach($sub_visit as $key => $one_data)
							{
								$r_a=65;$r_a1=64;
								
								
								$ucil_emp_id=(isset($one_data['ucil_emp_id'])) ? $one_data['ucil_emp_id'] : '';
								$patientname=(isset($newpetient_index[$one_data['pat_id']]['patientname'])) ? $newpetient_index[$one_data['pat_id']]['patientname'] : '';
								$phone_number=(isset($newpetient_index[$one_data['pat_id']]['pat_mobileno'])) ? $newpetient_index[$one_data['pat_id']]['pat_mobileno'] : '';
								$relative_name=(isset($newpetient_index[$one_data['pat_id']]['par_relationname'])) ? $newpetient_index[$one_data['pat_id']]['par_relationname'] : '';
								$ucil_submit_date=(isset($one_data['ucil_modified_date'])) ? date('d-m-Y H:i:s',strtotime($one_data['ucil_modified_date'])) : '';
								
								if($start_date == date('Y-m-d',strtotime($one_data['ucil_modified_date'])))
								{
									foreach($all_post_key as $one_field)
									{
										$cell_char=chr($r_a);
										
										
										
										
										if($r_a1>=65)
										{
											$cell_char=chr($r_a1).chr($r_a);	
										}
										
										if($one_field=="SNO")
										{
											$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $slno);
											$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else
										{
											if($one_field=="PATIENT_NAME")
		    				 				{
		    				 					$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $patientname);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="EMPLOYEE_ID") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $ucil_emp_id);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="CELL_NO") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $phone_number);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="RELATIVE_NAME") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $relative_name);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="RELATIVE_NAME") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $relative_name);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="UCIL_SUBMIT_DATE") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $ucil_submit_date);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
										
										
										}
										if($r_a>=90)
										{
											$r_a=64;
											$r_a1++;					
										}
										$r_a++;
									}
								}
								else if($start_date != date('Y-m-d',strtotime($one_data['ucil_modified_date'])))
								{
									
									$start_date=date('Y-m-d',strtotime($one_data['ucil_modified_date']));
									
									$objPHPExcel -> getActiveSheet() -> setCellValue('A'  . $row, 'Total');
									$objPHPExcel -> getActiveSheet() -> setCellValue('B' . $row, $sub_visit_group[$inc1]['ucil_letter_status']);
									$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':'.'F' . $row)->applyFromArray($styleArray5);
									
									
									$inc1++;
									$row++;
									foreach($all_post_key as $one_field)
									{
										$cell_char=chr($r_a);
										
										
										
										if($r_a1>=65)
										{
											$cell_char=chr($r_a1).chr($r_a);	
										}
										
										if($one_field=="SNO")
										{
											$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $slno);
											$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else
										{
											if($one_field=="PATIENT_NAME")
		    				 				{
		    				 					$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $patientname);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="EMPLOYEE_ID") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $ucil_emp_id);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="CELL_NO") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $phone_number);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="RELATIVE_NAME") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $relative_name);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="UCIL_SUBMIT_DATE") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $ucil_submit_date);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
										}
										if($r_a>=90)
										{
											$r_a=64;
											$r_a1++;					
										}
										$r_a++;
									}
								}
								
								
								$slno++;			
								$row++;
							
							}	
												
										$objPHPExcel -> getActiveSheet() -> setCellValue('A'  . $row, 'Total');
										$objPHPExcel -> getActiveSheet() -> setCellValue('B' . $row, $sub_visit_group[$inc1]['ucil_letter_status']);
										$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':'.'F' . $row)->applyFromArray($styleArray5);
										
										$row++;
										$objPHPExcel -> getActiveSheet() -> setCellValue('A'  . $row, 'Grant Total');
										$objPHPExcel -> getActiveSheet() -> setCellValue('B' . $row, $sub_visit_group_all['ucil_letter_status']);
										$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':'.'F' . $row)->applyFromArray($styleArray8);
										
										$row++;
										$objPHPExcel -> getActiveSheet() -> setCellValue('A'  . $row, 'OverAll Total');
										$objPHPExcel -> getActiveSheet() -> setCellValue('B' . $row, $sub_visit_overall['ucil_letter_status']);
										$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':'.'F' . $row)->applyFromArray($styleArray10);
										
										$row++;$row++;$row++;
							}

								$sub_visit=SubVisit::find()->select(['user_id'=>'user_id','ucil_letter_status'=>'COUNT(ucil_letter_status)'])->where(['ucil_letter_status' => 'YES'])->andWhere(['refund_status'=>'NO'])->andWhere(['BETWEEN','ucil_modified_date',$from_date.' 00:00:00',$to_date.' 23:59:59'])->orderBy(['ucil_modified_date'=>SORT_ASC])->groupBy(['user_id'])->all();
										$user_map=ArrayHelper::map($sub_visit,'user_id','user_id');
										$usernames=BranchAdmin::find()->where(['IN','ba_autoid',$user_map])->asArray()->all();
										
										$dataJobMaster = ArrayHelper::index($usernames,'ba_autoid');
										$all_post_key = array("SNO","MR_NUMBER","FROM_DATE","TO_DATE");
								if(!empty($sub_visit))
								{
									
								
										$objPHPExcel -> getActiveSheet() -> setCellValue('A'.$row, 'USERWISE REFFERAL LETTER COLLECTION');
										$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':'.'C'.$row);
										
										$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':'.'L' . $row)->applyFromArray($styleArray7);
										$row++;
										$objPHPExcel -> getActiveSheet() -> setCellValue('A'  . $row, 'USERNAME');
										$objPHPExcel -> getActiveSheet() -> setCellValue('B' . $row, 'COLLECTION');
										$objPHPExcel -> getActiveSheet() -> setCellValue('C' . $row, 'FROM DATE');
										$objPHPExcel -> getActiveSheet() -> setCellValue('D' . $row, 'TO DATE');
										$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':'.'D' . $row)->applyFromArray($styleArray8);
										$row++;
										//echo '<pre>';
										
										//echo '<pre>';
										//print_r($dataJobMaster);die;
										foreach ($sub_visit as  $value) 
										{
											foreach($all_post_key as $one_field)
											{
												
												$r_a=65;$r_a1=64;
												$cell_char=chr($r_a);
												//
												if($r_a1>=65)
												{
													$cell_char=chr($r_a1).chr($r_a);	
												}
												if($one_field == 'SNO')
												{
													$objPHPExcel -> getActiveSheet() -> setCellValue('A' . $row, $dataJobMaster[$value['user_id']]['ba_name']);
													$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												}
												else 
												{
														
													if ($one_field == 'MR_NUMBER') 
													{
														$objPHPExcel -> getActiveSheet() -> setCellValue('B' . $row, $value['ucil_letter_status']);
														$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
													}
													else if($one_field == 'FROM_DATE')
													{
														$objPHPExcel -> getActiveSheet() -> setCellValue('C' . $row, date('d-m-Y',strtotime($from_date)));
														$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
													}
													else if($one_field == 'TO_DATE')
													{
														$objPHPExcel -> getActiveSheet() -> setCellValue('D' . $row, date('d-m-Y',strtotime($to_date)));
														$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
													}
												}
												
												
												if($r_a>=90)
												{
													$r_a=64;
													$r_a1++;					
												}
												$r_a++;
											}
											$row++;
										}
										}
				
						
						
						$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
						header('Content-Type: application/vnd.ms-excel');
				        $filename = "UCIL_STATUS_REPORT".date("d-m-Y-H:i:s").".xls";
				        header('Content-Disposition: attachment;filename='.$filename .' ');
				        header('Cache-Control: max-age=0');		
						$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				        $objWriter->save('php://output'); 
						die;
	}
	}
	
	
	public function actionUcilreport()
    {
        
		if(Yii::$app->request->post())
		{
			ini_set('max_execution_time', 10000);
			$objPHPExcel = new \PHPExcel();
						
						
		$styleArray = array(
				    	'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 10,
				        'name'  => 'Calibri'
				    	));
				
				
								$styleArray5 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'ffe88c',
						        ),
						        ),
						      
						        
						        
								'alignment' => array(
				        'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
				        'wrap' => true
				    	),
						        
								
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);	
				
				
				
					$styleArray6 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'a9c9f1',
						        ),
						        ),
						     
						        
						        
								'alignment' => array(
				        'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
				       // 'wrap' => true
				    	),
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);
				
				
				$styleArray7 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'a9c9f1',
						        ),
						        ),
						        'borders' => array(
						        'outline' => array(
						            'style' => \PHPExcel_Style_Border::BORDER_DOTTED,
						            'color' => array('argb' => '000000'),
						        ), ),
						        
						         'alignment' => array(
            'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        ),
					
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);
				
				
				
				$styleArray8 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'a9c9f1',
						        ),
						        ),
						        'borders' => array(
						        'outline' => array(
						            'style' => \PHPExcel_Style_Border::BORDER_DOTTED,
						            'color' => array('argb' => '000000'),
						        ), ),
						        
						         'alignment' => array(
            'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        ),
					
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);
				
				
	$styleCalibri = array(
				   	'font'  => array(
				       // 'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 10,
				        'name'  => 'Calibri'
				    	),
				    	
					
						        
									'alignment' => array(
				      //  'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				       'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
				        'wrap' => true
				    	),
						        
						  	);	
				
				
				
							$styledotted = array(
				  
						 'borders' => array(
						        'outline' => array(
						            'style' => \PHPExcel_Style_Border::BORDER_DOTTED,
						            'color' => array('argb' => '000000'),
						        ), ),
						        
									'alignment' => array(
				        'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				       //'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
				        'wrap' => true
				    	),
						        
						  	);
							
							
							$styleArray8 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'f78f8f',
						        ),
						        ),
						   
					
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);
					
					
					
						
							$styleArray9 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => '00FF00',
						        ),
						        ),
						   
					
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);
				
				
				$styleArray10 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'FF6347',
						        ),
						        ),
						   
					
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);
					
					
							
							$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
							$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
							$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
							$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(35);
							$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
							$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
							$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
							//$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
							
						$sheet = 0;
						$session = Yii::$app->session;
						$objPHPExcel -> setActiveSheetIndex($sheet);
						$objPHPExcel -> getActiveSheet() -> setTitle("UCIL STATUS REPORT")	
						-> setCellValue('A1', 'SNO')
						-> setCellValue('B1', 'MR NUMBER')
						-> setCellValue('C1', 'SUB-VISIT')
						-> setCellValue('D1', 'UCIL ID')
						-> setCellValue('E1', 'REGISTER PERSON')
						-> setCellValue('F1', 'PATIENT NAME')
						//-> setCellValue('F1', 'GENDER')
						//-> setCellValue('G1', 'AGE')
						//-> setCellValue('H1', 'MARTIAL')
						
						-> setCellValue('G1', 'PHONE NUMBER')
						-> setCellValue('H1', 'RELATIVE NAME')
						-> setCellValue('I1', 'REGISTER DATE AND TIME')
						-> setCellValue('J1', 'ISSUE DATE')
						-> setCellValue('K1', 'STATUS')
						//-> setCellValue('K1', 'DOCTOR NAME')
						
						-> setCellValue('L1', 'INSURANCE TYPE');
						
						
						
						$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($styleArray7);
						
						//Date 
						$from_date=date('Y-m-d',strtotime(Yii::$app->request->post('fromDate')));
						$to_date=date('Y-m-d',strtotime(Yii::$app->request->post('toDate')));;
						
						//SUB_VISIT
						$sub_visit=SubVisit::find()->where(['ucil_letter_status' => 'NO'])->andWhere(['refund_status'=>'NO'])->andWhere(['BETWEEN','created_at',$from_date.' 00:00:00',$to_date.' 23:59:59'])->orderBy(['created_at'=>SORT_ASC])->asArray()->all();
						
						
						$sub_visit_group=SubVisit::find()->select(['ucil_letter_status'=>'COUNT(ucil_letter_status)'])->where(['ucil_letter_status' => 'NO'])->andWhere(['refund_status'=>'NO'])->andWhere(['BETWEEN','created_at',$from_date.' 00:00:00',$to_date.' 23:59:59'])->orderBy(['created_at'=>SORT_ASC])->groupBy(['date(created_at)'])->all();
						
						$sub_visit_group_all=SubVisit::find()->select(['ucil_letter_status'=>'COUNT(ucil_letter_status)'])->where(['ucil_letter_status' => 'NO'])->andWhere(['refund_status'=>'NO'])->andWhere(['BETWEEN','created_at',$from_date.' 00:00:00',$to_date.' 23:59:59'])->orderBy(['created_at'=>SORT_ASC])->groupBy(['ucil_letter_status'])->one();
						
						$sub_visit_overall=SubVisit::find()->select(['ucil_letter_status'=>'COUNT(ucil_letter_status)'])->where(['ucil_letter_status' => ['NO','YES']])->andWhere(['refund_status'=>'NO'])->andWhere(['BETWEEN','created_at',$from_date.' 00:00:00',$to_date.' 23:59:59'])->orderBy(['created_at'=>SORT_ASC])->one();
						
						$inc=0;
						
						$start_date=date('Y-m-d',strtotime($sub_visit[0]['created_at']));
						
						
						
						//Patient Mapping
						$newpetient_map=ArrayHelper::map($sub_visit,'sub_id','pat_id');
						$newpetient=Newpatient::find()->where(['IN','patientid',$newpetient_map])->asArray()->all();
						$newpetient_index=ArrayHelper::index($newpetient,'patientid');
						
						//Physician Name
						$physicianmaster_map=ArrayHelper::map($sub_visit,'sub_id','consultant_doctor');
						$physicianmaster=Physicianmaster::find()->where(['IN','id',$physicianmaster_map])->asArray()->all();
						$physicianmaster_index=ArrayHelper::index($physicianmaster,'id');
						
						//INSURANCE TYPE
						$insurance_map=ArrayHelper::map($sub_visit,'sub_id','insurance_type');
						$insurance=Insurance::find()->where(['IN','insurance_typeid',$insurance_map])->asArray()->all();
						$insurance_index=ArrayHelper::index($insurance,'insurance_typeid');
						
						$user_map=ArrayHelper::map($sub_visit,'sub_id','user_id');
						$usernames=BranchAdmin::find()->where(['IN','ba_autoid',$user_map])->asArray()->all();
						$dataJobMaster = ArrayHelper::index($usernames,'ba_autoid');
						
						
						$all_post_key = array("SNO","MR_NUMBER", "SUB-VISIT", "UCIL_ID","REGISTER_PERSON", "PATIENT_NAME",  "PHONE_NUMBER", "RELATIVE_NAME","REGISTER_DATE_AND_TIME","ISSUE_DATE","STATUS","INSURANCE_TYPE");
						
						$slno=1;
						
						
						$row = 2;
						if(!empty($sub_visit))
						{
						$row++;
						
						
						$objPHPExcel -> getActiveSheet() -> setCellValue('A2', 'UCIL STATUS: NO');
						$objPHPExcel->getActiveSheet()->getStyle('A2'.':'.'L2')->applyFromArray($styleArray9);
						
						
						
							foreach($sub_visit as $key => $one_data)
							{
								$r_a=65;$r_a1=64;
								
								
								$mr_number=(isset($one_data['mr_number'])) ? $one_data['mr_number'] : '';
								$sub_visit=(isset($one_data['sub_visit'])) ? $one_data['sub_visit'] : '';
								$ucil_emp_id=(isset($one_data['ucil_emp_id'])) ? $one_data['ucil_emp_id'] : '';
								$patientname=(isset($newpetient_index[$one_data['pat_id']]['patientname'])) ? $newpetient_index[$one_data['pat_id']]['patientname'] : '';
								//$gender=(isset($newpetient_index[$one_data['pat_id']]['pat_sex'])) ? $newpetient_index[$one_data['pat_id']]['pat_sex'] : '';
								//$age=(isset($newpetient_index[$one_data['pat_id']]['dob'])) ? $this->Getage($newpetient_index[$one_data['pat_id']]['dob']) : '';
								//$martial=(isset($newpetient_index[$one_data['pat_id']]['pat_marital_status'])) ? $newpetient_index[$one_data['pat_id']]['pat_marital_status'] : '';
								$phone_number=(isset($newpetient_index[$one_data['pat_id']]['pat_mobileno'])) ? $newpetient_index[$one_data['pat_id']]['pat_mobileno'] : '';
								$relative_name=(isset($newpetient_index[$one_data['pat_id']]['par_relationname'])) ? $newpetient_index[$one_data['pat_id']]['par_relationname'] : '';
								$register_date_time=(isset($one_data['created_at'])) ? date('d-m-Y H:i:s',strtotime($one_data['created_at'])) : '';
								$issue_date=(isset($one_data['ucil_date']) && ($one_data['ucil_date'] != '1970-01-01')) ? date('d-m-Y',strtotime($one_data['ucil_date'])) : '-';
								$ucil_status=(isset($one_data['ucil_letter_status'])) ? $one_data['ucil_letter_status'] : '';
								//$physician_name=(isset($physicianmaster_index[$one_data['consultant_doctor']]['physician_name'])) ? $physicianmaster_index[$one_data['consultant_doctor']]['physician_name'] : '';
								$insurance_name=(isset($insurance_index[$one_data['insurance_type']]['insurance_type'])) ? $insurance_index[$one_data['insurance_type']]['insurance_type'] : '';
								$register_name=(isset($dataJobMaster[$one_data['user_id']]['ba_name'])) ? $dataJobMaster[$one_data['user_id']]['ba_name'] : '';
								
								if($start_date == date('Y-m-d',strtotime($one_data['created_at'])))
								{
									foreach($all_post_key as $one_field)
									{
										$cell_char=chr($r_a);
										
										
										
										
										if($r_a1>=65)
										{
											$cell_char=chr($r_a1).chr($r_a);	
										}
										
										if($one_field=="SNO")
										{
											$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $slno);
											$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else
										{
											if($one_field=="MR_NUMBER")
		    				 				{
		    				 					$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $mr_number);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="SUB-VISIT") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $sub_visit);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="UCIL_ID") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $ucil_emp_id);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="REGISTER_PERSON") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $register_name);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="PATIENT_NAME") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $patientname);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
										
											elseif ($one_field=="PHONE_NUMBER") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $phone_number);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="RELATIVE_NAME") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $relative_name);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="REGISTER_DATE_AND_TIME") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $register_date_time);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="ISSUE_DATE") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $issue_date);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="STATUS") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $ucil_status);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											
											elseif ($one_field=="INSURANCE_TYPE") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $insurance_name);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											
										}
										if($r_a>=90)
										{
											$r_a=64;
											$r_a1++;					
										}
										$r_a++;
									}
								}
								else if($start_date != date('Y-m-d',strtotime($one_data['created_at'])))
								{
									
									$start_date=date('Y-m-d',strtotime($one_data['created_at']));
									
									$objPHPExcel -> getActiveSheet() -> setCellValue('A'  . $row, 'Total');
									$objPHPExcel -> getActiveSheet() -> setCellValue('B' . $row, $sub_visit_group[$inc]['ucil_letter_status']);
									$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':'.'L' . $row)->applyFromArray($styleArray5);
									
									
									$inc++;
									$row++;
									foreach($all_post_key as $one_field)
									{
										$cell_char=chr($r_a);
										
										
										
										if($r_a1>=65)
										{
											$cell_char=chr($r_a1).chr($r_a);	
										}
										
										if($one_field=="SNO")
										{
											$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $slno);
											$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else
										{
											if($one_field=="MR_NUMBER")
		    				 				{
		    				 					$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $mr_number);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="SUB-VISIT") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $sub_visit);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="UCIL_ID") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $ucil_emp_id);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="REGISTER_PERSON") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $register_name);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="PATIENT_NAME") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $patientname);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
										
											elseif ($one_field=="PHONE_NUMBER") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $phone_number);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="RELATIVE_NAME") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $relative_name);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="REGISTER_DATE_AND_TIME") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $register_date_time);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="ISSUE_DATE") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $issue_date);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="STATUS") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $ucil_status);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											
											elseif ($one_field=="INSURANCE_TYPE") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $insurance_name);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											
										}
										if($r_a>=90)
										{
											$r_a=64;
											$r_a1++;					
										}
										$r_a++;
									}
								}
								
								
								$slno++;			
								$row++;
							
							}

												$objPHPExcel -> getActiveSheet() -> setCellValue('A'  . $row, 'Total');
												$objPHPExcel -> getActiveSheet() -> setCellValue('B' . $row, $sub_visit_group[$inc]['ucil_letter_status']);
												$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':'.'L' . $row)->applyFromArray($styleArray5);
												
												$row++;
												$objPHPExcel -> getActiveSheet() -> setCellValue('A'  . $row, 'Grant Total');
												$objPHPExcel -> getActiveSheet() -> setCellValue('B' . $row, $sub_visit_group_all['ucil_letter_status']);
												$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':'.'L' . $row)->applyFromArray($styleArray8);
												
												$row++;
												
							}
												$objPHPExcel -> getActiveSheet() -> setCellValue('A'.$row, 'UCIL STATUS: YES');
												$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':'.'L'.$row)->applyFromArray($styleArray9);
												$row++;
												//UCIL STATUS YES
												
												$sub_visit=SubVisit::find()->where(['ucil_letter_status' => 'YES'])->andWhere(['refund_status'=>'NO'])->andWhere(['BETWEEN','created_at',$from_date.' 00:00:00',$to_date.' 23:59:59'])->orderBy(['created_at'=>SORT_ASC])->asArray()->all();
								
										
												$sub_visit_group=SubVisit::find()->select(['ucil_letter_status'=>'COUNT(ucil_letter_status)'])->where(['ucil_letter_status' => 'YES'])->andWhere(['refund_status'=>'NO'])->andWhere(['BETWEEN','created_at',$from_date.' 00:00:00',$to_date.' 23:59:59'])->orderBy(['created_at'=>SORT_ASC])->groupBy(['date(created_at)'])->all();
												//echo '<pre>';
												//print_r($sub_visit_group);die;
												$sub_visit_group_all=SubVisit::find()->select(['ucil_letter_status'=>'COUNT(ucil_letter_status)'])->where(['ucil_letter_status' => 'YES'])->andWhere(['refund_status'=>'NO'])->andWhere(['BETWEEN','created_at',$from_date.' 00:00:00',$to_date.' 23:59:59'])->orderBy(['created_at'=>SORT_ASC])->groupBy(['ucil_letter_status'])->one();
											
												
												$inc1=0;
												
												$start_date=date('Y-m-d',strtotime($sub_visit[0]['created_at']));
												
												
												
												//Patient Mapping
												$newpetient_map=ArrayHelper::map($sub_visit,'sub_id','pat_id');
												$newpetient=Newpatient::find()->where(['IN','patientid',$newpetient_map])->asArray()->all();
												$newpetient_index=ArrayHelper::index($newpetient,'patientid');
												
												//Physician Name
												$physicianmaster_map=ArrayHelper::map($sub_visit,'sub_id','consultant_doctor');
												$physicianmaster=Physicianmaster::find()->where(['IN','id',$physicianmaster_map])->asArray()->all();
												$physicianmaster_index=ArrayHelper::index($physicianmaster,'id');
												
												//INSURANCE TYPE
												$insurance_map=ArrayHelper::map($sub_visit,'sub_id','insurance_type');
												$insurance=Insurance::find()->where(['IN','insurance_typeid',$insurance_map])->asArray()->all();
												$insurance_index=ArrayHelper::index($insurance,'insurance_typeid');
												
												$user_map=ArrayHelper::map($sub_visit,'sub_id','user_id');
												$usernames=BranchAdmin::find()->where(['IN','ba_autoid',$user_map])->asArray()->all();
												$dataJobMaster = ArrayHelper::index($usernames,'ba_autoid');
							if(!empty($sub_visit))
							{					
							foreach($sub_visit as $key => $one_data)
							{
								$r_a=65;$r_a1=64;
								
								
								$mr_number=(isset($one_data['mr_number'])) ? $one_data['mr_number'] : '';
								$sub_visit=(isset($one_data['sub_visit'])) ? $one_data['sub_visit'] : '';
								$ucil_emp_id=(isset($one_data['ucil_emp_id'])) ? $one_data['ucil_emp_id'] : '';
								$patientname=(isset($newpetient_index[$one_data['pat_id']]['patientname'])) ? $newpetient_index[$one_data['pat_id']]['patientname'] : '';
								//$gender=(isset($newpetient_index[$one_data['pat_id']]['pat_sex'])) ? $newpetient_index[$one_data['pat_id']]['pat_sex'] : '';
								//$age=(isset($newpetient_index[$one_data['pat_id']]['dob'])) ? $this->Getage($newpetient_index[$one_data['pat_id']]['dob']) : '';
								//$martial=(isset($newpetient_index[$one_data['pat_id']]['pat_marital_status'])) ? $newpetient_index[$one_data['pat_id']]['pat_marital_status'] : '';
								$phone_number=(isset($newpetient_index[$one_data['pat_id']]['pat_mobileno'])) ? $newpetient_index[$one_data['pat_id']]['pat_mobileno'] : '';
								$relative_name=(isset($newpetient_index[$one_data['pat_id']]['par_relationname'])) ? $newpetient_index[$one_data['pat_id']]['par_relationname'] : '';
								$register_date_time=(isset($one_data['created_at'])) ? date('d-m-Y H:i:s',strtotime($one_data['created_at'])) : '';
								$issue_date=(isset($one_data['ucil_date']) && ($one_data['ucil_date'] != '1970-01-01')) ? date('d-m-Y',strtotime($one_data['ucil_date'])) : '-';
								$ucil_status=(isset($one_data['ucil_letter_status'])) ? $one_data['ucil_letter_status'] : '';
								//$physician_name=(isset($physicianmaster_index[$one_data['consultant_doctor']]['physician_name'])) ? $physicianmaster_index[$one_data['consultant_doctor']]['physician_name'] : '';
								$insurance_name=(isset($insurance_index[$one_data['insurance_type']]['insurance_type'])) ? $insurance_index[$one_data['insurance_type']]['insurance_type'] : '';
								$register_name=(isset($dataJobMaster[$one_data['user_id']]['ba_name'])) ? $dataJobMaster[$one_data['user_id']]['ba_name'] : '';
								
								if($start_date == date('Y-m-d',strtotime($one_data['created_at'])))
								{
									foreach($all_post_key as $one_field)
									{
										$cell_char=chr($r_a);
										
										
										
										
										if($r_a1>=65)
										{
											$cell_char=chr($r_a1).chr($r_a);	
										}
										
										if($one_field=="SNO")
										{
											$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $slno);
											$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else
										{
											if($one_field=="MR_NUMBER")
		    				 				{
		    				 					$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $mr_number);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="SUB-VISIT") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $sub_visit);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="UCIL_ID") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $ucil_emp_id);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="REGISTER_PERSON") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $register_name);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="PATIENT_NAME") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $patientname);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
										
											elseif ($one_field=="PHONE_NUMBER") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $phone_number);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="RELATIVE_NAME") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $relative_name);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="REGISTER_DATE_AND_TIME") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $register_date_time);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="ISSUE_DATE") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $issue_date);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="STATUS") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $ucil_status);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											
											elseif ($one_field=="INSURANCE_TYPE") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $insurance_name);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
										
										}
										if($r_a>=90)
										{
											$r_a=64;
											$r_a1++;					
										}
										$r_a++;
									}
								}
								else if($start_date != date('Y-m-d',strtotime($one_data['created_at'])))
								{
									
									$start_date=date('Y-m-d',strtotime($one_data['created_at']));
									
									$objPHPExcel -> getActiveSheet() -> setCellValue('A'  . $row, 'Total');
									$objPHPExcel -> getActiveSheet() -> setCellValue('B' . $row, $sub_visit_group[$inc1]['ucil_letter_status']);
									$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':'.'L' . $row)->applyFromArray($styleArray5);
									
									
									$inc1++;
									$row++;
									foreach($all_post_key as $one_field)
									{
										$cell_char=chr($r_a);
										
										
										
										if($r_a1>=65)
										{
											$cell_char=chr($r_a1).chr($r_a);	
										}
										
										if($one_field=="SNO")
										{
											$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $slno);
											$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else
										{
											if($one_field=="MR_NUMBER")
		    				 				{
		    				 					$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $mr_number);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="SUB-VISIT") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $sub_visit);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="UCIL_ID") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $ucil_emp_id);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="REGISTER_PERSON") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $register_name);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="PATIENT_NAME") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $patientname);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
										
											elseif ($one_field=="PHONE_NUMBER") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $phone_number);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="RELATIVE_NAME") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $relative_name);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="REGISTER_DATE_AND_TIME") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $register_date_time);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="ISSUE_DATE") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $issue_date);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="STATUS") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $ucil_status);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											
											elseif ($one_field=="INSURANCE_TYPE") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $insurance_name);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											
										}
										if($r_a>=90)
										{
											$r_a=64;
											$r_a1++;					
										}
										$r_a++;
									}
								}
								
								
								$slno++;			
								$row++;
							
							}	
												
										$objPHPExcel -> getActiveSheet() -> setCellValue('A'  . $row, 'Total');
										$objPHPExcel -> getActiveSheet() -> setCellValue('B' . $row, $sub_visit_group[$inc1]['ucil_letter_status']);
										$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':'.'L' . $row)->applyFromArray($styleArray5);
										
										$row++;
										$objPHPExcel -> getActiveSheet() -> setCellValue('A'  . $row, 'Grant Total');
										$objPHPExcel -> getActiveSheet() -> setCellValue('B' . $row, $sub_visit_group_all['ucil_letter_status']);
										$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':'.'L' . $row)->applyFromArray($styleArray8);
										
										$row++;
										$objPHPExcel -> getActiveSheet() -> setCellValue('A'  . $row, 'OverAll Total');
										$objPHPExcel -> getActiveSheet() -> setCellValue('B' . $row, $sub_visit_overall['ucil_letter_status']);
										$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':'.'L' . $row)->applyFromArray($styleArray10);
										
										$row++;$row++;$row++;
							}

								$sub_visit=SubVisit::find()->select(['user_id'=>'user_id','ucil_letter_status'=>'COUNT(ucil_letter_status)'])->where(['ucil_letter_status' => 'YES'])->andWhere(['refund_status'=>'NO'])->andWhere(['BETWEEN','created_at',$from_date.' 00:00:00',$to_date.' 23:59:59'])->orderBy(['created_at'=>SORT_ASC])->groupBy(['user_id'])->all();
										$user_map=ArrayHelper::map($sub_visit,'user_id','user_id');
										$usernames=BranchAdmin::find()->where(['IN','ba_autoid',$user_map])->asArray()->all();
										
										$dataJobMaster = ArrayHelper::index($usernames,'ba_autoid');
										$all_post_key = array("SNO","MR_NUMBER");
								if(!empty($sub_visit))
								{
									
								
										$objPHPExcel -> getActiveSheet() -> setCellValue('A'.$row, 'USERWISE REFFERAL LETTER COLLECTION');
										$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':'.'C'.$row);
										
										$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':'.'L' . $row)->applyFromArray($styleArray7);
										$row++;
										$objPHPExcel -> getActiveSheet() -> setCellValue('A'  . $row, 'USERNAME');
										$objPHPExcel -> getActiveSheet() -> setCellValue('B' . $row, 'COLLECTION');
										$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':'.'B' . $row)->applyFromArray($styleArray8);
										$row++;
										//echo '<pre>';
										
										//echo '<pre>';
										//print_r($dataJobMaster);die;
										foreach ($sub_visit as  $value) 
										{
											foreach($all_post_key as $one_field)
											{
												
												$r_a=65;$r_a1=64;
												$cell_char=chr($r_a);
												//
												if($r_a1>=65)
												{
													$cell_char=chr($r_a1).chr($r_a);	
												}
												if($one_field == 'SNO')
												{
													$objPHPExcel -> getActiveSheet() -> setCellValue('A' . $row, $dataJobMaster[$value['user_id']]['ba_name']);
													$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												}
												else 
												{
														
													if ($one_field == 'MR_NUMBER') 
													{
														$objPHPExcel -> getActiveSheet() -> setCellValue('B' . $row, $value['ucil_letter_status']);
														$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
													}
												}
												//print_r($cell_char . $row);
												//echo '<br>'; 
												
												if($r_a>=90)
												{
													$r_a=64;
													$r_a1++;					
												}
												$r_a++;
											}
											$row++;
										}
										}	//die;	
				
						
						
						$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
						header('Content-Type: application/vnd.ms-excel');
				        $filename = "UCIL_STATUS_REPORT".date("d-m-Y-H:i:s").".xls";
				        header('Content-Disposition: attachment;filename='.$filename .' ');
				        header('Cache-Control: max-age=0');		
						$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				        $objWriter->save('php://output'); 
						die;
						
		}
		else 
		{
			return $this->render('ucilreport', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        	]);	
		}
		
    }


	public function Getage($userDob)
	{
		
		//Create a DateTime object using the user's date of birth.
		$dob = new \DateTime($userDob);
		//We need to compare the user's date of birth with today's date.
		$now = new \DateTime();
		//Calculate the time difference between the two dates.
		$difference = $now->diff($dob);
		//Get the difference in years, as we are looking for the user's age.
		$age = $difference->y;
		//Print it out.
		return $age;
	}
	
	
	
	public function actionUcilopbills()
    {
		if($_POST)
		{
			
			ini_set('max_execution_time', 10000);
			$objPHPExcel = new \PHPExcel();
						
						
		$styleArray = array(
				    	'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 10,
				        'name'  => 'Calibri'
				    	));
				
				
								$styleArray5 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'ffe88c',
						        ),
						        ),
						      
						        
						        
								'alignment' => array(
				        'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
				        'wrap' => true
				    	),
						        
								
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);	
				
				
				
					$styleArray6 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'a9c9f1',
						        ),
						        ),
						     
						        
						        
								'alignment' => array(
				        'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
				       // 'wrap' => true
				    	),
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);
				
				
				$styleArray7 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'a9c9f1',
						        ),
						        ),
						        'borders' => array(
						        'outline' => array(
						            'style' => \PHPExcel_Style_Border::BORDER_DOTTED,
						            'color' => array('argb' => '000000'),
						        ), ),
						        
						         'alignment' => array(
            'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        ),
					
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);
				
				
				
				$styleArray8 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'a9c9f1',
						        ),
						        ),
						        'borders' => array(
						        'outline' => array(
						            'style' => \PHPExcel_Style_Border::BORDER_DOTTED,
						            'color' => array('argb' => '000000'),
						        ), ),
						        
						         'alignment' => array(
            'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        ),
					
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);
				
				
	$styleCalibri = array(
				   	'font'  => array(
				       // 'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 10,
				        'name'  => 'Calibri'
				    	),
				    	
					
						        
									'alignment' => array(
				      //  'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				       'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
				        'wrap' => true
				    	),
						        
						  	);	
				
				
				
							$styledotted = array(
				  
						 'borders' => array(
						        'outline' => array(
						            'style' => \PHPExcel_Style_Border::BORDER_DOTTED,
						            'color' => array('argb' => '000000'),
						        ), ),
						        
									'alignment' => array(
				        'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				       //'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
				        'wrap' => true
				    	),
						        
						  	);
							
							
							$styleArray8 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'f78f8f',
						        ),
						        ),
						   
					
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);
					
					
					
						
							$styleArray9 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => '00FF00',
						        ),
						        ),
						   			'alignment' => array(
				        'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				       //'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
				        'wrap' => true
				    	),
					
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);
				
				
				$styleArray10 = array('fill' => array(
								
								
								
								
						        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
						       // 'rotation' => 90,
						        'startcolor' => array(
						            'rgb' => 'FF6347',
						        ),
						        ),
						   
					
						   						    
				   		'font'  => array(
				        'bold'  => true,
				        //'color' => array('rgb' => 'FF0000'),
				        'size'  => 12,
				        'name'  => 'Calibri'
				    	),
				);
					
					
							
						$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
						$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
						$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
						$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
						$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
						$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
						$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
							
						$sheet = 0;
						$session = Yii::$app->session;
						$objPHPExcel -> setActiveSheetIndex($sheet);
						$objPHPExcel -> getActiveSheet() -> setTitle("UCIL BILLS REPORT")	
						-> setCellValue('A2', 'SNO')
						-> setCellValue('B2', 'PATIENT NAME')
						-> setCellValue('C2', 'UCIL ID')
						-> setCellValue('D2', 'MR NUMBER')
						-> setCellValue('E2', 'CONSULTANT')
						-> setCellValue('F2', 'INVES')
						-> setCellValue('G2', 'PHARM');
						
						$objPHPExcel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($styleArray7);
						
						//Date 
						$from_date=date('Y-m-d',strtotime(Yii::$app->request->post('fromDate')));
						$to_date=date('Y-m-d',strtotime(Yii::$app->request->post('toDate')));
						
						//SUB VISIT QUERY
						$sub_visit=SubVisit::find()->where(['ucil_letter_status' => ['NO','YES']])->andWhere(['refund_status'=>'NO'])->andWhere(['BETWEEN','created_at',$from_date.' 00:00:00',$to_date.' 23:59:59'])->orderBy(['created_at'=>SORT_ASC])->all();
						$sub_visit_day_wise_total=SubVisit::find()->select(['due_amt'=>'SUM(due_amt)'])->where(['ucil_letter_status' => ['NO','YES']])->andWhere(['refund_status'=>'NO'])->andWhere(['BETWEEN','created_at',$from_date.' 00:00:00',$to_date.' 23:59:59'])->orderBy(['created_at'=>SORT_ASC])->groupBy(['date(created_at)'])->all();
						$sub_visit_overall_total=SubVisit::find()->select(['due_amt'=>'SUM(due_amt)'])->where(['ucil_letter_status' => ['NO','YES']])->andWhere(['refund_status'=>'NO'])->andWhere(['BETWEEN','created_at',$from_date.' 00:00:00',$to_date.' 23:59:59'])->orderBy(['created_at'=>SORT_ASC])->asArray()->one();
						
						//echo '<pre>';
						//print_r($sub_visit);die;
						
						
						//PHARMACY QUERY
						$sub_visit_map=ArrayHelper::map($sub_visit,'sub_id','sub_id');
						$sales=Sales::find()->select(['subvisit_id'=>'subvisit_id','overalltotal'=>'SUM(overalltotal)'])->where(['IN','subvisit_id',$sub_visit_map])->andWhere(['BETWEEN','updated_on',$from_date.' 00:00:00',$to_date.' 23:59:59'])->orderBy(['updated_on'=>SORT_ASC])->groupBy(['subvisit_id'])->all();
						$sales_date_wise_total=Sales::find()->select(['overalltotal'=>'SUM(overalltotal)'])->where(['IN','subvisit_id',$sub_visit_map])->andWhere(['BETWEEN','updated_on',$from_date.' 00:00:00',$to_date.' 23:59:59'])->orderBy(['updated_on'=>SORT_ASC])->groupBy(['date(updated_on)'])->all();
						$sales_overall_total=Sales::find()->select(['overalltotal'=>'SUM(overalltotal)'])->where(['IN','subvisit_id',$sub_visit_map])->andWhere(['BETWEEN','updated_on',$from_date.' 00:00:00',$to_date.' 23:59:59'])->orderBy(['updated_on'=>SORT_ASC])->one();
						
						$sales_index=ArrayHelper::index($sales,'subvisit_id');
						
						//Investigation
						$lab_payment_prime=LabPaymentPrime::find()->select(['sub_id'=>'sub_id','overall_net_amt'=>'SUM(overall_net_amt)'])->where(['IN','sub_id',$sub_visit_map])->andWhere(['BETWEEN','created_at',$from_date.' 00:00:00',$to_date.' 23:59:59'])->orderBy(['created_at'=>SORT_ASC])->groupBy(['sub_id'])->all();
						$lab_day_wise_total=LabPaymentPrime::find()->select(['overall_net_amt'=>'SUM(overall_net_amt)'])->where(['IN','sub_id',$sub_visit_map])->andWhere(['BETWEEN','created_at',$from_date.' 00:00:00',$to_date.' 23:59:59'])->orderBy(['created_at'=>SORT_ASC])->groupBy(['date(created_at)'])->all();
						$lab_overall_total=LabPaymentPrime::find()->select(['overall_net_amt'=>'SUM(overall_net_amt)'])->where(['IN','sub_id',$sub_visit_map])->andWhere(['BETWEEN','created_at',$from_date.' 00:00:00',$to_date.' 23:59:59'])->orderBy(['created_at'=>SORT_ASC])->one();
						
						$lab_payment_prime_index=ArrayHelper::index($lab_payment_prime,'sub_id');
						//echo '<pre>';
						//print_r($lab_payment_prime_index);die;
						$all_post_key = array("SNO","PAT_NAME", "UCIL_ID","MR", "OP",  "INVES", "PHARM");
						
						$sub_visit_patient_map=ArrayHelper::map($sub_visit,'sub_id','pat_id');
						$new_patient=Newpatient::find()->where(['IN','patientid',$sub_visit_patient_map])->all();
						$new_patient_index=ArrayHelper::index($new_patient,'patientid');
						
						
						$objPHPExcel -> getActiveSheet() -> setCellValue('A1', 'UCIL BILLS: '.date('d-m-Y',strtotime($from_date)).' TO '.date('d-m-Y',strtotime($to_date)));
						$objPHPExcel->getActiveSheet()->getStyle('A1'.':'.'G1')->applyFromArray($styleArray9);
						$objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
						
						$slno=1;
						$row = 3;
						$inc=0;
						
						$start_date=date('Y-m-d',strtotime($sub_visit[0]['created_at']));
						if(!empty($sub_visit))
						{
							foreach($sub_visit as $key => $one_data)
							{
								$r_a=65;$r_a1=64;
								
								
								$patient_name=(isset($new_patient_index[$one_data['pat_id']]['patientname'])) ? $new_patient_index[$one_data['pat_id']]['patientname'] : '-';
								$ucil_emp_id=(isset($one_data['ucil_emp_id'])) ? $one_data['ucil_emp_id'] : '-';
								$mr_number=(isset($one_data['mr_number'])) ? $one_data['mr_number'] : '-';
								$op_amt=(isset($one_data['due_amt'])) ? $one_data['due_amt'] : '-';
								$inves=(isset($lab_payment_prime_index[$one_data['sub_id']]['overall_net_amt'])) ? $lab_payment_prime_index[$one_data['sub_id']]['overall_net_amt'] : '0';
								$pharm=(isset($sales_index[$one_data['sub_id']]['overalltotal'])) ? $sales_index[$one_data['sub_id']]['overalltotal'] : '0';
								
								
								
								if($start_date == date('Y-m-d',strtotime($one_data['created_at'])))
								{
									foreach($all_post_key as $one_field)
									{
										$cell_char=chr($r_a);
										
										if($r_a1>=65)
										{
											$cell_char=chr($r_a1).chr($r_a);	
										}
										
										if($one_field=="SNO")
										{
											$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $slno);
											$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else
										{
											if($one_field=="PAT_NAME")
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $patient_name);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="UCIL_ID") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $ucil_emp_id);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="MR") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $mr_number);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="OP") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $op_amt);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="INVES") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $inves);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="PHARM") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $pharm);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
										}
										
										if($r_a>=90)
										{
											$r_a=64;
											$r_a1++;					
										}
										$r_a++;
									}
									
								}
								elseif ($start_date != date('Y-m-d',strtotime($one_data['created_at']))) 
								{
									$start_date=date('Y-m-d',strtotime($one_data['created_at']));
									
									$objPHPExcel -> getActiveSheet() -> setCellValue('A'  . $row, 'Total');
									$objPHPExcel -> getActiveSheet() -> setCellValue('E' . $row, $sub_visit_day_wise_total[$inc]['due_amt']);
									$objPHPExcel -> getActiveSheet() -> setCellValue('F' . $row, $lab_day_wise_total[$inc]['overall_net_amt']);
									$objPHPExcel -> getActiveSheet() -> setCellValue('G' . $row, $sales_date_wise_total[$inc]['overalltotal']);
									$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':'.'G' . $row)->applyFromArray($styleArray5);
									
									$inc++;
									$row++;
									
									
									
									
									foreach($all_post_key as $one_field)
									{
										$cell_char=chr($r_a);
										
										if($r_a1>=65)
										{
											$cell_char=chr($r_a1).chr($r_a);	
										}
										
										if($one_field=="SNO")
										{
											$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $slno);
											$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
										}
										else
										{
											if($one_field=="PAT_NAME")
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $patient_name);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="UCIL_ID") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $ucil_emp_id);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="MR") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $mr_number);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="OP") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $op_amt);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="INVES") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $inves);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
											elseif ($one_field=="PHARM") 
											{
												$objPHPExcel -> getActiveSheet() -> setCellValue($cell_char . $row, $pharm);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
												$objPHPExcel->getActiveSheet()->getStyle($cell_char . $row)->applyFromArray($styleCalibri);
											}
										}
										
										if($r_a>=90)
										{
											$r_a=64;
											$r_a1++;					
										}
										$r_a++;
									}
								}
								
								$row++;
								$slno++;
							}
								
								$objPHPExcel -> getActiveSheet() -> setCellValue('A'  . $row, 'Total');
								$objPHPExcel -> getActiveSheet() -> setCellValue('E' . $row, $sub_visit_day_wise_total[$inc]['due_amt']);
								$objPHPExcel -> getActiveSheet() -> setCellValue('F' . $row, $lab_day_wise_total[$inc]['overall_net_amt']);
								$objPHPExcel -> getActiveSheet() -> setCellValue('G' . $row, $sales_date_wise_total[$inc]['overalltotal']);
								$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':'.'G' . $row)->applyFromArray($styleArray5);
							
								$row++;
								$objPHPExcel -> getActiveSheet() -> setCellValue('A'  . $row, 'OverAll Total');
								$objPHPExcel -> getActiveSheet() -> setCellValue('E' . $row, $sub_visit_overall_total['due_amt']);
								$objPHPExcel -> getActiveSheet() -> setCellValue('F' . $row, $lab_overall_total['overall_net_amt']);
								$objPHPExcel -> getActiveSheet() -> setCellValue('G' . $row, $sales_overall_total['overalltotal']);
								$objPHPExcel->getActiveSheet()->getStyle('A' . $row.':'.'G' . $row)->applyFromArray($styleArray10);

						}
						
						$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
						header('Content-Type: application/vnd.ms-excel');
				        $filename = "UCIL_STATUS_REPORT".date("d-m-Y-H:i:s").".xls";
				        header('Content-Disposition: attachment;filename='.$filename .' ');
				        header('Cache-Control: max-age=0');		
						$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				        $objWriter->save('php://output'); 
						die;
		}	
   }
	
	
	
	public function actionMailer()
    {
		 if( Yii::$app->mailer->compose()
			    ->setFrom('albanbensam.istrides@gmail.com')
			    ->setTo('albanbensam.istrides@gmail.com')
			    ->setSubject('Hai')
			    ->setHtmlBody('j')
				 //->setHtmlBody($file)
								
			    ->send())
				{
					print_r("hai");die;
				}
		 else {
			 print_r('Failed');die;
		 }
		//$pdf->Image('/pharmacy/backend/web/ubold/images/logo@1x.jpg', 2, 8, 255, 35, 'JPG', '', '', false, 1000, '', false, false, 1, true, false, false);
	
	}
	
	
	
public function actionPrintres($id,$pat_id,$date_ucil)
{
	
	$id=base64_decode(urldecode($id));
	$pat_id=base64_decode(urldecode($pat_id));
	
	//SUB-VISIT
	$sub_visit=SubVisit::find()->where(['ucil_letter_status' => ['NO','YES']])->andWhere(['refund_status'=>'NO'])->andWhere(['pat_id'=>$pat_id])->andWhere(['date(created_at)'=>date('Y-m-d',strtotime($date_ucil))])->orderBy(['created_at'=>SORT_ASC])->all();
	$sub_visit_amount = ArrayHelper::getColumn($sub_visit, 'due_amt');
	
	
	$SALES=Sales::find()->where(['patient_id'=>$pat_id])->where(['date(created_at)'=>date('Y-m-d',strtotime($date_ucil))])->all();
	$sales_map=ArrayHelper::map($SALES, 'opsaleid', 'opsaleid');
	$sales_details=Saledetail::find()->where(['IN','opsaleid',$sales_map])->andwhere(['date(created_at)'=>date('Y-m-d',strtotime($date_ucil))])->andWhere(['NOT IN','productqty' , '0'])->asArray()->all();
	$sales_net_amount = ArrayHelper::getColumn($sales_details, 'total_price_perqty');
	
	//Sales Fetch
	$product_map=ArrayHelper::map($sales_details, 'opsale_detailid', 'productid');
	$product_details=Product::find()->where(['IN','productid',$product_map])->asArray()->all();
	$product_index=ArrayHelper::index($product_details,'productid');
	
	
	
	//HSN CODE
	$hsn_map=ArrayHelper::map($product_details, 'productid', 'hsn_code');
	$taxgrouping_log=TaxgroupingLog::find()->where(['IN','taxgroupid',$hsn_map])->andWhere(['is_active'=>'1'])->all();
	$taxgrouping_index=ArrayHelper::index($taxgrouping_log,'taxgroupid');
	
	//echo '<pre>';
	//print_r($taxgrouping_index);die;
	
	//Common Fetch
	$physicianmaster=ArrayHelper::map(Physicianmaster::find()->asArray()->all(), 'id', 'physician_name');
	$specialistdoctor=ArrayHelper::map(Specialistdoctor::find()->where(['is_active'=>1])->asArray()->all(), 's_id', 'specialist');
	$new_patient=Newpatient::find()->where(['patientid'=>$pat_id])->one();
	$patienttype=ArrayHelper::map(Patienttype::find()->where(['is_active'=>1])->asArray()->all(), 'type_id', 'patient_type');
	
	
	require ('../../vendor/tcpdf/tcpdf.php');
	$pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('DMC');
	$pdf->SetTitle('Overall Report');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
	$pdf->SetPrintHeader(false);
	$pdf->SetPrintFooter(false);
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	$pdf->setFontSubsetting(true);
	$pdf->SetFont('helvetica', '', 8, '', true);
	$pdf->SetMargins(10, false, 10, true); // set the margins 
	$pdf->AddPage();
	

	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
	$pdf->Image('/pharmacy/backend/web/ubold/images/1.png', 10, 10, 25, 25, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
	if(!empty($new_patient) && !empty($sub_visit))
	{
		
		
		$tbl1='<html>
			<head>
			</head>
			<body>';

		$tbl1.='<table style="border:none;padding:2px 21px 2px 1px;font-size:12px;margin-bottom:250px;"  >
			<tr>
			<td style="width:1%;"></td> 
			<td style="width:55%;"> 
			<h2 style="text-align:left;color:red;">DINESH MEDICAL CENTRE</h2>
			<table style="line-height:2.7;" ALIGN="Left" border="">
			  <tr> <td style="line-height:1.7">D.No.3-7-215/1,First Floor,Bakarapuram,</td></tr>
			  <tr><td style="line-height:1.7">Pulivendula-516390,Kadapa Dist,A.P.</td></tr>
			  <tr><td style="line-height:1.7">[Phone : (08568) 286189]</td></tr>
			  <tr><td style="line-height:1.7">[TIN.NO :37141115904]</td></tr>
			  <tr><td style="line-height:1.7">[GSTIN : 37AADCC7476L1Z3]</td></tr>
			</table>
			</td>
			<td style="width:45%;margin-top:-250px;" > 
			<h2 style="text-align:center;color:red;">INVOICE</h2>
					<table style="line-height:25px;" ALIGN="CENTER" border="1">
					<tr><td style="background-color:#eee">INVOICE #</td><td style="background-color:#eee">DATE</td></tr>
					<tr><td>2034</td><td>'.date('d-m-Y',strtotime($date_ucil)).'</td></tr>
					<tr><td style="background-color:#eee">MR NUMBER</td><td style="background-color:#eee">ITEMS</td></tr>
					<tr><td>'.$new_patient->mr_no.'</td><td>OP/INV/PHAR</td></tr>
					</table>
			 </td></tr><table><p></p><div style="padding:2px 21px 2px 1px;"><hr></div>';
		
		
		$tbl1.='<table style="border:none;padding:2px 10px;font-size:12px;margin-top:100px;" ALIGN="left" >
			<tr><td style="width:35%;background-color:#eee;text-align:center;"><b> CONSULTANT DETAILS </b></td><td style="width:30%;"></td><td style="width:35%;background-color:#eee;text-align:center;"><b> PATIENT DETAILS </b></td></tr>';
		$tbl1.='<tr><td style="">'.$physicianmaster[$sub_visit[0]['consultant_doctor']].' </td><td style="width:30%;"></td><td style="">'.strtoupper($new_patient->patientname).' </td></tr>';
		$tbl1.='<tr><td style="">'.$specialistdoctor[$sub_visit[0]['department']].' </td><td style="width:30%;"></td><td style="width:30%;">UCIL - '.$sub_visit[0]['ucil_emp_id'].'</td></tr>';
		$tbl1.='<tr><td style="">D.No.3-7-215/1, First Floor, </td><td style="width:30%;"></td><td style="">'.$new_patient->pat_address.' </td></tr>';
		$tbl1.='<tr><td style="">Bakarapuram, Pulivendula, </td><td style="width:30%;"></td><td style="">'.$new_patient->pat_city.', '.$new_patient->pat_distict.' </td></tr>';
		$tbl1.='<tr><td style="">Y.S.R Kadapa Dist, A.P-516390. </td><td style="width:30%;"></td><td style="">Ph.No: '.$new_patient->pat_mobileno.' </td></tr>';
		$tbl1.='<tr><td style="">dineshmedicalcentre@gmail.com</td><td style="width:30%;"></td><td style=""></td></tr>';
		$tbl1.='</table>';
		
		$i=1;
		$visit_inc=1;
		$heading_inc=1;
	$tbl1.='<p></p><p></p><table style="border:1px solid #000;padding:2px 10px;font-size:12px;margin-top:250px;" ALIGN="left" border="0" >
	<tr><td style="width:60%;background-color:gray;border-right: 1px solid black;"> Description </td><td style="width:10%;border-right: 1px solid black;text-align:center;background-color:gray;">QTY</td><td style="width:15%;background-color:gray;border-right: 1px solid black;text-align:right"> UNIT PRICE </td><td style="width:15%;background-color:gray;text-align:right"> AMOUNT </td></tr>';
//$tbl1.='<tr ><td style="border-top: 1px solid black;border-right: 1px solid black;" > Name </td><td style="text-align:center;border-right: 1px solid black;">1</td><td style="text-align:center;border-right: 1px solid black;">150 </td><td style="text-align:right">150</td></tr>';
//$tbl1.='<tr><td style="border-right: 1px solid black;"> Company Name </td><td style="text-align:center;border-right: 1px solid black;">1</td><td style="text-align:center;border-right: 1px solid black;"> 150</td><td style="text-align:right">150</td></tr>';
//$tbl1.='<tr><td style="border-right: 1px solid black;"> Street Address </td><td style="text-align:center;border-right: 1px solid black;">1</td><td style="text-align:center;border-right: 1px solid black;"> 200 </td><td style="text-align:right">150</td></tr>';
//$tbl1.='<tr><td style="border-right: 1px solid black;"> [City & zip] </td><td style="text-align:center;border-right: 1px solid black;">1</td><td style="text-align:center;border-right: 1px solid black;"> 200 </td><td style="text-align:right">200</td></tr>';
//$tbl1.='<tr><td style="border-right: 1px solid black;"> [Phone] </td><td style="text-align:center;border-right: 1px solid black;">1</td><td style="text-align:center;border-right: 1px solid black;"> 300 </td><td style="text-align:right">300</td></tr>';
//$tbl1.='<tr><td style="border-right: 1px solid black;"> [Email Address] </td><td style="text-align:center;border-right: 1px solid black;">1</td><td style="text-align:center;border-right: 1px solid black;">300 </td><td style="text-align:right">200</td></tr>';
		$total_net_amount=array_sum($sub_visit_amount)+array_sum($sales_net_amount);
		//print_r($total_net_amount);die;
		foreach ($sub_visit as $key => $value) 
		{
			$tbl1.='<tr style="border-top: 1px solid black;border-right: 1px solid black;"><td  colspan="4"> <b>CONSULTATION FEES</b> </td></tr>';
			$tbl1.='<tr><td style=""> ('.$i++.') '.$physicianmaster[$value['consultant_doctor']].'</td><td style="text-align:center">'.$visit_inc++.'</td><td style="text-align:center">'.$value['due_amt'].'</td><td style="text-align:right">'.$value['due_amt'].'</td></tr>';
			if(!empty($sales_details))
			{
				if($heading_inc == 1)
				{
					$tbl1.='<tr style="border-top: 1px solid black;border-right: 1px solid black;"><td  colspan="4"> <b>PHARMACY</b> </td></tr>';
				}
				foreach ($sales_details as $key1 => $value1) 
				{
					if(isset($value1['productid']))
					{
						$product_id=$product_index[$value1['productid']]['hsn_code'];
						$hsn=$taxgrouping_index[$product_id]['hsncode'];
					}
					$tbl1.='<tr><td style=""> ('.$i++.') '.$product_index[$value1['productid']]['productname'].' - '.date('d-m-Y',strtotime($value1['expiredate'])).' - '.$hsn.'</td><td style="text-align:center">'.$value1['productqty'].'</td><td style="text-align:center">'.$value1['mrpperunit'].'</td><td style="text-align:right">'.$value1['total_price_perqty'].'</td></tr>';
				}
			}
		}
		$tbl1.='</table>';
		$tbl1.='<table style="border:none;padding:2px 10px;font-size:12px;" ALIGN="left" border="1" >
			<tr><td style="width:60%;"> Thanks you for your visiting </td><td style="width:25%;">TOTAL AMOUNT  </td><td style="width:15%;text-align:right">'.$total_net_amount.'</td></tr>
		</table>';
		
		$pdf->writeHTML($tbl1, true, false, false, false, '');
		$tbl12='If  you have any questions about this invoice please contact';
		$tbl1_bot='[Name,Phone,email@address.com]';
		$pdf->SetXY(70,255,true);
		$pdf->Cell(100, 0, $tbl12, 0, 0);
		$pdf->SetXY(80,260,true);
		$pdf->Cell(100, 0, $tbl1_bot, 0, 0);
	}
		
		
		$pdf->Output('OverallReport.pdf');

}
	
	
	
	
	public function actionZipall($troname, $troclg, $trophyyear){

$zip = new \ZipArchive();
$test = tempnam(sys_get_temp_dir(), rand(0, 999999999) . '.zip');
               var_dump($test);
               $res = $zip->open($test, \ZipArchive::CREATE);
$trophy_name = NasaTrophyDetails::find()->where(['trophy_id'=>$troname])->one();
if($trophy_name){
$name = $trophy_name->trophy_name;
}else{
$name = "";
}
               if($res) {
                if($troname!='' && $trophyyear!='' && $troclg!=''){

               	$mode=TrophyReg::find()->where(['trophy_id'=>$troname])->andWhere(['LIKE','clg_code',$troclg])->andWhere(['LIKE','trophy_year',$trophyyear])->all();
               	//echo "<pre>"; print_r(count($mode)); die;
foreach ($mode as  $value) { 
//	$modes=TrophyRegEntries::find()->where(['trophy_reg_id'=>$value->trophy_reg_id])->one();
$code=$value->clg_code;
$troneme=$value->trophyname;  
$fileToZip3=$value->registration_upload;
if($fileToZip3!=""){
$fileToZip1=Yii::$app->basePath."/web/uploads/trophy/".$fileToZip3;
$fileToZipa=$code.'-'.$troneme."/".$fileToZip3;                
$zip->addFile($fileToZip1,$fileToZipa);
}

}
$zip->close();
                   header('Content-Type: application/zip');
                   header('Content-Disposition: attachment; filename='.$name.'.zip');
                   readfile($test);
}}}
	
	
	
	
	
	
	
	
    /**
     * Deletes an existing SubVisit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SubVisit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SubVisit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SubVisit::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
