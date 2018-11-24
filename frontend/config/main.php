<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers', 
   // 'defaultRoute' => 'site/index',
   'timeZone' => 'Asia/Kolkata',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\Frontend',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_frontendUser', // unique for frontend
            ]
        ],
        'session' => [
            'name' => 'PHPFRONTSESSID',
            'savePath' => sys_get_temp_dir(),
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'sdfafsdsd',
            'csrfParam' => '_frontendCSRF',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
     
      'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
            
               'index'=>'site/index',
               //aruna
			   
            //   'fetch-customer'=>'dmc-api/fetchcustomer',
            //   'fetch-product-details'=>'dmc-api/fetchproductdetails',
           //    'search-product'=>'dmc-api/searchproduct',
               
			   //prasanth
			   //dmcapicontroller
			   
			    /*1*/			'fetchlogin'=>'dmc-api/fetchlogin',
				/*2*/			'fetchpatient'=>'dmc-api/fetchpatient',
				/*3*/			'fetchproductlist'=>'dmc-api/fetchproductlist',
				/*4*/			'searchstock'=>'dmc-api/searchstock',
				/*5*/			'fetchstockdetails'=>'dmc-api/fetchstockdetails',
				/*6*/			'addsales'=>'dmc-api/addsales',
				/*7*/			'fetchinvoice'=>'dmc-api/fetchinvoice',
				/*8*/			'editinvoice'=>'dmc-api/editinvoice',
				/*9*/			'updatesales'=>'dmc-api/updatesales',
                /*10*/			'fetchinvoicehistory'=>'dmc-api/fetchinvoicehistory',
				/*11*/			'fetchpaymentmethod'=>'dmc-api/fetchpaymentmethod',
				/*12*/			'fetchcardtype'=>'dmc-api/fetchcardtype',
				/*13*/			'payment'=>'dmc-api/payment',
				/*14*/			'cancelpayment'=>'dmc-api/cancelpayment',
				/*15*/			'addreturn'=>'dmc-api/addreturn',
				/*16*/        //  'cancelinvoice'=>'dmc-api/addreturn',
				
				/*17*/	   'fetchproductautocomplete'=>'dmc-apipart2/fetchproductautocomplete',
				/*18*/	  'fetchvendorautocomplete'=>'dmc-apipart2/fetchvendorautocomplete',
				/*19*/    'stockreceivedelete'=>'dmc-apipart2/stockreceivedelete',
				/*20*/	  'fetchstockrequestinfo'=>'dmc-apipart2/stockrequestinfo',
				/*21*/	   'stockrequestsave'=>'dmc-apipart2/stockrequestsave',
				/*22*/	   'fetchpurchaseorderlist'=>'dmc-apipart2/fetchpurchaseorderlist',
				
				
				
				/*23*/	   'editstockrequestinfo'=>'dmc-apipart2/editstockrequestinfo',
				/*24*/	   'updatestockrequestsave'=>'dmc-apipart2/updatestockrequestsave',
				/*25*/	   'deletestockrequestorder'=>'dmc-apipart2/deletestockrequestorder',
				/*26*/	  'fetchinvoiceautocomplete'=>'dmc-apipart2/fetchinvoiceautocomplete',
				/*27*/	   'stockreceiveinfo'=>'dmc-apipart2/stockreceiveinfo',
				/*28*/	   'stockreceiveinputinfo'=>'dmc-apipart2/stockreceiveinputinfo',
				/*29*/	   'stockreceivesave'=>'dmc-apipart2/stockreceivesave',
				/*30*/	   'stockreceivestatussave'=>'dmc-apipart2/stockreceivestatussave',
				/*31*/	   'deletestockrequestid'=>'dmc-apipart2/deletestockrequestid',
				/*32*/		'stockrequeststatussave'=>'dmc-apipart2/stockrequeststatussave',
				/*33*/	    'stockreceiveview'=>'dmc-apipart2/stockreceiveview',
				
				/*34*/	'saleschart'=>'dmc-apipart2/saleschart',
				
				
				
				
            ],  
        ],
        
    ],
    'params' => $params,
];
