<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=dmcpharmacy_local',
            'username' => 'root',
           'password' => '',
		    
            'charset' => 'utf8',
            'on afterOpen' => function($event) {
       			 $event->sender->createCommand("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))")->execute();
   		 }
        ],
     /*   'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
              'transport' => [
             'class' => 'Swift_SmtpTransport',
             'host' => 'rapidtechsmtp.logix.in',
           'username'      => 'care@tansihonda.com',
             'password'      => 'thonCARE17^%',
             'port' => '587',
             'encryption' => 'tls',
                         ],
        ],*/
        
		 'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
              'transport' => [
             'class' => 'Swift_SmtpTransport',
             'host' => 'mail.istrides.in',
             'username'      => 'vivek@istrides.in',  //albanbensam.istrides@gmail.com
             'password'      => 'vivek123',
             'port' => '587',
             'encryption' => 'tls',
                         ],
			 
        ],
		
    ],
];
/*return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=fzzgybtv_reconcile',
            'username' => 'fzzgybtv_reconci',
            'password' => '9WLGLBBFCGIH',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];*/