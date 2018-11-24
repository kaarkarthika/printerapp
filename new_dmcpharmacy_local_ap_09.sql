-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2018 at 02:00 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dmcpharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_log`
--

CREATE TABLE `admin_log` (
  `log_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_center_id` int(11) NOT NULL,
  `action` text NOT NULL,
  `log_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_theme_version`
--

CREATE TABLE `admin_theme_version` (
  `autoid` int(11) NOT NULL,
  `reconcileversionname` varchar(100) NOT NULL,
  `reconcileversion` varchar(30) NOT NULL,
  `reconcileversionkey` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_theme_version`
--

INSERT INTO `admin_theme_version` (`autoid`, `reconcileversionname`, `reconcileversion`, `reconcileversionkey`, `timestamp`) VALUES
(3, 'Dmc Pharmacy', 'V 1.0', 'DMC ADMIN', '2018-03-12 11:01:56');

-- --------------------------------------------------------

--
-- Table structure for table `api_log`
--

CREATE TABLE `api_log` (
  `autoid` bigint(20) NOT NULL,
  `event_key` varchar(200) DEFAULT NULL,
  `request_data` text,
  `response_data` text,
  `created_at` datetime NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'A=Active,I=Inactive',
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `api_log`
--

INSERT INTO `api_log` (`autoid`, `event_key`, `request_data`, `response_data`, `created_at`, `status`, `modified_at`) VALUES
(1, 'fetch-login', '{"username":"admin","password":"admin123"}', '{"status":true,"message":"success","authkey":"","branchcode":"B001","branchname":"Warehouse","branchid":"1"}', '2018-04-03 18:07:33', 'A', '2018-04-03 12:37:34'),
(2, 'fetch-vendorautocomplete', '{"authkey":"","vendorname":""}', '{"status":true,"message":"success","data":[{"vendorname":"SRI S.R.MEDICAL AGENCIES","vendorid":"1","vendorcode":"V001"},{"vendorname":"SRI KEERTHI MEDICAL AGENCIES","vendorid":"2","vendorcode":"V002"},{"vendorname":"SRINIVASA MEDICCAL AGENCIES","vendorid":"3","vendorcode":"V003"},{"vendorname":"PRABHAKAR MEDICAL AGENCIES","vendorid":"4","vendorcode":"V004"},{"vendorname":"SIVA TEJAA PHAARMA","vendorid":"5","vendorcode":"V005"},{"vendorname":"A.R. MEDICAL AGENCIES","vendorid":"6","vendorcode":"V007"},{"vendorname":"VENKATA GANESH MEDICAL AGENCIES","vendorid":"7","vendorcode":"V008"},{"vendorname":"GAYATRI MEDICAL AGENCIES","vendorid":"8","vendorcode":"V006"},{"vendorname":"SRI VINAYAKA MEDICAL AGENCIES","vendorid":"9","vendorcode":"V009"},{"vendorname":"SREE BALAJI MEDICAL & SURGICALS","vendorid":"10","vendorcode":"V010"},{"vendorname":"SRI GAYATRI PHARMACEUTICALS","vendorid":"11","vendorcode":"V011"},{"vendorname":"SRI LAKSHMI DEVI MEDICAL AGENCIES","vendorid":"12","vendorcode":"V012"},{"vendorname":"SRI SAPTHAGIRI MEDICAL AGENCIES","vendorid":"13","vendorcode":"V013"},{"vendorname":"SRI RAMA KRISHNA MEDICAL AGENCIES","vendorid":"14","vendorcode":"V014"},{"vendorname":"SUDHAKAR MEDICAL AGENCIES","vendorid":"15","vendorcode":"V015"},{"vendorname":"RKR MEDICAL AGENCIES","vendorid":"16","vendorcode":"V016"},{"vendorname":"SRI TIRUMALA MEDICAL AGENCIES","vendorid":"17","vendorcode":"V017"},{"vendorname":"SUDHEER MEDICAL AGENCIES","vendorid":"18","vendorcode":"V018"},{"vendorname":"RAJKUMAR MEDICALS","vendorid":"19","vendorcode":"V019"},{"vendorname":"SRI ADITHYA MEDICAL & SURGICAL AGENCIES","vendorid":"20","vendorcode":"V020"},{"vendorname":"Sree M.V.R. Medical Distributors","vendorid":"23","vendorcode":"V022"},{"vendorname":"TEST1","vendorid":"24","vendorcode":"TEST1"},{"vendorname":"DHINESH","vendorid":"25","vendorcode":"V023"}]}', '2018-04-03 18:07:45', 'A', '2018-04-03 12:37:45'),
(3, 'fetch-productautocomplete', '{"authkey":"","vendorid":"1","stockname":""}', '{"status":true,"message":"success","data":[{"productid":"17","productname":"Dolo 650mg Tablet"},{"productid":"128","productname":"Crocin"},{"productid":"2","productname":"METROGYL DG"},{"productid":"3","productname":"MYOSPAZ"},{"productid":"4","productname":"STREPSILS"}]}', '2018-04-03 18:07:48', 'A', '2018-04-03 12:37:48'),
(4, 'fetch-productautocomplete', '{"authkey":"","vendorid":"1","stockname":"d"}', '{"status":true,"message":"Success","data":[{"productid":"17","productname":"Dolo 650mg Tablet"}]}', '2018-04-03 18:07:53', 'A', '2018-04-03 12:37:53'),
(5, 'fetch-productautocomplete', '{"authkey":"","vendorid":"1","stockname":"dp"}', '{"status":true,"message":"No records found","data":[]}', '2018-04-03 18:07:54', 'A', '2018-04-03 12:37:55'),
(6, 'fetch-productautocomplete', '{"authkey":"","vendorid":"1","stockname":"d"}', '{"status":true,"message":"Success","data":[{"productid":"17","productname":"Dolo 650mg Tablet"}]}', '2018-04-03 18:07:55', 'A', '2018-04-03 12:37:55'),
(7, 'fetch-productautocomplete', '{"authkey":"","vendorid":"1","stockname":"do"}', '{"status":true,"message":"Success","data":[{"productid":"17","productname":"Dolo 650mg Tablet"}]}', '2018-04-03 18:07:56', 'A', '2018-04-03 12:37:56'),
(8, 'fetch-productautocomplete', '{"authkey":"","vendorid":"1","stockname":"dol"}', '{"status":true,"message":"Success","data":[{"productid":"17","productname":"Dolo 650mg Tablet"}]}', '2018-04-03 18:07:56', 'A', '2018-04-03 12:37:56'),
(9, 'fetch-productautocomplete', '{"authkey":"","vendorid":"1","stockname":"do"}', '{"status":true,"message":"Success","data":[{"productid":"17","productname":"Dolo 650mg Tablet"}]}', '2018-04-03 18:07:58', 'A', '2018-04-03 12:37:58'),
(10, 'fetch-productautocomplete', '{"authkey":"","vendorid":"1","stockname":"d"}', '{"status":true,"message":"Success","data":[{"productid":"17","productname":"Dolo 650mg Tablet"}]}', '2018-04-03 18:07:58', 'A', '2018-04-03 12:37:58'),
(11, 'fetch-productautocomplete', '{"authkey":"","vendorid":"1","stockname":""}', '{"status":true,"message":"success","data":[{"productid":"17","productname":"Dolo 650mg Tablet"},{"productid":"128","productname":"Crocin"},{"productid":"2","productname":"METROGYL DG"},{"productid":"3","productname":"MYOSPAZ"},{"productid":"4","productname":"STREPSILS"}]}', '2018-04-03 18:07:58', 'A', '2018-04-03 12:37:58'),
(12, 'add-stockrequestinfo', '{"authkey":"","vendorid":"1","productinfo":[]}', NULL, '2018-04-03 18:08:00', 'A', '2018-04-03 12:38:00'),
(13, 'fetch-productautocomplete', '{"authkey":"","vendorid":"1","stockname":""}', '{"status":true,"message":"success","data":[{"productid":"17","productname":"Dolo 650mg Tablet"},{"productid":"128","productname":"Crocin"},{"productid":"2","productname":"METROGYL DG"},{"productid":"3","productname":"MYOSPAZ"},{"productid":"4","productname":"STREPSILS"}]}', '2018-04-03 18:08:01', 'A', '2018-04-03 12:38:01'),
(14, 'add-stockrequestinfo', '{"authkey":"","vendorid":"1","productinfo":[{"productid":"2"},{"productid":"3"}]}', '{"status":true,"message":"Success","vendorid":"1","requesttype":"vendorstock","data":[{"productgroupid":82,"productid":"2","hsncode":"","stockcode":"SKC82","brandcode":"B82","productname":"METROGYL DG","compositionname":"Chlorhexidine Gluconate (0.5%w\\/w\\/1gm), Metronidazole Topical (15mg)","producttype":"Ointment","availablestock":0,"unitinfo":[{"unitid":"21","unitname":"Ointment"},{"unitid":"22","unitname":"ointment"},{"unitid":"23","unitname":"ointment"},{"unitid":"24","unitname":"oniment"},{"unitid":"33","unitname":"oinment"},{"unitid":"34","unitname":"oinment"}]},{"productgroupid":83,"productid":"3","hsncode":"","stockcode":"SKC83","brandcode":"B83","productname":"MYOSPAZ","compositionname":"Paracetamol (325mg), Chlorzoxazone (250mg)","producttype":"Tablets","availablestock":1000,"unitinfo":[{"unitid":"2","unitname":"Tablets"},{"unitid":"12","unitname":"Strips"},{"unitid":"20","unitname":"box"}]}]}', '2018-04-03 18:08:03', 'A', '2018-04-03 12:38:03'),
(15, 'stockrequest-save', '{"authkey":"","vendorid":"1","requesttype":"vendorstock","ipaddress":"192.168.1.14","productinfo":[{"productid":"2","productgroupid":"82","brandcode":"B82","quantity":"8","unitid":"21"},{"productid":"3","productgroupid":"83","brandcode":"B83","quantity":"5","unitid":"2"}]}', '{"status":true,"message":"success"}', '2018-04-03 18:08:08', 'A', '2018-04-03 12:38:08'),
(16, 'fetch-purchaseorderlist', '{"authkey":"","requestcode":"","vendorinfo":"","fromdate":"","todate":""}', '{"status":true,"message":"success","data":[{"requestcode":"PO\\/V001\\/2018\\/04\\/65","totalitems":"2","vendorname":"SRI S.R.MEDICAL AGENCIES","requestdate":"03\\/04\\/2018","brandcode":"B82"},{"requestcode":"PO\\/V007\\/2017\\/12\\/37","totalitems":"2","vendorname":"A.R. MEDICAL AGENCIES","requestdate":"28\\/12\\/2017","brandcode":"B77"},{"requestcode":"PO\\/V022\\/2017\\/12\\/33","totalitems":"1","vendorname":"Sree M.V.R. Medical Distributors","requestdate":"27\\/12\\/2017","brandcode":"B1"},{"requestcode":"PO\\/V022\\/2017\\/12\\/32","totalitems":"1","vendorname":"Sree M.V.R. Medical Distributors","requestdate":"06\\/12\\/2017","brandcode":"B1"},{"requestcode":"PO\\/V020\\/2017\\/12\\/31","totalitems":"1","vendorname":"SRI ADITHYA MEDICAL & SURGICAL AGENCIES","requestdate":"04\\/12\\/2017","brandcode":"B81"},{"requestcode":"PO\\/V022\\/2017\\/11\\/27","totalitems":"1","vendorname":"Sree M.V.R. Medical Distributors","requestdate":"28\\/11\\/2017","brandcode":"B9"},{"requestcode":"PO\\/V020\\/2017\\/11\\/26","totalitems":"2","vendorname":"SRI ADITHYA MEDICAL & SURGICAL AGENCIES","requestdate":"17\\/11\\/2017","brandcode":"B79"},{"requestcode":"PO\\/V022\\/2017\\/11\\/25","totalitems":"1","vendorname":"Sree M.V.R. Medical Distributors","requestdate":"07\\/11\\/2017","brandcode":"B1"},{"requestcode":"PO\\/V001\\/2017\\/11\\/24","totalitems":"2","vendorname":"SRI S.R.MEDICAL AGENCIES","requestdate":"06\\/11\\/2017","brandcode":"B75"},{"requestcode":"PO\\/V007\\/2017\\/10\\/20","totalitems":"2","vendorname":"A.R. MEDICAL AGENCIES","requestdate":"25\\/10\\/2017","brandcode":"B77"}]}', '2018-04-03 18:08:09', 'A', '2018-04-03 12:38:09'),
(17, 'edit-stockrequestinfo', '{"authkey":"","requestcode":"PO\\/V001\\/2018\\/04\\/65"}', '{"status":true,"message":"Success","vendorid":"1","requesttype":"vendorstock","requestcode":"PO\\/V001\\/2018\\/04\\/65","requestdate":"03\\/04\\/2018","vendorname":"SRI S.R.MEDICAL AGENCIES","data":[{"productgroupid":82,"productid":"2","hsncode":"","stockcode":"SKC82","brandcode":"B82","productname":"METROGYL DG","compositionname":"Chlorhexidine Gluconate (0.5%w\\/w\\/1gm), Metronidazole Topical (15mg)","producttype":"Ointment","availablestock":0,"quantity":"8","requestid":150,"noofbatches":0,"receivedstatus":"ncp","receiveddate":"","unitinfo":[{"unitid":"21","unitname":"Ointment","selected_unitid":true},{"unitid":"22","unitname":"ointment","selected_unitid":false},{"unitid":"23","unitname":"ointment","selected_unitid":false},{"unitid":"24","unitname":"oniment","selected_unitid":false},{"unitid":"33","unitname":"oinment","selected_unitid":false},{"unitid":"34","unitname":"oinment","selected_unitid":false}]},{"productgroupid":83,"productid":"3","hsncode":"","stockcode":"SKC83","brandcode":"B83","productname":"MYOSPAZ","compositionname":"Paracetamol (325mg), Chlorzoxazone (250mg)","producttype":"Tablets","availablestock":1000,"quantity":"5","requestid":151,"noofbatches":0,"receivedstatus":"ncp","receiveddate":"","unitinfo":[{"unitid":"2","unitname":"Tablets","selected_unitid":true},{"unitid":"12","unitname":"Strips","selected_unitid":false},{"unitid":"20","unitname":"box","selected_unitid":false}]}]}', '2018-04-03 18:08:11', 'A', '2018-04-03 12:38:11'),
(18, 'fetch-purchaseorderlist', '{"authkey":"","requestcode":"","vendorinfo":"","fromdate":"","todate":""}', '{"status":true,"message":"success","data":[{"requestcode":"PO\\/V001\\/2018\\/04\\/65","totalitems":"2","vendorname":"SRI S.R.MEDICAL AGENCIES","requestdate":"03\\/04\\/2018","brandcode":"B82"},{"requestcode":"PO\\/V007\\/2017\\/12\\/37","totalitems":"2","vendorname":"A.R. MEDICAL AGENCIES","requestdate":"28\\/12\\/2017","brandcode":"B77"},{"requestcode":"PO\\/V022\\/2017\\/12\\/33","totalitems":"1","vendorname":"Sree M.V.R. Medical Distributors","requestdate":"27\\/12\\/2017","brandcode":"B1"},{"requestcode":"PO\\/V022\\/2017\\/12\\/32","totalitems":"1","vendorname":"Sree M.V.R. Medical Distributors","requestdate":"06\\/12\\/2017","brandcode":"B1"},{"requestcode":"PO\\/V020\\/2017\\/12\\/31","totalitems":"1","vendorname":"SRI ADITHYA MEDICAL & SURGICAL AGENCIES","requestdate":"04\\/12\\/2017","brandcode":"B81"},{"requestcode":"PO\\/V022\\/2017\\/11\\/27","totalitems":"1","vendorname":"Sree M.V.R. Medical Distributors","requestdate":"28\\/11\\/2017","brandcode":"B9"},{"requestcode":"PO\\/V020\\/2017\\/11\\/26","totalitems":"2","vendorname":"SRI ADITHYA MEDICAL & SURGICAL AGENCIES","requestdate":"17\\/11\\/2017","brandcode":"B79"},{"requestcode":"PO\\/V022\\/2017\\/11\\/25","totalitems":"1","vendorname":"Sree M.V.R. Medical Distributors","requestdate":"07\\/11\\/2017","brandcode":"B1"},{"requestcode":"PO\\/V001\\/2017\\/11\\/24","totalitems":"2","vendorname":"SRI S.R.MEDICAL AGENCIES","requestdate":"06\\/11\\/2017","brandcode":"B75"},{"requestcode":"PO\\/V007\\/2017\\/10\\/20","totalitems":"2","vendorname":"A.R. MEDICAL AGENCIES","requestdate":"25\\/10\\/2017","brandcode":"B77"}]}', '2018-04-03 18:08:27', 'A', '2018-04-03 12:38:27'),
(19, 'fetch-invoice', '{"authkey":"","invoicenumber":"","paidstatus":"UnPaid","page":1}', '{"status":true,"message":"success","data":[{"mrnumber":"","patientname":"","invoicedate":"03\\/04\\/2018","billnumber":"P\\/INV\\/TEMP\\/2018\\/04\\/3","paidstatus":"UnPaid","overalltotal":852,"noofsaleproducts":"6","phonenumber":"","saleid":3},{"mrnumber":"","patientname":"","invoicedate":"03\\/04\\/2018","billnumber":"P\\/INV\\/TEMP\\/2018\\/04\\/2","paidstatus":"UnPaid","overalltotal":800,"noofsaleproducts":"2","phonenumber":"","saleid":2},{"mrnumber":"","patientname":"","invoicedate":"03\\/04\\/2018","billnumber":"P\\/INV\\/TEMP\\/2018\\/04\\/1","paidstatus":"UnPaid","overalltotal":394,"noofsaleproducts":"4","phonenumber":"","saleid":1}]}', '2018-04-04 10:36:34', 'A', '2018-04-04 05:06:34'),
(20, 'fetch-invoice', '{"authkey":"","invoicenumber":"","paidstatus":"UnPaid","page":2}', '{"status":true,"message":"success","data":[{"mrnumber":"","patientname":"","invoicedate":"03\\/04\\/2018","billnumber":"P\\/INV\\/TEMP\\/2018\\/04\\/3","paidstatus":"UnPaid","overalltotal":852,"noofsaleproducts":"6","phonenumber":"","saleid":3},{"mrnumber":"","patientname":"","invoicedate":"03\\/04\\/2018","billnumber":"P\\/INV\\/TEMP\\/2018\\/04\\/2","paidstatus":"UnPaid","overalltotal":800,"noofsaleproducts":"2","phonenumber":"","saleid":2},{"mrnumber":"","patientname":"","invoicedate":"03\\/04\\/2018","billnumber":"P\\/INV\\/TEMP\\/2018\\/04\\/1","paidstatus":"UnPaid","overalltotal":394,"noofsaleproducts":"4","phonenumber":"","saleid":1}]}', '2018-04-04 10:36:35', 'A', '2018-04-04 05:06:35'),
(21, 'fetch-cardtype', '{"authkey":""}', '{"status":true,"message":"success","data":[{"cardid":"1","cardtype":"MasterCard"},{"cardid":"2","cardtype":"Visa"},{"cardid":"3","cardtype":"Maestro"},{"cardid":"4","cardtype":"Rupay"},{"cardid":"5","cardtype":"Amex"},{"cardid":"6","cardtype":"Diners"},{"cardid":"7","cardtype":"DebitCard"}]}', '2018-04-04 10:36:49', 'A', '2018-04-04 05:06:49'),
(22, 'fetch-paymentmethod', '{"authkey":""}', '{"status":true,"message":"success","data":[{"paymentmethodid":"1","paymentmethodkey":"Cash Payment"},{"paymentmethodid":"2","paymentmethodkey":"Card Payment"},{"paymentmethodid":"3","paymentmethodkey":"Customer Cheque"},{"paymentmethodid":"4","paymentmethodkey":"Paytm"},{"paymentmethodid":"5","paymentmethodkey":"RTGS\\/NEFT"},{"paymentmethodid":"6","paymentmethodkey":"Customer DD"},{"paymentmethodid":"7","paymentmethodkey":"Discount Amount"}]}', '2018-04-04 10:36:49', 'A', '2018-04-04 05:06:49'),
(23, 'fetch-invoicehistory', '{"authkey":"","saleid":"1"}', '{"status":true,"message":"success","saleid":1,"patientname":"","phonenumber":"","invoicenumber":"P\\/INV\\/TEMP\\/2018\\/04\\/1","overalltotal":394,"mrnumber":"","invoicedate":"03\\/04\\/2018","data":[{"sno":1,"saledetailid":1,"stockresponseid":2,"stockname":"Dolo 650mg Tablet","hsncode":"30049000","items":11},{"sno":2,"saledetailid":2,"stockresponseid":41,"stockname":"Dolo 650mg Tablet","hsncode":"30049000","items":4},{"sno":3,"saledetailid":3,"stockresponseid":5,"stockname":"Dolo 650mg Tablet","hsncode":"30049000","items":10},{"sno":4,"saledetailid":4,"stockresponseid":8,"stockname":"Dolo 650mg Tablet","hsncode":"30049000","items":5}]}', '2018-04-04 10:36:49', 'A', '2018-04-04 05:06:49'),
(24, 'fetch-purchaseorderlist', '{"authkey":"","requestcode":"","vendorinfo":"","fromdate":"","todate":""}', '{"status":true,"message":"success","data":[{"requestcode":"PO\\/V001\\/2018\\/04\\/65","totalitems":"2","vendorname":"SRI S.R.MEDICAL AGENCIES","requestdate":"03\\/04\\/2018","brandcode":"B82"},{"requestcode":"PO\\/V007\\/2017\\/12\\/37","totalitems":"2","vendorname":"A.R. MEDICAL AGENCIES","requestdate":"28\\/12\\/2017","brandcode":"B77"},{"requestcode":"PO\\/V022\\/2017\\/12\\/33","totalitems":"1","vendorname":"Sree M.V.R. Medical Distributors","requestdate":"27\\/12\\/2017","brandcode":"B1"},{"requestcode":"PO\\/V022\\/2017\\/12\\/32","totalitems":"1","vendorname":"Sree M.V.R. Medical Distributors","requestdate":"06\\/12\\/2017","brandcode":"B1"},{"requestcode":"PO\\/V020\\/2017\\/12\\/31","totalitems":"1","vendorname":"SRI ADITHYA MEDICAL & SURGICAL AGENCIES","requestdate":"04\\/12\\/2017","brandcode":"B81"},{"requestcode":"PO\\/V022\\/2017\\/11\\/27","totalitems":"1","vendorname":"Sree M.V.R. Medical Distributors","requestdate":"28\\/11\\/2017","brandcode":"B9"},{"requestcode":"PO\\/V020\\/2017\\/11\\/26","totalitems":"2","vendorname":"SRI ADITHYA MEDICAL & SURGICAL AGENCIES","requestdate":"17\\/11\\/2017","brandcode":"B79"},{"requestcode":"PO\\/V022\\/2017\\/11\\/25","totalitems":"1","vendorname":"Sree M.V.R. Medical Distributors","requestdate":"07\\/11\\/2017","brandcode":"B1"},{"requestcode":"PO\\/V001\\/2017\\/11\\/24","totalitems":"2","vendorname":"SRI S.R.MEDICAL AGENCIES","requestdate":"06\\/11\\/2017","brandcode":"B75"},{"requestcode":"PO\\/V007\\/2017\\/10\\/20","totalitems":"2","vendorname":"A.R. MEDICAL AGENCIES","requestdate":"25\\/10\\/2017","brandcode":"B77"}]}', '2018-04-04 10:37:14', 'A', '2018-04-04 05:07:14');

-- --------------------------------------------------------

--
-- Table structure for table `auth_project_module`
--

CREATE TABLE `auth_project_module` (
  `p_autoid` bigint(20) NOT NULL,
  `moduleName` varchar(250) NOT NULL,
  `moduleCode` varchar(250) NOT NULL,
  `moduleCode2` varchar(250) DEFAULT NULL,
  `moduleMultiple` enum('One','More','Separator') NOT NULL,
  `moduelRoot` varchar(250) NOT NULL,
  `userAction` varchar(250) NOT NULL,
  `FAIcon` varchar(250) NOT NULL,
  `sortOrder` bigint(20) NOT NULL,
  `action` varchar(50) DEFAULT NULL,
  `is_active` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_project_module`
--

INSERT INTO `auth_project_module` (`p_autoid`, `moduleName`, `moduleCode`, `moduleCode2`, `moduleMultiple`, `moduelRoot`, `userAction`, `FAIcon`, `sortOrder`, `action`, `is_active`) VALUES
(8, 'Users', 'branch-admin', '', 'More', '', '', 'fa-sign-in', 1, '["1","2","3","4"]', 1),
(10, 'Manage Users', 'branch-admin', '', 'One', '8', 'index', 'fa-user', 2, '["1","2","3","4"]', 1),
(11, 'Project Module', 'auth-project-module', '', 'One', '21', 'index', 'fa-plus-square', 1, '["1","2","3","4","5"]', 1),
(14, 'Company Master', 'company', '', 'More', '', '', 'fa-building', 3, '["1","2","3","4"]', 1),
(15, 'Company', 'company', '', 'One', '14', 'index', 'fa-info', 1, '["1","2","3","4"]', 1),
(16, 'Company Branch', 'company-branch', '', 'One', '14', 'index', 'fa-sitemap', 3, '["1","2","3","4"]', 1),
(17, 'Company GST', 'company-gst', '', 'One', '14', 'index', 'fa-rocket', 2, '["1","2","3","4"]', 1),
(18, 'Product Master', 'product', '', 'More', '', '', 'fa-product-hunt', 4, '', 1),
(19, 'Product Type', 'producttype', '', 'One', '18', 'index', 'fa-sitemap', 1, '["1","2","3","4"]', 1),
(21, 'Auth Settings', 'auth-user-role', '', 'More', '', '', 'fa-cogs', 2, '', 1),
(22, 'User Role', 'auth-user-role', '', 'One', '21', 'index', 'fa-users', 2, '["1","2","3","4"]', 1),
(23, 'Manage Rights', 'serviceuser-login', '', 'One', '21', 'index', 'fa-user', 3, '["1","2","3","4"]', 1),
(24, 'Module Action', 'module-action', '', 'One', '21', 'index', 'fa-archive', 4, '["1","2","3","4"]', 1),
(25, 'Product', 'product', '', 'One', '18', 'index', 'fa-asterisk', 3, '["1","2","3","4"]', 1),
(26, 'Direct Stock', 'stockmaster', '', 'One', '39', 'index', 'fa-table', 1, '["1","2","3","4"]', 1),
(27, 'Unit', 'unit', '', 'One', '18', 'index', 'fa-medkit', 6, '["1","2","3","4"]', 1),
(28, 'Tax Master', 'taxmaster', '', 'More', '', '', 'fa-money', 14, '', 1),
(29, 'Tax', 'taxmaster', '', 'One', '28', 'index', 'fa-usd', 1, '["1","2","3","4"]', 1),
(30, ' Tax Group', 'taxgrouping', '', 'One', '28', 'index', 'fa-object-group', 2, '["1","2","3","4"]', 1),
(31, 'Sales & Return', 'sales', '', 'More', '', '', 'fa-credit-card', 13, '', 1),
(32, 'Sales Management', 'sales', '', 'One', '31', 'index', 'fa-sitemap', 2, '["1","2","3","4"]', 1),
(33, 'Vendor', 'vendor', '', 'More', '', '', 'fa-hospital-o', 5, '["1","2","3","4"]', 1),
(34, 'Vendor', 'vendor', '', 'One', '33', 'index', 'fa-viacoin', 1, '["1","2","3","4"]', 1),
(35, 'Vendor Branch', 'vendor-branch', '', 'One', '33', 'index', 'fa-sitemap', 3, '["1","2","3","4"]', 1),
(36, 'Composition', 'composition', '', 'One', '18', 'index', 'fa-anchor', 2, '["1","2","3","4","7","8"]', 1),
(37, 'Product Group', 'productgrouping', '', 'One', '18', 'index', 'fa-object-group', 4, '["1","2","3","4"]', 1),
(38, ' Stock Request', 'stockrequest', '', 'One', '39', 'create', 'fa-plus', 1, '["1","2","3","4"]', 0),
(39, 'Stock Master', 'stockmaster', '', 'More', '', '', 'fa-table', 6, '["1","2","3","4"]', 1),
(40, 'Import Stock', 'stockmaster', '', 'One', '39', 'excelimport', 'fa-upload', 3, '', 1),
(41, 'Patient Master', 'patient', '', 'More', '', '', 'fa-user-md', 10, '', 0),
(42, 'Patient', 'patient', '', 'One', '41', 'index', 'fa-stethoscope', 1, '["1","2","3","4"]', 0),
(43, 'PO-Received', 'stockresponse', '', 'One', '65', 'index', 'fa-hand-o-down', 3, '["1","2","3","4"]', 1),
(44, 'Stock audit', 'stockresponse', '', 'One', '39', 'audit', 'fa-table', 2, '["1","2","3","4"]', 1),
(45, 'PO-Request', 'stockrequest', '', 'One', '65', 'index', 'fa-sign-in', 1, '["1","2","3","4"]', 1),
(46, 'SalesDetail', 'saledetail', '', 'One', '31', 'index', 'fa-first-order', 3, '["1","2","3","4"]', 1),
(47, 'Return', 'salesreturn', '', 'One', '31', 'index', 'fa-table', 4, '["1","2","3","4"]', 1),
(48, 'Return Detail', 'returndetail', '', 'One', '31', 'index', 'fa-table', 5, '["1","2","3","4"]', 1),
(49, 'Invoice', 'invoice', '', 'One', '31', 'index', 'fa-first-order', 5, '["1","2","3","4"]', 0),
(52, 'TS-Request', 'transferstock', '', 'One', '66', 'index', 'fa-exchange', 1, '["1","2","3","4"]', 1),
(53, 'Vendor GST', 'vendor-gst', '', 'One', '33', 'index', 'fa-table', 2, '["1","2","3","4"]', 1),
(54, 'Event', 'event', '', 'More', '', '', 'fa-calendar', 11, '["1","2","3","4"]', 0),
(55, 'Calendar', 'event', '', 'One', '54', 'calendarindex', 'fa-calendar', 1, '["1","2","3","4"]', 0),
(56, 'Manufacturer', 'manufacturermaster', '', 'One', '18', 'index', 'fa-list alt', 7, '["1","2","3","4"]', 1),
(57, 'Physician Master', 'physicianmaster', '', 'One', '69', 'index', 'fa-user-md', 1, '["1","2","3","4"]', 1),
(58, 'Add Sales', 'sales', '', 'One', '31', 'create#sales', 'fa-plus-circle', 1, '', 1),
(59, 'TS-Receive', 'transferstock', NULL, 'One', '66', 'receive', 'fa-plus', 3, '["1","2","3","4"]', 1),
(60, 'TS-Approve', 'transferstock', NULL, 'One', '66', 'approve', 'fa-table', 2, '["1","2","3","4"]', 1),
(61, 'Sticky Notes', 'stickynotes', NULL, 'One', '', 'index', 'fa-sticky-note', 18, '["1","2","3","4"]', 1),
(62, 'Email Template', 'emailtemplate', NULL, 'One', '63', 'index', 'fa-table', 1, '["1","2","3","4"]', 1),
(63, 'Email', 'Email Template', NULL, 'More', '', '', 'ti-email', 17, '["1","2","3","4"]', 0),
(64, 'Compose', 'emailtemplate', NULL, 'One', '63', 'compose', 'fa-send', 2, '["1","2","3","4"]', 1),
(65, 'Purchase Order', 'stockrequest', NULL, 'More', '', '', 'fa-table', 11, '["1","2","3","4"]', 1),
(66, 'Transfer Stock ', 'transferstock', NULL, 'More', '', '', 'fa-table', 12, '["1","2","3","4"]', 1),
(67, 'PO-Receive', 'stockrequest', NULL, 'One', '65', 'receive', 'fa-table', 2, '["1","2","3","4"]', 1),
(68, 'PO-Return', 'stockrequest', NULL, 'One', '65', 'return', 'fa-table', 4, '["1","2","3","4"]', 1),
(69, 'Other Master', 'stockrequest', NULL, 'More', '', '', 'fa-table', 18, NULL, 1),
(70, 'Insurance', 'insurance', NULL, 'One', '69', 'index', 'fa-table', 2, '["1","2","3","4"]', 1),
(71, 'Payment Type', 'paymenttype', NULL, 'One', '69', 'index', 'fa-cc-visa', 3, '["1","2","3","4"]', 1),
(72, 'TS-Return', 'transferstock', NULL, 'One', '66', 'return', 'fa fa-table', 4, '["1","2","3","4"]', 1),
(73, 'Report', 'report', NULL, 'More', '', '', 'fa-file-pdf-o', 19, '["7"]', 1),
(74, 'Purchase Order', 'report', NULL, 'One', '73', 'purchaseorder', 'fa-file-excel-o', 2, NULL, 1),
(75, 'Composition', 'report', NULL, 'One', '73', 'composition', 'fa-table', 1, '["7"]', 1),
(76, 'PO-BackOrder', 'stockresponse', NULL, 'One', '65', 'backorder', 'fa-table', 5, NULL, 1),
(77, 'Invoice', 'invoice-payment', NULL, 'More', '', '', 'fa-table', 22, NULL, 1),
(78, 'Sale Payment', 'invoice-payment', NULL, 'One', '77', 'index', 'fa-table', 1, '["9","10","11"]', 1),
(79, 'Counter Sale', 'sales', NULL, 'One', '31', 'countersale', 'fa-table', 6, NULL, 0),
(80, 'TS-Return Approve', 'transferstock', NULL, 'One', '66', 'returnapprove', 'fa-table', 5, '["1","2","3","4"]', 1),
(81, 'Return Payment', 'invoice-payment', NULL, 'One', '77', 'returnpayment', 'fa-table', 3, '["9","10","11"]', 1),
(82, 'PO-Confirm', 'report', NULL, 'One', '73', 'poreceive', 'fa-file-pdf-o', 3, '', 1),
(83, 'Sale History', 'invoice-payment', NULL, 'One', '77', 'paymenthistory', 'fa-history', 2, '["9","10","11"]', 1),
(84, 'Refund History', 'invoicereturn-payment', NULL, 'One', '77', 'index', 'fa-history', 4, '["9","10","11"]', 1),
(85, 'Sale Report', 'report', NULL, 'One', '73', 'salereport', 'fa-table', 5, '["11"]', 1),
(86, 'Return Report', 'report', NULL, 'One', '73', 'returnreport', 'fa-table', 6, NULL, 1),
(87, 'PO-Return', 'report', NULL, 'One', '73', 'poreturn', 'fa-table', 4, NULL, 1),
(88, 'PriceList', 'report', NULL, 'One', '73', 'pricelist', 'fa-table', 7, NULL, 1),
(89, 'Apilog', 'api-log', NULL, 'One', '69', 'index', 'fa-table', 4, NULL, 1),
(90, 'Bulk Products', 'bulkproducts', NULL, 'One', '18', 'index', 'fa-table', 7, '["1","2","3","4"]', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_user_role`
--

CREATE TABLE `auth_user_role` (
  `ur_autoid` int(11) NOT NULL,
  `rolename` varchar(250) NOT NULL,
  `rolecode` varchar(250) NOT NULL,
  `sortorder` bigint(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_user_role`
--

INSERT INTO `auth_user_role` (`ur_autoid`, `rolename`, `rolecode`, `sortorder`, `timestamp`) VALUES
(7, 'Branch Admin', 'branchadmin', 7, '2017-07-25 00:49:49'),
(12, 'superadmin', 'Super', 4, '2017-08-07 08:10:22'),
(14, 'subadmin', 'subadmin', 4, '2017-08-17 04:47:14'),
(15, 'guest', 'guest', 5, '2017-09-18 03:12:12'),
(16, 'Warehouse Access', 'warehouseaccess', 6, '2017-09-27 02:28:27'),
(17, 'Cashier', 'Cashier', 7, '2017-10-06 09:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `branch_admin`
--

CREATE TABLE `branch_admin` (
  `ba_autoid` int(11) NOT NULL,
  `ba_branchid` varchar(250) NOT NULL,
  `ba_code` varchar(250) NOT NULL,
  `authUserRole` varchar(250) NOT NULL,
  `auth_key` varchar(32) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `ba_name` varchar(250) NOT NULL,
  `ba_status` enum('A','I','D') NOT NULL,
  `status` smallint(6) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `ba_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ba_createdat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch_admin`
--

INSERT INTO `branch_admin` (`ba_autoid`, `ba_branchid`, `ba_code`, `authUserRole`, `auth_key`, `password_hash`, `ba_name`, `ba_status`, `status`, `password_reset_token`, `ba_timestamp`, `ba_createdat`) VALUES
(17, '1', '', 'warehouseaccess', '', '$2y$13$tVoNtnluc7UWfpo3VNP.SeBe8dTHUPRsxgO4sDAQmPxRroCWjPUSe', 'admin', 'A', 0, '', '2017-09-27 02:33:34', '2017-09-27 01:33:34'),
(20, '1', '', 'warehouseaccess', '', '$2y$13$.kxRmng3MaCf3jyWUI5abuUUEd3m3DjYqfUxsAw49DoAYmBmD0KoW', 'warehouse', 'A', 0, '', '2017-10-06 10:10:29', '2017-10-06 09:10:29'),
(26, '1', '', 'Super', '', '$2y$13$MOpMz8O5hkiSwh5M5UtzSOr0a9FgWSupTXpiXzBJlg5/8NVJ9Ij.S', 'dmc', 'A', 0, '', '2017-08-16 09:26:31', '2017-08-16 08:26:31'),
(27, '3', '', 'branchadmin', '', '$2y$13$vExFFdviGeRpKzbPCkVzEOOj5dskaen4C4S0BtUh9qvaVMPwnVnTu', 'branch2', 'A', 0, '', '2017-08-17 07:42:24', '2017-08-17 06:42:24'),
(32, '1', '', 'warehouseaccess', NULL, '$2y$13$ZJfiY/d6RviXTu2fTEkxA.rC6JU6/QvXzmFLHbHQD9OqPvBnfBkm.', 'test', 'A', 0, NULL, '2017-09-27 02:33:55', '2017-09-27 01:33:55'),
(33, '3', '', 'branchadmin', NULL, '$2y$13$f/EzsXPakEc7rzlV.S7gquAVQjzSAb5FcYNIpsxv3WjwbFdtWgLaq', 'ss', 'A', 0, NULL, '2017-09-06 07:19:57', '2017-09-06 06:19:57'),
(34, '2', '', 'branchadmin', NULL, '$2y$13$V2JJfhWIjoFLWMzw/MJwSux.ZNHnnhztNl1/2I2ZHhtZTZbWUu1Em', 'dd', 'A', 0, NULL, '2017-10-06 09:24:11', '2017-10-06 08:24:11'),
(35, '4', '', 'branchadmin', NULL, '$2y$13$UjolR4dyF4Wj.25tDHm1VON56rqCMIUCoBhxX2ayMWUJjxyodeCQW', 'branch101', 'A', 0, NULL, '2017-09-09 00:51:18', '2017-09-09 11:51:18'),
(36, '1', '', 'guest', NULL, '$2y$13$KaXqnsVDO08iXAOu1m7RueD2vzaGgHf52dOg7z8lCDSZBvWh4eruS', 'guest01', 'A', 0, NULL, '2017-09-18 03:12:57', '2017-09-18 02:12:57'),
(37, '5', '', 'branchadmin', NULL, '$2y$13$xxxJcR5f3tvOS5Yz.MEqDuk0JEunwUNk9WLwSqoqVMRztbfzDkrPe', 'p1', 'A', 0, NULL, '2017-10-03 01:31:12', '2017-10-03 12:31:12'),
(38, '5', '', 'Cashier', NULL, '$2y$13$d8AgMI3f9eoWWz8lxJUFweAXraagJLk7FElJJmg9rIX078vUGxQVS', 'c1', 'A', 0, NULL, '2017-10-06 09:39:13', '2017-10-06 08:39:13'),
(39, '6', '', 'branchadmin', NULL, '$2y$13$NVoM9Qk0/RqobO6iqX1vPez0qQ6QBmGpnaVjSe8OIAP1UxQJXeiku', 'go', 'A', 0, NULL, '2017-10-13 01:02:29', '2017-10-13 12:02:29'),
(40, '7', '', 'branchadmin', NULL, '$2y$13$NQgNX8/h7qorW4G.2vfzju7280JYE/mTw2OzAOG6NAq/Dv47WkGCC', 'OMR', 'A', 0, NULL, '2017-10-21 01:54:08', '2017-10-21 12:54:08'),
(41, '3', '', 'branchadmin', 'IGbJ3P-ytfwa1wr_D3IAbGNmhSFAsKxn', '$2y$13$tODN22kJ5syGQ.NV2DB8uuzE4BqQ.piH1VrksHNbZXltfF9lWhqte', 'm1', 'A', 0, NULL, '2017-11-29 01:23:02', '2017-11-29 12:23:02'),
(42, '8', '', 'branchadmin', NULL, '$2y$13$LlwtYC7Eoyh/VCX0oLT3dOhyYhEHIh/nkqqcya2aUZIPbwabVnsta', 'L1', 'A', 0, NULL, '2017-10-24 22:19:25', '2017-10-25 09:19:25'),
(43, '8', '', 'Cashier', NULL, '$2y$13$wxPeNuvp/V/sVw8q04dRNu3nlhqNMPTk5txoHpuBB0/P5jrT2Ww9a', 'L2', 'A', 0, NULL, '2017-10-24 22:26:40', '2017-10-25 09:26:40'),
(44, '9', '', 'branchadmin', NULL, '$2y$13$Vlpi0aS1EIoCAQ4R746axeNwHo0Jt0araJyQnNlUPMcVP2Fk0mvzm', 'L3', 'A', 0, NULL, '2017-10-28 01:58:41', '2017-10-28 12:58:41'),
(45, '10', '', 'branchadmin', NULL, '$2y$13$0mSGab0raY48ymBDT8taiugJ0bWXyl6/r.FpoDidxSAKHEzQgxztm', 'h1', 'A', 0, NULL, '2017-11-02 01:35:27', '2017-11-02 12:35:27'),
(46, '11', '', 'branchadmin', NULL, '$2y$13$Sgnfj84v3yJ0WqjcS/czNulPWel98FdkQhMPwK6ZNXRFK0.OnuHou', 'PO1', 'A', 0, NULL, '2017-11-03 01:31:59', '2017-11-03 12:31:59'),
(47, '11', '', 'Cashier', NULL, '$2y$13$hVFW3gkuR5f.k4CEVshAIeP2Q/t3vWQjmeegc6tHg2DQvtUEF9VCS', 'CA1', 'A', 0, NULL, '2017-11-03 01:39:11', '2017-11-03 12:39:11'),
(48, '12', '', 'branchadmin', NULL, '$2y$13$wGBmXtXhmCFsauTwPFe7iOaGCTR/U4y7WXIFO.mieCYg206MW7.fW', 'd1', 'A', 0, NULL, '2017-11-03 01:46:54', '2017-11-03 12:46:54'),
(49, '12', '', 'Cashier', NULL, '$2y$13$eXcAZGCxPETKy/Hvbqs7iuruMPKz74mAGn2Rt.Vw2kiAwkOSYsBwW', 'dc1', 'A', 0, NULL, '2017-11-03 02:05:48', '2017-11-03 01:05:48'),
(50, '13', '', 'branchadmin', 'uGGN8PcUFEeVG8Fcp5Wy49n1IZjZDaGs', '$2y$13$JqYlJy6Wb5XWXreAdcN.2u08Yr0vRf4HF/yaTXw131epasuH7e6eq', 'ICF', 'A', 0, NULL, '2017-11-17 00:50:27', '2017-11-17 11:50:27'),
(51, '14', '', 'branchadmin', 'AgjY13jmrkcZV8AsiXHfuWcfP1QnOHdq', '$2y$13$79HqYnME23ibEjCuL.G0oeWvz9HKufEqpwjMb712dCrMPFKSYSCHu', 'mytest', 'A', 0, NULL, '2017-11-17 23:49:34', '2017-11-18 10:49:34'),
(52, '15', '', 'branchadmin', '9p39vnIwBaYIUJ5vZ0hVQM9N8iONg_BJ', '$2y$13$4LrBwNxnqfccCLhWW8JmeOWEfMn0G5dC.LZu1odHvDUCVa4NC2kL.', 'branchx', 'A', 0, NULL, '2017-12-01 00:17:22', '2017-12-01 11:17:22'),
(53, '1', '', 'Cashier', 'v3iaFd2rwkUFSzvmsOY7SXhDjKkNRQtz', '$2y$13$YMMtChWOgW2t3jGbgmaQzeze9tXdTyVCTS6XMZrw/WVgUSbIZXeCa', '1', 'A', 0, NULL, '2018-01-26 04:57:10', '2018-01-26 03:57:10');

-- --------------------------------------------------------

--
-- Table structure for table `branch_management`
--

CREATE TABLE `branch_management` (
  `branch_id` int(20) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `branch_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `branch_create_date` datetime NOT NULL,
  `branch_code` varchar(50) NOT NULL,
  `branch_location` varchar(50) NOT NULL,
  `branch_city` varchar(50) NOT NULL,
  `branch_mobilenumber` varchar(50) NOT NULL,
  `branch_status` enum('y','n') NOT NULL,
  `service_center_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bulkproducts`
--

CREATE TABLE `bulkproducts` (
  `bulkproductid` bigint(20) NOT NULL,
  `bulkproductname` text NOT NULL,
  `productidz` text NOT NULL,
  `productnamez` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bulkproducts`
--

INSERT INTO `bulkproducts` (`bulkproductid`, `bulkproductname`, `productidz`, `productnamez`, `created_at`, `updated_on`, `updated_by`, `status`) VALUES
(2, 'assdsd', '1,2', 'BECLATE 200 ROTACAPS,METROGYL DG', '2018-02-01 01:24:49', '2018-02-01 01:24:49', 26, 1),
(3, 'abcd', '1,2', 'BECLATE 200 ROTACAPS,METROGYL DG', '2018-04-08 04:49:26', '2018-04-08 04:49:26', 26, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `autoid` bigint(20) NOT NULL,
  `from_user` int(11) DEFAULT NULL,
  `to_user` int(11) NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'A=Active,I=Inactive',
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `company_code` varchar(10) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_type` varchar(25) NOT NULL,
  `cin` varchar(25) NOT NULL,
  `pan` varchar(25) NOT NULL,
  `dln1` varchar(25) NOT NULL,
  `dln2` varchar(25) NOT NULL,
  `dln3` varchar(25) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ipaddress` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_code`, `company_name`, `company_type`, `cin`, `pan`, `dln1`, `dln2`, `dln3`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(8, 'C001', 'Carmel Healthcare Private Limited', 'Private Limited', 'U85100AP2009PTC064896', 'AADCC7476L', '20F:AP/11/03/2017-137691', '21:AP/11/03/2017-137690', '20:AP/11/03/2017-137689', 1, '26', '2017-11-02 12:30:41', '183.83.51.82');

-- --------------------------------------------------------

--
-- Table structure for table `company_branch`
--

CREATE TABLE `company_branch` (
  `branch_id` int(11) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `branch_code` varchar(20) NOT NULL,
  `branch_name` varchar(30) NOT NULL,
  `is_head_office` tinyint(1) NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `address3` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(40) NOT NULL,
  `pincode` varchar(30) NOT NULL,
  `gst_number` varchar(30) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `updated_by` varchar(30) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ipaddress` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_branch`
--

INSERT INTO `company_branch` (`branch_id`, `company_id`, `branch_code`, `branch_name`, `is_head_office`, `address1`, `address2`, `address3`, `city`, `state`, `pincode`, `gst_number`, `email_id`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1, 8, 'B001', 'Warehouse', 1, 'Carmel HealthCare Private Limited,', '3-7-215/1, Bhakarapuram,', 'YSR KADAPA District', 'Pulivendula', '2', '516390', '37AADCC7476LIZ3', '', 1, '26', '2017-08-22 11:24:14', '49.206.117.149'),
(2, 8, 'B002', 'Pharmacy', 0, 'Carmel HealthCare Private Limited', '3-7-215/1, Bhakarapuram,', 'YSR KADAPA District', 'Pulivendula', '2', '516390', '37AADCC7476LIZ3', '', 1, '26', '2017-08-22 11:25:51', '49.206.117.149'),
(3, 8, 'MYTN01', 'MyTN', 0, 'Add1', 'Add2', 'Asdd3', 'Chennai', '35', '564345', '234RWQSZDF', 'AS@sdf.com', 1, '26', '2017-09-06 17:47:42', '49.207.177.156'),
(4, 8, 'BR101', 'Branch101', 0, 'Oppanakara Veethi', 'Oppanakara Veethi', 'Oppanakara Veethi', 'Kovai', '35', '627000', '234RWQSZDF', 'BR101@gmail.com', 1, '26', '2017-09-09 11:50:34', '49.207.177.156'),
(5, 8, 'PUN23', 'PUNA_CH', 0, '234', '234', '234', '34', '32', '234234', 'PNU234234234234', 'sdf@h.fghdfg', 1, '26', '2017-09-16 11:58:26', '49.207.177.156'),
(6, 8, 'T.Nagar', 'T.Nagar', 0, '', '', '', 'Chennai', '35', '600017', '234RWQSZDF', 'senthuran@rucsan.com', 1, '26', '2017-10-13 12:00:35', '106.208.20.29'),
(7, 8, 'MY01', 'OMR', 0, '', '', '', 'Chennai', '35', '600096', '234RWQSZDF', 'senthuran@rucsan.com', 1, '26', '2017-10-21 12:01:05', '122.171.87.93'),
(8, 8, 'LON001', 'Londan', 0, '', '', '', 'London', '35', '600089', '234RWQSZDF', 'senthuran@rucsan.com', 1, '26', '2017-10-25 09:18:58', '106.208.68.80'),
(9, 8, 'L3', 'Lahore', 0, '', '', '', 'Kadapa', '2', '560000', '37AADCC7476LIZ3', 'senthuran@rucsan.com', 1, '26', '2017-10-28 12:53:43', '106.203.85.93'),
(10, 8, 'H001', 'Haryana', 0, 'A1', 'A2', 'A2', 'Haya', '13', '656565', '25AADCC7476HYZ3', 'vv@gg.com', 1, '26', '2017-11-02 12:35:04', '183.83.51.82'),
(11, 8, 'Perungudi', 'Perungudi', 0, '', '', '', 'Chennai', '35', '600096', '234RWQSZDF', 'senthuran@rucsan.com', 1, '26', '2017-11-03 12:25:11', '106.208.21.182'),
(12, 8, 'D01', 'Dummy', 0, '', '', '', 'Ee', '32', '456456', 'PNU234234234234', 'vv@gg.com', 1, '26', '2017-11-03 12:44:20', '183.83.51.82'),
(13, 8, 'ICF', 'ICF', 0, '', '', '', 'Chennai', '35', '600017', '234RWQSZDF', 'senthuran@rucsan.com', 1, '26', '2017-11-17 11:50:06', '122.174.33.82'),
(14, 8, 'mytest', 'Mytest', 0, 'Fdsgsdf', 'Dfsgdfgf', 'Sdfdgfsd', 'Mytest', '2', '600000', '37AADCC7476LIZ3', 'mytest@gmail.com', 1, '26', '2017-11-18 10:49:08', '183.83.51.82'),
(15, 8, 'xc102', 'Branchx', 0, 'Fgfdgdf', 'Gdfgdfg', 'Gdfgdf', 'Tamilnadu', '2', '625009', '37AADCC7476LIZ3', 'fsdgfsd@sdfsd.sdfsd', 1, '26', '2017-12-28 15:12:50', '49.207.188.110'),
(16, 8, 'TESTER1', 'TESTER1', 0, 'TEST1', 'TEST1', 'TEST1', 'TEST1', '4', '111112', '25AADCC7476HYZ5', 'test1@gmail.com', 1, '26', '2017-12-28 18:25:49', '49.207.188.110');

-- --------------------------------------------------------

--
-- Table structure for table `company_gst`
--

CREATE TABLE `company_gst` (
  `gstid` int(11) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `stateid` bigint(20) NOT NULL,
  `gst` varchar(25) NOT NULL,
  `isactive` tinyint(1) NOT NULL,
  `updatedby` varchar(20) NOT NULL,
  `updatedon` datetime NOT NULL,
  `updatedipaddress` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_gst`
--

INSERT INTO `company_gst` (`gstid`, `company_id`, `stateid`, `gst`, `isactive`, `updatedby`, `updatedon`, `updatedipaddress`) VALUES
(1, 8, 2, '37AADCC7476LIZ3', 1, '26', '2017-08-22 11:21:32', '49.206.117.149'),
(2, 8, 35, '234RWQSZDF', 1, '26', '2017-09-06 17:45:38', '49.207.177.156'),
(3, 8, 32, 'PNU234234234234', 1, '26', '2017-09-16 11:57:48', '49.207.177.156'),
(4, 8, 13, '25AADCC7476HYZ3', 1, '26', '2017-11-02 12:34:03', '183.83.51.82'),
(5, 8, 4, '25AADCC7476HYZ5', 1, '26', '2017-12-28 15:20:57', '49.207.188.110');

-- --------------------------------------------------------

--
-- Table structure for table `composition`
--

CREATE TABLE `composition` (
  `composition_id` int(11) NOT NULL,
  `composition_name` varchar(100) NOT NULL,
  `agestart` int(3) NOT NULL,
  `age_end` int(3) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ipaddress` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `composition`
--

INSERT INTO `composition` (`composition_id`, `composition_name`, `agestart`, `age_end`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1, 'Beclometasone (200mg)', 10, 88, 1, '26', '2017-08-29 07:10:42', '49.248.229.83'),
(2, 'Chlorhexidine Gluconate (0.5%w/w/1gm), Metronidazole Topical (15mg)', 0, 99, 1, '36', '2017-09-23 01:04:33', '117.201.17.250'),
(3, 'Paracetamol (325mg), Chlorzoxazone (250mg)', 1, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(4, 'General', 0, 98, 1, '26', '2017-08-29 07:10:53', '49.248.229.83'),
(5, 'Guduchi (Tinospora Cordifolia), Saunf (Focrorhiza Valgare), Kutki (Picroehiza Kurroa)', 0, 16, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(6, 'PODOPHILLUM RESIN', 3, 31, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(7, 'MEFLOQUINE 250MG', 1, 14, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(8, 'Surgical', 3, 23, 1, '26', '2017-08-29 07:11:02', '49.248.229.83'),
(9, 'Ranitidine (50mg/2ml)', 5, 22, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(10, 'Ofloxacin (200mg)', 8, 17, 1, '36', '2017-09-22 22:19:58', '103.204.29.216'),
(11, 'Metoclopramide (10mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(12, 'Thyroxine (25mcg)', 0, 99, 1, '26', '2017-08-29 07:14:11', '49.248.229.83'),
(13, 'Thyroxine (100mcg)', 0, 99, 1, '26', '2017-08-29 07:17:51', '106.203.121.80'),
(14, 'Isoniazid (300mg), Rifampicin (450mg), Ethambutol (800mg), Pyrazinamide (750mg)', 0, 99, 1, '26', '2017-09-09 22:43:37', '49.207.187.48'),
(15, 'Rifampicin (450mg), Isoniazid (300mg)', 0, 99, 1, '36', '2017-09-26 15:13:29', '117.207.101.207'),
(16, 'Aswagandha, Ginseng, Hygrophlia Spinosa, Mucuna Pruriens, And Tribulus Terretris', 0, 99, 1, '26', '2017-08-25 13:48:45', '49.207.187.48'),
(17, 'Estriol Topical (1mg)', 0, 99, 1, '36', '2017-09-22 16:28:25', '117.221.135.89'),
(18, 'Mupirocin Topical (2%)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(19, 'Sodium Chloride, Potassium Chloride, Sodium Citrate, Anhydrous Dextrose, Calcium Lactate, Magnesium', 0, 99, 1, '36', '2017-09-18 20:28:49', '117.249.223.241'),
(20, 'Roxithromycin (50mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(21, 'Pneumococcal Polysaccharide Vaccine (2.2mcg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(22, 'Enalapril (2.5mg)', 0, 99, 1, '26', '2017-09-10 11:39:30', '49.207.187.48'),
(23, 'Cetirizine (5mg), Phenylephrine (10mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(24, 'Furazolidone (40mg/5ml), Metronidazole (200mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(29, 'MULTIVITAMINS, MULTIMINERALS', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(30, 'Carbimazole (5mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(31, 'GENERAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(32, 'Erythromycin Topical (125mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(33, 'GENERAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(34, 'Acyclovir (400mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(35, 'Phenytoin (30mg/5ml)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(36, 'Carbamazepine (100mg)', 0, 99, 1, '36', '2017-09-19 17:33:20', '157.50.12.3'),
(37, 'Ondansetron (2mg/5ml)', 0, 99, 1, '36', '2017-09-23 00:18:42', '117.201.17.250'),
(38, 'Citric acid and Sodium citrate', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(39, 'Brahmi, Ashwagandha', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(40, 'ZINC-20MG/5ML', 0, 99, 1, '36', '2017-09-18 21:50:46', '117.249.223.241'),
(41, 'Benzalkonium Chloride (0.02% w/v), Choline Salicylate (9% w/v)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(42, 'GENERAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(43, 'Himsra, Cichorium Intybus, Mandur Bhasma, Kakamachi, Terminalia Arjuna, Kasamarda, Achillea Millefol', 0, 99, 1, '36', '2017-09-18 22:08:23', '117.249.131.69'),
(44, 'Lindane (0.1%), Cetrimide (1%)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(45, 'Lindane (0.1%), Cetrimide (1%)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(46, 'Pyridoxine, Nicotinamide, Cyanocobalamin And Lysine', 0, 99, 1, '36', '2017-09-20 06:20:05', '157.50.11.158'),
(47, 'Phenytoin (100mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(48, 'Calcium Carbonate, Zinc, Magnesium, Manganese, Boron', 0, 99, 1, '36', '2017-09-19 08:28:58', '157.50.8.195'),
(49, 'Betamethasone (0.1%w/v), Neomycin (0.5%w/v)', 0, 99, 1, '26', '2017-08-29 07:45:19', '106.203.121.80'),
(50, 'Amoxicillin (250mg)', 0, 99, 1, '36', '2017-09-26 13:02:17', '117.207.101.207'),
(51, 'Betamethasone (1mg)', 0, 99, 1, '36', '2017-09-22 20:29:52', '103.204.29.216'),
(52, 'Chlorpheniramine (2mg), Paracetamol (500mg), Phenylephrine (5mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(54, 'Theophylline(25.3mg),Etophylline(84.7mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(55, 'Chloroquine (50mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(56, 'Lactulose (10gm)', 0, 99, 1, '36', '2017-09-19 18:17:01', '157.50.12.3'),
(57, 'Permethrin (5% W/w)', 0, 99, 1, '36', '2017-09-23 17:04:26', '117.222.161.88'),
(58, 'Betamethasone Topical (0.10% w/w), Clioquinol (Iodochlorhydroxyquin) (3% w/w)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(59, 'Betamethasone Topical (0.10% w/w), Clioquinol (Iodochlorhydroxyquin) (3% w/w)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(60, 'Ambroxol (15mg), Guaifenesin (50mg), Terbutaline (1.25mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(61, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(62, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(63, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(64, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(65, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(66, '3% NACL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(67, 'Ofloxacin (200mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(68, 'Cefalexin (500mg)', 0, 99, 1, '36', '2017-09-26 17:46:01', '117.222.161.67'),
(69, 'Diptheria Immune Globulin (30IU), Haemophilus B Conjugate Vaccine (10mcg), Hepatitis B (10mcg)', 0, 99, 1, '36', '2017-09-19 09:01:57', '157.50.8.195'),
(70, 'Wintergreen Oil, Mint Flowers, Turpentine Oil, And Eucalyptus Oil', 0, 99, 1, '26', '2017-08-25 13:43:42', '49.207.187.48'),
(71, 'PARACETAMOL, PROPYPHENAZONE AND CAFFEINE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(72, 'Norfloxacin (100mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(73, 'Norfloxacin (200mg)', 0, 99, 1, '26', '2017-09-09 17:30:38', '49.207.187.48'),
(74, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(75, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(76, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(77, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(78, 'SURGICal', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(79, 'L-Leucine (5.6mg), L-Isoleucine (12.5mg)', 0, 99, 1, '36', '2017-09-19 10:05:29', '157.50.8.195'),
(80, 'BENZOIN', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(81, 'Aceclofenac (100mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(82, 'Aceclofenac (100mg), Paracetamol (325mg)', 0, 99, 1, '26', '2017-08-25 11:55:44', '49.207.187.48'),
(83, 'Pyridoxine and Folic acid', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(84, 'SILYMARINE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(85, 'Amikacin (250mg)', 0, 99, 1, '36', '2017-09-19 13:05:03', '157.50.12.3'),
(86, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(87, 'Trihexyphenidyl (2mg)', 0, 99, 1, '36', '2017-09-26 01:16:47', '117.201.28.157'),
(88, 'Tranexamic Acid (500mg), Mefenamic Acid (250mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(89, 'Dicyclomine (20mg), Paracetamol (500mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(90, 'Flavoxate (200mg)', 0, 99, 1, '36', '2017-09-23 19:03:08', '117.201.24.231'),
(91, 'Ethacridine (1mg)', 0, 99, 1, '36', '2017-09-19 13:23:43', '157.50.12.3'),
(92, 'Pyridoxine and Folic acid', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(93, 'Lysine (200mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(94, 'Triamcinolone Topical (0.1% W/w)', 0, 99, 1, '26', '2017-08-25 23:30:39', '49.207.187.48'),
(95, 'Diclofenac Topical (NA)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(96, 'Lactulose(10gm)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(97, 'Letrozole (2.5mg)', 0, 99, 1, '36', '2017-09-22 22:07:05', '103.204.29.216'),
(98, 'Ethinyl Estradiol (0.03mg), Drospirenone (3mg)', 0, 99, 1, '36', '2017-09-26 11:14:11', '117.207.101.207'),
(99, 'PROTIEN POWDER', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(100, 'VITAMIN B & B12', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(101, 'Ethamsylate (125mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(102, 'GENERAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(103, 'OXYTOCIN', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(104, 'Doxylamine (10mg), Vitamin B6 (Pyridoxine) (10mg)', 0, 99, 1, '36', '2017-09-19 13:48:58', '157.50.12.3'),
(105, 'Lajjalu and Yashad ', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(106, 'Carboprost (250mcg)', 0, 99, 1, '36', '2017-09-19 13:57:30', '157.50.12.3'),
(107, 'Dinoprostone Topical (0.5mg)', 0, 99, 1, '36', '2017-09-19 15:49:44', '157.50.12.3'),
(108, 'Ibuprofen (400mg), Paracetamol (325mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(109, 'Ampicillin (500mg)', 0, 99, 1, '36', '2017-09-19 15:55:08', '157.50.12.3'),
(110, 'Hydrocortisone (200mg)', 0, 99, 1, '36', '2017-09-19 16:07:23', '157.50.12.3'),
(111, 'Measles Virus Vaccine (1000ccid50), Mumps Virus Vaccine (5000ccid50), Rubella (German Measles) (1000', 0, 99, 1, '36', '2017-09-19 16:10:17', '157.50.12.3'),
(112, 'Salbutamol (200mcg)', 0, 99, 1, '36', '2017-09-19 16:44:02', '157.50.12.3'),
(113, 'Diltiazem (30mg)', 0, 99, 1, '36', '2017-09-19 16:45:18', '157.50.12.3'),
(114, 'Povidone Iodine (5% W/w), Tinidazole Topical (1% W/w)', 0, 99, 1, '36', '2017-09-19 16:47:20', '157.50.12.3'),
(115, 'Xylometazoline (1mg/1ml)', 0, 99, 1, '36', '2017-09-19 16:50:22', '157.50.12.3'),
(116, 'Chlorpheniramine (1mg), Phenylephrine (5mg), Paracetamol (125mg), Sodium Citrate (60mg)', 0, 99, 1, '36', '2017-09-19 16:55:33', '157.50.12.3'),
(117, 'PROTIEN POWDER', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(119, 'Acyclovir (200mg)', 0, 99, 1, '36', '2017-09-25 23:29:40', '117.201.30.118'),
(120, 'Magaldrate (400mg), Polydimethyl Siloxane (20mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(121, 'Ranitidine (150mg)', 0, 99, 1, '36', '2017-09-24 22:25:26', '117.201.24.173'),
(122, '5g protein, vitamin B1,B12,iron,zinc ', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(123, 'Domperidone (20mg), Paracetamol (500mg)', 0, 99, 1, '36', '2017-09-23 20:40:24', '117.201.24.231'),
(124, 'Colistin (12.5mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(125, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(126, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(127, 'POWDER', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(128, 'Bacitracin Topical (400IU), Neomycin (3400IU), Polymyxin B (5000IU)', 0, 99, 1, '36', '2017-09-19 17:08:52', '157.50.12.3'),
(129, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(130, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(131, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(132, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(133, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(134, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(135, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(136, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(137, 'Paradichlorobenzene, Chlorbutol, Turpentine oil, and Lignocaine', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(138, 'Amylmetacresol (0.6mg), Dextromethorphan (5mg)', 0, 99, 1, '36', '2017-09-19 17:13:15', '157.50.12.3'),
(139, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(140, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(141, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(142, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(143, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(144, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(145, 'Ondansetron (2mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(146, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(147, 'Bisacodyl (5mg)', 0, 99, 1, '36', '2017-09-26 14:06:46', '117.207.101.207'),
(148, 'Cefalexin (125mg)', 0, 99, 1, '36', '2017-09-24 22:54:43', '117.201.17.114'),
(149, 'Propylene Glycol And Urea', 0, 99, 1, '36', '2017-09-19 17:23:23', '157.50.12.3'),
(150, 'Arteether (150mg)', 0, 99, 1, '36', '2017-09-19 17:25:38', '157.50.12.3'),
(151, 'Bromhexine - 2 MG, Guaiphenesin - 25 MG, Menthol - 0.5 MG, Terbutaline - 0.75 MG', 0, 99, 1, '36', '2017-09-19 17:29:06', '157.50.12.3'),
(152, 'Carbamazepine(100 mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(153, 'Potassium Chloride', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(154, 'Nifedipine (5mg)', 0, 99, 1, '36', '2017-09-19 17:36:19', '157.50.12.3'),
(155, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(156, 'VITAMIN A&D', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(157, 'Cetirizine (10mg)', 0, 99, 1, '36', '2017-09-26 20:00:30', '117.207.104.192'),
(158, 'Digoxin (0.25mg)', 0, 99, 1, '26', '2017-09-15 12:48:11', '180.151.35.68'),
(159, 'Ceftriaxone (500mg)', 0, 99, 1, '36', '2017-09-22 23:52:43', '103.204.29.216'),
(160, 'Dextromethorphan (10mg), Triprolidine (1.25mg), Phenylephrine (12.5mg), Menthol (1.5mg)', 0, 99, 1, '36', '2017-09-23 19:09:01', '117.201.24.231'),
(161, 'Ambroxol (15mg), Guaifenesin (50mg), Terbutaline (1.5mg)', 0, 99, 1, '36', '2017-09-22 20:03:45', '103.204.29.216'),
(163, 'Sodium Chloride', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(164, 'Mefenamic Acid (250mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(165, 'VITAMINA&D ', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(166, 'Vitamin A (1000IU), Thiamine(Vitamin B1) (5mg), Vitamin B2 (1.40mg), Vitamin D3 (100IU), Pantothenic', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(167, 'Guaifenesin (50mg/5ml), Bromhexine (4mg/5ml), Diphenhydramine (8mg/5ml), Ammonium Chloride (100mg/5m', 0, 99, 1, '36', '2017-09-19 23:22:52', '157.50.8.18'),
(168, 'AMPICILLIN 500MG', 0, 99, 1, '36', '2017-09-19 17:57:42', '157.50.12.3'),
(169, 'Salbutamol (2.5mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(170, 'Hydroxyzine (6mg)', 0, 99, 1, '36', '2017-09-23 20:12:19', '117.201.24.231'),
(171, 'Domperidone (15mg), Cinnarizine (20mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(172, 'Arteether (75mg)', 0, 99, 1, '36', '2017-09-19 18:13:16', '157.50.12.3'),
(173, 'Lactulose(10gm)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(174, 'Ethamsylate (125 Mg)', 0, 99, 1, '36', '2017-09-19 18:17:49', '157.50.12.3'),
(175, 'Cefalexin (100mg)', 0, 99, 1, '26', '2017-09-09 13:19:34', '49.207.187.48'),
(176, 'RACECADOTRIL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(177, 'Ursodeoxycholic Acid (300mg)', 0, 99, 1, '36', '2017-09-24 22:38:21', '117.201.31.206'),
(178, 'Amylmetacresol, Dextromethorphan ', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(179, 'Bromocriptine', 0, 99, 1, '36', '2017-09-19 18:29:52', '157.50.12.3'),
(180, 'Cefpodoxime (100mg)', 0, 99, 1, '36', '2017-09-26 19:01:23', '103.60.74.3'),
(181, 'Betamethasone (1mg)', 0, 99, 1, '26', '2017-08-29 07:50:14', '106.203.121.80'),
(182, 'Benzocaine (2.7%w/v), Chlorbutol (5%w/v), Paradichlorobenzene (2%w/v), Turpentine Oil (15%w/v)', 0, 99, 1, '36', '2017-09-19 22:43:29', '157.50.8.18'),
(183, 'Phenytoin (50mg/2ml)', 0, 99, 1, '36', '2017-09-19 22:45:39', '157.50.8.18'),
(184, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(185, '0.01 Mg Oxymetazoline Hydrochloride USP, 0.3 Mg Benzalkonium Chloride Solution 50% IP', 0, 99, 1, '36', '2017-09-19 22:47:27', '157.50.8.18'),
(186, 'SILVER NITRATE', 0, 99, 1, '36', '2017-09-23 00:41:20', '117.201.17.250'),
(187, 'Mannitol (20%)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(188, 'Xylometazoline (0.05% w/v)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(189, 'Diclofenac', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(190, 'Salbutamol (5mg)', 0, 99, 1, '36', '2017-09-19 23:00:51', '157.50.8.18'),
(191, 'Dicyclomine (10mg)', 0, 99, 1, '36', '2017-09-23 22:36:43', '117.201.24.231'),
(192, 'Fungal diastase and Pepsin', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(193, 'Vitamin A (1000IU), Thiamine(Vitamin B1) (5mg), Vitamin B2 (1.40mg), Vitamin D3 (100IU), Pantothenic', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(194, 'Ethamsylate (500mg)', 0, 99, 1, '36', '2017-09-25 01:07:04', '117.201.30.48'),
(195, 'Rabeprazole (20mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(196, 'Rbutin, Quinolone Derivatives, Bioflavonoids, Glucosides', 0, 99, 1, '36', '2017-09-19 23:11:15', '157.50.8.18'),
(197, 'Amino Acids, Carbohydrates, Minerals And Vitamins', 0, 99, 1, '36', '2017-09-19 23:17:20', '157.50.8.18'),
(198, 'Digoxin (50mcg/ml)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(199, 'Vitamin A as palmitate, Cholecalciferol, Thiamine', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(200, 'Guaifenesin(50 mg/ 5 ml),Bromhexine(4 mg/5 ml),?Diphenhydramine(8 mg/5', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(201, 'Ambroxol (7.5mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(202, 'Fungal diastase and Pepsin', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(203, 'Metoclopramide (10mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(205, 'Roxithromycin (150mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(206, 'Sodium chloride, Potassium chloride, Sodium citrate, anhydrous Dextrose, Calcium lactate, Magnesium ', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(207, 'Tetanus Toxoid (1.5lf)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(208, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(209, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(210, 'Tetanus Toxoid (250iu)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(211, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(212, 'Benzalkonium Chloride, Choline Salicylate', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(213, 'Benzalkonium Chloride, Choline Salicylate', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(214, 'Methylergometrine (0.2mg/1ml)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(215, 'Paracetamol (300mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(216, 'Betahistine (8mg)', 0, 99, 1, '36', '2017-09-26 13:53:43', '117.207.101.207'),
(217, 'Ferrous Ascorbic Acid', 0, 99, 1, '36', '2017-09-20 06:32:15', '157.50.11.158'),
(218, 'Isoniazid (300mg), Rifampicin (450mg), Ethambutol (800mg), Pyrazinamide (750mg)', 0, 99, 1, '36', '2017-09-20 05:33:43', '157.50.11.158'),
(219, 'Phytomenadione (10mg)', 0, 99, 1, '36', '2017-09-22 20:06:39', '103.204.29.216'),
(220, 'Ketoconazole Topical (2% W/w)', 0, 99, 1, '36', '2017-09-24 11:30:53', '117.207.109.148'),
(221, 'Heparin (25000IU)', 0, 99, 1, '36', '2017-09-24 17:06:38', '117.207.109.148'),
(222, '0.5 Mg Oxymetazoline Hydrochloride USP, 0.3 Mg Benzalkonium Chloride Solution 50% IP', 0, 99, 1, '36', '2017-09-20 05:40:26', '157.50.11.158'),
(223, 'Tocopheryl Acetate', 0, 99, 1, '36', '2017-09-20 14:30:42', '157.50.8.207'),
(224, 'Insulin Neutral Protamine Hagedorn (NPH) (70%), Insulin Regular (30%)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(225, 'Prednisolone (5mg/ml)', 0, 99, 1, '26', '2017-08-25 11:39:39', '49.207.187.48'),
(226, 'Pyridoxine and Folic acid', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(227, 'Cyanocobalamin (1000mcg), D-Panthenol (50mg), Niacinamide (100mg), Vitamin B6 (Pyridoxine) (100mg), ', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(228, 'Pyritinol (100mg)', 0, 99, 1, '36', '2017-09-26 00:46:43', '117.201.28.157'),
(229, 'FORMOLIN', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(230, 'Roxithromycin (300mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(231, '0.25 Mg Oxymetazoline Hydrochloride USP, 0.3 Mg Benzalkonium Chloride Solution 50% IP', 0, 99, 1, '36', '2017-09-20 06:10:39', '157.50.11.158'),
(232, 'Oxymetazoline Hydrochloride 0.05MG', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(233, 'Pasanabheda and Shilapushpa', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(234, 'Clobazam (10mg)', 0, 99, 1, '36', '2017-09-26 18:51:23', '103.60.74.3'),
(235, '?Pyridoxine, ?Nicotinamide, Cyanocobalamin and Lysine', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(236, 'Ethinyl Estradiol (0.03mg), Levonorgestrel (0.15mg)', 0, 99, 1, '36', '2017-09-20 06:21:07', '157.50.11.158'),
(237, 'Norgestrel (0.5mg), Ethinyl Estradiol (0.05mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(238, 'Methylcobalamin (1mg), Vitamin B6 (Pyridoxine) (100mg), Niacinamide (10mg)', 0, 99, 1, '36', '2017-09-26 20:10:36', '117.207.104.192'),
(239, 'Cilnidipine (10mg), Telmisartan (40mg)', 0, 99, 1, '36', '2017-09-26 20:10:13', '117.207.104.192'),
(240, 'Piroxicam (20mg)', 0, 99, 1, '36', '2017-09-22 20:20:44', '103.204.29.216'),
(241, 'Povidone Iodine (10% W/w)', 0, 99, 1, '36', '2017-09-23 00:46:02', '117.201.17.250'),
(242, 'Standard Cobra Venom (Naja naja) (0.6mg), Standard common krait Venom (Bangarus caeruleus) (0.45mg),', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(243, 'FERROUS ASCORBIC ACID', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(244, 'Triclofos (500mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(245, 'Carbimazole (10mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(246, 'Recombinant Hepatitis B Surface Antigen (20mcg), Thiomersal (0.05mg)', 0, 99, 1, '36', '2017-09-20 06:35:31', '157.50.11.158'),
(247, 'Pantoprazole (40mg)', 0, 99, 1, '36', '2017-09-24 11:52:45', '117.207.109.148'),
(248, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(249, 'Epinephrine (NA)', 0, 99, 1, '36', '2017-09-20 06:38:40', '157.50.11.158'),
(250, 'MENADIONE SODIUM ', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(251, 'Piroxicam (2ml)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(252, 'Promethazine (25mg)', 0, 99, 1, '36', '2017-09-22 20:33:43', '103.204.29.216'),
(253, 'Ethambutol (400mg)', 0, 99, 1, '36', '2017-09-20 06:43:30', '157.50.11.158'),
(254, 'Ethambutol (600mg)', 0, 99, 1, '26', '2017-09-10 10:20:11', '49.207.187.48'),
(255, 'Caper Bush (Himsra) and Chicory (Kasani)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(256, 'Ofloxacin (400mg)', 0, 99, 1, '36', '2017-09-26 19:41:43', '117.207.104.192'),
(257, 'Ceftriaxone (250mg), Sulbactam (125mg)', 0, 99, 1, '36', '2017-09-20 14:12:32', '157.50.8.207'),
(258, 'Ofloxacin (100mg)', 0, 99, 1, '36', '2017-09-24 03:16:39', '117.201.24.231'),
(259, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(260, 'Levosalbutamol (100mcg), Ipratropium (40mcg)', 0, 99, 1, '26', '2017-09-17 11:33:31', '49.207.184.10'),
(261, 'Formoterol (6mcg), Budesonide (100mcg)', 0, 99, 1, '36', '2017-09-20 07:37:44', '157.50.11.158'),
(262, 'HEPATITIS-B VACCINE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(263, 'Diphtheria Toxoid (30IU), Haemophilus Influenzae Type B Capsular Polysaccharide (10mcg), Pertussis T', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(264, 'Hydroxyprogesterone (500mg)', 0, 99, 1, '36', '2017-09-20 07:41:15', '157.50.11.158'),
(265, 'Amikacin (100mg)', 0, 99, 1, '36', '2017-09-20 07:42:18', '157.50.11.158'),
(266, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(267, 'Carbamazepine (400mg)', 0, 99, 1, '36', '2017-09-26 14:48:53', '117.207.101.207'),
(268, 'Carbamazepine(100 mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(269, 'Xantinol Nicotinate (500mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(270, 'Propranolol (10mg)', 0, 99, 1, '36', '2017-09-20 07:50:40', '157.50.11.158'),
(271, 'Phytoherbs', 0, 99, 1, '36', '2017-09-20 07:51:46', '157.50.11.158'),
(272, 'Medroxyprogesterone (10mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(273, 'Cefotaxime (250mg)', 0, 99, 1, '36', '2017-09-26 11:33:12', '117.207.101.207'),
(274, 'Vitamin A 25000 I.U.', 0, 99, 1, '36', '2017-09-20 07:57:30', '157.50.11.158'),
(275, 'Theophylline(25.3mg),Etophylline(84.7mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(276, 'Ceftriaxone (250mg), Tazobactum (31.25mg)', 0, 99, 1, '36', '2017-09-21 06:15:18', '157.50.12.3'),
(277, 'CALCIUM GLUCONATE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(278, 'Metronidazole (400mg)', 0, 99, 1, '36', '2017-09-20 08:02:05', '157.50.11.158'),
(279, 'Isoniazid (150mg), Pyrazinamide (750mg), Rifampicin (225mg)', 0, 99, 1, '26', '2017-09-09 22:48:37', '49.207.187.48'),
(280, 'Diazepam (2mg), Imipramine (25mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(281, 'Alprazolam (0.5mg)', 0, 99, 1, '36', '2017-09-20 08:06:08', '157.50.11.158'),
(282, 'VITAMIN B12', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(283, 'Domperidone (10mg), Ranitidine (150mg)', 0, 99, 1, '36', '2017-09-20 08:11:15', '157.50.11.158'),
(284, 'Calcium Dobesilate (500mg)', 0, 99, 1, '36', '2017-09-20 08:13:32', '157.50.11.158'),
(285, 'Metoclopramide (5mg), Paracetamol (500mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(286, 'Aceclofenac (100mg), Paracetamol (325mg), Serratiopeptidase (15mg)', 0, 99, 1, '26', '2017-08-25 11:54:18', '49.207.187.48'),
(287, 'Doxycycline (100mg), Lactobacillus (5Billion Spores)', 0, 99, 1, '36', '2017-09-26 15:06:56', '117.207.101.207'),
(288, 'Chloroquine (500mg)', 0, 99, 1, '36', '2017-09-25 20:19:18', '117.207.97.104'),
(289, 'Ondansetron (4mg)', 0, 99, 1, '36', '2017-09-24 02:53:08', '117.201.24.231'),
(290, 'Amitriptyline (10mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(291, 'PYRIDOXINE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(292, 'Isosorbide Mononitrate (20mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(293, 'ONDANSETRON', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(294, 'Dimenhydrinate (50mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(295, 'Stanozolol (2mg)', 0, 99, 1, '36', '2017-09-20 08:40:39', '157.50.11.158'),
(296, 'Clopidogrel (75mg)', 0, 99, 1, '26', '2017-09-15 12:31:37', '180.151.35.68'),
(298, 'Biotin, N-Acetyl Cysteine, Calcium Pantothenate, Selenium, Copper And Zinc', 0, 99, 1, '36', '2017-09-20 09:46:35', '157.50.8.144'),
(299, 'Prochlorperazine (5mg)', 0, 99, 1, '36', '2017-09-20 09:50:08', '157.50.8.144'),
(300, 'Guaifenesin (50mg), Terbutaline (1.25mg), Bromhexine (4mg)', 0, 99, 1, '36', '2017-09-22 23:41:40', '103.204.29.216'),
(301, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(302, 'Chlorpheniramine (1mg), Paracetamol (125mg), Phenylephrine (2.5mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(303, 'Isoniazid (300mg), Rifampicin (450mg), Ethambutol (800mg), Pyrazinamide (750mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(304, 'Methylcobalamin (750mcg), Pregabalin (75mg)', 0, 99, 1, '36', '2017-09-25 22:57:25', '117.201.30.118'),
(305, 'Dicyclomine (10mg), Dextropropoxyphene (100mg), Paracetamol (400mg)', 0, 99, 1, '26', '2017-09-09 17:57:43', '49.207.187.48'),
(306, 'Erythromycin (500mg)', 0, 99, 1, '36', '2017-09-20 09:57:56', '157.50.8.207'),
(307, 'Isosorbide Dinitrate (5mg)', 0, 99, 1, '36', '2017-09-20 09:59:49', '157.50.8.207'),
(308, 'Calcium pantothenate, Folic acid, Niacinamide, Pyridoxine, Riboflavin, ', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(309, 'Acyclovir Topical (5%)', 0, 99, 1, '36', '2017-09-23 20:56:20', '117.201.24.231'),
(310, 'DIGOXIN', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(311, 'CALCIUM GLUCONATE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(312, 'L-Ornithine L-Aspartate (150mg), Pancreatin (100mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(313, 'Nifedipine (10mg)', 0, 99, 1, '36', '2017-09-20 10:09:25', '157.50.8.207'),
(314, 'Metoclopramide (5mg/ml)', 0, 99, 1, '36', '2017-09-26 21:09:22', '59.93.11.153'),
(315, 'ATROPINE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(316, 'Pyridoxine,  Nicotinamide, Cyanocobalamin And Lysine', 0, 99, 1, '36', '2017-09-20 10:15:21', '157.50.8.207'),
(317, 'GENERAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(318, 'Ambroxol (7.5mg), Levosalbutamol (0.25mg), Guaifenesin (12.5mg)', 0, 99, 1, '36', '2017-09-26 17:31:02', '117.222.161.67'),
(319, 'DIGOXIN', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(320, 'Diclofenac (50mg), Trypsin Chymotrypsin (50000au)', 0, 99, 1, '36', '2017-09-26 15:21:04', '117.207.101.207'),
(321, 'Ibuprofen (400mg), Paracetamol (325mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(322, 'MOMETASONE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(323, 'Levosalbutamol (1.25mg), Ipratropium (500mcg)', 0, 99, 1, '26', '2017-09-17 11:39:04', '49.207.184.10'),
(324, 'CARBAMAZEPIN', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(325, 'TETRACYCLIN', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(326, 'Nicoumalone (3mg)', 0, 99, 1, '36', '2017-09-20 10:29:10', '157.50.8.207'),
(327, 'Nicoumalone (2mg)', 0, 99, 1, '36', '2017-09-20 10:30:33', '157.50.8.207'),
(328, 'Lactic Acid', 0, 99, 1, '36', '2017-09-20 10:32:40', '157.50.8.207'),
(329, 'SPACER', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(330, 'Ofloxacin (NA), Metronidazole (NA)', 0, 99, 1, '36', '2017-09-20 10:35:31', '157.50.8.207'),
(331, 'PARAFIN', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(332, 'Mupirocin Topical', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(333, 'NORMAL SELINE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(334, 'Simethicone (80mg)', 0, 99, 1, '36', '2017-09-20 10:40:44', '157.50.8.207'),
(335, 'Proteolysed Liver Extract, Proteolysed Meat Extract, Ovolecithin, And Ferrous Gluconate', 0, 99, 1, '36', '2017-09-20 10:42:38', '157.50.8.207'),
(336, 'Sodium Picosulfate (5mg/ml)', 0, 99, 1, '36', '2017-09-20 10:44:29', '157.50.8.207'),
(337, 'GENERAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(338, 'GENERAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(339, 'Ranitidine (25mg)', 0, 99, 1, '26', '2017-09-10 11:27:09', '49.207.187.48'),
(340, 'Ampicillin (500mg), Dicloxacillin (500mg)', 0, 99, 1, '36', '2017-09-24 14:18:27', '117.207.109.148'),
(341, 'Sodium Valproate (200mg/5ml)', 0, 99, 1, '36', '2017-09-23 08:06:07', '59.93.9.243'),
(342, 'Acyclovir (800mg)', 0, 99, 1, '36', '2017-09-26 11:45:49', '117.207.101.207'),
(343, 'CLOMIFENE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(344, 'Aspirin', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(345, 'Dicyclomine (20mg), Diclofenac (50mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(346, 'Povidone Iodine (5% w/w), Sucralfate Topical (7% w/w), Tinidazole Topical (1% w/w)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(347, 'CINNARIZINE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(348, 'KETOCONAZOLE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(349, 'Lanolin', 0, 99, 1, '36', '2017-09-20 13:40:01', '157.50.8.207'),
(350, 'GENERAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(351, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(352, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(353, 'Theophylline (400mg)', 0, 99, 1, '36', '2017-09-20 13:41:18', '157.50.8.207'),
(354, 'Multivitamins, Multiminerals', 0, 99, 1, '36', '2017-09-20 13:44:05', '157.50.8.207'),
(355, 'RABEPRAZOLE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(356, 'Acyclovir Topical (3% W/w)', 0, 99, 1, '26', '2017-08-25 12:25:16', '49.207.187.48'),
(357, 'GENERAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(358, 'GENERAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(359, 'Ringer''s Lactate (NA)', 0, 99, 1, '36', '2017-09-20 13:49:39', '157.50.8.207'),
(360, 'Dextrose (5% W/v)', 0, 99, 1, '36', '2017-09-21 15:09:39', '157.50.14.255'),
(361, 'SYRINGE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(362, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(363, 'Guaifenesin(50 mg/ 5 ml),Bromhexine(4 mg/5 ml),?Diphenhydramine(8 mg/5', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(364, 'Dextrose(5 g),Sodium Chloride(0.45 g)-ML', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(365, 'SYRINGE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(366, 'Amoxicillin', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(367, 'Beclometasone Topical (0.025% W/w), Lidocaine Topical (2.5% W/w), Phenylephrine (0.1% W/w)', 0, 99, 1, '36', '2017-09-20 13:52:47', '157.50.8.207'),
(368, 'Furosemide (20mg)', 0, 99, 1, '36', '2017-09-20 13:54:04', '157.50.8.207'),
(369, 'Gentamicin (80mg)', 0, 99, 1, '36', '2017-09-20 13:55:31', '157.50.8.207'),
(370, 'Paracetamol (150mg)', 0, 99, 1, '36', '2017-09-20 13:56:57', '157.50.8.207'),
(371, 'Albendazole (400mg)', 0, 99, 1, '36', '2017-09-20 13:58:18', '157.50.8.207'),
(372, 'Vitamin C ', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(373, 'Cefotaxime (1gm)', 0, 99, 1, '26', '2017-09-09 23:09:41', '49.207.187.48'),
(374, 'AMIKACIN', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(375, 'Domperidone (1mg)', 0, 99, 1, '36', '2017-09-20 14:06:18', '157.50.8.207'),
(376, 'Tranexamic Acid (650mg)', 0, 99, 1, '36', '2017-09-26 01:26:41', '117.201.28.157'),
(377, 'Tranexamic Acid (250mg), Ethamsylate (250mg)', 0, 99, 1, '36', '2017-09-26 00:28:19', '117.201.28.157'),
(378, 'Sodium Picosulfate (5mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(379, 'Cefpodoxime (200mg), Levofloxacin (250mg)', 0, 99, 1, '36', '2017-09-21 06:30:46', '157.50.12.3'),
(380, 'ANTI RASHES', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(381, 'Cetirizine(10 mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(382, 'TRICLOFOS', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(383, 'Framycetin Topical (1% W/w)', 0, 99, 1, '36', '2017-09-20 14:17:23', '157.50.8.207'),
(384, 'Fexofenadine (120mg)', 0, 99, 1, '36', '2017-09-22 22:28:06', '103.204.29.216'),
(385, 'Theophylline (25.3mg), Etophylline (84.7mg)', 0, 99, 1, '36', '2017-09-24 12:39:33', '117.207.109.148'),
(386, 'Chlorhexidine Gluconate (1% w/w)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(387, 'DOMPERIDONE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(388, 'LACTIC ACID', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(389, 'Methyldopa (500mg)', 0, 99, 1, '36', '2017-09-23 21:57:08', '117.201.24.231'),
(390, 'Norfloxacin (400mg)', 0, 99, 1, '26', '2017-09-09 17:29:19', '49.207.187.48'),
(391, 'MOMETASONE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(392, 'Carbamazepine(200 mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(393, 'VITAMIN E', 0, 99, 1, '36', '2017-09-22 20:09:47', '103.204.29.216'),
(394, 'Sodium Chloride (NA)', 0, 99, 1, '36', '2017-09-21 10:09:45', '106.208.179.103'),
(395, 'Budesonide (0.5mg)', 0, 99, 1, '36', '2017-09-20 14:32:11', '157.50.8.207'),
(396, 'HEALTH SUPPLIMENT', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(397, 'Salbutamol (2mg/5ml)', 0, 99, 1, '36', '2017-09-21 11:56:56', '106.208.179.103'),
(398, 'Ciprofloxacin (500mg), Tinidazole (600mg)', 0, 99, 1, '26', '2017-09-17 11:42:10', '49.207.184.10'),
(400, 'Betacarotene, Vitamins and Minerals fortified with Vitamin B6', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(401, 'CALCIUM', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(402, 'Aloe Vera inhibits essential nutrients and other active components,', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(403, 'Starflower oil, Evening Primrose, and other Micronutrients', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(404, 'ALBENDAZOLE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(405, 'Silymarin - 70 MG', 0, 99, 1, '36', '2017-09-21 15:38:05', '157.50.14.255'),
(406, 'ATENLOL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(407, 'Aspirin', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(408, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(409, 'Tretinoin Topical', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(410, 'Amorolfine (topical)(0.25% w/w),Phenoxyethanol(1% w/w)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(411, 'Mucopolysaccharide Polysulfate', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(412, 'Calamine, Cetrimide, Dimethicone and Zinc oxide', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(413, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(414, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(415, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(416, 'Spironolactone (25mg)', 0, 99, 1, '36', '2017-09-20 19:02:42', '157.50.21.122'),
(417, 'Paracetamol (500mg), Pseudoephedrine (10mg), Triprolidine (2.5mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(418, 'Acyclovir (25mg/ml)', 0, 99, 1, '26', '2017-08-25 12:26:30', '49.207.187.48'),
(419, 'PARAFIN', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(420, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(421, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(422, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(423, 'TETANUS', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(424, 'Ramipril (5mg', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(425, 'OXYTOCIN', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(426, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(427, 'Paracetamol (500mg), Pseudoephedrine (10mg), Triprolidine (2.5mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(428, 'Metronidazole (500mg/5ml)', 0, 99, 1, '36', '2017-09-21 06:02:31', '157.50.12.3'),
(429, 'Valethamate (8mg)', 0, 99, 1, '26', '2017-08-25 21:47:04', '49.207.187.48'),
(430, 'PANTAPRAZOLE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(431, 'Theophylline(25.3mg),Etophylline(84.7mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(432, 'Theophylline(25.3mg),Etophylline(84.7mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(433, 'ALBENDAZOLE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(434, 'Hemocoagulase (1CU)', 0, 99, 1, '36', '2017-09-21 06:10:33', '157.50.12.3'),
(435, 'Isoxsuprine (10mg)', 0, 99, 1, '36', '2017-09-26 01:04:56', '117.201.28.157'),
(436, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(437, 'CEFTRIAXONE ', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(438, 'Amikacin (500mg)', 0, 99, 1, '36', '2017-09-21 06:17:00', '157.50.12.3'),
(439, 'Ranitidine (300mg)', 0, 99, 1, '36', '2017-09-25 22:50:02', '117.201.30.118'),
(440, 'Minerals (calcium, Iron, Zinc ), Vitamins (Cholecalciferol, Vitamin A, Vitamin B1, Vitamin B2,', 0, 99, 1, '36', '2017-09-21 06:20:39', '157.50.12.3'),
(441, 'Pyridoxine, (Vitamin B6)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(442, 'Dicyclomine (10mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(443, 'Insulin Regular (40IU)', 0, 99, 1, '36', '2017-09-21 06:24:52', '157.50.12.3'),
(444, 'Carbimazole (10mg)', 0, 99, 1, '36', '2017-09-21 06:26:06', '157.50.12.3'),
(445, 'Furosemide (20mg), Spironolactone (50mg)', 0, 99, 1, '36', '2017-09-23 16:40:43', '117.222.161.88'),
(446, 'Clobazam (5mg)', 0, 99, 1, '36', '2017-09-21 06:28:34', '157.50.12.3'),
(447, 'CEFTRIAXONE ', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(448, 'Clotrimazole Topical (1% W/v)', 0, 99, 1, '36', '2017-09-21 06:32:04', '157.50.12.3'),
(449, 'CERTRIZINE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(450, 'Iron, Folic acid, Methylcobalamin, Manganese and Copper', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(451, 'Cilostazol (50mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(452, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(453, 'MENADOIN', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(454, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(455, 'Beclometasone Topical (0.025% W/w), Clotrimazole Topical (1w/w)', 0, 99, 1, '36', '2017-09-22 18:18:50', '117.221.135.89'),
(456, 'DIGOXIN', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(457, 'OFLOXACIN', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(458, 'Isoniazid (300mg)', 0, 99, 1, '26', '2017-09-09 22:51:06', '49.207.187.48'),
(459, 'Clotrimazole Topical', 0, 99, 1, '36', '2017-09-23 00:51:06', '117.201.17.250'),
(460, 'Allopurinol (100mg)', 0, 99, 1, '36', '2017-09-21 09:57:49', '157.50.10.184'),
(461, 'PYRIDOXINE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(462, 'Racecadotril (100mg)', 0, 99, 1, '36', '2017-09-24 22:56:37', '117.201.17.114'),
(463, 'Famciclovir (500mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(464, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(465, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(466, 'Bacitracin Topical(5000 iu),Neomycin Topical(3400 iu)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(467, 'SODIUM CHLORIDE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(468, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(469, 'MULTIVITAMIN', 0, 99, 1, '36', '2017-09-22 15:36:57', '117.221.131.112'),
(470, 'Ayurvedic Preparations', 0, 99, 1, '36', '2017-09-21 10:13:49', '106.208.179.103'),
(471, 'Losartan (50mg)', 0, 99, 1, '36', '2017-09-21 10:14:55', '106.208.179.103'),
(472, 'SODIUM BICARBONATE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(473, 'Pralidoxime (500mg)', 0, 99, 1, '36', '2017-09-21 10:16:52', '106.208.179.103'),
(474, 'HYDROGEN PERAXIDE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(475, 'MANNITOL 20%', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(476, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(477, 'Anti Rh D Immunoglobulin (300mcg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(478, 'Clobetasol Topical (0.05% w/w), Salicylic Acid (3% w/w)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(479, 'Mometasone Topical (1mg)', 0, 99, 1, '26', '2017-09-10 12:34:23', '49.207.187.48'),
(480, 'Mometasone Topical (1mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(481, 'Benzalkonium Chloride And Zinc Oxide', 0, 99, 1, '26', '2017-09-09 12:39:42', '49.207.187.48'),
(482, 'Selenium Sulphide (2.5% W/v), Selenium (2.5%)', 0, 99, 1, '36', '2017-09-22 16:51:14', '117.221.135.89'),
(483, 'Flunarizine (10mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(484, 'Cyproheptadine (4mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(485, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(486, 'Chloroquine (64.5mg)', 0, 99, 1, '36', '2017-09-21 15:31:14', '157.50.14.255'),
(487, 'Baclofen (10mg)', 0, 99, 1, '36', '2017-09-26 13:30:55', '117.207.101.207'),
(488, 'Hydroxyzine (25mg)', 0, 99, 1, '36', '2017-09-21 11:53:19', '106.208.179.103'),
(489, 'Cefalexin (750mg)', 0, 99, 1, '36', '2017-09-21 11:54:38', '106.208.179.103'),
(490, 'Pyridoxine and Folic acid.', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(491, 'Salbutamol', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(492, 'Chloroquine (50mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(494, 'GENERAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(495, 'Ambroxol (15mg/5ml), Guaifenesin (50mg/5ml), Terbutaline (1.25mg/5ml)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(496, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(497, 'Cyproheptadine (2mg), Tricholine Citrate (275mg), Sorbitol (2gm)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(498, 'Vitamin B6 (Pyridoxine) (10mg), Doxylamine (10mg), Folic Acid (2.5mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(499, 'Guaifenesin(50 mg),Terbutaline(1.25 mg),Bromhexine(2 mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(500, 'Pyridoxine and Folic acid', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(501, 'L-ornithine-L-aspartate, Nicotinamide, and Riboflavin sodium phosphate', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(502, 'Domperidone (15mg), Cinnarizine (20mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(503, 'Oxytocin (5iu)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(504, 'Levocetirizine (2.5mg), Montelukast (4mg)', 0, 99, 1, '36', '2017-09-21 12:13:55', '106.208.179.103'),
(505, 'Azithromycin (1000mg), Ornidazole (750mg), Fluconazole (150mg)', 0, 99, 1, '36', '2017-09-26 17:52:50', '117.222.161.67'),
(506, 'Zinc Sulphate And Folic Acid', 0, 99, 1, '36', '2017-09-21 13:25:12', '157.50.14.255'),
(507, 'Enalapril (5mg)', 0, 99, 1, '26', '2017-09-10 11:40:25', '49.207.187.48'),
(508, 'Amlodipine (5mg), Atenolol (50mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(509, 'Gentamicin (0.3% W/v), Hydrocortisone (0.02% W/v)', 0, 99, 1, '36', '2017-09-21 13:29:40', '157.50.14.255'),
(510, 'Triamcinolone (10mg/ml)', 0, 99, 1, '26', '2017-08-25 23:32:42', '49.207.187.48'),
(511, 'Ramipril (2.5mg)', 0, 99, 1, '36', '2017-09-21 13:32:16', '157.50.14.255'),
(512, 'Placenta Extracts (0.1gm)', 0, 99, 1, '36', '2017-09-21 13:33:20', '157.50.14.255'),
(513, 'Unsaturated Fatty Acids,Mono Unsaturated Fatty Acids, Saturated Fatty Acids, Carbohydrates', 0, 99, 1, '36', '2017-09-21 15:02:38', '157.50.14.255'),
(514, 'Isoniazid (50mg), Pyrazinamide (300mg), Rifampicin (100mg)', 0, 99, 1, '26', '2017-09-09 22:49:32', '49.207.187.48'),
(515, 'Piracetam (500mg)', 0, 99, 1, '36', '2017-09-21 15:07:01', '157.50.14.255'),
(516, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(517, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(518, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(519, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(520, 'TETANUS', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(521, 'ASCORBIC ACID', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(522, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(523, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(524, 'DEXTROSE', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(525, 'Lactitol (3.33g/5ml), Benzoic Acid (0.0075g/5ml)', 0, 99, 1, '36', '2017-09-21 15:11:30', '157.50.14.255'),
(526, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(527, 'Mephentermine (30mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(528, 'AYURVEDIC PREPARATIONS', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(529, 'OFLOXACIN', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(530, 'Calcium Carbonate And Vitamin D3', 0, 99, 1, '36', '2017-09-21 15:18:40', '157.50.14.255'),
(531, 'CALCIUM  WITH VITAMIN D3', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(532, 'LIDOCAINE, HYDROCORTISONE ACETATE, ZINC-MG', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(533, 'Cilostazol (50mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(534, 'L-Leucine(5.6 mg),L-Isoleucine(12.5 mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00');
INSERT INTO `composition` (`composition_id`, `composition_name`, `agestart`, `age_end`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(535, 'Trypsin Chymotrypsin (100000AU)', 0, 99, 1, '26', '2017-08-25 22:35:20', '49.207.187.48'),
(536, ' Diclofenac 1.16% w/w, Linseed oil 3% w/w, Methyl Salicylat', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(537, 'Chloroquine (40mg)', 0, 99, 1, '36', '2017-09-21 15:33:11', '157.50.14.255'),
(538, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(539, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(540, 'SILYMARIN', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(541, 'MULTIVITAMIN MINERALS', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(542, 'Tinidazole (600mg), Norfloxacin (400mg), Lactobacillus', 0, 99, 1, '26', '2017-09-09 17:32:37', '49.207.187.48'),
(543, 'SURGICAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(544, 'Amitriptyline (10mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(545, 'Chlorpheniramine (2.5mg), Paracetamol (125mg), Phenylephrine (1mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(546, 'Chlorpheniramine (1mg), Paracetamol (125mg), Phenylephrine (2.5mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(547, 'Lajjalu And Yashad Bhasma', 0, 99, 1, '36', '2017-09-19 13:55:30', '157.50.12.3'),
(548, 'Live Attenuated Human Rotavirus Vaccine (1000000ccid50)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(549, 'Anti Rh D Immunoglobulin (300mcg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(550, 'Salmonella Typhi Vaccine (25mcg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(551, 'Human Chorionic Gonadotropin (hCG) (5000IU)', 0, 99, 1, '36', '2017-09-26 21:16:11', '59.93.11.153'),
(552, 'Progesterone (Natural Micronized) (250mg/ml)', 0, 99, 1, '36', '2017-09-21 15:51:14', '157.50.14.255'),
(553, 'Hydroxyzine', 0, 99, 1, '36', '2017-09-22 13:15:48', '117.221.128.173'),
(554, 'Sucralfate (500mg/5ml)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(555, 'Diphenhydramine Topical (1% W/v)', 0, 99, 1, '26', '2017-09-09 12:03:48', '49.207.187.48'),
(556, 'Ambroxol (7.5mg)', 0, 99, 1, '36', '2017-09-21 15:59:54', '157.50.14.255'),
(558, 'Benzalkonium Chloride (0.02% w/v), Choline Salicylate (9% w/v)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(559, 'Clotrimazole Topical', 0, 99, 1, '36', '2017-09-22 18:15:37', '117.221.135.89'),
(560, 'GENERAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(561, 'Carbamazepine (200mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(562, 'Medroxyprogesterone (10mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(563, 'Furosemide (20mg), Spironolactone (50mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(564, 'Streptomycin (0.75gm)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(565, 'Promethazine (5mg/ml)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(566, 'Pancreatin (212.5mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(567, 'Saturated Fatty Acids And Monounsaturated Fatty Acid', 0, 99, 1, '36', '2017-09-22 08:17:10', '157.50.13.170'),
(568, 'LIDOCAINE, HYDROCORTISONE ACETATE, ZINC-MG', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(569, 'GENERAL', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(570, 'Chlorhexidine Gluconate (1% w/w)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(571, 'Chlorpheniramine (2.5mg), Paracetamol (125mg), Phenylephrine (1mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(572, 'Ethinyl Estradiol (0.03mg), Levonorgestrel (0.15mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(573, 'Ferrous fumarate (Iron), Folic acid, Vitamin B12', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(574, 'Sulfamethopyrazine (800mg), Trimethoprim (160mg)', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(575, 'Dicyclomine (10mg), Simethicone (40mg)', 0, 99, 1, '36', '2017-09-22 08:26:45', '157.50.13.170'),
(576, 'Isoniazid (100mg)', 0, 99, 1, '26', '2017-09-09 22:52:08', '49.207.187.48'),
(577, 'Clotrimazole Topical', 0, 99, 1, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(578, 'Guaifenesin(50 mg),Terbutaline(1.25 mg),Bromhexine(2 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(579, 'Domperidone (10mg)', 0, 99, 1, '36', '2017-09-22 08:31:50', '157.50.13.170'),
(580, 'L-Ornithine L-Aspartate (150mg), Pancreatin (100mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(581, 'Caper Bush (Himsra) and Chicory (Kasani)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(582, 'Pentazocine (30mg)', 0, 99, 1, '36', '2017-09-22 08:36:29', '157.50.13.170'),
(583, 'Dicyclomine (10mg), Dimethicone (40mg)', 0, 99, 1, '36', '2017-09-22 08:39:19', '157.50.13.170'),
(584, 'Antacid Syrup', 0, 99, 1, '36', '2017-09-22 08:44:09', '157.50.13.170'),
(585, 'Metoclopramide (5mg), Paracetamol (500mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(586, 'Caper Bush (Himsra) And Chicory (Kasani) Herbs', 0, 99, 1, '36', '2017-09-22 08:45:44', '157.50.13.170'),
(587, 'Ambroxol (15mg), Guaifenesin (50mg), Terbutaline (1.5mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(588, 'PROTIEN POWDER', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(589, 'Betamethasone Topical (0.05% W/v), Zinc Sulfate (0.05% W/v)', 0, 99, 1, '26', '2017-08-30 10:17:43', '180.151.35.68'),
(590, 'Vitamin B Complex (Vitamin B12, B1, B2, B6, B3 And Folic Acid), Vitamin C And Calcium Pantothenate', 0, 99, 1, '36', '2017-09-22 08:49:02', '157.50.13.170'),
(591, 'Guaifenesin (50mg/5ml), Bromhexine (4mg/5ml), Diphenhydramine (8mg/5ml), Ammonium Chloride (100mg/5m', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(592, 'POVIDINE IODINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(593, 'Guaifenesin(50 mg),Terbutaline(1.25 mg),Bromhexine(2 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(594, 'Phenobarbitone (30mg)', 0, 99, 1, '36', '2017-09-22 08:55:00', '157.50.13.170'),
(595, 'Dextrose, Sodium Chloride', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(596, 'Apple Drink', 0, 99, 1, '36', '2017-09-22 08:59:07', '157.50.13.170'),
(597, 'ARTEETHER 2ML', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(598, 'CEFTRIAXONE 500MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(599, 'OFLOXACIN 200MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(600, 'HYDROXYZINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(601, 'Prednisolone 5mg', 0, 99, 1, '26', '2017-08-25 11:38:57', '49.207.187.48'),
(602, 'milk of magnesia+ liquid paraffin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(603, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(604, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(605, 'Aspirin(ASA) (75mg), Clopidogrel (75mg)', 0, 99, 1, '26', '2017-09-14 16:24:49', '180.151.35.68'),
(606, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(607, 'LEVOFLOXACIN 500MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(608, 'Indomethacin (75mg)', 0, 99, 1, '36', '2017-09-23 16:39:03', '117.222.161.88'),
(609, 'hiamine Mononitrate, Riboflavin, Nicotinic Acid, Niacinamide, Pyridoxine, Calcium Pantothenate, Foli', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(610, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(611, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(612, 'SYRINGE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(613, 'L-Leucine(5.6 mg),L-Isoleucine(12.5 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(614, 'Ketoconazole Topical (2% W/v)', 0, 99, 0, '36', '2017-09-22 14:39:03', '117.221.128.173'),
(615, 'Selenium Sulphide (2.5% w/v), Selenium (2.5%)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(616, 'Citric Acid (334mg), Potassium Citrate (1100mg)', 0, 99, 1, '36', '2017-09-22 17:06:21', '117.221.135.89'),
(617, 'Clotrimazole Topical', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(618, 'Budesonide 200MG', 0, 99, 0, '36', '2017-09-22 15:13:03', '117.221.131.112'),
(619, 'Caraway (Krishnajiraka), carvone, limoline, Bishop?s Weed', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(620, 'Iron, Folic acid and Methylcobalamin.', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(621, 'L-Leucine(5.6 mg),L-Isoleucine(12.5 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(622, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(623, 'CALCIUM IRON VITAMINS SUPPLEMENT', 0, 99, 0, '36', '2017-09-22 17:28:42', '117.221.135.89'),
(624, 'MULTIVITAMIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(625, 'B12', 0, 99, 0, '36', '2017-09-22 15:37:59', '117.221.131.112'),
(626, 'Tretinoin Topical (0.025% W/w)', 0, 99, 1, '36', '2017-09-25 13:40:12', '157.50.22.165'),
(627, 'Acyclovir Topical (5% W/w)', 0, 99, 1, '26', '2017-08-25 12:27:54', '49.207.187.48'),
(628, 'PENIRAMIN', 0, 99, 0, '36', '2017-09-22 16:24:14', '117.221.135.89'),
(629, 'CHLOROQUINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(630, 'Estriol Topical (1mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(631, 'Mometasone Topical (1mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(632, 'Quath Processed Oil', 0, 99, 0, '36', '2017-09-22 18:08:51', '117.221.135.89'),
(633, 'Permethrin (5% W/v)', 0, 99, 0, '36', '2017-09-22 18:12:47', '117.221.135.89'),
(634, 'Clotrimazole Topical', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(635, 'METRONIDAZOLE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(636, 'LIDOCAINE, HYDROCORTISONE ACETATE, ZINC-MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(637, 'Clotrimazole Topical', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(638, 'Fusidic Acid Topical', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(639, 'Calamine, Aloe Vera And Light Liquid Paraffin With Water', 0, 99, 1, '26', '2017-09-09 12:28:32', '49.207.187.48'),
(640, 'Mefenamic Acid', 0, 99, 0, '36', '2017-09-22 19:07:17', '117.201.30.250'),
(641, 'PYRIDOXINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(642, 'Streptomycin ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(643, 'Carbamazepine ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(644, 'Protein, Carbohydrate, Multivitamin And Minerals', 0, 99, 0, '36', '2017-09-22 19:34:17', '117.201.30.250'),
(645, 'PIRACETAM', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(646, 'ANTACID SYRUP', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(647, 'DIAZEPAM', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(648, 'Trifluoperazine (5mg)', 0, 99, 1, '26', '2017-08-25 23:04:28', '49.207.187.48'),
(649, 'Pyritinol (100mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(650, 'Erythromycin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(651, 'Ambroxol (15mg), Guaifenesin (50mg), Terbutaline (1.5mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(652, 'Phytomenadione (10mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(653, 'VITAMIN E', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(654, 'OXYTOIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(655, 'Salbutamol', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(656, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(657, 'Piroxicam (20mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(658, 'Sildenafil', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(659, 'Sildenafil', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(660, 'Betamethasone (4mg)', 0, 99, 1, '26', '2017-08-29 07:51:21', '106.203.121.80'),
(661, 'Chlorpheniramine (4mg), Dextromethorphan (10mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(662, 'Promethazine (50mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(665, 'Theophylline(25.3mg),Etophylline(84.7mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(666, 'Ambroxol(15 mg),Levosalbutamol(0.5 mg),Guaifenesin(50 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(667, 'CINNARIZINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(668, 'Erythromycin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(669, 'Dill Oil (Shatapushpa), Tinospora Gulancha (Guduchi)', 0, 99, 0, '36', '2017-09-22 21:26:13', '103.204.29.216'),
(670, 'Oxymetazoline Hydrochloride', 0, 99, 0, '36', '2017-09-22 21:27:49', '103.204.29.216'),
(671, 'Phenazopyridine 200MG', 0, 99, 0, '36', '2017-09-22 21:34:28', '103.204.29.216'),
(672, 'Diclofenac (100mg)', 0, 99, 1, '36', '2017-09-22 21:38:52', '103.204.29.216'),
(673, 'Phenylephrine (5mg), Chlorpheniramine (2mg), Dextromethorphan (10mg)', 0, 99, 0, '36', '2017-09-22 21:57:35', '103.204.29.216'),
(674, 'IRON FOLIC ACID', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(676, 'LETROZOLE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(677, 'LABETOLOL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(678, 'Furosemide (20mg), Spironolactone (50mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(679, 'OFLOXACIN 200MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(680, 'OFLOXACIN 300MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(681, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(682, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(683, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(684, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(685, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(686, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(687, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(688, 'Fexofenadine', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(689, 'ASPRIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(690, 'Ambroxol (7.5mg), Levosalbutamol (0.25mg), Guaifenesin (12.5mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(691, 'Dextromethorphan (10mg), Triprolidine (1.25mg), Phenylephrine (12.5mg), Menthol (1.5mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(692, 'Ammonium Chloride (7mg/5ml), Noscapine (1.83mg/5ml), Sodium Citrate (0.67mg/5ml)', 0, 99, 0, '36', '2017-09-22 23:17:18', '103.204.29.216'),
(693, 'TERBUTALINE, BROMHEXINE, GUAOPHENESIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(694, 'ANTACID SYRUP', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(695, 'Ciprofloxacin (500mg)', 0, 99, 1, '26', '2017-09-17 11:43:30', '49.207.184.10'),
(696, 'Ammonium Chloride (7mg/5ml), Noscapine (1.83mg/5ml), Sodium Citrate (0.67mg/5ml)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(697, 'METHYLCOBALAMIN, FOLIC ACID', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(698, 'Chlorpheniramine (1mg), Paracetamol (125mg), Phenylephrine (5mg)', 0, 99, 1, '36', '2017-09-26 11:31:47', '117.207.101.207'),
(699, 'Chlorpheniramine(1mg/5ml),Paracetamol(125mg/5ml),Phenylephrine(5mg/5ml)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(700, 'Guaifenesin (50mg), Terbutaline (1.25mg), Bromhexine (4mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(701, 'CEFTRIAXONE 125MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(702, 'Benzyl Nicotinate Topical(2 mg),Heparin Topical(50 IU)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(703, 'Amoxicillin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(704, 'HEPARIN,ALLANTOIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(705, 'FLUCANAZOLE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(706, 'Famotidine (40mg)', 0, 99, 1, '36', '2017-09-23 16:49:55', '117.222.161.88'),
(707, 'ONDANCETRAN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(708, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(709, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(710, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(711, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(712, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(713, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(714, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(715, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(716, 'PROVIDINE-IODINE OINTMENT - GM', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(717, 'Oxetacaine (10mg), Aluminium Hydroxide (291mg), Milk Of Magnesia (98mg)', 0, 99, 0, '36', '2017-09-23 00:24:33', '117.201.17.250'),
(718, 'PYRIDOXINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(719, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(720, 'PROPYPENAZONE, PARACETAMOL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(721, 'SILVER NITRATE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(722, 'POVIDINE IODINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(723, 'Clotrimazole Topical', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(724, 'Chlorhexidine Gluconate(0.5% w/w/1 gm),Metronidazole Topical(15 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(725, 'PREGABALIN, METHICOBALAMIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(726, '?Pyridoxine, ?Nicotinamide, Cyanocobalamin and Lysine', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(727, 'SODIUM VULPARATE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(728, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(729, 'MOMETASONE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(730, 'ATROPINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(731, 'Tamsulosin (0.4mg), Deflazacort (30mg)', 0, 99, 1, '36', '2017-09-23 08:31:26', '59.93.9.243'),
(732, 'DILTIAZEM', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(733, 'Methylcobalamin (750mcg), Pregabalin (75mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(734, 'ITRACONAZOLE 100MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(735, 'Dydrogesterone (10mg)', 0, 99, 0, '36', '2017-09-23 08:47:35', '59.93.9.243'),
(736, 'Quinine (300mg)', 0, 99, 1, '36', '2017-09-23 08:51:21', '59.93.9.243'),
(737, 'Acetazolamide (250mg)', 0, 99, 0, '36', '2017-09-23 08:53:07', '59.93.9.243'),
(738, 'Human Chorionic Gonadotropin (hCG) (10000IU)', 0, 99, 0, '36', '2017-09-23 08:55:54', '59.93.9.243'),
(739, 'Doxofylline', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(740, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(741, 'SYRINGE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(742, 'CALAMINE LIGHT LIQUID PARAFFIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(743, 'Lactase 600 U/ml', 0, 99, 1, '36', '2017-09-25 13:42:02', '157.50.22.165'),
(744, 'Furosemide (20mg), Spironolactone (50mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(745, 'Kramuka Ksharam, Gokshura', 0, 99, 1, '36', '2017-09-25 13:59:37', '139.59.0.48'),
(746, 'ATENLOL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(747, 'Famciclovir 250MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(748, 'Vitamin B Like Methylcobalamin, Alpha Lipoic Acid, Benfothiamine, Pyridoxine, Folic Acid And Biotin', 0, 99, 1, '36', '2017-09-25 14:06:34', '139.59.0.48'),
(749, 'Glimepiride,Metformin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(750, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(751, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(752, 'URSODILE 300MG', 0, 99, 1, '36', '2017-09-23 16:26:05', '117.222.161.88'),
(753, 'Metformin (500mg), Methylcobalamin (750mcg)', 0, 99, 1, '36', '2017-09-23 16:29:04', '117.222.161.88'),
(754, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(755, 'Salmeterol (25mcg), Fluticasone (250mcg)', 0, 99, 1, '36', '2017-09-23 16:30:52', '117.222.161.88'),
(756, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(757, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(758, 'Beta-carotene,Eicosapentaenoic acid (EPA),  Zinc, Lutein, Lycopene, ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(759, 'Beta-Carotene, Chromium, Inositol, Iodine, (Cyanocobalamin),', 0, 99, 1, '36', '2017-09-25 14:10:31', '139.59.0.48'),
(760, 'PYRAZINAMIDE 750MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(761, 'INDI=OMETHACIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(762, 'Camylofin (50mg), Diclofenac (50mg)', 0, 99, 1, '36', '2017-09-23 16:42:43', '117.222.161.88'),
(763, 'CEFTRIAXONE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(764, 'Arteether (20mg), Lumefantrine (120mg/5ml)', 0, 99, 1, '36', '2017-09-23 16:46:11', '117.222.161.88'),
(765, 'Cefixime (25mg)', 0, 99, 1, '36', '2017-09-23 18:11:53', '117.201.28.84'),
(766, 'Famotidine (40mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(767, 'Cowrie Bhasma, Shankh Bhasma, Piper Nigrum, Emblica Officinalis, Terminalia Chebula', 0, 99, 1, '36', '2017-09-25 14:17:42', '157.50.22.165'),
(768, 'Allum Cepa Heparin', 0, 99, 1, '36', '2017-09-25 14:20:03', '157.50.22.165'),
(769, 'Betamethasone Topical (0.64mg), Clotrimazole Topical (10mg), Gentamicin Topical (1mg)', 0, 99, 1, '26', '2017-08-30 10:13:20', '180.151.35.68'),
(770, 'Mometasone Topical', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(771, 'PERIMITHINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(772, 'Cissus Quadrangularis, Moringa Oleifera, Pueraria Isoflavones, Ascorbic Acid', 0, 99, 1, '36', '2017-09-25 14:22:20', '157.50.22.165'),
(773, 'Cholecalciferol (Vitamin D3)', 0, 99, 1, '36', '2017-09-25 14:24:55', '157.50.22.165'),
(774, 'FAROPENUM', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(775, 'PANTAPRAZOLE DOMEPERIDON', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(776, 'MONTELIKAST LEVO CETRIZINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(777, 'Bromelain (90mg), Trypsin (48mg), Rutoside (100mg)', 0, 99, 1, '36', '2017-09-26 15:09:12', '117.207.101.207'),
(778, 'Levomefolic Acid, Calcium And Methylcobalamin', 0, 99, 1, '36', '2017-09-25 14:27:09', '157.50.22.165'),
(779, 'Potassium Magnesium Citrate And D-Mannose', 0, 99, 1, '36', '2017-09-25 14:29:30', '157.50.22.165'),
(780, 'Domperidone (20mg), Paracetamol (500mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(781, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(782, 'Methylcobalamin (750mcg), Pregabalin (75mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(783, 'PYRAZINAMIDE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(784, 'Fungal Diastase, Papain, Niacinamide, Dimethicone And Activated Charcoal.', 0, 99, 1, '36', '2017-10-05 13:46:41', '157.50.15.153'),
(785, 'DEFLOZACORT', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(786, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(787, 'CALCIUM  WITH VITAMIN D3', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(788, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(789, 'Drotaverine (80mg)', 0, 99, 1, '26', '2017-08-29 07:36:28', '106.203.121.80'),
(790, 'ESTADIOL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(791, 'LIGNOCAIN, ADRENALIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(792, 'Levetiracetam 250MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(793, 'Glimepiride,Metformin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(794, 'ACECLOFENAC PARACETAMOL &  TRIPCIN, CHYMO TRYPCIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(795, 'ESOMEPRAZOLE 20MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(796, 'REBOXITINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(797, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(798, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(799, 'Saccharomyces boulardii', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(801, 'Clindamycin (100mg), Clotrimazole (200mg)', 0, 99, 1, '36', '2017-09-26 13:14:29', '117.207.101.207'),
(802, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(803, 'Calcitriol, Calcium, Folic acid, Methylcobalamin and Vitamin B6', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(804, 'Isosorbide Mononitrate', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(805, 'Escitalopram', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(806, 'Glimepiride', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(807, 'Natural Micronised Progesterone (200mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(808, 'FATTY ACIDS, GREEN TEA EXTRACT', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(809, 'Piperacillin (2000mg), Tazobactum (250mg)', 0, 99, 1, '36', '2017-09-23 18:36:30', '117.201.28.84'),
(810, 'PARACETAMOL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(811, 'SILYMARIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(812, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(813, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(814, 'PHENYLEPRINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(815, 'CALCIUM', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(816, 'Aceclofenac (100mg), Paracetamol (325mg)', 0, 99, 1, '26', '2017-08-25 12:01:04', '49.207.187.48'),
(817, 'FLAVOXATE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(818, 'Dextromethorphan (10mg), Triprolidine (1.25mg), Phenylephrine (12.5mg), Menthol (1.5mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(819, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(820, 'Teneligliptin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(821, 'Hemocoagulase', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(822, 'LEVOFLOXACIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(823, 'Chloramphenicol TopicaL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(824, 'CETIRIZINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(825, 'Etizolam (0.5mg), Escitalopram (10mg)', 0, 99, 1, '36', '2017-09-23 19:31:20', '117.201.24.231'),
(826, 'Zolpidem (5mg)', 0, 99, 1, '36', '2017-09-23 19:34:33', '117.201.24.231'),
(827, 'AZITHROMYCIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(828, 'Sucralfate', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(829, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(830, 'PARACETAMOL ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(831, 'Ethamsylate', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(832, 'Sodium Chloride', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(833, 'LABETOLOL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(834, 'Isosorbide Mononitrate ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(835, 'Progesterone', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(836, 'HYDROXYZINE 6MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(837, 'CALCIUM IRON VITAMINS SUPPLEMENT', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(838, 'Diclofenac (75mg)', 0, 99, 1, '36', '2017-09-23 20:14:33', '117.201.24.231'),
(839, 'CEFTRIAXONE AND SULBACTAM', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(840, 'VITAMINS MINERALS ZINC', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(841, 'Progesterone 200MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(842, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(843, 'PARACETAMOL 650', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(844, 'VITAMINS & MINERALS', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(845, 'COLLAGEN PEPTIDE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(846, 'Amoxicillin(500mg),Potassium Clavulanate(125mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(847, 'Thyroxine (150mcg)', 0, 99, 1, '26', '2017-08-29 07:21:35', '106.203.121.80'),
(848, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(849, 'Zolpidem (10mg)', 0, 99, 1, '36', '2017-09-23 20:26:39', '117.201.24.231'),
(850, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(851, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(852, 'DEXTROSE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(853, 'Ambroxol', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(854, 'Hydroxychloroquine', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(855, 'Domperidone (20mg), Paracetamol (500mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(856, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(857, 'CINNARIZINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(858, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(860, 'Cefoperazone (1000mg), Sulbactam (500mg)', 0, 99, 1, '36', '2017-09-26 14:55:24', '117.207.101.207'),
(861, 'iron, Folic Acid, Lysine & Vitamin B12', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(862, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(863, 'PENIRAMIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(864, 'PREMAQUINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(865, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(866, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(867, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(869, 'Amoxicillin (250mg), Bromhexine (8mg)', 0, 99, 0, '36', '2017-09-23 20:59:04', '117.201.24.231'),
(871, 'HALOPERIDOL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(872, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(873, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(874, 'Phenobarbitone(60 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(875, ' lithotriplic and diurelic', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(876, 'ALLUM CEPA HEPARIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(877, 'Amoxicillin (500mg), Potassium Clavulanate (125mg)', 0, 99, 1, '36', '2017-09-23 21:08:09', '117.201.24.231'),
(878, 'Amoxicillin (1000mg), Clavulanic Acid (200mg)', 0, 99, 0, '36', '2017-09-23 21:11:10', '117.201.24.231'),
(879, 'FLUCanazole', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(880, 'mefloquine', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(881, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(882, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(883, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(884, 'urokinase', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(885, 'methyl prednisolone', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(886, 'methyl prednisolone', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(887, 'medroxyprogestwron', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(888, 'Caffeine (30mg), Paracetamol (500mg), Levocetirizine (2.5mg), Phenylephrine (10mg)', 0, 99, 1, '36', '2017-09-23 21:19:18', '117.201.24.231'),
(889, 'L-ARGININE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(890, 'surgical', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(891, 'Amlodipine (5mg), Hydrochlorothiazide (12.5mg)', 0, 99, 1, '36', '2017-09-26 15:20:29', '117.207.101.207'),
(892, 'Amlodipine (5mg), Hydrochlorothiazide (12.5mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(893, 'papaya leaf extract', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(894, 'Levo-carnitine (500mg), Methylcobalamin (1500mcg), Folic Acid (1.5mg)', 0, 99, 0, '36', '2017-09-23 21:53:58', '117.201.24.231'),
(895, 'CEFTRIAXONE 375MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(896, 'METHYLDOPA', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(897, 'OFLOXACIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(898, 'Multivitamin and Multimineral ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(899, 'Telmisartan (40mg), Chlorthalidone (12.5mg)', 0, 99, 0, '36', '2017-09-23 22:07:36', '117.201.24.231'),
(900, 'Vitamin D3', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(901, 'L-ARGININE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(902, 'Amoxicillin(500mg),Potassium Clavulanate(125mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(903, 'GENRAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(904, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(905, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(906, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(908, 'Clotrimazole Topical', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(909, 'AMANTADINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(910, 'ATORVASTATIN 10MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(911, 'Phenytoin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(912, 'Dicyclomine (20mg), Diclofenac (50mg)', 0, 99, 1, '26', '2017-09-09 17:44:22', '49.207.187.48'),
(913, 'Levodopa (100mg), Carbidopa (10mg)', 0, 99, 0, '36', '2017-09-23 22:39:49', '117.201.24.231'),
(914, 'SYRINGE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(916, 'Vitamin B (NA)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(917, 'Oxymetazoline Hydrochloride', 0, 99, 0, '36', '2017-09-22 21:31:08', '103.204.29.216'),
(918, 'Natural Micronised Progesterone (200mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(919, 'CALCIUM  WITH VITAMIN D3', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(920, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(921, 'CLIndamycin ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(922, 'METOPROLOL 125MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(923, 'LIDOCAIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(924, 'MECONALAMIN ALPHALOPIC ACID', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(925, 'PIPERACILLIN, TAZOBACTUM  ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(926, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(927, 'PANTAPRAZOLE DOMPERIDONE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(928, 'Clarithromycin (500mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(929, 'Dicyclomine(10 mg),Simethicone(40 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(930, 'Hyoscine', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(931, 'Etodolac (400mg), Thiocolchicoside (4mg)', 0, 99, 0, '36', '2017-09-23 23:44:20', '117.201.24.231'),
(932, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(933, 'CALCIUM  WITH VITAMIN D3', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(934, 'Cefadroxil (500mg)', 0, 99, 1, '36', '2017-09-23 23:47:59', '117.201.24.231'),
(936, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(937, 'Multivitamin and Multimineral ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(938, 'ADRENALIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(939, 'Diphtheria Toxoid (30IU), Haemophilus B Conjugate Vaccine (10mcg), Pertussis Toxoid (4IU), Tetanus T', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(940, 'VITAMIN D3', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(941, 'Calcium Pidolate with vitamin D3', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(942, 'TICAGROL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(943, 'TELMISARTAN AMLODIPINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(944, 'PROTIEN POWDER', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(945, 'DOXOFILLIN, AMBROXOL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(946, 'Drotaverine (80mg), Aceclofenac (100mg)', 0, 99, 1, '26', '2017-08-29 07:35:20', '106.203.121.80'),
(947, 'MEBENDAZOLE 10MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(948, 'Drotaverine (80mg), Paracetamol (500mg)', 0, 99, 1, '26', '2017-08-29 07:30:10', '106.203.121.80'),
(949, 'Cissus Quadrangularis Extract, Elemental Calcium, Vitamin D3.', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(950, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(951, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(952, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(953, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(954, 'Clindamycin (100mg), Clotrimazole (200mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(955, 'PARACETAMOL 500MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(956, 'LANSOPRAZOLE 15MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(957, 'Levofloxacin (500mg), Azithromycin (500mg)', 0, 99, 1, '36', '2017-09-24 19:57:48', '117.201.27.215'),
(958, 'Artemether (80mg), Lumefantrine (480mg)', 0, 99, 0, '36', '2017-09-24 00:29:16', '117.201.24.231'),
(959, 'Rifampicin (450mg)', 0, 99, 1, '36', '2017-09-24 00:34:54', '117.201.24.231'),
(960, 'Metronidazole Topical (1% W/w), Povidone Iodine (5% W/w)', 0, 99, 1, '36', '2017-09-24 00:38:34', '117.201.24.231'),
(961, 'OFLOXACIN ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(962, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(963, 'Levofloxacin (250mg), Ornidazole (500mg)', 0, 99, 1, '36', '2017-09-24 00:47:35', '117.201.24.231'),
(964, 'DEXAMETHASONE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(965, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(966, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(967, 'ESOMAPRAZOLE LEVOCARINITINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(968, 'VITAMIN C  ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(969, 'Sodium Valproate (200mg), Valproic Acid (87mg)', 0, 99, 0, '36', '2017-09-24 00:56:37', '117.201.24.231'),
(970, 'Fluoxetine (20mg)', 0, 99, 1, '36', '2017-09-24 20:29:13', '117.201.27.215'),
(971, 'ISOSORBIDE 10MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(972, 'Camphor, Chlorothymol, Eucalyptol, Terpinol, mg', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(973, 'Omeprazole (20mg)', 0, 99, 0, '36', '2017-09-24 01:04:52', '117.201.24.231'),
(974, 'Domperidone (30mg), Omeprazole (20mg)', 0, 99, 1, '36', '2017-09-24 01:07:52', '117.201.24.231'),
(975, 'Choline (275mg/5ml), Cyproheptadine (2mg/5ml)', 0, 99, 1, '36', '2017-09-24 01:10:06', '117.201.24.231'),
(976, 'DOXOFILLIN, AMBROXOL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(977, 'SYRINGE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(978, 'MISOPROSTOL 200MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(979, 'AYURVEDIC FORMULATION', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(980, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(981, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(982, 'Metoclopramide', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(983, 'LACTATING', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(984, 'CALCIUM IRON VITAMINS SUPPLEMENT', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(985, 'Rifampicin (600mg)', 0, 99, 1, '36', '2017-09-24 01:19:28', '117.201.24.231'),
(986, 'Ciprofloxacin (0.3% W/v)', 0, 99, 1, '26', '2017-09-17 11:44:31', '49.207.184.10'),
(987, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(988, 'Calcium Carbonate and Vitamin D3', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(989, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(990, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(991, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(992, 'Caffeine (50mg), Paracetamol (650mg)', 0, 99, 1, '36', '2017-09-24 01:21:32', '117.201.24.231'),
(993, 'ARTESUNATE 100MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(994, 'Camylofin (25mg), Diclofenac (25mg)', 0, 99, 1, '36', '2017-09-24 01:42:11', '117.201.24.231'),
(995, 'Telmisartan (40mg), Amlodipine (5mg), Hydrochlorothiazide (12.5mg)', 0, 99, 1, '36', '2017-09-24 01:44:53', '117.201.24.231'),
(996, 'ROXITHROMYCIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(997, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(998, 'L-ARGININE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(999, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1000, 'Amoxicillin (125mg)', 0, 99, 1, '36', '2017-09-25 23:52:28', '117.201.30.118'),
(1001, 'KETOCONAZOLE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1002, 'LETROZOLE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1003, 'Mifepristone (NA), Misoprostol (NA)', 0, 99, 0, '36', '2017-09-24 02:31:19', '117.201.24.231'),
(1004, 'PREMAQUINE 7.5MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1005, 'Eperisone (150mg), Diclofenac (100mg)', 0, 99, 1, '36', '2017-09-24 03:58:46', '117.201.24.231'),
(1006, 'Sulfamethoxazole (400mg), Trimethoprim (80mg)', 0, 99, 1, '36', '2017-09-26 17:29:02', '117.222.161.67'),
(1007, 'Aspirin(ASA) (150mg), Clopidogrel (75mg)', 0, 99, 1, '26', '2017-09-15 12:33:09', '180.151.35.68'),
(1009, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1010, 'ARTESUNATE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1011, 'Caper Bush (Himsra) and Chicory (Kasani) herbs.', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1012, 'Phenytoin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1013, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1014, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1015, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1016, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1017, 'Ondansetron (4mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1018, 'Carvedilol (6.25mg)', 0, 99, 1, '36', '2017-09-24 02:56:15', '117.201.24.231'),
(1019, 'Cefalexin (125mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1020, 'Lactobacillus and Fructo-oligosaccharides', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1021, 'Alprazolam (0.25mg)', 0, 99, 1, '36', '2017-09-24 03:02:17', '117.201.24.231'),
(1022, 'Amlodipine (5mg)', 0, 99, 1, '36', '2017-09-24 03:04:11', '117.201.24.231'),
(1023, 'Amlodipine (2.5mg)', 0, 99, 1, '36', '2017-09-24 03:07:00', '117.201.24.231'),
(1024, 'Tamsulosin (0.4mg), Dutasteride (0.5mg)', 0, 99, 1, '36', '2017-09-26 12:29:45', '117.207.101.207'),
(1025, 'Amoxicillin (100mg)', 0, 99, 1, '36', '2017-09-24 03:28:10', '117.201.24.231'),
(1026, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1027, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1028, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1029, 'ELECTROLITE P', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1030, 'Triamcinolone (40mg/ml)', 0, 99, 1, '26', '2017-08-25 23:35:25', '49.207.187.48'),
(1031, 'OFLOXACIN ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1032, 'L-Leucine(5.6 mg),L-Isoleucine(12.5 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1033, 'Thiamine (Vitamin B1)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1034, 'CHLORPROMAZINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1035, 'Propranolol 40MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1037, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1038, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1039, 'Lactic Acid, Sea Buckthorn Oil And Tea Tree Oil', 0, 99, 1, '26', '2017-08-25 22:41:30', '49.207.187.48'),
(1040, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1041, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1042, 'Atorvastatin (10mg), Aspirin(ASA) (150mg)', 0, 99, 1, '36', '2017-09-24 03:30:44', '117.201.24.231'),
(1043, 'Ropinirole (0.5mg)', 0, 99, 1, '36', '2017-09-24 03:32:45', '117.201.24.231'),
(1044, 'ANATCID', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1045, 'Mupirocin (2% W/w), Bromelain (25% W/w)', 0, 99, 1, '36', '2017-09-24 03:35:45', '117.201.24.231'),
(1046, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1047, 'Atorvastatin(10 mg),Fenofibrate(160 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1048, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1049, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1050, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1051, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1052, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1053, 'Shea butter, Ceramide, Wheat germ oil,GLA and Aloe vera.', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1054, 'Domperidone (30mg), Rabeprazole (20mg)', 0, 99, 1, '36', '2017-09-24 03:40:10', '117.201.24.231'),
(1055, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1056, 'AMPICILLIN SODIUM 500MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1057, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1058, 'Chlorpheniramine (2mg/ml), Phenylephrine (5mg/ml)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1059, 'LACTIC ACID', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1060, 'EBASTIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1061, 'Chlorpheniramine (1mg), Phenylephrine (2.5mg)', 0, 99, 1, '36', '2017-09-24 03:46:15', '117.201.24.231'),
(1062, 'Norethisterone (5mg)', 0, 99, 1, '36', '2017-09-24 03:47:46', '117.201.24.231'),
(1063, 'Camphor, Chlorothymol, Eucalyptol, Terpinol, MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1064, 'Methylcobalamin (1000mcg), Niacinamide (100mg), Vitamin B6 (Pyridoxine) (100mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1065, 'OMEPRAZOLE 40MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1066, 'Guaifenesin(50 mg/ 5 ml),Bromhexine(4 mg/5 ml),?Diphenhydramine(8 mg/5', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1067, 'Chloroquine 500MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1068, 'Biotin, L methylfolate, Methylcobalamin and Pyridoxal 5-phosphate. \n', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1069, 'Eperisone (150mg), Diclofenac (100mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00');
INSERT INTO `composition` (`composition_id`, `composition_name`, `agestart`, `age_end`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1070, 'L-ARGININE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1071, 'IV FLUIDS', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1072, 'Domperidone(30mg),Esomeprazole(40mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1073, 'Betamethasone Topical (0.10% W/w), Gentamicin Topical (0.10% W/w), Miconazole Topical (2% W/w)', 0, 99, 1, '36', '2017-09-24 11:09:27', '117.207.109.148'),
(1074, 'KETAMIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1075, 'Cefixime (100mg)', 0, 99, 1, '36', '2017-09-24 11:14:02', '117.207.109.148'),
(1076, 'Aloe Vera inhibits essential nutrients and other active components,', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1077, 'Omeprazole (40mg)', 0, 99, 1, '36', '2017-09-24 11:16:11', '117.207.109.148'),
(1078, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1079, 'Iron, Folic acid, Methylcobalamin, Manganese and Copper', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1080, 'Docusate sodium 100 MG+Senna extract 86 MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1081, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1082, 'Mefenamic Acid (100mg)', 0, 99, 1, '36', '2017-09-24 11:21:56', '117.207.109.148'),
(1083, 'Mebeverine (135mg)', 0, 99, 1, '36', '2017-09-24 11:25:10', '117.207.109.148'),
(1084, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1085, 'VITAMIN A', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1086, 'ROXITHROMYCIN 75MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1087, 'Evening Primrose oil (EPO) 500mg', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1088, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1089, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1090, 'KETOCONAZOLE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1091, 'Voglibose (0.3mg)', 0, 99, 1, '36', '2017-09-24 11:33:48', '117.207.109.148'),
(1092, 'Iron, Folic acid, Methylcobalamin, Manganese and Copper', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1093, 'CEFALEXINE 250MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1094, 'TELMISARTAN 20MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1095, 'PANTAPRAZOLE-MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1096, 'povidine iodine', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1097, 'Furosemide ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1098, 'Lidocaine (2% W/v), Clotrimazole (1% W/v), Beclometasone (0.025% W/v), Ofloxacin (0.3% W/v)', 0, 99, 1, '36', '2017-09-24 12:01:09', '117.207.109.148'),
(1099, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1100, 'CEFTRIAXONE ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1101, 'Clotrimazole Topical', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1102, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1103, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1104, 'Aloe vera gel and glycerin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1105, 'midazolam', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1106, 'multivitamin, zinc, selenium', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1107, 'Cefuroxime (500mg)', 0, 99, 1, '36', '2017-09-25 23:08:04', '117.201.30.118'),
(1108, 'ARTESUNATE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1109, 'Mefenamic Acid (500mg)', 0, 99, 1, '36', '2017-09-24 12:36:47', '117.207.109.148'),
(1110, 'Theophylline(25.3mg),Etophylline(84.7mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1111, 'Theophylline(25.3mg),Etophylline(84.7mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1112, 'Amoxicillin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1113, 'Spironolactone(25 mg),Torasemide(10 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1114, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1115, 'Spironolactone(25 mg),Torasemide(10 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1116, 'Brahmi, Ashwagandha and Madhukaparni.', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1117, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1118, 'RIFAXIMIN 400MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1119, 'RIFAXIMIN 200MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1120, 'HYDROCORTISONE SODIUM SUCCINATE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1121, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1122, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1123, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1124, 'Mefenamic Acid (250mg), Tranexamic Acid (500mg), Vitamin K (25mcg)', 0, 99, 1, '36', '2017-09-24 13:19:38', '117.207.109.148'),
(1125, 'Betamethasone Topical (0.1% W/w)', 0, 99, 1, '36', '2017-09-24 13:21:20', '117.207.109.148'),
(1126, 'Cefpodoxime (200mg), Ofloxacin (200mg)', 0, 99, 1, '36', '2017-09-24 13:24:12', '117.207.109.148'),
(1127, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1128, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1129, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1130, 'Ceftazidime (1000mg)', 0, 99, 1, '36', '2017-09-24 13:26:27', '117.207.109.148'),
(1131, 'L-Ornithine L-Aspartate (5gm)', 0, 99, 1, '36', '2017-09-24 13:29:14', '117.207.109.148'),
(1132, 'RACECADOTRIL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1133, 'Cefpodoxime (50mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1134, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1135, 'Glimepiride (2mg), Metformin (500mg)', 0, 99, 1, '36', '2017-09-26 00:59:24', '117.201.28.157'),
(1136, 'Meropenem (125mg)', 0, 99, 1, '36', '2017-09-24 13:34:31', '117.207.109.148'),
(1137, 'Methylcobalamin (1mg), Vitamin B6 (Pyridoxine) (100mg), Niacinamide (10mg)', 0, 99, 1, '36', '2017-09-26 11:27:33', '117.207.101.207'),
(1138, 'Dicyclomine(10 mg/ml),Dimethicone(40 mg/ml)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1139, 'Salmeterol (25mcg), Fluticasone (125mcg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1140, 'APPLE DRINK', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1141, 'Levetiracetam (500mg)', 0, 99, 1, '36', '2017-09-24 13:43:00', '117.207.109.148'),
(1142, 'Naproxen (250mg), Domperidone (10mg)', 0, 99, 1, '36', '2017-09-24 13:45:27', '117.207.109.148'),
(1143, 'Pyridoxine (Vitamin B3) , about 10 mg of Thiamine ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1144, 'THYOCOLCHICOSIDE, ACECLOFENAC AND PARACETAMOL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1145, 'Natural Micronised Progesterone (300mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1146, 'GENERal', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1147, 'Sodium Picosulfate (10mg)', 0, 99, 1, '36', '2017-09-24 13:55:44', '117.207.109.148'),
(1148, 'Telmisartan(40 mg),Amlodipine(5 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1149, 'Drotaverine (40mg)', 0, 99, 1, '36', '2017-09-23 17:37:41', '117.221.131.116'),
(1150, 'cefuroxime 125MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1151, 'Clotrimazole Topical', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1152, 'Glycerine, Shea Butter, Kokum Butter, Olive Extract, Aloe Vera Extract, Milk Protein, Wheat Protein,', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1153, 'Artemether (60mg), Lumefantrine (360mg)', 0, 99, 1, '36', '2017-09-24 14:02:36', '117.207.109.148'),
(1154, 'Fluticasone (topical) (50mcg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1155, 'LIDOCAIN, BECLAMETHASONE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1156, 'Cyanocobalamin , Elemental zinc , Folic acid , L-isoleucine , L-phenylalanine , L-threonine , L-vali', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1157, 'Telmisartan (40mg)', 0, 99, 1, '36', '2017-09-26 16:44:44', '117.222.161.67'),
(1158, 'Cefixime (200mg), Cloxacillin (500mg), Lactobacillus (90Million Spores)', 0, 99, 1, '36', '2017-09-24 14:11:44', '117.207.109.148'),
(1159, 'Cefpodoxime (100mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1160, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1161, 'Cefpodoxime (100mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1162, 'ELECTROLITE M', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1163, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1164, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1165, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1166, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1167, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1168, 'RABIES VACCINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1169, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1170, 'Beta-Carotene, Chromium, Inositol, Iodine, (Cyanocobalamin),', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1171, 'potent lithotriplic and diurelic properties', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1172, 'Cefalexin (250mg)', 0, 99, 1, '36', '2017-09-26 13:44:37', '117.207.101.207'),
(1173, 'Acetyl Cysteine (600mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1174, 'L-Carnitine, Ubidecarenone, Zinc, Lycopene, and Astaxanthin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1175, 'Cefixime (200mg), Clavulanic Acid (125mg)', 0, 99, 1, '36', '2017-09-26 11:21:13', '117.207.101.207'),
(1176, 'Ampicillin (500mg), Dicloxacillin (500mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1177, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1178, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1179, 'Pyridoxine (Vitamin B3) , about 10 mg of Thiamine ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1180, 'minerals, vitamins, nutrients Glucosamine, Chondroitin Sulphate, Ginger and benefits of Collagen typ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1181, 'multivitamin multimineral ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1182, 'Vitamin B6 (Pyridoxine) (20mg), Doxylamine (20mg), Folic Acid (5mg)', 0, 99, 1, '36', '2017-09-24 14:20:08', '117.207.109.148'),
(1183, 'Calcium Carbonate, Calcitirol and Vitamin K2', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1185, 'Furosemide (40mg)', 0, 99, 1, '36', '2017-09-24 14:24:04', '117.207.109.148'),
(1186, 'Albendazole (400mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1187, 'Calamine, Aloe Vera And Light Liquid Paraffin', 0, 99, 0, '36', '2017-09-22 19:02:36', '117.201.30.250'),
(1188, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1189, 'Aceclofenac (100mg), Tizanidine (2mg)', 0, 99, 1, '26', '2017-08-25 12:06:25', '49.207.187.48'),
(1191, 'Sodium Chloride(0.9% w/v)-ML', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1192, 'Dextrose(10% w/v)-ML', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1193, 'Dextrose(5gm)-ML', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1194, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1195, 'SYRINGE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1196, 'Heparin (25000IU)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1197, 'Fungal diastase and Pepsin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1198, 'Naproxen (500mg), Domperidone (10mg)', 0, 99, 1, '36', '2017-09-24 17:21:23', '117.207.107.176'),
(1199, 'SUTURE METERIAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1201, 'Glucosamine (750mg), Diacerein (50mg), Methyl Sulfonyl Methane (250mg)', 0, 99, 1, '36', '2017-09-24 17:25:40', '117.207.107.176'),
(1202, 'Neostigmine (2.5mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1203, 'Prochlorperazine (12.5mg)', 0, 99, 1, '36', '2017-09-24 19:01:25', '117.201.27.215'),
(1204, 'Hydrochlorothiazide (12.5mg), Olmesartan (40mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1205, 'Bacitracin Topical(5000 iu),Neomycin Topical(3400 iu)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1207, 'PARACETAMOL+ MEFENAMIC ACID', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1208, 'Clidinium (2.5mg), Chlordiazepoxide (5mg), Dicyclomine (10mg)', 0, 99, 1, '36', '2017-09-24 19:21:44', '117.201.27.215'),
(1209, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1210, 'PARACETAMOL 250MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1211, 'cholecalciferol (Vitamin D3)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1212, 'Domperidone (30mg), Esomeprazole (20mg)', 0, 99, 1, '36', '2017-09-24 19:39:00', '117.201.27.215'),
(1213, 'Labetalol (100mg)', 0, 99, 1, '36', '2017-09-24 19:44:14', '117.201.27.215'),
(1214, 'Theophylline(25.3mg),Etophylline(84.7mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1215, 'Levofloxacin (500mg), Azithromycin (500mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1216, 'Prazosin (2.5mg)', 0, 99, 1, '36', '2017-09-24 20:10:52', '117.201.27.215'),
(1217, 'Trypsin Chymotrypsin (200000AU)', 0, 99, 1, '36', '2017-09-24 20:21:00', '117.201.27.215'),
(1218, 'Fluoxetine (20mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1219, 'PARACETAMOL 500MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1220, 'Paracetamol (250mg)', 0, 99, 1, '36', '2017-09-24 20:35:54', '117.201.27.215'),
(1221, 'Ciprofloxacin (0.3% W/v), Dexamethasone (0.1% W/v)', 0, 99, 1, '26', '2017-09-17 12:58:09', '49.207.184.10'),
(1222, 'Epinephrine (2mg)', 0, 99, 1, '36', '2017-09-24 20:37:49', '117.201.27.215'),
(1224, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1225, 'Enalapril (10mg)', 0, 99, 1, '36', '2017-09-24 20:59:55', '59.93.11.160'),
(1226, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1227, 'CHLOROQUINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1228, 'Cefpodoxime (50mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1229, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1230, 'Levofloxacin (750mg)', 0, 99, 1, '36', '2017-09-26 00:42:50', '117.201.28.157'),
(1231, 'Ranitidine (50mg)', 0, 99, 1, '26', '2017-09-10 11:28:21', '49.207.187.48'),
(1232, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1233, 'Natural Micronised Progesterone (200mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1234, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1235, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1236, 'Menotrophin (75IU)', 0, 99, 1, '36', '2017-09-24 22:35:22', '117.201.17.49'),
(1238, 'Cefalexin (125mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1239, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1240, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1241, 'PROTIEN POWDER', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1242, 'RACECADOTRIL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1243, 'Itopride (50mg)', 0, 99, 1, '36', '2017-09-24 22:59:14', '117.201.17.114'),
(1244, 'Caffeine (100mg), Ergotamine (1mg), Paracetamol (250mg), Belladonna Dry Extract (10mg)', 0, 99, 1, '36', '2017-09-25 01:01:18', '117.201.30.230'),
(1245, 'Isoniazid (300mg), Vitamin B6 (Pyridoxine) (10mg)', 0, 99, 1, '36', '2017-09-25 00:30:39', '117.201.20.40'),
(1246, 'Ethamsylate (500mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1247, 'Telmisartan(40 mg),Hydrochlorothiazide(12.5 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1248, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1249, 'Amoxicillin (500mg)', 0, 99, 1, '36', '2017-09-25 22:43:54', '117.201.31.100'),
(1250, 'Chloroquine (500mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1251, 'Promethazine (10mg)', 0, 99, 1, '36', '2017-09-25 20:22:09', '117.207.97.104'),
(1252, 'Cetirizine (5mg)', 0, 99, 1, '36', '2017-09-20 14:14:42', '157.50.8.207'),
(1253, 'TESTOSTERON', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1254, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1255, 'MEBENDAZOLE 100MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1256, 'Clotrimazole Topical', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1257, 'DEXTROSE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1258, 'Fexofenadine (30mg)', 0, 99, 1, '36', '2017-09-25 20:31:34', '117.207.97.104'),
(1259, 'CAMYLOFINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1260, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1261, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1262, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1263, 'TOBRAMYCIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1264, 'PROTIEN POWDER', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1265, 'Salmeterol (50mcg), Fluticasone (500mcg)', 0, 99, 1, '36', '2017-09-25 20:35:39', '117.207.97.104'),
(1266, 'Beclometasone Topical (0.025% w/w), Fusidic Acid Topical (2% w/w)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1267, 'CAMYLOFINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1268, 'Amoxicillin (750mg), Clarithromycin (500mg), Esomeprazole (40mg)', 0, 99, 1, '36', '2017-09-25 20:57:35', '59.93.9.176'),
(1269, 'Propofol (10mg)', 0, 99, 1, '36', '2017-09-25 21:12:28', '59.93.9.176'),
(1270, 'Bisacodyl', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1271, 'COLLODIAL SILVER', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1272, 'HALOPERIDOL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1273, 'Beta-carotene,Eicosapentaenoic acid (EPA),  Zinc, Lutein, Lycopene, ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1274, 'DIBUTAMINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1275, 'Flupirtine (100mg), Paracetamol (325mg)', 0, 99, 1, '36', '2017-09-25 21:16:33', '59.93.9.176'),
(1276, 'Telmisartan(40 mg),Hydrochlorothiazide(12.5 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1277, 'Docosahexaenoic acid 100 MG+Eicosapentaenoic acid', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1278, 'Clopidogrel (150mg)', 0, 99, 1, '26', '2017-09-15 12:34:16', '180.151.35.68'),
(1279, 'Bromelain (90mg), Rutoside (100mg), Trypsin Chymotrypsin (50000AU)', 0, 99, 1, '36', '2017-09-26 13:56:45', '117.207.101.207'),
(1280, 'Diclofenac Topical (100mg)', 0, 99, 1, '36', '2017-09-25 21:34:13', '117.201.31.100'),
(1281, 'LIDOCAIN, BECLAMETHASONE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1282, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1283, 'Asparagus Racemosus', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1284, 'Levodopa (100mg), Carbidopa (25mg)', 0, 99, 1, '36', '2017-09-25 21:38:35', '117.201.31.100'),
(1287, 'Glimepiride (2mg), Metformin (500mg), Voglibose (0.2mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1288, 'Cefpodoxime (50mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1289, 'Meropenem (250mg)', 0, 99, 1, '36', '2017-09-25 21:59:19', '117.201.31.100'),
(1290, 'Atropine (0.6mg)', 0, 99, 1, '36', '2017-09-25 22:10:30', '117.201.31.100'),
(1291, 'POTASSIUM CHLORIDE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1292, 'Clomifene (50mg)', 0, 99, 1, '36', '2017-09-26 14:56:53', '117.207.101.207'),
(1293, 'Clindamycin (300mg)', 0, 99, 1, '36', '2017-09-25 22:16:42', '117.201.31.100'),
(1294, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1295, 'Trypsin,Bromelain,Rutoside,Diclofenac', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1296, 'Rosuvastatin (5mg)', 0, 99, 1, '36', '2017-09-25 22:27:25', '117.201.31.100'),
(1297, 'Amoxicillin (500mg), Bromhexine (8mg)', 0, 99, 1, '36', '2017-09-25 22:30:50', '117.201.31.100'),
(1298, 'Cefixime (50mg)', 0, 99, 1, '36', '2017-09-26 19:52:21', '117.207.104.192'),
(1299, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1300, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1301, 'CALAMINE LIGHT LIQUID PARAFFIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1302, 'PROPOFOL 20MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1303, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1304, 'KETOCONAZOLE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1306, 'Thyroxine (12.5mcg)', 0, 99, 1, '26', '2017-08-29 07:20:40', '106.203.121.80'),
(1307, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1308, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1309, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1310, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1311, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1312, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1313, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1314, 'BORIC ACID', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1315, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1316, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1317, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1318, 'B12', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1319, 'POWDER', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1320, 'IV FLUIDS', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1321, 'OFLOXACIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1322, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1323, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1325, 'Pyridoxine (Vitamin B3) , about 10 mg of Thiamine ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1326, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1327, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1328, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1329, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1330, 'CHLORPROMAZINE 50MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1331, 'DRACOTIN, MEMOSA', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1332, 'PREGABALIN, METHICOBALAMIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1333, 'Vecuronium (10mg)', 0, 99, 1, '26', '2017-08-25 22:00:08', '49.207.187.48'),
(1334, 'CINNARIZINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1335, 'Diclofenac 1.16% W/w, Linseed Oil 3% W/w, Methyl Salicylate 10.0% W/w And Menthol 5.0% W/w', 0, 99, 1, '26', '2017-09-09 18:03:39', '49.207.187.48'),
(1336, 'CLOMIFEN, MELANOTIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1337, 'POTASSIUM CHLORIDE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1338, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1339, 'Ursodeoxycholic Acid (150mg)', 0, 99, 1, '36', '2017-09-26 12:51:25', '117.207.101.207'),
(1340, 'CEFUROXIME 500MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1341, 'Artemether , Lumefantrine ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1342, 'VITAMINS MINERALS ZINC', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1343, 'CLINDAMYCIN, CLOTRIMAZOLE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1344, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1345, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1346, 'CLOMIFENE 25MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1347, 'Anti Rabies Sera Immunoglobulins', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1348, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1350, 'SULFASALAZINE 500MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1351, 'MEGNESIUM SULFATE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1352, 'LINSEED OIL, DICLOFENAC, DIETHYLAMINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1353, 'AMOXYCILLIN CLAVULANIC ACID', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1354, 'PREMAQUINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1355, 'Voglibose (0.2mg)', 0, 99, 1, '36', '2017-09-25 23:27:12', '117.201.30.118'),
(1356, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1357, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1358, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1359, 'Beta-carotene,Eicosapentaenoic acid (EPA),  Zinc, Lutein, Lycopene, ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1360, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1362, 'CEFTRIAXONE 2GM', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1363, 'Ranitidine (75mg)', 0, 99, 1, '26', '2017-09-10 11:32:49', '49.207.187.48'),
(1364, 'Secnidazole', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1365, 'Escitalopram', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1366, 'Levonorgestrel (1.5mg)', 0, 99, 1, '36', '2017-09-25 23:34:58', '117.201.30.118'),
(1367, 'Aceclofenac (200mg)', 0, 99, 1, '36', '2017-09-25 23:36:46', '117.201.30.118'),
(1368, 'SACROMYCIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1369, 'Thyroxine (75mcg)', 0, 99, 1, '26', '2017-08-29 07:22:27', '106.203.121.80'),
(1370, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1371, 'Spironolactone(25 mg),Torasemide(10 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1372, 'SUTURE METERIAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1373, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1374, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1375, 'PAPAYA LEAF EXTRACT ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1376, 'LINEZOLID I.V.', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1377, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1378, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1379, 'LACTATING', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1380, 'PARACETAMOL 80MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1381, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1382, 'Cefixime (200mg)', 0, 99, 1, '36', '2017-09-25 23:44:45', '117.201.30.118'),
(1383, 'MONTELIKAST10MG, LEVOCETRIZINE 5MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1384, 'Glimepiride 500MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1385, 'Caffeine (100mg), Ergotamine (1mg), Paracetamol (250mg), Prochlorperazine (2.5mg)', 0, 99, 1, '36', '2017-09-25 23:50:28', '117.201.30.118'),
(1386, 'ANTACID', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1387, 'LOPERIMIDE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1388, 'DEXAMETHASONE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1389, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1390, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1391, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1392, 'Amoxicillin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1393, 'PREMAQUINE 2.5MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1394, 'Salbutamol(100 mcg),Ipratropium(40 mcg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1395, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1396, 'Progesterone SUSTAINED RELEASE ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1397, 'Glimepiride,Metformin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1398, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1399, 'Iron, Folic acid, Methylcobalamin, Manganese and Copper', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1400, 'Levetiracetam', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1401, 'CLOPIDOGRIL 75MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1402, 'FAROPENUM 200MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1403, 'Furosemide (40mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1404, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1405, 'Diclofenac (50mg), Paracetamol (325mg), Serratiopeptidase (10mg)', 0, 99, 1, '36', '2017-09-26 00:15:14', '117.201.28.157'),
(1406, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1407, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1408, 'Guduchi (Tinospora Cordifolia), Saunf (Foeniculum Vulgare), Kutki (Picrorhiza Kurroa), Vidang (Embil', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1409, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1410, 'AMPICILLIN 500MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1411, 'Clotrimazole Topical', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1412, 'Octreotide', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1413, 'PRYROLATE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1414, 'ATORVASTATINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1415, 'RIFAXIMIN 400MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1416, 'BETAHISTIN 16MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1417, 'Tranexamic Acid (500mg)', 0, 99, 1, '26', '2017-08-25 23:16:36', '49.207.187.48'),
(1418, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1419, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1420, 'Mometasone Topical(0.1% w/w),Salicylic Acid(3.5% w/w)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1421, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1422, 'AYURVEDIC', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1423, 'PIPERACILLIN, TAZOBACTUM  ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1424, 'Progesterone 100MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1425, 'PIRACETAM', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1426, 'Terbinafine (250mg)', 0, 99, 1, '36', '2017-09-25 00:02:15', '157.50.23.160'),
(1427, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1428, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1429, 'TRIPSIN, CHYMOTRYPSIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1430, 'Trypsin (48mg), Bromelain (90mg), Rutoside (100mg), Diclofenac (50mg)', 0, 99, 1, '36', '2017-09-26 00:40:40', '117.201.28.157'),
(1431, 'GENERGAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1432, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1433, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1434, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1435, 'TRAMADOL HYDROCHLORIDE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1436, 'LEVOFLOXACIN 750MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1437, 'KETOCANAZOLE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1438, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1439, 'PYRITINOL 100MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1440, 'Ethamsylate', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1441, 'HEALTH SUPPLIMENT', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1442, 'Saraca indica, Asparagus racemosus, Symplocos racemosus, Aloe vera, Cedrus deodara, Terminalia chebu', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1443, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1444, 'ALBENDAZOLE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1445, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1446, 'MILK PROTEIN POWDER', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1447, 'Sodium Chloride(0.600gm),Sodium Lactate(0.320gm),Potassium Chloride(0.040gm),Calcium Chloride(0.027g', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1448, 'LYSINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1449, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1450, 'Progesterone', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1451, 'POTACIUM MEGNESIUM CITRATE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1452, 'Glimepiride,Metformin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1453, 'Glimepiride,Metformin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1454, 'Ethinyl Estradiol (0.15mg), Levonorgestrel (0.03mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1455, 'Ormeloxifene', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1456, 'CAMYLOFINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1457, 'Levosulpiride (75mg), Esomeprazole (40mg)', 0, 99, 1, '36', '2017-09-26 01:02:22', '117.201.28.157'),
(1458, 'Isoxsuprine', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1459, 'Drotaverine (80mg), Mefenamic Acid (250mg)', 0, 99, 1, '26', '2017-08-29 07:28:03', '106.203.121.80'),
(1460, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1461, 'Beta-Carotene, Chromium, Inositol, Iodine, (Cyanocobalamin),', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1462, 'MONTELIKAST LEVO CETRIZINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1463, 'PIRACETAM', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1464, 'CLOPIDOGRIL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1465, 'Iron, Folic acid, Methylcobalamin, Manganese and Copper', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1466, 'PANCREATIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1467, 'Cefadroxil', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1468, 'OFLOXACIN+ ORNIDAZOLE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1469, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1470, 'Iron, Folic acid, Methylcobalamin, Manganese and Copper', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1472, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1473, 'VITAMINS MINERALS ZINC', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1474, 'hydroxocobalamin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1475, 'Metoclopramide', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1476, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1477, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1478, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1479, 'BCG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1481, 'CABERGOLIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1482, 'Ethinyl Estradiol,Drospirenone', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1483, 'Tranexamic Acid (500mg)', 0, 99, 0, '36', '2017-09-20 14:07:39', '157.50.8.207'),
(1484, 'Clotrimazole Topical', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1485, 'Cyproheptadine (1.5mg), Tricholine Citrate (55mg)', 0, 99, 1, '36', '2017-09-26 10:34:05', '117.207.101.207'),
(1486, 'TERBINAFINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1487, 'CEFTRIAXONE ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1488, 'CALCIUM', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1489, 'CEFTRIAXONE ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1490, 'Cilnidipine (10mg), Telmisartan (40mg)', 0, 99, 1, '36', '2017-09-26 11:04:39', '117.207.101.207'),
(1491, 'DOXYCILLIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1492, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1493, 'Hyoscine(10 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1494, 'Ethinyl Estradiol,Drospirenone', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1495, 'BICLIZINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1496, 'Clotrimazole Topical', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1497, 'Bupivacaine', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1499, 'PARACETAMOL. PHENYLEPRONE HYDROCHLORIDE CHLORPHENIRAMINE MALEATE-MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1500, 'ANTACID', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1501, 'PARACETAMOL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1502, 'Methylcobalamin (1mg), Vitamin B6 (Pyridoxine) (100mg), Niacinamide (10mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1503, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1504, 'PERIMITHINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1505, 'Theophylline(25.3mg),Etophylline(84.7mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1506, 'Bacitracin Topical(5000 iu),Neomycin Topical(3400 iu)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1507, 'PARACETAMOL. PHENYLEPRONE HYDROCHLORIDE CHLORPHENIRAMINE MALEATE-ML', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1509, 'PARACETAMOL. PHENYLEPRONE HYDROCHLORIDE CHLORPHENIRAMINE MALEATE-ML', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1510, 'Aspirin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1511, 'silver nano particles(0.02 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1512, 'Beta-carotene,Eicosapentaenoic acid (EPA),  Zinc, Lutein, Lycopene, ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1513, 'METRONIDAZOLE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1514, 'Teneligliptin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1516, 'Dicyclomine(10 mg),Simethicone(40 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1517, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1518, 'Human chorionic gonadotropin (hCG) (5000IU)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1519, 'CALCIUM  WITH VITAMIN D3', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1520, 'SURGIcal', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1521, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1522, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1523, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1524, 'VITAMIN B12', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1525, 'Ropinirole', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1526, 'METFORMIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1527, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1529, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1530, 'CEFTRIAXONE ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1531, 'Cefalexin (375mg)', 0, 99, 1, '36', '2017-09-26 18:53:12', '103.60.74.3'),
(1532, 'Polio Vaccine (', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1533, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1534, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1535, 'Guduchi (Tinospora Cordifolia), Saunf (Focrorhiza Valgare), Kutki ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1536, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1537, 'Norethisterone', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1538, 'Iron, Folic acid, Methylcobalamin, Manganese and Copper', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1539, 'Diptheria Immune Globulin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1540, 'Theophylline(25.3mg),Etophylline(84.7mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1541, 'Azathioprine', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1542, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1543, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1544, 'essential oils, namely dill oil and fennel oil. ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1545, 'PARACETAMOL. PHENYLEPRONE HYDROCHLORIDE CHLORPHENIRAMINE MALEATE-ML', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1546, 'CLINDAMYCIN PHOSPATE & CLOTRIMAZOLE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1547, 'ARTESUNATE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1548, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1549, 'Hydroxyprogesterone', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1550, 'BUDESONIDE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1551, 'HEPATITIS-B VACCINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1552, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1553, 'ARTESUNATE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1554, 'PROPOFOL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1555, 'Chlorpheniramine (2mg/ml), Phenylephrine (5mg/ml)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1557, 'CABERGOLIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1558, 'Levetiracetam (100mg/ml)', 0, 99, 1, '36', '2017-09-26 12:50:11', '117.207.101.207'),
(1559, 'FLUCANAZOLE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1560, 'Glimepiride,Metformin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1561, 'Aspirin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1562, 'CITRULLUS VULGARIUS, HEMIDESMUS INDICUS', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1563, 'METFORMIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1564, 'ATORVASTATINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1565, 'TRENAXAMIC ACID', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1566, 'KETAMINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1567, 'Levetiracetam (100mg/ml)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1568, 'URSODILE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1570, 'EVENING PRIMROSE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1571, 'Aceclofenac (100mg), Paracetamol (325mg), Trypsin Chymotrypsin (50000AU)', 0, 99, 1, '36', '2017-09-26 12:53:40', '117.207.101.207'),
(1572, 'Bisacodyl', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1573, 'Copper, Selenium, Zinc, ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1574, 'L-TYROCIN, MULTIC=VITAMINS, MULTIMINERALS', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1575, 'RAMIPRIL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1576, 'Amoxicillin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1577, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1578, 'Progesterone', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1579, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1580, 'Bupivacaine', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1581, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1582, 'Camylofin (25mg), Paracetamol (300mg)', 0, 99, 1, '36', '2017-09-26 15:03:09', '117.207.101.207'),
(1583, 'Progesterone', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1584, 'SILVER IONIZED', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1585, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1586, 'Clindamycin Topical (100mg), Clotrimazole Topical (200mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1587, 'CLOMIFENE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1588, 'Dexchlorpheniramine (2mg)', 0, 99, 1, '36', '2017-09-26 13:17:55', '117.207.101.207'),
(1589, 'Cefpodoxime (200mg), Clavulanic Acid (125mg)', 0, 99, 1, '36', '2017-09-26 13:20:13', '117.207.101.207'),
(1590, 'ENOXAPARIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1591, 'CARVEDIOL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1592, 'AMLODIPINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1593, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1594, 'Calcium Carbonate And Vitamin D3 Fortified With Magnesium & Zinc', 0, 99, 1, '26', '2017-09-09 12:35:44', '49.207.187.48'),
(1595, 'CIPROFLOXACIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1596, 'PARACETAMOL. PHENYLEPRONE HYDROCHLORIDE CHLORPHENIRAMINE MALEATE-MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1597, 'ESOMEPRAZOLE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1599, 'LINEZOLID ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1600, 'PANTAPRAZOLE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1601, 'Calcium Dobesilate (500mg), Troxerutin (500mg)', 0, 99, 1, '36', '2017-09-26 13:39:51', '117.207.101.207'),
(1602, 'Thyroxine (125mcg)', 0, 99, 1, '26', '2017-08-29 07:23:39', '106.203.121.80'),
(1603, 'Prednisolone 10mg', 0, 99, 1, '26', '2017-08-25 11:40:24', '49.207.187.48'),
(1604, 'Sildenafil(25 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1605, 'LEVOCETRIZINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1606, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1607, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1608, 'CEFALEXIN 250MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1610, 'DICLOFENAC', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1611, 'CALCIUM  WITH VITAMIN D3', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1612, 'Sodium Chloride(0.9% w/v)-ML', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1613, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1614, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1615, 'Sodium Picosulfate (3.33mg), liquid paraffin (1.25ml), Milk of Magnesia (3.75ml)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00');
INSERT INTO `composition` (`composition_id`, `composition_name`, `agestart`, `age_end`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1616, 'BETAHISTIN 8MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1617, 'Bupivacaine', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1618, 'MEGNESIUM', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1619, 'TRIPSIN, CHYMOTRIPSIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1620, 'PIRACETAM', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1621, 'LOSARTAN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1622, 'Aspirin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1623, 'Glimepiride,Metformin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1624, 'CEFUROXIME', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1625, 'LEVOFLOXACIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1626, 'Bisacodyl', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1627, 'Sucralfate', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1628, 'SUTURE METERIAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1629, 'SUTURE METERIAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1630, 'SUTURE METERIAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1631, 'Paracetamol (325mg), Tramadol (37.5mg)', 0, 99, 1, '36', '2017-09-26 14:10:25', '117.207.101.207'),
(1632, 'PREVENTION & TREATMENT OF RASHES-MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1633, 'Butorphanol (2mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1634, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1635, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1636, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1637, 'Diethylcarbamazine (100mg)', 0, 99, 1, '36', '2017-09-26 14:14:35', '117.207.101.207'),
(1638, 'Aceclofenac (100mg), Paracetamol (325mg), Trypsin Chymotrypsin (150000AU)', 0, 99, 1, '36', '2017-09-26 16:26:28', '117.221.130.65'),
(1639, 'METFORMIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1640, 'Vancomycin (500mg)', 0, 99, 1, '36', '2017-09-26 14:36:22', '117.207.101.207'),
(1641, 'CLOMIFENE 50MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1642, 'METHYLCOBALAMIN, METHYL FOLATE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1643, 'Cefoperazone (500mg), Sulbactam (500mg)', 0, 99, 1, '36', '2017-09-26 14:46:31', '117.207.101.207'),
(1644, 'Carbamazepine (200mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1645, 'SILVER NITRATE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1646, 'multivitamins, multiminerals', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1647, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1648, 'Glimepiride,Metformin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1649, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1650, 'MEROPENUM 500MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1651, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1652, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1653, 'CEFAPERAZONE+SULBACTUM', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1654, 'Clomifene (50mg), Coenzyme Q10 (75mg), Acetyl Cysteine (600mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1655, 'THYOCOLCHICOSIDE, ACECLOFENAC AND PARACETAMOL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1656, 'Camylofin (25mg), Paracetamol (300mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1657, 'DOXYCILLIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1658, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1660, 'Guaifenesin(50 mg),Terbutaline(1.25 mg),Bromhexine', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1661, 'SYRINGE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1663, 'AMLODIPINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1664, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1665, 'Hyoscine', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1666, 'TRIPSIN, CHYMOTRYPSIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1667, 'Diclofenac (50mg), Trypsin Chymotrypsin (50000AU)', 0, 99, 1, '26', '2017-09-09 13:00:30', '49.207.187.48'),
(1668, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1669, 'B-COMPLEX', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1670, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1671, 'AMPICILLIN CLOXACIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1672, 'DIOSMIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1673, 'Guaifenesin(50 mg),Terbutaline(1.25 mg),Bromhexine', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1674, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1675, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1676, 'PENTAZOCIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1677, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1678, 'Vitamin D3', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1679, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1680, 'CLARITHROMYCIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1681, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1682, 'IRON', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1683, 'Cefuroxime (500mg), Clavulanic Acid (125mg)', 0, 99, 1, '36', '2017-09-26 16:10:39', '117.207.101.207'),
(1684, 'Milk Of Magnesia (11.25ml), Liquid Paraffin (3.75ml)', 0, 99, 1, '36', '2017-09-26 16:16:23', '117.207.101.207'),
(1685, 'Cefixime (200mg), Linezolid (600mg)', 0, 99, 1, '26', '2017-09-09 23:18:24', '49.207.187.48'),
(1687, 'Aceclofenac (100mg), Paracetamol (325mg), Trypsin Chymotrypsin (150000AU)', 0, 99, 1, '26', '2017-08-25 11:48:51', '49.207.187.48'),
(1688, 'PROTEIN CALCIUM DHA', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1689, 'PARACETAMOL 650MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1690, ' Alpha lipoic acid, Benfotiamine, Docosahexaenoic acid', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1691, 'CISSUS', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1692, 'MECOBALAMIN, ALPHALOPIC ACID', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1693, 'TERBINAFINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1694, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1695, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1696, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1697, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1698, 'NEBIVOLOL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1699, 'ENOXAPARIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1700, 'LEVOFLAXACIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1701, 'DICLOFENAC', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1702, 'TELMISARTAN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1703, 'IRON AND FOLIC ACID', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1704, 'LIDOCAIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1705, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1706, 'BISOPROLOL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1707, 'LEVOFLOXACIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1708, 'Progesterone', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1709, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1710, 'KETOCONAZOLE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1711, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1712, 'GLYCOPYROLATE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1713, 'IRON', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1714, 'METHOTREXATE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1715, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1716, 'Dehydroepiandrosterone (75mg), L-Methyl Folate (1mg), Vitamin D3 (2000IU)', 0, 99, 1, '36', '2017-09-26 17:24:18', '117.222.161.67'),
(1717, 'Benfotiamine (7.5mg), Folic Acid (0.75mg), Methylcobalamin (750mcg), Pregabalin (75mg), Vitamin B6 (', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1718, 'surgical', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1719, 'Calcium CHOLECALCIFEROL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1720, 'surgical', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1721, 'cynomin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1722, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1723, 'Calcium CHOLECALCIFEROL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1724, 'desonide', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1725, 'general', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1726, 'Sulfamethoxazole (400mg), Trimethoprim (80mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1727, 'Ambroxol(15 mg),Levosalbutamol(0.5 mg),Guaifenesin(50 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1728, 'Amoxicillin (250mg), Clavulanic Acid (50mg)', 0, 99, 1, '26', '2017-08-25 13:03:40', '49.207.187.48'),
(1729, 'Cetirizine (5mg), Phenylephrine (5mg), Menthol (1.5mg/5ml), Dextromethorphan (10mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1730, 'Phenobarbitone-ML', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1731, 'deflozacort', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1732, 'calcium WITH VITAMIN D3', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1733, 'surgical', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1734, 'Dienogest', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1735, 'Amlodipine (5mg), Metoprolol (50mg)', 0, 99, 1, '36', '2017-09-26 17:42:10', '117.222.161.67'),
(1736, 'Clobetasol Topical (0.05% W/w), Clotrimazole Topical (1% W/w)', 0, 99, 1, '36', '2017-09-26 17:43:50', '117.222.161.67'),
(1737, 'Cranberry extract 200 MG+D-mannose 300 MG+Potassium-magnesium citrate 978 MG /15ML', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1738, 'surgical', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1739, 'cefalaxine', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1740, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1741, 'aluminium chlorohydrate ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1742, 'Clomifene (50mg), Coenzyme Q10 (75mg), Acetyl Cysteine (600mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1743, 'nikorandil', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1744, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1745, 'Azithromycin (1000mg), Ornidazole (750mg), Fluconazole (150mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1746, 'meropenum 1GM', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1747, 'surgical', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1748, 'dopamine', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1749, 'diosmin 500MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1750, 'multivitamins, multiminerals', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1751, 'Amoxicillin (400mg), Clavulanic Acid (57mg)', 0, 99, 1, '36', '2017-09-24 19:12:23', '117.201.27.215'),
(1752, 'Chlorpheniramine (NA)', 0, 99, 1, '36', '2017-09-26 18:03:30', '117.222.161.67'),
(1753, 'Clotrimazole Topical (1% W/w), Mometasone Topical (0.1% W/w)', 0, 99, 1, '36', '2017-09-26 18:08:31', '117.222.161.67'),
(1754, 'vitamin b12', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1755, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1756, 'Aspirin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1757, 'tamsulocin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1758, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1759, 'general', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1760, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1761, 'L-Leucine(5.6 mg),L-Isoleucine(12.5 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1762, 'levofloxacin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1763, 'electrolite m', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1764, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1765, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1766, 'mifepristone', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1767, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1768, 'Calamine, Aloe Vera, Allantoin And Vitamin E', 0, 99, 1, '26', '2017-09-09 12:31:12', '49.207.187.48'),
(1769, 'DIAZEPAM', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1770, 'Erythromycin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1771, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1772, 'Pantoprazole(40mg),Itopride(150mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1773, 'TOBRAMYCIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1774, 'Aloe vera gel and glycerin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1775, 'THAIMIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1777, 'L-CARNITINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1778, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1779, 'LACTATING', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1780, 'METHERGINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1781, 'Bacitracin Topical (250iu), Neomycin Topical (5mg), Sulfacetamide Topical (60mg)', 0, 99, 1, '36', '2017-09-21 10:08:27', '106.208.179.103'),
(1782, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1783, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1784, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1785, 'Cefixime (200mg), Ofloxacin (200mg)', 0, 99, 1, '36', '2017-09-26 18:39:35', '103.60.74.3'),
(1786, 'menstruation (periods), menorrhagia ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1787, 'DRACOTIN, MEMOSA', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1788, 'Citicoline 500 MG', 0, 99, 1, '36', '2017-09-25 23:29:17', '157.50.23.59'),
(1789, 'VITAMIN D3', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1790, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1791, 'CHOLCALCIFEROL, VITAMIN D3', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1792, 'FRUSEMIDE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1793, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1794, 'CEFALEXIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1795, 'Fluconazole (150mg), Azithromycin (1gm), Secnidazole (1gm)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1796, 'Carboxymethylcellulose', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1797, 'GENTAMYCIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1798, 'MOLMOL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1799, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1800, 'AZITHROMYCIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1801, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1802, 'CEFTRIAXONE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1803, 'NEBIVOLOL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1804, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1805, 'NUTRITION POWDER', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1806, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1807, 'CALCIUM', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1808, 'Calamine, Aloe Vera And Light Liquid Paraffin', 0, 99, 0, '36', '2017-09-22 19:03:22', '117.201.30.250'),
(1809, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1810, 'Telmisartan(40 mg),Amlodipine(5 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1811, 'Ampicillin (250mg), Cloxacillin (250mg)', 0, 99, 1, '36', '2017-09-26 19:20:40', '117.207.104.192'),
(1812, 'ATROPINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1813, 'Aloe vera, Oatmeal and NAB butterbur extract.', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1814, 'Chlorpheniramine (2mg), Paracetamol (500mg), Phenylephrine (10mg)', 0, 99, 1, '36', '2017-09-22 23:34:48', '103.204.29.216'),
(1815, 'Ayurvedic formulation', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1816, 'Teneligliptin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1817, 'Amoxicillin,Clavulanic Acid', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1818, 'BISACODYL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1819, 'AMOXYCILLIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1820, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1822, 'PARACETAMOL. PHENYLEPRONE HYDROCHLORIDE CHLORPHENIRAMINE MALEATE-ML', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1823, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1824, 'OFLOXACIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1825, 'Glyceryl Trinitrate (2.6mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1826, 'LIDOCAIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1827, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1828, 'PREVENTION & TREATMENT OF RASHES-MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1829, 'LEVOFLOXACIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1830, 'Thyroxine (50mcg)', 0, 99, 1, '26', '2017-08-29 07:24:37', '106.203.121.80'),
(1831, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1832, 'FOSFOMYCIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1834, 'Docosahexaenoic acid, L-methylfolate, Methylcobalmin, Pyridoxal 5-Phosphate and Vitamin D3. \n', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1835, 'CALCIUM', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1836, 'Progesterone', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1838, 'Hyoscine(10 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1839, 'Methotrexate (2.5mg)', 0, 99, 1, '36', '2017-09-26 19:54:33', '117.207.104.192'),
(1840, 'ALBENDAZOLE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1841, 'Aloe vera gel and glycerin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1842, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1843, 'Domperidone(15 mg),Omeprazole(10 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1844, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1845, 'Azithromycin (250mg)', 0, 99, 1, '36', '2017-09-26 19:58:21', '117.207.104.192'),
(1846, 'Cetirizine(10 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1847, 'PANTAPRAZOLE-MG', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1848, 'METFORMIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1849, 'Hepatitis Immunoglobulin (100iu)', 0, 99, 1, '36', '2017-09-26 20:06:28', '117.207.104.192'),
(1850, 'CALCIUM', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1851, 'MULTIVITAMIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1852, 'PARACETAMOL 250 SYR', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1854, 'Medroxyprogesterone (10mg)\n', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1855, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1856, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1857, 'MULTIVITAMIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1858, 'KETOKENAZOLE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1859, 'Amoxicillin(400 mg),Clavulanic Acid(57 mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1860, 'Vitamin D3', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1861, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1863, 'GENTICYN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1864, 'HEME IRON POLYPEPTIDE & L-METHYL FOLATE ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1865, 'Olmesartan (20mg), Amlodipine (5mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1866, 'CITICOLIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1867, 'CITICOLIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1868, 'STYPTOKYNACE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1869, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1870, 'Iron, Folic acid and Methylcobalamin.', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1871, 'Levosulpiride(75mg),Pantoprazole(40mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1872, 'METFORMIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1873, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1874, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1875, 'LACTATING', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1876, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1877, 'Penicillin G (Benzylpenicillin) (12Lac units)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1879, 'Progesterone', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1880, 'FLUPIRTINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1881, 'Alpha lipoic acid, Benfotiamine, Docosahexaenoic acid', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1882, 'Tinidazole (600mg), Norfloxacin (400mg), Lactobacillus (120Million Spores)', 0, 99, 1, '26', '2017-09-09 17:34:06', '49.207.187.48'),
(1883, 'ANTACID', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1884, 'CABERGOLIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1885, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1886, 'TRENAXAMIC ACID', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1887, 'natural herbs and vitamin C', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1888, 'Sodium Chloride', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1889, 'Pentoxifylline (400mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1890, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1892, 'MONTELIKAST LEVOCETRIZINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1893, 'Domperidone(30mg),Pantoprazole(40mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1894, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1895, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1896, 'APPLE DRINK', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1897, 'Folic Acid and Myo-inositol. ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1898, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1899, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1900, 'NORADRENALIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1901, 'Bupivacaine', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1902, 'L-ARGIN, COLLEGEN PEPTIDE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1903, 'Iron, Folic acid, Methylcobalamin, Manganese and Copper', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1904, 'AMOXYCILLIN POTACIUM CLAVULANIC ACID', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1907, 'APPLE DRINK', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1908, 'Aspirin', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1909, 'MOXIFLOXACIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1910, 'POVIDINE IODINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1911, 'L-ARGIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1912, 'APPLE DRINK', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1913, 'PAPAYA LEAFE EXTRACT', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1914, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1915, 'NEBIVOLOL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1916, 'THAIMIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1917, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1918, 'Benfotiamine (50mg), Levo-carnitine (50mg), Resveratrol (25mg), Vitamin B6 (Pyridoxine) (25mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1919, 'Estradiol (2mg), Sildenafil (25mg)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1920, 'LECITHIN, SILYMARIN, GLUTATHIONE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1921, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1922, 'TORASAMIDE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1923, 'Phenobarbitone-ML', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1924, 'Beta-Carotene, Chromium, Inositol, Iodine, (Cyanocobalamin),', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1925, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1926, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1927, 'KETOCANAZOLE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1928, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1929, 'Aloe vera, Oatmeal and NAB butterbur extract', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1930, 'CURADOR', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1931, 'IRON FOLIC ACID', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1932, 'PANTAPRAZOLE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1933, 'AMINO ACIDS, VITAMINS, MINERALS', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1934, 'MEROPENUM', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1935, 'AMOXYCILLIN& POTASSIUM CLAVULANATE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1936, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1937, 'METHYLPREDNISOLONE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1938, 'FLUNARIZINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1939, 'AZITHROMYCIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1940, 'sugar, salt, yeast, wheat, gluten,', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1941, 'Mucopolysaccharide Polysulfate (250IU)', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1942, 'SUTURE METERIEL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1943, 'ENOXAPARIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1944, 'PYZINAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1945, 'GENERAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1946, 'Enoxaparin (40mg)', 0, 99, 1, '36', '2017-09-26 13:22:11', '117.207.101.207'),
(1947, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1948, 'RACICADOTRIL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1949, 'Methylcobalamin (1500mcg), Nortriptyline (10mg), Pregabalin (75mg)', 0, 99, 1, '36', '2017-09-25 00:15:07', '157.50.23.160'),
(1950, 'PARACETAMOL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1951, 'CITICOLIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1952, 'LIDOCAIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1953, 'CLOTRIMAZOLE, BETAMETHASONE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1954, 'OFLOXACIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1955, 'Progesterone', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1956, 'CLOTRIMAZOLE, BETAMETHASONE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1957, 'CLOPIDOGRIL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1958, 'Valeriana Officinalis, Passiflora Incarnata And Humulus Lupulus', 0, 99, 1, '26', '2017-08-25 21:55:18', '49.207.187.48'),
(1959, 'Cilnidipine (5mg)', 0, 99, 1, '36', '2017-09-25 00:18:11', '157.50.23.160'),
(1960, 'PRE-PROBIOTIC', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1961, 'PREGALIN METHICOBALAMINE, ALPHALOPIC ACID', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1962, 'DICLOFENAC', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1963, 'Ambroxol (7.5mg), Guaifenesin (12.5mg), Terbutaline (0.25mg)', 0, 99, 1, '36', '2017-09-25 00:06:47', '157.50.23.160'),
(1964, 'PIPERACILLIN 1G  AND TAZOBACTAM 0.125G', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1965, 'FICUS GLOMARATS, BUTEA FRONDOSA', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1966, 'Piperacillin (2000mg), Tazobactum (250mg)', 0, 99, 1, '36', '2017-09-25 00:03:43', '157.50.23.160'),
(1967, 'TERBINAFINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1968, 'Chromium, Zinc, And Multivitamins', 0, 99, 1, '36', '2017-09-25 00:00:48', '157.50.23.160'),
(1969, 'Simethicone, Fennel Oil And Dill Oil', 0, 99, 1, '36', '2017-09-24 23:59:22', '157.50.23.160'),
(1970, 'Dicyclomine (10mg/5ml), Simethicone (40mg/5ml)', 0, 99, 1, '36', '2017-09-24 23:57:09', '157.50.23.160'),
(1971, 'OXYTOCIN', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1973, 'Prednisolone 20mg', 0, 99, 1, '26', '2017-08-25 11:38:06', '49.207.187.48'),
(1974, 'MUPIROCIN ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1975, 'Amino Acids And Vitamins C', 0, 99, 1, '36', '2017-09-24 23:45:42', '157.50.23.160'),
(1976, 'Ferrous Fumarate (Iron), Folic Acid (vitamin B9), And Zinc Sulphate', 0, 99, 1, '26', '2017-08-25 11:35:56', '49.207.187.48'),
(1977, 'Pyridoxine, Thiamine, Vitamin B2', 0, 99, 1, '26', '2017-08-25 21:37:45', '49.207.187.48'),
(1978, 'Orlistat 120mg', 0, 99, 1, '26', '2017-08-25 11:32:40', '49.207.187.48'),
(1979, 'Troxerutin', 0, 99, 1, '26', '2017-08-25 23:07:16', '49.207.187.48'),
(1980, 'PENTAZOCINE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1981, 'CEFUROXIME 250MG', 0, 99, 1, '26', '2017-08-25 11:26:56', '49.207.187.48'),
(1982, 'Acebrophylline 100mg', 0, 99, 1, '26', '2017-08-25 11:30:09', '49.207.187.48'),
(1983, 'Lactitol (10gm), Ispaghula (3.5gm)', 0, 99, 1, '36', '2017-09-24 23:34:55', '157.50.23.160'),
(1984, 'Alpha Lipoic Acid, Chromium, Folic Acid, Inositol, Methylcobalamin, Selenium And Zinc', 0, 99, 0, '26', '2017-08-25 11:20:57', '49.207.187.48'),
(1985, 'Merastin 400mg', 0, 99, 1, '36', '2017-09-24 23:30:46', '157.50.23.160'),
(1986, 'Paracetamol (650mg)', 0, 99, 1, '36', '2017-09-26 16:28:32', '117.221.130.65'),
(1987, 'TRENAXAMIC WITH MEFENAMIC ', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1988, 'SURGICAL', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1989, 'Anti Rh D Immunoglobulin (150mcg)', 0, 99, 1, '36', '2017-09-24 23:25:14', '157.50.23.160'),
(1990, 'Ethinyl Estradiol,Drospirenone', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1992, 'LACTULOSE', 0, 99, 127, '26', '2017-08-23 12:54:00', '2017-08-23 12:54:00'),
(1993, 'Diltiazem (90mg)', 0, 99, 1, '26', '2017-08-25 11:08:12', '49.207.187.48'),
(1994, 'Paracetamol (650mg)', 0, 99, 1, '36', '2017-09-23 20:20:47', '117.201.24.231'),
(1995, 'Aceclofenac (100mg), Paracetamol (325mg), Tramadol (37.5mg)', 0, 99, 1, '36', '2017-09-23 19:00:21', '117.201.24.231'),
(1996, 'Ursodeoxycholic Acid (450mg)', 0, 99, 1, '26', '2017-08-25 22:26:21', '49.207.187.48'),
(1998, 'MyCopo', 0, 100, 1, '33', '2017-09-09 15:09:18', '49.207.177.156'),
(1999, 'Norfloxacin (400mg), Tinidazole (600mg)', 0, 99, 1, '26', '2017-09-09 17:36:01', '49.207.187.48'),
(2000, 'Rifampicin (300mg)', 0, 100, 1, '36', '2017-09-26 21:04:55', '117.201.25.158'),
(2001, 'Tamsulosin (0.4mg)', 0, 12, 1, '36', '2017-09-26 18:21:37', '103.60.74.3'),
(2002, 'Deflazacort (6mg)', 0, 16, 1, '36', '2017-09-26 17:39:43', '117.222.161.67'),
(2004, 'TEST -230', 0, 11, 1, '26', '2017-09-16 12:00:24', '49.207.177.156'),
(2006, 'Ginseng, Aswagandha, Tribulus Terretris, Hygrophlia Spinosa, Mucuna Pruriens', 0, 99, 1, '36', '2017-09-18 19:24:10', '117.249.223.241'),
(2007, 'Copper Sulphate, Magnesium, D-Panthenol, Potassium, Zinc Sulphate, Magnesium', 0, 99, 1, '36', '2017-09-18 21:08:21', '117.249.223.241'),
(2008, 'CARBAMAZEPINE 100MG', 0, 99, 1, '36', '2017-09-18 21:29:48', '117.249.223.241'),
(2009, 'Calcium Chloride, Cyanocobalamin, Iron, Selenium, Folic Acid, L-lysine, Niacinamide, And Pyridoxine', 0, 99, 1, '36', '2017-09-19 08:23:51', '157.50.8.195'),
(2010, 'Vitamins, Minerals, Zinc', 0, 99, 1, '36', '2017-09-19 08:36:44', '157.50.8.195'),
(2011, 'Chloroquine (250mg)', 0, 99, 1, '36', '2017-09-19 08:44:49', '157.50.8.195'),
(2012, 'Betamethasone Topical (0.1% W/w), Neomycin Topical (0.5% W/w)', 0, 99, 1, '36', '2017-09-19 08:53:27', '157.50.8.195'),
(2013, 'Propylphenazone - Propypheanazone - 150 MG, Caffeine - 50 MG, Acetaminophen - 300 MG', 0, 99, 1, '36', '2017-09-19 09:43:36', '157.50.8.195'),
(2014, 'Ethinyl Estradiol (0.035mg), Cyproterone (2mg)', 0, 99, 1, '36', '2017-09-19 13:35:45', '157.50.12.3'),
(2015, 'Methylcobalamin (1000mg), Vitamin B6 (Pyridoxine) (100mg)', 0, 99, 1, '36', '2017-09-19 13:43:21', '157.50.12.3'),
(2016, 'Measles Virus Vaccine (1000ccid50), Mumps Virus Vaccine (5000ccid50), Rubella (German Measles) (1000', 0, 99, 1, '36', '2017-09-19 16:41:12', '157.50.12.3'),
(2017, 'Measles Virus Vaccine (1000ccid50), Mumps Virus Vaccine (5000ccid50), Rubella (German Measles)', 0, 99, 1, '36', '2017-09-19 16:42:27', '157.50.12.3'),
(2021, 'Vitamin A (1000IU), Thiamine(Vitamin B1) (5mg), Vitamin B2 (1.40mg), Vitamin D3 (100IU), Pantothenic', 0, 99, 1, '36', '2017-09-19 17:50:42', '157.50.12.3'),
(2022, 'Phenylephrine (5mg/ml), Chlorpheniramine (2mg/5ml), Dextromethorphan (15mg/5ml)', 0, 99, 1, '36', '2017-09-19 18:28:16', '157.50.12.3'),
(2023, 'Silver Sulfadiazine, Chlorhexidine Gluconate, Aloe Vera', 0, 99, 1, '36', '2017-09-19 22:49:59', '157.50.8.18'),
(2024, 'Vitamin A (1000IU), Thiamine(Vitamin B1) (5mg), Vitamin B2 (1.40mg), Vitamin D3 (100IU), Pantothenic', 0, 99, 1, '36', '2017-09-19 23:06:25', '157.50.8.18'),
(2025, 'Vitamin A (1000IU), Thiamine(Vitamin B1) (5mg), Vitamin B2 (1.40mg), Vitamin D3 (100IU), Pantothenic', 0, 99, 1, '36', '2017-09-19 23:06:25', '157.50.8.18'),
(2026, 'Papain And Alpha-amylase', 0, 99, 1, '36', '2017-09-19 23:28:03', '157.50.8.18'),
(2027, 'Iron, Folic Acid, Lysine Hydrochloride, Cyanocobalamin', 0, 99, 1, '36', '2017-09-19 23:43:05', '157.50.8.18'),
(2028, 'Prednisolone (10mg)', 0, 99, 1, '36', '2017-09-20 05:44:11', '157.50.11.158'),
(2029, 'Deflazacort (30mg)', 0, 99, 1, '36', '2017-09-20 06:24:28', '157.50.11.158'),
(2030, 'Cefotaxime (1gm)', 0, 99, 1, '36', '2017-09-20 07:55:46', '157.50.11.158'),
(2031, 'Theophylline (69mg), Etophylline (231mg)', 0, 99, 1, '36', '2017-09-26 12:14:04', '117.207.101.207'),
(2032, 'Vitamin B2', 0, 99, 1, '36', '2017-09-20 08:09:33', '157.50.11.158'),
(2033, 'Amitriptyline (25mg)', 0, 99, 1, '36', '2017-09-20 08:22:42', '157.50.11.158'),
(2034, 'Pyridoxine 100 Mg', 0, 99, 1, '36', '2017-09-20 08:24:25', '157.50.11.158'),
(2035, 'Guaifenesin (100mg), Terbutaline (2.5mg), Bromhexine (8mg)', 0, 99, 1, '36', '2017-09-20 09:51:30', '157.50.8.144'),
(2036, 'Dicyclomine (10mg), Paracetamol (325mg), Tramadol (50mg)', 0, 99, 1, '36', '2017-09-20 09:55:18', '157.50.8.144'),
(2037, 'Atropine (1%)', 0, 99, 1, '36', '2017-09-20 10:13:49', '157.50.8.207'),
(2038, 'Tetracycline (500mg)', 0, 99, 1, '36', '2017-09-20 10:27:39', '157.50.8.207'),
(2039, 'Sodium Chloride (0.9% W/v)', 0, 99, 1, '36', '2017-09-20 10:37:58', '157.50.8.207'),
(2040, 'Sodium Valproate (200mg)', 0, 99, 1, '36', '2017-09-20 10:48:35', '157.50.8.207'),
(2041, 'Aspirin(ASA) (75mg)', 0, 99, 1, '36', '2017-09-20 10:53:27', '157.50.8.207'),
(2042, 'Cinnarizine (25mg)', 0, 99, 1, '36', '2017-09-20 13:35:49', '157.50.8.207'),
(2043, 'Milk Of Magnesia, Liquid Paraffin', 0, 99, 1, '36', '2017-09-20 14:10:33', '157.50.8.207'),
(2044, 'High Strength Silymarin Along With Select Micronutrients And Antioxidants', 0, 99, 1, '36', '2017-09-20 18:54:56', '157.50.21.122'),
(2045, 'Atenolol (25mg)', 0, 99, 1, '36', '2017-09-20 18:56:13', '157.50.21.122'),
(2046, 'Aspirin(ASA) (150mg)', 0, 99, 1, '36', '2017-09-20 18:57:37', '157.50.21.122'),
(2047, 'Ramipril (5mg)', 0, 99, 1, '36', '2017-09-20 22:35:39', '157.50.12.3'),
(2048, 'Clotrimazole (1%w/v), Selenium (2.5%w/v)', 0, 99, 1, '36', '2017-09-21 09:55:44', '157.50.10.184'),
(2049, 'Zingiber Officinale, Cuminum Cyminum', 0, 99, 1, '36', '2017-09-21 10:11:34', '106.208.179.103'),
(2050, 'Mannitol (20%w/v)', 0, 99, 1, '36', '2017-09-21 10:19:45', '106.208.179.103'),
(2052, 'Noscapine (7mg/5ml), Chlorpheniramine (2mg/5ml), Ammonium Chloride (28mg/5ml), Sodium Citrate (3.25m', 0, 99, 1, '36', '2017-09-21 12:01:01', '106.208.179.103'),
(2053, 'Phenylephrine (5mg), Chlorpheniramine (2mg), Dextromethorphan (15mg)', 0, 99, 1, '36', '2017-09-21 12:06:38', '106.208.179.103'),
(2054, 'Biotin (5mg)', 0, 99, 1, '36', '2017-09-21 12:07:56', '106.208.179.103'),
(2055, 'Chlorpheniramine (2mg), Phenylephrine (5mg), Paracetamol (250mg), Sodium Citrate (60mg)', 0, 99, 1, '36', '2017-09-22 23:27:15', '103.204.29.216'),
(2056, 'Carbamazepine (100mg/5ml)', 0, 99, 1, '36', '2017-09-22 08:08:31', '157.50.13.170'),
(2057, 'Medroxyprogesterone (2.5mg)', 0, 99, 1, '36', '2017-09-22 08:10:35', '157.50.13.170'),
(2058, 'Lidocaine, Hydrocortisone Acetate, Zinc Oxide And Allantoin', 0, 99, 1, '36', '2017-09-22 08:19:50', '157.50.13.170'),
(2059, 'Beclometasone Topical (0.025%), Clotrimazole Topical (1%), Neomycin Topical (0.5%)', 0, 99, 1, '36', '2017-09-22 08:29:25', '157.50.13.170'),
(2060, 'Sodium Chloride (topical) (NA)', 0, 99, 1, '36', '2017-09-22 08:56:38', '157.50.13.170'),
(2061, 'HYDROXYZINE', 0, 99, 1, '36', '2017-09-22 13:05:54', '117.221.128.173'),
(2062, 'Hydroxyzine (10mg)', 0, 99, 1, '36', '2017-09-22 13:31:41', '117.221.128.173'),
(2063, 'Hydroxyzine (10mg)', 0, 99, 1, '36', '2017-09-22 13:25:30', '117.221.128.173'),
(2064, 'Hydroxyzine (10mg)', 0, 99, 1, '36', '2017-09-22 13:25:30', '117.221.128.173'),
(2065, 'Hydroxyzine (10mg)', 0, 99, 1, '36', '2017-09-22 13:31:23', '117.221.128.173'),
(2066, 'Milk Of Magnesia+ Liquid Paraffin', 0, 99, 1, '36', '2017-09-22 13:45:48', '117.221.128.173'),
(2067, 'LEVOFLOXACIN 500MG', 0, 99, 1, '36', '2017-09-22 13:48:56', '117.221.128.173'),
(2068, 'Levofloxacin (500mg)', 0, 99, 1, '36', '2017-09-26 17:06:38', '117.222.161.67'),
(2069, 'Levofloxacin (500mg)', 0, 99, 1, '36', '2017-09-23 19:20:02', '117.201.24.231'),
(2070, 'Ketoconazole Topical (2% W/v)', 0, 99, 1, '36', '2017-09-22 14:34:18', '117.221.128.173'),
(2071, 'Ketoconazole Topical (2% W/v)', 0, 99, 1, '36', '2017-09-22 14:32:04', '117.221.128.173'),
(2072, 'Budesonide (200mg)', 0, 99, 0, '36', '2017-09-22 15:29:11', '117.221.131.112'),
(2073, 'Budesonide (200mg)', 0, 99, 1, '36', '2017-09-22 15:17:53', '117.221.131.112'),
(2074, 'Caraway (Krishnajiraka), Carvone, Limoline, Bishop’s Weed', 0, 99, 1, '36', '2017-09-22 15:30:48', '117.221.131.112'),
(2075, 'L-Leucine(5.6 Mg),L-Isoleucine(12.5 Mg)', 0, 99, 1, '36', '2017-09-22 15:34:22', '117.221.131.112'),
(2076, 'B12', 0, 99, 1, '36', '2017-09-22 15:38:19', '117.221.131.112'),
(2077, 'B12', 0, 99, 1, '36', '2017-09-22 15:38:33', '117.221.131.112'),
(2078, 'B12', 0, 99, 0, '36', '2017-09-22 15:39:04', '117.221.131.112'),
(2079, 'ACICLOVIR', 0, 99, 1, '36', '2017-09-22 16:21:33', '117.221.135.89'),
(2080, 'Indomethacin (75mg)', 0, 99, 1, '36', '2017-09-22 16:33:53', '117.221.135.89'),
(2081, 'Indomethacin (75mg)', 0, 99, 1, '36', '2017-09-22 16:36:48', '117.221.135.89'),
(2082, 'Hiamine Mononitrate, Riboflavin, Nicotinic Acid, Niacinamide, Pyridoxine, Calcium Pantothenate, Foli', 0, 99, 1, '36', '2017-09-22 16:44:28', '117.221.135.89'),
(2083, 'Hiamine Mononitrate, Riboflavin, Nicotinic Acid, Niacinamide, Pyridoxine, Calcium Pantothenate, Foli', 0, 99, 1, '36', '2017-09-22 16:44:50', '117.221.135.89'),
(2084, 'Selenium Sulphide (2.5% W/v), Selenium (2.5%)', 0, 99, 1, '36', '2017-09-22 16:50:09', '117.221.135.89'),
(2085, 'Selenium Sulphide (2.5% W/v), Selenium (2.5%)', 0, 99, 1, '36', '2017-09-22 16:50:32', '117.221.135.89'),
(2086, 'Citric Acid (334mg), Potassium Citrate (1100mg)', 0, 99, 1, '36', '2017-09-22 17:00:14', '117.221.135.89'),
(2087, 'Citric Acid (334mg), Potassium Citrate (1100mg)', 0, 99, 1, '36', '2017-09-22 17:00:34', '117.221.135.89'),
(2088, 'Citric Acid (334mg), Potassium Citrate (1100mg)', 0, 99, 1, '36', '2017-09-22 17:04:24', '117.221.135.89'),
(2089, 'Iron, Folic Acid And Methylcobalamin.', 0, 99, 1, '36', '2017-09-22 17:21:23', '117.221.135.89'),
(2090, 'CALCIUM IRON VITAMINS SUPPLEMENT', 0, 99, 1, '36', '2017-09-22 17:28:11', '117.221.135.89'),
(2091, 'CALCIUM IRON VITAMINS SUPPLEMENT', 0, 99, 1, '36', '2017-09-22 17:28:28', '117.221.135.89'),
(2092, 'Calcium Iron Vitamins Supplement', 0, 99, 1, '36', '2017-09-22 17:30:32', '117.221.135.89'),
(2093, 'Multivitamin', 0, 99, 1, '36', '2017-09-22 17:35:07', '117.221.135.89'),
(2094, 'Multivitamin', 0, 99, 1, '36', '2017-09-22 17:35:20', '117.221.135.89'),
(2095, 'Tretinoin Topical (0.05% W/w)', 0, 99, 1, '36', '2017-09-22 17:42:45', '117.221.135.89'),
(2096, 'Pheniramine (22.75mg)', 0, 99, 1, '36', '2017-09-22 17:46:54', '117.221.135.89'),
(2097, 'Pheniramine (22.75mg)', 0, 99, 1, '36', '2017-09-22 17:47:16', '117.221.135.89'),
(2098, 'Quath Processed Oil', 0, 99, 1, '36', '2017-09-22 18:09:18', '117.221.135.89'),
(2099, 'Permethrin (5% W/v)', 0, 99, 1, '36', '2017-09-22 18:13:09', '117.221.135.89'),
(2100, 'Metronidazole Topical (2%)', 0, 99, 1, '36', '2017-09-22 18:25:12', '117.221.135.89'),
(2101, 'Lidocaine Topical (3% W/w), Calcium Dobesilate Topical (0.25% W/w), Hydrocortisone Topical (0.25% W/', 0, 99, 1, '36', '2017-09-22 18:29:16', '117.221.135.89'),
(2102, 'Lidocaine Topical (3% W/w), Calcium Dobesilate Topical (0.25% W/w), Hydrocortisone Topical (0.25% W/', 0, 99, 1, '36', '2017-09-22 18:29:35', '117.221.135.89'),
(2103, 'Lidocaine Topical (3% W/w), Calcium Dobesilate Topical (0.25% W/w), Hydrocortisone Topical (0.25% W/', 0, 99, 1, '36', '2017-09-22 18:30:06', '117.221.135.89'),
(2104, 'Lidocaine Topical, Calcium Dobesilate Topical , Hydrocortisone Topical', 0, 99, 1, '36', '2017-09-22 18:31:08', '117.221.135.89'),
(2105, 'Lidocaine,hydrocortisone Acetate,zinc-mg', 0, 99, 1, '36', '2017-09-22 18:33:14', '117.221.135.89'),
(2106, 'Fusidic Acid (topical) (2%)', 0, 99, 1, '36', '2017-09-22 18:40:02', '117.221.135.89'),
(2107, 'Calamine, Aloe Vera And Light Liquid Paraffin', 0, 99, 1, '36', '2017-09-22 19:03:43', '117.201.30.250'),
(2108, 'Mefenamic Acid (100mg/5ml)', 0, 99, 1, '36', '2017-09-22 19:08:52', '117.201.30.250'),
(2109, 'Pyridoxine', 0, 99, 1, '36', '2017-09-23 00:31:42', '117.201.17.250'),
(2110, 'Pyridoxine', 0, 99, 1, '36', '2017-09-22 19:12:07', '117.201.30.250'),
(2111, 'Pyridoxine', 0, 99, 1, '36', '2017-09-22 19:14:38', '117.201.30.250'),
(2112, 'Pyridoxine', 0, 99, 1, '36', '2017-09-22 19:22:20', '117.201.30.250'),
(2113, 'Pyridoxine', 0, 99, 1, '36', '2017-09-22 19:22:35', '117.201.30.250'),
(2114, 'Streptomycin (1gm)', 0, 99, 1, '36', '2017-09-22 19:25:49', '117.201.30.250'),
(2115, 'Protein, Carbohydrate, Multivitamin And Minerals', 0, 99, 1, '36', '2017-09-22 19:34:49', '117.201.30.250'),
(2116, 'Piracetam (500mg/5ml)', 0, 99, 1, '36', '2017-09-22 19:37:33', '117.201.30.250'),
(2117, 'Piracetam (500mg/5ml)', 0, 99, 1, '36', '2017-09-22 19:37:55', '117.201.30.250'),
(2118, 'Diazepam (10mg)', 0, 99, 1, '36', '2017-09-22 19:54:51', '103.204.29.216'),
(2119, 'Trifluoperazine (5mg)', 0, 99, 1, '36', '2017-09-22 19:54:38', '103.204.29.216'),
(2120, 'Erythromycin (125mg)', 0, 99, 1, '36', '2017-09-22 19:59:44', '103.204.29.216'),
(2121, 'Vitamin E', 0, 99, 1, '36', '2017-09-22 20:11:36', '103.204.29.216'),
(2122, 'Vitamin E', 0, 99, 1, '36', '2017-09-22 20:12:50', '103.204.29.216'),
(2123, 'Salbutamol (4mg)', 0, 99, 1, '36', '2017-09-22 20:17:42', '103.204.29.216'),
(2124, 'Sildenafil (50mg)', 0, 99, 1, '36', '2017-09-22 20:23:48', '103.204.29.216'),
(2125, 'Sildenafil (25mg)', 0, 99, 1, '36', '2017-09-26 13:42:40', '117.207.101.207'),
(2126, 'Betamethasone (1mg)', 0, 99, 1, '36', '2017-09-22 20:30:22', '103.204.29.216'),
(2127, 'Betamethasone (0.5mg)', 0, 99, 1, '36', '2017-09-22 20:30:51', '103.204.29.216'),
(2128, 'Ambroxol (30mg), Levosalbutamol (1mg), Guaifenesin (50mg)', 0, 99, 1, '36', '2017-09-22 22:38:09', '103.204.29.216'),
(2129, 'Cinnarizine (75mg)', 0, 99, 1, '36', '2017-09-23 20:42:02', '117.201.24.231'),
(2130, 'Erythromycin (250mg)', 0, 99, 1, '36', '2017-09-22 21:04:49', '103.204.29.216'),
(2131, 'Oxymetazoline Hydrochloride', 0, 99, 1, '36', '2017-09-22 21:29:22', '103.204.29.216'),
(2132, 'Oxymetazoline Hydrochloride', 0, 99, 1, '36', '2017-09-22 21:29:44', '103.204.29.216'),
(2133, 'Oxymetazoline Hydrochloride', 0, 99, 1, '36', '2017-09-22 21:30:17', '103.204.29.216'),
(2134, 'Phenazopyridine 200MG', 0, 99, 1, '36', '2017-09-22 21:35:51', '103.204.29.216'),
(2135, 'Phenylephrine (5mg), Chlorpheniramine (2mg), Dextromethorphan (10mg)', 0, 99, 1, '36', '2017-09-22 21:43:58', '103.204.29.216'),
(2136, 'Wintergreen Oil, Mint Flowers', 0, 99, 1, '36', '2017-09-22 22:03:00', '103.204.29.216'),
(2137, 'Labetalol (100mg)', 0, 99, 1, '36', '2017-09-22 22:12:09', '103.204.29.216'),
(2138, 'Furosemide (20mg), Spironolactone (50mg)', 0, 99, 1, '36', '2017-09-22 22:16:50', '103.204.29.216'),
(2139, 'Ofloxacin (300mg)', 0, 99, 1, '36', '2017-09-22 22:23:48', '103.204.29.216'),
(2140, 'Aspirin(ASA) (350mg)', 0, 99, 1, '36', '2017-09-22 22:31:40', '103.204.29.216'),
(2141, 'Noscapine (7mg/5ml), Chlorpheniramine (2mg/5ml), Ammonium Chloride (28mg/5ml), Sodium Citrate (3.25m', 0, 99, 1, '36', '2017-09-22 22:47:01', '103.204.29.216'),
(2142, 'Noscapine (7mg/5ml), Chlorpheniramine (2mg/5ml), Ammonium Chloride (28mg/5ml), Sodium Citrate (3.25m', 0, 99, 1, '36', '2017-09-22 22:47:32', '103.204.29.216'),
(2143, 'Noscapine (7mg/5ml), Chlorpheniramine (2mg/5ml), Ammonium Chloride (28mg/5ml), Sodium Citrate (3.25m', 0, 99, 1, '36', '2017-09-22 22:48:32', '103.204.29.216'),
(2144, 'Ammonium Chloride (7mg/5ml), Noscapine (1.83mg/5ml), Sodium Citrate (0.67mg/5ml)', 0, 99, 1, '36', '2017-09-22 22:54:55', '103.204.29.216'),
(2145, 'Chlorpheniramine (2mg), Paracetamol (500mg), Phenylephrine (10mg)', 0, 99, 1, '36', '2017-09-22 23:34:21', '103.204.29.216'),
(2146, 'Benzyl Nicotinate Topical (2mg), Heparin Topical (50IU)', 0, 99, 1, '36', '2017-09-22 23:59:19', '103.204.29.216'),
(2147, 'Fluconazole (150mg)', 0, 99, 1, '36', '2017-09-23 00:05:45', '103.204.29.216'),
(2148, 'Famotidine (40mg)', 0, 99, 1, '36', '2017-09-23 00:11:14', '103.204.29.216'),
(2149, 'Famotidine (40mg)', 0, 99, 1, '36', '2017-09-23 00:11:31', '103.204.29.216'),
(2150, 'Oxetacaine (10mg), Aluminium Hydroxide (291mg), Milk Of Magnesia (98mg)', 0, 99, 1, '36', '2017-09-23 00:25:58', '117.201.17.250'),
(2151, 'Pyridoxine', 0, 99, 1, '36', '2017-09-23 00:31:23', '117.201.17.250'),
(2152, 'Paracetamol (250mg), Caffeine (50mg), Phenazone (150mg)', 0, 99, 1, '36', '2017-09-23 00:35:57', '117.201.17.250'),
(2153, 'Silver Nitrate', 0, 99, 1, '36', '2017-09-23 00:41:50', '117.201.17.250');
INSERT INTO `composition` (`composition_id`, `composition_name`, `agestart`, `age_end`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(2154, 'Calcium Chloride, Cyanocobalamin, Iron, Selenium, Folic Acid, L-lysine, Niacinamide, And Pyridoxine', 0, 99, 1, '36', '2017-09-25 13:38:35', '157.50.22.165'),
(2155, 'Atropine (0.6mg)', 0, 99, 1, '36', '2017-09-23 08:29:00', '59.93.9.243'),
(2156, 'Diltiazem Topical (2%)', 0, 99, 1, '36', '2017-09-23 08:35:02', '59.93.9.243'),
(2157, 'Itraconazole (100mg)', 0, 99, 1, '36', '2017-09-23 08:43:56', '59.93.9.243'),
(2158, 'Dydrogesterone (10mg)', 0, 99, 1, '36', '2017-09-23 08:48:15', '59.93.9.243'),
(2159, 'Quinine (100mg)', 0, 99, 1, '36', '2017-09-23 08:50:56', '59.93.9.243'),
(2160, 'Acetazolamide (250mg)', 0, 99, 1, '36', '2017-09-23 08:53:29', '59.93.9.243'),
(2161, 'Human Chorionic Gonadotropin (hCG) (10000IU)', 0, 99, 1, '36', '2017-09-23 08:56:35', '59.93.9.243'),
(2162, 'Doxofylline (400mg)', 0, 99, 1, '36', '2017-09-26 11:10:21', '117.207.101.207'),
(2163, 'Atenolol (50mg)', 0, 99, 1, '36', '2017-09-23 16:16:51', '117.222.161.88'),
(2164, 'Famciclovir (250mg)', 0, 99, 1, '36', '2017-09-23 16:19:05', '117.222.161.88'),
(2165, 'Glimepiride (2mg), Metformin (500mg)', 0, 99, 1, '36', '2017-09-23 16:24:15', '117.222.161.88'),
(2166, 'Salmeterol (50mcg), Fluticasone (100mcg)', 0, 99, 1, '36', '2017-09-23 16:32:39', '117.222.161.88'),
(2167, 'Pyrazinamide (750mg)', 0, 99, 1, '36', '2017-09-23 16:36:41', '117.222.161.88'),
(2168, 'Beclometasone Topical (0.025% W/w), Clotrimazole Topical (1% W/w), Neomycin Topical (0.5% W/w)', 0, 99, 1, '36', '2017-09-23 16:55:08', '117.222.161.88'),
(2169, 'Mometasone Topical (0.1% W/w)', 0, 99, 1, '36', '2017-09-23 16:57:47', '117.222.161.88'),
(2170, 'Faropenem (300mg)', 0, 99, 1, '36', '2017-09-23 17:12:58', '117.201.19.147'),
(2171, 'Domperidone (10mg), Pantoprazole (20mg)', 0, 99, 1, '36', '2017-09-23 17:16:34', '117.221.131.116'),
(2172, 'Ambroxol (75mg), Levocetirizine (5mg), Montelukast (10mg)', 0, 99, 1, '36', '2017-09-23 17:19:00', '117.221.131.116'),
(2173, 'Methylcobalamin (750mcg), Pregabalin (75mg)', 0, 99, 1, '36', '2017-09-23 17:27:48', '117.221.131.116'),
(2174, 'Methylcobalamin (750mcg), Pregabalin (75mg)', 0, 99, 1, '36', '2017-09-23 17:28:40', '117.221.131.116'),
(2175, 'Methylcobalamin (750mcg), Pregabalin (75mg)', 0, 99, 1, '36', '2017-09-23 17:29:04', '117.221.131.116'),
(2176, 'Methylcobalamin (750mcg), Pregabalin (75mg)', 0, 99, 1, '36', '2017-09-23 17:29:47', '117.221.131.116'),
(2177, 'Pyrazinamide (500mg)', 0, 99, 1, '36', '2017-09-23 17:34:00', '117.221.131.116'),
(2178, 'Estradiol (2mg)', 0, 99, 1, '36', '2017-09-23 17:53:13', '117.201.28.84'),
(2179, 'Levetiracetam (250mg)', 0, 99, 1, '36', '2017-09-23 18:01:55', '117.201.28.84'),
(2180, 'Esomeprazole (20mg)', 0, 99, 1, '36', '2017-09-23 18:09:14', '117.201.28.84'),
(2181, 'Isosorbide Mononitrate (30mg)', 0, 99, 1, '36', '2017-09-23 18:20:47', '117.201.28.84'),
(2182, 'Escitalopram (5mg)', 0, 99, 1, '36', '2017-09-23 18:24:32', '117.201.28.84'),
(2183, 'Metformin (500mg)', 0, 99, 1, '36', '2017-09-25 23:48:52', '117.201.30.118'),
(2184, 'Progesterone (Natural Micronized) (200mg)', 0, 99, 1, '36', '2017-09-26 00:50:32', '117.201.28.157'),
(2185, 'Paracetamol (250mg)', 0, 99, 1, '36', '2017-09-23 18:49:12', '117.201.24.231'),
(2186, 'Silymarin (70mg)', 0, 99, 1, '36', '2017-09-23 18:54:33', '117.201.24.231'),
(2187, 'Silymarin (70mg)', 0, 99, 1, '36', '2017-09-23 18:55:03', '117.201.24.231'),
(2188, 'Teneligliptin (20mg)', 0, 99, 1, '36', '2017-09-26 11:43:44', '117.207.101.207'),
(2189, 'Hemocoagulase (1christensenunits)', 0, 99, 1, '36', '2017-09-23 19:17:49', '117.201.24.231'),
(2190, 'Chloramphenicol Topical (1% W/w)', 0, 99, 1, '36', '2017-09-23 19:24:37', '117.201.24.231'),
(2191, 'Azithromycin (500mg)', 0, 99, 1, '36', '2017-09-23 19:40:27', '117.201.24.231'),
(2192, 'Sodium Chloride (topical) (0.65% W/v)', 0, 99, 1, '36', '2017-09-23 19:46:45', '117.201.24.231'),
(2193, 'Labetalol (NA)', 0, 99, 1, '36', '2017-09-23 19:53:37', '117.201.24.231'),
(2194, 'Isosorbide Mononitrate (60mg)', 0, 99, 1, '36', '2017-09-23 20:07:14', '117.201.24.231'),
(2195, 'Progesterone (Natural Micronized) (300mg)', 0, 99, 1, '36', '2017-09-24 13:53:47', '117.207.109.148'),
(2196, 'Progesterone (100mg/ml)', 0, 99, 1, '36', '2017-09-26 13:12:22', '117.207.101.207'),
(2197, 'Dextrose (25%)', 0, 99, 1, '36', '2017-09-23 20:29:43', '117.201.24.231'),
(2198, 'Ambroxol (30mg/5ml)', 0, 99, 1, '36', '2017-09-23 20:35:56', '117.201.24.231'),
(2199, 'Domperidone (20mg), Paracetamol (500mg)', 0, 99, 1, '36', '2017-09-23 20:38:25', '117.201.24.231'),
(2200, 'Domperidone (20mg), Paracetamol (500mg)', 0, 99, 1, '36', '2017-09-23 20:38:48', '117.201.24.231'),
(2201, 'Domperidone (20mg), Paracetamol (500mg)', 0, 99, 1, '36', '2017-09-23 20:39:42', '117.201.24.231'),
(2202, 'Cefoperazone (1000mg), Sulbactam (500mg)', 0, 99, 1, '36', '2017-09-23 20:46:57', '117.201.24.231'),
(2203, 'Pheniramine (25mg)', 0, 99, 1, '36', '2017-09-23 20:51:07', '117.201.24.231'),
(2204, 'Primaquine (2.5mg)', 0, 99, 1, '36', '2017-09-25 23:53:51', '117.201.30.118'),
(2205, 'Amoxicillin (250mg), Bromhexine (8mg)', 0, 99, 1, '36', '2017-09-23 21:01:17', '117.201.24.231'),
(2206, 'Phenobarbitone (60mg)', 0, 99, 1, '36', '2017-09-26 17:38:03', '117.222.161.67'),
(2207, 'Amoxicillin (1000mg), Clavulanic Acid (200mg)', 0, 99, 1, '36', '2017-09-23 21:11:57', '117.201.24.231'),
(2208, 'Methylprednisolone (40mg/ml)', 0, 99, 1, '36', '2017-09-23 21:16:06', '117.201.24.231'),
(2209, 'Levo-carnitine (500mg), Methylcobalamin (1500mcg), Folic Acid (1.5mg)', 0, 99, 1, '36', '2017-09-23 21:54:41', '117.201.24.231'),
(2210, 'Telmisartan (40mg), Chlorthalidone (12.5mg)', 0, 99, 1, '36', '2017-09-23 22:08:15', '117.201.24.231'),
(2211, 'Amoxicillin (500mg), Clavulanic Acid (125mg)', 0, 99, 1, '36', '2017-09-23 22:16:43', '117.201.24.231'),
(2212, 'Amoxicillin (500mg), Clavulanic Acid (125mg)', 0, 99, 1, '36', '2017-09-23 22:17:06', '117.201.24.231'),
(2213, 'Amantadine (100mg)', 0, 99, 1, '36', '2017-09-23 22:23:48', '117.201.24.231'),
(2214, 'Atorvastatin (10mg)', 0, 99, 1, '36', '2017-09-23 22:29:40', '117.201.24.231'),
(2215, 'Levodopa (100mg), Carbidopa (10mg)', 0, 99, 1, '36', '2017-09-23 22:40:11', '117.201.24.231'),
(2216, 'Clindamycin Topical (1% W/v)', 0, 99, 1, '36', '2017-09-23 22:52:35', '117.201.24.231'),
(2217, 'Metoprolol (12.5mg)', 0, 99, 1, '36', '2017-09-26 11:56:51', '117.207.101.207'),
(2218, 'Metoprolol (12.5mg)', 0, 99, 1, '36', '2017-09-23 22:57:21', '117.201.24.231'),
(2219, 'Lidocaine (2%)', 0, 99, 1, '36', '2017-09-26 17:00:35', '117.222.161.67'),
(2220, 'Piperacillin (1000mg), Tazobactum (125mg)', 0, 99, 1, '36', '2017-09-23 23:09:13', '117.201.24.231'),
(2221, 'Domperidone (10mg), Pantoprazole (20mg)', 0, 99, 1, '36', '2017-09-23 23:13:05', '117.201.24.231'),
(2222, 'Clarithromycin (500mg)', 0, 99, 1, '36', '2017-09-23 23:15:26', '117.201.24.231'),
(2223, 'Dicyclomine (10mg), Mefenamic Acid (250mg)', 0, 99, 1, '36', '2017-09-23 23:18:27', '117.201.24.231'),
(2224, 'Dicyclomine (10mg), Mefenamic Acid (250mg)', 0, 99, 1, '36', '2017-09-23 23:18:50', '117.201.24.231'),
(2225, 'Dicyclomine (10mg), Mefenamic Acid (250mg)', 0, 99, 1, '36', '2017-09-23 23:19:23', '117.201.24.231'),
(2226, 'Dicyclomine (10mg), Mefenamic Acid (250mg)', 0, 99, 1, '36', '2017-09-23 23:20:01', '117.201.24.231'),
(2227, 'Dicyclomine (10mg), Mefenamic Acid (250mg)', 0, 99, 1, '36', '2017-09-23 23:21:43', '117.201.24.231'),
(2228, 'Dicyclomine (10mg), Mefenamic Acid (250mg)', 0, 99, 1, '36', '2017-09-23 23:22:06', '117.201.24.231'),
(2229, 'Dicyclomine (10mg), Mefenamic Acid (250mg)', 0, 99, 1, '36', '2017-09-23 23:25:59', '117.201.24.231'),
(2230, 'Dicyclomine (10mg), Mefenamic Acid (250mg)', 0, 99, 1, '36', '2017-09-23 23:33:05', '117.201.24.231'),
(2231, 'Dicyclomine (10mg), Mefenamic Acid (250mg)', 0, 99, 1, '36', '2017-09-23 23:34:18', '117.201.24.231'),
(2232, 'Hyoscine (10mg)', 0, 99, 1, '36', '2017-09-26 11:11:55', '117.207.101.207'),
(2233, 'Hyoscine (10mg)', 0, 99, 1, '36', '2017-09-23 23:37:40', '117.201.24.231'),
(2234, 'Dicyclomine (10mg), Mefenamic Acid (250mg)', 0, 99, 1, '36', '2017-09-23 23:41:54', '117.201.24.231'),
(2235, 'Dicyclomine (10mg), Mefenamic Acid (250mg)', 0, 99, 1, '36', '2017-09-23 23:43:02', '117.201.24.231'),
(2236, 'Etodolac (400mg), Thiocolchicoside (4mg)', 0, 99, 1, '36', '2017-09-23 23:45:05', '117.201.24.231'),
(2237, 'Diphtheria Toxoid (30IU), Haemophilus B Conjugate Vaccine (10mcg), Pertussis Toxoid (4IU), Tetanus T', 0, 99, 1, '36', '2017-09-24 00:01:51', '117.201.24.231'),
(2238, 'Diphtheria Toxoid (30IU), Haemophilus B Conjugate Vaccine (10mcg), Pertussis Toxoid (4IU), Tetanus T', 0, 99, 1, '36', '2017-09-24 00:02:40', '117.201.24.231'),
(2239, 'Diphtheria Toxoid (30IU), Haemophilus B Conjugate Vaccine (10mcg), Pertussis Toxoid (4IU), Tetanus T', 0, 99, 1, '36', '2017-09-24 00:03:18', '117.201.24.231'),
(2240, 'Diphtheria Toxoid (30IU), Haemophilus B Conjugate Vaccine (10mcg), Pertussis Toxoid (4IU), Tetanus T', 0, 99, 1, '36', '2017-09-24 00:04:03', '117.201.24.231'),
(2241, 'Diphtheria Toxoid (30IU), Haemophilus B Conjugate Vaccine (10mcg), Pertussis Toxoid (4IU), Tetanus T', 0, 99, 1, '36', '2017-09-24 00:04:20', '117.201.24.231'),
(2242, 'Diphtheria Toxoid (30IU), Haemophilus B Conjugate Vaccine (10mcg), Pertussis Toxoid (4IU), Tetanus T', 0, 99, 1, '36', '2017-09-24 00:05:57', '117.201.24.231'),
(2243, 'Diphtheria Toxoid (30IU), Haemophilus B Conjugate Vaccine (10mcg), Pertussis Toxoid (4IU), Tetanus T', 0, 99, 1, '36', '2017-09-24 00:06:23', '117.201.24.231'),
(2244, 'Diphtheria Toxoid (30IU), Haemophilus B Conjugate Vaccine (10mcg), Pertussis Toxoid (4IU), Tetanus T', 0, 99, 1, '36', '2017-09-24 00:07:10', '117.201.24.231'),
(2245, 'Ticagrelor (90mg)', 0, 99, 1, '36', '2017-09-24 00:09:49', '117.201.24.231'),
(2246, 'Ticagrelor (90mg)', 0, 99, 1, '36', '2017-09-24 00:09:44', '117.201.24.231'),
(2247, 'Telmisartan (40mg), Amlodipine (5mg)', 0, 99, 1, '36', '2017-09-26 13:26:20', '117.207.101.207'),
(2248, 'Doxofylline (400mg), Ambroxol (30mg)', 0, 99, 1, '36', '2017-09-24 00:17:31', '117.201.24.231'),
(2249, 'Paracetamol (NA)', 0, 99, 1, '36', '2017-09-24 00:22:09', '117.201.24.231'),
(2250, 'Levofloxacin (500mg), Azithromycin (500mg)', 0, 99, 1, '36', '2017-09-24 00:25:55', '117.201.24.231'),
(2251, 'Artemether (80mg), Lumefantrine (480mg)', 0, 99, 1, '36', '2017-09-24 00:28:39', '117.201.24.231'),
(2252, 'Artemether (80mg), Lumefantrine (480mg)', 0, 99, 1, '36', '2017-09-24 00:32:27', '117.201.24.231'),
(2253, 'Ofloxacin Topical (0.3% W/v)', 0, 99, 1, '36', '2017-09-24 00:45:03', '117.201.24.231'),
(2254, 'Dexamethasone (0.5mg)', 0, 99, 1, '36', '2017-09-24 00:51:28', '117.201.24.231'),
(2255, 'Sodium Valproate (200mg), Valproic Acid (87mg)', 0, 99, 1, '36', '2017-09-24 00:57:08', '117.201.24.231'),
(2256, 'Isosorbide Dinitrate (10mg)', 0, 99, 1, '36', '2017-09-24 01:01:49', '117.201.24.231'),
(2257, 'Omeprazole (20mg)', 0, 99, 1, '36', '2017-09-24 01:05:18', '117.201.24.231'),
(2258, 'Artesunate (100mg), Sulfadoxine (500mg), Pyrimethamine (25mg)', 0, 99, 1, '36', '2017-09-24 01:38:04', '117.201.24.231'),
(2259, 'Roxithromycin (25mg)', 0, 99, 1, '36', '2017-09-24 02:11:21', '117.201.24.231'),
(2260, 'Mifepristone (NA), Misoprostol (NA)', 0, 99, 1, '36', '2017-09-24 02:29:48', '117.201.24.231'),
(2261, 'Mifepristone (NA), Misoprostol (NA)', 0, 99, 1, '36', '2017-09-24 02:31:12', '117.201.24.231'),
(2262, 'Primaquine (7.5mg)', 0, 99, 1, '36', '2017-09-24 02:35:24', '117.201.24.231'),
(2263, 'Phenytoin (50mg)', 0, 99, 1, '36', '2017-09-24 02:51:33', '117.201.24.231'),
(2264, 'L-Lysine (22.3mg), L-Threonine (5.4mg), L-Isoleucine (5.5mg), L-Methionine (7.1mg), L-Histidine Hydr', 0, 99, 1, '36', '2017-09-24 03:19:44', '117.201.24.231'),
(2265, 'L-Lysine (22.3mg), L-Threonine (5.4mg), L-Isoleucine (5.5mg), L-Methionine (7.1mg), L-Histidine Hydr', 0, 99, 1, '36', '2017-09-24 03:20:06', '117.201.24.231'),
(2266, 'L-Lysine (22.3mg), L-Threonine (5.4mg), L-Isoleucine (5.5mg), L-Methionine (7.1mg), L-Histidine Hydr', 0, 99, 1, '36', '2017-09-24 03:21:24', '117.201.24.231'),
(2267, 'Chlorpromazine (50mg)', 0, 99, 1, '36', '2017-09-25 22:54:12', '117.201.30.118'),
(2268, 'Propranolol (40mg)', 0, 99, 1, '36', '2017-09-24 03:25:50', '117.201.24.231'),
(2269, 'Atorvastatin (10mg), Fenofibrate (160mg)', 0, 99, 1, '36', '2017-09-24 03:38:04', '117.201.24.231'),
(2270, 'Guaifenesin (50mg/5ml), Bromhexine (4mg/5ml), Diphenhydramine (8mg/5ml), Ammonium Chloride (100mg/5m', 0, 99, 1, '36', '2017-09-24 03:56:10', '117.201.24.231'),
(2271, 'Domperidone (30mg), Esomeprazole (40mg)', 0, 99, 1, '36', '2017-09-24 11:05:42', '117.207.109.148'),
(2272, 'Ketamine (50mg)', 0, 99, 1, '36', '2017-09-24 11:12:02', '117.207.109.148'),
(2273, 'Telmisartan (20mg)', 0, 99, 1, '36', '2017-09-24 11:38:58', '117.207.109.148'),
(2274, 'Povidone Iodine (2% W/v)', 0, 99, 1, '36', '2017-09-24 11:55:56', '117.207.109.148'),
(2275, 'Furosemide (10mg/1ml)', 0, 99, 1, '36', '2017-09-24 11:59:00', '117.207.109.148'),
(2276, 'Midazolam (1mg)', 0, 99, 1, '36', '2017-09-24 12:06:14', '117.207.109.148'),
(2277, 'Artesunate (120mg)', 0, 99, 1, '36', '2017-09-24 12:35:16', '117.207.109.148'),
(2278, 'Theophylline (23mg), Etophylline (77mg)', 0, 99, 1, '36', '2017-09-24 12:58:29', '117.207.109.148'),
(2279, 'Spironolactone (25mg), Torasemide (20mg)', 0, 99, 1, '36', '2017-09-24 13:11:47', '117.207.109.148'),
(2280, 'Spironolactone (25mg), Torasemide (10mg)', 0, 99, 1, '36', '2017-09-24 13:14:14', '117.207.109.148'),
(2281, 'Rifaximin (400mg)', 0, 99, 1, '36', '2017-09-26 00:23:42', '117.201.28.157'),
(2282, 'Rifaximin (200mg)', 0, 99, 1, '36', '2017-09-24 13:17:49', '117.207.109.148'),
(2283, 'Salmeterol (25mcg), Fluticasone (125mcg)', 0, 99, 1, '36', '2017-09-24 13:40:08', '117.207.109.148'),
(2284, 'Salmeterol (25mcg), Fluticasone (125mcg)', 0, 99, 1, '36', '2017-09-24 13:40:31', '117.207.109.148'),
(2285, 'Salmeterol (25mcg), Fluticasone (125mcg)', 0, 99, 1, '36', '2017-09-24 13:40:57', '117.207.109.148'),
(2286, 'Doxylamine (10mg), Vitamin B6 (Pyridoxine) (10mg), Folic Acid (2.5mg)', 0, 99, 1, '36', '2017-09-24 13:48:31', '117.207.109.148'),
(2287, 'Aceclofenac (100mg), Thiocolchicoside (4mg)', 0, 99, 1, '36', '2017-09-24 13:52:48', '117.207.109.148'),
(2288, 'Aceclofenac (100mg), Thiocolchicoside (4mg)', 0, 99, 1, '36', '2017-09-24 13:53:03', '117.207.109.148'),
(2289, 'Sodium Picosulfate (10mg)', 0, 99, 1, '36', '2017-09-24 13:56:10', '117.207.109.148'),
(2290, 'Clotrimazole (100mg)', 0, 99, 1, '36', '2017-09-24 14:00:43', '117.207.109.148'),
(2291, 'Fluticasone (0.055% W/w)', 0, 99, 1, '36', '2017-09-24 14:04:50', '117.207.109.148'),
(2292, 'Acetylcysteine (600mg)', 0, 99, 1, '36', '2017-09-24 14:15:17', '117.207.109.148'),
(2293, 'Aceclofenac (100mg), Tizanidine (2mg)', 0, 99, 1, '36', '2017-09-24 14:29:26', '117.207.109.148'),
(2294, 'Aceclofenac (100mg), Tizanidine (2mg)', 0, 99, 1, '36', '2017-09-24 14:29:45', '117.207.109.148'),
(2295, 'Neostigmine (2.5mg)', 0, 99, 1, '36', '2017-09-24 18:48:26', '117.207.103.145'),
(2296, 'Olmesartan (20mg)', 0, 99, 1, '36', '2017-09-24 19:04:19', '117.201.27.215'),
(2297, 'Mefenamic Acid (100mg), Paracetamol (250mg)', 0, 99, 1, '36', '2017-09-24 19:17:44', '117.201.27.215'),
(2298, 'Theophylline (35mg), Etophylline (115mg)', 0, 99, 1, '36', '2017-09-24 19:50:31', '117.201.27.215'),
(2299, 'Paracetamol (500mg)', 0, 99, 1, '36', '2017-09-24 20:32:54', '117.201.27.215'),
(2300, 'Vitamin E And Almond Oil', 0, 99, 1, '36', '2017-09-24 23:18:54', '157.50.23.160'),
(2301, 'Tranexamic Acid 500mg, Mefenamic Acid 250 Mg', 0, 99, 1, '36', '2017-09-24 23:27:02', '157.50.23.160'),
(2302, 'Alpha Lipoic Acid, Chromium, Folic Acid, Inositol, Methylcobalamin, Selenium And Zinc', 0, 99, 1, '36', '2017-09-24 23:32:58', '157.50.23.160'),
(2303, 'Troxerutin (NA)', 0, 99, 1, '36', '2017-09-24 23:40:05', '157.50.23.160'),
(2304, 'Orlistat (60mg)', 0, 99, 1, '36', '2017-09-24 23:41:44', '157.50.23.160'),
(2305, 'Mupirocin (2% W/w)', 0, 99, 1, '36', '2017-09-24 23:48:00', '157.50.23.160'),
(2306, 'Acebrophylline (100mg)', 0, 99, 1, '36', '2017-09-24 23:55:16', '157.50.23.160'),
(2307, 'Piperacillin (4000mg), Tazobactum (500mg)', 0, 99, 1, '36', '2017-09-26 00:32:10', '117.201.28.157'),
(2308, 'Methyl Salicylate, Menthol, Camphor, Eucalyptus Oil And Capsaicin', 0, 99, 1, '36', '2017-09-25 00:08:37', '157.50.23.160'),
(2309, 'Streptococcus Faecalis, Lactobacillus, Clostridium Butyricum, Bacillus Mesentericus', 0, 99, 1, '36', '2017-09-25 00:16:54', '157.50.23.160'),
(2310, 'Allantoin (0.2% W/w), Clotrimazole Topical (1% W/w)', 0, 99, 1, '36', '2017-09-25 00:21:50', '157.50.23.160'),
(2311, 'Telmisartan (40mg), Hydrochlorothiazide (12.5mg)', 0, 99, 1, '36', '2017-09-25 21:28:56', '117.201.31.100'),
(2312, 'Lactose Monohydrate: 15mg, Sunset Yellow FCF (E110): 0.34mg', 0, 99, 1, '36', '2017-09-25 14:14:28', '157.50.22.165'),
(2313, 'Mebendazole (100mg)', 0, 99, 1, '36', '2017-09-25 20:26:45', '117.207.97.104'),
(2314, 'Glimepiride (2mg), Metformin (500mg), Voglibose (0.2mg)', 0, 99, 1, '36', '2017-09-25 21:54:30', '117.201.31.100'),
(2315, 'Glimepiride (2mg), Metformin (500mg), Voglibose (0.2mg)', 0, 99, 1, '36', '2017-09-25 21:54:53', '117.201.31.100'),
(2316, 'MOXBRO 500MG CAP', 0, 99, 1, '36', '2017-09-25 22:29:31', '117.201.31.100'),
(2317, 'Clomifene (50mg), Melatonin (3mg)', 0, 99, 1, '36', '2017-09-25 23:01:58', '117.201.30.118'),
(2318, 'Artemether (40mg), Lumefantrine (240mg)', 0, 99, 1, '36', '2017-09-25 23:18:30', '117.201.30.118'),
(2319, 'Lidocaine (2%), Epinephrine (0.005mg)', 0, 99, 1, '36', '2017-09-25 23:18:04', '157.50.23.59'),
(2320, 'Artemether (40mg), Lumefantrine (240mg)', 0, 99, 1, '36', '2017-09-25 23:18:04', '117.201.30.118'),
(2321, 'CLOFERT 25 MG TABLET', 0, 99, 1, '36', '2017-09-25 23:21:50', '117.201.30.118'),
(2322, 'CLOFERT 25 MG TABLET', 0, 99, 1, '36', '2017-09-25 23:22:04', '117.201.30.118'),
(2323, 'Sulfasalazine (500mg)', 0, 99, 1, '36', '2017-09-25 23:23:09', '117.201.30.118'),
(2324, 'Escitalopram (10mg)', 0, 99, 1, '36', '2017-09-25 23:32:52', '117.201.30.118'),
(2325, 'Racecadotril (15mg), Ofloxacin (50mg)', 0, 99, 1, '36', '2017-09-25 23:33:17', '157.50.23.59'),
(2326, 'Torasemide (10mg)', 0, 99, 1, '36', '2017-09-25 23:40:09', '117.201.30.118'),
(2327, 'Paracetamol (80mg)', 0, 99, 1, '36', '2017-09-25 23:42:36', '117.201.30.118'),
(2328, 'Levocetirizine (5mg), Montelukast (10mg)', 0, 99, 1, '36', '2017-09-25 23:46:39', '117.201.30.118'),
(2329, 'Faropenem (200mg)', 0, 99, 1, '36', '2017-09-26 00:13:02', '117.201.28.157'),
(2330, 'Ampicillin (250mg)', 0, 99, 1, '36', '2017-09-26 00:19:01', '117.201.28.157'),
(2331, 'Atorvastatin (40mg)', 0, 99, 1, '36', '2017-09-26 00:22:06', '117.201.28.157'),
(2332, 'Betahistine (16mg)', 0, 99, 1, '36', '2017-09-26 00:26:52', '117.201.28.157'),
(2333, 'Mometasone Topical (1mg), Salicylic Acid (50mg)', 0, 99, 1, '36', '2017-09-26 00:30:20', '117.201.28.157'),
(2334, 'Progesterone (Natural Micronized) (100mg)', 0, 99, 1, '36', '2017-09-26 19:49:55', '117.207.104.192'),
(2335, 'Piracetam (400mg)', 0, 99, 1, '36', '2017-09-26 18:41:32', '103.60.74.3'),
(2336, 'Ketoconazole Topical (2%)', 0, 99, 1, '36', '2017-09-26 20:50:34', '117.207.104.192'),
(2337, 'Sodium Chloride (0.600gm), Sodium Lactate (0.320gm), Potassium Chloride (0.040gm), Calcium Chloride', 0, 99, 1, '36', '2017-09-26 00:49:05', '117.201.28.157'),
(2338, 'Sodium Chloride (0.600gm), Sodium Lactate (0.320gm), Potassium Chloride (0.040gm), Calcium Chloride', 0, 99, 1, '36', '2017-09-26 00:49:19', '117.201.28.157'),
(2339, 'Sodium Chloride (0.600gm), Sodium Lactate (0.320gm), Potassium Chloride (0.040gm), Calcium Chloride', 0, 99, 1, '36', '2017-09-26 00:49:45', '117.201.28.157'),
(2340, 'Glimepiride (1mg), Metformin (500mg)', 0, 99, 1, '36', '2017-09-26 14:50:50', '117.207.101.207'),
(2341, 'Piracetam (200mg)', 0, 99, 1, '36', '2017-09-26 01:07:07', '117.201.28.157'),
(2342, 'Cabergoline (0.25mg)', 0, 99, 1, '36', '2017-09-26 01:21:29', '117.201.28.157'),
(2343, 'Ethinyl Estradiol (0.02mg), Drospirenone (3mg)', 0, 99, 1, '36', '2017-09-26 01:24:34', '117.201.28.157'),
(2344, 'Lidocaine (2% W/v), Clotrimazole (1% W/v)', 0, 99, 1, '36', '2017-09-26 11:17:14', '117.207.101.207'),
(2345, 'Bupivacaine (0.5%)', 0, 99, 1, '36', '2017-09-26 11:19:24', '117.207.101.207'),
(2346, 'Chlorpheniramine (4mg), Phenylephrine (10mg)', 0, 99, 1, '36', '2017-09-26 11:25:10', '117.207.101.207'),
(2347, 'Chlorpheniramine (2mg), Phenylephrine (5mg)', 0, 99, 1, '36', '2017-09-26 12:28:11', '117.207.101.207'),
(2348, 'Aspirin(ASA) (325mg)', 0, 99, 1, '36', '2017-09-26 11:37:26', '117.207.101.207'),
(2349, 'Silver Nano Particles (0.02mg), Silver', 0, 99, 1, '36', '2017-09-26 11:39:33', '117.207.101.207'),
(2350, 'Metronidazole (200mg)', 0, 99, 1, '36', '2017-09-26 11:41:37', '117.207.101.207'),
(2351, 'Dicyclomine (10mg/ml)', 0, 99, 1, '36', '2017-09-26 11:50:00', '117.207.101.207'),
(2352, 'Human Chorionic Gonadotropin (hCG) (5000IU)', 0, 99, 1, '36', '2017-09-26 11:51:39', '117.207.101.207'),
(2353, 'Human Chorionic Gonadotropin (hCG) (5000IU)', 0, 99, 1, '36', '2017-09-26 11:51:52', '117.207.101.207'),
(2354, 'Human Chorionic Gonadotropin (hCG) (5000IU)', 0, 99, 1, '36', '2017-09-26 11:53:01', '117.207.101.207'),
(2355, 'Ropinirole (0.25mg)', 0, 99, 1, '36', '2017-09-26 11:55:12', '117.207.101.207'),
(2356, 'Norethisterone (10mg)', 0, 99, 1, '36', '2017-09-26 12:07:56', '117.207.101.207'),
(2357, 'Polio Vaccine (NA)', 0, 99, 1, '36', '2017-09-26 12:12:00', '117.207.101.207'),
(2358, 'Azathioprine (50mg)', 0, 99, 1, '36', '2017-09-26 12:16:09', '117.207.101.207'),
(2359, 'Chlorpheniramine (1mg/ml), Paracetamol (125mg/1ml), Phenylephrine (2.5mg/1ml)', 0, 99, 1, '36', '2017-09-26 12:19:19', '117.207.101.207'),
(2360, 'Artesunate (200mg), Sulfadoxine (500mg), Pyrimethamine (25mg)', 0, 99, 1, '36', '2017-09-26 12:21:10', '117.207.101.207'),
(2361, 'Budesonide (200mcg)', 0, 99, 1, '36', '2017-09-26 12:23:51', '117.207.101.207'),
(2362, 'Hepatitis B (20mcg), Aluminium Hydroxide (0.5mg), Thiomersal (0.05mg)', 0, 99, 1, '36', '2017-09-26 12:25:23', '117.207.101.207'),
(2363, 'Cabergoline (0.5mg)', 0, 99, 1, '36', '2017-09-26 12:31:57', '117.207.101.207'),
(2364, 'Levetiracetam (100mg)', 0, 99, 1, '36', '2017-09-26 12:34:19', '117.207.101.207'),
(2365, 'Fluconazole (50mg)', 0, 99, 1, '36', '2017-09-26 12:37:25', '117.207.101.207'),
(2366, 'Glimepiride (1mg), Metformin (1000mg)', 0, 99, 1, '36', '2017-09-26 12:40:45', '117.207.101.207'),
(2367, 'Atorvastatin (10mg), Aspirin(ASA) (75mg)', 0, 99, 1, '36', '2017-09-26 12:42:35', '117.207.101.207'),
(2368, 'Metoprolol (50mg)', 0, 99, 1, '36', '2017-09-26 20:03:40', '117.207.104.192'),
(2369, 'Atorvastatin (20mg)', 0, 99, 1, '36', '2017-09-26 12:46:45', '117.207.101.207'),
(2370, 'Bisacodyl (10mg)', 0, 99, 1, '36', '2017-09-26 12:55:23', '117.207.101.207'),
(2371, 'Ramipril (2.5mg), Hydrochlorothiazide (12.5mg)', 0, 99, 1, '36', '2017-09-26 12:58:39', '117.207.101.207'),
(2372, 'Ramipril (2.5mg), Hydrochlorothiazide (12.5mg)', 0, 99, 1, '36', '2017-09-26 12:59:00', '117.207.101.207'),
(2373, 'Progesterone (Natural Micronized) (25mg)', 0, 99, 1, '36', '2017-09-26 13:05:18', '117.207.101.207'),
(2374, 'Bupivacaine (5mg)', 0, 99, 1, '36', '2017-09-26 13:07:04', '117.207.101.207'),
(2375, 'Clomifene (100mg)', 0, 99, 1, '36', '2017-09-26 13:16:30', '117.207.101.207'),
(2376, 'Carvedilol (3.125mg)', 0, 99, 1, '36', '2017-09-26 13:24:04', '117.207.101.207'),
(2377, 'Chlorpheniramine (4mg), Paracetamol (325mg), Phenylephrine (10mg)', 0, 99, 1, '36', '2017-09-26 13:27:55', '117.207.101.207'),
(2378, 'Esomeprazole (40mg)', 0, 99, 1, '36', '2017-09-26 13:29:23', '117.207.101.207'),
(2379, 'Linezolid (600mg)', 0, 99, 1, '36', '2017-09-26 13:32:36', '117.207.101.207'),
(2380, 'Pantoprazole (20mg)', 0, 99, 1, '36', '2017-09-26 13:37:46', '117.207.101.207'),
(2381, 'Prednisolone (5mg)', 0, 99, 1, '36', '2017-09-26 13:41:26', '117.207.101.207'),
(2382, 'Sodium Chloride (0.9gm)', 0, 99, 1, '36', '2017-09-26 13:49:24', '117.207.101.207'),
(2383, 'Piracetam (800mg)', 0, 99, 1, '36', '2017-09-26 13:58:13', '117.207.101.207'),
(2384, 'Losartan (50mg), Hydrochlorothiazide (12.5mg)', 0, 99, 1, '36', '2017-09-26 13:59:57', '117.207.101.207'),
(2385, 'Aspirin(ASA) (75mg), Atorvastatin (10mg), Clopidogrel (75mg)', 0, 99, 1, '36', '2017-09-26 14:01:39', '117.207.101.207'),
(2386, 'Glimepiride (1mg)', 0, 99, 1, '36', '2017-09-26 14:03:37', '117.207.101.207'),
(2387, 'Sucralfate (500mg/5ml), Oxetacaine (10mg/5ml)', 0, 99, 1, '36', '2017-09-26 14:08:54', '117.207.101.207'),
(2388, 'Sucralfate (500mg/5ml), Oxetacaine (10mg/5ml)', 0, 99, 1, '36', '2017-09-26 14:09:07', '117.207.101.207'),
(2389, 'Butorphanol (1mg)', 0, 99, 1, '36', '2017-09-26 14:12:57', '117.207.101.207'),
(2390, 'Metoprolol (25mg)', 0, 99, 1, '36', '2017-09-26 14:33:35', '117.207.101.207'),
(2391, 'Clomifene (100mg), Melatonin (3mg)', 0, 99, 1, '36', '2017-09-26 14:43:22', '117.207.101.207'),
(2392, 'Meropenem (500mg)', 0, 99, 1, '36', '2017-09-26 14:52:57', '117.207.101.207'),
(2393, 'Lactagard 1000mg/500mg Injection', 0, 99, 1, '36', '2017-09-26 14:54:47', '117.207.101.207'),
(2394, 'Aceclofenac (100mg), Thiocolchicoside (8mg)', 0, 99, 1, '36', '2017-09-26 14:58:37', '117.207.101.207'),
(2395, 'Ampicillin (125mg), Cloxacillin (125mg)', 0, 99, 1, '36', '2017-09-26 15:31:00', '117.207.101.207'),
(2396, 'Diosmin (900mg)', 0, 99, 1, '36', '2017-09-26 15:32:59', '117.207.101.207'),
(2397, 'Guaifenesin (1mg), Terbutaline (15mg), Bromhexine (50mg)', 0, 99, 1, '36', '2017-09-26 15:48:01', '117.207.101.207'),
(2398, 'Clarithromycin (250mg)', 0, 99, 1, '36', '2017-09-26 15:57:35', '117.207.101.207'),
(2399, 'Cefuroxime (500mg), Clavulanic Acid (125mg)', 0, 99, 1, '36', '2017-09-26 16:10:30', '117.207.101.207'),
(2400, 'Aceclofenac (100mg), Paracetamol (325mg), Trypsin Chymotrypsin (150000AU)', 0, 99, 1, '36', '2017-09-26 16:26:08', '117.221.130.65'),
(2401, 'Nebivolol (5mg)', 0, 99, 1, '36', '2017-09-26 16:39:33', '117.222.161.67'),
(2402, 'Enoxaparin (60mg)', 0, 99, 1, '36', '2017-09-26 16:41:11', '117.222.161.67'),
(2403, 'Bisoprolol (5mg)', 0, 99, 1, '36', '2017-09-26 17:02:56', '117.222.161.67'),
(2404, 'Progesterone (300mg)', 0, 99, 1, '36', '2017-09-26 17:08:53', '117.222.161.67'),
(2405, 'Beclometasone Topical (0.025% W/w), Ketoconazole Topical (2% W/w)', 0, 99, 1, '36', '2017-09-26 17:17:54', '117.222.161.67'),
(2406, 'Methotrexate (50mg)', 0, 99, 1, '36', '2017-09-26 17:22:06', '117.222.161.67'),
(2407, 'Benfotiamine (7.5mg), Folic Acid (0.75mg), Methylcobalamin (750mcg), Pregabalin (75mg), Vitamin B6 (', 0, 99, 1, '36', '2017-09-26 17:26:12', '117.222.161.67'),
(2408, 'Benfotiamine (7.5mg), Folic Acid (0.75mg), Methylcobalamin (750mcg), Pregabalin (75mg), Vitamin B6 (', 0, 99, 1, '36', '2017-09-26 17:26:35', '117.222.161.67'),
(2409, 'Cetirizine (5mg), Phenylephrine (5mg), Menthol (1.5mg), Dextromethorphan (10mg)', 0, 99, 1, '36', '2017-09-26 17:36:14', '117.222.161.67'),
(2410, 'Clomifene (50mg), Coenzyme Q10 (75mg), Acetylcysteine (600mg)', 0, 99, 1, '36', '2017-09-26 17:48:41', '117.222.161.67'),
(2411, 'Nicorandil (5mg)', 0, 99, 1, '36', '2017-09-26 17:50:34', '117.222.161.67'),
(2412, 'Meropenem (1000mg)', 0, 99, 1, '36', '2017-09-26 17:56:20', '117.222.161.67'),
(2413, 'Diosmin (450mg)', 0, 99, 1, '36', '2017-09-26 17:59:35', '117.222.161.67'),
(2414, 'Atorvastatin (20mg), Aspirin(ASA) (75mg)', 0, 99, 1, '36', '2017-09-26 18:14:26', '117.222.161.67'),
(2415, 'Mifepristone (200mg)', 0, 99, 1, '36', '2017-09-26 18:29:32', '103.60.74.3'),
(2416, 'Mifepristone (200mg)', 0, 99, 1, '36', '2017-09-26 18:29:27', '103.60.74.3'),
(2417, 'Diazepam (5mg)', 0, 99, 1, '36', '2017-09-26 18:32:10', '103.60.74.3'),
(2418, 'Pantoprazole (40mg), Itopride (150mg)', 0, 99, 1, '36', '2017-09-26 18:35:44', '103.60.74.3'),
(2419, 'Vitamin D3 (600000IU)', 0, 99, 1, '36', '2017-09-26 18:44:57', '103.60.74.3'),
(2420, 'Fluconazole (150mg), Azithromycin (1000mg), Secnidazole (1000mg)', 0, 99, 1, '36', '2017-09-26 18:54:56', '103.60.74.3'),
(2421, 'Nebivolol (10mg)', 0, 99, 1, '36', '2017-09-26 19:04:21', '103.60.74.3'),
(2422, 'Amoxicillin (80mg), Clavulanic Acid (11.4mg)', 0, 99, 1, '36', '2017-09-26 19:37:58', '117.207.104.192'),
(2423, 'Nitroglycerin (2.6mg)', 0, 99, 1, '36', '2017-09-26 19:44:08', '117.207.104.192'),
(2424, 'Lidocaine (10% W/v)', 0, 99, 1, '36', '2017-09-26 19:46:28', '117.207.104.192'),
(2425, 'Cetirizine (10mg)', 0, 99, 1, '36', '2017-09-26 20:00:42', '117.207.104.192'),
(2426, 'Benfotiamine (7.5mg), Folic Acid (0.75mg), Methylcobalamin (750mcg), Pregabalin (75mg), Vitamin B6 (', 0, 99, 1, '36', '2017-09-26 20:33:26', '117.207.104.192'),
(2427, 'Clomifene (25mg)', 0, 99, 1, '36', '2017-09-26 20:37:07', '117.207.104.192'),
(2428, 'Primaquine (15mg)', 0, 99, 1, '36', '2017-09-26 20:40:51', '117.207.104.192'),
(2429, 'Mometasone Topical (0.1% W/w), Salicylic Acid (3.5% W/w)', 0, 99, 1, '36', '2017-09-26 20:45:47', '117.207.104.192'),
(2430, 'Sodium Chloride (0.600gm), Sodium Lactate (0.320gm), Potassium Chloride (0.040gm), Calcium Chloride', 0, 99, 1, '36', '2017-09-26 20:54:35', '117.201.17.89'),
(2431, 'Sodium Chloride (0.600gm), Sodium Lactate (0.320gm), Potassium Chloride (0.040gm), Calcium Chloride', 0, 99, 1, '36', '2017-09-26 20:54:51', '117.201.17.89'),
(2432, 'Pancreatin (250mg)', 0, 99, 1, '36', '2017-09-26 21:00:37', '117.201.25.158'),
(2433, 'Ofloxacin (200mg), Ornidazole (500mg)', 0, 99, 1, '36', '2017-09-26 21:02:33', '117.201.25.158'),
(2434, 'Clobetasol Topical (0.05% W/w), Clotrimazole Topical (1% W/w), Neomycin Topical (0.5% W/w)', 0, 99, 1, '36', '2017-09-26 21:11:47', '59.93.11.153'),
(2435, 'Benfotiamine (7.5mg), Folic Acid (0.75mg), Methylcobalamin (750mcg), Pregabalin (75mg), Vitamin B6 (', 0, 99, 1, '36', '2017-09-26 21:32:29', '59.93.11.153'),
(2436, 'Levo-carnitine (500mg/5ml)', 0, 99, 1, '36', '2017-09-26 21:40:08', '59.93.11.153'),
(2438, 'Tester', 15, 30, 1, '26', '2017-12-28 16:00:46', '49.207.188.110');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

CREATE TABLE `insurance` (
  `insurance_typeid` int(11) NOT NULL,
  `insurance_type` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `updated_on` date NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_ipaddress` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insurance`
--

INSERT INTO `insurance` (`insurance_typeid`, `insurance_type`, `is_active`, `updated_on`, `updated_by`, `updated_ipaddress`) VALUES
(1, 'GP', 1, '2017-09-06', 26, '192.168.1.12'),
(2, 'Aarogyasri', 1, '2017-09-06', 26, '192.168.1.12'),
(3, 'UCIL', 1, '2017-09-06', 26, '192.168.1.12'),
(4, 'Insurance', 1, '2017-09-06', 26, '192.168.1.12');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoiceid` int(11) NOT NULL,
  `receipt_number` varchar(20) NOT NULL,
  `patient_type` int(11) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `invoicenumber` varchar(50) NOT NULL,
  `tax` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoicereturn_payment`
--

CREATE TABLE `invoicereturn_payment` (
  `invoicepaymentreturnid` int(11) NOT NULL,
  `branchid` int(11) NOT NULL,
  `returnid` int(11) NOT NULL,
  `patientname` varchar(100) NOT NULL,
  `patient_mobilenumber` bigint(11) NOT NULL,
  `mrnumber` varchar(255) NOT NULL,
  `return_reason` varchar(255) DEFAULT NULL,
  `referencenumber` varchar(100) NOT NULL,
  `paymentmethod` varchar(255) NOT NULL,
  `invoicenumber` varchar(255) NOT NULL,
  `paymentamount` double NOT NULL,
  `timestamp` datetime NOT NULL,
  `updated_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payment`
--

CREATE TABLE `invoice_payment` (
  `invoicepaymentid` bigint(20) NOT NULL,
  `branchid` int(11) NOT NULL,
  `saleid` int(11) NOT NULL,
  `paymentmethod` varchar(255) NOT NULL,
  `invoicenumber` varchar(255) NOT NULL,
  `paymentamount` double NOT NULL,
  `cardtype` varchar(255) NOT NULL,
  `cardholdername` varchar(255) NOT NULL,
  `referencenumber` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL,
  `updated_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manufacturermaster`
--

CREATE TABLE `manufacturermaster` (
  `id` int(100) NOT NULL,
  `manufacturer_name` varchar(255) DEFAULT NULL,
  `manufacturer_description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `updatedby` varchar(20) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `updated_ipaddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacturermaster`
--

INSERT INTO `manufacturermaster` (`id`, `manufacturer_name`, `manufacturer_description`, `is_active`, `updatedby`, `updatedon`, `updated_ipaddress`) VALUES
(1, 'Cipla', 'Cipla', 1, '26', '2017-09-10 09:54:21', '49.207.187.48'),
(2, 'Macleods Pharmaceuticals', 'Macleods Pharmaceuticals', 1, '26', '2017-09-10 09:54:11', '49.207.187.48'),
(6, 'Ranbaxy Laboratories', 'Ranbaxy Laboratories', 1, '26', '2017-09-10 09:54:53', '49.207.187.48'),
(7, 'Dr. Reddy''s Laboratories', 'Dr. Reddy''s Laboratories', 1, '26', '2017-09-10 09:55:29', '49.207.187.48'),
(8, 'GlaxoSmithKline Pharmaceuticals', 'GlaxoSmithKline Pharmaceuticals', 1, '26', '2017-09-10 09:56:24', '49.207.187.48'),
(9, 'Lupin', 'Lupin', 1, '26', '2017-09-10 09:56:54', '49.207.187.48'),
(10, 'Mankind Pharma', 'Mankind Pharma', 1, '26', '2017-09-10 09:57:15', '49.207.187.48'),
(11, 'Cadila Pharmaceuticals', 'Cadila Pharmaceuticals', 1, '26', '2017-09-10 09:57:35', '49.207.187.48'),
(12, 'Glenmark Pharmaceuticals', 'Glenmark Pharmaceuticals', 1, '26', '2017-09-10 09:58:04', '49.207.187.48'),
(13, 'Vicco Group', 'Vicco Group', 1, '26', '2017-09-10 09:58:18', '49.207.187.48'),
(14, 'Sun Pharmaceutical', 'Sun Pharmaceutical', 1, '26', '2017-09-15 12:26:52', '180.151.35.68'),
(15, 'Novartis', 'Novartis', 1, '26', '2017-09-15 12:27:29', '180.151.35.68'),
(16, 'Samarth Life Sciences', 'Samarth Life Sciences', 1, '26', '2017-09-15 12:52:18', '180.151.35.68'),
(17, 'DELHI_CM', 'DElhisuplier', 1, '26', '2017-09-16 12:06:11', '49.207.177.156'),
(18, 'Zydus Cadila', 'Zydus', 1, '36', '2017-09-18 19:07:41', '117.249.223.241'),
(19, 'Uni Labs', 'Uni Labs', 1, '36', '2017-09-18 19:25:34', '117.249.223.241'),
(20, 'MSD Pharmaceuticals Pvt Ltd', 'MSD Pharmaceuticals Pvt Ltd', 1, '36', '2017-09-18 19:29:10', '117.249.223.241'),
(21, 'Wallace Pharmaceuticals Pvt Ltd', 'Wallace Pharmaceuticals Pvt Ltd', 1, '36', '2017-09-18 19:35:44', '117.249.223.241'),
(22, 'Alembic Pharmaceuticals Ltd', 'Alembic Pharmaceuticals Ltd', 1, '36', '2017-09-18 20:48:01', '117.249.223.241'),
(23, 'Pfizer Ltd', 'Pfizer', 1, '36', '2017-09-18 20:54:20', '117.249.223.241'),
(24, 'Unichem Laboratories Ltd', 'Unichem', 1, '36', '2017-09-18 21:01:33', '117.249.223.241'),
(25, 'J B Chemicals And Pharmaceuticals Ltd', 'J B Chemicals and Pharmaceuticals', 1, '36', '2017-09-18 21:04:13', '117.249.223.241'),
(26, 'Glaxo SmithKline Pharmaceuticals Ltd', 'Glaxo SmithKline Pharmaceuticals', 1, '36', '2017-09-18 21:06:05', '117.249.223.241'),
(27, 'Abbott India Ltd', 'Abbott India', 1, '36', '2017-09-18 21:10:16', '117.249.223.241'),
(28, 'Novartis India Ltd', 'NOVARTIS INDIA', 1, '36', '2017-09-18 21:31:02', '117.249.223.241'),
(29, 'IPCA LABORATORIES', 'IPCA LABORATORIES', 1, '36', '2017-09-18 21:35:18', '117.249.223.241'),
(30, 'Indoco Remedies Ltd', 'Indoco Remedies', 1, '36', '2017-09-18 21:37:26', '117.249.223.241'),
(31, 'Himalaya Drug Company', 'Himalaya Drug Company', 1, '36', '2017-09-18 21:42:31', '117.249.223.241'),
(32, 'Raptakos', 'Raptakos', 1, '36', '2017-09-18 22:02:11', '117.249.131.69'),
(33, 'Biological E Ltd', 'Biological E', 1, '36', '2017-09-19 08:23:19', '157.50.8.195'),
(34, 'Torrent Pharmaceuticals Ltd', 'Torrent Pharmaceuticals', 1, '36', '2017-09-19 08:27:18', '157.50.8.195'),
(35, 'Blue Cross Laboratories Ltd', 'Blue Cross Laboratories', 1, '36', '2017-09-19 08:31:06', '157.50.8.195'),
(36, 'Apex Laboratories Pvt Ltd', 'Apex Laboratories Pvt', 1, '36', '2017-09-19 08:37:01', '157.50.8.195'),
(37, 'Ipca Laboratories Ltd', 'Ipca Laboratories', 1, '36', '2017-09-19 08:43:45', '157.50.8.195'),
(38, 'Monichem Healthcare Pvt Ltd', 'Monichem Healthcare', 1, '36', '2017-09-19 08:48:30', '157.50.8.195'),
(39, 'Torque Pharmaceuticals Pvt Ltd', 'Torque Pharmaceuticals', 1, '36', '2017-09-19 08:58:40', '157.50.8.195'),
(40, 'Panacea Biotec Ltd', 'Panacea Biotec', 1, '36', '2017-09-19 09:02:17', '157.50.8.195'),
(41, 'Paras Pharmaceuticals Ltd', 'Paras Pharmaceuticals', 1, '36', '2017-09-19 09:04:07', '157.50.8.195'),
(42, 'Tablets India Limited', 'Tablets India', 1, '36', '2017-09-19 09:58:37', '157.50.8.195'),
(43, 'Biochem Pharmaceutical Industries', 'Biochem Pharmaceutical', 1, '36', '2017-09-19 13:05:48', '157.50.12.3'),
(44, 'Sun Pharmaceutical Industries Ltd', 'Sun Pharmaceutical Industries', 1, '36', '2017-09-19 13:17:47', '157.50.12.3'),
(45, 'Mankind Pharma Ltd', 'Mankind Pharma', 1, '36', '2017-09-19 13:22:11', '157.50.12.3'),
(46, 'Jagsonpal Pharmaceuticals Ltd', 'Jagsonpal Pharmaceuticals', 1, '36', '2017-09-19 13:24:23', '157.50.12.3'),
(47, 'Veritaz Healthcare Ltd', 'Veritaz Healthcare', 1, '36', '2017-09-19 13:26:31', '157.50.12.3'),
(48, 'Dr Reddy''s Laboratories Ltd', 'Dr Reddy''s Laboratories', 1, '36', '2017-09-19 13:30:12', '157.50.12.3'),
(49, 'Merck Ltd', 'Merck', 1, '36', '2017-09-19 13:43:50', '157.50.12.3'),
(50, 'TTK Healthcare Ltd', 'TTK Healthcare', 1, '36', '2017-09-19 13:47:00', '157.50.12.3'),
(51, 'Bharat Serums & Vaccines Ltd', 'Bharat Serums & Vaccines', 1, '36', '2017-09-19 13:57:05', '157.50.12.3'),
(52, 'Sanofi India Ltd', 'Sanofi India', 1, '36', '2017-09-19 15:52:24', '157.50.12.3'),
(53, 'Macleods Pharmaceuticals Pvt Ltd', 'Macleods Pharmaceuticals Pvt', 1, '36', '2017-09-19 16:06:20', '157.50.12.3'),
(54, 'Serum Institute Of India Ltd', 'Serum Institute Of India', 1, '36', '2017-09-19 16:10:35', '157.50.12.3'),
(55, 'Stedman Pharmaceuticals Pvt Ltd', 'Stedman Pharmaceuticals Pvt', 1, '36', '2017-09-19 16:47:33', '157.50.12.3'),
(56, 'DWD Pharmaceuticals Ltd', 'DWD Pharmaceuticals', 1, '36', '2017-09-19 17:03:30', '157.50.12.3'),
(57, 'Karnataka Antibiotics & Pharmaceuticals Ltd', 'Karnataka Antibiotics & Pharmaceuticals', 1, '36', '2017-09-19 17:05:33', '157.50.12.3'),
(58, 'Vanguard Therapeutics Pvt Ltd', 'Vanguard Therapeutics Pvt', 1, '36', '2017-09-19 17:10:41', '157.50.12.3'),
(59, 'Boehringer Ingelheim', 'Boehringer Ingelheim', 1, '36', '2017-09-19 17:20:48', '157.50.12.3'),
(60, 'Fulford India Ltd', 'Fulford India', 1, '36', '2017-09-19 17:23:44', '157.50.12.3'),
(61, 'Sapco Laboratories Private Limited', 'Sapco Laboratories Private', 1, '36', '2017-09-19 17:30:50', '157.50.12.3'),
(62, 'Walter Bushnell', 'Walter Bushnell', 1, '36', '2017-09-19 17:34:52', '157.50.12.3'),
(63, 'Glenmark Pharmaceuticals Ltd', 'Glenmark Pharmaceuticals', 1, '36', '2017-09-19 17:43:39', '157.50.12.3'),
(64, 'USV Ltd', 'USV Ltd', 1, '36', '2017-09-19 17:53:32', '157.50.12.3'),
(65, 'Janssen Pharmaceuticals', 'Janssen Pharmaceuticals', 1, '36', '2017-09-19 18:07:06', '157.50.12.3'),
(66, 'Mercury Healthcare Pvt Ltd', 'Mercury Healthcare', 1, '36', '2017-09-19 18:18:42', '157.50.12.3'),
(67, 'Hetero Drugs Ltd', 'Hetero Drugs', 1, '36', '2017-09-19 18:23:48', '157.50.12.3'),
(68, 'Albert David Ltd', 'Albert David', 1, '36', '2017-09-19 22:53:46', '157.50.8.18'),
(69, 'Aristo Pharmaceuticals Pvt Ltd', 'Aristo Pharmaceuticals Pvt', 1, '36', '2017-09-19 23:03:58', '157.50.8.18'),
(70, 'Aimil Pharmaceuticals India Ltd', 'Aimil Pharmaceuticals India', 1, '36', '2017-09-19 23:11:43', '157.50.8.18'),
(71, 'Samarth Life Sciences Pvt Ltd', 'Samarth Life Sciences Pvt', 1, '36', '2017-09-19 23:19:08', '157.50.8.18'),
(72, 'Juggat Pharma', 'Juggat Pharma', 1, '36', '2017-09-19 23:20:45', '157.50.8.18'),
(73, 'Raptakos Brett & Co Ltd', 'Raptakos Brett & Co', 1, '36', '2017-09-19 23:35:31', '157.50.8.18'),
(74, 'Novo Nordisk India Pvt Ltd', 'Novo Nordisk India Pvt', 1, '36', '2017-09-20 05:42:26', '157.50.11.158'),
(75, 'Wockhardt Ltd', 'Wockhardt', 1, '36', '2017-09-20 06:27:32', '157.50.11.158'),
(76, 'East India Pharmaceutical Works Ltd', 'East India Pharmaceutical Works', 1, '36', '2017-09-20 06:31:17', '157.50.11.158'),
(77, 'Bharat Biotech', 'Bharat Biotech', 1, '36', '2017-09-20 06:35:44', '157.50.11.158'),
(78, 'Harson Laboratories', 'Harson Laboratories', 1, '36', '2017-09-20 06:38:59', '157.50.11.158'),
(79, 'Shreya Life Sciences Pvt Ltd', 'Shreya Life Sciences', 1, '36', '2017-09-20 08:08:50', '157.50.11.158'),
(80, 'Modi Mundi Pharma Pvt Ltd', 'Modi Mundi Pharma', 1, '36', '2017-09-20 08:24:44', '157.50.11.158'),
(81, 'Oaknet Healthcare Pvt Ltd', 'Oaknet Healthcare', 1, '36', '2017-09-20 08:41:10', '157.50.11.158'),
(82, 'Med Manor Organics Pvt Ltd', 'Med Manor Organics', 1, '36', '2017-09-20 09:48:24', '157.50.8.144'),
(83, 'Maneesh Pharmaceuticals Ltd', 'Maneesh Pharmaceuticals', 1, '36', '2017-09-20 10:00:58', '157.50.8.207'),
(84, 'Micro Labs Ltd', 'Micro Labs', 1, '36', '2017-09-20 10:03:36', '157.50.8.207'),
(85, 'Win-Medicare Pvt Ltd', 'Win-Medicare', 1, '36', '2017-09-20 10:07:18', '157.50.8.207'),
(86, 'Pharmatak Opthalmics Pvt Ltd', 'Pharmatak Opthalmics', 1, '36', '2017-09-20 10:14:28', '157.50.8.207'),
(87, 'Sanzyme Ltd', 'Sanzyme', 1, '36', '2017-09-20 10:31:44', '157.50.8.207'),
(88, 'Claris Lifesciences Ltd', 'Claris Lifesciences', 1, '36', '2017-09-20 10:38:47', '157.50.8.207'),
(89, 'Menarini India Pvt Ltd', 'Menarini India', 1, '36', '2017-09-20 10:40:28', '157.50.8.207'),
(90, 'Alkem Laboratories Ltd', 'Alkem Laboratories', 1, '36', '2017-09-20 13:44:29', '157.50.8.207'),
(91, 'Icpa Health Products Ltd', 'Icpa Health Products', 1, '36', '2017-09-20 14:22:43', '157.50.8.207'),
(92, 'Meyer Organics Pvt Ltd', 'Meyer Organics', 1, '36', '2017-09-20 14:34:59', '157.50.8.207'),
(93, 'RPG Life Sciences Ltd', 'RPG Life Sciences', 1, '36', '2017-09-20 19:03:17', '157.50.21.122'),
(94, 'Edura Pharmaceuticals Pvt Ltd', 'Edura Pharmaceuticals Pvt', 1, '36', '2017-09-20 19:10:13', '157.50.21.122'),
(95, 'Inga Laboratories Pvt Ltd', 'Inga Laboratories', 1, '36', '2017-09-20 22:42:12', '157.50.12.3'),
(96, 'Piramal Healthcare Limited', 'Piramal Healthcare', 1, '36', '2017-09-21 06:19:38', '157.50.12.3'),
(97, 'Cadila Pharmaceuticals Ltd', 'Cadila Pharmaceuticals', 1, '36', '2017-09-21 06:34:20', '157.50.12.3'),
(98, 'Alpha Pharmaceuticals', 'Alpha Pharmaceuticals', 1, '36', '2017-09-21 09:59:45', '157.50.10.184'),
(99, 'Nirlife Healthcare', 'Nirlife Healthcare', 1, '36', '2017-09-21 10:09:27', '106.208.179.103'),
(100, 'Doctor Pharma', 'Doctor Pharma', 1, '36', '2017-09-21 10:13:09', '106.208.179.103'),
(101, 'Acme Pharmaceutical', 'Acme Pharma', 1, '36', '2017-09-21 10:16:34', '106.208.179.103'),
(102, 'Geno Pharmaceuticals Ltd', 'Geno Pharmaceuticals', 1, '36', '2017-09-21 12:11:25', '106.208.179.103'),
(103, 'Parenteral Drugs India Ltd', 'Parenteral Drugs', 1, '36', '2017-09-21 15:10:20', '157.50.14.255'),
(104, 'Neon Laboratories Ltd', 'Neon Laboratories', 1, '36', '2017-09-21 15:13:46', '157.50.14.255'),
(105, 'Kerala Ayurveda Limited', 'Kerala Ayurveda', 1, '36', '2017-09-21 15:14:56', '157.50.14.255'),
(106, 'Fourrts India Laboratories Pvt Ltd', 'Fourrts India Laboratories', 1, '36', '2017-09-21 15:55:05', '157.50.14.255'),
(107, 'FDC Ltd', 'FDC', 1, '36', '2017-09-22 08:18:18', '157.50.13.170'),
(108, 'Venus Remedies Ltd', 'Venus Remedies', 1, '36', '2017-09-22 08:57:20', '157.50.13.170'),
(109, 'P & B Pharmaceuticals Ltd', 'P & B Pharmaceuticals Ltd', 1, '36', '2017-09-22 17:32:19', '117.221.135.89'),
(110, 'Reckitt Benckiser', 'Reckitt Benckiser', 1, '36', '2017-09-22 22:34:07', '103.204.29.216'),
(111, 'Reckitt Benckiser', 'Reckitt Benckiser', 1, '36', '2017-09-22 22:33:52', '103.204.29.216'),
(112, 'Zee Laboratories', 'Zee Laboratories', 1, '36', '2017-09-22 23:04:29', '103.204.29.216'),
(113, 'Troikaa Pharmaceuticals Ltd', 'Troikaa Pharmaceuticals Ltd', 1, '36', '2017-09-23 08:40:28', '59.93.9.243'),
(114, 'Pharmanova India Drugs Pvt Ltd', 'Pharmanova India Drugs Pvt Ltd', 1, '36', '2017-09-23 08:39:33', '59.93.9.243'),
(115, 'Pharmanova India Drugs Pvt Ltd', 'Pharmanova India Drugs Pvt Ltd', 1, '36', '2017-09-23 08:40:10', '59.93.9.243'),
(116, 'Pharmanova India Drugs Pvt Ltd', 'Pharmanova India Drugs Pvt Ltd', 1, '36', '2017-09-23 08:40:22', '59.93.9.243'),
(117, 'Hegde And Hegde Pharmaceutical LLP', 'Hegde and Hegde Pharmaceutical LLP', 1, '36', '2017-09-23 16:59:12', '117.222.161.88'),
(118, 'Lloyd Healthcare Pvt Ltd', 'Lloyd Healthcare Pvt Ltd', 1, '36', '2017-09-23 17:31:49', '117.221.131.116'),
(119, 'Wanbury Ltd', 'Wanbury Ltd', 1, '36', '2017-09-23 18:06:40', '117.201.28.84'),
(120, 'Meridian Enterprises Pvt Ltd', 'Meridian Enterprises Pvt Ltd', 1, '36', '2017-09-23 18:50:40', '117.201.24.231'),
(121, 'Fresenius Kabi India Pvt Ltd', 'Fresenius Kabi India Pvt Ltd', 1, '36', '2017-09-23 20:33:35', '117.201.24.231'),
(122, 'Zuventus Healthcare Ltd', 'Zuventus Healthcare Ltd', 1, '36', '2017-09-23 20:48:22', '117.201.24.231'),
(123, 'Themis Medicare Ltd', 'Themis Medicare Ltd', 1, '36', '2017-09-23 23:03:35', '117.201.24.231'),
(124, 'Astra Zeneca', 'Astra Zeneca', 1, '36', '2017-09-24 00:11:59', '117.201.24.231'),
(125, 'Intas Pharmaceuticals Ltd', 'Intas Pharmaceuticals Ltd', 1, '36', '2017-09-24 02:58:11', '117.201.24.231'),
(126, 'Minova Life Sciences Pvt Ltd', 'Minova Life Sciences Pvt Ltd', 1, '36', '2017-09-24 13:37:31', '117.207.109.148'),
(127, 'Xieon Life Sciences Pvt Ltd', 'Xieon Life Sciences Pvt Ltd', 1, '36', '2017-09-24 13:49:36', '117.207.109.148'),
(128, 'Gland Pharma Limited', 'Gland Pharma Limited', 1, '36', '2017-09-24 17:10:56', '59.93.13.134'),
(129, 'Systopic Laboratories Pvt Ltd', 'Systopic Laboratories Pvt Ltd', 1, '36', '2017-09-24 19:25:34', '117.201.27.215'),
(130, 'Dabur India Ltd', 'Dabur India', 1, '36', '2017-09-24 23:18:09', '157.50.23.160'),
(131, 'Strides Shasun Ltd', 'Strides shasun', 1, '36', '2017-09-24 23:32:11', '157.50.23.160'),
(132, 'Orris Pharmaceuticals', 'Orris Pharmaceuticals', 1, '36', '2017-09-24 23:37:08', '157.50.23.160'),
(133, 'Bal Pharma Ltd', 'Bal Pharma', 1, '36', '2017-09-25 13:43:11', '157.50.22.165'),
(134, 'Ar-Ex Laboratories Pvt Ltd', 'Ar-Ex Laboratories Pvt Ltd', 1, '36', '2017-09-25 22:14:38', '117.201.31.100'),
(135, 'Akumentis Healthcare Ltd', 'Akumentis Healthcare Ltd', 1, '36', '2017-09-25 23:03:33', '117.201.30.118'),
(136, 'KNOLL HEALTHCARE', 'KNOLL HEALTHCARE', 1, '36', '2017-09-25 23:29:37', '157.50.23.59'),
(137, 'Comed Chemicals Ltd', 'Comed Chemicals Ltd', 1, '36', '2017-09-26 00:16:41', '117.201.28.157'),
(138, 'Ajanta Pharma Ltd', 'Ajanta Pharma Ltd', 1, '36', '2017-09-26 11:59:48', '117.207.101.207'),
(139, 'Baxter India Pvt Ltd', 'Baxter India Pvt Ltd', 1, '36', '2017-09-26 13:50:23', '117.207.101.207'),
(140, 'Elion Health Care Ltd', 'Elion Health Care Ltd', 1, '36', '2017-09-26 14:17:31', '117.207.101.207'),
(141, 'Vhb Life Sciences Inc', 'Vhb Life Sciences Inc', 1, '36', '2017-09-26 14:37:53', '117.207.101.207'),
(142, 'Vhb Life Sciences Inc', 'Vhb Life Sciences Inc', 1, '36', '2017-09-26 14:38:48', '117.207.101.207'),
(143, 'Serdia Pharmaceuticals India Pvt Ltd', 'Serdia Pharmaceuticals India Pvt Ltd', 1, '36', '2017-09-26 15:37:16', '117.207.101.207'),
(144, 'Kim Lab', 'Kim Lab', 1, '36', '2017-09-26 18:04:51', '117.222.161.67'),
(145, 'Icon Life Sciences', 'Icon Life Sciences', 1, '36', '2017-09-26 18:42:44', '103.60.74.3'),
(146, 'Johnson & Johnson Ltd', 'Johnson & Johnson', 1, '36', '2017-10-05 13:55:41', '157.50.15.153'),
(147, 'TESTER', 'TESTER', 1, '26', '2017-12-28 17:06:46', '49.207.188.110');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1459344856),
('m130524_201442_init', 1459344861),
('m140506_102106_rbac_init', 1462199506);

-- --------------------------------------------------------

--
-- Table structure for table `module_action`
--

CREATE TABLE `module_action` (
  `actionid` int(11) NOT NULL,
  `action_name` varchar(30) NOT NULL,
  `action_key` varchar(30) NOT NULL,
  `action_value` varchar(30) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `updatedby` varchar(30) NOT NULL,
  `updatedon` datetime NOT NULL,
  `updated_ipaddress` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_action`
--

INSERT INTO `module_action` (`actionid`, `action_name`, `action_key`, `action_value`, `is_active`, `updatedby`, `updatedon`, `updated_ipaddress`) VALUES
(1, 'Add', 'a', 'a', 1, '17', '2017-07-28 18:47:32', '192.168.1.54'),
(2, 'Edit', 'e', '', 1, '17', '2017-07-24 17:58:11', '192.168.1.54'),
(3, 'View', 'v', '', 1, '17', '2017-07-21 17:15:28', '192.168.1.63'),
(4, 'Delete', 'd', '', 1, '17', '2017-07-12 19:17:20', '192.168.1.54'),
(5, 'ModuleAction', 'm', '', 0, '17', '2017-07-13 18:01:52', '192.168.1.27'),
(6, 'Import', 'import', '', 1, '17', '2017-07-15 17:24:44', '192.168.1.27'),
(7, 'Export', 'et', '', 1, '26', '2017-08-17 16:04:32', '49.207.177.156'),
(8, 'Delete All', 'da', 'da', 1, '26', '2017-09-12 19:09:37', '49.207.177.156'),
(9, 'Pay', 'pay', 'pay', 1, '26', '2017-10-06 20:41:16', '49.206.120.32'),
(10, 'refund', 'refund', 'refund', 1, '26', '2017-10-28 18:57:19', '183.83.51.82'),
(11, 'print', 'print', 'print', 1, '26', '2017-10-31 11:21:51', '183.83.51.82'),
(12, 'Test12', 'test12', '12', 1, '26', '2017-12-28 15:01:24', '49.207.188.110');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL,
  `patient_type` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` varchar(50) DEFAULT NULL,
  `medicalrecord_number` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `emailid` varchar(100) DEFAULT NULL,
  `patient_mobilenumber` varchar(20) DEFAULT NULL,
  `guardian_name` varchar(200) DEFAULT NULL,
  `guardian_mobilenumber` varchar(20) DEFAULT NULL,
  `physicianname` varchar(200) DEFAULT NULL,
  `insurance_type` tinyint(3) DEFAULT NULL,
  `reference_number` varchar(50) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_ipaddress` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `patient_type`, `firstname`, `lastname`, `dob`, `age`, `medicalrecord_number`, `address`, `gender`, `emailid`, `patient_mobilenumber`, `guardian_name`, `guardian_mobilenumber`, `physicianname`, `insurance_type`, `reference_number`, `notes`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1, 1, 'Wer', 'Wer', '2017-08-26', '0', '1', '', 'M', 'wer@gh.hrt', '234', 'We', '', 'Sharma', 0, '', '', 1, 26, '2017-08-26 17:49:47', '49.207.177.156'),
(2, 1, 'Rahul', 'Sharma', '2000-11-23', '17', '2', '', 'M', 'test7@patient.co', '7777777789', '', '', 'Sharma', 0, '', '', 1, 26, '2017-08-26 18:16:00', '49.207.177.156'),
(3, 1, 'Tytt', 'Tt', '1970-01-01', '8', '3', '7567', 'F', '', '6456456456', '', '56', '1', 1, '', '567', 1, 26, '2018-03-08 12:28:25', '192.168.1.9'),
(4, 1, 'Test', 'Patient', '1994-06-15', '23', '4', '3333dfgdf', 'M', 'dfgd@dgfdg.dffd', '4333333333', 'Fdgsdfg', '3433333333', '1', 2, 'dfgfd', '', 1, 35, '2017-09-09 12:46:44', '49.207.177.156'),
(5, 1, 'Dfgdf', 'Dfgds', '2007-06-12', '10', '5', '', 'M', '', '3434343434', '', '', '1', 3, '', '', 1, 26, '2017-09-09 13:04:10', '49.207.177.156'),
(6, 1, 'Test', 'Patient', '2008-06-10', '9', '6', '', 'M', '', '3454535435', '', '', '1', 1, '4353535', '', 1, 26, '2017-09-09 18:47:36', '49.207.177.156'),
(7, 1, 'F', 'F', '2017-09-27', '0', '7', 'Asd', '', '', '234234', 'Asd', '', '1', 1, 'er', 'Asd', 1, 33, '2017-09-09 19:19:12', '49.207.177.156'),
(8, 1, 'F', 'F', '2017-09-27', '0', '8', 'Asd', 'F', '', '234234', 'Asd', '', '1', 1, 'er', 'Asd', 1, 33, '2017-09-09 19:19:48', '49.207.177.156'),
(9, 2, 'Xc', 'Sdf', '2017-09-29', '0', '9', '', 'F', '', '4534534534', '', '', '1', 3, '', '', 1, 33, '2017-09-09 19:21:44', '49.207.177.156'),
(10, 1, 'Werwe', 'Rwe', '2017-09-28', '0', '10', '', 'F', '', '34234234', '', '', '1', 3, '', '', 1, 26, '2017-09-21 20:27:27', '49.206.120.32'),
(11, 2, 'Test', 'Test', '2017-04-04', '0', '11', '', 'M', '', '6876876876', '', '', '1', 1, '', '', 1, 26, '2017-09-21 20:27:34', '106.208.99.38'),
(12, 1, 'Test', 'Patient', '2010-08-27', '7', '12', 'Test Address', 'M', 'test@patient.co', '9876543210', 'Gsdfgsdf', '2342423423', '1', 1, '423432', 'Sadfsd', 1, 26, '2017-09-26 19:20:56', '49.206.120.32'),
(13, 1, '234', '23', '2017-10-23', '0', '13', '', 'M', '', '34345345', '', '', '1', 1, '', '', 1, 26, '2017-10-03 13:15:09', '49.206.120.32'),
(14, 2, 'Senthuran', 'Sendil Kumar', '1988-07-05', '29', '14', '', 'M', '', '7550043079', '', '', '1', 3, '', '', 1, 26, '2017-10-11 17:32:01', '106.208.22.0'),
(15, 3, '345345345', NULL, NULL, NULL, '15', NULL, NULL, NULL, '4334345', NULL, NULL, NULL, NULL, NULL, NULL, 1, 26, '2017-10-11 20:53:00', '49.206.120.32'),
(16, 3, '345345345', NULL, NULL, NULL, '16', NULL, NULL, NULL, '4334345', NULL, NULL, NULL, NULL, NULL, NULL, 1, 26, '2017-10-11 20:53:09', '49.206.120.32'),
(17, 3, '345345345', NULL, NULL, NULL, '17', NULL, NULL, NULL, '4334345', NULL, NULL, NULL, NULL, NULL, NULL, 1, 26, '2017-10-11 20:53:22', '49.206.120.32'),
(18, 3, 'Test', NULL, NULL, NULL, '18', NULL, NULL, NULL, '7777777789', NULL, NULL, NULL, NULL, NULL, NULL, 1, 26, '2017-10-11 20:54:04', '49.206.120.32'),
(19, 3, '345345345', NULL, NULL, NULL, '19', NULL, NULL, NULL, '4334345', NULL, NULL, NULL, NULL, NULL, NULL, 1, 26, '2017-10-11 20:55:41', '49.206.120.32'),
(20, 3, 'Senthuran', NULL, NULL, NULL, '20', NULL, NULL, NULL, '7550043079', NULL, NULL, NULL, NULL, NULL, NULL, 1, 39, '2017-10-13 13:40:23', '106.208.20.29'),
(21, 3, 'Senthuran', NULL, NULL, NULL, '21', NULL, NULL, NULL, '7550043079', NULL, NULL, NULL, NULL, NULL, NULL, 1, 42, '2017-10-25 09:25:23', '106.208.68.80'),
(22, 1, 'Ff', 'Ll', '2017-10-23', '0', '1qaz', '33333333', 'M', '345@gh.thret', '55', '5555', '4444', '1', 1, '66666', 'Dddddddddddddddddd', 1, 26, '2017-10-28 11:18:24', '183.83.51.82'),
(23, 2, 'Ramesh', NULL, NULL, NULL, '23', NULL, NULL, NULL, '7550043079', NULL, NULL, NULL, NULL, NULL, NULL, 1, 42, '2017-10-28 12:43:23', '106.203.85.93'),
(24, 2, 'Micheal Jackson', NULL, NULL, NULL, 'TEST001', NULL, NULL, NULL, '7550043078', NULL, NULL, NULL, 3, NULL, NULL, 1, 46, '2017-11-03 12:38:24', '106.208.21.182'),
(25, 2, 'Cdd', NULL, NULL, NULL, 'Vteat', NULL, NULL, NULL, '9777777777', NULL, NULL, NULL, 3, NULL, NULL, 1, 48, '2017-11-03 13:04:42', '183.83.51.82'),
(26, 2, 'Tt', NULL, NULL, NULL, 'sd', NULL, NULL, NULL, '9888888888', NULL, NULL, NULL, 3, NULL, NULL, 1, 48, '2017-11-03 13:33:47', '183.83.51.82'),
(27, 2, 'Sdf', NULL, NULL, NULL, 'uu', NULL, NULL, NULL, '9666666666', NULL, NULL, NULL, 3, NULL, NULL, 1, 48, '2017-11-03 13:33:59', '183.83.51.82'),
(28, 2, 'TEST', 'TEST', '2017-04-26', '0', 'TEST010', '', 'M', '', '7550043073', '', '', '1', 3, '', '', 1, 50, '2017-11-17 21:41:17', '122.174.33.82'),
(29, 2, 'Varun', 'Aaron', '2012-11-05', '5', '7890', '', 'M', '', '9243432423', '', '', '1', 3, '', '', 1, 26, '2017-11-18 11:25:16', '183.83.51.82'),
(30, 2, 'Fdgf', 'Sdfgsdfgdsf', '2013-11-14', '4', '123123', '', 'M', 'sgfsg@fsg.fsdgf', '9423423423', 'Sdgdf', '', '1', 3, '', '', 1, 26, '2017-11-18 11:55:09', '183.83.51.82'),
(31, 2, 'Test', 'Xyz', '2012-11-13', '5', '987', 'Fdsfsd', 'F', 'prasanth@gmail.com', '9342343242', 'Sfdgfdg', '9534534534', '1', 3, '', 'Sdfs', 1, 26, '2017-11-20 18:34:10', '183.83.51.82'),
(32, 1, '56', '56', '2017-11-16', '0', '8888888888888888888888888888', '', 'M', '', '9006756756', '', '', '1', 4, '', '', 1, 26, '2017-11-21 20:03:15', '183.83.51.82'),
(33, 2, 'Ghgdhgf', 'Gfhgfh', '2012-10-29', '5', '834', '', 'F', '', '9564567845', '', '', '1', 3, '', '', 1, 26, '2017-11-21 20:08:02', '183.83.51.82'),
(34, 2, 'Sdfsdf', 'sdfdf', '1970-06-01', '48years0months16days', '1234', '', 'M', '', '9564567867', '', '', '1', 1, '', '', 1, 26, '2018-02-06 03:46:37', '192.168.1.84'),
(35, 2, 'Dsdfsfsd', 'Sdfsd', '2012-11-06', '5', '123467', 'Sfsdfsd', 'F', 'gfhgfh@fdgfdg.dfgdf', '9343424234', 'Fdgfgdgd', '9545345435', '1', 3, '', 'Sdfsdf', 1, 26, '2017-11-28 13:35:45', '49.206.126.68'),
(36, 2, 'Sdfsdfdsf', NULL, NULL, NULL, '923432', NULL, NULL, NULL, '9564567834', NULL, NULL, NULL, 3, NULL, NULL, 1, 26, '2017-11-28 13:36:33', '49.206.126.68'),
(37, 2, 'randy', '', '1970-01-01', '47', 'MRN37', 'gfggh', NULL, 'gffdd@gmail.com', '9454542164', NULL, NULL, NULL, NULL, NULL, NULL, 1, 52, '2017-12-01 13:29:51', NULL),
(38, 2, 'ranjithakp', '', '1970-01-01', '47', 'MRN38', 'nnnbb', NULL, 'kjhh@gmail.com', '9452122236', NULL, NULL, NULL, NULL, NULL, NULL, 1, 52, '2017-12-01 13:35:05', NULL),
(39, 2, 'ranjuima', '', '1900-01-02', '117', 'MRN39', 'jhgvv', NULL, 'ranjhhgghi@gmail.com', '9678888545', NULL, NULL, NULL, NULL, NULL, NULL, 1, 52, '2017-12-01 13:36:38', NULL),
(40, 2, 'tinku', '', '1900-02-02', '117', 'MRN40', 'gggfg', NULL, 'mkjjjranji@gmail.com', '9645555225', NULL, NULL, NULL, NULL, NULL, NULL, 1, 52, '2017-12-01 13:57:54', NULL),
(41, 2, 'ran', '', '1900-09-02', '117', 'MRN41', 'kkkj', NULL, 'rangggggji@gmail.com', '9555555656', NULL, NULL, NULL, NULL, NULL, NULL, 1, 52, '2017-12-01 14:06:48', NULL),
(42, 2, 'ras', '', '1970-01-01', '47', 'MRN42', '', NULL, '', '955455555', NULL, NULL, NULL, NULL, NULL, NULL, 1, 52, '2017-12-01 14:50:51', NULL),
(43, 2, 'dsfsdfsd', '', '1989-12-12', '28', 'MRN43', 'sdfsfsdfsdfs', NULL, 'randy@gmail.com', '8754398821', NULL, NULL, NULL, NULL, NULL, NULL, 1, 52, '2017-12-01 15:17:58', NULL),
(44, 2, 'jjjj', '', '1970-01-01', '47', 'MRN44', '', NULL, '', '98555555', NULL, NULL, NULL, NULL, NULL, NULL, 1, 52, '2017-12-01 15:56:34', NULL),
(45, 2, 'ttttt', '', '1900-02-02', '117', 'MRN45', '', NULL, '', '9547854445', NULL, NULL, NULL, NULL, NULL, NULL, 1, 52, '2017-12-01 18:28:10', NULL),
(46, 2, 'iiuu', '', '1900-02-02', '117', 'MRN46', '', NULL, '', '9555556655', NULL, NULL, NULL, NULL, NULL, NULL, 1, 52, '2017-12-01 20:43:50', NULL),
(47, 2, 'ras', '', '1970-01-01', '47', 'MRN47', '', NULL, '', '9955268826', NULL, NULL, NULL, NULL, NULL, NULL, 1, 52, '2017-12-06 15:49:26', NULL),
(48, 2, 'Test', '', '1994-06-12', '23', 'MRN48', '', NULL, '', '67766764566', NULL, NULL, NULL, NULL, NULL, NULL, 1, 52, '2017-12-06 18:08:58', NULL),
(49, 2, 'BABU', '', '2017-02-02', '0', 'MRN49', 'pulivendla', NULL, 'plvdpharmacy@gmail.com', '08568287557', NULL, NULL, NULL, NULL, NULL, NULL, 1, 52, '2017-12-06 18:55:00', NULL),
(50, 2, 'dfgg', '', '2017-11-12', '0', 'MRN50', '', NULL, 'vcfghh@gmail.com', '5355265885', NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2017-12-11 14:43:25', NULL),
(51, 2, 'dfgg', '', '2010-11-12', '7', 'MRN51', '', NULL, 'vcfgfghh@gmail.com', '5355265889', NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2017-12-11 14:46:02', NULL),
(52, 2, 'Yyyyy', '', '2017-11-12', '0', 'MRN52', '', NULL, '', '9575558555', NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2017-12-11 14:51:29', NULL),
(53, 2, 'Rrrrjj', '', '2017-08-12', '0', 'MRN53', '', NULL, '', '9557664568', NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2017-12-11 14:54:21', NULL),
(54, 2, 'rssd', '', '2017-11-12', '0', 'MRN54', '', NULL, 'cfghh@gmail.com', '9885688866', NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2017-12-11 15:05:15', NULL),
(55, 2, 'iiiiii', '', '1970-01-01', '47', 'MRN55', '', NULL, 'hgdd@gmail.com', '9442563211', NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2017-12-11 15:09:10', NULL),
(56, 2, 'gg', NULL, NULL, '', 'MRN56', '', NULL, '', '9633211478', NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2017-12-11 15:47:05', NULL),
(57, 2, 'tgh', NULL, NULL, '', 'MRN57', '', NULL, '', '6325556211', NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2017-12-11 15:48:23', NULL),
(58, 2, 'fyy', NULL, '1970-01-01', '47 years - 11 months - 10 days', 'MRN58', 'fggh', NULL, 'ggf@gmail.com', '412333669', NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2017-12-11 15:59:17', NULL),
(59, 2, 'Tankh', NULL, NULL, '', 'MRN59', '', NULL, '', '9642131224', NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2017-12-12 07:44:09', NULL),
(60, 2, 'ghgvg', NULL, NULL, '', 'MRN60', '', NULL, '', '9644258785', NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2017-12-12 12:38:08', NULL),
(61, 2, 'ras', NULL, NULL, '', 'MRN61', '', NULL, '', '1235699869', NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2017-12-12 15:03:58', NULL),
(62, 2, 'kkkk', NULL, NULL, '', 'MRN62', '', NULL, '', '9696555555', NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2017-12-12 15:57:04', NULL),
(63, 2, 'Ranjitha', NULL, NULL, '', 'MRN63', '', NULL, '', '9685748213', NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2017-12-12 18:42:50', NULL),
(64, 2, 'Ran', NULL, NULL, '', 'MRN64', '', NULL, '', '9587545523', NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2017-12-13 10:57:31', NULL),
(65, 2, 'fddf', NULL, '1970-01-01', '47 years - 11 months - 12 days', 'MRN65', '', NULL, 'gfdffggh@gnail.com', '9542225555', NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2017-12-13 12:23:40', NULL),
(66, 2, 'Hshvvsgs', NULL, '1970-01-01', '47 years - 11 months - 13 days', 'MRN66', '', NULL, '', '9858855988', NULL, NULL, NULL, NULL, NULL, NULL, 1, 15, '2017-12-14 16:23:32', NULL),
(67, 2, 'Uip', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8888888888', NULL, NULL, 'M', NULL, NULL, NULL, NULL, 26, '2018-03-08 03:20:03', '192.168.1.12'),
(68, 2, 'qwer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7888888888', NULL, NULL, '788888', NULL, NULL, NULL, NULL, 26, '2018-03-08 03:29:34', '192.168.1.12'),
(69, 2, '787', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '787', NULL, NULL, '787', NULL, NULL, NULL, NULL, 26, '2018-03-08 03:34:28', '192.168.1.12'),
(70, 2, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, 26, '2018-03-09 02:20:15', '192.168.1.12'),
(71, 2, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, 26, '2018-03-09 02:20:31', '192.168.1.12'),
(72, 2, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, 26, '2018-03-09 02:43:37', '192.168.1.12'),
(73, 2, 'hhhj', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, 26, '2018-03-09 03:34:23', '192.168.1.61'),
(74, 2, 'hjhjh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, 26, '2018-03-09 03:34:39', '192.168.1.61'),
(75, 2, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11111', NULL, NULL, '1111', NULL, NULL, NULL, NULL, 26, '2018-03-09 03:43:50', '192.168.1.12'),
(76, 2, 'sdvcas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '87989898', NULL, NULL, '8989', NULL, NULL, NULL, NULL, 26, '2018-03-09 04:47:05', '192.168.1.12'),
(77, 2, '5655', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '56565', NULL, NULL, '565', NULL, NULL, NULL, NULL, 26, '2018-03-09 04:49:42', '192.168.1.12'),
(78, 2, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, 26, '2018-03-09 04:50:34', '192.168.1.12'),
(79, 2, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, 26, '2018-03-09 04:50:36', '192.168.1.12'),
(80, 2, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, 26, '2018-03-09 04:50:37', '192.168.1.12'),
(81, 2, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, 26, '2018-03-09 04:50:37', '192.168.1.12'),
(82, 2, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, 26, '2018-03-09 04:50:47', '192.168.1.12'),
(83, 2, 'jjk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7777777777', NULL, NULL, 'jk', NULL, NULL, NULL, NULL, 26, '2018-03-09 05:21:13', '192.168.1.12'),
(84, 2, 'UIOP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1111111111', NULL, NULL, '111', NULL, NULL, NULL, NULL, 26, '2018-03-09 06:25:20', '192.168.1.12'),
(85, 2, 'qwe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1222222222', NULL, NULL, '121', NULL, NULL, NULL, NULL, 26, '2018-03-10 05:11:33', '192.168.1.10'),
(86, 2, 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6666666666', NULL, NULL, 'test', NULL, NULL, NULL, NULL, 26, '2018-03-21 08:57:35', '192.168.1.12'),
(87, 2, 'fdq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8999999999', NULL, NULL, '898', NULL, NULL, NULL, NULL, 26, '2018-04-02 03:54:01', '192.168.1.20'),
(88, 2, 'op', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8777777777', NULL, NULL, '78787', NULL, NULL, NULL, NULL, 26, '2018-04-02 04:00:56', '192.168.1.20'),
(89, 2, 'uio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0999999999', NULL, NULL, '909', NULL, NULL, NULL, NULL, 26, '2018-04-02 04:03:49', '192.168.1.20'),
(90, 2, 'iiop', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7889797987', NULL, NULL, 'DOLO', NULL, NULL, NULL, NULL, 26, '2018-04-02 04:46:11', '192.168.1.20'),
(91, 2, '56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5565556556', NULL, NULL, '5', NULL, NULL, NULL, NULL, 26, '2018-04-02 04:49:29', '192.168.1.20'),
(92, 2, '899', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8899999999', NULL, NULL, '8989', NULL, NULL, NULL, NULL, 26, '2018-04-02 06:15:17', '192.168.1.20'),
(93, 2, 'Dolo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7979797979', NULL, NULL, 'dolo', NULL, NULL, NULL, NULL, 26, '2018-04-05 03:41:10', '192.168.1.16'),
(94, 2, 'dolo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7887877777', NULL, NULL, 'dolo', NULL, NULL, NULL, NULL, 26, '2018-04-05 03:43:43', '192.168.1.16'),
(95, 2, 'amirtha', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4444444445', NULL, NULL, 'lingam', NULL, NULL, NULL, NULL, 26, '2018-04-06 12:29:09', '192.168.1.13'),
(96, 2, 'amirtha', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4444444446', NULL, NULL, 'lingam', NULL, NULL, NULL, NULL, 26, '2018-04-06 12:34:25', '192.168.1.13'),
(97, 2, 'SIVAM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1656445612', NULL, NULL, 'SIVAM', NULL, NULL, NULL, NULL, 26, '2018-04-07 01:20:16', '192.168.1.13'),
(98, 2, 'WWW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7895653354', NULL, NULL, 'Ganapathy', NULL, NULL, NULL, NULL, 26, '2018-04-07 05:54:26', '192.168.1.13'),
(99, 2, 'Ert', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4656444444', NULL, NULL, 'RTR', NULL, NULL, NULL, NULL, 26, '2018-04-07 05:56:20', '192.168.1.13'),
(100, 2, 'tyu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4644545433', NULL, NULL, 'hjk', NULL, NULL, NULL, NULL, 26, '2018-04-07 05:57:24', '192.168.1.13'),
(101, 2, 'tyr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4373634948', NULL, NULL, '', NULL, NULL, NULL, NULL, 26, '2018-04-07 06:42:30', '192.168.1.13'),
(102, 2, 'popopo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, 26, '2018-04-07 06:46:00', '192.168.1.13'),
(103, 2, 'tirei', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, 26, '2018-04-08 01:25:06', '192.168.1.13'),
(104, 2, 'tyotyj', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, 26, '2018-04-08 01:27:21', '192.168.1.13'),
(105, 2, 'petrr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, 26, '2018-04-08 02:24:35', '192.168.1.13'),
(106, 2, 'doolo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, 26, '2018-04-08 02:58:09', '192.168.1.13'),
(107, 2, 'qwyt', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6326688', NULL, NULL, '8767', NULL, NULL, NULL, NULL, 26, '2018-04-08 03:53:46', '192.168.1.13'),
(108, 2, 'iuyg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7678876667', NULL, NULL, 'jk', NULL, NULL, NULL, NULL, 26, '2018-04-08 04:00:20', '192.168.1.13'),
(109, 2, 'Dedere', NULL, NULL, NULL, '123', NULL, NULL, NULL, '7765343434', NULL, NULL, NULL, 3, NULL, NULL, 1, 26, '2018-04-08 17:11:15', '192.168.1.21');

-- --------------------------------------------------------

--
-- Table structure for table `patienttype`
--

CREATE TABLE `patienttype` (
  `patient_typeid` int(11) NOT NULL,
  `patient_typename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patienttype`
--

INSERT INTO `patienttype` (`patient_typeid`, `patient_typename`) VALUES
(1, 'In Patient'),
(2, 'Out Patient');

-- --------------------------------------------------------

--
-- Table structure for table `paymenttype`
--

CREATE TABLE `paymenttype` (
  `payment_type_id` int(11) NOT NULL,
  `paymenttype` varchar(100) NOT NULL,
  `is_active` tinyint(3) NOT NULL,
  `updated_by` tinyint(3) NOT NULL,
  `updated_on` date NOT NULL,
  `updated_ipaddress` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymenttype`
--

INSERT INTO `paymenttype` (`payment_type_id`, `paymenttype`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1, 'MasterCard', 1, 26, '2017-09-13', '192.168.1.5'),
(2, 'Visa', 1, 26, '2017-09-11', '192.168.1.12'),
(3, 'Maestro', 1, 26, '2017-09-11', '192.168.1.12'),
(4, 'Rupay', 1, 26, '2017-09-11', '192.168.1.12'),
(5, 'Amex', 1, 26, '2017-09-11', '192.168.1.12'),
(6, 'Diners', 1, 26, '2017-09-11', '192.168.1.12'),
(7, 'DebitCard', 1, 26, '2017-09-11', '192.168.1.12');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `pm_autoid` bigint(20) NOT NULL,
  `methodname` varchar(250) NOT NULL,
  `methodkey` varchar(250) NOT NULL,
  `refundmode` varchar(250) NOT NULL,
  `methodorder` bigint(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`pm_autoid`, `methodname`, `methodkey`, `refundmode`, `methodorder`, `timestamp`) VALUES
(1, 'Cash Payment', 'cashpayment', 'Y', 1, '2017-03-10 19:34:26'),
(2, 'Card Payment', 'cardpayment', '', 2, '2017-02-14 15:48:21'),
(3, 'Customer Cheque', 'customercheque', 'Y', 3, '2017-03-10 19:34:30'),
(4, 'Paytm', 'paytm', '', 5, '2017-02-14 15:52:39'),
(5, 'RTGS/NEFT', 'rtgsneft', 'Y', 6, '2017-03-10 19:34:33'),
(6, 'Customer DD', 'customerdd', '', 4, '2017-02-14 15:52:35'),
(7, 'Discount Amount', 'discountamount', '', 1, '2017-02-22 19:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `physicianmaster`
--

CREATE TABLE `physicianmaster` (
  `id` int(100) NOT NULL,
  `physician_name` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `specialist` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `updatedby` varchar(20) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `updated_ipaddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `physicianmaster`
--

INSERT INTO `physicianmaster` (`id`, `physician_name`, `qualification`, `specialist`, `is_active`, `updatedby`, `updatedon`, `updated_ipaddress`) VALUES
(1, 'Sharma', 'M.D', 'Heart', 1, '26', '2017-09-01 17:27:40', '49.207.177.156'),
(2, 'Test1', 'TEST1', 'TEST Surgery1', 1, '26', '2017-12-29 12:08:35', '49.207.188.110');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productid` int(11) NOT NULL,
  `productname` varchar(100) NOT NULL,
  `product_typeid` varchar(20) NOT NULL,
  `sort_description` varchar(500) NOT NULL,
  `composition_id` varchar(100) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `minstock` bigint(20) NOT NULL,
  `reorderlevelstock` varchar(100) NOT NULL,
  `maxstock` bigint(20) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `hsn_code` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `updatedby` varchar(20) NOT NULL,
  `updatedon` datetime NOT NULL,
  `updated_ipaddress` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productid`, `productname`, `product_typeid`, `sort_description`, `composition_id`, `manufacturer_id`, `product_code`, `minstock`, `reorderlevelstock`, `maxstock`, `unit`, `hsn_code`, `is_active`, `updatedby`, `updatedon`, `updated_ipaddress`) VALUES
(1, 'BECLATE 200 ROTACAPS', '71', '', '1', 0, 'SC101', 10, '15', 20, 'Unit Not Available for this Product.', '', 1, '26', '2017-08-22 12:03:51', '49.206.117.149'),
(2, 'METROGYL DG', '77', 'METROGYL DG', '2', 0, 'SC102', 0, '5', 10, '1', '', 1, '26', '2017-08-24 10:15:14', '49.207.187.48'),
(3, 'MYOSPAZ', '53', 'MYOSPAZ', '3', 0, 'SC103', 0, '5', 10, '2', '', 1, '26', '2017-08-24 10:16:31', '49.207.187.48'),
(4, 'STREPSILS', '53', 'STREPSILS', '4', 0, 'SC104', 0, '5', 10, '2', '', 1, '26', '2017-08-24 10:17:21', '49.207.187.48'),
(5, 'APTIVATE', '54', 'APTIVATE', '5', 0, 'SC105', 0, '5', 10, '3', '', 1, '26', '2017-08-24 10:18:16', '49.207.187.48'),
(6, 'MEFLOC', '53', 'MEFLOC', '7', 0, 'SC106', 0, '5', 10, '2', '', 1, '26', '2017-08-24 10:23:09', '49.207.187.48'),
(7, 'Rantac 50mg/2ml', '57', 'Rantac 50mg/2ml', '9', 0, 'SC107', 10, '5', 20, '5', '', 1, '26', '2017-09-10 11:31:39', '49.207.187.48'),
(8, 'MAXERON', '53', 'MAXERON', '11', 0, 'SC108', 5, '5', 10, '2', '', 1, '26', '2017-08-24 10:26:23', '49.207.187.48'),
(9, 'Thyrox 25mcg', '53', 'Thyrox 25mcg', '12', 0, 'SC109', 10, '5', 20, '2', '', 1, '26', '2017-08-29 07:15:37', '49.248.229.83'),
(10, 'Thyrox 100mcg', '53', 'Thyrox 100mcg', '13', 0, 'SC110', 20, '15', 30, '2', '', 1, '26', '2017-08-29 07:20:04', '106.203.121.80'),
(11, 'Akt-4 Kit', '53', 'Akt-4 Kit', '14', 0, 'SC111', 10, '15', 20, '2', '', 1, '26', '2017-09-09 22:43:58', '49.207.187.48'),
(12, 'R-CINEX', '60', 'R-CINEX', '15', 0, 'SC112', 20, '15', 30, '6', '', 1, '26', '2017-08-24 10:29:16', '49.207.187.48'),
(13, 'Testovit Forte', '60', 'TESTOVIT FORTE', '16', 0, 'SC113', 20, '25', 40, '6', '', 1, '26', '2017-08-25 13:49:59', '49.207.187.48'),
(14, 'ZYNCET-D', '53', 'ZYNCET-D', '23', 0, 'SC114', 20, '10', 40, '2', '', 1, '26', '2017-08-25 11:03:09', '49.207.187.48'),
(15, 'DRONIS 30', '53', 'DRONIS 30', '98', 1, 'SC115', 0, '5', 20, '2', '000000000000', 1, '26', '2017-09-15 11:24:30', '49.207.177.156'),
(16, 'DILZEM CD 90mg', '60', 'DILZEM CD 90mg', '1993', 0, 'SC116', 0, '10', 20, '6', '', 1, '26', '2017-08-25 11:09:11', '49.207.187.48'),
(17, 'Dolo 650mg Tablet', '53', 'DOLO 650MG', '1994', 84, 'SC117', 20, '10', 40, '2', '30049000', 1, '36', '2017-09-24 23:29:42', '157.50.23.160'),
(18, 'Altacef 250mg Tablet', '53', 'Altacef 250mg', '1981', 63, 'SC118', 40, '45', 50, '2', '30049000', 1, '36', '2017-09-24 23:38:36', '157.50.23.160'),
(19, 'Ablife 100MG', '60', 'Ablife 100MG', '1982', 132, 'SC119', 20, '30', 40, '6', '30049000', 1, '36', '2017-09-24 23:37:35', '157.50.23.160'),
(20, 'Reeshape 120MG', '60', 'Reeshape 120MG', '1978', 0, 'SC120', 50, '75', 100, '6', '', 1, '26', '2017-08-25 11:33:33', '49.207.187.48'),
(21, 'Livogen-Z Captab', '53', 'Livogen-Z', '1976', 49, 'SC121', 40, '100', 50, '2', '30049000', 1, '36', '2017-09-24 23:44:13', '157.50.23.160'),
(22, 'Omnacortil 10mg', '53', 'Omnacortil 10mg', '1603', 0, 'SC122', 10, '15', 30, '2', '', 1, '26', '2017-08-25 11:41:08', '49.207.187.48'),
(23, 'Omnacortil 5mg', '53', 'Omnacortil 5mg', '601', 0, 'SC123', 20, '50', 40, '2', '', 1, '26', '2017-08-25 11:41:41', '49.207.187.48'),
(24, 'Omnacortil 20mg Tablet', '53', 'Omnacortil 20mg', '1973', 53, 'SC124', 50, '55', 60, '2', '30049000', 1, '36', '2017-09-24 23:52:08', '157.50.23.160'),
(25, 'Omnacortil 5mg/ml', '80', 'Omnacortil 5mg/ml', '225', 0, 'SC125', 50, '60', 70, '8', '', 1, '26', '2017-08-25 11:43:43', '49.207.187.48'),
(26, 'Chymonac', '53', 'Chymonac', '1687', 0, 'SC126', 40, '100', 50, '2', '', 1, '26', '2017-08-25 11:49:33', '49.207.187.48'),
(27, 'Chymoral-AP', '53', 'Chymoral-AP', '1571', 0, 'SC127', 20, '30', 40, '2', '', 1, '26', '2017-08-25 11:51:13', '49.207.187.48'),
(28, 'Zerodol-SP', '53', 'Zerodol-SP', '286', 0, 'SC128', 40, '50', 60, '2', '', 1, '26', '2017-08-25 12:02:20', '49.207.187.48'),
(29, 'Zerodol-P', '53', 'Zerodol-P', '82', 0, 'SC129', 50, '45', 60, '2', '', 1, '26', '2017-08-25 12:05:24', '49.207.187.48'),
(30, 'Zerodol-MR', '53', 'Zerodol-MR', '1189', 0, 'SC130', 30, '100', 40, '2', '', 1, '26', '2017-08-25 12:07:07', '49.207.187.48'),
(31, 'Zerodol 100mg', '53', 'Zerodol 100mg', '81', 0, 'SC131', 20, '50', 40, '2', '', 1, '26', '2017-08-25 12:08:04', '49.207.187.48'),
(32, 'Zerodol 200mg CR', '53', 'Zerodol CR', '1367', 0, 'SC132', 30, '50', 40, '2', '', 1, '26', '2017-08-25 12:09:13', '49.207.187.48'),
(33, 'Zerodol PT', '53', 'Zerodol PT', '1995', 0, 'SC133', 40, '50', 70, '2', '', 1, '26', '2017-08-25 12:12:14', '49.207.187.48'),
(34, 'Zymor-AP', '53', 'Zymor-AP', '1687', 0, 'SC134', 40, '50', 60, '2', '', 1, '26', '2017-08-25 12:14:38', '49.207.187.48'),
(35, 'Herpikind 800mg', '53', 'Herpikind 800mg', '342', 0, 'SC135', 40, '60', 50, '2', '', 1, '26', '2017-08-25 12:31:25', '49.207.187.48'),
(36, 'Herpikind 400mg', '53', 'Herpikind 400mg', '34', 10, 'SC136', 0, '0', 0, '2', '30049000', 1, '26', '2017-09-17 10:41:26', '49.207.184.10'),
(37, 'Herpikind 5%', '77', 'Herpikind 5%', '309', 0, 'SC137', 0, '0', 0, '1', '', 1, '26', '2017-08-25 12:32:48', '49.207.187.48'),
(38, 'Herpikind 200mg', '53', 'Herpikind 200mg', '119', 0, 'SC138', 0, '0', 0, '2', '', 1, '26', '2017-08-25 12:33:21', '49.207.187.48'),
(39, 'Acivir 25mg/ml', '57', 'Acivir 25mg/ml', '418', 0, 'SC139', 0, '0', 0, '5', '', 1, '26', '2017-08-25 12:36:22', '49.207.187.48'),
(40, 'Acivir 400mg DT', '53', 'Acivir 400mg', '34', 0, 'SC140', 0, '0', 0, '2', '', 1, '26', '2017-08-25 12:37:07', '49.207.187.48'),
(41, 'Acivir 200mg DT', '53', 'Acivir 200mg', '119', 0, 'SC141', 0, '0', 0, '2', '', 1, '26', '2017-08-25 12:38:03', '49.207.187.48'),
(42, 'Acivir 3% W/w', '77', 'Acivir 3% w/w', '356', 0, 'SC142', 0, '0', 0, '1', '', 1, '26', '2017-08-25 12:39:35', '49.207.187.48'),
(43, 'Herperax 800mg', '53', 'Herperax 800mg', '342', 0, 'SC143', 0, '0', 0, '2', '', 1, '26', '2017-08-25 12:40:52', '49.207.187.48'),
(44, 'Herperax 400mg', '53', 'Herperax 400mg', '34', 0, 'SC144', 0, '0', 0, '2', '', 1, '26', '2017-08-25 12:41:25', '49.207.187.48'),
(45, 'Herperax 5% W/w', '77', 'Herperax 5% w/w', '627', 0, 'SC145', 0, '0', 0, '1', '', 1, '26', '2017-08-25 12:42:02', '49.207.187.48'),
(46, 'Herperax 200mg', '53', 'Herperax 200mg', '119', 0, 'SC146', 0, '0', 0, '2', '', 1, '26', '2017-08-25 12:42:33', '49.207.187.48'),
(47, 'Zovirax 400mg', '53', 'Zovirax 400mg', '34', 0, 'SC147', 0, '0', 0, '2', '', 1, '26', '2017-08-25 12:44:44', '49.207.187.48'),
(48, 'Zovirax 400mg S', '79', 'Zovirax 400mg', '34', 0, 'SC148', 0, '0', 0, '9', '', 1, '26', '2017-08-25 12:46:52', '49.207.187.48'),
(49, 'Blumox P 125mg', '53', 'Blumox P 125mg', '1000', 0, 'SC149', 0, '0', 0, '2', '', 1, '26', '2017-08-25 12:53:08', '49.207.187.48'),
(50, 'Blumox 250mg DT', '53', 'Blumox 250mg', '50', 0, 'SC150', 0, '0', 0, '2', '', 1, '26', '2017-08-25 12:53:44', '49.207.187.48'),
(51, 'Novamox 125mg', '54', 'Novamox 125mg', '1000', 0, 'SC151', 0, '0', 0, '3', '', 1, '26', '2017-08-25 12:58:15', '49.207.187.48'),
(52, 'Novamox 100 Rediuse', '80', 'Novamox 100 Rediuse', '1025', 0, 'SC152', 0, '0', 0, '8', '', 1, '26', '2017-08-25 13:00:29', '49.207.187.48'),
(53, 'Augpen 300mg', '57', 'Augpen 300mg', '1728', 0, 'SC153', 0, '0', 0, '5', '', 1, '26', '2017-08-25 13:04:10', '49.207.187.48'),
(54, 'Augpen DS 400 Mg/57 Mg', '79', 'Augpen DS 400 mg/57 mg', '1751', 0, 'SC154', 0, '0', 0, '9', '', 1, '26', '2017-08-25 13:07:01', '49.207.187.48'),
(55, 'Acuclav 625', '53', 'Acuclav 625', '877', 0, 'SC155', 0, '0', 0, '2', '', 1, '26', '2017-08-25 13:10:08', '49.207.187.48'),
(56, 'Acuclav DS', '54', 'Acuclav DS', '1751', 0, 'SC156', 0, '0', 0, '3', '', 1, '26', '2017-08-25 13:11:54', '49.207.187.48'),
(57, 'Zolfresh 10mg', '53', 'Zolfresh 10mg', '849', 0, 'SC157', 0, '0', 0, '2', '', 1, '26', '2017-08-25 13:15:47', '49.207.187.48'),
(58, 'Zolfresh 5mg', '53', 'Zolfresh 5mg', '826', 0, 'SC158', 0, '0', 0, '2', '', 1, '26', '2017-08-25 13:16:18', '49.207.187.48'),
(59, 'Ascazin', '53', 'Ascazin', '40', 0, 'SC159', 0, '0', 0, '2', '', 1, '26', '2017-08-25 13:19:40', '49.207.187.48'),
(60, 'Zincovit', '53', 'Zincovit', '40', 0, 'SC160', 0, '0', 0, '2', '', 1, '26', '2017-08-25 13:20:54', '49.207.187.48'),
(61, 'Ascazin 20mg', '81', 'Ascazin 20mg', '40', 0, 'SC161', 0, '0', 0, '10', '', 1, '26', '2017-08-25 13:25:17', '49.207.187.48'),
(62, 'Ascazin 10mg', '81', 'Ascazin 10mg', '40', 0, 'SC162', 0, '0', 0, '10', '', 1, '26', '2017-08-25 13:25:54', '49.207.187.48'),
(63, 'Zincovit D', '80', 'Zincovit', '40', 0, 'SC163', 0, '0', 0, '8', '', 1, '26', '2017-08-25 13:30:39', '49.207.187.48'),
(64, 'Zincovit S', '54', 'Zincovit', '40', 0, 'SC164', 0, '0', 0, '3', '', 1, '26', '2017-08-25 13:31:32', '49.207.187.48'),
(65, 'Folinz', '53', 'Folinz', '40', 0, 'SC165', 0, '0', 0, '2', '', 1, '26', '2017-08-25 13:32:23', '49.207.187.48'),
(66, 'ZN 20', '54', 'ZN 20', '40', 0, 'SC166', 0, '0', 0, '3', '', 1, '26', '2017-08-25 13:33:39', '49.207.187.48'),
(67, 'Z&D DS 20', '79', 'Z&D DS 20', '40', 0, 'SC167', 0, '0', 0, '9', '', 1, '26', '2017-08-25 13:34:56', '49.207.187.48'),
(68, 'Complamina Retard 500mg', '53', 'Complamina Retard 500mg', '269', 0, 'SC168', 0, '0', 0, '2', '', 1, '26', '2017-08-25 13:38:17', '49.207.187.48'),
(69, 'Voglistar 0.2mg', '53', 'Voglistar 0.2mg', '1355', 0, 'SC169', 0, '0', 0, '2', '', 1, '26', '2017-08-25 13:40:29', '49.207.187.48'),
(70, 'Voglistar 0.3mg', '53', 'Voglistar 0.3mg', '1091', 0, 'SC170', 0, '0', 0, '2', '', 1, '26', '2017-08-25 13:42:07', '49.207.187.48'),
(71, 'Moov 25gm', '77', 'Moov', '70', 0, 'SC171', 0, '0', 0, '1', '', 1, '26', '2017-08-25 13:44:19', '49.207.187.48'),
(72, 'Moov 15gm', '77', 'Moov', '70', 0, 'SC172', 0, '0', 0, '1', '', 1, '26', '2017-08-25 13:45:47', '49.207.187.48'),
(73, 'Moov 5gm', '77', 'Moov', '70', 0, 'SC173', 0, '0', 0, '1', '', 1, '26', '2017-08-25 13:46:41', '49.207.187.48'),
(74, 'Fourts B Drop', '80', 'Fourts B', '1977', 106, 'SC174', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-24 23:43:07', '157.50.23.160'),
(75, 'Vansafe CP 500mg', '57', 'Vansafe CP 500mg', '1640', 0, 'SC175', 0, '0', 0, '5', '', 1, '26', '2017-08-25 21:44:17', '49.207.187.48'),
(76, 'Epidosin 8mg', '57', 'Epidosin 8mg', '429', 0, 'SC176', 0, '0', 0, '5', '', 1, '26', '2017-08-25 21:47:45', '49.207.187.48'),
(77, 'Valosin 8mg Injection', '57', 'Valosin 8mg', '429', 83, 'SC177', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-24 23:53:09', '157.50.23.160'),
(78, 'Nsf 3 Tablet', '53', 'Nsf 3', '1958', 42, 'SC178', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-25 00:20:22', '157.50.23.160'),
(79, 'Zyvec 10 Mg', '57', 'Zyvec 10 mg', '1333', 0, 'SC179', 0, '0', 0, '5', '', 1, '26', '2017-08-25 22:03:35', '49.207.187.48'),
(80, 'Udiliv 300mg', '53', 'Udiliv 300mg', '177', 0, 'SC180', 0, '0', 0, '2', '', 1, '26', '2017-08-25 22:16:24', '49.207.187.48'),
(81, 'Udiliv 150mg', '53', 'Udiliv 150mg', '1339', 0, 'SC181', 0, '0', 0, '2', '', 1, '26', '2017-08-25 22:18:20', '49.207.187.48'),
(82, 'Udimarin Forte SR 450mg', '53', 'Udimarin Forte SR 450mg', '1996', 0, 'SC182', 0, '0', 0, '2', '', 1, '26', '2017-08-25 22:27:00', '49.207.187.48'),
(83, 'Actiheal-D', '53', 'Actiheal-D', '1430', 0, 'SC183', 0, '0', 0, '2', '', 1, '26', '2017-08-25 22:31:23', '49.207.187.48'),
(84, 'Chymoral Forte -DS', '53', 'Chymoral Forte -DS', '1217', 0, 'SC184', 0, '0', 0, '2', '', 1, '26', '2017-08-25 22:33:11', '49.207.187.48'),
(85, 'Enzomac Plus', '53', 'Enzomac Plus', '1430', 0, 'SC185', 0, '0', 0, '2', '', 1, '26', '2017-08-25 22:34:27', '49.207.187.48'),
(86, 'Chymoral Forte', '53', 'Chymoral Forte', '535', 0, 'SC186', 0, '0', 0, '2', '', 1, '26', '2017-08-25 22:35:47', '49.207.187.48'),
(87, 'IntiWash', '81', 'IntiWash', '1039', 0, 'SC187', 0, '0', 0, '10', '', 1, '26', '2017-08-25 22:42:00', '49.207.187.48'),
(88, 'Genwash Vaginal Wash', '81', 'Genwash', '1039', 0, 'SC188', 0, '0', 0, '10', '', 1, '26', '2017-08-25 22:43:15', '49.207.187.48'),
(89, 'Chymomax', '53', 'Chymomax', '1638', 0, 'SC189', 0, '0', 0, '2', '', 1, '26', '2017-08-25 22:47:24', '49.207.187.48'),
(90, 'Chymoral-BR', '53', 'Chymoral-BR', '1279', 0, 'SC190', 0, '0', 0, '2', '', 1, '26', '2017-08-25 22:50:30', '49.207.187.48'),
(91, 'Pacitane 2mg', '53', 'Pacitane 2mg', '87', 0, 'SC191', 0, '0', 0, '2', '', 1, '26', '2017-08-25 22:53:27', '49.207.187.48'),
(92, 'Pedicloryl 500mg', '54', 'Pedicloryl 500mg', '244', 0, 'SC192', 0, '0', 0, '3', '', 1, '26', '2017-08-25 23:03:48', '49.207.187.48'),
(93, 'Espazine 5mg', '53', 'Espazine 5mg', '648', 0, 'SC193', 0, '0', 0, '2', '', 1, '26', '2017-08-25 23:05:01', '49.207.187.48'),
(94, 'Hemolit', '55', 'Hemolit', '1979', 0, 'SC194', 0, '0', 0, '7', '', 1, '26', '2017-08-25 23:07:53', '49.207.187.48'),
(95, 'Trapic E', '53', 'Trapic E', '377', 0, 'SC195', 0, '0', 0, '2', '', 1, '26', '2017-08-25 23:13:14', '49.207.187.48'),
(96, 'Trapic 650mg', '53', 'Trapic 650mg', '376', 0, 'SC196', 0, '0', 0, '2', '', 1, '26', '2017-08-25 23:14:00', '49.207.187.48'),
(97, 'Xamic 500mg', '53', 'Xamic 500mg', '1417', 0, 'SC197', 0, '0', 0, '2', '', 1, '26', '2017-08-25 23:17:11', '49.207.187.48'),
(98, 'Trapic 500mg', '53', 'Trapic 500mg', '1417', 0, 'SC198', 0, '0', 0, '2', '', 1, '26', '2017-08-25 23:19:41', '49.207.187.48'),
(99, 'Trapic MF', '53', 'Trapic MF', '88', 0, 'SC199', 0, '0', 0, '2', '', 1, '26', '2017-08-25 23:20:45', '49.207.187.48'),
(100, 'Xamic 500mg INJ', '57', 'Xamic 500mg INJ', '1417', 0, 'SC200', 0, '0', 0, '5', '', 1, '26', '2017-08-25 23:21:51', '49.207.187.48'),
(101, 'Tranlok 500mg', '57', 'Tranlok 500mg', '1417', 0, 'SC201', 0, '0', 0, '5', '', 1, '26', '2017-08-25 23:22:37', '49.207.187.48'),
(102, 'Transpace MF', '53', 'Transpace MF', '88', 0, 'SC202', 0, '0', 0, '2', '', 1, '26', '2017-08-25 23:24:10', '49.207.187.48'),
(103, 'Kenacort 0.1% W/w', '82', 'Kenacort 0.1% w/w', '94', 0, 'SC203', 0, '0', 0, '11', '', 1, '26', '2017-08-25 23:31:42', '49.207.187.48'),
(104, 'Kenacort 10mg', '57', 'Kenacort 10mg', '510', 0, 'SC204', 0, '0', 0, '5', '', 1, '26', '2017-08-25 23:33:17', '49.207.187.48'),
(105, 'Kenacort 40mg', '57', 'Kenacort 40mg', '1030', 0, 'SC205', 0, '0', 0, '5', '', 1, '26', '2017-08-25 23:35:50', '49.207.187.48'),
(106, 'Thyrox - 12.5', '53', 'Thyrox - 12.5', '1306', 0, 'SC206', 0, '0', 0, '2', '', 1, '26', '2017-08-29 07:21:04', '106.203.121.80'),
(107, 'Thyrox - 150', '53', 'Thyrox - 150', '847', 0, 'SC207', 0, '0', 0, '2', '', 1, '26', '2017-08-29 07:21:59', '106.203.121.80'),
(108, 'Thyrox 75mcg', '53', 'Thyrox 75mcg', '1369', 0, 'SC208', 0, '0', 0, '2', '', 1, '26', '2017-08-29 07:22:55', '106.203.121.80'),
(109, 'Thyrox 125mcg', '53', 'Thyrox 125mcg', '1602', 0, 'SC209', 0, '0', 0, '2', '', 1, '26', '2017-08-29 07:24:08', '106.203.121.80'),
(110, 'Thyrox 50mcg', '53', 'Thyrox 50mcg', '1830', 0, 'SC210', 0, '0', 0, '2', '', 1, '26', '2017-08-29 07:25:05', '106.203.121.80'),
(111, 'Drotin-M', '53', 'Drotin-M', '1459', 0, 'SC211', 0, '0', 0, '2', '', 1, '26', '2017-08-29 07:28:45', '106.203.121.80'),
(112, 'Drotin 40mg', '53', 'Drotin 40mg', '1149', 0, 'SC212', 0, '0', 0, '2', '', 1, '26', '2017-08-29 07:29:40', '106.203.121.80'),
(113, 'Drotin Plus', '53', 'Drotin Plus', '948', 0, 'SC213', 0, '0', 0, '2', '', 1, '26', '2017-08-29 07:30:39', '106.203.121.80'),
(114, 'Drotin 40mg INJ', '57', 'Drotin 40mg INJ', '1149', 0, 'SC214', 0, '0', 0, '5', '', 1, '26', '2017-08-29 07:34:22', '106.203.121.80'),
(115, 'Drotin A', '53', 'Drotin A', '946', 0, 'SC215', 0, '0', 0, '2', '', 1, '26', '2017-08-29 07:35:48', '106.203.121.80'),
(116, 'Drotin DS 80mg', '53', 'Drotin DS 80mg', '789', 0, 'SC216', 0, '0', 0, '2', '', 1, '26', '2017-08-29 07:37:03', '106.203.121.80'),
(117, 'Drotikind M 80 Mg/250 Mg', '53', 'Drotikind M 80 mg/250 mg', '1459', 0, 'SC217', 0, '0', 0, '2', '', 1, '26', '2017-08-29 07:39:42', '106.203.121.80'),
(118, 'Zerodol Spas 80 Mg/100 Mg', '53', 'Zerodol Spas 80 mg/100 mg', '946', 0, 'SC218', 0, '0', 0, '2', '', 1, '26', '2017-08-29 07:40:44', '106.203.121.80'),
(119, 'Betnesol 0.5mg Drop', '80', 'Betnesol 0.5mg', '51', 0, 'SC219', 0, '0', 0, '8', '', 1, '26', '2017-08-29 07:48:54', '106.203.121.80'),
(120, 'Betnesol-N', '80', 'Betnesol-N', '49', 0, 'SC220', 0, '0', 0, '8', '', 1, '26', '2017-08-29 07:46:02', '106.203.121.80'),
(121, 'Betnesol 0.5mg', '53', 'Betnesol 0.5mg', '51', 0, 'SC221', 0, '0', 0, '2', '', 1, '26', '2017-08-29 07:49:12', '106.203.121.80'),
(122, 'Betnesol 1mg Forte', '53', 'Betnesol 1mg Forte', '181', 0, 'SC222', 0, '0', 0, '2', '', 1, '26', '2017-08-29 07:50:38', '106.203.121.80'),
(123, 'Betnesol 4mg INJ', '57', 'Betnesol 4mg INJ', '660', 8, 'SC223', 0, '0', 0, '5', '30043200', 1, '26', '2017-10-18 14:15:56', '49.207.184.24'),
(124, 'Quadriderm AF', '55', 'Quadriderm AF', '769', 0, 'SC224', 0, '0', 0, '7', '', 1, '26', '2017-08-30 10:14:13', '180.151.35.68'),
(125, 'Diprovate Plus', '52', 'Diprovate Plus', '589', 0, 'SC225', 0, '0', 0, '4', '', 1, '26', '2017-08-30 10:18:18', '180.151.35.68'),
(126, 'Wikoryl L', '53', 'Wikoryl L', '888', 0, 'SC226', 0, '0', 0, '2', '', 1, '26', '2017-09-09 11:52:58', '49.207.187.48'),
(127, 'Pacimol Active', '53', 'Pacimol Active', '992', 0, 'SC227', 0, '0', 0, '2', '', 1, '26', '2017-09-09 11:54:26', '49.207.187.48'),
(128, 'Crocin', '53', 'Paracetemol', '3', 0, 'SC228', 100, '200', 1000, '12', '', 1, '26', '2017-09-09 11:56:53', '49.207.177.156'),
(129, 'Migranil EC 100mg/1mg/250mg/10mg', '53', 'Migranil EC', '1244', 0, 'SC228', 0, '0', 0, '2', '', 1, '26', '2017-09-09 11:57:14', '49.207.187.48'),
(130, 'Vasograin', '53', 'Vasograin', '1385', 0, 'SC230', 0, '0', 0, '2', '', 1, '26', '2017-09-09 11:58:20', '49.207.187.48'),
(131, 'Caladryl 50ml', '52', 'Caladryl Lotion', '555', 0, 'SC231', 0, '0', 0, '4', '', 1, '26', '2017-09-09 12:04:48', '49.207.187.48'),
(132, 'Caladryl 120ml', '52', 'Caladryl Lotion', '555', 0, 'SC232', 0, '0', 0, '4', '', 1, '26', '2017-09-09 12:05:48', '49.207.187.48'),
(133, 'Calapure A 100ml', '52', 'Calapure A', '639', 0, 'SC233', 0, '0', 0, '4', '', 1, '26', '2017-09-09 12:29:11', '49.207.187.48'),
(134, 'Calapure A 50ml', '52', 'Calapure A', '639', 0, 'SC234', 0, '0', 0, '4', '', 1, '26', '2017-09-09 12:29:42', '49.207.187.48'),
(135, 'Calora 100ml', '52', 'Calora', '1768', 0, 'SC235', 0, '0', 0, '4', '', 1, '26', '2017-09-09 12:31:56', '49.207.187.48'),
(136, 'Calora 60ml', '52', 'Calora', '1768', 0, 'SC236', 0, '0', 0, '4', '', 1, '26', '2017-09-09 12:32:33', '49.207.187.48'),
(137, 'Calcimax Forte Plus', '53', 'Calcimax Forte Plus', '1594', 0, 'SC237', 0, '0', 0, '2', '', 1, '26', '2017-09-09 12:36:26', '49.207.187.48'),
(138, 'Rashfree', '55', 'Rashfree', '481', 0, 'SC238', 0, '0', 0, '7', '', 1, '26', '2017-09-09 12:40:25', '49.207.187.48'),
(139, 'Happy Nap', '55', 'Happy Nap', '481', 0, 'SC239', 0, '0', 0, '7', '', 1, '26', '2017-09-09 12:48:37', '49.207.187.48'),
(140, 'Enzomac', '53', 'Enzomac', '777', 0, 'SC240', 0, '0', 0, '2', '', 1, '26', '2017-09-09 12:52:29', '49.207.187.48'),
(141, 'Enzomac Ointment', '55', 'Enzomac Ointment', '1045', 0, 'SC241', 0, '0', 0, '7', '', 1, '26', '2017-09-09 12:54:16', '49.207.187.48'),
(142, 'Rutoheal', '53', 'Rutoheal', '777', 0, 'SC242', 0, '0', 0, '2', '', 1, '26', '2017-09-09 12:56:13', '49.207.187.48'),
(143, 'Chymoral Plus 50 Mg/50000 AU', '53', 'Chymoral Plus 50 mg/50000 AU', '1667', 0, 'SC243', 0, '0', 0, '2', '', 1, '26', '2017-09-09 13:02:43', '49.207.187.48'),
(144, 'Bludrox 500mg', '53', 'Bludrox 500mg', '934', 0, 'SC244', 0, '0', 0, '2', '', 1, '26', '2017-09-09 13:09:24', '49.207.187.48'),
(145, 'Sporidex 500mg', '60', 'Sporidex 500mg', '68', 0, 'SC245', 0, '0', 0, '6', '', 1, '26', '2017-09-09 13:12:38', '49.207.187.48'),
(146, 'Sporidex 250mg', '53', 'Sporidex 250mg', '1172', 0, 'SC246', 0, '0', 0, '2', '', 1, '26', '2017-09-09 13:13:49', '49.207.187.48'),
(147, 'Sporidex 125mg', '53', 'Sporidex 125mg', '148', 0, 'SC247', 0, '0', 0, '2', '', 1, '26', '2017-09-09 13:15:40', '49.207.187.48'),
(148, 'Sporidex 125mg Syrup', '54', 'Sporidex 125mg Syrup', '148', 0, 'SC248', 0, '0', 0, '3', '', 1, '26', '2017-09-09 13:16:39', '49.207.187.48'),
(149, 'Sporidex 250mg Syrup', '54', 'Sporidex 250mg Syrup', '1172', 0, 'SC249', 0, '0', 0, '3', '', 1, '26', '2017-09-09 13:17:46', '49.207.187.48'),
(150, 'Sporidex-AF 375mg', '53', 'Sporidex-AF 375mg', '1531', 0, 'SC250', 0, '0', 0, '2', '', 1, '26', '2017-09-09 13:18:53', '49.207.187.48'),
(151, 'Sporidex Redimix 100mg', '80', 'Sporidex Redimix 100mg', '175', 0, 'SC251', 0, '0', 0, '8', '', 1, '26', '2017-09-09 13:20:02', '49.207.187.48'),
(152, 'Phexin 500mg', '60', 'Phexin 500mg', '68', 0, 'SC252', 0, '0', 0, '6', '', 1, '26', '2017-09-09 13:22:01', '49.207.187.48'),
(153, 'Phexin 250mg', '53', 'Phexin 250mg', '1172', 0, 'SC253', 0, '0', 0, '2', '', 1, '26', '2017-09-09 13:23:13', '49.207.187.48'),
(154, 'Phexin Kid 125mg', '53', 'Phexin Kid 125mg', '148', 0, 'SC254', 0, '0', 0, '2', '', 1, '26', '2017-09-09 13:24:26', '49.207.187.48'),
(155, 'Phexin Pead 100mg', '80', 'Phexin Pead 100mg', '175', 0, 'SC255', 0, '0', 0, '8', '', 1, '26', '2017-09-09 13:26:18', '49.207.187.48'),
(156, 'Met', '84', 'Test', '1998', 0, 'SC256', 100, '200', 800, '13', '', 1, '33', '2017-09-09 15:11:56', '49.207.177.156'),
(157, 'Norflox 400mg Tablet', '53', 'Norflox 400mg', '390', 1, 'SC257', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-20 14:28:10', '157.50.8.207'),
(158, 'Norflox 200mg', '53', 'Norflox 200mg', '73', 0, 'SC258', 0, '0', 0, '2', '', 1, '26', '2017-09-09 17:31:05', '49.207.187.48'),
(159, 'Norflox TZ LB', '53', 'Norflox TZ LB', '542', 0, 'SC259', 0, '0', 0, '2', '', 1, '26', '2017-09-09 17:33:10', '49.207.187.48'),
(160, 'Norflox TZ', '53', 'Norflox TZ', '1882', 0, 'SC260', 0, '0', 0, '2', '', 1, '26', '2017-09-09 17:34:37', '49.207.187.48'),
(161, 'Norflokem TZ', '53', 'Norflokem TZ', '1999', 0, 'SC261', 0, '0', 0, '2', '', 1, '26', '2017-09-09 17:36:29', '49.207.187.48'),
(162, 'Epripride 150 Mg', '53', 'Epripride 150 mg', '1005', 0, 'SC262', 0, '0', 0, '2', '', 1, '26', '2017-09-09 17:39:37', '49.207.187.48'),
(163, 'Lyser DP', '53', 'Lyser DP', '1405', 0, 'SC263', 0, '0', 0, '2', '', 1, '26', '2017-09-09 17:41:37', '49.207.187.48'),
(164, 'Anaspas 25mg', '57', 'Anaspas 25mg', '994', 0, 'SC264', 0, '0', 0, '5', '', 1, '26', '2017-09-09 17:43:01', '49.207.187.48'),
(165, 'Spasmo Proxyvon Forte', '57', 'Spasmo Proxyvon Forte', '345', 0, 'SC265', 0, '0', 0, '5', '', 1, '26', '2017-09-09 17:44:52', '49.207.187.48'),
(166, 'Dolokind Aqua 75mg', '57', 'Dolokind Aqua 75mg', '838', 0, 'SC266', 0, '0', 0, '5', '', 1, '26', '2017-09-09 17:46:00', '49.207.187.48'),
(167, 'Anaspas 50 Mg/50 Mg', '53', 'Anaspas 50 mg/50 mg', '762', 0, 'SC267', 0, '0', 0, '2', '', 1, '26', '2017-09-09 17:47:23', '49.207.187.48'),
(168, 'Voveran SR 100mg', '53', 'Voveran SR 100mg', '672', 0, 'SC268', 0, '0', 0, '2', '', 1, '26', '2017-09-09 17:54:37', '49.207.187.48'),
(169, 'Spasmo Proxyvon', '60', 'Spasmo Proxyvon', '305', 0, 'SC269', 0, '0', 0, '6', '', 1, '26', '2017-09-09 17:58:09', '49.207.187.48'),
(170, 'Volini', '72', 'Volini', '1335', 0, 'SC270', 0, '0', 0, '14', '', 1, '26', '2017-09-09 18:05:35', '49.207.187.48'),
(171, 'Fensupp 100mg', '53', 'Fensupp 100mg', '1280', 0, 'SC271', 0, '0', 0, '2', '', 1, '26', '2017-09-09 18:12:17', '49.207.187.48'),
(172, 'Diclomove Plus', '72', 'Diclomove Plus', '95', 0, 'SC272', 0, '0', 0, '14', '', 1, '26', '2017-09-09 18:13:11', '49.207.187.48'),
(173, 'R-Cin 450mg', '53', 'R-Cin 450mg', '959', 0, 'SC273', 0, '0', 0, '2', '', 1, '26', '2017-09-09 22:36:51', '49.207.187.48'),
(174, 'R-Cin 600mg', '53', 'R-Cin 600mg', '985', 0, 'SC274', 0, '0', 0, '2', '', 1, '26', '2017-09-09 22:38:05', '49.207.187.48'),
(175, 'R-Cin 300mg', '60', 'R-Cin 300mg', '2000', 0, 'SC275', 0, '0', 0, '6', '', 1, '26', '2017-09-09 22:39:24', '49.207.187.48'),
(176, 'Akt-2', '53', 'Akt-2', '15', 0, 'SC276', 0, '0', 0, '2', '', 1, '26', '2017-09-09 22:45:20', '49.207.187.48'),
(177, 'Macox-ZH', '53', 'Macox-ZH', '279', 0, 'SC277', 0, '0', 0, '2', '', 1, '26', '2017-09-09 22:49:04', '49.207.187.48'),
(178, 'Macox-ZH Kid Tablet DT', '53', 'Macox-ZH Kid', '514', 53, 'SC278', 0, '0', 0, '2', '30049057', 1, '26', '2017-10-18 14:14:09', '49.207.184.24'),
(179, 'Solonex 300mg Tablet', '53', 'Solonex 300mg', '458', 53, 'SC279', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-21 09:54:50', '157.50.10.184'),
(180, 'Solonex DT 100mg', '53', 'Solonex DT 100mg', '576', 0, 'SC280', 0, '0', 0, '2', '', 1, '26', '2017-09-09 22:52:45', '49.207.187.48'),
(181, 'Isokin 300 Mg/10 Mg', '53', 'Isokin 300 mg/10 mg', '1245', 0, 'SC281', 0, '0', 0, '2', '', 1, '26', '2017-09-09 22:54:01', '49.207.187.48'),
(182, 'Biotax O 100mg Tablet', '53', 'Biotax O 100mg', '1075', 43, 'SC282', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-20 14:04:36', '157.50.8.207'),
(183, 'Biotax O 200mg', '53', 'Biotax O 200mg', '1382', 0, 'SC283', 0, '0', 0, '2', '', 1, '26', '2017-09-09 23:00:08', '49.207.187.48'),
(184, 'Biotax OF', '53', 'Biotax OF', '1785', 0, 'SC284', 0, '0', 0, '2', '', 1, '26', '2017-09-09 23:02:56', '49.207.187.48'),
(185, 'Biotax 250mg', '57', 'Biotax 250mg', '273', 0, 'SC285', 0, '0', 0, '5', '', 1, '26', '2017-09-09 23:05:17', '49.207.187.48'),
(186, 'Biotax 1gm', '57', 'Biotax 1gm', '373', 0, 'SC286', 0, '0', 0, '5', '', 1, '26', '2017-09-09 23:10:08', '49.207.187.48'),
(187, 'Biotax O 50mg', '54', 'Biotax O 50mg', '1298', 0, 'SC287', 0, '0', 0, '3', '', 1, '26', '2017-09-09 23:11:17', '49.207.187.48'),
(188, 'Cefolac 100mg', '54', 'Cefolac 100mg', '1075', 0, 'SC288', 0, '0', 0, '3', '', 1, '26', '2017-09-09 23:12:42', '49.207.187.48'),
(189, 'Ceftas CL 200mg', '53', 'Ceftas CL 200mg', '1158', 0, 'SC289', 0, '0', 0, '2', '', 1, '26', '2017-09-09 23:15:26', '49.207.187.48'),
(190, 'Ceftas CV 200 Mg/125 Mg', '53', 'Ceftas CV 200 mg/125 mg', '1175', 0, 'SC290', 0, '0', 0, '2', '', 1, '26', '2017-09-09 23:17:36', '49.207.187.48'),
(191, 'Lizokef', '53', 'Lizokef', '1685', 0, 'SC291', 0, '0', 0, '2', '', 1, '26', '2017-09-09 23:18:51', '49.207.187.48'),
(192, 'Laz 250mg', '53', 'Laz 250mg', '1845', 0, 'SC292', 0, '0', 0, '2', '', 1, '26', '2017-09-09 23:20:25', '49.207.187.48'),
(193, 'Milixim Turbo', '53', 'Milixim Turbo', '1685', 0, 'SC293', 0, '0', 0, '2', '', 1, '26', '2017-09-09 23:23:59', '49.207.187.48'),
(194, 'Taxim O', '54', 'Taxim O', '1298', 0, 'SC294', 0, '0', 0, '3', '', 1, '26', '2017-09-09 23:25:02', '49.207.187.48'),
(195, 'Taxim O 25mg', '80', 'Taxim O 25mg', '765', 0, 'SC295', 0, '0', 0, '8', '', 1, '26', '2017-09-09 23:26:34', '49.207.187.48'),
(196, 'Inderal 40mg', '53', 'Inderal 40mg', '270', 0, 'SC296', 0, '0', 0, '2', '', 1, '26', '2017-09-10 10:15:15', '49.207.187.48'),
(197, 'Metocard AM', '53', 'Metocard AM', '1735', 0, 'SC297', 0, '0', 0, '2', '', 1, '26', '2017-09-10 10:18:26', '49.207.187.48'),
(198, 'Combutol 400mg', '53', 'Combutol 400mg', '253', 0, 'SC298', 0, '0', 0, '2', '', 1, '26', '2017-09-10 10:20:52', '49.207.187.48'),
(199, 'Combutol 600mg', '53', 'Combutol 600mg', '254', 0, 'SC299', 0, '0', 0, '2', '', 1, '26', '2017-09-10 10:21:27', '49.207.187.48'),
(200, 'Tamsin D', '53', 'Tamsin D', '1024', 0, 'SC300', 0, '0', 0, '2', '', 1, '26', '2017-09-10 10:22:55', '49.207.187.48'),
(201, 'Tamfil S', '60', 'Tamfil S', '731', 0, 'SC301', 0, '0', 0, '6', '', 1, '26', '2017-09-10 10:55:18', '49.207.187.48'),
(202, 'Dutas T', '60', 'Dutas T', '1024', 0, 'SC302', 0, '0', 0, '6', '', 1, '26', '2017-09-10 10:57:43', '49.207.187.48'),
(203, 'Tamsin 0.4mg', '53', 'Tamsin 0.4mg', '2001', 0, 'SC303', 0, '0', 0, '2', '', 1, '26', '2017-09-10 10:59:37', '49.207.187.48'),
(204, 'Liofen 10mg', '53', 'Liofen 10mg', '487', 0, 'SC304', 0, '0', 0, '2', '', 1, '26', '2017-09-10 11:02:50', '49.207.187.48'),
(205, 'Dalacin C 300mg', '60', 'Dalacin C 300mg', '1293', 0, 'SC305', 0, '0', 0, '6', '', 1, '26', '2017-09-10 11:07:29', '49.207.187.48'),
(206, 'Cansoft-CL', '53', 'Cansoft-CL', '801', 0, 'SC306', 0, '0', 0, '2', '', 1, '26', '2017-09-10 11:10:42', '49.207.187.48'),
(207, 'Zinetac 150mg', '53', 'Zinetac 150mg', '121', 0, 'SC307', 0, '0', 0, '2', '', 1, '26', '2017-09-10 11:16:40', '49.207.187.48'),
(208, 'Zinetac 300mg', '53', 'Zinetac 300mg', '439', 0, 'SC308', 0, '0', 0, '2', '', 1, '26', '2017-09-10 11:17:47', '49.207.187.48'),
(209, 'Rantac 150mg', '53', 'Rantac 150mg', '121', 0, 'SC309', 0, '0', 0, '2', '', 1, '26', '2017-09-10 11:22:43', '49.207.187.48'),
(210, 'Bintac 25mg', '57', 'Bintac 25mg', '339', 0, 'SC310', 0, '0', 0, '5', '', 1, '26', '2017-09-10 11:27:33', '49.207.187.48'),
(211, 'Ranitin 50mg', '57', 'Ranitin 50mg', '1231', 0, 'SC311', 0, '0', 0, '5', '', 1, '26', '2017-09-10 11:29:29', '49.207.187.48'),
(212, 'Histac Evt 150mg', '53', 'Histac Evt 150mg', '121', 0, 'SC312', 0, '0', 0, '2', '', 1, '26', '2017-09-10 11:30:48', '49.207.187.48'),
(213, 'Rantac 75mg', '54', 'Rantac 75mg', '1363', 0, 'SC313', 0, '0', 0, '3', '', 1, '26', '2017-09-10 11:33:22', '49.207.187.48'),
(214, 'Epidosin 8mg INJ', '57', 'Epidosin 8mg', '429', 0, 'SC314', 0, '0', 0, '5', '', 1, '26', '2017-09-10 11:36:30', '49.207.187.48'),
(215, 'Enam 2.5mg', '53', 'Enam 2.5mg', '22', 0, 'SC315', 0, '0', 0, '2', '', 1, '26', '2017-09-10 11:39:58', '49.207.187.48'),
(216, 'Enam 5mg Tablet', '53', 'Enam 5mg Tablet', '507', 48, 'SC316', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-21 13:26:38', '157.50.14.255'),
(217, 'Enam 10mg', '53', 'Enam 10mg', '1225', 0, 'SC317', 0, '0', 0, '2', '', 1, '26', '2017-09-10 11:41:35', '49.207.187.48'),
(218, 'Defcort 6mg', '53', 'Defcort 6mg', '2002', 0, 'SC318', 0, '0', 0, '2', '', 1, '26', '2017-09-10 11:44:55', '49.207.187.48'),
(219, 'Elocon', '55', 'Elocon', '479', 0, 'SC319', 0, '0', 0, '7', '', 1, '26', '2017-09-10 12:34:54', '49.207.187.48'),
(222, 'Zxc', '52', '345', '1', 2, 'SC320', 5, '345', 45, '4', 'sdf', 1, '26', '2017-09-15 11:23:22', '49.207.177.156'),
(223, 'Clopilet A 75', '60', 'Clopilet A 75', '605', 14, 'SC323', 0, '0', 0, '6', '30049099', 1, '26', '2017-09-15 12:30:23', '180.151.35.68'),
(224, 'Clopilet 75mg', '53', 'Clopilet 75mg', '296', 14, 'SC324', 0, '0', 0, '2', '30049000', 1, '26', '2017-09-15 12:32:38', '180.151.35.68'),
(225, 'Clopilet A 150', '60', 'Clopilet A 150', '1007', 14, 'SC325', 0, '0', 0, '6', '30049000', 1, '26', '2017-09-15 12:33:51', '180.151.35.68'),
(226, 'Clopilet 150mg', '53', 'Clopilet 150mg', '1278', 14, 'SC326', 0, '0', 0, '2', '30049000', 1, '26', '2017-09-15 12:34:56', '180.151.35.68'),
(227, 'Clopivas 75mg', '53', 'Clopivas 75mg', '296', 1, 'SC327', 0, '0', 0, '2', '30049000', 1, '26', '2017-09-15 12:36:40', '180.151.35.68'),
(228, 'Clopitab 75mg', '53', 'Clopitab 75mg', '296', 9, 'SC328', 0, '0', 0, '2', '30049000', 1, '26', '2017-09-15 12:37:53', '180.151.35.68'),
(229, 'Ceruvin A', '53', 'Ceruvin A', '605', 14, 'SC329', 0, '0', 0, '2', '30049000', 1, '26', '2017-09-15 12:42:07', '180.151.35.68'),
(230, 'Lanoxin 0.25mg', '53', 'Lanoxin 0.25mg', '158', 8, 'SC330', 0, '0', 0, '2', '30049000', 1, '26', '2017-09-15 12:48:46', '180.151.35.68'),
(231, 'Lanoxin 0.25mg INJ', '57', 'Lanoxin 0.25mg INJ', '158', 8, 'SC331', 0, '0', 0, '5', '30049000', 1, '26', '2017-09-15 12:50:47', '180.151.35.68'),
(232, 'Dixin Paed Oral', '73', 'Dixin Paed Oral', '198', 16, 'SC332', 0, '0', 0, '15', '30049000', 1, '26', '2017-09-15 12:53:56', '180.151.35.68'),
(233, 'Health', '84', 'Teast product', '2004', 17, 'SC333', 100, '300', 800, '13', 'HEALTH230', 1, '26', '2017-09-16 12:06:20', '49.207.177.156'),
(234, 'Duolin Rotacap', '71', 'Duolin Rotacap', '260', 1, 'SC334', 0, '0', 0, '16', '30049000', 1, '26', '2017-09-17 11:35:39', '49.207.184.10'),
(235, 'Duolin Inhaler', '86', 'Duolin Inhaler', '260', 1, 'SC335', 0, '0', 0, '17', '30049000', 1, '26', '2017-09-17 11:37:59', '49.207.184.10'),
(236, 'Duolin Respules 2.5ml', '87', 'Duolin Respules 2.5ml', '323', 1, 'SC336', 0, '0', 0, '18', '30049000', 1, '26', '2017-09-17 11:40:38', '49.207.184.10'),
(237, 'Cifran CT Tablet', '53', 'Cifran CT Tablet', '398', 14, 'SC337', 0, '0', 0, '2', '30049000', 1, '26', '2017-09-17 11:43:01', '49.207.184.10'),
(238, 'Cifran 500mg Tablet', '53', 'Cifran 500mg Tablet', '695', 14, 'SC338', 0, '0', 0, '2', '30049000', 1, '26', '2017-09-17 11:44:02', '49.207.184.10'),
(239, 'Cifran 0.3% W/v Eye/ear Drops', '80', 'Cifran 0.3% w/v Eye/ear Drops', '986', 14, 'SC339', 0, '0', 0, '8', '30049000', 1, '26', '2017-09-17 11:45:11', '49.207.184.10'),
(240, 'Ciplox D Eye/Ear Drops', '80', 'Ciplox D Eye/Ear Drops', '1221', 1, 'SC340', 0, '0', 0, '8', '30049000', 1, '26', '2017-09-17 12:58:54', '49.207.184.10'),
(241, 'Ciplox 0.3% W/v Eye/ear Drops', '80', 'Ciplox 0.3% w/v Eye/ear Drops', '986', 1, 'SC341', 0, '0', 0, '8', '30049000', 1, '26', '2017-09-17 12:59:46', '49.207.184.10'),
(242, 'Rifampicin Inh 450 Mg/300 Mg Capsule', '60', 'Rifampicin Inh 450 mg/300 mg Capsule', '15', 18, 'SC342', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-18 19:09:30', '117.249.223.241'),
(243, 'Testovit Forte Capsule', '60', 'Testovit Forte Capsule', '2006', 19, 'SC343', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-18 19:26:47', '117.249.223.241'),
(244, 'Evalon Cream', '55', 'Evalon Cream', '17', 20, 'SC344', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-18 19:30:04', '117.249.223.241'),
(245, 'B Bact 2% W/w Ointment', '77', 'B Bact 2% w/w Ointment', '18', 21, 'SC345', 0, '0', 0, '1', '30049000', 1, '36', '2017-09-18 19:36:38', '117.249.223.241'),
(246, 'Walyte Sachet', '78', 'Walyte Sachet', '19', 21, 'SC346', 0, '0', 0, '19', '30049000', 1, '36', '2017-09-18 20:50:57', '117.249.223.241'),
(247, 'Roxid Kid 50mg Tablet', '53', 'Roxid Kid 50mg Tablet', '20', 22, 'SC347', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-18 20:49:57', '117.249.223.241'),
(248, 'Prevenar 13 Vaccine', '57', 'Prevenar 13 Vaccine', '21', 23, 'SC348', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-18 20:55:09', '117.249.223.241'),
(249, 'Enam 2.5mg Tablet', '53', 'Enam 2.5mg Tablet', '22', 7, 'SC349', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-18 20:57:05', '117.249.223.241'),
(250, 'Zyncet D 5 Mg/10 Mg Tablet', '53', 'Zyncet D 5 mg/10 mg Tablet', '23', 24, 'SC350', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-18 21:02:23', '117.249.223.241'),
(251, 'Metrogyl F Suspension', '79', 'Metrogyl F Suspension', '24', 25, 'SC351', 0, '0', 0, '9', '30049000', 1, '36', '2017-09-18 21:04:57', '117.249.223.241'),
(252, 'Becadexamin Soft Gelatin Capsule', '60', 'Becadexamin Soft Gelatin Capsule', '2007', 26, 'SC352', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-18 21:09:12', '117.249.223.241'),
(253, 'Neo-Mercazole 5mg Tablet', '60', 'Neo-Mercazole 5mg Tablet', '30', 27, 'SC353', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-18 21:11:00', '117.249.223.241'),
(254, 'Althrocin 125mg Liquid', '81', 'Althrocin 125mg Liquid', '32', 22, 'SC354', 0, '0', 0, '10', '30049000', 1, '36', '2017-09-18 21:13:08', '117.249.223.241'),
(255, 'Zovirax 400mg Suspension', '79', 'Zovirax 400mg Suspension', '34', 26, 'SC355', 0, '0', 0, '9', '30049000', 1, '36', '2017-09-18 21:23:27', '117.249.223.241'),
(256, 'Eptoin 30mg/5ml Suspension', '79', 'Eptoin 30mg/5ml Suspension', '35', 27, 'SC356', 0, '0', 0, '9', '30049000', 1, '36', '2017-09-18 21:27:17', '117.249.223.241'),
(257, 'Tegretol Syrup 100ML', '54', 'Tegretol Syrup 100ML', '2008', 28, 'SC357', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-18 21:32:12', '117.249.223.241'),
(258, 'PERISET 30ML SYRUP', '54', 'PERISET 30ML SYRUP', '37', 29, 'SC358', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-18 21:36:18', '117.249.223.241'),
(259, 'Carmicide EZ Syrup', '54', 'Carmicide EZ Syrup', '38', 30, 'SC359', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-18 21:40:56', '117.249.223.241'),
(260, 'Himalaya Mentat Syrup', '54', 'Himalaya Mentat Syrup', '39', 31, 'SC360', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-18 21:43:12', '117.249.223.241'),
(261, 'ZN 20MG SYRUP 100ML', '54', 'ZN 20MG SYRUP 100ML', '40', 21, 'SC361', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-18 21:51:59', '117.249.223.241'),
(262, 'ZYTEE RB GEL 10ML', '72', 'ZYTEE RB GEL 10ML', '41', 32, 'SC362', 0, '0', 0, '14', '30049000', 1, '36', '2017-09-18 22:04:18', '117.249.131.69'),
(263, 'Liv 52 Syrup', '54', 'Liv 52 Syrup', '43', 31, 'SC363', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-18 22:12:53', '27.62.233.234'),
(264, 'SCABEX LOTION 100ML', '52', 'SCABEX LOTION 100ML', '44', 30, 'SC364', 0, '0', 0, '4', '30049000', 1, '36', '2017-09-18 22:15:34', '27.62.233.234'),
(265, 'Bethadoxin 12 M Syrup', '54', 'Bethadoxin 12 M Syrup', '2009', 33, 'SC365', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-19 08:24:43', '157.50.8.195'),
(266, 'Eptoin 100mg Tablet', '53', 'Eptoin 100mg Tablet', '47', 27, 'SC366', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-19 08:26:14', '157.50.8.195'),
(267, 'Shelcal-M Syrup', '54', 'Shelcal-M Syrup', '48', 34, 'SC367', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-19 08:29:49', '157.50.8.195'),
(268, 'Blumox 250mg Tablet DT', '53', 'Blumox 250mg Tablet DT', '50', 35, 'SC368', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 08:32:03', '157.50.8.195'),
(269, 'Wikoryl 2 Mg/500 Mg/5 Mg Tablet', '53', 'Wikoryl 2 mg/500 mg/5 mg Tablet', '52', 22, 'SC369', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 08:34:29', '157.50.8.195'),
(270, 'Zincovit Syrup', '54', 'Zincovit Syrup', '2010', 36, 'SC370', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-19 08:38:28', '157.50.8.195'),
(271, 'Lariago 250mg Tablet', '53', 'Lariago 250mg Tablet', '2011', 37, 'SC371', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 08:45:46', '157.50.8.195'),
(272, 'Peritop 5% W/w Lotion', '52', 'Peritop 5% w/w Lotion', '57', 38, 'SC372', 0, '0', 0, '4', '30049000', 1, '36', '2017-09-19 08:50:36', '157.50.8.195'),
(273, 'Betnovate-C Cream', '55', 'Betnovate-C Cream', '58', 26, 'SC373', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-19 08:52:10', '157.50.8.195'),
(274, 'Betnovate-N Cream', '55', 'Betnovate-N Cream', '2012', 26, 'SC374', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-19 08:54:14', '157.50.8.195'),
(275, 'Ofloxamac 200mg Tablet', '53', 'Ofloxamac 200mg Tablet', '10', 39, 'SC375', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 08:59:30', '157.50.8.195'),
(276, 'Phexin 500mg Capsule', '60', 'Phexin 500mg Capsule', '68', 26, 'SC376', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-19 09:00:51', '157.50.8.195'),
(277, 'Norflox 100mg Tablet DT', '53', 'Norflox 100mg Tablet DT', '72', 1, 'SC377', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 09:48:14', '157.50.8.195'),
(278, 'Norflox 200mg Tablet', '53', 'Norflox 200mg Tablet', '73', 1, 'SC378', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 09:51:50', '157.50.8.195'),
(279, 'Astymin SN Infusion', '81', 'Astymin SN Infusion', '79', 42, 'SC379', 0, '0', 0, '10', '30049000', 1, '36', '2017-09-19 10:06:19', '157.50.8.195'),
(280, 'Zerodol-P Tablet', '53', 'Zerodol-P Tablet', '82', 37, 'SC380', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 13:01:46', '157.50.12.3'),
(281, 'B-Long F Tablet SR', '53', 'B-Long F Tablet SR', '83', 34, 'SC381', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 13:03:32', '157.50.12.3'),
(282, 'Amikacin (250mg)', '57', 'Amikacin (250mg)', '85', 43, 'SC382', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-19 13:06:49', '157.50.12.3'),
(283, 'Pacitane 2mg Tablet', '53', 'Pacitane 2mg Tablet', '87', 23, 'SC383', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 13:16:14', '157.50.12.3'),
(284, 'Trapic MF Tablet', '53', 'Trapic MF Tablet', '88', 44, 'SC384', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 13:18:35', '157.50.12.3'),
(285, 'Cyclopam Tablet', '53', 'Cyclopam Tablet', '89', 30, 'SC385', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 13:19:45', '157.50.12.3'),
(286, 'Urikind 200mg Tablet', '53', 'Urikind 200mg Tablet', '90', 45, 'SC386', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 13:22:43', '157.50.12.3'),
(287, 'Vecredil 1mg Infusion', '57', 'Vecredil 1mg Infusion', '91', 46, 'SC387', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-19 13:24:58', '157.50.12.3'),
(288, 'Lysatone Plus Syrup', '54', 'Lysatone Plus Syrup', '93', 47, 'SC388', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-19 13:27:03', '157.50.12.3'),
(289, 'Kenacort 0.1% W/w Oral Paste', '82', 'Kenacort 0.1% w/w Oral Paste', '94', 27, 'SC389', 0, '0', 0, '11', '30049000', 1, '36', '2017-09-19 13:28:14', '157.50.12.3'),
(290, 'Nise Gel', '72', 'Nise Gel', '95', 48, 'SC390', 0, '0', 0, '14', '30049000', 1, '36', '2017-09-19 13:30:49', '157.50.12.3'),
(291, 'Livoluk Syrup', '54', 'Livoluk Syrup', '56', 40, 'SC391', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-19 13:32:25', '157.50.12.3'),
(292, 'Letoval Tablet', '53', 'Letoval Tablet', '97', 44, 'SC392', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 13:34:11', '157.50.12.3'),
(293, 'Krimson 35 Tablet', '53', 'Krimson 35 Tablet', '2014', 44, 'SC393', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 13:36:19', '157.50.12.3'),
(294, 'Neurobion RF Forte Injection', '57', 'Neurobion RF Forte Injection', '2015', 49, 'SC394', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-19 13:44:22', '157.50.12.3'),
(295, 'Styptochrome E 125mg Injection', '57', 'Styptochrome E 125mg Injection', '101', 48, 'SC395', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-19 13:45:54', '157.50.12.3'),
(296, 'Foetocin 5IU Injection', '57', 'Foetocin 5IU Injection', '503', 50, 'SC396', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-19 13:47:32', '157.50.12.3'),
(297, 'Pregnidoxin NU Tablet', '53', 'Pregnidoxin NU Tablet', '104', 48, 'SC397', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 13:49:52', '157.50.12.3'),
(298, 'Himalaya Pilex Tablet', '53', 'Himalaya Pilex Tablet', '547', 31, 'SC398', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-19 13:56:10', '157.50.12.3'),
(299, 'Endoprost 250mcg Injection', '57', 'Endoprost 250mcg Injection', '106', 51, 'SC399', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-19 13:58:00', '157.50.12.3'),
(300, 'Primigyn 0.5mg Gel', '72', 'Primigyn 0.5mg Gel', '107', 51, 'SC400', 0, '0', 0, '14', '30049000', 1, '36', '2017-09-19 15:50:57', '157.50.12.3'),
(301, 'Combiflam Tablet', '53', 'Combiflam Tablet', '108', 52, 'SC401', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 15:53:15', '157.50.12.3'),
(302, 'Roscillin 500mg Capsule', '60', 'Roscillin 500mg Capsule', '109', 44, 'SC402', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-19 15:56:36', '157.50.12.3'),
(303, 'R-Cinex Capsule', '60', 'R-Cinex Capsule', '15', 9, 'SC403', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-19 16:00:03', '157.50.12.3'),
(304, 'Primacort 200mg Injection', '57', 'Primacort 200mg Injection', '110', 53, 'SC404', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-19 16:08:02', '157.50.12.3'),
(305, 'Tresivac Vaccine', '57', 'Tresivac Vaccine', '111', 54, 'SC405', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-19 16:43:12', '157.50.12.3'),
(306, 'Asthalin Rotacap', '71', 'Asthalin Rotacap', '112', 1, 'SC406', 0, '0', 0, '16', '30049000', 1, '36', '2017-09-19 16:44:34', '157.50.12.3'),
(307, 'Dilzem 30mg Tablet', '53', 'Dilzem 30mg Tablet', '113', 34, 'SC407', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 16:46:19', '157.50.12.3'),
(308, 'Drez S Ointment', '77', 'Drez S Ointment', '114', 55, 'SC408', 0, '0', 0, '1', '30049000', 1, '36', '2017-09-19 16:48:41', '157.50.12.3'),
(309, 'Flucold Syrup', '54', 'Flucold Syrup', '116', 21, 'SC409', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-19 16:56:21', '157.50.12.3'),
(310, 'Herpikind 400mg Tablet', '53', 'Herpikind 400mg Tablet', '34', 45, 'SC410', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 16:57:51', '157.50.12.3'),
(311, 'Herpikind 200mg Tablet', '53', 'Herpikind 200mg Tablet', '119', 45, 'SC411', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 16:59:48', '157.50.12.3'),
(312, 'Rantac Mps 400 Mg/20 Mg Syrup', '54', 'Rantac Mps 400 mg/20 mg Syrup', '120', 25, 'SC412', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-19 17:00:58', '157.50.12.3'),
(313, 'Rantac 150mg Tablet', '53', 'Rantac 150mg Tablet', '121', 25, 'SC413', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 17:02:36', '157.50.12.3'),
(314, 'Zest Syrup', '54', 'Zest Syrup', '122', 56, 'SC414', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-19 17:04:08', '157.50.12.3'),
(315, 'Grenil Tablet', '53', 'Grenil Tablet', '123', 57, 'SC415', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 17:06:17', '157.50.12.3'),
(316, 'Walamycin 12.5mg Suspension', '79', 'Walamycin 12.5mg Suspension', '124', 21, 'SC416', 0, '0', 0, '9', '30049000', 1, '36', '2017-09-19 17:07:28', '157.50.12.3'),
(317, 'Neosporin Eye Ointment', '77', 'Neosporin Eye Ointment', '128', 26, 'SC417', 0, '0', 0, '1', '30049000', 1, '36', '2017-09-19 17:09:38', '157.50.12.3'),
(318, 'Vanguard Therapeutics Pvt Ltd', '80', 'Vanguard Therapeutics Pvt Ltd', '137', 58, 'SC418', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-19 17:11:16', '157.50.12.3'),
(319, 'Tusq D SF Lozenges', '54', 'Tusq D SF Lozenges', '138', 35, 'SC419', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-19 17:14:44', '157.50.12.3'),
(320, 'Periset 2mg Injection', '57', 'Periset 2mg Injection', '145', 37, 'SC420', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-19 17:17:26', '157.50.12.3'),
(321, 'Dulcoflex 5mg Tablet', '53', 'Dulcoflex 5mg Tablet', '147', 59, 'SC421', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 17:21:23', '157.50.12.3'),
(322, 'Sporidex 125mg Tablet DT', '53', 'Sporidex 125mg Tablet DT', '148', 44, 'SC422', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 17:22:44', '157.50.12.3'),
(323, 'Emolene Cream', '55', 'Emolene Cream', '149', 60, 'SC423', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-19 17:24:28', '157.50.12.3'),
(324, 'Rapither 150mg Injection', '57', 'Rapither 150mg Injection', '150', 37, 'SC424', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-19 17:26:06', '157.50.12.3'),
(325, 'Brethex P Drops', '80', 'Brethex P Drops', '151', 61, 'SC425', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-19 17:31:53', '157.50.12.3'),
(326, 'Mazetol 100mg Tablet', '53', 'Mazetol 100mg Tablet', '36', 27, 'SC426', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 17:33:55', '157.50.12.3'),
(327, 'Potklor Oral Solution', '73', 'Potklor Oral Solution', '153', 62, 'SC427', 0, '0', 0, '15', '30049000', 1, '36', '2017-09-19 17:35:30', '157.50.12.3'),
(328, 'Calcigard 5mg Capsule', '60', 'Calcigard 5mg Capsule', '154', 34, 'SC428', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-19 17:36:52', '157.50.12.3'),
(329, 'Cetzine 10mg Tablet', '53', 'Cetzine 10mg Tablet', '157', 26, 'SC429', 0, '0', 0, '12', '30049031', 1, '26', '2017-10-18 14:10:19', '49.207.184.24'),
(330, 'Lanoxin 0.25mg Tablet', '53', 'Lanoxin 0.25mg Tablet', '158', 26, 'SC430', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 17:39:51', '157.50.12.3'),
(331, 'Monotax 500mg Injection', '57', 'Monotax 500mg Injection', '159', 43, 'SC431', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-19 17:42:22', '157.50.12.3'),
(332, 'Ascoril D Plus Syrup', '54', 'Ascoril D Plus Syrup', '160', 63, 'SC432', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-19 17:44:13', '157.50.12.3'),
(333, 'Brozeet 15mg/50mg/1.5mg Syrup', '54', 'Brozeet 15mg/50mg/1.5mg Syrup', '161', 22, 'SC433', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-19 17:45:50', '157.50.12.3'),
(334, 'Meftal 250mg Tablet', '53', 'Meftal 250mg Tablet', '164', 35, 'SC434', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 17:49:50', '157.50.12.3'),
(335, 'M.V.I. Injection', '57', 'M.V.I. Injection', '166', 64, 'SC435', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-19 17:54:03', '157.50.12.3'),
(336, 'Asthalin 2.5mg Respules', '87', 'Asthalin 2.5mg Respules', '169', 1, 'SC436', 0, '0', 0, '18', '30049000', 1, '36', '2017-09-20 14:33:47', '157.50.8.207'),
(337, 'Atarax 6mg Drop', '80', 'Atarax 6mg Drop', '170', 48, 'SC437', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-19 18:03:56', '157.50.12.3'),
(338, 'Stugil Tablet', '53', 'Stugil Tablet', '171', 65, 'SC438', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 18:08:10', '157.50.12.3'),
(339, 'Rapither AB 75mg Injection', '57', 'Rapither AB 75mg Injection', '172', 37, 'SC439', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-19 18:16:16', '157.50.12.3'),
(340, 'Livoluk Kid Syrup', '54', 'Livoluk Kid Syrup', '56', 40, 'SC440', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-19 18:17:31', '157.50.12.3'),
(341, 'K-Stat 125mg Injection', '57', 'K-Stat 125mg Injection', '101', 66, 'SC441', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-19 18:20:18', '157.50.12.3'),
(342, 'Sporidex 100mg Drop', '80', 'Sporidex 100mg Drop', '175', 44, 'SC442', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-19 18:22:30', '157.50.12.3'),
(343, 'AD 100mg Capsule', '60', 'AD 100mg Capsule', '462', 67, 'SC443', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-21 10:05:56', '106.208.179.103'),
(344, 'Udiliv 300mg Tablet', '53', 'Udiliv 300mg Tablet', '177', 27, 'SC444', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 18:25:46', '157.50.12.3'),
(345, 'Tusq DX Syrup', '54', 'Tusq DX Syrup', '2022', 35, 'SC445', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-19 18:28:56', '157.50.12.3'),
(346, 'Cycloset Syrup', '54', 'Cycloset Syrup', '179', 22, 'SC446', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-19 18:30:50', '157.50.12.3'),
(347, 'Otorex Drop', '80', 'Otorex Drop', '182', 30, 'SC447', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-19 22:44:08', '157.50.8.18'),
(348, 'Eptoin Injection', '57', 'Eptoin Injection', '183', 27, 'SC448', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-19 22:46:12', '157.50.8.18'),
(349, 'Nasivion Mini 0.01% Nasal Drops', '80', 'Nasivion Mini 0.01% Nasal Drops', '185', 49, 'SC449', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-19 22:48:04', '157.50.8.18'),
(350, 'Silverex AV Cream', '55', 'Silverex AV Cream', '2023', 44, 'SC450', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-19 22:50:47', '157.50.8.18'),
(351, 'Mannitol 20% Infusion', '57', 'Mannitol 20% Infusion', '187', 68, 'SC451', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-19 22:54:55', '157.50.8.18'),
(352, 'Volini Spray', '75', 'Volini Spray Small', '1335', 44, 'SC452', 0, '0', 0, 'Unit Not Available for this Product.', '30049000', 1, '36', '2017-09-19 22:59:22', '157.50.8.18'),
(353, 'Asthalin 5mg Solution', '73', 'Asthalin 5mg Solution', '190', 1, 'SC453', 0, '0', 0, '15', '30049000', 1, '36', '2017-09-19 23:01:21', '157.50.8.18'),
(354, 'Cyclopam 10mg Injection', '57', 'Cyclopam 10mg Injection', '191', 30, 'SC454', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-19 23:03:02', '157.50.8.18');
INSERT INTO `product` (`productid`, `productname`, `product_typeid`, `sort_description`, `composition_id`, `manufacturer_id`, `product_code`, `minstock`, `reorderlevelstock`, `maxstock`, `unit`, `hsn_code`, `is_active`, `updatedby`, `updatedon`, `updated_ipaddress`) VALUES
(355, 'Aristozyme Drop', '80', 'Aristozyme Drop', '192', 69, 'SC455', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-19 23:04:52', '157.50.8.18'),
(356, 'Styptovit E 500mg Tablet', '53', 'Styptovit E 500mg Tablet', '194', 48, 'SC456', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 23:08:53', '157.50.8.18'),
(357, 'Razo 20mg Tablet', '53', 'Razo 20mg Tablet', '195', 48, 'SC457', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 23:10:01', '157.50.8.18'),
(358, 'Neeri Syrup', '54', 'Neeri Syrup', '196', 70, 'SC458', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-19 23:12:28', '157.50.8.18'),
(359, 'Astymin Syrup', '54', 'Astymin Syrup', '197', 42, 'SC459', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-19 23:18:05', '157.50.8.18'),
(360, 'Dixin Paed Oral Solution', '73', 'Dixin Paed Oral Solution', '198', 71, 'SC460', 0, '0', 0, '15', '30049000', 1, '36', '2017-09-19 23:19:56', '157.50.8.18'),
(361, 'Mulmin Syrup', '54', 'Mulmin Syrup', '199', 72, 'SC461', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-19 23:21:37', '157.50.8.18'),
(362, 'Zeet Expectorant', '54', 'Zeet Expectorant', '167', 22, 'SC462', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-19 23:23:35', '157.50.8.18'),
(363, 'Coscoril Drop', '80', 'Coscoril Drop', '201', 33, 'SC463', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-19 23:26:47', '157.50.8.18'),
(364, 'Bestozyme Syrup', '54', 'Bestozyme Syrup', '2026', 33, 'SC464', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-19 23:28:45', '157.50.8.18'),
(365, 'Perinorm 10mg Tablet', '53', 'Perinorm 10mg Tablet', '11', 37, 'SC465', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 23:30:03', '157.50.8.18'),
(366, 'Zinetac 150mg Tablet', '53', 'Zinetac 150mg Tablet', '121', 26, 'SC466', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 23:31:11', '157.50.8.18'),
(367, 'Roxid 150mg Tablet', '53', 'Roxid 150mg Tablet', '205', 22, 'SC467', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 23:32:28', '157.50.8.18'),
(368, 'Tetglob 250IU Injection', '57', 'Tetglob 250IU Injection', '210', 51, 'SC468', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-19 23:34:48', '157.50.8.18'),
(369, 'Methergin 0.2mg/1ml Injection', '57', 'Methergin 0.2mg/1ml Injection', '214', 28, 'SC469', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-19 23:37:32', '157.50.8.18'),
(370, 'Tyfy 300mg Tablet DT', '53', 'Tyfy 300mg Tablet DT', '215', 58, 'SC470', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 23:40:05', '157.50.8.18'),
(371, 'Vertin 8mg Tablet', '53', 'Vertin 8mg Tablet', '216', 27, 'SC471', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-19 23:41:18', '157.50.8.18'),
(372, 'Ferrochelate Drop', '80', 'Ferrochelate Drop', '2027', 68, 'SC472', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-19 23:43:44', '157.50.8.18'),
(373, 'Forecox Kit', '75', 'Forecox Kit', '14', 53, 'SC473', 0, '0', 0, 'Unit Not Available for this Product.', '30049000', 1, '36', '2017-09-20 05:34:35', '157.50.11.158'),
(374, 'K-Win 10mg Injection', '57', 'K-Win 10mg Injection', '219', 66, 'SC474', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 05:36:55', '157.50.11.158'),
(375, 'Nizral 2% Solution', '73', 'Nizral 2% Solution', '220', 65, 'SC475', 0, '0', 0, '15', '30049000', 1, '36', '2017-09-20 05:38:29', '157.50.11.158'),
(376, 'Human Mixtard 30/70 40IU Injection', '57', 'Human Mixtard 30/70 40IU Injection', '224', 74, 'SC476', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 05:43:04', '157.50.11.158'),
(377, 'Omnacortil 10mg Tablet', '53', 'Omnacortil 10mg Tablet', '2028', 53, 'SC477', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 05:44:55', '157.50.11.158'),
(378, 'Optineuron Injection', '57', 'Optineuron Injection', '227', 9, 'SC478', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 06:00:49', '157.50.11.158'),
(379, 'Encephabol 100mg Suspension', '79', 'Encephabol 100mg Suspension', '228', 49, 'SC479', 0, '0', 0, '9', '30049000', 1, '36', '2017-09-20 06:01:57', '157.50.11.158'),
(380, 'Roxid 300mg Tablet', '53', 'Roxid 300mg Tablet', '230', 22, 'SC480', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 06:04:17', '157.50.11.158'),
(381, 'Nasivion Paediatric 0.025% Nasal Drops', '80', 'Nasivion Paediatric 0.025% Nasal Drops', '231', 49, 'SC481', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-20 06:11:14', '157.50.11.158'),
(382, 'Nasivion Classic Adult 0.05% Nasal Spray', '80', 'Nasivion Classic Adult 0.05% Nasal Spray', '222', 49, 'SC482', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-20 06:14:42', '157.50.11.158'),
(383, 'Himalaya Cystone Tablet', '53', 'Himalaya Cystone Tablet', '233', 31, 'SC483', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-20 06:16:06', '157.50.11.158'),
(384, 'Himalaya Pilex Ointment', '77', 'Himalaya Pilex Ointment', '547', 31, 'SC484', 0, '0', 0, '1', '30049000', 1, '36', '2017-09-20 06:17:47', '157.50.11.158'),
(385, 'Polybion LC Syrup', '54', 'Polybion LC Syrup', '46', 49, 'SC485', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-20 06:20:34', '157.50.11.158'),
(386, 'Ovral L 0.03 Mg/0.15 Mg Tablet', '53', 'Ovral L 0.03 mg/0.15 mg Tablet', '236', 23, 'SC486', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 06:21:46', '157.50.11.158'),
(387, 'Ovral G 0.5mg/05mg Tablet', '53', 'Ovral G 0.5mg/05mg Tablet', '237', 23, 'SC487', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 06:23:04', '157.50.11.158'),
(388, 'Defcort 30mg Tablet', '53', 'Defcort 30mg Tablet', '2029', 53, 'SC488', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 06:25:07', '157.50.11.158'),
(389, 'Dolonex 20mg Tablet DT', '53', 'Dolonex 20mg Tablet DT', '240', 23, 'SC489', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 06:26:43', '157.50.11.158'),
(390, 'Wokadine 10% W/w Ointment', '77', 'Wokadine 10% w/w Ointment', '241', 75, 'SC490', 0, '0', 0, '1', '30049000', 1, '36', '2017-09-22 08:52:18', '157.50.13.170'),
(391, 'Snake Antivenin Injection', '57', 'Snake Antivenin Injection', '242', 33, 'SC491', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 06:30:37', '157.50.11.158'),
(392, 'Tonoferon Syrup', '54', 'Tonoferon Syrup', '217', 76, 'SC492', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-20 06:32:54', '157.50.11.158'),
(393, 'Pedicloryl 500mg Syrup', '54', 'Pedicloryl 500mg Syrup', '244', 48, 'SC493', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-20 14:16:24', '157.50.8.207'),
(394, 'Neo-Mercazole 10mg Tablet', '53', 'Neo-Mercazole 10mg Tablet', '245', 27, 'SC494', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-20 06:34:53', '157.50.11.158'),
(395, 'Revac-B 20mcg Vaccine', '57', 'Revac-B 20mcg Vaccine', '246', 77, 'SC495', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 06:36:19', '157.50.11.158'),
(396, 'Pantop 40mg Tablet', '53', 'Pantop 40mg Tablet', '247', 69, 'SC496', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 06:37:57', '157.50.11.158'),
(397, 'Adrenaline Tartrate Injection', '57', 'Adrenaline Tartrate Injection', '249', 78, 'SC497', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 06:39:34', '157.50.11.158'),
(398, 'Dolonex 2ml Injection', '57', 'Dolonex 2ml Injection', '251', 23, 'SC498', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 06:40:51', '157.50.11.158'),
(399, 'Phenergan Injection', '57', 'Phenergan Injection', '252', 27, 'SC499', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 06:42:31', '157.50.11.158'),
(400, 'Combutol 400mg Tablet', '53', 'Combutol 400mg Tablet', '253', 9, 'SC500', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 06:44:13', '157.50.11.158'),
(401, 'Combutol 600mg Tablet', '53', 'Combutol 600mg Tablet', '254', 9, 'SC501', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 06:45:17', '157.50.11.158'),
(402, 'Himalaya Liv. 52 DS Tablet', '53', 'Himalaya Liv. 52 DS Tablet', '255', 31, 'SC502', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-20 06:46:26', '157.50.11.158'),
(403, 'Oflomac 400mg Tablet', '53', 'Oflomac 400mg Tablet', '256', 53, 'SC503', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 07:34:50', '157.50.11.158'),
(404, 'Monotax O 100mg Syrup', '54', 'Monotax O 100mg Syrup', '180', 43, 'SC504', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-20 07:36:27', '157.50.11.158'),
(405, 'Foracort 100 Inhaler', '86', 'Foracort 100 Inhaler', '261', 1, 'SC505', 0, '0', 0, '17', '30049000', 1, '36', '2017-09-20 07:38:27', '157.50.11.158'),
(406, 'Pentaxim Vaccine', '57', 'Pentaxim Vaccine', '263', 52, 'SC506', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 07:40:22', '157.50.11.158'),
(407, 'Maintane 500mg Injection', '57', 'Maintane 500mg Injection', '264', 46, 'SC507', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 07:41:45', '157.50.11.158'),
(408, 'Amicin 100mg Injection', '57', 'Amicin 100mg Injection', '265', 43, 'SC508', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 14:05:32', '157.50.8.207'),
(409, 'Mazetol 400mg Tablet', '53', 'Mazetol 400mg Tablet', '267', 27, 'SC509', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 07:44:19', '157.50.11.158'),
(410, 'Complamina Retard 500mg Tablet SR', '53', 'Complamina Retard 500mg Tablet SR', '269', 18, 'SC510', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 07:49:24', '157.50.11.158'),
(411, 'Inderal 10mg Tablet', '53', 'Inderal 10mg Tablet', '270', 27, 'SC511', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 07:52:05', '157.50.11.158'),
(412, 'C', '53', 'Phytoherbs', '271', 50, 'SC512', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-20 07:53:00', '157.50.11.158'),
(413, 'Meprate 10mg Tablet', '53', 'Meprate 10mg Tablet', '272', 54, 'SC513', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 07:54:20', '157.50.11.158'),
(414, 'Biotax 1gm Injection', '57', 'Biotax 1gm Injection', '373', 43, 'SC514', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 07:56:19', '157.50.11.158'),
(415, 'Aquasol A Capsule', '60', 'Aquasol A Capsule', '274', 64, 'SC515', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-20 07:58:08', '157.50.11.158'),
(416, 'Deriphyllin Retard 300 Tablet', '53', 'Deriphyllin Retard 300 Tablet', '2031', 18, 'SC516', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 08:00:15', '157.50.11.158'),
(417, 'Metrogyl 400mg Tablet', '53', 'Metrogyl 400mg Tablet', '278', 25, 'SC517', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 08:02:37', '157.50.11.158'),
(418, 'Macox-ZH Tablet', '53', 'Macox-ZH Tablet', '279', 53, 'SC518', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 08:03:54', '157.50.11.158'),
(419, 'Tancodep 2mg/25mg Tablet', '53', 'Tancodep 2mg/25mg Tablet', '280', 34, 'SC519', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 08:05:31', '157.50.11.158'),
(420, 'Restyl 0.5mg Tablet', '53', 'Restyl 0.5mg Tablet', '281', 1, 'SC520', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 08:08:14', '157.50.11.158'),
(421, 'Riboflavine Tablet', '53', 'Riboflavine Tablet', '2032', 79, 'SC521', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 08:10:20', '157.50.11.158'),
(422, 'Rantac D 10 Mg/150 Mg Tablet', '53', 'Rantac D 10 mg/150 mg Tablet', '283', 25, 'SC522', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 08:12:43', '157.50.11.158'),
(423, 'Dobesil 500mg Capsule', '60', 'Dobesil 500mg Capsule', '284', 44, 'SC523', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-20 08:14:15', '157.50.11.158'),
(424, 'Paramet 5 Mg/500 Mg Tablet', '53', 'Paramet 5 mg/500 mg Tablet', '285', 21, 'SC524', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 08:15:18', '157.50.11.158'),
(425, 'Doxt SL Capsule', '60', 'Doxt SL Capsule', '287', 48, 'SC525', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-20 08:17:25', '157.50.11.158'),
(426, 'Lariago DS 500mg Tablet', '53', 'Lariago DS 500mg Tablet', '288', 37, 'SC526', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 08:19:35', '157.50.11.158'),
(427, 'Vomikind 4mg Tablet MD', '53', 'Vomikind 4mg Tablet MD', '289', 45, 'SC527', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 08:20:59', '157.50.11.158'),
(428, 'Tryptomer 25mg Tablet', '53', 'Tryptomer 25mg Tablet', '2033', 75, 'SC528', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 08:23:33', '157.50.11.158'),
(429, 'Pyricontin Tablet', '53', 'Pyricontin Tablet', '2034', 80, 'SC529', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 08:25:25', '157.50.11.158'),
(430, 'Monotrate 20mg Tablet', '53', 'Monotrate 20mg Tablet', '292', 44, 'SC530', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 08:26:36', '157.50.11.158'),
(431, 'Periset 4mg Tablet', '53', 'Periset 4mg Tablet', '289', 37, 'SC531', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 08:38:26', '157.50.11.158'),
(432, 'Gravol 50mg Tablet', '53', 'Gravol 50mg Tablet', '294', 21, 'SC532', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 08:39:30', '157.50.11.158'),
(433, 'Menabol 2mg Tablet', '53', 'Menabol 2mg Tablet', '295', 81, 'SC533', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 08:41:48', '157.50.11.158'),
(434, 'Trichoton Tablet', '53', 'Trichoton Tablet', '298', 82, 'SC534', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 09:49:15', '157.50.8.144'),
(435, 'Stemetil 5mg Tablet MD', '53', 'Stemetil 5mg Tablet MD', '299', 27, 'SC535', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 09:50:38', '157.50.8.144'),
(436, 'Ascoril Plus Tablet', '53', 'Ascoril Plus Tablet', '2035', 63, 'SC536', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 09:52:01', '157.50.8.144'),
(437, 'Tusq P Oral Drops', '80', 'Tusq P Oral Drops', '302', 35, 'SC537', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-20 09:53:09', '157.50.8.144'),
(438, 'Pregalin X 750mcg/75mg Tablet', '53', 'Pregalin X 750mcg/75mg Tablet', '304', 34, 'SC538', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 09:54:32', '157.50.8.144'),
(439, 'Spasmo Proxyvon Plus Capsule', '60', 'Spasmo Proxyvon Plus Capsule', '2036', 75, 'SC539', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-20 09:56:08', '157.50.8.144'),
(440, 'Althrocin 500mg Tablet', '53', 'Althrocin 500mg Tablet', '306', 22, 'SC540', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 09:58:38', '157.50.8.207'),
(441, 'Sorbitrate 5mg Tablet', '53', 'Sorbitrate 5mg Tablet', '307', 27, 'SC541', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 10:00:14', '157.50.8.207'),
(442, 'Calpanto Forte Capsule', '60', 'Calpanto Forte Capsule', '308', 83, 'SC542', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-20 10:01:42', '157.50.8.207'),
(443, 'Herperax 5% W/w Ointment', '77', 'Herperax 5% w/w Ointment', '627', 84, 'SC543', 0, '0', 0, '1', '30049000', 1, '36', '2017-09-20 10:04:22', '157.50.8.207'),
(444, 'Hepa Merz Tablet', '53', 'Hepa Merz Tablet', '312', 85, 'SC544', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 10:07:55', '157.50.8.207'),
(445, 'Calcigard 10mg Capsule', '60', 'Calcigard 10mg Capsule', '313', 34, 'SC545', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-20 10:10:14', '157.50.8.207'),
(446, 'Perinorm Injection', '57', 'Perinorm Injection', '314', 37, 'SC546', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 10:11:32', '157.50.8.207'),
(447, 'Atropine 1% Eye Drop', '80', 'Atropine 1% Eye Drop', '2037', 86, 'SC547', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-20 10:14:58', '157.50.8.207'),
(448, 'Ascoril SF Expectorant', '81', 'Ascoril SF Expectorant', '318', 63, 'SC548', 0, '0', 0, '10', '30049000', 1, '36', '2017-09-20 10:18:35', '157.50.8.207'),
(449, 'Chymoral Plus 50 Mg/50000 AU Tablet', '53', 'Chymoral Plus 50 mg/50000 AU Tablet', '320', 34, 'SC549', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 10:22:03', '157.50.8.207'),
(450, 'Elocon Cream 10gm', '55', 'Elocon Cream', '479', 60, 'SC550', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-21 10:31:58', '106.208.179.103'),
(451, 'Tegrital 200mg Tablet', '53', 'Tegrital 200mg Tablet', '561', 28, 'SC551', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 10:25:37', '157.50.8.207'),
(452, 'Resteclin 500mg Capsule', '60', 'Resteclin 500mg Capsule', '2038', 27, 'SC552', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-20 10:28:17', '157.50.8.207'),
(453, 'Acitrom 3mg Tablet', '53', 'Acitrom 3mg Tablet', '326', 27, 'SC553', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 10:29:45', '157.50.8.207'),
(454, 'Acitrom 2mg Tablet', '53', 'Acitrom 2mg Tablet', '327', 27, 'SC554', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 10:31:03', '157.50.8.207'),
(455, 'Sporlac Tablet', '53', 'Sporlac Tablet', '328', 87, 'SC555', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 10:33:13', '157.50.8.207'),
(456, 'Zerostat VT Spacer', '75', 'Zerostat VT Spacer', '329', 1, 'SC556', 0, '0', 0, '1', '30049099', 1, '26', '2017-10-18 14:16:41', '49.207.184.24'),
(457, 'Ofm DS Syrup', '54', 'Ofm DS Syrup', '330', 25, 'SC557', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-20 10:36:02', '157.50.8.207'),
(458, 'Normal Saline 0.9% W/v Infusion', '57', 'Normal Saline 0.9% w/v Infusion', '2039', 88, 'SC558', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 10:39:22', '157.50.8.207'),
(459, 'Espumisan 80mg Capsule', '60', 'Espumisan 80mg Capsule', '334', 89, 'SC559', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-20 10:41:30', '157.50.8.207'),
(460, 'Mynberrys Compound Liquid', '81', 'Mynberrys Compound Liquid', '335', 72, 'SC560', 0, '0', 0, '10', '30049000', 1, '36', '2017-09-20 10:43:13', '157.50.8.207'),
(461, 'Piclin 5mg/ml Syrup', '54', 'Piclin 5mg/ml Syrup', '336', 89, 'SC561', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-20 10:44:59', '157.50.8.207'),
(462, 'Histac Evt 150mg Tablet', '53', 'Histac Evt 150mg Tablet', '121', 44, 'SC562', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 10:46:15', '157.50.8.207'),
(463, 'Ampilox DS 500mg/500mg Tablet', '53', 'Ampilox DS 500mg/500mg Tablet', '340', 43, 'SC563', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 10:47:25', '157.50.8.207'),
(464, 'Epival EC 200mg Tablet', '53', 'Epival EC 200mg Tablet', '2040', 44, 'SC564', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 10:49:14', '157.50.8.207'),
(465, 'Acivir 400mg Tablet DT', '53', 'Acivir 400mg Tablet DT', '34', 1, 'SC565', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 10:50:16', '157.50.8.207'),
(466, 'Clofert 50mg Tablet', '53', 'Clofert 50mg Tablet', '1292', 83, 'SC566', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 10:52:40', '157.50.8.207'),
(467, 'Ecosprin 75mg Tablet', '53', 'Ecosprin 75mg Tablet', '2041', 64, 'SC567', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 10:54:04', '157.50.8.207'),
(468, 'Spasmo Proxyvon Injection', '57', 'Spasmo Proxyvon Injection', '191', 75, 'SC568', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 10:55:51', '157.50.8.207'),
(469, 'Stugeron 25mg Tablet', '53', 'Stugeron 25mg Tablet', '2042', 65, 'SC569', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 13:36:28', '157.50.8.207'),
(470, 'Keto Soap', '75', 'Keto Soap', '220', 82, 'SC570', 0, '0', 0, 'Unit Not Available for this Product.', '30049000', 1, '36', '2017-09-20 13:38:55', '157.50.8.207'),
(471, 'Chapcure Cream', '55', 'Chapcure Cream', '349', 55, 'SC571', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-20 13:40:37', '157.50.8.207'),
(472, 'Unicontin-E 400mg Tablet CR', '53', 'Unicontin-E 400mg Tablet CR', '353', 80, 'SC572', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 13:41:58', '157.50.8.207'),
(473, 'A To Z NS Tablet', '53', 'v', '354', 90, 'SC573', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 13:45:07', '157.50.8.207'),
(474, 'Odirab 20mg Tablet', '53', 'Odirab 20mg Tablet', '195', 43, 'SC574', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 13:46:14', '157.50.8.207'),
(475, 'Acivir 3% W/w Eye Ointment', '77', 'Acivir 3% w/w Eye Ointment', '356', 1, 'SC575', 0, '0', 0, '1', '30049000', 1, '36', '2017-09-20 13:47:52', '157.50.8.207'),
(476, 'Ringer Lactate Infusion', '57', 'Ringer Lactate Infusion', '359', 68, 'SC576', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 13:50:20', '157.50.8.207'),
(477, 'Blumox P 125mg Tablet', '53', 'Blumox P 125mg Tablet', '1000', 35, 'SC577', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 13:51:54', '157.50.8.207'),
(478, 'Proctosedyl Ointment', '77', 'Proctosedyl Ointment', '367', 52, 'SC578', 0, '0', 0, '1', '30049000', 1, '36', '2017-09-20 13:53:26', '157.50.8.207'),
(479, 'Lasix 20mg Injection 2ml', '57', 'Lasix 20mg Injection', '368', 52, 'SC579', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 13:54:40', '157.50.8.207'),
(480, 'Biogaracin 80mg Injection', '57', 'Biogaracin 80mg Injection', '369', 43, 'SC580', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 13:56:06', '157.50.8.207'),
(481, 'Fevastin 150mg Injection', '57', 'Fevastin 150mg Injection', '370', 42, 'SC581', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 13:57:27', '157.50.8.207'),
(482, 'Zentel 400mg Tablet', '53', 'Zentel 400mg Tablet', '371', 26, 'SC582', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 13:58:57', '157.50.8.207'),
(483, 'Celin 500mg Tablet', '53', 'Celin 500mg Tablet', '372', 26, 'SC583', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 14:00:07', '157.50.8.207'),
(484, 'Domstal Baby Oral Drops', '80', 'Domstal Baby Oral Drops', '375', 34, 'SC584', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-20 14:07:05', '157.50.8.207'),
(485, 'Xamic 500mg Tablet', '53', 'Xamic 500mg Tablet', '1417', 34, 'SC585', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 14:08:15', '157.50.8.207'),
(486, 'Cremaffin Syrup Mixed Fruit', '54', 'Cremaffin Syrup Mixed fruit', '2043', 27, 'SC586', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-20 14:11:10', '157.50.8.207'),
(487, 'Monotax SB 250 Mg/125 Mg Injection', '57', 'Monotax SB 250 mg/125 mg Injection', '257', 43, 'SC587', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 14:13:07', '157.50.8.207'),
(488, 'Cetzine 5mg Syrup', '54', 'Cetzine 5mg Syrup', '1252', 26, 'SC588', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-20 14:15:18', '157.50.8.207'),
(489, 'Soframycin 1% Cream', '55', 'Soframycin 1% Cream', '383', 52, 'SC589', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-20 14:17:58', '157.50.8.207'),
(490, 'Allegra 120mg Tablet', '53', 'Allegra 120mg Tablet', '384', 52, 'SC590', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 14:19:25', '157.50.8.207'),
(491, 'Deriphyllin Injection 2ml', '57', 'Deriphyllin Injection 2ml', '385', 18, 'SC591', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 14:20:52', '157.50.8.207'),
(492, 'Hexigel 1% W/w Gel', '72', 'Hexigel 1% w/w Gel', '386', 91, 'SC592', 0, '0', 0, '14', '30049000', 1, '36', '2017-09-20 14:23:19', '157.50.8.207'),
(493, 'Domstal 1mg Suspension', '79', 'Domstal 1mg Suspension', '375', 34, 'SC593', 0, '0', 0, '9', '30049000', 1, '36', '2017-09-20 14:24:30', '157.50.8.207'),
(494, 'Sporlac Powder 4''S', '78', 'Sporlac Powder', '328', 87, 'SC594', 0, '0', 0, 'Unit Not Available for this Product.', '30049000', 1, '36', '2017-09-20 14:25:43', '157.50.8.207'),
(495, 'Alphadopa 500mg Tablet', '53', 'Alphadopa 500mg Tablet', '389', 75, 'SC595', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 14:26:56', '157.50.8.207'),
(496, 'Mazetol 200mg Tablet', '53', 'Mazetol 200mg Tablet', '561', 27, 'SC596', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 14:29:58', '157.50.8.207'),
(497, 'Evion 400mg Capsule', '60', 'Evion 400mg Capsule', '223', 49, 'SC597', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-20 14:31:17', '157.50.8.207'),
(498, 'Budecort 0.5mg Respules 2ml', '87', 'Budecort 0.5mg Respules 2ml', '395', 1, 'SC598', 0, '0', 0, '18', '30049000', 1, '36', '2017-09-20 14:32:52', '157.50.8.207'),
(499, 'Premence Plus Capsule', '60', 'Premence Plus Capsule', '400', 92, 'SC599', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-20 14:35:39', '157.50.8.207'),
(500, 'Pregna Cream', '55', 'Pregna Cream', '402', 92, 'SC600', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-20 18:51:20', '157.50.21.122'),
(501, 'Wellwoman Capsule', '60', 'Wellwoman Capsule', '403', 92, 'SC601', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-20 18:53:14', '157.50.21.122'),
(502, 'Liveril Forte Tablet', '53', 'Liveril Forte Tablet', '2044', 92, 'SC602', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 18:55:36', '157.50.21.122'),
(503, 'Aten 25mg Tablet', '53', 'Aten 25mg Tablet', '2045', 18, 'SC603', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 18:56:42', '157.50.21.122'),
(504, 'Ecosprin 150mg Tablet', '53', 'Ecosprin 150mg Tablet', '2046', 64, 'SC604', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 18:58:18', '157.50.21.122'),
(505, 'Happy Nap Cream', '55', 'Happy Nap Cream', '412', 36, 'SC605', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-20 19:01:48', '157.50.21.122'),
(506, 'Aldactone 25mg Tablet', '53', 'Aldactone 25mg Tablet', '416', 93, 'SC606', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 19:03:43', '157.50.21.122'),
(507, 'Recofast Plus Tablet', '53', 'Recofast Plus Tablet', '417', 79, 'SC607', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 19:04:41', '157.50.21.122'),
(508, 'Herperax 200mg Tablet', '53', 'Herperax 200mg Tablet', '119', 84, 'SC608', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 19:05:39', '157.50.21.122'),
(509, 'Edura Liquid Paraffin Syrup', '54', 'Edura Liquid Paraffin Syrup', '119', 94, 'SC609', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-20 19:13:00', '157.50.21.122'),
(510, 'Cardace 5mg Tablet', '53', 'Cardace 5mg Tablet', '2047', 52, 'SC610', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-20 22:37:15', '157.50.12.3'),
(511, 'Oxyton 5IU Injection', '57', 'Oxyton 5IU Injection', '503', 95, 'SC611', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-20 22:42:43', '157.50.12.3'),
(512, 'Metrogyl IV 500mg/5ml Infusion', '57', 'Metrogyl IV 500mg/5ml Infusion', '428', 25, 'SC612', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-21 06:03:08', '157.50.12.3'),
(513, 'Epidosin 8mg Injection', '57', 'Epidosin 8mg Injection', '429', 50, 'SC613', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-21 06:04:30', '157.50.12.3'),
(514, 'Deriphyllin OD 300mg Tablet', '53', 'Deriphyllin OD 300mg Tablet', '2031', 18, 'SC614', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 06:09:04', '157.50.12.3'),
(515, 'Botroclot 1CU Solution', '73', 'Botroclot 1CU Solution', '434', 72, 'SC615', 0, '0', 0, '15', '30049000', 1, '36', '2017-09-21 06:11:06', '157.50.12.3'),
(516, 'Tidilan 10mg Tablet', '53', 'Tidilan 10mg Tablet', '435', 72, 'SC616', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 06:12:33', '157.50.12.3'),
(517, 'Monotax XP 250mg/31.25mg Injection', '57', 'Monotax XP 250mg/31.25mg Injection', '276', 43, 'SC617', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-21 06:15:59', '157.50.12.3'),
(518, 'Amicin 500mg Injection', '57', 'Amicin 500mg Injection', '438', 43, 'SC618', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-21 06:17:32', '157.50.12.3'),
(519, 'Zinetac 300mg Tablet', '53', 'Zinetac 300mg Tablet', '439', 26, 'SC619', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 06:18:39', '157.50.12.3'),
(520, 'Ferradol Syrup', '54', 'Ferradol Syrup', '440', 96, 'SC620', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-21 06:21:16', '157.50.12.3'),
(521, 'Benadon Tablet', '53', 'Benadon Tablet', '441', 27, 'SC621', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 06:22:47', '157.50.12.3'),
(522, 'Human Actrapid 40IU Injection', '57', 'Human Actrapid 40IU Injection', '443', 74, 'SC622', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-21 06:25:27', '157.50.12.3'),
(523, 'Lasilactone 50 Tablet', '53', 'Lasilactone 50 Tablet', '445', 52, 'SC623', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 06:28:00', '157.50.12.3'),
(524, 'Frisium 5mg Tablet', '53', 'Frisium 5mg Tablet', '446', 52, 'SC624', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-21 06:29:20', '157.50.12.3'),
(525, 'Monotax L 200mg/250mg Tablet', '53', 'Monotax L 200mg/250mg Tablet', '379', 43, 'SC625', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 06:31:17', '157.50.12.3'),
(526, 'Candid 1% Mouth Paint', '82', 'Candid 1% Mouth Paint', '448', 63, 'SC626', 0, '0', 0, '11', '30049000', 1, '36', '2017-09-21 06:32:54', '157.50.12.3'),
(527, 'Haem UP Liquid', '81', 'Haem UP Liquid', '450', 97, 'SC627', 0, '0', 0, '10', '30049000', 1, '36', '2017-09-21 06:34:56', '157.50.12.3'),
(528, 'Stiloz 50mg Tablet', '53', 'Stiloz 50mg Tablet', '451', 63, 'SC628', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 15:22:24', '157.50.14.255'),
(529, 'Candid-B Cream', '55', 'Candid-B Cream', '455', 63, 'SC629', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-21 06:37:37', '157.50.12.3'),
(530, 'Oflomac 100mg Tablet', '53', 'Oflomac 100mg Tablet', '258', 53, 'SC630', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 06:40:02', '157.50.12.3'),
(531, 'Candid TV Suspension', '79', 'Candid TV Suspension', '2048', 63, 'SC631', 0, '0', 0, '9', '30049000', 1, '36', '2017-09-21 09:56:35', '157.50.10.184'),
(532, 'Zyloric 100mg Tablet', '53', 'Zyloric 100mg Tablet', '460', 26, 'SC632', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 09:58:24', '157.50.10.184'),
(533, 'Pyridoxine Hcl Tablet', '53', 'Pyridoxine Hcl Tablet', '441', 98, 'SC633', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 10:04:42', '106.208.179.103'),
(534, 'Penvir 500mg Tablet', '53', 'Penvir 500mg Tablet', '463', 67, 'SC634', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 10:06:59', '106.208.179.103'),
(535, 'Nebasulf Dusting Powder', '78', 'Nebasulf Dusting Powder', '1781', 23, 'SC635', 0, '0', 0, 'Unit Not Available for this Product.', '30049000', 1, '36', '2017-09-21 10:08:58', '106.208.179.103'),
(536, 'Sodium Chloride Injection', '57', 'Sodium Chloride Injection', '394', 99, 'SC636', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-21 10:10:14', '106.208.179.103'),
(537, 'Enzymin Syrup', '54', 'Enzymin Syrup', '2049', 19, 'SC637', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-21 10:12:05', '106.208.179.103'),
(538, 'Gynovit Syrup', '54', 'Gynovit Syrup', '470', 100, 'SC638', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-21 10:14:20', '106.208.179.103'),
(539, 'Losar 50mg Tablet', '53', 'Losar 50mg Tablet', '471', 24, 'SC639', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 10:15:29', '106.208.179.103'),
(540, 'Pam 500mg Injection', '57', 'Pam 500mg Injection', '473', 101, 'SC640', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-21 10:17:33', '106.208.179.103'),
(541, 'Mannitol 20%W/V Infusion', '57', 'Mannitol 20%W/V Infusion', '2050', 68, 'SC641', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-21 10:20:17', '106.208.179.103'),
(542, 'Rhoclone 300mcg Injection', '57', 'Rhoclone 300mcg Injection', '477', 51, 'SC642', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-21 15:48:09', '157.50.14.255'),
(543, 'Dipsalic F Ointment', '77', 'Dipsalic F Ointment', '478', 60, 'SC643', 0, '0', 0, '1', '30049000', 1, '36', '2017-09-21 10:30:38', '106.208.179.103'),
(544, 'Elocon Cream 30mg', '55', 'Elocon Cream 30mg', '479', 60, 'SC644', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-21 10:32:42', '106.208.179.103'),
(545, 'Selsun Shampoo', '81', 'Selsun Shampoo', '482', 27, 'SC645', 0, '0', 0, '10', '30049000', 1, '36', '2017-09-21 10:41:39', '106.208.179.103'),
(546, 'Sibelium 10mg Tablet', '53', 'Sibelium 10mg Tablet', '483', 65, 'SC646', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 10:43:36', '106.208.179.103'),
(547, 'Ciplactin 4mg Tablet', '53', 'Ciplactin 4mg Tablet', '484', 1, 'SC647', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 11:44:15', '106.208.179.103'),
(548, 'Liofen 10mg Tablet', '53', 'Liofen 10mg Tablet', '487', 44, 'SC648', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 11:47:22', '106.208.179.103'),
(549, 'Atarax 25mg Tablet', '53', 'Atarax 25mg Tablet', '488', 48, 'SC649', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 11:53:51', '106.208.179.103'),
(550, 'Phexin BD 750mg Tablet', '53', 'Phexin BD 750mg Tablet', '489', 26, 'SC650', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 11:55:20', '106.208.179.103'),
(551, 'Asthalin 2mg/5ml Syrup', '54', 'Asthalin 2mg/5ml Syrup', '397', 1, 'SC651', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-21 11:57:23', '106.208.179.103'),
(552, 'Lariago Suspension', '79', 'Lariago Suspension', '55', 37, 'SC652', 0, '0', 0, '9', '30049000', 1, '36', '2017-09-21 11:58:16', '106.208.179.103'),
(553, 'Coscopin Syrup', '54', 'Coscopin Syrup', '2052', 33, 'SC653', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-21 12:01:40', '106.208.179.103'),
(554, 'Tusq P 1mg/125mg/2.5mg Liquid', '81', 'Tusq P 1mg/125mg/2.5mg Liquid', '302', 35, 'SC654', 0, '0', 0, '10', '30049000', 1, '36', '2017-09-21 12:03:13', '106.208.179.103'),
(555, 'Aptimust Syrup', '54', 'Aptimust Syrup', '497', 45, 'SC655', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-21 12:04:12', '106.208.179.103'),
(556, 'Vomilast Tablet', '53', 'Vomilast Tablet', '498', 45, 'SC656', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 12:05:25', '106.208.179.103'),
(557, 'Asthakind DX 5 Mg/2 Mg/15 Mg Syrup', '54', 'Asthakind DX 5 mg/2 mg/15 mg Syrup', '2053', 45, 'SC657', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-21 12:07:08', '106.208.179.103'),
(558, 'Biopreg -F Tablet', '53', 'Biopreg -F Tablet', '2054', 45, 'SC658', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 12:08:24', '106.208.179.103'),
(559, 'Hepa Merz Syrup', '54', 'Hepa Merz Syrup', '501', 85, 'SC659', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-21 12:10:13', '106.208.179.103'),
(560, 'Vertidom Tablet', '53', 'Vertidom Tablet', '171', 102, 'SC660', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 12:11:57', '106.208.179.103'),
(561, 'Monticope -Kid Tablet', '53', 'Monticope -Kid Tablet', '504', 45, 'SC661', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 12:14:26', '106.208.179.103'),
(562, 'Nuforce 3 Kit', '75', 'Nuforce 3 Kit', '505', 45, 'SC662', 0, '0', 0, 'Unit Not Available for this Product.', '30049000', 1, '36', '2017-09-21 12:15:31', '106.208.179.103'),
(563, 'Folinz Tablet', '53', 'Folinz Tablet', '506', 36, 'SC663', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 13:25:44', '157.50.14.255'),
(564, 'Stamlo Beta Tablet', '53', 'Stamlo Beta Tablet', '508', 48, 'SC664', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 13:28:58', '157.50.14.255'),
(565, 'Genticyn Eye Drop', '80', 'Genticyn Eye Drop', '509', 27, 'SC665', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-21 13:30:11', '157.50.14.255'),
(566, 'Kenacort 10mg Injection', '57', 'Kenacort 10mg Injection', '510', 27, 'SC666', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-21 13:31:27', '157.50.14.255'),
(567, 'Cardace 2.5mg Tablet', '53', 'Cardace 2.5mg Tablet', '511', 52, 'SC667', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 13:32:46', '157.50.14.255'),
(568, 'Placentrex 0.1gm Gel', '72', 'Placentrex 0.1gm Gel', '512', 68, 'SC668', 0, '0', 0, '14', '30049000', 1, '36', '2017-09-21 13:34:23', '157.50.14.255'),
(569, 'Lactodex -Nmw 1 Powder', '78', 'Lactodex -Nmw 1 Powder', '513', 73, 'SC669', 0, '0', 0, 'Unit Not Available for this Product.', '30049000', 1, '36', '2017-09-21 15:03:24', '157.50.14.255'),
(570, 'Piracetam (500mg)', '54', 'Piracetam (500mg)', '515', 84, 'SC670', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-21 15:07:37', '157.50.14.255'),
(571, 'Dextrose 5% Infusion', '57', 'Dextrose 5% Infusion', '360', 103, 'SC671', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-21 15:10:51', '157.50.14.255'),
(572, 'Laxitol Syrup', '54', 'Laxitol Syrup', '525', 53, 'SC672', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-21 15:12:04', '157.50.14.255'),
(573, 'Termin 30mg Injection', '57', 'Termin 30mg Injection', '527', 104, 'SC673', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-21 15:14:22', '157.50.14.255'),
(574, 'Kerala Ayurveda Mahanarayana Thailam', '82', 'Kerala Ayurveda Mahanarayana Thailam', '470', 105, 'SC674', 0, '0', 0, '11', '30049000', 1, '36', '2017-09-21 15:16:28', '157.50.14.255'),
(575, 'Oflomac Forte Syrup', '54', 'Oflomac Forte Syrup', '258', 53, 'SC675', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-21 15:17:31', '157.50.14.255'),
(576, 'Shelcal Syrup', '54', 'Shelcal Syrup', '530', 34, 'SC676', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-21 15:19:18', '157.50.14.255'),
(577, 'Shelcal - 500 Tablet', '53', 'Shelcal - 500 Tablet', '530', 34, 'SC677', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 15:20:18', '157.50.14.255'),
(578, 'Chymoral Forte Tablet', '53', 'Chymoral Forte Tablet', '535', 34, 'SC678', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 15:25:32', '157.50.14.255'),
(579, 'Lariago 64.5mg Injection', '57', 'Lariago 64.5mg Injection', '486', 37, 'SC679', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-21 15:31:43', '157.50.14.255'),
(580, 'Lariago 40mg Injection', '57', 'Lariago 40mg Injection', '537', 37, 'SC680', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-21 15:33:45', '157.50.14.255'),
(581, 'Silybon -140 Tablet', '53', 'Silybon -140 Tablet', '405', 84, 'SC681', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 15:39:00', '157.50.14.255'),
(582, 'Norflox TZ Tablet', '53', 'Norflox TZ Tablet', '1882', 1, 'SC682', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 15:41:03', '157.50.14.255'),
(583, 'Tryptomer 10mg Tablet', '53', 'Tryptomer 10mg Tablet', '290', 75, 'SC683', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-21 15:42:17', '157.50.14.255'),
(584, 'Wikoryl DS Syrup', '54', 'Wikoryl DS Syrup', '2055', 22, 'SC684', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-21 15:44:02', '157.50.14.255'),
(585, 'Rotarix Oral Vaccine', '57', 'Rotarix Oral Vaccine', '548', 26, 'SC685', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-21 15:47:37', '157.50.14.255'),
(586, 'Typbar Vaccine', '57', 'Typbar Vaccine', '550', 77, 'SC686', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-21 15:49:38', '157.50.14.255'),
(587, 'Hucog - 5000 HP Injection', '57', 'Hucog - 5000 HP Injection', '551', 51, 'SC687', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-21 15:50:39', '157.50.14.255'),
(588, 'Prolouton Dpt Injection', '57', 'Prolouton Dpt Injection', '552', 97, 'SC688', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-21 15:51:47', '157.50.14.255'),
(589, 'Atarax 10mg Syrup', '54', 'Atarax 10mg Syrup', '553', 48, 'SC689', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-21 15:53:33', '157.50.14.255'),
(590, 'Sucrafil 500mg/5ml Suspension', '79', 'Sucrafil 500mg/5ml Suspension', '554', 106, 'SC690', 0, '0', 0, '9', '30049000', 1, '36', '2017-09-21 15:55:39', '157.50.14.255'),
(591, 'Caladryl Lotion', '52', 'Caladryl Lotion', '555', 96, 'SC691', 0, '0', 0, '4', '30049000', 1, '36', '2017-09-21 15:59:13', '157.50.14.255'),
(592, 'Mucolite Drop', '80', 'Mucolite Drop', '201', 48, 'SC692', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-21 16:00:34', '157.50.14.255'),
(593, 'Candid-B Lotion', '52', 'Candid-B Lotion', '455', 63, 'SC693', 0, '0', 0, '4', '30049000', 1, '36', '2017-09-22 08:06:42', '157.50.13.170'),
(594, 'Tegrital Syrup', '54', 'Tegrital Syrup', '2056', 28, 'SC694', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-22 08:09:27', '157.50.13.170'),
(595, 'Meprate 2.5mg Tablet', '53', 'Meprate 2.5mg Tablet', '2057', 54, 'SC695', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 08:11:14', '157.50.13.170'),
(596, 'Ambistryn-S 0.75gm Injection', '57', 'Ambistryn-S 0.75gm Injection', '564', 27, 'SC696', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-22 08:12:42', '157.50.13.170'),
(597, 'Phenergan Syrup', '54', 'Phenergan Syrup', '565', 27, 'SC697', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-22 08:14:04', '157.50.13.170'),
(598, 'Festal N 212.5mg Tablet', '53', 'Festal N 212.5mg Tablet', '566', 52, 'SC698', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 08:15:04', '157.50.13.170'),
(599, 'Simyl Mct Oil', '81', 'Simyl Mct Oil', '567', 107, 'SC699', 0, '0', 0, '10', '30049000', 1, '36', '2017-09-22 08:18:59', '157.50.13.170'),
(600, 'Shield Ointment', '77', 'Shield Ointment', '2058', 26, 'SC700', 0, '0', 0, '1', '30049000', 1, '36', '2017-09-22 08:20:21', '157.50.13.170'),
(601, 'Wikoryl Drop', '80', 'Wikoryl Drop', '545', 22, 'SC701', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-22 08:23:26', '157.50.13.170'),
(602, 'Autrin Capsule', '60', 'Autrin Capsule', '573', 23, 'SC702', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-22 08:24:52', '157.50.13.170'),
(603, 'Bactrim DS 800 Mg/160 Mg Tablet', '53', 'Bactrim DS 800 mg/160 mg Tablet', '574', 27, 'SC703', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 08:25:42', '157.50.13.170'),
(604, 'Meftal Spas Drop', '80', 'Meftal Spas Drop', '575', 35, 'SC704', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-22 08:27:22', '157.50.13.170'),
(605, 'Solonex 100mg Tablet DT', '53', 'Solonex 100mg Tablet DT', '576', 53, 'SC705', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 08:28:06', '157.50.13.170'),
(606, 'Candiderma Plus Cream', '55', 'Candiderma Plus Cream', '2059', 63, 'SC706', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-22 08:29:52', '157.50.13.170'),
(607, 'Domstal 10mg Tablet', '53', 'Domstal 10mg Tablet', '579', 34, 'SC707', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 08:32:21', '157.50.13.170'),
(608, 'Fortwin 30mg Injection', '57', 'Fortwin 30mg Injection', '582', 44, 'SC708', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-22 08:36:58', '157.50.13.170'),
(609, 'Colimex Oral Drops', '80', 'Colimex Oral Drops', '583', 21, 'SC709', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-22 08:39:48', '157.50.13.170'),
(610, 'Diovol Forte Mango Syrup', '54', 'Diovol Forte Mango Syrup', '584', 21, 'SC710', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-22 08:44:39', '157.50.13.170'),
(611, 'Brozeet SF Syrup', '54', 'Brozeet SF Syrup', '60', 22, 'SC711', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-22 08:47:35', '157.50.13.170'),
(612, 'Becosules Capsule', '60', 'Becosules Capsule', '590', 23, 'SC712', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-22 08:49:40', '157.50.13.170'),
(613, 'Zeet 12 Syrup', '54', 'Zeet 12 Syrup', '167', 22, 'SC713', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-22 08:51:32', '157.50.13.170'),
(614, 'Coscoril 50 Mg/1.25 Mg/4 Mg Syrup', '54', 'Coscoril 50 mg/1.25 mg/4 mg Syrup', '300', 33, 'SC714', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-22 08:54:09', '157.50.13.170'),
(615, 'Gardenal 30mg Tablet', '53', 'Gardenal 30mg Tablet', '594', 27, 'SC715', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 08:55:29', '157.50.13.170'),
(616, 'Dns Solution', '73', 'Dns Solution', '2060', 108, 'SC716', 0, '0', 0, '15', '30049000', 1, '36', '2017-09-22 08:57:51', '157.50.13.170'),
(617, 'Ors Liquid Apple', '81', 'Ors Liquid Apple', '596', 1, 'SC717', 0, '0', 0, '10', '30049000', 1, '36', '2017-09-22 08:59:42', '157.50.13.170'),
(618, 'Rapither AB 150mg Injection', '57', 'Rapither AB 150mg Injection', '150', 37, 'SC718', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-22 09:00:59', '157.50.13.170'),
(619, 'Oflomac 200mg Tablet', '53', 'Oflomac 200mg Tablet', '10', 53, 'SC719', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 11:28:30', '157.50.12.79'),
(620, 'Omnacortil 5mg/ml Drop', '80', 'Omnacortil 5mg/ml Drop', '225', 53, 'SC720', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-22 11:38:12', '157.50.12.79'),
(621, 'Atarax', '53', 'Atarax ', '553', 48, 'SC721', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-22 13:37:39', '117.221.128.173'),
(622, 'Levoday', '53', 'Levoday', '2068', 18, 'SC722', 0, '0', 0, '1', '30049000', 1, '36', '2017-09-22 14:09:46', '117.221.128.173'),
(623, 'Nizral 2%', '73', 'Nizral 2%', '2070', 65, 'SC723', 0, '0', 0, '15', '30049000', 1, '36', '2017-09-22 15:01:17', '117.221.131.112'),
(624, 'Candid TV', '79', 'Candid TV ', '2048', 63, 'SC724', 0, '0', 0, '9', '30049000', 1, '36', '2017-09-22 15:11:14', '117.221.131.112'),
(625, 'Indocap 75mg Capsule SR', '60', 'Indocap 75mg Capsule SR', '608', 46, 'SC725', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-22 16:42:47', '117.221.135.89'),
(626, 'Urikind K', '54', 'Urikind k', '616', 45, 'SC726', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-22 17:08:16', '117.221.135.89'),
(627, 'Budecort 200mg Rotacap', '71', 'Budecort 200mg Rotacap', '2073', 1, 'SC727', 0, '0', 0, '16', '30049000', 1, '36', '2017-09-22 17:10:36', '117.221.135.89'),
(628, 'Himalaya Bonnispaz Drop', '80', 'Himalaya Bonnispaz Drop', '2074', 31, 'SC728', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-22 17:14:03', '117.221.135.89'),
(629, 'Hepatoglobine Forte Syrup', '54', 'Hepatoglobine Forte Syrup', '2089', 73, 'SC729', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-22 17:22:45', '117.221.135.89'),
(630, 'Maltviron Syrup', '54', 'Maltviron Syrup', '2092', 109, 'SC730', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-22 17:33:43', '117.221.135.89'),
(631, 'A To Z NS Syrup', '54', 'A to Z NS Syrup', '2093', 90, 'SC731', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-22 17:38:19', '117.221.135.89'),
(632, 'Retino-a', '55', 'Retino-a ', '2095', 65, 'SC732', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-22 17:44:33', '117.221.135.89'),
(633, 'Avil', '57', 'Avil ', '2096', 52, 'SC733', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-22 17:49:46', '117.221.135.89'),
(634, 'Lariago', '57', 'Lariago ', '537', 37, 'SC734', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-22 17:55:13', '117.221.135.89'),
(635, 'Elocon Cream', '55', 'Elocon Cream', '479', 60, 'SC735', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-22 17:58:03', '117.221.135.89'),
(636, 'Krack Heel Repair Cream', '55', 'Krack Heel Repair Cream', '2098', 41, 'SC736', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-22 18:11:05', '117.221.135.89'),
(637, 'Peritop', '55', 'Peritop cream', '2099', 38, 'SC737', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-22 18:15:10', '117.221.135.89'),
(638, 'Candid-B', '55', 'Candid-B', '455', 63, 'SC738', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-22 18:20:37', '117.221.135.89'),
(639, 'Metrogyl', '72', 'Metrogyl ', '2100', 25, 'SC739', 0, '0', 0, '14', '30049000', 1, '36', '2017-09-22 18:26:40', '117.221.135.89'),
(640, 'Smuth Cream', '55', 'Smuth Cream', '2105', 69, 'SC740', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-22 18:34:37', '117.221.135.89'),
(641, 'Candid-V 2%', '72', 'Candid-V 2%', '459', 63, 'SC741', 0, '0', 0, '14', '30049000', 1, '36', '2017-09-22 18:37:45', '117.221.135.89'),
(642, 'Fusiwal', '77', 'Fusiwal ', '2106', 21, 'SC742', 0, '0', 0, '21', '30049000', 1, '36', '2017-09-22 18:45:07', '117.221.135.89'),
(643, 'Caladryl', '52', 'Caladryl ', '2107', 96, 'SC743', 0, '0', 0, '4', '30049000', 1, '36', '2017-09-22 19:04:59', '117.201.30.250'),
(644, 'Meftal P', '54', 'Meftal P ', '2108', 35, 'SC744', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-22 19:13:54', '117.201.30.250'),
(645, 'Benadon', '53', 'Benadon ', '2109', 27, 'SC745', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-22 19:24:50', '117.201.30.250'),
(646, 'Ambistryn-S', '57', 'Ambistryn-S', '2114', 27, 'SC746', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-22 19:29:53', '117.201.30.250'),
(647, 'Sharkoferrol', '54', 'Sharkoferrol ', '2115', 22, 'SC747', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-22 19:36:05', '117.201.30.250'),
(648, 'Nootropil', '54', 'Nootropil', '2116', 48, 'SC748', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-22 19:42:25', '117.201.30.250'),
(649, 'Calmpose', '57', 'Calmpose', '2118', 44, 'SC749', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-22 19:53:04', '103.204.29.216'),
(650, 'Espazine', '53', 'Espazine', '648', 26, 'SC750', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-22 19:56:14', '103.204.29.216'),
(651, 'Encephabol', '79', 'Encephabol', '228', 49, 'SC751', 0, '0', 0, '9', '30049000', 1, '36', '2017-09-22 19:58:37', '103.204.29.216'),
(652, 'Althrocin Kid', '53', 'Althrocin Kid', '2120', 22, 'SC752', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 20:01:58', '103.204.29.216'),
(653, 'Brozeet', '54', 'Brozeet ', '161', 22, 'SC753', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-22 20:04:47', '103.204.29.216'),
(654, 'K-Win', '57', 'K-Win ', '219', 66, 'SC754', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-22 20:07:49', '103.204.29.216'),
(655, 'Evion', '60', 'Evion ', '2121', 49, 'SC755', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-22 20:14:32', '103.204.29.216'),
(656, 'Asthalin', '53', 'Asthalin ', '2123', 1, 'SC756', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 20:19:10', '103.204.29.216'),
(657, 'Dolonex', '53', 'Dolonex', '240', 23, 'SC757', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 20:21:53', '103.204.29.216'),
(658, 'Caverta', '53', 'Caverta', '2124', 44, 'SC758', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 20:25:05', '103.204.29.216'),
(659, 'Betnesol', '53', 'Betnesol', '2127', 26, 'SC759', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 20:32:14', '103.204.29.216'),
(660, 'Phenergan', '57', 'Phenergan ', '252', 27, 'SC760', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-22 20:35:17', '103.204.29.216'),
(661, 'Zinetac', '53', 'Zinetac', '121', 26, 'SC761', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 20:40:15', '103.204.29.216'),
(662, 'Deriphyllin Retard', '53', 'Deriphyllin Retard ', '2031', 18, 'SC762', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 20:52:56', '103.204.29.216'),
(663, 'Ascoril LS', '54', 'Ascoril LS', '2128', 63, 'SC763', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-22 20:56:12', '103.204.29.216'),
(664, 'Stugeron Forte', '53', 'Stugeron Forte', '2129', 65, 'SC764', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 21:03:23', '103.204.29.216'),
(665, 'Althrocin', '53', 'Althrocin', '2130', 22, 'SC765', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 21:07:05', '103.204.29.216'),
(666, 'Nasivion Paediatric', '80', 'Nasivion Paediatric', '2131', 49, 'SC766', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-22 21:33:16', '103.204.29.216'),
(667, 'Pyridium', '53', 'Pyridium ', '2134', 89, 'SC767', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 21:37:08', '103.204.29.216'),
(668, 'Voveran', '53', 'Voveran', '672', 28, 'SC768', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 21:40:06', '103.204.29.216'),
(669, 'Tusq DX New', '53', 'Tusq DX New ', '2135', 35, 'SC769', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 21:45:56', '103.204.29.216'),
(670, 'Moov', '77', 'Moov ', '2136', 41, 'SC770', 0, '0', 0, '21', '30049000', 1, '36', '2017-09-22 22:05:59', '103.204.29.216'),
(671, 'Letoval', '53', 'Letoval', '97', 44, 'SC771', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 22:08:25', '103.204.29.216'),
(672, 'Labebet', '53', 'Labebet', '1213', 44, 'SC772', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 22:15:02', '103.204.29.216'),
(673, 'Lasilactone', '53', 'Lasilactone', '445', 52, 'SC773', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 22:18:57', '103.204.29.216'),
(674, 'Oflomac', '53', 'Oflomac', '10', 53, 'SC774', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 22:22:41', '103.204.29.216'),
(675, 'Allegra', '53', 'Allegra', '384', 52, 'SC775', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 22:29:55', '103.204.29.216');
INSERT INTO `product` (`productid`, `productname`, `product_typeid`, `sort_description`, `composition_id`, `manufacturer_id`, `product_code`, `minstock`, `reorderlevelstock`, `maxstock`, `unit`, `hsn_code`, `is_active`, `updatedby`, `updatedon`, `updated_ipaddress`) VALUES
(676, 'Disprin', '53', 'Disprin ', '2140', 110, 'SC776', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 22:35:59', '103.204.29.216'),
(677, 'Ascoril D', '54', 'Ascoril D', '160', 63, 'SC777', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-22 22:43:09', '103.204.29.216'),
(678, 'Coscopin Paed', '54', 'Coscopin Paed', '2144', 33, 'SC778', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-22 22:56:01', '103.204.29.216'),
(679, 'Brutex G', '54', 'Brutex G', '2035', 112, 'SC779', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-22 23:08:03', '103.204.29.216'),
(680, 'Cifran CT', '53', 'Cifran CT ', '398', 44, 'SC780', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 23:14:07', '103.204.29.216'),
(681, 'Wikoryl DS', '54', '', '2055', 22, 'SC781', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-22 23:28:45', '103.204.29.216'),
(682, 'Febrex Plus', '53', 'Febrex Plus', '1814', 30, 'SC782', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-22 23:36:31', '103.204.29.216'),
(683, 'Coscoril', '54', 'Coscoril ', '300', 33, 'SC783', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-22 23:43:24', '103.204.29.216'),
(684, 'Monotax', '57', 'Monotax ', '159', 43, 'SC784', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-22 23:54:28', '103.204.29.216'),
(685, 'Thrombophob', '77', 'Thrombophob ', '2146', 18, 'SC785', 0, '0', 0, '21', '30049000', 1, '36', '2017-09-23 00:00:55', '103.204.29.216'),
(686, 'Blumox P', '53', 'Blumox P', '1000', 35, 'SC786', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 00:04:35', '103.204.29.216'),
(687, 'Onecan', '53', 'Onecan ', '2147', 21, 'SC787', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 00:07:11', '103.204.29.216'),
(688, 'Contractubex Gel', '72', 'Contractubex Gel', '2148', 85, 'SC788', 0, '0', 0, '14', '30049000', 1, '36', '2017-09-23 00:10:28', '103.204.29.216'),
(689, 'Topcid', '53', 'Topcid ', '2148', 34, 'SC789', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 00:13:11', '103.204.29.216'),
(690, 'Periset', '54', 'Periset ', '37', 37, 'SC790', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-23 00:19:54', '117.201.17.250'),
(691, 'Betadine', '77', 'Betadine', '241', 85, 'SC791', 0, '0', 0, '21', '30049000', 1, '36', '2017-09-23 00:23:24', '117.201.17.250'),
(692, 'Mucaine Gel Mint', '72', 'Mucaine Gel Mint', '2150', 23, 'SC792', 0, '0', 0, '14', '30049000', 1, '36', '2017-09-23 00:27:27', '117.201.17.250'),
(693, 'Saridon', '53', 'Saridon ', '2152', 96, 'SC793', 0, '0', 0, '20', '30049000', 1, '36', '2017-09-23 00:37:36', '117.201.17.250'),
(694, 'Silverex Ionic Gel', '72', 'Silverex Ionic', '2153', 44, 'SC794', 0, '0', 0, '14', '30049000', 1, '36', '2017-09-23 00:43:39', '117.201.17.250'),
(695, 'Candid 1% Dusting Powder', '78', 'Candid 1% Dusting Powder', '459', 63, 'SC795', 0, '0', 0, '25', '30049000', 1, '36', '2017-09-23 00:58:35', '117.201.17.250'),
(696, 'Metrogyl DG Forte', '54', 'Metrogyl DG Forte', '2', 25, 'SC796', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-23 01:07:30', '117.201.17.250'),
(697, 'Pregalin M', '60', 'Pregalin M', '304', 34, 'SC797', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-23 07:59:41', '59.93.9.243'),
(698, 'Epival', '54', 'Epival', '341', 44, 'SC798', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-23 08:07:26', '59.93.9.243'),
(699, 'Atrowok', '57', 'Atrowok ', '2155', 75, 'SC799', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-23 08:30:14', '59.93.9.243'),
(700, 'Diltigesic', '72', 'Diltigesic', '2156', 113, 'SC800', 0, '0', 0, '14', '30049000', 1, '36', '2017-09-23 08:37:48', '59.93.9.243'),
(701, 'Sensesit', '60', 'Sensesit ', '304', 114, 'SC801', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-23 08:41:57', '59.93.9.243'),
(702, 'Candiforce', '60', 'Candiforce ', '2157', 45, 'SC802', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-23 08:44:59', '59.93.9.243'),
(703, 'Duphaston', '53', 'Duphaston', '2158', 27, 'SC803', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-23 08:49:31', '59.93.9.243'),
(704, 'Cinkona', '53', 'Cinkona', '2159', 37, 'SC804', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-23 08:52:19', '59.93.9.243'),
(705, 'Diamox', '53', 'Diamox ', '2160', 23, 'SC805', 0, '0', 0, '20', '30049000', 1, '36', '2017-09-23 08:54:43', '59.93.9.243'),
(706, 'Hucog - 10000', '57', 'Hucog - 10000', '2161', 51, 'SC806', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-23 08:57:33', '59.93.9.243'),
(707, 'Doxolin', '53', 'Doxolin', '2162', 18, 'SC807', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 09:00:01', '59.93.9.243'),
(708, 'Aten 50mg Tablet', '53', 'Aten 50mg Tablet', '2163', 18, 'SC808', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 16:18:11', '117.222.161.88'),
(709, 'Penvir 250mg Tablet', '53', 'Penvir 250mg Tablet', '2164', 67, 'SC809', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 16:20:12', '117.222.161.88'),
(710, 'Geminor M 2 Tablet SR', '53', 'Geminor M 2 Tablet SR', '2165', 53, 'SC810', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 16:25:28', '117.222.161.88'),
(711, 'Rejumet 500mg Tablet', '53', 'Rejumet 500mg Tablet', '753', 106, 'SC811', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 16:30:11', '117.222.161.88'),
(712, 'Seroflo 100 Rotacap', '71', 'Seroflo 100 Rotacap', '2166', 1, 'SC812', 0, '0', 0, '16', '30049099', 1, '26', '2017-10-18 14:17:06', '49.207.184.24'),
(713, 'Pyzina 750mg Tablet', '53', 'Pyzina 750mg Tablet', '2167', 9, 'SC813', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 16:37:38', '117.222.161.88'),
(714, 'Microcid 75mg Capsule SR', '60', 'Microcid 75mg Capsule SR', '608', 84, 'SC814', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-23 16:40:02', '117.222.161.88'),
(715, 'Fruselac Tablet', '53', 'Fruselac Tablet', '445', 9, 'SC815', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 16:41:48', '117.222.161.88'),
(716, 'Anaspas 50 Mg/50 Mg Tablet', '53', 'Anaspas 50 mg/50 mg Tablet', '762', 27, 'SC816', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 16:43:38', '117.222.161.88'),
(717, 'Lumerax Dry Syrup', '54', 'Lumerax Dry Syrup', '764', 37, 'SC817', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-23 16:47:07', '117.222.161.88'),
(718, 'Biotax O 50mg Syrup', '54', 'Biotax O 50mg Syrup', '1298', 43, 'SC818', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-23 16:49:15', '117.222.161.88'),
(719, 'Topcid 40mg Tablet', '53', 'Topcid 40mg Tablet', '706', 34, 'SC819', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 16:50:58', '117.222.161.88'),
(720, 'Quadriderm RF Cream', '55', 'Quadriderm RF Cream', '2168', 60, 'SC820', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-23 16:56:29', '117.222.161.88'),
(721, 'HH Sone 0.1% W/w Cream', '55', 'HH Sone 0.1% w/w Cream', '2169', 117, 'SC821', 0, '0', 0, '27', '30049000', 1, '36', '2017-09-23 17:03:40', '117.222.161.88'),
(722, 'Zyfor 300mg Tablet ER', '53', 'Zyfor 300mg Tablet ER', '2170', 43, 'SC822', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 17:14:46', '117.221.131.116'),
(723, 'Pantocid D Capsule', '60', 'Pantocid D Capsule', '2171', 44, 'SC823', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-23 17:17:17', '117.221.131.116'),
(724, 'Monticope-A Tablet', '53', 'Monticope-A Tablet', '2172', 45, 'SC824', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 17:20:04', '117.221.131.116'),
(725, 'Rutoheal Tablet', '53', 'Rutoheal Tablet', '777', 10, 'SC825', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 17:24:24', '117.221.131.116'),
(726, 'M Strong PG Tablet', '53', 'M Strong PG Tablet', '304', 118, 'SC826', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 17:33:01', '117.221.131.116'),
(727, 'Pyzina 500mg Tablet', '53', 'Pyzina 500mg Tablet', '2177', 9, 'SC827', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 17:35:04', '117.221.131.116'),
(728, 'Drotikind 40mg Injection', '57', 'Drotikind 40mg Injection', '1149', 45, 'SC828', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-23 17:38:35', '117.221.131.116'),
(729, 'Evatone 2mg Tablet', '53', 'Evatone 2mg Tablet', '2178', 54, 'SC829', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 17:54:14', '117.201.28.84'),
(730, 'Levipil 250mg Tablet', '53', 'Levipil 250mg Tablet', '2179', 44, 'SC830', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 18:02:55', '117.201.28.84'),
(731, 'Glycomet-GP 2 Tablet SR', '53', 'Glycomet-GP 2 Tablet SR', '1135', 64, 'SC831', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 18:04:48', '117.201.28.84'),
(732, 'Chymonac Tablet', '53', 'Chymonac Tablet', '1638', 119, 'SC832', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 18:08:00', '117.201.28.84'),
(733, 'Nexpro 20mg Tablet', '53', 'Nexpro 20mg Tablet', '2180', 34, 'SC833', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 18:10:09', '117.201.28.84'),
(734, 'Cefolac 25mg Oral Drops', '53', 'Cefolac 25mg Oral Drops', '765', 53, 'SC834', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 18:13:00', '117.201.28.84'),
(735, 'Nuforce-CD 3 Suppository', '53', 'Nuforce-CD 3 Suppository', '801', 45, 'SC835', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 18:16:31', '117.201.28.84'),
(736, 'Monotrate SR 30mg Tablet', '53', 'Monotrate SR 30mg Tablet', '2181', 44, 'SC836', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 18:21:50', '117.201.28.84'),
(737, 'Nexito 5mg Tablet', '53', 'Nexito 5mg Tablet', '2182', 44, 'SC837', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 18:25:18', '117.201.28.84'),
(738, 'Glycomet 500mg Tablet SR', '53', 'Glycomet 500mg Tablet SR', '2183', 64, 'SC838', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 18:31:15', '117.201.28.84'),
(739, 'Strone 200mg Tablet SR', '53', 'Strone 200mg Tablet SR', '2184', 54, 'SC839', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 18:33:29', '117.201.28.84'),
(740, 'Durataz 2000 Mg/250 Mg Injection', '57', 'Durataz 2000 mg/250 mg Injection', '809', 69, 'SC840', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-23 18:37:28', '117.201.28.84'),
(741, 'Suppol 250mg Suppository', '92', 'Suppol 250mg Suppository', '2185', 120, 'SC841', 0, '0', 0, '28', '30049000', 1, '36', '2017-09-23 18:52:05', '117.201.24.231'),
(742, 'Silybon 70mg Tablet', '53', 'Silybon 70mg Tablet', '2186', 84, 'SC842', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 18:56:56', '117.201.24.231'),
(743, 'Zerodol PT Tablet', '53', 'Zerodol PT Tablet', '1995', 37, 'SC843', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 19:02:08', '117.201.24.231'),
(744, 'Urispas 200mg Tablet', '53', 'Urispas 200mg Tablet', '90', 62, 'SC844', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 19:04:44', '117.201.24.231'),
(745, 'Dynaglipt 20mg Table', '53', 'Dynaglipt 20mg Table', '2188', 45, 'SC845', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 19:14:32', '117.201.24.231'),
(746, 'Botropase 1Christensenunits Injection', '57', 'Botropase 1Christensenunits Injection', '2189', 72, 'SC846', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-23 19:18:37', '117.201.24.231'),
(747, 'Chloromycetin 1% W/w Aplicap', '75', 'Chloromycetin 1% w/w Aplicap', '2190', 23, 'SC847', 0, '0', 0, '29', '30049000', 1, '36', '2017-09-23 19:29:08', '117.201.24.231'),
(748, 'Solopose Plus Tablet', '53', 'Solopose Plus Tablet', '825', 45, 'SC848', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 19:33:48', '117.201.24.231'),
(749, 'Zolfresh 5mg Tablet', '53', 'Zolfresh 5mg Tablet', '826', 27, 'SC849', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 19:35:41', '117.201.24.231'),
(750, 'Azibact 500mg Tablet', '53', 'Azibact 500mg Tablet', '2191', 37, 'SC850', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 19:41:20', '117.201.24.231'),
(751, 'Solvin Nasal Spray', '94', 'Solvin Nasal Spray', '2192', 37, 'SC851', 0, '0', 0, '31', '30049000', 1, '36', '2017-09-23 19:52:07', '117.201.24.231'),
(752, 'Labebet Injection', '57', 'Labebet Injection', '2193', 44, 'SC852', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-23 19:54:41', '117.201.24.231'),
(753, 'Monotrate SR 60mg Tablet', '53', 'Monotrate SR 60mg Tablet', '2194', 44, 'SC853', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 20:08:11', '117.201.24.231'),
(754, 'Susten 300mg Soft Gelatin Capsule', '60', 'Susten 300mg Soft Gelatin Capsule', '2195', 44, 'SC854', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-23 20:11:28', '117.201.24.231'),
(755, 'Dolokind Aqua 75mg Injection', '57', 'Dolokind Aqua 75mg Injection', '838', 45, 'SC855', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-23 20:15:38', '117.201.24.231'),
(756, 'Susten 200mg Injection', '57', 'Susten 200mg Injection', '2196', 44, 'SC856', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-23 20:20:02', '117.201.24.231'),
(757, 'Biopyrin 650mg Tablet', '53', 'Biopyrin 650mg Tablet', '1994', 43, 'SC857', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 20:21:36', '117.201.24.231'),
(758, 'Acuclav 625 Tablet', '53', 'Acuclav 625 Tablet', '877', 53, 'SC858', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 20:25:05', '117.201.24.231'),
(759, 'Zolfresh 10mg Tablet', '53', 'Zolfresh 10mg Tablet', '849', 27, 'SC859', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 20:27:58', '117.201.24.231'),
(760, 'Dextrose 25% Infusion', '95', 'Dextrose 25% Infusion', '2197', 121, 'SC860', 0, '0', 0, '32', '30049000', 1, '36', '2017-09-23 20:34:53', '117.201.24.231'),
(761, 'Mucolite Syrup', '54', 'Mucolite Syrup', '2198', 48, 'SC861', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-23 20:36:56', '117.201.24.231'),
(762, 'Stugeron Forte 75mg Tablet', '53', 'Stugeron Forte 75mg Tablet', '2129', 65, 'SC862', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 20:43:26', '117.201.24.231'),
(763, 'Zostum 1.5gm Injection', '57', 'Zostum 1.5gm Injection', '2202', 122, 'SC863', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-23 20:49:23', '117.201.24.231'),
(764, 'Avil 25mg Tablet', '53', 'Avil 25mg Tablet', '2203', 52, 'SC864', 0, '00', 0, '2', '30049000', 1, '36', '2017-09-23 20:52:18', '117.201.24.231'),
(765, 'Pmq Inga 2.5mg Tablet', '53', 'Pmq Inga 2.5mg Tablet', '2204', 95, 'SC865', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 20:54:49', '117.201.24.231'),
(766, 'Herpikind 5% Ointment', '77', 'Herpikind 5% Ointment', '309', 45, 'SC866', 0, '0', 0, '21', '30049000', 1, '36', '2017-09-23 20:57:36', '117.201.24.231'),
(767, 'Moxbro 250mg Capsule', '60', 'Moxbro 250mg Capsule', '2205', 56, 'SC867', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-23 21:00:34', '117.201.24.231'),
(768, 'Akt-2 Tablet', '53', 'Akt-2 Tablet', '15', 9, 'SC868', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 21:03:09', '117.201.24.231'),
(769, 'Gardenal 60mg Tablet', '53', 'Gardenal 60mg Tablet', '2206', 27, 'SC869', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 21:07:00', '117.201.24.231'),
(770, 'Augpen 1000mg/200mg Injection', '57', 'Augpen 1000mg/200mg Injection', '2207', 122, 'SC870', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-23 21:13:05', '117.201.24.231'),
(771, 'Depo Medrol 40mg/ml Injection', '57', 'Depo Medrol 40mg/ml Injection', '2208', 23, 'SC871', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-23 21:17:15', '117.201.24.231'),
(772, 'Wikoryl L Tablet', '53', 'Wikoryl L Tablet', '888', 22, 'SC872', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 21:20:30', '117.201.24.231'),
(773, 'Amlong-H Tablet', '53', 'Amlong-H Tablet', '891', 84, 'SC873', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 21:24:35', '117.201.24.231'),
(774, 'Nurokind-LC Tablet', '53', 'Nurokind-LC Tablet', '2209', 45, 'SC874', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 21:55:45', '117.201.24.231'),
(775, 'Oflox 100mg Suspension', '79', 'Oflox 100mg Suspension', '258', 1, 'SC875', 0, '0', 0, '9', '30049000', 1, '36', '2017-09-23 22:05:07', '117.201.24.231'),
(776, 'Telvas CT 40 Mg/12.5 Mg Tablet', '53', 'Telvas CT 40 mg/12.5 mg Tablet', '2210', 69, 'SC876', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 22:09:24', '117.201.24.231'),
(777, 'Mega CV 500mg/125mg Tablet', '53', 'Mega CV 500mg/125mg Tablet', '2211', 69, 'SC877', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 22:20:08', '117.201.24.231'),
(778, 'Amantrel 100mg Capsule', '60', 'Amantrel 100mg Capsule', '2213', 1, 'SC878', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-23 22:25:08', '117.201.24.231'),
(779, 'Aztor 10mg Tablet', '53', 'Aztor 10mg Tablet', '2214', 44, 'SC879', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 22:31:11', '117.201.24.231'),
(780, 'Syndopa 110 Tablet', '53', 'Syndopa 110 Tablet', '2215', 44, 'SC880', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 22:41:01', '117.201.24.231'),
(781, 'Susten 200mg Tablet VT', '53', 'Susten 200mg Tablet VT', '2184', 44, 'SC881', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 22:49:46', '117.201.24.231'),
(782, 'Erytop 1% W/v Lotion', '52', 'Erytop 1% w/v Lotion', '2216', 64, 'SC882', 0, '0', 0, '4', '30049000', 1, '36', '2017-09-23 22:54:38', '117.201.24.231'),
(783, 'Metocard XL 12.5mg Tablet', '53', 'Metocard XL 12.5mg Tablet', '2217', 34, 'SC883', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 23:00:14', '117.201.24.231'),
(784, 'Themicaine 2% Injection', '57', 'Themicaine 2% Injection', '2219', 123, 'SC884', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-23 23:04:44', '117.201.24.231'),
(785, 'Durataz 1000 Mg/125 Mg Injection', '57', 'Durataz 1000 mg/125 mg Injection', '2220', 69, 'SC885', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-23 23:10:45', '117.201.24.231'),
(786, 'Pantop-D Capsule', '60', 'Pantop-D Capsule', '2171', 69, 'SC886', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-23 23:14:24', '117.201.24.231'),
(787, 'Clarigard 500mg Tablet', '53', 'Clarigard 500mg Tablet', '2222', 53, 'SC887', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 23:17:30', '117.201.24.231'),
(788, 'Buscogast 10mg Tablet', '53', 'Buscogast 10mg Tablet', '2232', 59, 'SC888', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 23:41:04', '117.201.24.231'),
(789, 'Etova-MR 400/4 Tablet', '53', 'Etova-MR 400/4 Tablet', '2236', 37, 'SC889', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 23:46:20', '117.201.24.231'),
(790, 'Bludrox 500mg Tablet', '53', 'Bludrox 500mg Tablet', '934', 35, 'SC890', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-23 23:49:09', '117.201.24.231'),
(791, 'Brilinta 90mg Tablet', '53', 'Brilinta 90mg Tablet', '2245', 124, 'SC891', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 00:13:10', '117.201.24.231'),
(792, 'Telvas-AM Tablet', '53', 'Telvas-AM Tablet', '2247', 69, 'SC892', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 00:15:47', '117.201.24.231'),
(793, 'Ventidox-Bro Tablet', '53', 'Ventidox-Bro Tablet', '2248', 45, 'SC893', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 00:18:26', '117.201.24.231'),
(794, 'Biopyrin XF Tablet', '53', 'Biopyrin XF Tablet', '2249', 43, 'SC894', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 00:23:31', '117.201.24.231'),
(795, 'Levomac AZ Tablet', '53', 'Levomac AZ Tablet', '2250', 2, 'SC895', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 00:27:36', '117.201.24.231'),
(796, 'Lumerax 80mg/480mg Tablet', '53', 'Lumerax 80mg/480mg Tablet', '2251', 37, 'SC896', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 00:33:52', '117.201.24.231'),
(797, 'R-Cin 450mg Capsule', '60', 'R-Cin 450mg Capsule', '959', 9, 'SC897', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-24 00:36:15', '117.201.24.231'),
(798, 'Metrogyl P Ointment', '77', 'Metrogyl P Ointment', '960', 25, 'SC898', 0, '0', 0, '21', '30049000', 1, '36', '2017-09-24 00:43:55', '117.201.24.231'),
(799, 'ZO Eye/Ear Drops', '80', 'ZO Eye/Ear Drops', '2253', 107, 'SC899', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-24 00:46:21', '117.201.24.231'),
(800, 'Levomac OZ Tablet', '53', 'Levomac OZ Tablet', '963', 53, 'SC900', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 00:50:26', '117.201.24.231'),
(801, 'Dexona 0.5mg Tablet', '53', 'Dexona 0.5mg Tablet', '2254', 18, 'SC901', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 00:52:42', '117.201.24.231'),
(802, 'Nexpro Fast 20mg Tablet', '53', 'Nexpro Fast 20mg Tablet', '2180', 34, 'SC902', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 00:55:17', '117.201.24.231'),
(803, 'Encorate Chrono 300 Tablet CR', '53', 'Encorate Chrono 300 Tablet CR', '2255', 44, 'SC903', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 00:58:08', '117.201.24.231'),
(804, 'Fludac 20mg Capsule', '60', 'Fludac 20mg Capsule', '970', 97, 'SC904', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-24 01:00:04', '117.201.24.231'),
(805, 'Sorbitrate 10mg Tablet', '53', 'Sorbitrate 10mg Tablet', '2256', 27, 'SC905', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 01:03:02', '117.201.24.231'),
(806, 'Omez 20mg Capsule', '60', 'Omez 20mg Capsule', '2257', 48, 'SC906', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-24 01:06:30', '117.201.24.231'),
(807, 'Omez-D SR Capsule', '60', 'Omez-D SR Capsule', '974', 48, 'SC907', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-24 01:09:07', '117.201.24.231'),
(808, 'Cypon Syrup', '54', 'Cypon Syrup', '975', 102, 'SC908', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-24 01:11:02', '117.201.24.231'),
(809, 'Doxovent 400mg Tablet', '53', 'Doxovent 400mg Table', '2162', 63, 'SC909', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 01:13:35', '117.201.24.231'),
(810, 'R-Cin 600mg Capsule', '60', 'R-Cin 600mg Capsule', '985', 9, 'SC910', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-24 01:20:27', '117.201.24.231'),
(811, 'Pacimol Active Tablet', '53', 'Pacimol Active Tablet', '992', 37, 'SC911', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 01:22:23', '117.201.24.231'),
(812, 'Larinate 100 Kit', '53', 'Larinate 100 Kit', '2258', 37, 'SC912', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 01:25:14', '117.201.24.231'),
(813, 'Anaspas 25mg Injection', '57', 'Anaspas 25mg Injection', '994', 27, 'SC913', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-24 01:43:09', '117.201.24.231'),
(814, 'Telvas-3D Tablet', '53', 'Telvas-3D Tablet', '995', 69, 'SC914', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 01:46:11', '117.201.24.231'),
(815, 'Roxid 25mg Drop', '80', 'Roxid 25mg Drop', '2259', 22, 'SC915', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-24 02:12:42', '117.201.24.231'),
(816, 'Novamox 125mg Dry Syrup', '54', 'Novamox 125mg Dry Syrup', '1000', 1, 'SC916', 0, '0', 0, '3', '30041030', 1, '26', '2017-10-18 14:12:47', '49.207.184.24'),
(817, 'Insta Kit', '53', 'Insta Kit', '2260', 53, 'SC917', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 02:34:44', '117.201.24.231'),
(818, 'Malirid 7.5mg Tablet', '53', 'Malirid 7.5mg Tablet', '2262', 37, 'SC918', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 02:36:33', '117.201.24.231'),
(819, 'Epripride 150 Mg/100 Mg Capsule', '60', 'Epripride 150 mg/100 mg Capsule', '1005', 45, 'SC919', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-24 02:38:53', '117.201.24.231'),
(820, 'Eptoin 50mg Tablet', '53', 'Eptoin 50mg Tablet', '2263', 27, 'SC920', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 02:52:22', '117.201.24.231'),
(821, 'Periset MD 4mg Tablet', '53', 'Periset MD 4mg Tablet', '289', 37, 'SC921', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 02:54:16', '117.201.24.231'),
(822, 'Carca 6.25mg Tablet', '53', 'Carca 6.25mg Tablet', '1018', 125, 'SC922', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 02:59:18', '117.201.24.231'),
(823, 'Restyl 0.25mg Tablet', '53', 'Restyl 0.25mg Tablet', '1021', 1, 'SC923', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 03:03:12', '117.201.24.231'),
(824, 'Stamlo 5mg Tablet', '53', 'Stamlo 5mg Tablet', '1022', 48, 'SC924', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 03:05:30', '117.201.24.231'),
(825, 'Stamlo 2.5mg Tablet', '53', 'Stamlo 2.5mg Tablet', '1023', 48, 'SC925', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 03:08:03', '117.201.24.231'),
(826, 'Tamsin D Tablet', '53', 'Tamsin D Tablet', '1024', 62, 'SC926', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 03:10:33', '117.201.24.231'),
(827, 'Novamox 100 Rediuse Drop', '80', 'Novamox 100 Rediuse Drop', '1025', 1, 'SC927', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-24 03:12:42', '117.201.24.231'),
(828, 'Chlorpromazine 50mg Tablet', '53', 'Chlorpromazine 50mg Tablet', '2267', 44, 'SC928', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 03:24:21', '117.201.24.231'),
(829, 'Inderal 40mg Tablet', '53', 'Inderal 40mg Tablet', '2268', 27, 'SC929', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 03:26:44', '117.201.24.231'),
(830, 'Novamox Paed 100mg Drop', '80', 'Novamox Paed 100mg Drop', '1025', 1, 'SC930', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-24 03:29:12', '117.201.24.231'),
(831, 'Ecosprin AV 150 Capsule', '60', 'Ecosprin AV 150 Capsule', '1042', 64, 'SC931', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-24 03:31:58', '117.201.24.231'),
(832, 'Ropark 0.5mg Tablet', '53', 'Ropark 0.5mg Tablet', '1043', 44, 'SC932', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 03:33:46', '117.201.24.231'),
(833, 'Atchol F 10 Mg/160 Mg Tablet', '53', 'Atchol F 10 mg/160 mg Tablet', '2269', 69, 'SC933', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 03:39:08', '117.201.24.231'),
(834, 'Acera-D Capsule SR', '60', 'Acera-D Capsule SR', '1054', 37, 'SC934', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-24 03:41:06', '117.201.24.231'),
(835, 'Contus Drop', '80', 'Contus Drop', '1061', 55, 'SC935', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-24 03:47:09', '117.201.24.231'),
(836, 'Primolut-N 5mg Tablet', '53', 'Primolut-N 5mg Tablet', '1062', 18, 'SC936', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 03:48:46', '117.201.24.231'),
(837, 'Omez 40mg Tablet', '53', 'Omez 40mg Tablet', '1077', 7, 'SC937', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 03:53:01', '117.201.24.231'),
(838, 'Nexpro RD 40 Capsule SR', '60', 'Nexpro RD 40 Capsule SR', '2271', 34, 'SC938', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-24 04:03:05', '117.201.24.231'),
(839, 'Betnovate Gm Cream', '55', 'Betnovate gm Cream', '1073', 26, 'SC939', 0, '0', 0, '27', '30049000', 1, '36', '2017-09-24 11:10:18', '117.207.109.148'),
(840, 'Ketamax 50mg Injection', '57', 'Ketamax 50mg Injection', '2272', 113, 'SC940', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-24 11:13:00', '117.207.109.148'),
(841, 'Cefolac 100mg Syrup', '54', 'Cefolac 100mg Syrup', '1075', 53, 'SC941', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-24 11:15:10', '117.207.109.148'),
(842, 'Omez 40mg Injection', '57', 'Omez 40mg Injection', '1077', 48, 'SC942', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-24 11:17:05', '117.207.109.148'),
(843, 'Meftal P Tablet DT', '53', 'Meftal P Tablet DT', '1082', 35, 'SC943', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 11:24:17', '117.207.109.148'),
(844, 'Colospa 135mg Tablet', '53', 'Colospa 135mg Tablet', '1083', 27, 'SC944', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 11:26:03', '117.207.109.148'),
(845, 'KZ 2% Cream', '55', 'KZ 2% Cream', '220', 117, 'SC945', 0, '0', 0, '27', '30049000', 1, '36', '2017-09-24 11:32:00', '117.207.109.148'),
(846, 'Voglistar 0.3mg Tablet MD', '53', 'Voglistar 0.3mg Tablet MD', '1091', 45, 'SC946', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 11:35:22', '117.207.109.148'),
(847, 'Sporidex 250mg Tablet DT', '53', 'Sporidex 250mg Tablet DT', '1172', 44, 'SC947', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 11:37:24', '117.207.109.148'),
(848, 'Telvas 20mg Tablet', '53', 'Telvas 20mg Tablet', '2273', 69, 'SC948', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 11:51:19', '117.207.109.148'),
(849, 'Pantin 40mg Injection', '57', 'Pantin 40mg Injection', '247', 67, 'SC949', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-24 11:53:53', '117.207.109.148'),
(850, 'Betadine 2% W/v Gargle Mint', '73', 'Betadine 2% w/v Gargle Mint', '2274', 85, 'SC950', 0, '0', 0, '15', '30049000', 1, '36', '2017-09-24 11:57:13', '117.207.109.148'),
(851, 'Furoped Suspension', '79', 'Furoped Suspension', '2275', 71, 'SC951', 0, '0', 0, '9', '30049000', 1, '36', '2017-09-24 11:59:51', '117.207.109.148'),
(852, 'Drep Ear Drop', '80', 'Drep Ear Drop', '1098', 56, 'SC952', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-24 12:02:01', '117.207.109.148'),
(853, 'Medzol 1mg Injection', '57', 'Medzol 1mg Injection', '2276', 123, 'SC953', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-24 12:07:09', '117.207.109.148'),
(854, 'Cefoxim 500mg Tablet', '53', 'Cefoxim 500mg Table', '1107', 43, 'SC954', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 12:32:30', '117.207.109.148'),
(855, 'Larinate 120mg Injection', '57', 'Larinate 120mg Injection', '2277', 37, 'SC955', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-24 12:36:07', '117.207.109.148'),
(856, 'Meftal 500mg Tablet', '53', 'Meftal 500mg Tablet', '1109', 35, 'SC956', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 12:37:32', '117.207.109.148'),
(857, 'Deriphyllin Tablet', '53', 'Deriphyllin Tablet', '2278', 18, 'SC957', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 12:59:24', '117.207.109.148'),
(858, 'Defcort 6mg Tablet', '53', 'Defcort 6mg Tablet', '2002', 53, 'SC957', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 12:59:24', '139.59.47.79'),
(859, 'Tide Plus 20 Tablet', '53', 'Tide Plus 20 Tablet', '2279', 34, 'SC959', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 13:12:51', '117.207.109.148'),
(860, 'Tide Plus 10 Tablet', '53', 'Tide Plus 10 Tablet', '2280', 34, 'SC960', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 13:15:08', '117.207.109.148'),
(861, 'Rifagut 400mg Tablet', '53', 'Rifagut 400mg Tablet', '2281', 44, 'SC961', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 13:17:11', '117.207.109.148'),
(862, 'Rifaset 200mg Tablet', '53', 'Rifaset 200mg Tablet', '2282', 53, 'SC962', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 13:18:44', '117.207.109.148'),
(863, 'Tamik BC Tablet', '53', 'Tamik BC Tablet', '1124', 50, 'SC963', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 13:20:24', '117.207.109.148'),
(864, 'Betnovate 0.1% W/w Cream', '55', 'Betnovate 0.1% w/w Cream', '1125', 26, 'SC964', 0, '0', 0, '7', '30043200', 1, '26', '2017-10-18 14:15:00', '49.207.184.24'),
(865, 'Gudcef Plus Tablet', '53', 'Gudcef Plus Tablet', '1126', 45, 'SC965', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 13:25:10', '117.207.109.148'),
(866, 'Cefazid 1000mg Injection', '57', 'Cefazid 1000mg Injection', '1130', 43, 'SC966', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-24 13:27:28', '117.207.109.148'),
(867, 'Hepa Merz Injection', '57', 'Hepa Merz Injection', '1131', 85, 'SC967', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-24 13:30:02', '117.207.109.148'),
(868, 'Merobax 125mg Injection', '57', 'Merobax 125mg Injection', '1136', 69, 'SC968', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-24 13:35:25', '117.207.109.148'),
(869, 'Redinerv Plus Injection', '57', 'Redinerv Plus Injection', '1137', 126, 'SC969', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-24 13:38:42', '117.207.109.148'),
(870, 'Levipil 500mg Tablet', '53', 'Levipil 500mg Tablet', '1141', 44, 'SC970', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 13:44:04', '117.207.109.148'),
(871, 'Naxdom 250 Tablet', '53', 'Naxdom 250 Tablet', '1142', 44, 'SC971', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 13:46:29', '117.207.109.148'),
(872, 'Pydomin Tablet', '53', 'Pydomin Tablet', '2286', 127, 'SC972', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 13:50:41', '117.207.109.148'),
(873, 'Susten 300mg Tablet SR', '53', 'Susten 300mg Tablet SR', '2195', 44, 'SC973', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 13:54:46', '117.207.109.148'),
(874, 'Cremalax 10mg Tablet', '53', 'Cremalax 10mg Tablet', '1147', 27, 'SC974', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 13:57:08', '117.207.109.148'),
(875, 'Candid-V6 100mg Vaginal Tablet', '53', 'Candid-V6 100mg Vaginal Tablet', '2290', 63, 'SC975', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 14:01:34', '117.207.109.148'),
(876, 'Lumerax 60mg/360mg Tablet', '53', 'Lumerax 60mg/360mg Tablet', '1153', 37, 'SC976', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 14:03:35', '117.207.109.148'),
(877, 'Flutiflo FT Nasal Spray', '93', 'Flutiflo FT Nasal Spray', '2291', 9, 'SC977', 0, '0', 0, '30', '30049000', 1, '36', '2017-09-24 14:05:56', '117.207.109.148'),
(878, 'Telvas 40mg Tablet', '53', 'Telvas 40mg Tablet', '1157', 69, 'SC978', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 14:07:53', '117.207.109.148'),
(879, 'Ceftas CL 200 Mg Tablet', '53', 'Ceftas CL 200 mg Tablet', '1158', 125, 'SC979', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 14:10:22', '117.207.109.148'),
(880, 'Monocef O 100mg Tablet', '53', 'Monocef O 100mg Tablet', '180', 69, 'SC980', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 14:12:53', '117.207.109.148'),
(881, 'Mucinac 600mg Effervescent Tablet Orange', '53', 'Mucinac 600mg Effervescent Tablet Orange', '2292', 1, 'SC981', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 14:16:41', '117.207.109.148'),
(882, 'Ampilox 500 Mg/500 Mg Injection', '57', 'Ampilox 500 mg/500 mg Injection', '340', 43, 'SC982', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-24 14:19:18', '117.207.109.148'),
(883, 'Vomilast -OD Tablet', '53', 'Vomilast -OD Tablet', '1182', 45, 'SC983', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 14:21:00', '117.207.109.148'),
(884, 'Lasix 40mg Tablet', '53', 'Lasix 40mg Tablet', '1185', 52, 'SC984', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 14:25:02', '117.207.109.148'),
(885, 'R-Cin 300mg Capsule', '60', 'R-Cin 300mg Capsule', '2000', 9, 'SC985', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-24 14:31:27', '117.207.109.148'),
(886, 'Heparin 25000IU Injection', '57', 'Heparin 25000IU Injection', '221', 128, 'SC986', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-24 17:12:03', '59.93.13.134'),
(887, 'Naxdom 500 Tablet', '53', 'Naxdom 500 Tablet', '1198', 44, 'SC987', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 17:22:23', '117.207.107.176'),
(888, 'Jointace DN Tablet', '53', 'Jointace DN Tablet', '1201', 92, 'SC988', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 17:24:51', '117.207.107.176'),
(889, 'Myostigmin 2.5mg Injection', '57', 'Myostigmin 2.5mg Injection', '2295', 104, 'SC989', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-24 18:55:00', '117.207.103.145'),
(890, 'Stemetil 12.5mg Injection', '57', 'Stemetil 12.5mg Injection', '1203', 27, 'SC990', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-24 19:02:32', '117.201.27.215'),
(891, 'Olsertain 20mg Tablet', '53', 'Olsertain 20mg Tablet', '2296', 48, 'SC991', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 19:06:16', '117.201.27.215'),
(892, 'Clamp Kid Forte Tablet', '53', 'Clamp Kid Forte Tablet', '1751', 48, 'SC992', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 19:14:10', '117.201.27.215'),
(893, 'Normaxin 2.5 Mg/5 Mg/10 Mg Tablet', '53', 'Normaxin 2.5 mg/5 mg/10 mg Tablet', '1208', 129, 'SC993', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 19:28:47', '117.201.27.215'),
(894, 'P 250mg Suspension', '79', 'P 250mg Suspension', '2185', 36, 'SC994', 0, '0', 0, '9', '30049000', 1, '36', '2017-09-24 19:34:24', '117.201.27.215'),
(895, 'Nexpro RD 20 Capsule SR', '60', 'Nexpro RD 20 Capsule SR', '1212', 34, 'SC995', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-24 19:40:38', '117.201.27.215'),
(896, 'Labebet 100mg Tablet', '53', 'Labebet 100mg Tablet', '1213', 44, 'SC996', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 19:45:09', '117.201.27.215'),
(897, 'Deriphyllin Retard 150 Tablet PR', '53', 'Deriphyllin Retard 150 Tablet PR', '2298', 18, 'SC997', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 19:56:08', '117.201.27.215'),
(898, 'Minipress XL 2.5mg Tablet', '53', 'Minipress XL 2.5mg Tablet', '1216', 23, 'SC998', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 20:13:41', '117.201.27.215'),
(899, 'Chymoral Forte -DS 200000AU Tablet', '53', 'Chymoral Forte -DS 200000AU Tablet', '1217', 34, 'SC999', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 20:25:43', '117.201.27.215'),
(900, 'P 500mg Suspension', '79', 'P 500mg Suspension', '2299', 36, 'SC1000', 0, '0', 0, '9', '30049000', 1, '36', '2017-09-24 20:35:10', '117.201.27.215'),
(901, 'Pacimol DS 250mg Suspension', '79', 'Pacimol DS 250mg Suspension', '1220', 37, 'SC1001', 0, '0', 0, '9', '30049000', 1, '36', '2017-09-24 20:37:08', '117.201.27.215'),
(902, 'Noradria 2mg Injection', '57', 'Noradria 2mg Injection', '1222', 113, 'SC1002', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-24 20:38:44', '117.201.27.215'),
(903, 'Novamox 250 Rediuse Suspension', '79', 'Novamox 250 Rediuse Suspension', '50', 1, 'SC1003', 0, '0', 0, '9', '30049000', 1, '36', '2017-09-24 20:40:43', '117.201.27.215'),
(904, 'Enam 10mg Tablet', '53', 'Enam 10mg Tablet', '1225', 48, 'SC1004', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 21:01:02', '59.93.11.160'),
(905, 'Levomac 750mg Tablet', '53', 'Levomac 750mg Tablet', '1230', 53, 'SC1005', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 22:24:55', '117.201.24.173'),
(906, 'Udimarin 300mg Tablet', '53', 'Udimarin 300mg Tablet', '177', 106, 'SC1006', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 22:53:17', '117.201.17.114'),
(907, 'Phexin Kid 125mg Tablet', '53', 'Phexin Kid 125mg Tablet', '148', 26, 'SC1007', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 22:55:33', '117.201.17.114'),
(908, 'Redotil 100mg Capsule', '60', 'Redotil 100mg Capsule', '462', 48, 'SC1008', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-24 22:57:55', '117.201.17.114'),
(909, 'Ganaton 50mg Tablet', '53', 'Ganaton 50mg Tablet', '1243', 27, 'SC1009', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-24 23:00:19', '117.201.17.114'),
(910, 'Odomos Naturals Cream Pack Of 3', '55', 'Odomos Naturals Cream Pack of 3', '2300', 130, 'SC1010', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-24 23:19:42', '157.50.23.160'),
(911, 'Laxiwal Syrup', '54', 'Laxiwal Syrup', '56', 21, 'SC1011', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-24 23:21:36', '157.50.23.160'),
(912, 'Dilzem CD 90mg Capsule ER', '60', 'Dilzem CD 90mg Capsule ER', '1993', 34, 'SC1012', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-24 23:23:41', '157.50.23.160'),
(913, 'Dronis 30 Tablet', '53', 'Dronis 30 Tablet', '98', 44, 'SC1013', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 23:24:38', '157.50.23.160'),
(914, 'Rhoclone 150mcg Injection', '57', 'Rhoclone 150mcg Injection', '1989', 51, 'SC1014', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-24 23:25:52', '157.50.23.160'),
(915, 'Transpace-MF Tablet', '53', 'Transpace-MF Tablet', '2301', 126, 'SC1015', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-24 23:28:27', '157.50.23.160'),
(916, 'Zerofat Next Capsule', '60', 'Zerofat Next Capsule', '1985', 45, 'SC1016', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-24 23:31:39', '157.50.23.160'),
(917, 'Renerve Plus Capsule', '60', 'Renerve Plus Capsule', '2302', 131, 'SC1017', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-24 23:33:36', '157.50.23.160'),
(918, 'Loozfibre Granules', '88', 'Loozfibre Granules', '1983', 125, 'SC1018', 0, '0', 0, '19', '30049000', 1, '36', '2017-09-24 23:36:05', '157.50.23.160'),
(919, 'Riddof 30mg Injection', '57', 'Riddof 30mg Injection', '582', 104, 'SC1019', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-24 23:39:35', '157.50.23.160'),
(920, 'Hemolit Cream', '55', 'Hemolit Cream', '2303', 53, 'SC1020', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-24 23:40:35', '157.50.23.160'),
(921, 'Reeshape 60mg Capsule', '60', 'Reeshape 60mg Capsule', '2304', 92, 'SC1021', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-24 23:42:18', '157.50.23.160'),
(922, 'Astymin C Drop', '80', 'Astymin C Drop', '1975', 42, 'SC1022', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-24 23:46:17', '157.50.23.160'),
(923, 'Mupi 2% W/w Ointment', '77', 'Mupi 2% w/w Ointment', '2305', 117, 'SC1023', 0, '0', 0, '21', '30049000', 1, '36', '2017-09-24 23:51:13', '157.50.23.160'),
(924, 'Oxybro 100mg Capsule', '60', 'Oxybro 100mg Capsule', '2306', 97, 'SC1024', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-24 23:55:53', '157.50.23.160'),
(925, 'Cyclopam Suspension', '79', 'Cyclopam Suspension', '1970', 30, 'SC1025', 0, '0', 0, '9', '30049000', 1, '36', '2017-09-24 23:57:45', '157.50.23.160'),
(926, 'Carmicide Drop', '80', 'Carmicide Drop', '1969', 30, 'SC1026', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-24 23:59:52', '157.50.23.160'),
(927, 'Optisulin Capsule', '60', 'Optisulin Capsule', '1968', 48, 'SC1027', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-25 00:01:24', '157.50.23.160'),
(928, 'Gris Odt 250mg Tablet', '53', 'Gris Odt 250mg Tablet', '1426', 48, 'SC1028', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-25 00:02:46', '157.50.23.160'),
(929, 'Maxotaz 2000 Mg/250 Mg Injection', '57', 'Maxotaz 2000 mg/250 mg Injection', '809', 53, 'SC1029', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-25 00:04:31', '157.50.23.160'),
(930, 'Maxotaz 4000 Mg/500 Mg Injection', '57', 'Maxotaz 4000 mg/500 mg Injection', '2307', 53, 'SC1030', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-25 00:06:01', '157.50.23.160'),
(931, 'Asthakind P Drop', '80', 'Asthakind P Drop', '1963', 45, 'SC1031', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-25 00:07:22', '157.50.23.160'),
(932, 'Myolaxin Ointment', '77', 'Myolaxin Ointment', '2308', 102, 'SC1032', 0, '0', 0, '21', '30049000', 1, '36', '2017-09-25 00:09:20', '157.50.23.160'),
(933, 'Dubinor Tablet', '53', 'Dubinor Tablet', '1949', 63, 'SC1033', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-25 00:15:44', '157.50.23.160'),
(934, 'Bifilac Capsule', '60', 'Bifilac Capsule', '2309', 42, 'SC1034', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-25 00:17:32', '157.50.23.160'),
(935, 'Cilacar 5mg Tablet', '53', 'Cilacar 5mg Tablet', '1959', 25, 'SC1035', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 00:18:49', '157.50.23.160'),
(936, 'Candid Gold Powder', '78', 'Candid Gold Powder', '2310', 63, 'SC1036', 0, '0', 0, '25', '30049000', 1, '36', '2017-09-25 00:22:37', '157.50.23.160'),
(937, 'Strone 300mg Tablet SR', '53', 'Strone 300mg Tablet SR', '2195', 54, 'SC1037', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 00:24:52', '157.50.23.160'),
(938, 'Zanocin 200mg Tablet', '53', 'Zanocin 200mg Tablet', '10', 44, 'SC1038', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 00:25:53', '157.50.23.160'),
(939, 'Isokin 300 Mg/10 Mg Tablet', '53', 'Isokin 300 mg/10 mg Tablet', '1245', 23, 'SC1039', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 01:00:43', '117.201.30.230'),
(940, 'K-Stat 500mg Tablet', '53', 'K-Stat 500mg Tablet', '194', 66, 'SC1040', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 01:08:00', '117.201.30.48'),
(941, 'Tretin 0.025% Cream', '55', 'Tretin 0.025% Cream', '626', 117, 'SC1041', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-25 13:40:43', '157.50.22.165'),
(942, 'Neosmile Drop', '80', 'Neosmile Drop', '743', 45, 'SC1042', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-25 13:42:37', '157.50.22.165'),
(943, 'Stonex Capsule', '60', 'Stonex Capsule', '745', 133, 'SC1043', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-25 14:04:45', '139.59.0.48'),
(944, 'Meganeuron OD Plus Capsule', '60', 'Meganeuron OD Plus Capsule', '748', 69, 'SC1044', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-25 14:07:09', '139.59.0.48'),
(945, 'Bevon Drop', '80', 'Bevon Drop', '759', 122, 'SC1045', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-25 14:11:16', '139.59.0.48'),
(946, 'Himalaya Gasex Tablet', '53', 'Himalaya Gasex Tablet', '767', 31, 'SC1046', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-25 14:18:59', '157.50.22.165'),
(947, 'Scarend Silicone Gel', '72', 'Scarend Silicone Gel', '768', 45, 'SC1047', 0, '0', 0, '14', '30049000', 1, '36', '2017-09-25 14:20:37', '157.50.22.165'),
(948, 'Breakfix Tablet', '53', 'Breakfix Tablet', '772', 119, 'SC1048', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 14:23:27', '157.50.22.165'),
(949, 'Bon D Light Drop', '80', 'Bon D Light Drop', '773', 63, 'SC1049', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-25 14:25:38', '157.50.22.165'),
(950, 'Folizorb Soft Gelatin Capsule', '60', 'Folizorb Soft Gelatin Capsule', '778', 53, 'SC1050', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-25 14:27:58', '157.50.22.165'),
(951, 'Urikind-KM Sachet 5gm', '88', 'Urikind-KM Sachet 5gm', '779', 45, 'SC1051', 0, '0', 0, '19', '30049000', 1, '36', '2017-09-25 14:30:08', '157.50.22.165'),
(952, 'Phenergan 10mg Tablet', '53', 'Phenergan 10mg Tablet', '1251', 27, 'SC1052', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 20:23:23', '117.207.97.104'),
(953, 'Mebex 100mg Tablet', '53', 'Mebex 100mg Tablet', '2313', 1, 'SC1053', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 20:27:54', '117.207.97.104'),
(954, 'Allegra 30mg Tablet', '53', 'Allegra 30mg Tablet', '1258', 52, 'SC1054', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 20:33:30', '117.207.97.104'),
(955, 'Seroflo 500 Rotacap', '71', 'Seroflo 500 Rotacap', '1265', 1, 'SC1055', 0, '0', 0, '16', '30049000', 1, '36', '2017-09-25 20:36:33', '117.207.97.104'),
(956, 'Nexpro HP Kit', '53', 'Nexpro HP Kit', '1268', 34, 'SC1056', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-25 21:09:14', '59.93.9.176'),
(957, 'Zyfol 10mg Injection', '57', 'Zyfol 10mg Injection', '1269', 123, 'SC1057', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-25 21:13:49', '59.93.9.176'),
(958, 'Pruf P 100 Mg/325 Mg Tablet', '53', 'Pruf P 100 mg/325 mg Tablet', '1275', 125, 'SC1058', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 21:17:52', '59.93.9.176'),
(959, 'Macsart H Tablet', '53', 'Macsart H Tablet', '2311', 53, 'SC1059', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 21:29:57', '117.201.31.100'),
(960, 'Chymoral-BR Tablet', '53', 'Chymoral-BR Tablet', '1279', 34, 'SC1060', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 21:32:46', '117.201.31.100'),
(961, 'Fensupp 100mg Suppository', '92', 'Fensupp 100mg Suppository', '1280', 120, 'SC1061', 0, '0', 0, '28', '30049000', 1, '36', '2017-09-25 21:37:19', '117.201.31.100'),
(962, 'Syndopa Plus Tablet', '53', 'Syndopa Plus Tablet', '1284', 44, 'SC1062', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 21:41:13', '117.201.31.100'),
(963, 'Merobax 250mg Injection', '57', 'Merobax 250mg Injection', '1289', 69, 'SC1063', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-25 22:09:43', '117.201.31.100'),
(964, 'Tropine 0.6mg Injection', '57', 'Tropine 0.6mg Injection', '1290', 104, 'SC1064', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-25 22:11:27', '117.201.31.100'),
(965, 'Fertyl 50mg Tablet', '53', 'Fertyl 50mg Tablet', '1292', 134, 'SC1065', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 22:15:44', '117.201.31.100'),
(966, 'Dalacin C 300mg Capsule', '60', 'Dalacin C 300mg Capsule', '1293', 23, 'SC1066', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-25 22:23:51', '117.201.31.100'),
(967, 'Enzomac Plus Tablet', '53', 'Enzomac Plus Tablet', '1430', 53, 'SC1067', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 22:25:48', '117.201.31.100'),
(968, 'Rozat 5mg Tablet', '53', 'Rozat 5mg Tablet', '1296', 48, 'SC1068', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 22:28:37', '117.201.31.100'),
(969, 'Moxbro 500mg Capsule', '60', 'Moxbro 500mg Capsule', '1297', 56, 'SC1069', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-25 22:31:57', '117.201.31.100'),
(970, 'Taxim O 50mg Tablet DT', '53', 'Taxim O 50mg Tablet DT', '1298', 90, 'SC1070', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 22:35:04', '117.201.31.100'),
(971, 'Novamox 500mg Capsule', '60', 'Novamox 500mg Capsule', '1249', 1, 'SC1071', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-25 22:45:31', '117.201.31.100'),
(972, 'Pregalin M 75 Capsule', '60', 'Pregalin M 75 Capsule', '304', 34, 'SC1072', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-25 22:58:16', '117.201.30.118'),
(973, 'Bestova 50mg Capsule', '60', 'Bestova 50mg Capsule', '2317', 135, 'SC1073', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-25 23:04:40', '117.201.30.118'),
(974, 'Udiliv 150mg Tablet', '53', 'Udiliv 150mg Tablet', '1339', 27, 'SC1074', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 23:06:54', '117.201.30.118'),
(975, 'Stafcure 500mg Tablet', '53', 'Stafcure 500mg Tablet', '1107', 53, 'SC1075', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 23:10:15', '117.201.30.118'),
(976, 'Lumerax 40mg/240mg Tablet', '53', 'Lumerax 40mg/240mg Tablet', '2318', 37, 'SC1076', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 23:19:55', '117.201.30.118'),
(977, 'Sazo 500mg Tablet DR', '53', 'Sazo 500mg Tablet DR', '2323', 21, 'SC1077', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 23:24:57', '117.201.30.118'),
(978, 'Lox 2% Injection', '57', 'Lox 2% Injection', '2319', 104, 'SC1076', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-25 23:27:29', '157.50.23.59'),
(979, 'Voglistar 0.2mg Tablet MD', '53', 'Voglistar 0.2mg Tablet MD', '1355', 45, 'SC1078', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 23:28:30', '117.201.30.118'),
(980, 'Acivir 200mg Tablet DT', '53', 'Acivir 200mg Tablet DT', '119', 1, 'SC1080', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 23:30:20', '117.201.30.118'),
(981, 'Citinol 500MG Tablet', '53', 'Citinol 500MG Tablet', '1788', 136, 'SC1080', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-25 23:30:24', '157.50.23.59'),
(982, 'Pacimol 500mg Tablet', '53', 'Pacimol 500mg Tablet', '2299', 37, 'SC1082', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 23:31:52', '157.50.23.59'),
(983, 'Racigyl O 15 Mg/50 Mg Dry Syrup', '54', 'Racigyl O 15 mg/50 mg Dry Syrup', '2325', 45, 'SC1083', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-25 23:34:07', '157.50.23.59'),
(984, 'Nexito 10mg Tablet', '53', 'Nexito 10mg Tablet', '2324', 44, 'SC1083', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 23:34:10', '117.201.30.118'),
(985, 'Enoxion 40mg Injection', '57', 'Enoxion 40mg Injection', '1946', 104, 'SC1085', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-25 23:35:30', '157.50.23.59'),
(986, 'Instafree 72 Tablet', '53', 'Instafree 72 Tablet', '1366', 2, 'SC1085', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 23:35:52', '117.201.30.118'),
(987, 'Zerodol 200mg Tablet CR', '53', 'Zerodol 200mg Tablet CR', '1367', 37, 'SC1087', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 23:37:36', '117.201.30.118'),
(988, 'Tide 10mg Tablet', '53', 'Tide 10mg Tablet', '2326', 34, 'SC1088', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 23:41:00', '117.201.30.118'),
(989, 'Suppol Baby 80mg Suppository', '92', 'Suppol Baby 80mg Suppository', '2327', 120, 'SC1089', 0, '0', 0, '28', '30049000', 1, '36', '2017-09-25 23:43:42', '117.201.30.118'),
(990, 'Biotax O 200mg Tablet', '53', 'Biotax O 200mg Tablet', '1382', 43, 'SC1090', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 23:45:42', '117.201.30.118'),
(991, 'Monticope Tablet', '53', 'Monticope Tablet', '2328', 45, 'SC1091', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 23:47:35', '117.201.30.118');
INSERT INTO `product` (`productid`, `productname`, `product_typeid`, `sort_description`, `composition_id`, `manufacturer_id`, `product_code`, `minstock`, `reorderlevelstock`, `maxstock`, `unit`, `hsn_code`, `is_active`, `updatedby`, `updatedon`, `updated_ipaddress`) VALUES
(992, 'Glycomet 500mg Tablet', '53', 'Glycomet 500mg Tablet', '2183', 64, 'SC1092', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 23:49:51', '117.201.30.118'),
(993, 'Vasograin Tablet', '53', 'Vasograin Tablet', '1385', 97, 'SC1093', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 23:51:16', '117.201.30.118'),
(994, 'Novamox 125mg Rediuse Suspension', '79', 'Novamox 125mg Rediuse Suspension', '1000', 1, 'SC1094', 0, '0', 0, '9', '30049000', 1, '36', '2017-09-25 23:53:14', '117.201.30.118'),
(995, 'Malirid 2.5mg Tablet DT', '53', 'Malirid 2.5mg Tablet DT', '2204', 37, 'SC1095', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-25 23:54:44', '117.201.30.118'),
(996, 'Zyfor 200mg Tablet', '53', 'Zyfor 200mg Tablet', '2329', 43, 'SC1096', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 00:13:56', '117.201.28.157'),
(997, 'Lyser DP Tablet', '53', 'Lyser DP Tablet', '1405', 137, 'SC1097', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 00:18:03', '117.201.28.157'),
(998, 'Roscillin 250mg Injection', '57', 'Roscillin 250mg Injection', '2330', 44, 'SC1098', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 00:19:52', '117.201.28.157'),
(999, 'Aztor 40mg Tablet', '53', 'Aztor 40mg Tablet', '2331', 44, 'SC1099', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 00:23:06', '117.201.28.157'),
(1000, 'Vertin 16mg Tablet', '53', 'Vertin 16mg Tablet', '2332', 27, 'SC1100', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 00:27:38', '117.201.28.157'),
(1001, 'Trapic E Tablet', '53', 'Trapic E Tablet', '377', 44, 'SC1101', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 00:29:08', '117.201.28.157'),
(1002, 'Strone 100mg Soft Gelatin Capsule', '60', 'Strone 100mg Soft Gelatin Capsule', '2334', 54, 'SC1102', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-26 00:36:54', '117.201.28.157'),
(1003, 'Neurocetam 400mg Capsule', '60', 'Neurocetam 400mg Capsule', '2335', 84, 'SC1103', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-26 00:39:42', '117.201.28.157'),
(1004, 'Actiheal-D Tablet', '53', 'Actiheal-D Tablet', '1430', 53, 'SC1104', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 00:41:41', '117.201.28.157'),
(1005, 'Glevo 750mg Tablet', '53', 'Glevo 750mg Tablet', '1230', 63, 'SC1105', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 00:43:44', '117.201.28.157'),
(1006, 'Keto Cream', '55', 'Keto Cream', '2336', 82, 'SC1106', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-26 00:46:04', '117.201.28.157'),
(1007, 'Encephabol 100mg Tablet', '53', 'Encephabol 100mg Tablet', '228', 49, 'SC1107', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 00:47:47', '117.201.28.157'),
(1008, 'Gestofit 200mg Tablet SR', '53', 'Gestofit 200mg Tablet SR', '2184', 22, 'SC1108', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 00:51:58', '117.201.28.157'),
(1009, 'Geminor M 1 Tablet SR', '53', 'Geminor M 1 Tablet SR', '2340', 2, 'SC1109', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 00:56:14', '117.201.28.157'),
(1010, 'Unwanted Pregcard 21 Days Tablet', '53', 'Unwanted Pregcard 21 Days Tablet', '236', 45, 'SC1110', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 01:00:50', '117.201.28.157'),
(1011, 'Nexpro L Capsule', '60', 'Nexpro L Capsule', '1457', 34, 'SC1111', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-26 01:04:13', '117.201.28.157'),
(1012, 'Gestakind 10mg Tablet', '53', 'Gestakind 10mg Tablet', '435', 45, 'SC1112', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 01:05:50', '117.201.28.157'),
(1013, 'Nootropil 200mg Injection', '57', 'Nootropil 200mg Injection', '2341', 48, 'SC1113', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 01:08:14', '117.201.28.157'),
(1014, 'Cabgolin 0.25mg Tablet', '53', 'Cabgolin 0.25mg Tablet', '2342', 44, 'SC1114', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 01:22:29', '117.201.28.157'),
(1015, 'Dronis 20 Tablet', '53', 'Dronis 20 Tablet', '2343', 44, 'SC1115', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 01:25:35', '117.201.28.157'),
(1016, 'Trapic 650mg Tablet', '53', 'Trapic 650mg Tablet', '376', 44, 'SC1116', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 01:27:40', '117.201.28.157'),
(1017, 'Cypon Oral Drops', '80', 'Cypon Oral Drops', '1485', 102, 'SC1117', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-26 10:42:21', '117.207.101.207'),
(1018, 'Cilaheart T 10mg/40mg Tablet', '53', 'Cilaheart T 10mg/40mg Tablet', '1490', 45, 'SC1118', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 11:05:45', '117.207.101.207'),
(1019, 'Hyocimax 10mg Tablet', '53', 'Hyocimax 10mg Tablet', '2232', 18, 'SC1119', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 11:13:19', '117.207.101.207'),
(1020, 'Candid Ear Drop', '80', 'Candid Ear Drop', '2344', 63, 'SC1120', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-26 11:18:07', '117.207.101.207'),
(1021, 'Anawin 0.5% Injection', '57', 'Anawin 0.5% Injection', '2345', 104, 'SC1121', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 11:20:22', '117.207.101.207'),
(1022, 'Ceftas CV 200 Mg/125 Mg Tablet', '53', 'Ceftas CV 200 mg/125 mg Tablet', '1175', 125, 'SC1122', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 11:22:05', '117.207.101.207'),
(1023, 'Maxtra Tablet', '53', 'Maxtra Tablet', '2346', 122, 'SC1123', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 11:26:08', '117.207.101.207'),
(1024, 'Maxtra P Syrup', '54', 'Maxtra P Syrup', '698', 122, 'SC1124', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-26 11:32:35', '117.207.101.207'),
(1025, 'Biotax 250mg Injection', '57', 'Biotax 250mg Injection', '273', 43, 'SC1125', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 11:34:09', '117.207.101.207'),
(1026, 'Maxtra Syrup', '54', 'Maxtra Syrup', '2347', 122, 'SC1126', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-26 11:36:31', '117.207.101.207'),
(1027, 'Ecosprin 325mg Tablet', '53', 'Ecosprin 325mg Tablet', '2348', 64, 'SC1127', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 11:38:12', '117.207.101.207'),
(1028, 'Meganano Gel', '72', 'Meganano Gel', '2349', 122, 'SC1128', 0, '0', 0, '14', '30049000', 1, '36', '2017-09-26 11:40:28', '117.207.101.207'),
(1029, 'Metrogyl 200mg Tablet', '53', 'Metrogyl 200mg Tablet', '2350', 25, 'SC1129', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 11:43:12', '117.207.101.207'),
(1030, 'Dynaglipt 20mg Tablet', '53', 'Dynaglipt 20mg Tablet', '2188', 45, 'SC1130', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 11:45:02', '117.207.101.207'),
(1031, 'Herpikind 800mg Tablet', '53', 'Herpikind 800mg Tablet', '342', 45, 'SC1131', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 11:47:40', '117.207.101.207'),
(1032, 'Meftal Spas Injection', '57', 'Meftal Spas Injection', '2351', 35, 'SC1132', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 11:50:44', '117.207.101.207'),
(1033, 'Ropark 0.25mg Tablet', '53', 'Ropark 0.25mg Tablet', '2355', 44, 'SC1133', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 11:55:59', '117.207.101.207'),
(1034, 'Met XL 12.5mg Tablet', '53', 'Met XL 12.5mg Tablet', '2217', 138, 'SC1134', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 12:01:11', '117.207.101.207'),
(1035, 'Crina-Ncr 10mg Tablet', '53', 'Crina-Ncr 10mg Tablet', '2356', 22, 'SC1135', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 12:08:57', '117.207.101.207'),
(1036, 'Phexin 250mg Tablet DT', '53', 'Phexin 250mg Tablet DT', '1172', 26, 'SC1136', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 12:11:12', '117.207.101.207'),
(1037, 'Biopolio B1/3 Vaccine', '57', 'Biopolio B1/3 Vaccine', '2357', 77, 'SC1137', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 12:12:40', '117.207.101.207'),
(1038, 'Azoran 50mg Tablet', '53', 'Azoran 50mg Tablet', '2358', 93, 'SC1138', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 12:16:57', '117.207.101.207'),
(1039, 'Maxtra P Oral Drops', '80', 'Maxtra P Oral Drops', '2359', 122, 'SC1139', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-26 12:20:08', '117.207.101.207'),
(1040, 'Larinate 200 Kit Tablet', '53', 'Larinate 200 Kit Tablet', '2360', 37, 'SC1140', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 12:22:11', '117.207.101.207'),
(1041, 'Budecort 200mcg Inhaler', '86', 'Budecort 200mcg Inhaler', '2361', 1, 'SC1141', 0, '0', 0, '17', '30049000', 1, '36', '2017-09-26 12:24:38', '117.207.101.207'),
(1042, 'Revac-B Injection', '57', 'Revac-B Injection', '2362', 77, 'SC1142', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 12:26:09', '117.207.101.207'),
(1043, 'Coriminic Syrup', '54', 'Coriminic Syrup', '2347', 119, 'SC1143', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-26 12:29:02', '117.207.101.207'),
(1044, 'Dutas T Capsule', '60', 'Dutas T Capsule', '1024', 48, 'SC1144', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-26 12:30:32', '117.207.101.207'),
(1045, 'Cabgolin 0.5mg Tablet', '53', 'Cabgolin 0.5mg Tablet', '2363', 44, 'SC1145', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 12:33:37', '117.207.101.207'),
(1046, 'Levipil 100mg Injection', '57', 'Levipil 100mg Injection', '2364', 44, 'SC1146', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 12:35:33', '117.207.101.207'),
(1047, 'Onecan 50mg Tablet', '53', 'Onecan 50mg Tablet', '2365', 21, 'SC1147', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 12:38:20', '117.207.101.207'),
(1048, 'Glycomet-GP 1 Forte Tablet SR', '53', 'Glycomet-GP 1 Forte Tablet SR', '2366', 64, 'SC1148', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 12:41:36', '117.207.101.207'),
(1049, 'Ecosprin AV 75 Capsule', '60', 'Ecosprin AV 75 Capsule', '2367', 64, 'SC1149', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-26 12:43:26', '117.207.101.207'),
(1050, 'Metocard XL 50mg Tablet', '53', 'Metocard XL 50mg Tablet', '2368', 34, 'SC1150', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 12:45:12', '117.207.101.207'),
(1051, 'Aztor 20mg Tablet', '53', 'Aztor 20mg Tablet', '2369', 44, 'SC1151', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 12:47:34', '117.207.101.207'),
(1052, 'Levipil Syrup', '54', 'Levipil Syrup', '1558', 44, 'SC1152', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-26 12:50:56', '117.207.101.207'),
(1053, 'Chymoral-AP Tablet', '53', 'Chymoral-AP Tablet', '1571', 34, 'SC1153', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 12:54:42', '117.207.101.207'),
(1054, 'Gerbisa 10mg Suppository', '92', 'Gerbisa 10mg Suppository', '2370', 18, 'SC1154', 0, '0', 0, '28', '30049000', 1, '36', '2017-09-26 12:56:52', '117.207.101.207'),
(1055, 'Cardace H 2.5 Tablet', '53', 'Cardace H 2.5 Tablet', '2371', 52, 'SC1155', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 13:00:08', '117.207.101.207'),
(1056, 'Novamox 250mg Capsule', '60', 'Novamox 250mg Capsule', '50', 1, 'SC1156', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-26 13:03:16', '117.207.101.207'),
(1057, 'Aqsusten 25mg Injection 1ml', '57', 'Aqsusten 25mg Injection 1ml', '2373', 44, 'SC1157', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 13:06:04', '117.207.101.207'),
(1058, 'Anawin Heavy 5mg Injection', '57', 'Anawin Heavy 5mg Injection', '2374', 104, 'SC1158', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 13:08:10', '117.207.101.207'),
(1059, 'Anafortan 25 Mg/300 Mg Tablet', '53', 'Anafortan 25 mg/300 mg Tablet', '1582', 27, 'SC1159', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 13:10:42', '117.207.101.207'),
(1060, 'Cansoft-CL Suppository', '92', 'Cansoft-CL Suppository', '801', 44, 'SC1160', 0, '0', 0, '28', '30049000', 1, '36', '2017-09-26 13:15:27', '117.207.101.207'),
(1061, 'Siphene 100mg Tablet', '53', 'Siphene 100mg Tablet', '2375', 54, 'SC1161', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 13:17:15', '117.207.101.207'),
(1062, 'Polaramine 2mg Tablet', '53', 'Polaramine 2mg Tablet', '1588', 60, 'SC1162', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 13:19:34', '117.207.101.207'),
(1063, 'Gudcef-CV 200 Tablet', '53', 'Gudcef-CV 200 Tablet', '1589', 45, 'SC1163', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 13:21:34', '117.207.101.207'),
(1064, 'Carca 3.125mg Tablet', '53', 'Carca 3.125mg Tablet', '2376', 125, 'SC1164', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 13:25:11', '117.207.101.207'),
(1065, 'Amlosafe TM 40 Mg/5 Mg Tablet', '53', 'Amlosafe TM 40 mg/5 mg Tablet', '2247', 69, 'SC1165', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 13:27:02', '117.207.101.207'),
(1066, 'Maxtra P Tablet', '53', 'Maxtra P Tablet', '2377', 122, 'SC1166', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 13:28:42', '117.207.101.207'),
(1067, 'Nexpro 40mg Tablet', '53', 'Nexpro 40mg Tablet', '2378', 34, 'SC1167', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 13:30:14', '117.207.101.207'),
(1068, 'Lizolid 600mg Tablet', '53', 'Lizolid 600mg Tablet', '2379', 63, 'SC1168', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 13:37:03', '117.207.101.207'),
(1069, 'Pantop 20mg Tablet', '53', 'Pantop 20mg Tablet', '2380', 69, 'SC1169', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 13:39:15', '117.207.101.207'),
(1070, 'Oxerute CD Tablet', '53', 'Oxerute CD Tablet', '1601', 106, 'SC1170', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 13:40:41', '117.207.101.207'),
(1071, 'Omnacortil 5mg Tablet', '53', 'Omnacortil 5mg Tablet', '2381', 53, 'SC1171', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 13:42:12', '117.207.101.207'),
(1072, 'Alivher 25mg Tablet', '53', 'Alivher 25mg Tablet', '2125', 135, 'SC1172', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 13:43:27', '117.207.101.207'),
(1073, 'N S 0.9gm Infusion', '95', 'N S 0.9gm Infusion', '2382', 139, 'SC1173', 0, '0', 0, '32', '30049000', 1, '36', '2017-09-26 13:51:38', '117.207.101.207'),
(1074, 'Nootropil 800mg Tablet', '53', 'Nootropil 800mg Tablet', '2383', 48, 'SC1174', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 13:59:07', '117.207.101.207'),
(1075, 'Losar-H Tablet', '53', 'Losar-H Tablet', '2384', 24, 'SC1175', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 14:00:44', '117.207.101.207'),
(1076, 'Ecosprin Gold 10 Capsule', '60', 'Ecosprin Gold 10 Capsule', '2385', 64, 'SC1176', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-26 14:02:24', '117.207.101.207'),
(1077, 'GP 1mg Tablet', '53', 'GP 1mg Tablet', '2386', 64, 'SC1177', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 14:04:24', '117.207.101.207'),
(1078, 'Glevo 500mg Tablet', '53', 'Glevo 500mg Tablet', '2068', 63, 'SC1178', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 14:06:13', '117.207.101.207'),
(1079, 'Gerbisa 5mg Suppository', '92', 'Gerbisa 5mg Suppository', '147', 18, 'SC1179', 0, '0', 0, '28', '30049000', 1, '36', '2017-09-26 14:07:38', '117.207.101.207'),
(1080, 'Vorth TM 325mg/37.5mg Tablet', '53', 'Vorth TM 325mg/37.5mg Tablet', '1631', 63, 'SC1180', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-26 14:11:18', '117.207.101.207'),
(1081, 'Butrum 1mg Injection', '57', 'Butrum 1mg Injection', '2389', 69, 'SC1181', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 14:13:49', '117.207.101.207'),
(1082, 'Hetrazan 100mg Tablet', '53', 'Hetrazan 100mg Tablet', '1637', 23, 'SC1182', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 14:15:20', '117.207.101.207'),
(1083, 'Chymomax Tablet', '53', 'Chymomax Tablet', '1638', 140, 'SC1183', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 14:18:24', '117.207.101.207'),
(1084, 'Metocard XL 25mg Tablet', '53', 'Metocard XL 25mg Tablet', '2390', 34, 'SC1184', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 14:34:55', '117.207.101.207'),
(1085, 'Vansafe CP 500mg Injection', '57', 'Vansafe CP 500mg Injection', '1640', 141, 'SC1185', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 14:40:03', '117.207.101.207'),
(1086, 'Bestova 100mg Capsule', '60', 'Bestova 100mg Capsule', '2391', 135, 'SC1186', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-26 14:44:24', '117.207.101.207'),
(1087, 'Zonamax ES 500 Mg/500 Mg Injection', '57', 'Zonamax ES 500 mg/500 mg Injection', '1643', 53, 'SC1187', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 14:47:43', '117.207.101.207'),
(1088, 'Tegrital CR 400mg Tablet', '53', 'Tegrital CR 400mg Tablet', '267', 28, 'SC1188', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 14:49:53', '117.207.101.207'),
(1089, 'Glycomet-GP 1 Tablet SR', '53', 'Glycomet-GP 1 Tablet SR', '2340', 64, 'SC1189', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 14:51:38', '117.207.101.207'),
(1090, 'Merobax 500mg Injection', '57', 'Merobax 500mg Injection', '2392', 69, 'SC1190', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 14:53:46', '117.207.101.207'),
(1091, 'Lactagard 1000mg/500mg Injection', '57', 'Lactagard 1000mg/500mg Injection', '860', 37, 'SC1191', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 14:56:11', '117.207.101.207'),
(1092, 'Siphene 50mg Tablet', '53', 'Siphene 50mg Tablet', '1292', 54, 'SC1192', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 14:57:42', '117.207.101.207'),
(1093, 'Zerodol TH 8mg Tablet', '53', 'Zerodol TH 8mg Tablet', '2394', 37, 'SC1193', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 15:01:22', '117.207.101.207'),
(1094, 'Enzomac Tablet', '53', 'Enzomac Tablet', '777', 53, 'SC1194', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 15:10:10', '117.207.101.207'),
(1095, 'Amlokind-H Tablet', '53', 'Amlokind-H Tablet', '891', 45, 'SC1195', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 15:16:35', '117.207.101.207'),
(1096, 'Ampilox C Dry Syrup', '54', 'Ampilox C Dry Syrup', '2395', 43, 'SC1196', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-26 15:31:54', '117.207.101.207'),
(1097, 'Daflon 1000 Mg Tablet', '53', 'Daflon 1000 mg Tablet', '2396', 143, 'SC1197', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 15:39:30', '117.207.101.207'),
(1098, 'Asthakind Drop', '80', 'Asthakind Drop', '2397', 45, 'SC1198', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-26 15:53:35', '117.207.101.207'),
(1099, 'Clarinova 250mg Tablet', '53', 'Clarinova 250mg Tablet', '2398', 45, 'SC1199', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 15:59:06', '117.207.101.207'),
(1100, 'Fastclav 500 Tablet', '53', 'Fastclav 500 Tablet', '1683', 37, 'SC1200', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 16:11:52', '117.207.101.207'),
(1101, 'Smuth Suspension', '79', 'Smuth Suspension', '1684', 69, 'SC1201', 0, '0', 0, '9', '30049000', 1, '36', '2017-09-26 16:22:15', '117.221.130.65'),
(1102, 'Lizokef Tablet', '53', 'Lizokef Tablet', '1685', 53, 'SC1202', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 16:25:10', '117.221.130.65'),
(1103, 'Zymor-AP Tablet', '53', 'Zymor-AP Tablet', '1638', 43, 'SC1203', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 16:27:25', '117.221.130.65'),
(1104, 'Pacimol 650mg Tablet', '53', 'Pacimol 650mg Tablet', '1986', 37, 'SC1204', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 16:35:18', '117.222.161.67'),
(1105, 'Nebicard 5mg Tablet', '53', 'Nebicard 5mg Tablet', '2401', 34, 'SC1205', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 16:40:27', '117.222.161.67'),
(1106, 'Lmwx 60mg Injection', '57', 'Lmwx 60mg Injection', '2402', 27, 'SC1206', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 16:42:10', '117.222.161.67'),
(1107, 'Levomac 500mg Tablet', '53', 'Levomac 500mg Tablet', '2068', 53, 'SC1207', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 16:43:29', '117.222.161.67'),
(1108, 'Macsart 40mg Tablet', '53', 'Macsart 40mg Tablet', '1157', 53, 'SC1208', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 16:45:43', '117.222.161.67'),
(1109, 'Loxicard 2% Infusion', '95', 'Loxicard 2% Infusion', '2219', 104, 'SC1209', 0, '0', 0, '32', '30049000', 1, '36', '2017-09-26 17:01:40', '117.222.161.67'),
(1110, 'Besicor 5mg Tablet', '53', 'Besicor 5mg Tablet', '2403', 138, 'SC1210', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 17:05:38', '117.222.161.67'),
(1111, 'Qure 500mg Tablet', '53', 'Qure 500mg Tablet', '2068', 69, 'SC1211', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 17:07:46', '117.222.161.67'),
(1112, 'Gestofit 300mg Tablet SR', '53', 'Gestofit 300mg Tablet SR', '2404', 22, 'SC1212', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 17:16:53', '117.222.161.67'),
(1113, 'Keto B Cream', '55', 'Keto B Cream', '2405', 82, 'SC1213', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-26 17:18:51', '117.222.161.67'),
(1114, 'Folitrax 50mg Injection', '57', 'Folitrax 50mg Injection', '2406', 37, 'SC1214', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 17:23:02', '117.222.161.67'),
(1115, 'Ovigyn D3 Tablet', '53', 'Ovigyn D3 Tablet', '1716', 22, 'SC1215', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 17:25:21', '117.222.161.67'),
(1116, 'Septran Adult 400 Mg/80 Mg Tablet', '53', 'Septran Adult 400 mg/80 mg Tablet', '1006', 26, 'SC1216', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 17:30:02', '117.222.161.67'),
(1117, 'Ascoril LS Drop', '80', 'Ascoril LS Drop', '318', 63, 'SC1217', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-26 17:32:35', '117.222.161.67'),
(1118, 'Planokuf D Syrup', '54', 'Planokuf D Syrup', '2409', 79, 'SC1218', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-26 17:37:08', '117.222.161.67'),
(1119, 'Metocard AM Tablet', '53', 'Metocard AM Tablet', '1735', 34, 'SC1219', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 17:43:00', '117.222.161.67'),
(1120, 'Propyderm NF Cream', '55', 'Propyderm NF Cream', '1736', 117, 'SC1220', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-26 17:44:54', '117.222.161.67'),
(1121, 'Sporidex 500mg Capsule', '60', 'Sporidex 500mg Capsule', '68', 44, 'SC1221', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-26 17:46:52', '117.222.161.67'),
(1122, 'Smartova -50 Capsule', '60', 'Smartova -50 Capsule', '2410', 114, 'SC1222', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-26 17:49:42', '117.222.161.67'),
(1123, 'Nikoran 5mg Tablet', '53', 'Nikoran 5mg Tablet', '2411', 34, 'SC1223', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-26 17:51:33', '117.222.161.67'),
(1124, 'AF Kit 1000 Mg/750 Mg/150 Mg Tablet', '53', 'AF Kit 1000 mg/750 mg/150 mg Tablet', '505', 129, 'SC1224', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 17:54:40', '117.222.161.67'),
(1125, 'Merobax 1000mg Injection', '57', 'Merobax 1000mg Injection', '2412', 69, 'SC1225', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 17:57:36', '117.222.161.67'),
(1126, 'Daflon 500mg Tablet', '53', 'Daflon 500mg Tablet', '2413', 143, 'SC1226', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 18:01:26', '117.222.161.67'),
(1127, 'CPM Injection', '57', 'CPM Injection', '1752', 144, 'SC1227', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 18:06:26', '117.222.161.67'),
(1128, 'Hhderm Cream', '55', 'Hhderm Cream', '1753', 117, 'SC1228', 0, '0', 0, '7', '30049000', 1, '36', '2017-09-26 18:10:01', '117.222.161.67'),
(1129, 'Ecosprin AV 75/20 Capsule', '60', 'Ecosprin AV 75/20 Capsule', '2414', 64, 'SC1229', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-26 18:13:43', '117.222.161.67'),
(1130, 'Tamsin 0.4mg Tablet', '53', 'Tamsin 0.4mg Tablet', '2001', 62, 'SC1230', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 18:22:37', '103.60.74.3'),
(1131, 'Abortab 200mg Tablet', '53', 'Abortab 200mg Tablet', '2415', 51, 'SC1231', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-26 18:30:30', '103.60.74.3'),
(1132, 'Valium 5mg Tablet', '53', 'Valium 5mg Tablet', '2417', 27, 'SC1232', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-26 18:33:09', '103.60.74.3'),
(1133, 'Pantocid IT Capsule SR', '60', 'Pantocid IT Capsule SR', '2418', 44, 'SC1233', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-26 18:36:43', '103.60.74.3'),
(1134, 'Biotax OF Tablet', '53', 'Biotax OF Tablet', '1785', 43, 'SC1234', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 18:40:26', '103.60.74.3'),
(1135, 'Flocetam 400mg Tablet', '53', 'Flocetam 400mg Tablet', '2335', 145, 'SC1235', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 18:44:05', '103.60.74.3'),
(1136, 'Arachitol 6L Injection', '57', 'Arachitol 6L Injection', '2419', 27, 'SC1236', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 18:46:01', '103.60.74.3'),
(1137, 'Frisium 10mg Tablet', '53', 'Frisium 10mg Tablet', '234', 52, 'SC1237', 0, '0', 0, '2', '30049000', 1, '36', '2017-09-26 18:52:25', '103.60.74.3'),
(1138, 'Sporidex-AF 375mg Tablet', '53', 'Sporidex-AF 375mg Tablet', '1531', 44, 'SC1238', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 18:54:10', '103.60.74.3'),
(1139, 'Fas 3 Kit', '53', 'Fas 3 Kit', '2420', 67, 'SC1239', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 18:57:28', '103.60.74.3'),
(1140, 'Nebicard 10mg Tablet', '53', 'Nebicard 10mg Tablet', '2421', 34, 'SC1240', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 19:07:55', '103.60.74.3'),
(1141, 'Macsart AM Tablet', '53', 'Macsart AM Tablet', '2247', 53, 'SC1241', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 19:18:25', '117.207.104.192'),
(1142, 'Ampikem C 250mg/250mg Capsule', '60', 'Ampikem C 250mg/250mg Capsule', '1811', 90, 'SC1242', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-26 19:21:33', '117.207.104.192'),
(1143, 'Mega CV Drop', '80', 'Mega CV Drop', '2422', 69, 'SC1243', 0, '0', 0, '8', '30049000', 1, '36', '2017-09-26 19:39:07', '117.207.104.192'),
(1144, 'Monit GTN 2.6mg Tablet CR', '53', 'Monit GTN 2.6mg Tablet CR', '2423', 125, 'SC1244', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 19:45:20', '117.207.104.192'),
(1145, 'Lox 10% W/v Spray', '93', 'Lox 10% w/v Spray', '2424', 104, 'SC1245', 0, '0', 0, '30', '30049000', 1, '36', '2017-09-26 19:47:24', '117.207.104.192'),
(1146, 'Susten 100mg Soft Gelatin Capsule', '60', 'Susten 100mg Soft Gelatin Capsule', '2334', 44, 'SC1246', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-26 19:51:06', '117.207.104.192'),
(1147, 'Taxim O Syrup', '54', 'Taxim O Syrup', '1298', 90, 'SC1247', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-26 19:53:22', '117.207.104.192'),
(1148, 'Oncotrex 2.5mg Tablet', '53', 'Oncotrex 2.5mg Tablet', '1839', 44, 'SC1248', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 19:55:41', '117.207.104.192'),
(1149, 'Laz 250mg Tablet', '53', 'Laz 250mg Tablet', '1845', 67, 'SC1249', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 19:59:42', '117.207.104.192'),
(1150, 'Alerid 10mg Tablet', '53', 'Alerid 10mg Tablet', '157', 1, 'SC1250', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 20:01:41', '117.207.104.192'),
(1151, 'Met XL 50mg Tablet', '53', 'Met XL 50mg Tablet', '2368', 138, 'SC1251', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 20:04:36', '117.207.104.192'),
(1152, 'Hepabsv 100IU Injection', '57', 'Hepabsv 100IU Injection', '1849', 51, 'SC1252', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 20:07:20', '117.207.104.192'),
(1153, 'Clofert 25mg Tablet', '53', 'Clofert 25mg Tablet', '2427', 83, 'SC1253', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 20:38:03', '117.207.104.192'),
(1154, 'Malirid DS Tablet', '53', 'Malirid DS Tablet', '2428', 37, 'SC1254', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 20:41:42', '117.207.104.192'),
(1155, 'HH Salic 0.1% W/w/3.5', '77', 'HH Salic 0.1% w/w/3.5', '2429', 117, 'SC1255', 0, '0', 0, '21', '30049000', 1, '36', '2017-09-26 20:47:09', '117.207.104.192'),
(1156, 'Enzar-HS Capsule', '60', 'Enzar-HS Capsule', '2432', 34, 'SC1256', 0, '0', 0, '6', '30049000', 1, '36', '2017-09-26 21:01:20', '117.201.25.158'),
(1157, 'Zenflox-OZ Tablet', '53', 'Zenflox-OZ Tablet', '2433', 45, 'SC1257', 0, '0', 0, '12', '30049000', 1, '36', '2017-09-26 21:03:17', '117.201.25.158'),
(1158, 'Sifasi 5000IU Injection', '57', 'Sifasi 5000IU Injection', '551', 54, 'SC1258', 0, '0', 0, '5', '30049000', 1, '36', '2017-09-26 21:17:18', '59.93.11.153'),
(1159, 'Carnisure Syrup', '54', 'Carnisure Syrup', '2436', 34, 'SC1259', 0, '0', 0, '3', '30049000', 1, '36', '2017-09-26 21:41:02', '59.93.11.153'),
(1160, 'Merizyme Tablet', '53', 'Merizyme Tablet', '784', 66, 'SC1260', 0, '0', 0, '12', '300150001', 1, '36', '2017-10-05 13:47:35', '157.50.15.153'),
(1161, 'Johnsons Baby Oil With Vitamin E', '81', 'Johnsons Baby Oil with Vitamin E', '4', 146, 'SC1261', 0, '0', 0, '10', '300150001', 1, '36', '2017-10-05 13:56:21', '157.50.15.153'),
(1162, 'Caladryl1234', '52', '', '4', 1, 'SC1262', 500, '200', 1000, '4', '132dce23d23d23d2', 1, '26', '2017-11-28 17:36:06', '49.206.126.68'),
(1163, 'Tester Product', '97', 'TESTER', '2438', 1, 'SC1263', 1, '10', 10, '35', 'TEST', 1, '26', '2017-12-28 16:50:53', '49.207.188.110');

-- --------------------------------------------------------

--
-- Table structure for table `productgrouping`
--

CREATE TABLE `productgrouping` (
  `productgroupid` int(11) NOT NULL,
  `productid` varchar(50) NOT NULL,
  `vendorid` varchar(50) NOT NULL,
  `brandcode` varchar(50) NOT NULL,
  `stock_code` varchar(20) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ipaddress` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productgrouping`
--

INSERT INTO `productgrouping` (`productgroupid`, `productid`, `vendorid`, `brandcode`, `stock_code`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(40, '51', '23', 'B1', 'SKC1', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(41, '52', '23', 'B2', 'SKC2', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(42, '123', '23', 'B3', 'SKC3', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(43, '177', '23', 'B4', 'SKC4', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(44, '178', '23', 'B5', 'SKC5', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(45, '273', '23', 'B6', 'SKC6', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(46, '274', '23', 'B7', 'SKC7', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(47, '306', '23', 'B8', 'SKC8', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(48, '329', '23', 'B9', 'SKC9', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(49, '336', '23', 'B10', 'SKC10', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(50, '353', '23', 'B11', 'SKC11', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(51, '418', '23', 'B12', 'SKC12', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(52, '456', '23', 'B13', 'SKC13', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(53, '498', '23', 'B14', 'SKC14', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(54, '551', '23', 'B15', 'SKC15', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(55, '557', '23', 'B16', 'SKC16', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(56, '561', '23', 'B17', 'SKC17', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(57, '627', '23', 'B18', 'SKC18', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(58, '656', '23', 'B19', 'SKC19', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(59, '712', '23', 'B20', 'SKC20', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(60, '724', '23', 'B21', 'SKC21', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(61, '816', '23', 'B22', 'SKC22', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(62, '827', '23', 'B23', 'SKC23', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(63, '830', '23', 'B24', 'SKC24', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(64, '839', '23', 'B25', 'SKC25', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(65, '864', '23', 'B26', 'SKC26', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(66, '903', '23', 'B27', 'SKC27', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(67, '931', '23', 'B28', 'SKC28', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(68, '955', '23', 'B29', 'SKC29', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(69, '971', '23', 'B30', 'SKC30', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(70, '991', '23', 'B31', 'SKC31', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(71, '994', '23', 'B32', 'SKC32', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(72, '1041', '23', 'B33', 'SKC33', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(73, '1056', '23', 'B34', 'SKC34', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(74, '1098', '23', 'B35', 'SKC35', 1, '26', '2017-10-18 14:07:39', '49.207.184.24'),
(75, '17', '1', 'B75', 'SKC75', 1, '26', '2017-10-21 12:02:11', '122.171.87.93'),
(76, '128', '1', 'B76', 'SKC76', 1, '26', '2017-10-21 12:02:11', '122.171.87.93'),
(77, '9', '6', 'B77', 'SKC77', 1, '26', '2017-10-25 09:12:16', '106.208.68.80'),
(78, '10', '6', 'B78', 'SKC78', 1, '26', '2017-10-25 09:12:16', '106.208.68.80'),
(79, '29', '20', 'B79', 'SKC79', 1, '26', '2017-11-17 11:58:08', '122.174.33.82'),
(80, '30', '20', 'B80', 'SKC80', 1, '26', '2017-11-17 11:58:08', '122.174.33.82'),
(81, '31', '20', 'B81', 'SKC81', 1, '26', '2017-11-17 11:58:08', '122.174.33.82'),
(82, '2', '1', 'B82', 'SKC82', 1, '26', '2017-11-28 17:16:39', '49.206.126.68'),
(83, '3', '1', 'B83', 'SKC83', 1, '26', '2017-11-28 17:16:39', '49.206.126.68'),
(84, '4', '1', 'B84', 'SKC84', 1, '26', '2017-11-28 17:17:27', '49.206.126.68'),
(86, '1163', '24', 'B85', 'SKC85', 1, '26', '2017-12-28 17:20:18', '49.207.188.110'),
(87, '5', '1', 'B87', 'SKC87', 1, '26', '2018-04-08 16:34:46', '192.168.1.21'),
(89, '6', '1', 'B88', 'SKC88', 1, '26', '2018-04-08 16:44:25', '192.168.1.21');

-- --------------------------------------------------------

--
-- Table structure for table `producttype`
--

CREATE TABLE `producttype` (
  `product_typeid` int(11) NOT NULL,
  `product_type` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ipaddress` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producttype`
--

INSERT INTO `producttype` (`product_typeid`, `product_type`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(52, 'Lotion', 1, '26', '2018-02-06 15:59:12', '192.168.1.84'),
(53, 'Tablets', 1, '17', '2017-07-21 11:28:02', '192.168.1.17'),
(54, 'Syrup', 1, '26', '2017-08-22 11:30:10', '49.206.117.149'),
(55, 'Cream', 1, '17', '2017-07-20 16:50:41', '192.168.1.27'),
(57, 'Injection', 1, '17', '2017-07-19 12:51:22', '192.168.1.27'),
(60, 'Capsule', 1, '17', '2017-07-24 13:19:18', '192.168.1.22'),
(71, 'Rotacaps', 1, '36', '2017-09-18 20:39:11', '117.249.223.241'),
(72, 'Gel', 1, '26', '2017-08-22 11:29:58', '49.206.117.149'),
(73, 'Solution', 1, '26', '2017-08-22 11:30:20', '49.206.117.149'),
(74, 'Surgical', 1, '26', '2017-08-22 11:30:32', '49.206.117.149'),
(75, 'General', 1, '26', '2017-08-22 11:32:58', '49.206.117.149'),
(76, 'IV Fluids', 1, '26', '2017-08-22 11:33:23', '49.206.117.149'),
(77, 'Ointment', 1, '36', '2017-09-22 15:45:24', '117.221.131.112'),
(78, 'Powder', 1, '26', '2017-08-22 11:33:47', '49.206.117.149'),
(79, 'Suspension', 1, '26', '2017-08-22 11:33:58', '49.206.117.149'),
(80, 'Drops', 1, '26', '2017-08-22 11:34:17', '49.206.117.149'),
(81, 'Liquid', 1, '26', '2017-08-25 13:24:25', '49.207.187.48'),
(82, 'Paste', 1, '33', '2017-09-09 15:08:19', '49.207.177.156'),
(84, 'Hard', 1, '33', '2017-09-09 15:08:43', '49.207.177.156'),
(86, 'Inhaler', 1, '26', '2017-09-17 11:36:32', '49.207.184.10'),
(87, 'Respules', 1, '26', '2017-09-17 11:39:34', '49.207.184.10'),
(88, 'Sachet', 1, '36', '2017-09-18 20:32:32', '117.249.223.241'),
(89, 'Oniment', 1, '36', '2017-09-22 15:44:53', '117.221.131.112'),
(90, 'Tube', 1, '36', '2017-09-22 15:47:39', '117.221.131.112'),
(91, 'Bottle', 1, '36', '2017-09-22 16:52:42', '117.221.135.89'),
(92, 'Suppository', 1, '36', '2017-09-23 18:39:24', '117.201.28.84'),
(93, 'Spray', 1, '36', '2017-09-23 19:48:26', '117.201.24.231'),
(94, 'Spary', 1, '36', '2017-09-23 19:48:53', '117.201.24.231'),
(95, 'Infusion', 1, '36', '2017-09-23 20:31:12', '117.201.24.231'),
(96, 'Test', 1, '26', '2017-12-28 15:29:01', '49.207.188.110'),
(97, 'TESTER', 1, '26', '2017-12-28 16:14:09', '49.207.188.110');

-- --------------------------------------------------------

--
-- Table structure for table `returndetail`
--

CREATE TABLE `returndetail` (
  `return_detailid` int(11) NOT NULL,
  `return_id` int(11) NOT NULL,
  `stockid` int(11) NOT NULL,
  `stockresponseid` int(11) NOT NULL,
  `returndate` datetime NOT NULL,
  `productid` int(11) NOT NULL,
  `brandcode` varchar(20) NOT NULL,
  `stock_code` varchar(50) NOT NULL,
  `compositionid` int(11) NOT NULL,
  `unitid` int(11) NOT NULL,
  `batchnumber` varchar(50) NOT NULL,
  `expiredate` date NOT NULL,
  `productqty` int(11) NOT NULL,
  `price` double NOT NULL,
  `discount_type` varchar(100) NOT NULL,
  `gstvalue` float NOT NULL,
  `cgstvalue` float NOT NULL,
  `sgstvalue` float NOT NULL,
  `discountvalue` float NOT NULL,
  `priceperqty` double NOT NULL,
  `gstrate` float NOT NULL,
  `discountrate` float NOT NULL,
  `gstvalueperquantity` float NOT NULL,
  `discountvalueperquantity` float NOT NULL,
  `is_active` tinyint(3) NOT NULL,
  `updated_by` tinyint(3) NOT NULL,
  `updated_on` date NOT NULL,
  `updated_ipaddress` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `returndetail`
--

INSERT INTO `returndetail` (`return_detailid`, `return_id`, `stockid`, `stockresponseid`, `returndate`, `productid`, `brandcode`, `stock_code`, `compositionid`, `unitid`, `batchnumber`, `expiredate`, `productqty`, `price`, `discount_type`, `gstvalue`, `cgstvalue`, `sgstvalue`, `discountvalue`, `priceperqty`, `gstrate`, `discountrate`, `gstvalueperquantity`, `discountvalueperquantity`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(3, 1, 44, 74, '2018-02-03 01:02:50', 17, 'B75', 'SKC75', 1994, 1, '12', '1970-01-01', 2, 120, 'flat', 0, 0, 0, 0, 60, 0, 0, 0, 0, 1, 26, '2018-02-03', '192.168.1.84'),
(4, 2, 44, 74, '2018-02-03 06:47:50', 17, 'B75', 'SKC75', 1994, 1, '12', '1970-01-01', 2, 120, 'flat', 0, 0, 0, 0, 60, 0, 0, 0, 0, 1, 26, '2018-02-03', '192.168.1.84');

-- --------------------------------------------------------

--
-- Table structure for table `saledetail`
--

CREATE TABLE `saledetail` (
  `opsale_detailid` int(11) NOT NULL,
  `opsaleid` varchar(200) NOT NULL,
  `return_status` enum('N','Y') NOT NULL DEFAULT 'N',
  `stockid` int(11) NOT NULL,
  `stockresponseid` int(11) NOT NULL,
  `saledate` datetime NOT NULL,
  `productid` varchar(100) NOT NULL,
  `brandcode` varchar(20) NOT NULL,
  `stock_code` varchar(50) NOT NULL,
  `compositionid` varchar(100) NOT NULL,
  `unitid` varchar(100) NOT NULL,
  `batchnumber` varchar(50) NOT NULL,
  `productqty` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `taxableamount` float NOT NULL,
  `mrpperunit` float NOT NULL,
  `expiredate` date DEFAULT NULL,
  `priceperqty` varchar(100) NOT NULL,
  `gstrate` varchar(10) NOT NULL,
  `discountrate` varchar(10) NOT NULL,
  `gstvalueperquantity` float NOT NULL,
  `discountvalueperquantity` float DEFAULT NULL,
  `gstvalue` float NOT NULL,
  `cgst_percent` float DEFAULT NULL,
  `sgst_percent` float DEFAULT NULL,
  `cgstvalue` float NOT NULL,
  `sgstvalue` float NOT NULL,
  `total_price_perqty` float DEFAULT NULL,
  `discountvalue` float DEFAULT NULL,
  `discount_type` varchar(100) DEFAULT NULL,
  `tablet_type` varchar(50) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `medicine_type_ins` varchar(255) DEFAULT NULL,
  `tablet_tot_unit_ins` varchar(255) DEFAULT NULL,
  `is_active` tinyint(3) NOT NULL,
  `updated_by` tinyint(3) NOT NULL,
  `updated_on` date NOT NULL,
  `updated_ipaddress` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saledetail`
--

INSERT INTO `saledetail` (`opsale_detailid`, `opsaleid`, `return_status`, `stockid`, `stockresponseid`, `saledate`, `productid`, `brandcode`, `stock_code`, `compositionid`, `unitid`, `batchnumber`, `productqty`, `price`, `taxableamount`, `mrpperunit`, `expiredate`, `priceperqty`, `gstrate`, `discountrate`, `gstvalueperquantity`, `discountvalueperquantity`, `gstvalue`, `cgst_percent`, `sgst_percent`, `cgstvalue`, `sgstvalue`, `total_price_perqty`, `discountvalue`, `discount_type`, `tablet_type`, `product_name`, `medicine_type_ins`, `tablet_tot_unit_ins`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1, '1', 'Y', 1, 3, '2018-04-05 01:13:31', '17', 'B20', 'SKC20', '1994', '2', 't2', '1', '0', 0, 0, '2017-10-26', '0', '0', '', 0, NULL, 0, 0, 0, 0, 0, 0, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-06', '192.168.1.13'),
(2, '1', 'Y', 15, 27, '2018-04-05 01:13:31', '17', 'B75', 'SKC75', '1994', '2', 'TAB001', '1', '11', 0, 11.2, '2018-01-31', '11', '12', '', 0, NULL, 1.32, 6, 6, 0.66, 0.66, 12.32, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-06', '192.168.1.13'),
(3, '1', 'Y', 15, 41, '2018-04-05 01:13:31', '17', 'B75', 'SKC75', '1994', '2', 'KAL001', '4', '60', 0, 15, '2018-03-31', '60', '12', '', 0, NULL, 7.2, 6, 6, 3.6, 3.6, 67.2, NULL, '', '2', NULL, 'Tablets', '4', 1, 26, '2018-04-06', '192.168.1.13'),
(4, '1', 'Y', 1, 5, '2018-04-05 01:13:31', '17', 'B20', 'SKC20', '1994', '2', 'BN101', '102', '102', 0, 1, '2018-09-28', '102', '0', '', 0, NULL, 0, 0, 0, 0, 0, 102, NULL, '', '2', NULL, 'Tablets', '102', 1, 26, '2018-04-06', '192.168.1.13'),
(5, '1', 'Y', 1, 8, '2018-04-05 01:13:31', '17', 'B20', 'SKC20', '1994', '2', 'CA1011', '100', '200', 0, 2, '2018-09-30', '200', '0', '', 0, NULL, 0, 0, 0, 0, 0, 200, NULL, '', '2', NULL, 'Tablets', '100', 1, 26, '2018-04-06', '192.168.1.13'),
(6, '1', 'Y', 1, 1, '2018-04-05 01:13:31', '17', 'B20', 'SKC20', '1994', '2', '1234', '30', '300', 0, 1, '2019-09-27', '300', '5', '', 0, NULL, 15, 2.5, 2.5, 7.5, 7.5, 315, NULL, '', '12', NULL, 'Strips', '300', 1, 26, '2018-04-06', '192.168.1.13'),
(7, '2', 'Y', 1, 3, '2018-04-05 01:13:40', '17', 'B20', 'SKC20', '1994', '2', 't2', '1', '0', 0, 0, '2017-10-26', '0', '0', '', 0, 0, 0, 0, 0, 0, 0, 0, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-07', '192.168.1.13'),
(8, '2', 'Y', 15, 27, '2018-04-05 01:13:40', '17', 'B75', 'SKC75', '1994', '2', 'TAB001', '1', '11', 0, 11.2, '2018-01-31', '11', '12', '', 0, 5, 1.32, 6, 6, 0.36, 0.36, 6.72, NULL, 'Flat', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-07', '192.168.1.13'),
(9, '2', 'Y', 15, 41, '2018-04-05 01:13:40', '17', 'B75', 'SKC75', '1994', '2', 'KAL001', '4', '60', 0, 15, '2018-03-31', '60', '12', '', 0, 0, 7.2, 6, 6, 3.6, 3.6, 67.2, NULL, '', '2', NULL, 'Tablets', '4', 1, 26, '2018-04-07', '192.168.1.13'),
(10, '2', 'Y', 1, 5, '2018-04-05 01:13:40', '17', 'B20', 'SKC20', '1994', '2', 'BN101', '102', '102', 0, 1, '2018-09-28', '102', '0', '', 0, 0, 0, 0, 0, 0, 0, 102, NULL, '', '2', NULL, 'Tablets', '102', 1, 26, '2018-04-07', '192.168.1.13'),
(11, '2', 'Y', 1, 8, '2018-04-05 01:13:40', '17', 'B20', 'SKC20', '1994', '2', 'CA1011', '100', '200', 0, 2, '2018-09-30', '200', '0', '', 0, 0, 0, 0, 0, 0, 0, 200, NULL, '', '2', NULL, 'Tablets', '100', 1, 26, '2018-04-07', '192.168.1.13'),
(12, '2', 'Y', 1, 1, '2018-04-05 01:13:40', '17', 'B20', 'SKC20', '1994', '2', '1234', '30', '300', 0, 1, '2019-09-27', '300', '5', '', 0, 0, 15, 2.5, 2.5, 7.5, 7.5, 315, NULL, '', '12', NULL, 'Strips', '300', 1, 26, '2018-04-07', '192.168.1.13'),
(13, '3', 'N', 1, 3, '2018-04-05 03:41:10', '17', 'B20', 'SKC20', '1994', '2', 't2', '1', '3', 0, 0, '2017-10-26', '0', '0', '', 0, NULL, 0, 0, 0, 0, 0, 0, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-05', '192.168.1.16'),
(14, '3', 'N', 15, 27, '2018-04-05 03:41:10', '17', 'B75', 'SKC75', '1994', '2', 'TAB001', '1', '27', 0, 11.2, '2018-01-31', '11', '12', '', 0, NULL, 1.32, 6, 6, 0.66, 0.66, 12.32, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-05', '192.168.1.16'),
(15, '3', 'N', 15, 41, '2018-04-05 03:41:11', '17', 'B75', 'SKC75', '1994', '2', 'KAL001', '4', '41', 0, 15, '2018-03-31', '60', '12', '', 0, NULL, 7.2, 6, 6, 3.6, 3.6, 67.2, NULL, '', '2', NULL, 'Tablets', '4', 1, 26, '2018-04-05', '192.168.1.16'),
(16, '3', 'N', 1, 5, '2018-04-05 03:41:11', '17', 'B20', 'SKC20', '1994', '2', 'BN101', '102', '5', 0, 1, '2018-09-28', '102', '0', '', 0, NULL, 0, 0, 0, 0, 0, 102, NULL, '', '2', NULL, 'Tablets', '102', 1, 26, '2018-04-05', '192.168.1.16'),
(17, '3', 'N', 1, 8, '2018-04-05 03:41:11', '17', 'B20', 'SKC20', '1994', '2', 'CA1011', '100', '8', 0, 2, '2018-09-30', '200', '0', '', 0, NULL, 0, 0, 0, 0, 0, 200, NULL, '', '2', NULL, 'Tablets', '100', 1, 26, '2018-04-05', '192.168.1.16'),
(18, '3', 'N', 1, 1, '2018-04-05 03:41:11', '17', 'B20', 'SKC20', '1994', '2', '1234', '30', '1', 0, 1, '2019-09-27', '300', '5', '', 0, NULL, 15, 2.5, 2.5, 7.5, 7.5, 315, NULL, '', '12', NULL, 'Strips', '300', 1, 26, '2018-04-05', '192.168.1.16'),
(19, '4', 'N', 1, 3, '2018-04-05 03:43:43', '17', 'B20', 'SKC20', '1994', '2', 't2', '1', '3', 0, 0, '2017-10-26', '0', '0', '', 0, NULL, 0, 0, 0, 0, 0, 0, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-05', '192.168.1.16'),
(20, '4', 'N', 1, 2, '2018-04-05 03:43:43', '17', 'B20', 'SKC20', '1994', '2', 't1', '11', '2', 0, 11, '2017-11-03', '121', '10', '', 0, NULL, 12.1, 5, 5, 6.05, 6.05, 133.1, NULL, '', '2', NULL, 'Tablets', '11', 1, 26, '2018-04-05', '192.168.1.16'),
(21, '4', 'N', 15, 27, '2018-04-05 03:43:43', '17', 'B75', 'SKC75', '1994', '2', 'TAB001', '1', '27', 0, 11.2, '2018-01-31', '11', '12', '', 0, NULL, 1.32, 6, 6, 0.66, 0.66, 12.32, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-05', '192.168.1.16'),
(22, '4', 'N', 15, 41, '2018-04-05 03:43:43', '17', 'B75', 'SKC75', '1994', '2', 'KAL001', '4', '41', 0, 15, '2018-03-31', '60', '12', '', 0, NULL, 7.2, 6, 6, 3.6, 3.6, 67.2, NULL, '', '2', NULL, 'Tablets', '4', 1, 26, '2018-04-05', '192.168.1.16'),
(23, '4', 'N', 1, 5, '2018-04-05 03:43:43', '17', 'B20', 'SKC20', '1994', '2', 'BN101', '102', '5', 0, 1, '2018-09-28', '102', '0', '', 0, NULL, 0, 0, 0, 0, 0, 102, NULL, '', '2', NULL, 'Tablets', '102', 1, 26, '2018-04-05', '192.168.1.16'),
(24, '4', 'N', 1, 8, '2018-04-05 03:43:43', '17', 'B20', 'SKC20', '1994', '2', 'CA1011', '100', '8', 0, 2, '2018-09-30', '200', '0', '', 0, NULL, 0, 0, 0, 0, 0, 200, NULL, '', '2', NULL, 'Tablets', '100', 1, 26, '2018-04-05', '192.168.1.16'),
(25, '4', 'N', 1, 1, '2018-04-05 03:43:43', '17', 'B20', 'SKC20', '1994', '2', '1234', '354', '1', 0, 1, '2019-09-27', '354', '5', '', 0, NULL, 17.7, 2.5, 2.5, 8.85, 8.85, 371.7, NULL, '', '2', NULL, 'Tablets', '354', 1, 26, '2018-04-05', '192.168.1.16'),
(26, '4', 'N', 1, 7, '2018-04-05 03:43:43', '17', 'B20', 'SKC20', '1994', '2', 'CA1010', '98', '7', 0, 1, '2019-10-26', '98', '0', '', 0, NULL, 0, 0, 0, 0, 0, 98, NULL, '', '2', NULL, 'Tablets', '98', 1, 26, '2018-04-05', '192.168.1.16'),
(27, '5', 'N', 1, 2, '2018-04-05 04:05:43', '17', 'B20', 'SKC20', '1994', '2', 't1', '11', '2', 0, 11, '2017-11-03', '121', '10', '', 0, NULL, 12.1, 5, 5, 6.05, 6.05, 133.1, NULL, '', '2', NULL, 'Tablets', '11', 1, 26, '2018-04-05', '192.168.1.16'),
(28, '5', 'N', 15, 27, '2018-04-05 04:05:43', '17', 'B75', 'SKC75', '1994', '2', 'TAB001', '1', '27', 0, 11.2, '2018-01-31', '11', '12', '', 0, NULL, 1.32, 6, 6, 0.66, 0.66, 12.32, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-05', '192.168.1.16'),
(29, '5', 'N', 15, 41, '2018-04-05 04:05:43', '17', 'B75', 'SKC75', '1994', '2', 'KAL001', '4', '41', 0, 15, '2018-03-31', '60', '12', '', 0, NULL, 7.2, 6, 6, 3.6, 3.6, 67.2, NULL, '', '2', NULL, 'Tablets', '4', 1, 26, '2018-04-05', '192.168.1.16'),
(30, '5', 'N', 1, 5, '2018-04-05 04:05:43', '17', 'B20', 'SKC20', '1994', '2', 'BN101', '102', '5', 0, 1, '2018-09-28', '102', '0', '', 0, NULL, 0, 0, 0, 0, 0, 102, NULL, '', '2', NULL, 'Tablets', '102', 1, 26, '2018-04-05', '192.168.1.16'),
(31, '5', 'N', 1, 8, '2018-04-05 04:05:43', '17', 'B20', 'SKC20', '1994', '2', 'CA1011', '100', '8', 0, 2, '2018-09-30', '200', '0', '', 0, NULL, 0, 0, 0, 0, 0, 200, NULL, '', '2', NULL, 'Tablets', '100', 1, 26, '2018-04-05', '192.168.1.16'),
(32, '5', 'N', 1, 1, '2018-04-05 04:05:43', '17', 'B20', 'SKC20', '1994', '2', '1234', '354', '1', 0, 1, '2019-09-27', '354', '5', '', 0, NULL, 17.7, 2.5, 2.5, 8.85, 8.85, 371.7, NULL, '', '2', NULL, 'Tablets', '354', 1, 26, '2018-04-05', '192.168.1.16'),
(33, '5', 'N', 1, 7, '2018-04-05 04:05:43', '17', 'B20', 'SKC20', '1994', '2', 'CA1010', '98', '7', 0, 1, '2019-10-26', '98', '0', '', 0, NULL, 0, 0, 0, 0, 0, 98, NULL, '', '2', NULL, 'Tablets', '98', 1, 26, '2018-04-05', '192.168.1.16'),
(34, '5', 'N', 46, 88, '2018-04-05 04:05:43', '3', 'B83', 'SKC83', '3', '2', '9465645', '10', '88', 0, 0.09, '2018-02-20', '0', '0', '', 0, NULL, 0, 0, 0, 0, 0, 0, NULL, '', '2', NULL, 'Tablets', '10', 1, 26, '2018-04-05', '192.168.1.16'),
(35, '5', 'N', 40, 64, '2018-04-05 04:05:43', '1163', 'B85', 'SKC85', '2438', '35', 'TEST', '8', '64', 0, 10, '2017-12-31', '800', '0', '', 0, NULL, 0, 0, 0, 0, 0, 800, NULL, '', '35', NULL, 'TEST4', '80', 1, 26, '2018-04-05', '192.168.1.16'),
(36, '6', 'Y', 1, 2, '2018-04-05 04:17:09', '17', 'B20', 'SKC20', '1994', '2', 't1', '11', '121', 0, 11, '2017-11-03', '121', '10', '', 0, NULL, 12.1, 5, 5, 6.05, 6.05, 133.1, NULL, '', '2', NULL, 'Tablets', '11', 1, 26, '2018-04-07', '192.168.1.13'),
(37, '6', 'Y', 15, 27, '2018-04-05 04:17:09', '17', 'B75', 'SKC75', '1994', '2', 'TAB001', '1', '11', 0, 11.2, '2018-01-31', '11', '12', '', 0, NULL, 1.32, 6, 6, 0.66, 0.66, 12.32, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-07', '192.168.1.13'),
(38, '6', 'Y', 15, 41, '2018-04-05 04:17:09', '17', 'B75', 'SKC75', '1994', '2', 'KAL001', '4', '60', 0, 15, '2018-03-31', '60', '12', '', 0, NULL, 7.2, 6, 6, 3.6, 3.6, 67.2, NULL, '', '2', NULL, 'Tablets', '4', 1, 26, '2018-04-07', '192.168.1.13'),
(39, '6', 'Y', 1, 5, '2018-04-05 04:17:09', '17', 'B20', 'SKC20', '1994', '2', 'BN101', '10', '100', 0, 1, '2018-09-28', '100', '0', '', 0, NULL, 0, 0, 0, 0, 0, 100, NULL, '', '12', NULL, 'Strips', '100', 1, 26, '2018-04-07', '192.168.1.13'),
(40, '6', 'Y', 1, 8, '2018-04-05 04:17:09', '17', 'B20', 'SKC20', '1994', '2', 'CA1011', '10', '200', 0, 2, '2018-09-30', '200', '0', '', 0, NULL, 0, 0, 0, 0, 0, 200, NULL, '', '12', NULL, 'Strips', '100', 1, 26, '2018-04-07', '192.168.1.13'),
(41, '6', 'Y', 1, 1, '2018-04-05 04:17:09', '17', 'B20', 'SKC20', '1994', '2', '1234', '33', '330', 0, 1, '2019-09-27', '330', '5', '', 0, NULL, 16.5, 2.5, 2.5, 8.25, 8.25, 346.5, NULL, '', '12', NULL, 'Strips', '330', 1, 26, '2018-04-07', '192.168.1.13'),
(48, '8', 'N', 1, 2, '2018-04-06 07:19:32', '17', 'B20', 'SKC20', '1994', '2', 't1', '11', '121', 0, 11, '2017-11-03', '121', '10', '', 0, NULL, 12.1, 5, 5, 6.05, 6.05, 133.1, NULL, '', '2', NULL, 'Tablets', '11', 1, 26, '2018-04-06', '192.168.1.13'),
(49, '8', 'N', 15, 27, '2018-04-06 07:19:32', '17', 'B75', 'SKC75', '1994', '2', 'TAB001', '1', '11', 0, 11.2, '2018-01-31', '11', '12', '', 0, NULL, 1.32, 6, 6, 0.66, 0.66, 12.32, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-06', '192.168.1.13'),
(50, '8', 'N', 15, 41, '2018-04-06 07:19:32', '17', 'B75', 'SKC75', '1994', '2', 'KAL001', '4', '60', 0, 15, '2018-03-31', '60', '12', '', 0, NULL, 7.2, 6, 6, 3.6, 3.6, 67.2, NULL, '', '2', NULL, 'Tablets', '4', 1, 26, '2018-04-06', '192.168.1.13'),
(51, '8', 'N', 1, 5, '2018-04-06 07:19:32', '17', 'B20', 'SKC20', '1994', '2', 'BN101', '10', '100', 0, 1, '2018-09-28', '100', '0', '', 0, NULL, 0, 0, 0, 0, 0, 100, NULL, '', '12', NULL, 'Strips', '100', 1, 26, '2018-04-06', '192.168.1.13'),
(52, '8', 'N', 1, 8, '2018-04-06 07:19:32', '17', 'B20', 'SKC20', '1994', '2', 'CA1011', '10', '200', 0, 2, '2018-09-30', '200', '0', '', 0, NULL, 0, 0, 0, 0, 0, 200, NULL, '', '12', NULL, 'Strips', '100', 1, 26, '2018-04-06', '192.168.1.13'),
(53, '8', 'N', 1, 1, '2018-04-06 07:19:32', '17', 'B20', 'SKC20', '1994', '2', '1234', '33', '330', 0, 1, '2019-09-27', '330', '5', '', 0, NULL, 16.5, 2.5, 2.5, 8.25, 8.25, 346.5, NULL, '', '12', NULL, 'Strips', '330', 1, 26, '2018-04-06', '192.168.1.13'),
(54, '9', 'Y', 1, 2, '2018-04-07 11:24:31', '17', 'B20', 'SKC20', '1994', '2', 't1', '22', '242', 0, 11, '2017-11-03', '242', '10', '', 0, NULL, 24.2, 5, 5, 12.1, 12.1, 266.2, NULL, '', '2', NULL, 'Tablets', '22', 1, 26, '2018-04-07', '192.168.1.13'),
(55, '10', 'Y', 1, 2, '2018-04-07 11:27:50', '17', 'B20', 'SKC20', '1994', '2', 't1', '44', '484', 0, 11, '2017-11-03', '484', '10', '', 0, NULL, 48.4, 5, 5, 24.2, 24.2, 532.4, NULL, '', '2', NULL, 'Tablets', '44', 1, 26, '2018-04-07', '192.168.1.13'),
(56, '11', 'N', 1, 2, '2018-04-07 01:20:17', '17', 'B20', 'SKC20', '1994', '2', 't1', '10', '110', 0, 11, '2017-11-03', '110', '10', '', 0, NULL, 11, 5, 5, 5.5, 5.5, 121, NULL, '', '2', NULL, 'Tablets', '10', 1, 26, '2018-04-07', '192.168.1.13'),
(57, '12', 'N', 1, 5, '2018-04-07 05:54:27', '17', 'B20', 'SKC20', '1994', '2', 'BN101', '7', '7', 0, 1, '2018-09-28', '7', '0', '', 0, NULL, 0, 0, 0, 0, 0, 7, NULL, '', '2', NULL, 'Tablets', '7', 1, 26, '2018-04-07', '192.168.1.13'),
(58, '12', 'N', 1, 8, '2018-04-07 05:54:27', '17', 'B20', 'SKC20', '1994', '2', 'CA1011', '32', '64', 0, 2, '2018-09-30', '64', '0', '', 0, NULL, 0, 0, 0, 0, 0, 64, NULL, '', '2', NULL, 'Tablets', '32', 1, 26, '2018-04-07', '192.168.1.13'),
(59, '12', 'N', 1, 1, '2018-04-07 05:54:27', '17', 'B20', 'SKC20', '1994', '2', '1234', '55', '55', 0, 1, '2019-09-27', '55', '5', '', 0, NULL, 2.75, 2.5, 2.5, 1.375, 1.375, 57.75, NULL, '', '2', NULL, 'Tablets', '55', 1, 26, '2018-04-07', '192.168.1.13'),
(60, '12', 'N', 1, 7, '2018-04-07 05:54:27', '17', 'B20', 'SKC20', '1994', '2', 'CA1010', '8', '8', 0, 1, '2019-10-26', '8', '0', '', 0, NULL, 0, 0, 0, 0, 0, 8, NULL, '', '2', NULL, 'Tablets', '8', 1, 26, '2018-04-07', '192.168.1.13'),
(61, '13', 'N', 1, 5, '2018-04-07 05:56:20', '17', 'B20', 'SKC20', '1994', '2', 'BN101', '5', '5', 0, 1, '2018-09-28', '5', '0', '', 0, NULL, 0, 0, 0, 0, 0, 5, NULL, '', '2', NULL, 'Tablets', '5', 1, 26, '2018-04-07', '192.168.1.13'),
(62, '13', 'N', 1, 8, '2018-04-07 05:56:20', '17', 'B20', 'SKC20', '1994', '2', 'CA1011', '24', '48', 0, 2, '2018-09-30', '48', '0', '', 0, NULL, 0, 0, 0, 0, 0, 48, NULL, '', '2', NULL, 'Tablets', '24', 1, 26, '2018-04-07', '192.168.1.13'),
(63, '14', 'N', 1, 1, '2018-04-07 05:57:25', '17', 'B20', 'SKC20', '1994', '2', '1234', '48', '48', 0, 1, '2019-09-27', '48', '5', '', 0, NULL, 2.4, 2.5, 2.5, 1.2, 1.2, 50.4, NULL, '', '2', NULL, 'Tablets', '48', 1, 26, '2018-04-07', '192.168.1.13'),
(64, '14', 'N', 1, 7, '2018-04-07 05:57:25', '17', 'B20', 'SKC20', '1994', '2', 'CA1010', '3', '3', 0, 1, '2019-10-26', '3', '0', '', 0, NULL, 0, 0, 0, 0, 0, 3, NULL, '', '2', NULL, 'Tablets', '3', 1, 26, '2018-04-07', '192.168.1.13'),
(65, '15', 'N', 1, 3, '2018-04-07 06:00:32', '17', 'B20', 'SKC20', '1994', '2', 't2', '1', '10', 0, 0, '2017-10-26', '10', '0', '', 0, NULL, 0, 0, 0, 0, 0, 10, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-07', '192.168.1.13'),
(66, '15', 'N', 1, 2, '2018-04-07 06:00:32', '17', 'B20', 'SKC20', '1994', '2', 't1', '1', '11', 0, 11, '2017-11-03', '11', '10', '', 0, NULL, 1.1, 5, 5, 0.55, 0.55, 12.1, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-07', '192.168.1.13'),
(67, '15', 'N', 15, 27, '2018-04-07 06:00:32', '17', 'B75', 'SKC75', '1994', '2', 'TAB001', '1', '11', 0, 11.2, '2018-01-31', '11', '12', '', 0, NULL, 1.32, 6, 6, 0.66, 0.66, 12.32, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-07', '192.168.1.13'),
(68, '15', 'N', 15, 41, '2018-04-07 06:00:32', '17', 'B75', 'SKC75', '1994', '2', 'KAL001', '1', '15', 0, 15, '2018-03-31', '15', '12', '', 0, NULL, 1.8, 6, 6, 0.9, 0.9, 16.8, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-07', '192.168.1.13'),
(69, '15', 'N', 1, 5, '2018-04-07 06:00:32', '17', 'B20', 'SKC20', '1994', '2', 'BN101', '1', '1', 0, 1, '2018-09-28', '1', '0', '', 0, NULL, 0, 0, 0, 0, 0, 1, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-07', '192.168.1.13'),
(70, '15', 'N', 1, 8, '2018-04-07 06:00:32', '17', 'B20', 'SKC20', '1994', '2', 'CA1011', '1', '2', 0, 2, '2018-09-30', '2', '0', '', 0, NULL, 0, 0, 0, 0, 0, 2, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-07', '192.168.1.13'),
(71, '15', 'N', 1, 1, '2018-04-07 06:00:32', '17', 'B20', 'SKC20', '1994', '2', '1234', '1', '1', 0, 1, '2019-09-27', '1', '5', '', 0, NULL, 0.05, 2.5, 2.5, 0.025, 0.025, 1.05, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-07', '192.168.1.13'),
(72, '15', 'N', 1, 7, '2018-04-07 06:00:32', '17', 'B20', 'SKC20', '1994', '2', 'CA1010', '1', '1', 0, 1, '2019-10-26', '1', '0', '', 0, NULL, 0, 0, 0, 0, 0, 1, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-07', '192.168.1.13'),
(73, '16', 'N', 1, 3, '2018-04-07 06:42:31', '17', 'B20', 'SKC20', '1994', '2', 't2', '2', '0', 0, 0, '2017-10-26', '0', '0', '', 0, NULL, 0, 0, 0, 0, 0, 0, NULL, '', '2', NULL, 'Tablets', '2', 1, 26, '2018-04-07', '192.168.1.13'),
(74, '16', 'N', 1, 2, '2018-04-07 06:42:31', '17', 'B20', 'SKC20', '1994', '2', 't1', '10', '110', 0, 11, '2017-11-03', '110', '10', '', 0, NULL, 11, 5, 5, 5.5, 5.5, 121, NULL, '', '2', NULL, 'Tablets', '10', 1, 26, '2018-04-07', '192.168.1.13'),
(75, '17', 'N', 1, 2, '2018-04-07 06:46:01', '17', 'B20', 'SKC20', '1994', '2', 't1', '4', '44', 0, 11, '2017-11-03', '44', '10', '', 0, NULL, 4.4, 5, 5, 2.2, 2.2, 48.4, NULL, '', '2', NULL, 'Tablets', '4', 1, 26, '2018-04-07', '192.168.1.13'),
(76, '18', 'N', 1, 5, '2018-04-07 07:00:36', '17', 'B20', 'SKC20', '1994', '2', 'BN101', '3', '3', 0, 1, '2018-09-28', '3', '0', '', 0, NULL, 0, 0, 0, 0, 0, 3, NULL, '', '2', NULL, 'Tablets', '3', 1, 26, '2018-04-07', '192.168.1.61'),
(77, '18', 'N', 1, 8, '2018-04-07 07:00:36', '17', 'B20', 'SKC20', '1994', '2', 'CA1011', '2', '4', 0, 2, '2018-09-30', '4', '0', '', 0, NULL, 0, 0, 0, 0, 0, 4, NULL, '', '2', NULL, 'Tablets', '2', 1, 26, '2018-04-07', '192.168.1.61'),
(78, '18', 'N', 1, 1, '2018-04-07 07:00:36', '17', 'B20', 'SKC20', '1994', '2', '1234', '2', '2', 0, 1, '2019-09-27', '2', '5', '', 0, NULL, 0.1, 2.5, 2.5, 0.05, 0.05, 2.1, NULL, '', '2', NULL, 'Tablets', '2', 1, 26, '2018-04-07', '192.168.1.61'),
(79, '18', 'N', 1, 7, '2018-04-07 07:00:36', '17', 'B20', 'SKC20', '1994', '2', 'CA1010', '2', '2', 0, 1, '2019-10-26', '2', '0', '', 0, NULL, 0, 0, 0, 0, 0, 2, NULL, '', '2', NULL, 'Tablets', '2', 1, 26, '2018-04-07', '192.168.1.61'),
(80, '19', 'N', 1, 3, '2018-04-08 01:25:07', '17', 'B20', 'SKC20', '1994', '2', 't2', '5', '0', 0, 0, '2017-10-26', '0', '0', '', 0, NULL, 0, 0, 0, 0, 0, 0, NULL, '', '12', NULL, 'Strips', '50', 1, 26, '2018-04-08', '192.168.1.13'),
(81, '20', 'N', 1, 3, '2018-04-08 01:27:21', '17', 'B20', 'SKC20', '1994', '2', 't2', '45', '0', 0, 0, '2017-10-26', '0', '0', '', 0, NULL, 0, 0, 0, 0, 0, 0, NULL, '', '2', NULL, 'Tablets', '45', 1, 26, '2018-04-08', '192.168.1.13'),
(82, '21', 'N', 1, 3, '2018-04-08 02:24:35', '17', 'B20', 'SKC20', '1994', '2', 't2', '100', '0', 0, 0, '2017-10-26', '0', '0', '', 0, NULL, 0, 0, 0, 0, 0, 0, NULL, '', '2', NULL, 'Tablets', '100', 1, 26, '2018-04-08', '192.168.1.13'),
(83, '22', 'Y', 1, 2, '2018-04-08 02:46:40', '17', 'B20', 'SKC20', '1994', '2', 't1', '28', '308', 0, 11, '2017-11-03', '308', '10', '', 0, NULL, 30.8, 5, 5, 15.4, 15.4, 338.8, NULL, '', '2', NULL, 'Tablets', '28', 1, 26, '2018-04-08', '192.168.1.13'),
(84, '22', 'Y', 15, 27, '2018-04-08 02:46:40', '17', 'B75', 'SKC75', '1994', '2', 'TAB001', '315', '3465', 0, 11.2, '2018-01-31', '3465', '12', '', 0, NULL, 415.8, 6, 6, 207.9, 207.9, 3880.8, NULL, '', '2', NULL, 'Tablets', '315', 1, 26, '2018-04-08', '192.168.1.13'),
(85, '22', 'Y', 15, 41, '2018-04-08 02:46:40', '17', 'B75', 'SKC75', '1994', '2', 'KAL001', '228', '3420', 0, 15, '2018-03-31', '3420', '12', '', 0, NULL, 410.4, 6, 6, 205.2, 205.2, 3830.4, NULL, '', '2', NULL, 'Tablets', '228', 1, 26, '2018-04-08', '192.168.1.13'),
(86, '23', 'N', 1, 2, '2018-04-08 02:58:09', '17', 'B20', 'SKC20', '1994', '2', 't1', '1', '11', 0, 11, '2017-11-03', '11', '10', '', 0, NULL, 1.1, 5, 5, 0.55, 0.55, 12.1, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-08', '192.168.1.13'),
(87, '24', 'N', 1, 2, '2018-04-08 03:47:36', '17', 'B20', 'SKC20', '1994', '2', 't1', '1', '11', 0, 11, '2017-11-03', '11', '10', '', 0, NULL, 1.1, 5, 5, 0.55, 0.55, 12.1, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-08', '192.168.1.13'),
(88, '24', 'N', 15, 27, '2018-04-08 03:47:36', '17', 'B75', 'SKC75', '1994', '2', 'TAB001', '1', '11', 0, 11.2, '2018-01-31', '11', '12', '', 0, NULL, 1.32, 6, 6, 0.66, 0.66, 12.32, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-08', '192.168.1.13'),
(89, '24', 'N', 15, 41, '2018-04-08 03:47:36', '17', 'B75', 'SKC75', '1994', '2', 'KAL001', '1', '15', 0, 15, '2018-03-31', '15', '12', '', 0, NULL, 1.8, 6, 6, 0.9, 0.9, 16.8, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-08', '192.168.1.13'),
(90, '24', 'N', 1, 5, '2018-04-08 03:47:36', '17', 'B20', 'SKC20', '1994', '2', 'BN101', '1', '1', 0, 1, '2018-09-28', '1', '0', '', 0, NULL, 0, 0, 0, 0, 0, 1, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-08', '192.168.1.13'),
(91, '24', 'N', 1, 8, '2018-04-08 03:47:36', '17', 'B20', 'SKC20', '1994', '2', 'CA1011', '1', '2', 0, 2, '2018-09-30', '2', '0', '', 0, NULL, 0, 0, 0, 0, 0, 2, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-08', '192.168.1.13'),
(92, '24', 'N', 1, 1, '2018-04-08 03:47:36', '17', 'B20', 'SKC20', '1994', '2', '1234', '1', '1', 0, 1, '2019-09-27', '1', '5', '', 0, NULL, 0.05, 2.5, 2.5, 0.025, 0.025, 1.05, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-08', '192.168.1.13'),
(93, '24', 'N', 1, 7, '2018-04-08 03:47:36', '17', 'B20', 'SKC20', '1994', '2', 'CA1010', '1', '1', 0, 1, '2019-10-26', '1', '0', '', 0, NULL, 0, 0, 0, 0, 0, 1, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-08', '192.168.1.13'),
(94, '25', 'N', 1, 2, '2018-04-08 03:49:10', '17', 'B20', 'SKC20', '1994', '2', 't1', '1', '11', 0, 11, '2017-11-03', '11', '10', '', 0, NULL, 1.1, 5, 5, 0.55, 0.55, 12.1, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-08', '192.168.1.13'),
(95, '25', 'N', 15, 27, '2018-04-08 03:49:11', '17', 'B75', 'SKC75', '1994', '2', 'TAB001', '1', '11', 0, 11.2, '2018-01-31', '11', '12', '', 0, NULL, 1.32, 6, 6, 0.66, 0.66, 12.32, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-08', '192.168.1.13'),
(96, '26', 'N', 15, 27, '2018-04-08 03:53:46', '17', 'B75', 'SKC75', '1994', '2', 'TAB001', '1', '11', 0, 11.2, '2018-01-31', '11', '12', '', 0, 1, 1.2, 6, 6, 0.6, 0.6, 11.2, 1, 'Flat', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-08', '192.168.1.13'),
(97, '26', 'N', 15, 41, '2018-04-08 03:53:46', '17', 'B75', 'SKC75', '1994', '2', 'KAL001', '1', '15', 0, 15, '2018-03-31', '15', '12', '', 0, 0, 1.8, 6, 6, 0.9, 0.9, 16.8, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-08', '192.168.1.13'),
(98, '27', 'N', 1, 2, '2018-04-08 04:00:20', '17', 'B20', 'SKC20', '1994', '2', 't1', '1', '11', 0, 11, '2017-11-03', '11', '10', '', 0, NULL, 1.1, 5, 5, 0.55, 0.55, 12.1, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-08', '192.168.1.13'),
(99, '27', 'N', 15, 27, '2018-04-08 04:00:20', '17', 'B75', 'SKC75', '1994', '2', 'TAB001', '1', '11', 0, 11.2, '2018-01-31', '11', '12', '', 0, NULL, 1.32, 6, 6, 0.66, 0.66, 12.32, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-08', '192.168.1.13'),
(100, '28', 'N', 3, 10, '2018-04-08 00:00:00', '233', 'B15', 'SKC15', '2004', '13', '1234', '50', '52.00', 50, 1, '2018-10-27', '1', '6', '2', 0.06, 0.02, 3, NULL, NULL, 1.5, 1.5, NULL, 1, 'percent', NULL, NULL, NULL, NULL, 1, 26, '2018-04-08', '192.168.1.21'),
(101, '29', 'N', 1, 2, '2018-04-08 06:31:15', '17', 'B20', 'SKC20', '1994', '2', 't1', '1', '11', 0, 11, '2017-11-03', '11', '10', '', 0, NULL, 1.1, 5, 5, 0.55, 0.55, 12.1, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-08', '192.168.1.13'),
(102, '29', 'N', 15, 27, '2018-04-08 06:31:15', '17', 'B75', 'SKC75', '1994', '2', 'TAB001', '1', '11', 0, 11.2, '2018-01-31', '11', '12', '', 0, NULL, 1.32, 6, 6, 0.66, 0.66, 12.32, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-08', '192.168.1.13'),
(103, '29', 'N', 15, 41, '2018-04-08 06:31:15', '17', 'B75', 'SKC75', '1994', '2', 'KAL001', '1', '15', 0, 15, '2018-03-31', '15', '12', '', 0, NULL, 1.8, 6, 6, 0.9, 0.9, 16.8, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-08', '192.168.1.13'),
(104, '29', 'N', 1, 5, '2018-04-08 06:31:15', '17', 'B20', 'SKC20', '1994', '2', 'BN101', '1', '1', 0, 1, '2018-09-28', '1', '0', '', 0, NULL, 0, 0, 0, 0, 0, 1, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-08', '192.168.1.13'),
(105, '29', 'N', 1, 8, '2018-04-08 06:31:15', '17', 'B20', 'SKC20', '1994', '2', 'CA1011', '1', '2', 0, 2, '2018-09-30', '2', '0', '', 0, NULL, 0, 0, 0, 0, 0, 2, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-08', '192.168.1.13'),
(106, '29', 'N', 1, 1, '2018-04-08 06:31:15', '17', 'B20', 'SKC20', '1994', '2', '1234', '1', '1', 0, 1, '2019-09-27', '1', '5', '', 0, NULL, 0.05, 2.5, 2.5, 0.025, 0.025, 1.05, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-08', '192.168.1.13'),
(107, '29', 'N', 1, 7, '2018-04-08 06:31:15', '17', 'B20', 'SKC20', '1994', '2', 'CA1010', '1', '1', 0, 1, '2019-10-26', '1', '0', '', 0, NULL, 0, 0, 0, 0, 0, 1, NULL, '', '2', NULL, 'Tablets', '1', 1, 26, '2018-04-08', '192.168.1.13');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `opsaleid` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `sales_type` enum('O','I','T') DEFAULT NULL,
  `return_status` enum('N','Y') NOT NULL DEFAULT 'N',
  `name` varchar(100) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(5) DEFAULT NULL,
  `physicianname` varchar(50) DEFAULT NULL,
  `mrnumber` varchar(20) NOT NULL,
  `patienttype` tinyint(3) NOT NULL,
  `patient_id` varchar(255) DEFAULT NULL,
  `insurancetype` int(11) NOT NULL,
  `emailid` varchar(100) DEFAULT NULL,
  `phonenumber` varchar(100) NOT NULL,
  `billnumber` varchar(25) DEFAULT NULL,
  `invoicedate` datetime DEFAULT NULL,
  `total` varchar(200) DEFAULT NULL,
  `tot_no_of_items` varchar(100) DEFAULT NULL,
  `tot_quantity` varchar(255) DEFAULT NULL,
  `totalgstvalue` float DEFAULT NULL,
  `totalcgstvalue` float DEFAULT NULL,
  `totalsgstvalue` float DEFAULT NULL,
  `totaldiscountvalue` float DEFAULT NULL,
  `totaltaxableamount` float NOT NULL,
  `overalldiscounttype` varchar(30) NOT NULL,
  `overalldiscountpercent` float NOT NULL,
  `overalldiscountamount` float NOT NULL,
  `overalltotal` float NOT NULL,
  `saleincrement` int(11) DEFAULT NULL,
  `paid_status` varchar(30) NOT NULL,
  `updated_by` varchar(20) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_ipaddress` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`opsaleid`, `branch_id`, `sales_type`, `return_status`, `name`, `dob`, `gender`, `physicianname`, `mrnumber`, `patienttype`, `patient_id`, `insurancetype`, `emailid`, `phonenumber`, `billnumber`, `invoicedate`, `total`, `tot_no_of_items`, `tot_quantity`, `totalgstvalue`, `totalcgstvalue`, `totalsgstvalue`, `totaldiscountvalue`, `totaltaxableamount`, `overalldiscounttype`, `overalldiscountpercent`, `overalldiscountamount`, `overalltotal`, `saleincrement`, `paid_status`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1, 1, 'O', 'Y', 'dio', NULL, NULL, NULL, '', 0, NULL, 0, NULL, '3335464644', 'P/INV/TEMP/2018/04/1', '2018-04-05 01:13:31', '500', '2', '400', 15, 7.5, 7.5, 0, 515, '', 0, 0, 515, 1, 'UnPaid', '26', '2018-04-05 13:13:31', '192.168.1.16'),
(2, 1, 'O', 'Y', 'oioiiooi', '1970-01-01', NULL, NULL, '', 0, NULL, 1, NULL, '', 'P/INV/TEMP/2018/04/2', '2018-04-05 01:13:40', '697', '6', '238', 23.52, 11.76, 11.76, 0, 23.52, '', 0, 0, 697, 2, 'UnPaid', '26', '2018-04-05 13:13:40', '192.168.1.16'),
(3, 1, 'O', 'N', 'Dolo', NULL, NULL, 'dolo', '', 2, NULL, 0, NULL, '7979797979', 'P/INV/OP/2018/04/3', '2018-04-05 03:41:10', '697', '6', '238', 23.52, 11.76, 11.76, 0, 23.52, '', 0, 0, 697, 3, 'UnPaid', '26', '2018-04-05 15:41:10', '192.168.1.16'),
(4, 1, 'O', 'N', 'dolo', NULL, NULL, 'dolo', '', 2, NULL, 0, NULL, '7887877777', 'P/INV/OP/2018/04/4', '2018-04-05 03:43:43', '985', '8', '671', 38.32, 19.16, 19.16, 0, 38.32, '', 0, 0, 985, 4, 'UnPaid', '26', '2018-04-05 15:43:43', '192.168.1.16'),
(5, 1, 'I', 'N', 'Tytt', '1970-01-01', NULL, 'Sharma', '3', 1, NULL, 1, NULL, '6456456456', 'P/INV/IP/2018/04/5', '2018-04-05 04:05:43', '1785', '9', '688', 38.32, 19.16, 19.16, 0, 38.32, '', 0, 0, 1785, 5, 'UnPaid', '26', '2018-04-05 16:05:43', '192.168.1.16'),
(6, 1, 'O', 'Y', 'RTYYTT', NULL, NULL, NULL, '', 0, NULL, 0, NULL, '5644112334', 'P/INV/TEMP/2018/04/6', '2018-04-05 04:17:09', '822', '6', '546', 37.12, 18.56, 18.56, 0, 859.12, '', 0, 0, 859.12, 6, 'UnPaid', '26', '2018-04-05 16:17:09', '192.168.1.16'),
(8, 1, 'I', 'N', 'Tytt', '1970-01-01', NULL, 'Sharma', '3', 1, NULL, 1, NULL, '6456456456', 'P/INV/IP/2018/04/7', '2018-04-06 07:19:32', '859.12', '6', '546', 37.12, 18.56, 18.56, 0, 37.12, '', 0, 0, 859.12, 7, 'UnPaid', '26', '2018-04-06 19:19:32', '192.168.1.13'),
(9, 1, 'O', 'Y', 'vasanth', NULL, NULL, NULL, '', 0, NULL, 0, NULL, '7894685654', 'P/INV/TEMP/2018/04/8', '2018-04-07 11:24:31', '267', '1', '22', 24.2, 12.1, 12.1, 0, 24.2, '', 0, 0, 267, 8, 'UnPaid', '26', '2018-04-07 11:24:31', '192.168.1.13'),
(10, 1, 'O', 'Y', 'rio', NULL, NULL, NULL, '', 0, NULL, 0, NULL, '0000000001', 'P/INV/TEMP/2018/04/9', '2018-04-07 11:27:50', '533', '1', '44', 48.4, 24.2, 24.2, 0, 48.4, '', 0, 0, 533, 9, 'UnPaid', '26', '2018-04-07 11:27:50', '192.168.1.13'),
(11, 1, 'O', 'N', 'SIVAM', NULL, NULL, 'SIVAM', '', 2, '97', 0, NULL, '1656445612', 'P/INV/OP/2018/04/10', '2018-04-07 01:20:16', '121', '1', '10', 11, 5.5, 5.5, 0, 11, '', 0, 0, 121, 10, 'UnPaid', '26', '2018-04-07 13:20:16', '192.168.1.13'),
(12, 1, 'O', 'N', 'WWW', NULL, NULL, 'Ganapathy', '', 2, '98', 0, NULL, '7895653354', 'P/INV/OP/2018/04/11', '2018-04-07 05:54:27', '137', '4', '102', 2.75, 1.375, 1.375, 0, 2.75, '', 0, 0, 137, 11, 'UnPaid', '26', '2018-04-07 17:54:27', '192.168.1.13'),
(13, 1, 'O', 'N', 'Ert', NULL, NULL, 'RTR', '', 2, '99', 0, NULL, '4656444444', 'P/INV/OP/2018/04/12', '2018-04-07 05:56:20', '53', '2', '29', 0, 0, 0, 0, 0, '', 0, 0, 53, 12, 'UnPaid', '26', '2018-04-07 17:56:20', '192.168.1.13'),
(14, 1, 'O', 'N', 'tyu', NULL, NULL, 'hjk', '', 2, '100', 0, NULL, '4644545433', 'P/INV/OP/2018/04/13', '2018-04-07 05:57:24', '54', '2', '51', 2.4, 1.2, 1.2, 0, 2.4, '', 0, 0, 54, 13, 'UnPaid', '26', '2018-04-07 17:57:24', '192.168.1.13'),
(15, 1, 'I', 'N', 'Tytt', '1970-01-01', NULL, 'Sharma', '3', 1, NULL, 1, NULL, '6456456456', 'P/INV/IP/2018/04/14', '2018-04-07 06:00:32', '59', '8', '8', 4.27, 2.135, 2.135, 0, 8, '', 0, 0, 59, 14, 'UnPaid', '26', '2018-04-07 18:00:32', '192.168.1.13'),
(16, 1, 'O', 'N', 'tyr', NULL, NULL, '', '', 2, '101', 0, NULL, '4373634948', 'P/INV/OP/2018/04/15', '2018-04-07 06:42:31', '121', '2', '12', 11, 5.5, 5.5, 0, 11, '', 0, 0, 121, 15, 'UnPaid', '26', '2018-04-07 18:42:31', '192.168.1.13'),
(17, 1, 'O', 'N', 'popopo', NULL, NULL, '', '', 2, '102', 0, NULL, '', 'P/INV/OP/2018/04/16', '2018-04-07 06:46:01', '49', '1', '4', 4.4, 2.2, 2.2, 0, 4.4, '', 0, 0, 49, 16, 'UnPaid', '26', '2018-04-07 18:46:01', '192.168.1.13'),
(18, 1, 'T', 'N', '', NULL, NULL, NULL, '', 0, NULL, 0, NULL, '', 'P/INV/TEMP/2018/04/17', '2018-04-07 07:00:36', '12', '4', '9', 0.1, 0.05, 0.05, 0, 0.1, '', 0, 0, 12, 17, 'UnPaid', '26', '2018-04-07 19:00:36', '192.168.1.61'),
(19, 1, 'O', 'N', 'tirei', NULL, NULL, '', '', 2, '103', 0, NULL, '', 'P/INV/OP/2018/04/18', '2018-04-08 01:25:06', '0', '1', '5', 0, 0, 0, 0, 0, '', 0, 0, 0, 18, 'UnPaid', '26', '2018-04-08 13:25:06', '192.168.1.13'),
(20, 1, 'O', 'N', 'tyotyj', NULL, NULL, '', '', 2, '104', 0, NULL, '', 'P/INV/OP/2018/04/19', '2018-04-08 01:27:21', '0', '1', '45', 0, 0, 0, 0, 0, '', 0, 0, 0, 19, 'UnPaid', '26', '2018-04-08 13:27:21', '192.168.1.13'),
(21, 1, 'O', 'N', 'petrr', NULL, NULL, '', '', 2, '105', 0, NULL, '', 'P/INV/OP/2018/04/20', '2018-04-08 02:24:35', '0', '1', '100', 0, 0, 0, 0, 0, '', 0, 0, 0, 20, 'UnPaid', '26', '2018-04-08 14:24:35', '192.168.1.13'),
(22, 1, 'O', 'Y', 'Rupan', NULL, NULL, NULL, '', 0, NULL, 0, NULL, '', 'P/INV/TEMP/2018/04/21', '2018-04-08 02:46:40', '8050', '3', '571', 857, 428.5, 428.5, 0, 857, '', 0, 0, 8050, 21, 'UnPaid', '26', '2018-04-08 14:46:40', '192.168.1.13'),
(23, 1, 'O', 'N', 'doolo', NULL, NULL, '', '', 2, '106', 0, NULL, '', 'P/INV/OP/2018/04/22', '2018-04-08 02:58:09', '13', '1', '1', 1.1, 0.55, 0.55, 0, 1.1, '', 0, 0, 13, 22, 'UnPaid', '26', '2018-04-08 14:58:09', '192.168.1.13'),
(24, 1, 'T', 'N', '', NULL, NULL, NULL, '', 0, NULL, 0, NULL, '', 'P/INV/TEMP/2018/04/23', '2018-04-08 03:47:36', '47', '7', '7', 4.27, 2.135, 2.135, 0, 4.27, '', 0, 0, 47, 23, 'UnPaid', '26', '2018-04-08 15:47:36', '192.168.1.13'),
(25, 1, 'T', 'N', '', NULL, NULL, NULL, '', 0, NULL, 0, NULL, '', 'P/INV/TEMP/2018/04/24', '2018-04-08 03:49:10', '25', '2', '2', 2.42, 1.21, 1.21, 0, 2.42, '', 0, 0, 25, 24, 'UnPaid', '26', '2018-04-08 15:49:10', '192.168.1.13'),
(26, 1, 'O', 'N', 'qwyt', NULL, NULL, '8767', '', 2, '107', 0, NULL, '6326688', 'P/INV/OP/2018/04/25', '2018-04-08 03:53:46', '27', '2', '2', 3, 1.5, 1.5, 1, 3.12, '', 0, 0, 27, 25, 'UnPaid', '26', '2018-04-08 15:53:46', '192.168.1.13'),
(27, 1, 'O', 'N', 'iuyg', NULL, NULL, 'jk', '', 2, '108', 0, NULL, '7678876667', 'P/INV/OP/2018/04/26', '2018-04-08 04:00:20', '25', '2', '2', 2.42, 1.21, 1.21, 0, 2.42, '', 0, 0, 25, 26, 'UnPaid', '26', '2018-04-08 16:00:20', '192.168.1.13'),
(28, 1, NULL, 'N', 'Dedere ', NULL, NULL, NULL, '123', 2, NULL, 0, NULL, '7765343434', 'P/INV/OP/2018/04/27', '2018-04-08 00:00:00', '52.00', NULL, NULL, 3, 1.5, 1.5, 1, 50, 'flat', 1, 1, 1, 27, 'UnPaid', '26', '2018-04-08 17:11:15', '192.168.1.21'),
(29, 1, 'I', 'N', 'Tytt', '1970-01-01', NULL, 'Sharma', '3', 1, NULL, 1, NULL, '6456456456', 'P/INV/IP/2018/04/28', '2018-04-08 06:31:14', '47', '7', '7', 4.27, 2.135, 2.135, 0, 4.27, '', 0, 0, 47, 28, 'Paid', '26', '2018-04-08 18:31:14', '192.168.1.13');

-- --------------------------------------------------------

--
-- Table structure for table `salesreturn`
--

CREATE TABLE `salesreturn` (
  `return_id` int(11) NOT NULL,
  `saleid` int(11) NOT NULL,
  `return_invoicenumber` varchar(50) NOT NULL,
  `patient_type` tinyint(3) NOT NULL,
  `returndate` datetime DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `mrnumber` varchar(50) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `returnincrement` int(11) NOT NULL,
  `total` float NOT NULL,
  `totalgstvalue` float NOT NULL,
  `totalcgstvalue` float NOT NULL,
  `totalsgstvalue` float NOT NULL,
  `totaldiscountvalue` float NOT NULL,
  `paid_status` varchar(50) NOT NULL,
  `is_active` tinyint(3) NOT NULL,
  `updated_by` tinyint(3) NOT NULL,
  `updated_on` date NOT NULL,
  `updated_ipaddress` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesreturn`
--

INSERT INTO `salesreturn` (`return_id`, `saleid`, `return_invoicenumber`, `patient_type`, `returndate`, `name`, `mrnumber`, `branch_id`, `returnincrement`, `total`, `totalgstvalue`, `totalcgstvalue`, `totalsgstvalue`, `totaldiscountvalue`, `paid_status`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1, 1, 'P/RETURN/OP/2018/02/1', 2, '2018-02-03 01:02:50', 'Sdfsdf sdfdf', '1234', 1, 1, 120, 0, 0, 0, 0, 'UnPaid', 1, 26, '2018-02-03', '192.168.1.84'),
(2, 2, 'P/RETURN/OP/2018/02/2', 2, '2018-02-03 06:47:50', 'Sdfsdf sdfdf', '1234', 1, 2, 120, 0, 0, 0, 0, 'UnPaid', 1, 26, '2018-02-03', '192.168.1.84');

-- --------------------------------------------------------

--
-- Table structure for table `serviceuser_login`
--

CREATE TABLE `serviceuser_login` (
  `id` int(100) NOT NULL,
  `auth_role` varchar(2000) NOT NULL,
  `assign_service` varchar(2000) NOT NULL,
  `assign_action` text NOT NULL,
  `status` enum('A','I') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `serviceuser_login`
--

INSERT INTO `serviceuser_login` (`id`, `auth_role`, `assign_service`, `assign_action`, `status`) VALUES
(22, 'branchadmin', '["14","15","16","17","18","19","25","26","27","28","29","30","31","32","33","34","35","36","37","39","40","41","42","43","44","46","47","48","52","53","56","57","58","59","60","61","62","63","64","66","67","69","70","71","72","79"]', '{"14":"v,","15":"v,","16":"e,v,","17":"v,","19":"a,e,v,","25":"a,e,v,","26":"a,e,v,","27":"a,e,v,","29":"a,e,v,","30":"a,e,v,","32":"a,e,v,","33":"a,e,v,","34":"a,e,v,","35":"a,e,v,","36":"a,e,v,da,","37":"a,e,v,","39":"a,e,v,","42":"a,e,v,","44":"a,e,v,","46":"a,e,v,","47":"a,e,v,","48":"a,e,v,","52":"a,e,v,d,","53":"a,e,v,","56":"a,e,v,","57":"a,e,v,","59":"a,e,v,","60":"a,e,v,","61":"a,e,v,","62":"a,e,v,","63":"a,e,v,","64":"a,e,v,","66":"a,e,v,","70":"a,e,v,","71":"a,e,v,","72":"a,e,v,"}', 'A'),
(43, 'Super', '["8","10","11","14","15","16","17","18","19","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","52","53","54","55","56","57","58","59","60","61","62","63","64","65","66","67","68","69","70","71","72","73","74","75","76","77","78","79","80","81","82","83","84","85","86","87","88","89","90"]', '{"8":"a,e,v,d,","10":"a,e,v,d,","11":"a,e,v,d,m,","14":"a,e,v,d,","15":"e,v,","16":"a,e,v,d,","17":"a,e,v,d,","19":"a,e,v,d,","22":"a,e,v,d,","23":"a,e,v,d,","24":"a,e,v,d,","25":"a,e,v,d,","26":"a,e,v,d,","27":"a,e,v,d,","29":"a,e,v,d,","30":"a,e,v,d,","32":"a,e,v,d,","33":"a,e,v,d,","34":"a,e,v,d,","35":"a,e,v,d,","36":"a,e,v,d,da,","37":"a,e,v,d,","38":"a,e,v,d,","39":"a,e,v,d,","42":"a,e,v,d,","43":"a,e,v,d,","44":"a,e,v,d,","45":"a,e,v,d,","46":"a,e,v,d,","47":"a,e,v,d,","48":"a,e,v,d,","49":"a,e,v,d,","52":"a,e,v,d,","53":"a,e,v,d,","54":"a,e,v,d,","55":"a,e,v,d,","56":"a,e,v,d,","57":"a,e,v,d,","59":"a,e,v,d,","60":"a,e,v,d,","61":"a,e,v,d,","62":"a,e,v,d,","63":"a,e,v,d,","64":"a,e,v,d,","65":"a,e,v,d,","66":"a,e,v,d,","67":"a,e,v,d,","68":"a,e,v,d,","70":"a,e,v,d,","71":"a,e,v,d,","72":"a,e,v,d,","75":"et,","78":"pay,refund,print,","80":"a,e,v,d,","81":"pay,refund,print,","83":"pay,refund,print,","84":"pay,refund,print,","85":"print,","90":"a,e,v,d,"}', 'A'),
(44, 'guest', '["18","19","25","27","36","37","56"]', '{"19":"a,e,v,","25":"a,e,v,","27":"a,e,v,","36":"a,e,v,da,","37":"a,e,v,","56":"a,e,v,"}', 'A'),
(45, 'warehouseaccess', '["14","15","16","17","18","19","25","26","27","28","29","30","33","34","35","36","37","38","39","40","41","42","43","44","45","49","52","53","54","55","56","57","59","60","61","62","63","64","65","66","67","68","69","70","71","72","73","74","75","76"]', '{"14":"a,e,v,","15":"a,e,v,","16":"a,e,v,","17":"a,e,v,","19":"a,e,v,","25":"a,e,v,","26":"a,e,v,","27":"a,e,v,","29":"a,e,v,","30":"a,e,v,","33":"a,e,v,","34":"a,e,v,","35":"a,e,v,d,","36":"a,e,v,et,da,","37":"a,e,v,","38":"a,e,v,","39":"a,e,v,","42":"a,e,v,","43":"a,e,v,","44":"a,e,v,","45":"a,e,v,","49":"a,e,v,","53":"a,e,v,","54":"a,e,v,","55":"a,e,v,","56":"a,e,v,","57":"a,e,v,","59":"a,e,v,","60":"a,e,v,","61":"a,e,v,","62":"a,e,v,","63":"a,e,v,","64":"a,e,v,","65":"a,e,v,","67":"a,e,v,","68":"a,e,v,","70":"a,e,v,","71":"a,e,v,","72":"a,e,v,","73":"et,","75":"et,"}', 'A'),
(46, 'Cashier', '["77","78"]', '{"78":"pay,"}', 'A'),
(48, 'tester1', '["8","10","11","14","15","16","17","18","19","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","52","53","54","55","56","57","58","59","60","61","62","63","64","65","66","67","68","69","70","71","72","73","74","75","76","77","78","79","80","81","82","83","84","85","86","87","88"]', '{"8":"a,e,v,d,","10":"a,e,v,d,","11":"a,e,v,d,m,","14":"a,e,v,d,","15":"a,e,v,d,","16":"a,e,v,d,","17":"a,e,v,d,","19":"a,e,v,d,","22":"a,e,v,d,","23":"a,e,v,d,","24":"a,e,v,d,","25":"a,e,v,d,","26":"a,e,v,d,","27":"a,e,v,d,","29":"a,e,v,d,","30":"a,e,v,d,","32":"a,e,v,d,","33":"a,e,v,d,","34":"a,e,v,d,","35":"a,e,v,d,","36":"a,e,v,d,et,da,","37":"a,e,v,d,","38":"a,e,v,d,","39":"a,e,v,d,","42":"a,e,v,d,","43":"a,e,v,d,","44":"a,e,v,d,","45":"a,e,v,d,","46":"a,e,v,d,","47":"a,e,v,d,","48":"a,e,v,d,","49":"a,e,v,d,","52":"a,e,v,d,","53":"a,e,v,d,","54":"a,e,v,d,","55":"a,e,v,d,","56":"a,e,v,d,","57":"a,e,v,d,","59":"a,e,v,d,","60":"a,e,v,d,","61":"a,e,v,d,","62":"a,e,v,d,","63":"a,e,v,d,","64":"a,e,v,d,","65":"a,e,v,d,","66":"a,e,v,d,","67":"a,e,v,d,","68":"a,e,v,d,","70":"a,e,v,d,","71":"a,e,v,d,","72":"a,e,v,d,","73":"et,","75":"et,","78":"pay,refund,print,","80":"a,e,v,d,","81":"pay,refund,print,","83":"pay,refund,print,","84":"pay,refund,print,","85":"print,"}', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `service_centre`
--

CREATE TABLE `service_centre` (
  `center_autoid` bigint(20) NOT NULL,
  `service_center_name` varchar(250) NOT NULL,
  `service_center_code` varchar(250) NOT NULL,
  `location` varchar(200) NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(100) NOT NULL,
  `pincode` int(6) NOT NULL,
  `city` varchar(250) NOT NULL,
  `mobile_number` varchar(20) DEFAULT NULL,
  `branch_logo` varchar(200) NOT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `auto_increment` bigint(20) NOT NULL,
  `service_center_status` enum('A','I','D') NOT NULL,
  `service_center_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `service_center_createdat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_centre`
--

INSERT INTO `service_centre` (`center_autoid`, `service_center_name`, `service_center_code`, `location`, `address1`, `address2`, `username`, `email`, `website`, `pincode`, `city`, `mobile_number`, `branch_logo`, `latitude`, `longitude`, `auto_increment`, `service_center_status`, `service_center_timestamp`, `service_center_createdat`) VALUES
(1, 'Super Admin', 'DMC-1', 'Bengaluru', 'Tansi Motors Private Limited', 'No.1, Sapthagiri Arcade, ITPL Main Rd, KEB Colony, Industrial Area, Hoodi,Bengaluru, Karnataka', 'BRANCH01', 'Hoodi@gmail.com', 'www.Hoodi.com', 560048, 'Bengaluru', '8679658997', 'images/tansi_logo56661.jpg', NULL, NULL, 44, 'A', '2017-07-07 09:43:29', '2017-06-09 04:36:50'),
(2, 'Ramagondanahalli', 'KA01BA11', 'Karnataka', 'Tansi Motors Private Limited', 'No. 814/714, Varthur Road, Ramagondanahalli, Opp Laughing Waters, Siddapura, Whitefield, Bengaluru, Karnataka', 'BRANCH02', 'Ramagondanahalli@gmail.com', '', 560066, 'Bengaluru', '', 'images/tansi_logo60354.jpg', NULL, NULL, 0, 'A', '2017-06-13 02:27:36', '2017-06-09 04:39:18'),
(3, 'Marathahalli', 'KA01BB11', 'Bengaluru', 'Tansi Motors Private Limited', '356, Marathahalli - Sarjapur Outer Ring Road, Marathahalli, Chandra Layout, Marathahalli, Bengaluru, Karnataka', 'BRANCH03', 'Marathahalli@gmail.com', '', 560037, 'Bengaluru', '', 'images/honda-bike-vector645381030715136.jpg', NULL, NULL, 0, 'A', '2017-06-09 22:47:02', '2017-06-09 04:41:18'),
(4, 'Seegehalli', 'KA01AA11', 'Kannamangala', 'Tansi Motors Private Limited', '24/6, Opp to Shell petrol pump, Seegehalli - Kannamangala Rd, Vastu Bhoomi, Krishnarajapura, Kannamangala, Karnataka', 'BRANCH04', 'Seegehalli@gmail.com', '', 560067, 'Kannamangala', '', 'images/honda-bike-vector64538103072200.jpg', NULL, NULL, 0, 'A', '2017-06-09 22:47:12', '2017-06-09 04:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `service_centre_admin`
--

CREATE TABLE `service_centre_admin` (
  `id` bigint(20) NOT NULL,
  `servicecenter_id` varchar(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(70) NOT NULL,
  `last_name` varchar(70) NOT NULL,
  `dob` date NOT NULL,
  `user_type` enum('A','U','P') NOT NULL COMMENT 'A=Admin, U=User, P=Player',
  `city` varchar(70) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL,
  `created_at` datetime NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rights` text NOT NULL,
  `status_flag` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive',
  `user_level` varchar(20) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `designation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_centre_admin`
--

INSERT INTO `service_centre_admin` (`id`, `servicecenter_id`, `username`, `first_name`, `last_name`, `dob`, `user_type`, `city`, `auth_key`, `password_hash`, `password_reset_token`, `status`, `created_at`, `timestamp`, `rights`, `status_flag`, `user_level`, `mobile_number`, `designation`) VALUES
(1, '1', 'admin123', '', '', '0000-00-00', 'A', '', '', '$2y$13$04h5Rr1SHyTvNkgGM0ot6OMWvkv9eHRZjVO..ZYRfZvQM3wQHa6tS', '', 0, '2017-03-01 12:59:12', '2017-07-11 05:51:51', '', 'A', '', '', ''),
(2, '2', 'BRANCH02', '', '', '0000-00-00', 'A', '', '', '$2y$13$/es93/sxs1J9ysNuqPHrpeTOWICAZXUBRnHJLnFxzgHUe69wHuY8q', '', 0, '2017-03-01 01:00:28', '2017-03-01 02:02:01', '', 'A', '', '', ''),
(3, '3', 'BRANCH03', '', '', '0000-00-00', 'A', '', '', '$2y$13$/4NVeYb2dkRgO3CP2WdclORIEs7xhwijdXKSowvwEpZi2mDqvdFfK', '', 0, '2017-03-01 01:01:05', '2017-03-01 02:02:06', '', 'A', '', '', ''),
(4, '4', 'BRANCH04', '', '', '0000-00-00', 'A', '', '', '$2y$13$B5ssS5qc7P0ke6klC0MEgerW7rvChdyqrBoQsu95S06VwJ1mYZ5nm', '', 0, '2017-03-01 01:01:36', '2017-03-01 02:02:09', '', 'A', '', '', ''),
(5, '16', 'vtest', '', '', '0000-00-00', 'A', '', '', '$2y$13$/swTZzS9DHyM.w77q0bB5OCszfH461ZX.bj7Pnwr0st9krdF6pYd2', '', 0, '2017-03-01 08:11:07', '2017-03-01 09:11:07', '', 'A', '', '', ''),
(6, '17', 'v2test', '', '', '0000-00-00', 'A', '', '', '$2y$13$q9eZSBxM0uBbGjoHQjDSU.FjpR5wMqdMe9aF4VW6YUcYCTq.uI6sa', '', 0, '2017-03-24 01:43:09', '2017-03-24 02:44:12', '', 'A', '', '', ''),
(7, '18', 'demoadmin', '', '', '0000-00-00', 'A', '', '', '$2y$13$Dj78XoRLS3FPfXNX9t62n.y3CpIyWCp28hgTgar3Vt5oymMZaHrm2', '', 0, '2017-04-12 02:50:34', '2017-04-12 03:50:34', '', 'A', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `stateid` int(11) NOT NULL,
  `state_name` varchar(500) NOT NULL,
  `isactive` tinyint(1) NOT NULL,
  `updatedby` varchar(30) NOT NULL,
  `updatedon` datetime NOT NULL,
  `updatedipaddress` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`stateid`, `state_name`, `isactive`, `updatedby`, `updatedon`, `updatedipaddress`) VALUES
(1, 'Andaman and Nicobar Islands', 0, '', '0000-00-00 00:00:00', ''),
(2, 'Andhra Pradesh', 0, '', '0000-00-00 00:00:00', ''),
(3, 'Arunachal Pradesh', 0, '', '0000-00-00 00:00:00', ''),
(4, 'Assam', 0, '', '0000-00-00 00:00:00', ''),
(5, 'Bihar', 0, '', '0000-00-00 00:00:00', ''),
(6, 'Chandigarh', 0, '', '0000-00-00 00:00:00', ''),
(7, 'Chhattisgarh', 0, '', '0000-00-00 00:00:00', ''),
(8, 'Dadra and Nagar Haveli', 0, '', '0000-00-00 00:00:00', ''),
(9, 'Daman and Diu', 0, '', '0000-00-00 00:00:00', ''),
(10, 'Delhi', 0, '', '0000-00-00 00:00:00', ''),
(11, 'Goa', 0, '', '0000-00-00 00:00:00', ''),
(12, 'Gujarat', 0, '', '0000-00-00 00:00:00', ''),
(13, 'Haryana', 0, '', '0000-00-00 00:00:00', ''),
(14, 'Himachal Pradesh', 0, '', '0000-00-00 00:00:00', ''),
(15, 'Jammu and Kashmir', 0, '', '0000-00-00 00:00:00', ''),
(16, 'Jharkhand', 0, '', '0000-00-00 00:00:00', ''),
(17, 'Karnataka', 0, '', '0000-00-00 00:00:00', ''),
(19, 'Kerala', 0, '', '0000-00-00 00:00:00', ''),
(20, 'Lakshadweep', 0, '', '0000-00-00 00:00:00', ''),
(21, 'Madhya Pradesh', 0, '', '0000-00-00 00:00:00', ''),
(22, 'Maharashtra', 0, '', '0000-00-00 00:00:00', ''),
(23, 'Manipur', 0, '', '0000-00-00 00:00:00', ''),
(24, 'Meghalaya', 0, '', '0000-00-00 00:00:00', ''),
(25, 'Mizoram', 0, '', '0000-00-00 00:00:00', ''),
(26, 'Nagaland', 0, '', '0000-00-00 00:00:00', ''),
(29, 'Odisha', 0, '', '0000-00-00 00:00:00', ''),
(31, 'Puducherry', 0, '', '0000-00-00 00:00:00', ''),
(32, 'Punjab', 0, '', '0000-00-00 00:00:00', ''),
(33, 'Rajasthan', 0, '', '0000-00-00 00:00:00', ''),
(34, 'Sikkim', 0, '', '0000-00-00 00:00:00', ''),
(35, 'Tamil Nadu', 0, '', '0000-00-00 00:00:00', ''),
(36, 'Telangana', 0, '', '0000-00-00 00:00:00', ''),
(37, 'Tripura', 0, '', '0000-00-00 00:00:00', ''),
(38, 'Uttar Pradesh', 0, '', '0000-00-00 00:00:00', ''),
(39, 'Uttarakhand', 0, '', '0000-00-00 00:00:00', ''),
(41, 'West Bengal', 0, '', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `stickynotes`
--

CREATE TABLE `stickynotes` (
  `noteid` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `notetitle` varchar(100) NOT NULL,
  `notedesc` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `colorscheme` enum('1','2','3','4','5','6') DEFAULT NULL COMMENT '1=Purple,2=Light Teal,3=Sky Blue,4=Orange,5=Light green,6=Red',
  `updated_by` tinyint(1) DEFAULT '0',
  `updated_on` datetime NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'A=Active,I=Inactive',
  `updated_ipaddress` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stickynotes`
--

INSERT INTO `stickynotes` (`noteid`, `branch_id`, `notetitle`, `notedesc`, `is_active`, `colorscheme`, `updated_by`, `updated_on`, `status`, `updated_ipaddress`) VALUES
(9, 1, 'rrrr', NULL, 0, '6', 0, '2017-09-20 20:03:57', 'A', NULL),
(11, 5, '', NULL, 0, '6', 0, '2017-10-09 19:46:34', 'A', NULL),
(12, 1, 'rrr', NULL, 0, '6', 0, '2017-10-24 11:24:57', 'A', NULL),
(13, 1, 'tttt', NULL, 0, '4', 0, '2017-10-24 11:25:02', 'A', NULL),
(14, 1, 'gggggggggggggg', NULL, 0, '2', 0, '2017-10-24 11:25:08', 'A', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sticky_notes_details`
--

CREATE TABLE `sticky_notes_details` (
  `autoid` bigint(20) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `notes_description` text,
  `notes_check` int(11) NOT NULL DEFAULT '0',
  `status` enum('A','I') NOT NULL COMMENT 'A=Active,I=Inactive',
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sticky_notes_details`
--

INSERT INTO `sticky_notes_details` (`autoid`, `branch_id`, `group_id`, `notes_description`, `notes_check`, `status`, `created_at`, `modified_at`) VALUES
(20, 1, 9, 'wer', 0, 'A', '2017-09-20 20:04:03', '2018-03-07 12:46:34'),
(21, 1, 9, 'erwer', 0, 'A', '2017-09-20 20:04:06', '2018-03-07 12:46:35'),
(22, 1, 9, 'wer', 0, 'A', '2017-09-20 20:04:07', '2018-03-07 12:46:35'),
(23, 1, 9, 'sdf', 0, 'A', '2017-10-24 11:24:44', '2018-03-07 12:46:36'),
(24, 1, 9, 'wer', 0, 'A', '2017-10-24 11:24:50', '2018-03-07 12:46:37');

-- --------------------------------------------------------

--
-- Table structure for table `stockmaster`
--

CREATE TABLE `stockmaster` (
  `stockid` bigint(20) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `productgroupid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `vendorid` int(11) NOT NULL,
  `vendor_branchid` int(11) NOT NULL,
  `compositionid` int(11) NOT NULL,
  `brandcode` varchar(100) NOT NULL,
  `stockcode` varchar(100) NOT NULL,
  `unitid` smallint(5) NOT NULL,
  `total_no_of_quantity` int(11) NOT NULL,
  `batchnumber` varchar(20) NOT NULL,
  `expiredate` date DEFAULT NULL,
  `manufacturedate` date DEFAULT NULL,
  `unitquantity` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `priceperqty` varchar(200) NOT NULL,
  `serialnumber` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(20) DEFAULT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ipaddress` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockmaster`
--

INSERT INTO `stockmaster` (`stockid`, `branch_id`, `productgroupid`, `productid`, `vendorid`, `vendor_branchid`, `compositionid`, `brandcode`, `stockcode`, `unitid`, `total_no_of_quantity`, `batchnumber`, `expiredate`, `manufacturedate`, `unitquantity`, `quantity`, `price`, `priceperqty`, `serialnumber`, `is_active`, `created_at`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1, 5, 20, 17, 17, 4, 1994, 'B20', 'SKC20', 2, 640, 't1', '2017-11-03', '2017-11-04', 1, 423, 998, '21', '1', 1, '2017-10-07 08:07:10', '20', '0000-00-00 00:00:00', '49.206.120.32'),
(2, 1, 21, 128, 17, 4, 3, 'B21', 'SKC21', 12, 300, 'BN10', '2018-09-07', '2017-09-24', 10, 30, 333.334, '1', '2', 1, '2017-10-09 09:44:50', '20', '2017-12-01 11:26:05', '49.206.120.32'),
(3, 1, 15, 233, 21, 3, 2004, 'B15', 'SKC15', 13, 5000, 'BN101', '2017-09-24', '2017-09-24', 50, 100, 4970, '1', '2', 1, '2017-10-11 09:06:00', '20', '2017-10-11 20:10:35', '49.206.120.32'),
(4, 5, 15, 233, 21, 3, 2004, 'B15', 'SKC15', 13, 250, '1234', '2018-10-27', '2017-09-24', 50, 5, 265, '1.06', '4', 1, '2017-10-11 09:32:39', '37', '2017-10-11 20:42:18', '49.206.120.32'),
(5, 6, 27, 9, 2, 2, 12, 'B27', 'SKC27', 2, 10, 'KOL001', '2017-10-26', '2017-10-01', 1, 10, 100, '10', '2', 1, '2017-10-13 01:05:28', '39', '2017-10-13 12:05:28', '106.208.20.29'),
(6, 6, 28, 10, 2, 2, 13, 'B28', 'SKC28', 2, 20, 'KOL002', '2017-10-31', '2017-10-02', 1, 20, 400, '20', '2', 1, '2017-10-13 01:05:28', '39', '2017-10-13 12:05:28', '106.208.20.29'),
(7, 1, 30, 22, 11, 5, 1603, 'B30', 'SKC30', 2, 60, 'OMM3', '2017-12-31', '2017-10-01', 1, 100, 200, '2', '2', 1, '2017-10-13 01:15:53', '26', '2017-10-16 19:29:04', '106.208.20.29'),
(8, 1, 33, 35, 11, 5, 342, 'B33', 'SKC33', 2, 50, 'WELL01', '2017-12-31', '2017-10-01', 1, 20, 100, '2', '2', 1, '2017-10-13 01:48:06', '26', '2017-10-13 12:48:06', '106.208.20.29'),
(9, 1, 37, 43, 11, 5, 342, 'B37', 'SKC37', 2, 7, 'null01', '2017-12-31', '2017-10-01', 1, 7, 6.64, '1', '2', 1, '2017-10-13 01:52:31', '26', '2017-10-13 13:00:15', '106.208.20.29'),
(10, 6, 37, 43, 11, 5, 342, 'B37', 'SKC37', 2, 3, 'null01', '2017-12-31', '2017-10-01', 1, 3, 3.36, '1.12', '10', 1, '2017-10-13 02:01:16', '39', '2017-10-13 13:01:16', '106.208.20.29'),
(11, 1, 29, 20, 11, 5, 1978, 'B29', 'SKC29', 6, 10, 'IV003', '2017-11-02', '2017-10-01', 1, 10, -30, '1', '2', 1, '2017-10-13 02:20:07', '26', '2017-10-13 13:31:35', '49.207.188.239'),
(12, 1, 36, 38, 11, 5, 119, 'B36', 'SKC36', 2, 10, 'dsf', '2017-11-02', '2017-11-02', 1, 10, 4, '0.4', '2', 1, '2017-10-13 02:24:06', '26', '2017-10-13 13:24:06', '49.207.188.239'),
(13, 1, 38, 44, 11, 5, 34, 'B38', 'SKC38', 2, 0, '1', '2017-10-31', '2017-10-10', 1, 0, -0.12, '1', '2', 1, '2017-10-13 02:35:28', '26', '2017-10-13 13:37:36', '106.208.20.29'),
(14, 6, 38, 44, 11, 5, 34, 'B38', 'SKC38', 2, 1, '1', '2017-10-31', '2017-10-10', 1, 1, 1.12, '1.12', '14', 1, '2017-10-13 02:37:49', '39', '2017-10-13 13:37:49', '106.208.20.29'),
(15, 1, 75, 17, 1, 7, 1994, 'B75', 'SKC75', 2, 539, 'TAB001', '2018-01-31', '2017-10-01', 1, 9, 110, '10', '2', 1, '2017-10-21 01:37:55', '26', '0000-00-00 00:00:00', '106.203.85.93'),
(16, 7, 75, 17, 1, 7, 1994, 'B75', 'SKC75', 2, 2, 'TAB001', '2018-01-31', '2017-10-01', 1, 2, 22.4, '11.2', '16', 1, '2017-10-21 02:19:09', '26', '2017-11-30 20:43:41', '49.206.126.68'),
(17, 1, 76, 128, 1, 7, 3, 'B76', 'SKC76', 12, 0, 'TAB003', '2018-02-28', '2017-07-01', 10, 0, -2.4, '2', '2', 1, '2017-10-21 02:23:59', '26', '2017-10-21 13:31:35', '122.171.87.93'),
(18, 7, 76, 128, 1, 7, 3, 'B76', 'SKC76', 12, 0, 'TAB003', '2018-02-28', '2017-07-01', 10, 0, 0, '2.24', '18', 1, '2017-10-21 02:35:41', '40', '2017-10-21 13:46:58', '122.171.87.93'),
(19, 1, 40, 51, 23, 6, 1000, 'B1', 'SKC1', 3, 6, 'v5', '2018-03-05', '2017-10-28', 1, -1, 722, '22.8', '2', 1, '2017-10-21 08:22:52', '26', '2017-10-24 21:04:58', '183.83.51.88'),
(20, 7, 40, 51, 23, 6, 1000, 'B1', 'SKC1', 3, 3, 'v5', '2018-03-05', '2017-10-28', 1, 3, 0, '30', '20', 1, '2017-10-21 09:22:15', '40', '2017-10-21 20:40:51', '183.83.51.88'),
(21, 3, 40, 51, 23, 6, 1000, 'B1', 'SKC1', 3, 19, 'v5', '2018-03-05', '2017-10-28', 1, 19, 210, '30', '21', 1, '2017-10-23 01:44:40', '41', '2017-10-24 21:02:52', '183.83.51.88'),
(22, 1, 43, 177, 23, 6, 279, 'B4', 'SKC4', 2, 0, 'sss3', '2018-11-04', '2017-10-30', 1, 900, -1000, '1', '2', 1, '2017-10-23 09:07:42', '26', '2017-10-23 20:12:10', '183.83.51.88'),
(23, 3, 43, 177, 23, 6, 279, 'B4', 'SKC4', 2, 1000, 'sss3', '2018-11-04', '2017-10-30', 1, 100, 2000, '2', '23', 1, '2017-10-23 09:13:19', '26', '2017-10-23 20:13:19', '183.83.51.88'),
(24, 1, 78, 10, 6, 9, 13, 'B78', 'SKC78', 2, 901, 'KA001', '2018-02-01', '2017-07-01', 1, 91, 3750, '20', '2', 1, '2017-10-24 22:14:46', '26', '2017-12-01 20:56:12', '49.206.126.68'),
(25, 8, 78, 10, 6, 9, 13, 'B78', 'SKC78', 2, 0, 'KA001', '2018-02-01', '2017-07-01', 1, 0, 0, '15', '25', 1, '2017-10-24 22:22:53', '42', '2017-10-25 09:27:31', '106.208.68.80'),
(26, 11, 78, 10, 6, 9, 13, 'B78', 'SKC78', 2, -1, 'FLOW001', '2019-02-28', '2017-06-01', 1, -1, -18.6, '15', '26', 1, '2017-11-03 01:36:40', '46', '2017-11-03 12:40:09', '106.208.21.182'),
(27, 12, 78, 10, 6, 9, 13, 'B78', 'SKC78', 2, -1, 'DU01', '2017-12-02', '2017-11-27', 1, -1, -62, '50', '27', 1, '2017-11-03 01:59:49', '48', '2017-11-03 13:34:51', '183.83.51.82'),
(28, 1, 81, 31, 20, 11, 81, 'B81', 'SKC81', 2, 93, 'ICF002', '2019-11-30', '2017-11-01', 1, 3, 220, '12', '2', 1, '2017-11-17 01:39:41', '26', '2017-12-01 16:44:22', '49.206.126.68'),
(29, 13, 81, 31, 20, 11, 81, 'B81', 'SKC81', 2, 2, 'ICF001', '2019-05-31', '2017-08-01', 1, 2, 450, '225', '29', 1, '2017-11-17 10:37:45', '50', '2017-11-17 21:37:45', '122.174.33.82'),
(30, 9, 75, 17, 1, 7, 1994, 'B75', 'SKC75', 2, 4, 'KAL001', '2018-03-31', '2017-06-15', 1, 4, 60, '15', '30', 1, '2017-11-30 09:43:51', '26', '2018-01-26 16:32:34', '49.206.126.68'),
(31, 1, 82, 2, 1, 7, 2, 'B82', 'SKC82', 1, 0, '5678', '2017-12-17', '2017-12-24', 1, 0, 0, '12', '2', 1, '2017-12-01 00:34:25', '20', '2017-12-01 11:36:22', '49.206.126.68'),
(32, 15, 82, 2, 1, 7, 2, 'B82', 'SKC82', 1, 890, '1', '2018-01-29', '2018-01-29', 1, 1005, 10602, '10596', '32', 1, '2017-12-01 00:36:51', '15', '2018-01-29 18:23:48', '192.168.1.3'),
(33, 1, 80, 30, 20, 11, 1189, 'B80', 'SKC80', 2, 90, 'XB122', '2017-12-31', '2017-12-27', 1, 0, 150, '20', '2', 1, '2017-12-01 05:27:12', '26', '2017-12-01 16:44:07', '49.206.126.68'),
(34, 15, 80, 30, 20, 11, 1189, 'B80', 'SKC80', 2, 7, 'XB122', '2017-12-31', '2017-12-27', 1, 10, 35.482, '5', '34', 1, '2017-12-01 06:02:36', '52', '2018-01-30 15:33:20', '49.206.126.68'),
(35, 15, 81, 31, 20, 11, 81, 'B81', 'SKC81', 2, 9, 'Xkl123', '2017-12-31', '2017-12-18', 1, 10, 18.11, '2', '35', 1, '2017-12-01 06:02:37', '52', '2017-12-06 16:15:07', '49.206.126.68'),
(36, 1, 77, 9, 6, 9, 12, 'B77', 'SKC77', 2, 0, 'Cm101', '2017-12-31', '2017-12-18', 1, 0, -500, '20', '2', 1, '2017-12-01 09:52:26', '26', '2017-12-01 20:56:27', '49.206.126.68'),
(37, 15, 78, 10, 6, 9, 13, 'B78', 'SKC78', 2, -54, 'XC123', '2017-12-31', '2017-12-26', 1, 10, -116.758, '2.5', '37', 1, '2017-12-01 09:57:01', '26', '2017-12-07 14:35:25', '49.206.126.68'),
(38, 15, 77, 9, 6, 9, 12, 'B77', 'SKC77', 2, 773, 'Cm101', '2017-12-31', '2017-12-18', 1, 100, 1950.35, '2.5', '38', 1, '2017-12-01 09:57:01', '26', '2018-01-25 17:26:54', '49.206.126.68'),
(39, 16, 86, 1163, 24, 12, 2438, 'B85', 'SKC85', 35, 60, 'TEST', '2017-12-31', '2017-01-01', 10, 1, -600, '10', '2', 1, '2017-12-28 07:28:17', '26', '2018-04-08 17:04:34', '192.168.1.21'),
(40, 1, 86, 1163, 24, 12, 2438, 'B85', 'SKC85', 35, 80, 'TEST', '2017-12-31', '2017-01-01', 10, 8, 800, '10', '40', 1, '2017-12-28 09:52:17', '26', '2017-12-29 10:34:27', '49.207.188.110'),
(41, 15, 40, 51, 23, 6, 1000, 'B1', 'SKC1', 3, 214, '1', '2018-01-24', '2018-01-29', 1, 215, 1604.5, '1603.5', '41', 1, '2018-01-22 08:37:36', '15', '2018-01-29 16:18:51', '192.168.1.3'),
(42, 15, 46, 274, 23, 6, 2012, 'B7', 'SKC7', 7, 50, '123', '2018-01-22', '2018-01-22', 1, 50, 5, '0.1', '42', 1, '2018-01-22 09:12:31', '15', '2018-01-22 20:12:31', '192.168.1.2'),
(43, 15, 49, 336, 23, 8, 169, 'B10', 'SKC10', 18, 1, '147', '2018-01-22', '2018-01-22', 1, 1, 7, '7.0', '43', 1, '2018-01-22 09:13:38', '15', '2018-01-22 20:13:38', '192.168.1.2'),
(44, 15, 75, 17, 1, 7, 1994, 'B75', 'SKC75', 2, 40, '12', '2018-01-30', '2018-01-30', 1, 40, 13, '5.5', '44', 1, '2018-01-24 08:53:30', '15', '0000-00-00 00:00:00', '0.0.0.0'),
(45, 15, 41, 52, 23, 6, 1025, 'B2', 'SKC2', 8, 36, '1', '2018-01-25', '2018-01-25', 1, 36, 17, '7.5', '45', 1, '2018-01-25 09:31:05', '15', '2018-01-25 20:52:53', '192.168.1.3'),
(46, 1, 83, 3, 1, 7, 3, 'B83', 'SKC83', 2, 1000, '9465645', '2018-02-20', '2018-02-27', 10, 100, 93, '0.09', '2', 1, '2018-02-07 07:27:05', '26', '2018-02-07 12:57:05', '192.168.1.84'),
(47, 1, 84, 4, 1, 1, 4, 'B84', 'SKC84', 2, 550, 'e3e3e3e3', '2018-12-31', '2018-03-26', 1, 55, 3500, '70', '2', 1, '2018-04-08 11:30:57', '26', '2018-04-08 17:00:57', '192.168.1.21'),
(48, 1, 89, 6, 1, 1, 7, 'B88', 'SKC88', 1, 1000, 'BC45', '2019-04-01', '2018-04-01', 1, 1000, 1000, '1.00', '2', 1, '2018-04-08 12:31:43', '26', '2018-04-08 18:01:43', '192.168.1.13');

-- --------------------------------------------------------

--
-- Table structure for table `stockrequest`
--

CREATE TABLE `stockrequest` (
  `requestid` int(11) NOT NULL,
  `requestincrement` int(11) NOT NULL,
  `requestcode` varchar(50) NOT NULL,
  `backorder_requestcode` varchar(50) DEFAULT NULL,
  `requesttype` enum('directstock','vendorstock') NOT NULL,
  `productgroupid` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `vendorid` varchar(100) NOT NULL,
  `productid` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `brandcode` varchar(30) NOT NULL,
  `unitid` varchar(100) NOT NULL,
  `total_no_of_quantity` varchar(100) NOT NULL,
  `requestdate` date NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ipaddress` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockrequest`
--

INSERT INTO `stockrequest` (`requestid`, `requestincrement`, `requestcode`, `backorder_requestcode`, `requesttype`, `productgroupid`, `branch_id`, `vendorid`, `productid`, `quantity`, `brandcode`, `unitid`, `total_no_of_quantity`, `requestdate`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1, 1, 'PO/V017/2017/10/1', '', 'vendorstock', 20, 1, '17', '17', '100', 'B20', '2', '100', '2017-10-07', 0, '20', '2017-10-07 19:07:10', '49.206.120.32'),
(2, 2, 'PO/V017/2017/10/2', '', 'vendorstock', 20, 1, '17', '17', '10', 'B20', '2', '10', '2017-10-09', 0, '26', '2017-10-09 19:49:01', '49.206.120.32'),
(3, 3, 'PO/V017/2017/10/3', '', 'vendorstock', 20, 1, '17', '17', '100', 'B20', '2', '100', '2017-10-09', 0, '20', '2017-10-09 19:54:49', '49.206.120.32'),
(4, 4, 'PO/V017/2017/10/4', '', 'vendorstock', 21, 1, '17', '128', '100', 'B21', '12', '1000', '2017-10-09', 0, '20', '2017-10-11 19:53:08', '49.206.120.32'),
(5, 5, 'PO/V017/2017/10/5', '', 'vendorstock', 20, 1, '17', '17', '100', 'B20', '2', '100', '2017-10-11', 0, '20', '2017-10-11 19:52:33', '49.206.120.32'),
(6, 6, 'PO/V017/2017/10/6', '', 'vendorstock', 20, 1, '17', '17', '100', 'B20', '2', '100', '2017-10-11', 0, '20', '2017-10-11 20:00:43', '49.206.120.32'),
(7, 7, 'PO/VENTE01/2017/10/7', '', 'vendorstock', 15, 1, '21', '233', '100', 'B15', '13', '5000', '2017-10-11', 0, '20', '2017-10-11 20:06:00', '49.206.120.32'),
(8, 8, 'PO/VENTE01/2017/10/8', '', 'vendorstock', 15, 1, '21', '233', '10', 'B15', '13', '500', '2017-10-11', 0, '20', '2017-10-11 20:08:31', '49.206.120.32'),
(9, 9, 'DS/V002/2017/10/9', NULL, 'directstock', 27, 6, '2', '9', '10', 'B27', '2', '10', '2017-10-13', 1, '39', '2017-10-13 12:05:28', '106.208.20.29'),
(10, 9, 'DS/V002/2017/10/9', NULL, 'directstock', 28, 6, '2', '10', '20', 'B28', '2', '20', '2017-10-13', 1, '39', '2017-10-13 12:05:28', '106.208.20.29'),
(11, 10, 'PO/V011/2017/10/10', '', 'vendorstock', 30, 1, '11', '22', '100', 'B30', '2', '100', '2017-10-13', 0, '26', '2017-10-13 12:15:54', '106.208.20.29'),
(12, 10, 'PO/V011/2017/10/10', '', 'vendorstock', 31, 1, '11', '23', '50', 'B31', '2', '50', '2017-10-13', 0, '26', '2017-10-13 12:15:54', '106.208.20.29'),
(13, 10, 'PO/V011/2017/10/10', '', 'vendorstock', 32, 1, '11', '24', '70', 'B32', '2', '70', '2017-10-13', 0, '26', '2017-10-13 12:15:54', '106.208.20.29'),
(14, 11, 'PO/V011/2017/10/11', '', 'vendorstock', 33, 1, '11', '35', '100', 'B33', '2', '100', '2017-10-13', 0, '26', '2017-10-13 12:48:06', '106.208.20.29'),
(15, 11, 'PO/V011/2017/10/11', '', 'vendorstock', 34, 1, '11', '36', '20', 'B34', '2', '20', '2017-10-13', 0, '26', '2017-10-13 12:48:06', '106.208.20.29'),
(16, 11, 'PO/V011/2017/10/11', '', 'vendorstock', 35, 1, '11', '37', '5', 'B35', '1', '5', '2017-10-13', 0, '26', '2017-10-13 12:48:06', '106.208.20.29'),
(17, 12, 'PO/V011/2017/10/12', '', 'vendorstock', 37, 1, '11', '43', '10', 'B37', '2', '10', '2017-10-13', 0, '26', '2017-10-13 12:52:31', '106.208.20.29'),
(18, 12, 'PO/V011/2017/10/12', '', 'vendorstock', 38, 1, '11', '44', '5', 'B38', '2', '5', '2017-10-13', 0, '26', '2017-10-13 12:52:31', '106.208.20.29'),
(19, 13, 'PO/V011/2017/10/13', '', 'vendorstock', 29, 1, '11', '20', '25', 'B29', '6', '25', '2017-10-13', 0, '26', '2017-10-13 13:20:07', '49.207.188.239'),
(20, 14, 'PO/V011/2017/10/14', '', 'vendorstock', 36, 1, '11', '38', '30', 'B36', '2', '30', '2017-10-13', 0, '26', '2017-10-13 13:24:06', '49.207.188.239'),
(21, 14, 'PO/V011/2017/10/14', '', 'vendorstock', 37, 1, '11', '43', '40', 'B37', '2', '40', '2017-10-13', 0, '26', '2017-10-13 13:24:06', '49.207.188.239'),
(22, 15, 'PO/V011/2017/10/15', '', 'vendorstock', 38, 1, '11', '44', '1', 'B38', '2', '1', '2017-10-13', 0, '26', '2017-10-13 13:35:28', '106.208.20.29'),
(23, 16, 'PO/V022/2017/10/16', '', 'vendorstock', 40, 1, '23', '51', '223', 'B1', '3', '223', '2017-10-20', 0, '26', '2017-10-21 20:44:15', '183.83.51.88'),
(24, 17, 'PO/V001/2017/10/17', '', 'vendorstock', 75, 1, '1', '17', '10', 'B75', '2', '10', '2017-10-21', 0, '26', '2017-10-21 12:37:55', '122.171.87.93'),
(25, 17, 'PO/V001/2017/10/17', '', 'vendorstock', 76, 1, '1', '128', '5', 'B76', '12', '50', '2017-10-21', 0, '26', '2017-10-21 13:23:59', '122.171.87.93'),
(26, 18, 'PO/V022/2017/10/18', '', 'vendorstock', 40, 1, '23', '51', '46', 'B1', '3', '46', '2017-10-21', 0, '26', '2017-10-21 19:45:37', '183.83.51.88'),
(27, 19, 'PO/V022/2017/10/19', '', 'vendorstock', 43, 1, '23', '177', '1245', 'B4', '2', '1245', '2017-10-23', 0, '26', '2017-10-23 20:07:42', '183.83.51.88'),
(28, 20, 'PO/V007/2017/10/20', '', 'vendorstock', 77, 1, '6', '9', '10', 'B77', '2', '10', '2017-10-25', 1, '26', '2017-10-25 09:13:01', '106.208.68.80'),
(29, 20, 'PO/V007/2017/10/20', '', 'vendorstock', 78, 1, '6', '10', '1', 'B78', '2', '1', '2017-10-25', 0, '26', '2017-10-25 09:14:46', '106.208.68.80'),
(30, 21, 'PO/V001/2017/10/21', '', 'vendorstock', 75, 1, '1', '17', '10', 'B75', '2', '10', '2017-10-28', 0, '26', '2017-10-28 12:57:24', '106.203.85.93'),
(31, 22, 'PO/V007/2017/11/22', '', 'vendorstock', 78, 1, '6', '10', '2', 'B78', '2', '2', '2017-11-03', 0, '26', '2017-11-03 12:30:09', '106.208.21.182'),
(32, 23, 'PO/V007/2017/11/23', '', 'vendorstock', 78, 1, '6', '10', '2', 'B78', '2', '2', '2017-11-03', 0, '26', '2017-11-03 12:51:55', '183.83.51.82'),
(33, 24, 'PO/V001/2017/11/24', '', 'vendorstock', 75, 1, '1', '17', '3', 'B75', '2', '3', '2017-11-06', 1, '26', '2017-11-06 15:56:45', '183.83.51.82'),
(34, 24, 'PO/V001/2017/11/24', '', 'vendorstock', 76, 1, '1', '128', '4', 'B76', '2', '4', '2017-11-06', 1, '26', '2017-11-06 15:56:45', '183.83.51.82'),
(35, 25, 'PO/V022/2017/11/25', '', 'vendorstock', 40, 1, '23', '51', '100', 'B1', '3', '100', '2017-11-07', 1, '26', '2017-11-07 15:44:30', '183.83.51.82'),
(36, 26, 'PO/V020/2017/11/26', '', 'vendorstock', 79, 1, '20', '29', '5', 'B79', '2', '5', '2017-11-17', 1, '26', '2017-11-17 12:36:52', '122.174.33.82'),
(38, 26, 'PO/V020/2017/11/26', '', 'vendorstock', 81, 1, '20', '31', '5', 'B81', '2', '5', '2017-11-17', 0, '26', '2017-11-17 12:39:41', '122.174.33.82'),
(39, 27, 'PO/V022/2017/11/27', '', 'vendorstock', 48, 1, '23', '329', '10', 'B9', '12', '100', '2017-11-28', 1, '26', '2017-11-28 17:56:27', '49.206.126.68'),
(40, 28, 'DS/V001/2017/12/28', NULL, 'directstock', 82, 1, '1', '2', '1000', 'B82', '1', '1000', '2017-12-01', 1, '20', '2017-12-01 11:34:25', '49.206.126.68'),
(42, 29, 'PO/V020/2017/12/29', '', 'vendorstock', 80, 1, '20', '30', '10', 'B80', '12', '100', '2017-12-01', 0, '26', '2017-12-01 16:27:12', '49.206.126.68'),
(43, 29, 'PO/V020/2017/12/29', '', 'vendorstock', 81, 1, '20', '31', '10', 'B81', '12', '100', '2017-12-01', 0, '26', '2017-12-01 16:28:16', '49.206.126.68'),
(44, 30, 'PO/V007/2017/12/30', '', 'vendorstock', 77, 1, '6', '9', '100', 'B77', '12', '1000', '2017-12-01', 0, '26', '2017-12-01 20:52:26', '49.206.126.68'),
(45, 30, 'PO/V007/2017/12/30', '', 'vendorstock', 78, 1, '6', '10', '100', 'B78', '12', '1000', '2017-12-01', 0, '26', '2017-12-01 20:54:39', '49.206.126.68'),
(46, 31, 'PO/V020/2017/12/31', '', 'vendorstock', 81, 1, '20', '31', '100', 'B81', '12', '1000', '2017-12-04', 1, '20', '2017-12-04 18:38:25', '49.206.126.68'),
(47, 32, 'PO/V022/2017/12/32', '', 'vendorstock', 40, 1, '23', '51', '100', 'B1', '3', '100', '2017-12-06', 1, '26', '2017-12-06 11:47:46', '49.207.177.156'),
(48, 33, 'PO/V022/2017/12/33', '', 'vendorstock', 40, 1, '23', '51', '122', 'B1', '3', '122', '2017-12-27', 1, '26', '2017-12-27 11:45:53', '49.207.188.110'),
(55, 35, 'DS/TEST1/2017/12/35', NULL, 'directstock', 86, 16, '24', '1163', '10', 'B85', '35', '100', '2017-12-28', 1, '26', '2017-12-28 18:28:17', '49.207.188.110'),
(57, 36, 'PO/TEST1/2017/12/36', '', 'vendorstock', 86, 1, '24', '1163', '10', 'B85', '35', '100', '2017-12-28', 0, '26', '2017-12-28 20:15:30', '49.207.188.110'),
(60, 37, 'PO/V007/2017/12/37', 'PO/V007/2017/12/30', 'vendorstock', 77, 1, '6', '9', '100', 'B77', '2', '100', '2017-12-28', 1, '26', '2017-12-28 20:25:12', '49.207.188.110'),
(61, 37, 'PO/V007/2017/12/37', 'PO/V007/2017/12/30', 'vendorstock', 78, 1, '6', '10', '10', 'B78', '2', '10', '2017-12-28', 1, '26', '2017-12-28 20:25:12', '49.207.188.110'),
(65, 38, 'PO/V001/2017/12/38', '', 'vendorstock', 76, 15, '1', '128', '2', 'B76', '2', '2', '2017-12-29', 1, '15', '2017-12-29 17:22:59', '192.168.1.2'),
(66, 38, 'PO/V001/2017/12/38', '', 'vendorstock', 83, 15, '1', '3', '2', 'B83', '2', '2', '2017-12-29', 1, '15', '2017-12-29 17:22:59', '192.168.1.2'),
(67, 39, 'PO/V001/2017/12/39', '', 'vendorstock', 76, 15, '1', '128', '2', 'B76', '2', '2', '2017-12-29', 1, '15', '2017-12-29 19:58:10', '192.168.1.2'),
(68, 39, 'PO/V001/2017/12/39', '', 'vendorstock', 82, 15, '1', '2', '3', 'B82', '21', '3', '2017-12-29', 1, '15', '2017-12-29 19:58:10', '192.168.1.2'),
(69, 40, 'PO/V001/2017/12/40', '', 'vendorstock', 75, 15, '1', '17', '200', 'B75', '12', '2000', '2017-12-29', 1, '15', '2017-12-29 20:58:03', '192.168.0.110'),
(70, 40, 'PO/V001/2017/12/40', '', 'vendorstock', 76, 15, '1', '128', '100', 'B76', '2', '100', '2017-12-29', 1, '15', '2017-12-29 20:58:03', '192.168.0.110'),
(71, 40, 'PO/V001/2017/12/40', '', 'vendorstock', 82, 15, '1', '2', '100', 'B82', '21', '100', '2017-12-29', 1, '15', '2017-12-29 20:58:03', '192.168.0.110'),
(72, 40, 'PO/V001/2017/12/40', '', 'vendorstock', 83, 15, '1', '3', '500', 'B83', '2', '500', '2017-12-29', 1, '15', '2017-12-29 20:58:03', '192.168.0.110'),
(73, 40, 'PO/V001/2017/12/40', '', 'vendorstock', 84, 15, '1', '4', '600', 'B84', '2', '600', '2017-12-29', 1, '15', '2017-12-29 20:58:03', '192.168.0.110'),
(74, 41, 'PO/V001/2018/01/41', '', 'vendorstock', 75, 15, '1', '17', '2', 'B75', '12', '20', '2018-01-02', 1, '15', '2018-01-02 17:26:34', '192.168.1.6'),
(75, 41, 'PO/V001/2018/01/41', '', 'vendorstock', 82, 15, '1', '2', '3', 'B82', '21', '3', '2018-01-02', 1, '15', '2018-01-02 17:26:34', '192.168.1.6'),
(81, 43, 'PO/V001/2018/01/43', '', 'vendorstock', 75, 15, '1', '17', '1', 'B75', '2', '1', '2018-01-02', 1, '15', '2018-01-02 18:11:17', '192.168.1.6'),
(82, 43, 'PO/V001/2018/01/43', '', 'vendorstock', 76, 15, '1', '128', '1', 'B76', '2', '1', '2018-01-02', 1, '15', '2018-01-02 18:11:17', '192.168.1.6'),
(83, 43, 'PO/V001/2018/01/43', '', 'vendorstock', 83, 15, '1', '3', '1', 'B83', '2', '1', '2018-01-02', 1, '15', '2018-01-02 18:11:17', '192.168.1.6'),
(84, 43, 'PO/V001/2018/01/43', '', 'vendorstock', 84, 15, '1', '4', '1', 'B84', '2', '1', '2018-01-02', 1, '15', '2018-01-02 18:11:17', '192.168.1.6'),
(85, 44, 'PO/V001/2018/01/44', '', 'vendorstock', 76, 15, '1', '128', '5', 'B76', '2', '5', '2018-01-04', 1, '15', '2018-01-04 17:28:33', '192.168.1.7'),
(86, 44, 'PO/V001/2018/01/44', '', 'vendorstock', 82, 15, '1', '2', '2', 'B82', '21', '2', '2018-01-04', 1, '15', '2018-01-04 17:28:33', '192.168.1.7'),
(88, 45, 'PO/V001/2018/01/45', '', 'vendorstock', 75, 15, '1', '17', '2', 'B75', '2', '2', '2018-01-04', 1, '15', '2018-01-04 17:52:50', '192.168.1.7'),
(89, 45, 'PO/V001/2018/01/45', '', 'vendorstock', 83, 15, '1', '3', '2', 'B83', '2', '2', '2018-01-04', 1, '15', '2018-01-04 17:52:50', '192.168.1.7'),
(90, 46, 'PO/V001/2018/01/46', '', 'vendorstock', 75, 15, '1', '17', '2', 'B75', '12', '20', '2018-01-04', 1, '15', '2018-01-04 19:03:03', '192.168.1.7'),
(91, 46, 'PO/V001/2018/01/46', '', 'vendorstock', 76, 15, '1', '128', '8', 'B76', '12', '80', '2018-01-04', 1, '15', '2018-01-04 19:03:03', '192.168.1.7'),
(92, 47, 'PO/V001/2018/01/47', '', 'vendorstock', 84, 15, '1', '4', '70', 'B84', '20', '70', '2018-01-04', 1, '15', '2018-01-04 19:05:50', '192.168.1.7'),
(93, 47, 'PO/V001/2018/01/47', '', 'vendorstock', 83, 15, '1', '3', '557', 'B83', '20', '557', '2018-01-04', 1, '15', '2018-01-04 19:09:20', '192.168.1.7'),
(94, 48, 'PO/V022/2018/01/48', '', 'vendorstock', 40, 15, '23', '51', '5', 'B1', '3', '5', '2018-01-04', 1, '15', '2018-01-04 19:11:52', '192.168.1.7'),
(95, 48, 'PO/V022/2018/01/48', '', 'vendorstock', 41, 15, '23', '52', '7', 'B2', '8', '7', '2018-01-04', 1, '15', '2018-01-04 19:11:52', '192.168.1.7'),
(96, 49, 'PO/V007/2018/01/49', '', 'vendorstock', 77, 15, '6', '9', '4', 'B77', '12', '40', '2018-01-04', 1, '15', '2018-01-04 19:13:40', '192.168.1.7'),
(97, 49, 'PO/V007/2018/01/49', '', 'vendorstock', 78, 15, '6', '10', '8', 'B78', '20', '8', '2018-01-04', 1, '15', '2018-01-04 19:13:40', '192.168.1.7'),
(98, 50, 'PO/V001/2018/01/50', '', 'vendorstock', 75, 15, '1', '17', '4', 'B75', '2', '4', '2018-01-05', 1, '15', '2018-01-05 17:46:55', '192.168.1.2'),
(99, 50, 'PO/V001/2018/01/50', '', 'vendorstock', 82, 15, '1', '2', '5', 'B82', '21', '5', '2018-01-05', 1, '15', '2018-01-05 17:46:55', '192.168.1.2'),
(100, 51, 'PO/V001/2018/01/51', '', 'vendorstock', 75, 15, '1', '17', '6', 'B75', '2', '6', '2018-01-05', 1, '15', '2018-01-05 18:06:56', '192.168.1.2'),
(101, 51, 'PO/V001/2018/01/51', '', 'vendorstock', 84, 15, '1', '4', '8', 'B84', '2', '8', '2018-01-05', 1, '15', '2018-01-05 18:06:56', '192.168.1.2'),
(102, 52, 'PO/V001/2018/01/52', '', 'vendorstock', 75, 15, '1', '17', '12', 'B75', '2', '12', '2018-01-12', 1, '15', '2018-01-12 12:00:30', '192.168.1.2'),
(103, 52, 'PO/V001/2018/01/52', '', 'vendorstock', 82, 15, '1', '2', '5', 'B82', '21', '5', '2018-01-12', 1, '15', '2018-01-12 12:00:30', '192.168.1.2'),
(104, 53, 'PO/V001/2018/01/53', '', 'vendorstock', 76, 15, '1', '128', '6', 'B76', '2', '6', '2018-01-17', 1, '15', '2018-01-17 12:59:07', '192.168.1.2'),
(105, 53, 'PO/V001/2018/01/53', '', 'vendorstock', 76, 15, '1', '128', '5', 'B76', '12', '50', '2018-01-17', 1, '15', '2018-01-17 12:59:07', '192.168.1.2'),
(106, 53, 'PO/V001/2018/01/53', '', 'vendorstock', 83, 15, '1', '3', '4', 'B83', '20', '4', '2018-01-17', 1, '15', '2018-01-17 12:59:07', '192.168.1.2'),
(107, 53, 'PO/V001/2018/01/53', '', 'vendorstock', 82, 15, '1', '2', '55', 'B82', '21', '55', '2018-01-17', 1, '15', '2018-01-17 12:59:07', '192.168.1.2'),
(108, 54, 'PO/V001/2018/01/54', '', 'vendorstock', 76, 15, '1', '128', '25', 'B76', '12', '250', '2018-01-17', 1, '15', '2018-01-17 12:54:01', '192.168.1.2'),
(109, 54, 'PO/V001/2018/01/54', '', 'vendorstock', 82, 15, '1', '2', '74', 'B82', '24', '74', '2018-01-17', 1, '15', '2018-01-17 12:57:04', '192.168.1.2'),
(115, 55, 'PO/V007/2018/01/55', '', 'vendorstock', 77, 15, '6', '9', '55', 'B77', '20', '55', '2018-01-17', 1, '15', '2018-01-17 13:00:21', '192.168.1.2'),
(116, 55, 'PO/V007/2018/01/55', '', 'vendorstock', 78, 15, '6', '10', '100', 'B78', '2', '100', '2018-01-17', 1, '15', '2018-01-17 13:00:07', '192.168.1.2'),
(117, 56, 'PO/V022/2018/01/56', '', 'vendorstock', 40, 15, '23', '51', '8', 'B1', '3', '8', '2018-01-22', 1, '15', '2018-01-22 19:21:55', '192.168.1.2'),
(119, 56, 'PO/V022/2018/01/56', '', 'vendorstock', 46, 15, '23', '274', '3', 'B7', '27', '3', '2018-01-22', 1, '15', '2018-01-22 19:21:55', '192.168.1.2'),
(120, 56, 'PO/V022/2018/01/56', '', 'vendorstock', 49, 15, '23', '336', '4', 'B10', '18', '4', '2018-01-22', 1, '15', '2018-01-22 19:21:55', '192.168.1.2'),
(125, 58, 'PO/V001/2018/01/58', '', 'vendorstock', 75, 15, '1', '17', '2', 'B75', '12', '20', '2018-01-27', 1, '15', '2018-01-27 12:30:26', '192.168.1.3'),
(127, 58, 'PO/V001/2018/01/58', '', 'vendorstock', 83, 15, '1', '3', '4', 'B83', '12', '40', '2018-01-27', 1, '15', '2018-01-27 12:30:26', '192.168.1.3'),
(134, 59, 'PO/V001/2018/01/59', '', 'vendorstock', 75, 15, '1', '17', '1', 'B75', '2', '1', '2018-01-27', 1, '15', '2018-01-27 12:41:54', '192.168.1.3'),
(135, 59, 'PO/V001/2018/01/59', '', 'vendorstock', 75, 15, '1', '17', '1', 'B75', '2', '1', '2018-01-27', 1, '15', '2018-01-27 14:04:26', '192.168.1.3'),
(136, 60, 'PO/V001/2018/01/60', '', 'vendorstock', 75, 15, '1', '17', '1', 'B75', '2', '1', '2018-01-27', 1, '15', '2018-01-27 14:05:03', '192.168.1.3'),
(137, 60, 'PO/V001/2018/01/60', '', 'vendorstock', 75, 15, '1', '17', '1', 'B75', '2', '1', '2018-01-27', 1, '15', '2018-01-27 14:05:54', '192.168.1.3'),
(139, 61, 'PO/V001/2018/01/61', '', 'vendorstock', 75, 15, '1', '17', '6', 'B75', '12', '60', '2018-01-30', 1, '15', '2018-01-30 15:42:13', '0.0.0.0'),
(140, 61, 'PO/V001/2018/01/61', '', 'vendorstock', 76, 15, '1', '128', '5', 'B76', '20', '5', '2018-01-30', 1, '15', '2018-01-30 15:42:13', '0.0.0.0'),
(141, 62, 'PO/V001/2018/01/62', '', 'vendorstock', 75, 15, '1', '17', '1', 'B75', '2', '1', '2018-01-29', 1, '15', '2018-01-29 09:41:24', '192.168.0.105'),
(142, 62, 'PO/V001/2018/01/62', '', 'vendorstock', 75, 15, '1', '17', '1', 'B75', '2', '1', '2018-01-29', 1, '15', '2018-01-29 16:19:12', '192.168.1.3'),
(143, 63, 'PO/V001/2018/01/63', '', 'vendorstock', 75, 15, '1', '17', '1', 'B75', '2', '1', '2018-01-29', 1, '15', '2018-01-29 16:20:58', '192.168.1.3'),
(145, 63, 'PO/V001/2018/01/63', '', 'vendorstock', 83, 15, '1', '3', '5', 'B83', '2', '5', '2018-01-29', 1, '15', '2018-01-29 16:21:40', '192.168.1.3'),
(148, 64, 'PO/V001/2018/01/64', '', 'vendorstock', 82, 15, '1', '2', '1', 'B82', '33', '1', '2018-01-29', 0, '15', '2018-01-29 18:26:05', '192.168.1.3'),
(149, 65, 'DS/V001/2018/02/65', NULL, 'directstock', 83, 1, '1', '3', '100', 'B83', '2', '1000', '2018-02-07', 1, '26', '2018-02-07 12:57:05', '192.168.1.84'),
(150, 65, 'PO/V001/2018/04/65', '', 'vendorstock', 82, 1, '1', '2', '8', 'B82', '21', '8', '2018-04-03', 1, '1', '2018-04-03 18:08:08', '192.168.1.14'),
(151, 65, 'PO/V001/2018/04/65', '', 'vendorstock', 83, 1, '1', '3', '5', 'B83', '2', '5', '2018-04-03', 1, '1', '2018-04-03 18:08:08', '192.168.1.14'),
(152, 66, 'PO/V001/2018/04/66', '', 'vendorstock', 84, 1, '1', '4', '50', 'B84', '20', '50', '2018-04-08', 0, '26', '2018-04-08 17:00:57', '192.168.1.21'),
(153, 67, 'DS/V001/2018/04/67', NULL, 'directstock', 89, 1, '1', '6', '1000', 'B88', '1', '1000', '2018-04-08', 1, '26', '2018-04-08 18:01:43', '192.168.1.13');

-- --------------------------------------------------------

--
-- Table structure for table `stockresponse`
--

CREATE TABLE `stockresponse` (
  `stockresponseid` int(11) NOT NULL,
  `stockrequestid` int(11) NOT NULL,
  `request_code` varchar(200) NOT NULL,
  `stockid` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `batchnumber` varchar(100) NOT NULL,
  `receivedquantity` int(11) NOT NULL,
  `total_no_of_quantity` int(11) NOT NULL,
  `unitid` int(11) NOT NULL,
  `receiveddate` date NOT NULL,
  `purchaseprice` float NOT NULL,
  `priceperquantity` float NOT NULL,
  `receivedfreequantity` int(11) DEFAULT NULL,
  `discountpercent` float DEFAULT NULL,
  `discountvalue` float DEFAULT NULL,
  `gstpercent` float DEFAULT NULL,
  `gstvalue` float DEFAULT NULL,
  `cgstpercent` float DEFAULT NULL,
  `cgstvalue` float DEFAULT NULL,
  `sgstpercent` float DEFAULT NULL,
  `sgstvalue` float DEFAULT NULL,
  `igstpercent` int(11) DEFAULT NULL,
  `igstvalue` float DEFAULT NULL,
  `mrpperunit` float DEFAULT NULL,
  `mrp` float DEFAULT NULL,
  `manufacturedate` date NOT NULL,
  `expiredate` date NOT NULL,
  `purchasedate` date NOT NULL,
  `sales_status` varchar(10) DEFAULT NULL,
  `updated_by` tinyint(3) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ipaddress` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockresponse`
--

INSERT INTO `stockresponse` (`stockresponseid`, `stockrequestid`, `request_code`, `stockid`, `branch_id`, `batchnumber`, `receivedquantity`, `total_no_of_quantity`, `unitid`, `receiveddate`, `purchaseprice`, `priceperquantity`, `receivedfreequantity`, `discountpercent`, `discountvalue`, `gstpercent`, `gstvalue`, `cgstpercent`, `cgstvalue`, `sgstpercent`, `sgstvalue`, `igstpercent`, `igstvalue`, `mrpperunit`, `mrp`, `manufacturedate`, `expiredate`, `purchasedate`, `sales_status`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1, 1, 'PO/V017/2017/10/1', 1, 1, '1234', 105, 407, 2, '2017-10-07', 365, 1, 5, 5, 5, 5, 5, 0, 0, 0, 0, 0, 0, 1, 100, '2017-09-24', '2019-09-27', '2017-09-24', NULL, 20, '2017-10-07 19:07:10', '49.206.120.32'),
(2, 2, 'PO/V017/2017/10/2', 1, 1, 't1', 10, 23, 2, '2017-10-09', 100, 10, 2, 0, 0, 10, 10, 0, NULL, 0, 0, 0, NULL, 11, 110, '2017-11-04', '2017-11-03', '2017-11-04', NULL, 26, '2017-10-09 19:49:01', '49.206.120.32'),
(3, 2, 'PO/V017/2017/10/2', 1, 1, 't2', 5, 0, 2, '2017-10-09', 200, 40, 3, 0, 0, 0, 0, 0, NULL, 0, 0, 0, NULL, 0, 200, '2017-11-01', '2017-10-26', '2017-10-25', NULL, 26, '2017-10-09 19:49:01', '49.206.120.32'),
(4, 1, 'TS/V017/2017/10/1', 1, 5, 't1', 10, 10, 2, '2017-10-09', 200, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-04', '2017-11-03', '2017-11-04', NULL, 37, '2017-10-09 19:40:39', '49.206.120.32'),
(5, 3, 'PO/V017/2017/10/3', 1, 1, 'BN101', 100, 77, 2, '2017-10-09', 100, 1, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 100, '2017-09-24', '2018-09-28', '2017-09-24', NULL, 20, '2017-10-09 19:54:49', '49.206.120.32'),
(6, 4, 'PO/V017/2017/10/4', 2, 1, 'BN10', 30, 300, 12, '2017-10-11', 1000, 11.1111, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, NULL, 1.11111, 333.334, '2017-09-24', '2018-09-07', '2017-09-24', NULL, 20, '2017-12-01 11:26:05', '49.206.120.32'),
(7, 5, 'PO/V017/2017/10/5', 1, 1, 'CA1010', 98, 35, 2, '2017-10-11', 98, 1, 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, NULL, 1, 100, '2017-09-24', '2019-10-26', '2017-09-24', NULL, 20, '2018-01-26 15:57:53', '49.206.120.32'),
(8, 6, 'PO/V017/2017/10/6', 1, 1, 'CA1011', 100, 409, 2, '2017-10-11', 200, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 200, '2017-09-24', '2018-09-30', '2017-09-24', NULL, 20, '2017-10-11 20:00:43', '49.206.120.32'),
(9, 7, 'PO/VENTE01/2017/10/7', 3, 1, 'BN101', 100, 5000, 13, '2017-10-11', 5000, 50, 0, 0, 0, 6, 300, 3, 150, 3, 150, 0, 0, 1.06, 5300, '2017-09-24', '2017-09-24', '2017-09-24', NULL, 20, '2017-10-11 20:06:00', '49.206.120.32'),
(10, 8, 'PO/VENTE01/2017/10/8', 3, 1, '1234', 0, 120, 13, '2017-10-11', 500, 50, 0, 0, 0, 6, 30, 3, 15, 3, 15, 0, 0, 1.06, 0, '2017-09-24', '2018-10-27', '2017-09-24', NULL, 20, '2017-10-11 20:10:35', '49.206.120.32'),
(11, 3, 'TS/VENTE01/2017/10/3', 4, 5, '1234', 5, 250, 13, '2017-10-11', 265, 1.06, 0, 0, 0, 6, 31.8, 3, 15.9, 3, 15.9, 0, 15.9, 1.06, 530, '2017-09-24', '2018-10-27', '2017-09-24', NULL, 37, '2017-10-11 20:32:39', '49.206.120.32'),
(12, 9, 'DS/V002/2017/10/9', 5, 6, 'KOL001', 10, 10, 2, '2017-10-13', 100, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 100, '2017-10-01', '2017-10-26', '2017-10-13', NULL, 39, '2017-10-13 12:05:28', '106.208.20.29'),
(13, 10, 'DS/V002/2017/10/9', 6, 6, 'KOL002', 20, 20, 2, '2017-10-13', 400, 20, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 20, 400, '2017-10-02', '2017-10-31', '2017-10-13', NULL, 39, '2017-10-13 12:05:28', '106.208.20.29'),
(14, 11, 'PO/V011/2017/10/10', 7, 1, 'OMM3', 20, 20, 2, '2017-10-13', 40, 2, 0, 0, 0, 12, 4.8, 0, 0, 0, 0, 0, 0, 2.24, 44.8, '2017-10-01', '2017-12-31', '2017-10-13', NULL, 26, '2017-10-16 19:29:04', '106.208.20.29'),
(15, 11, 'PO/V011/2017/10/10', 7, 1, 'OMM2', 30, 30, 2, '2017-10-13', 60, 2, 0, 0, 0, 12, 0.24, 0, NULL, 0, NULL, 0, 0, 4, 80, '2017-10-01', '2017-12-19', '2017-10-13', NULL, 26, '2017-10-13 12:15:53', '106.208.20.29'),
(16, 11, 'PO/V011/2017/10/10', 7, 1, 'OMM1', 50, 50, 2, '2017-10-13', 100, 2, 0, 0, 0, 12, 0.24, 0, NULL, 0, NULL, 0, 0, 4, 200, '2017-10-01', '2017-12-01', '2017-10-13', NULL, 26, '2017-10-13 12:15:54', '106.208.20.29'),
(17, 14, 'PO/V011/2017/10/11', 8, 1, 'WELL01', 50, 50, 2, '2017-10-13', 100, 2, 0, 0, 0, 12, 12, 0, 0, 0, 0, 0, 0, 4, 200, '2017-10-01', '2017-12-31', '2017-10-13', NULL, 26, '2017-10-13 12:48:06', '106.208.20.29'),
(18, 17, 'PO/V011/2017/10/12', 9, 1, 'null01', 2, 2, 2, '2017-10-13', 5, 1, 0, 0, 0, 12, 0.6, 6, 0.3, 6, 0.3, 0, 0, 1.12, 2.24, '2017-10-01', '2017-12-31', '2017-10-13', NULL, 26, '2017-10-13 13:00:15', '106.208.20.29'),
(19, 17, 'PO/V011/2017/10/12', 9, 1, 'null02', 3, 3, 2, '2017-10-13', 3, 1, 0, 0, 0, 12, 0.36, 6, 0.18, 6, 0.18, 0, 0, 1.12, 3.36, '2017-10-01', '2017-12-21', '2017-10-13', NULL, 26, '2017-10-13 12:52:31', '106.208.20.29'),
(20, 17, 'PO/V011/2017/10/12', 9, 1, 'null03', 2, 2, 2, '2017-10-13', 2, 1, 0, 0, 0, 12, 0.24, 6, 0.12, 6, 0.12, 0, 0, 1.12, 2.24, '2017-10-01', '2017-12-01', '2017-10-13', NULL, 26, '2017-10-13 12:52:31', '106.208.20.29'),
(21, 6, 'TS/V011/2017/10/5', 10, 6, 'null01', 3, 3, 2, '2017-10-13', 3.36, 1.12, 0, 0, 0, 12, 0.4032, 6, 0.2016, 6, 0.2016, 0, 0.2016, 1.12, 3.36, '2017-10-01', '2017-12-31', '2017-10-13', NULL, 39, '2017-10-13 13:01:16', '106.208.20.29'),
(22, 19, 'PO/V011/2017/10/13', 11, 1, 'IV003', 10, 10, 6, '2017-10-13', 10, 1, 0, 0, 0, 10, 1, 0, 0, 0, 0, 0, 0, 5, 50, '2017-10-01', '2017-11-02', '2017-10-30', NULL, 26, '2017-10-13 13:20:07', '49.207.188.239'),
(23, 19, 'PO/V011/2017/10/13', 11, 1, '23', 0, 0, 6, '2017-10-13', 10, 1, 0, 0, 0, 10, 1, 0, 0, 0, 0, 0, 0, 5, -39, '2017-10-01', '2017-11-02', '2017-10-30', NULL, 26, '2017-10-13 13:31:35', '49.207.188.239'),
(24, 20, 'PO/V011/2017/10/14', 12, 1, 'dsf', 10, 10, 2, '2017-10-13', 4, 0.4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.4, 4, '2017-11-02', '2017-11-02', '2017-11-01', NULL, 26, '2017-10-13 13:24:06', '49.207.188.239'),
(25, 22, 'PO/V011/2017/10/15', 13, 1, '1', 0, 0, 2, '2017-10-13', 1, 1, 0, 0, 0, 12, 0.12, 6, 0.06, 6, 0.06, 0, 0, 1.12, 0, '2017-10-10', '2017-10-31', '2017-10-13', NULL, 26, '2017-10-13 13:37:36', '106.208.20.29'),
(26, 10, 'TS/V011/2017/10/7', 14, 6, '1', 1, 1, 2, '2017-10-13', 1.12, 1.12, 0, 0, 0, 12, 0.1344, 6, 0.0672, 6, 0.0672, 0, 0.0672, 1.12, 1.12, '2017-10-10', '2017-10-31', '2017-10-13', NULL, 39, '2017-10-13 13:37:49', '106.208.20.29'),
(27, 24, 'PO/V001/2017/10/17', 15, 1, 'TAB001', 1, 310, 2, '2017-10-21', 60, 10, 0, 0, 0, 12, 7.2, 0, 0, 0, 0, 12, 7.2, 11.2, 11.2, '2017-10-01', '2018-01-31', '2017-10-21', NULL, 26, '2017-10-21 13:02:15', '122.171.87.93'),
(29, 12, 'TS/2017/10/9', 16, 7, 'TAB001', 1, 1, 2, '2017-10-21', 11.2, 11.2, 0, 0, 0, 12, 1.344, 6, 0.672, 6, 0.672, 0, 0.672, 11.2, 11.2, '2017-10-01', '2018-01-31', '2017-10-21', NULL, 26, '2017-10-21 13:19:09', '122.171.87.93'),
(30, 25, 'PO/V001/2017/10/17', 17, 1, 'TAB003', 0, 0, 12, '2017-10-21', 20, 20, 0, 0, 0, 12, 2.4, 0, 0, 0, 0, 12, 2.4, 2.24, -0.00000000000000355271, '2017-07-01', '2018-02-28', '2017-10-21', NULL, 26, '2017-10-21 13:31:35', '122.171.87.93'),
(31, 13, 'TS/2017/10/10', 18, 7, 'TAB003', 0, 0, 12, '2017-10-21', 0, 2.24, 0, 0, 0, 12, 2.688, 6, 1.344, 6, 1.344, 0, 1.344, 2.24, 22.4, '2017-07-01', '2018-02-28', '2017-10-21', NULL, 40, '2017-10-21 13:35:41', '122.171.87.93'),
(32, 26, 'PO/V022/2017/10/18', 19, 1, 'v5', 2, 2, 3, '2017-10-21', 230, 20, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 30, 90, '2017-10-28', '2018-03-05', '2017-10-24', NULL, 26, '2017-10-24 20:52:50', '183.83.51.88'),
(33, 14, 'TS/2017/10/11', 20, 7, 'v5', 3, 3, 3, '2017-10-21', 0, 30, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 30, 150, '2017-10-28', '2018-03-05', '2017-10-24', NULL, 40, '2017-10-21 20:22:15', '183.83.51.88'),
(34, 23, 'PO/V022/2017/10/16', 19, 1, 'v01', -3, -3, 3, '2017-10-27', 326, 22.8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, '2017-10-30', '2017-10-27', '2017-10-30', NULL, 26, '2017-10-23 12:44:11', '183.83.51.88'),
(36, 27, 'PO/V022/2017/10/19', 22, 1, 'sss3', 900, 0, 2, '2017-10-23', 1000, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, '2017-10-30', '2018-11-04', '2017-11-03', NULL, 26, '2017-10-23 20:12:10', '183.83.51.88'),
(37, 16, 'TS/2017/10/13', 23, 3, 'sss3', 100, 1000, 12, '2017-10-23', 2000, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 2000, '2017-10-30', '2018-11-04', '2017-11-03', NULL, 26, '2017-10-23 20:13:19', '183.83.51.88'),
(38, 17, 'TS/2017/10/14', 21, 3, 'v5', 1, 1, 3, '2017-10-24', 30, 30, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 30, 60, '2017-10-28', '2018-03-05', '2017-10-24', NULL, 41, '2017-10-24 20:54:43', '183.83.51.88'),
(39, 29, 'PO/V007/2017/10/20', 24, 1, 'KA001', 0, 0, 2, '2017-10-25', 10, 10, 0, 0, 0, 12, 1.2, 6, 0.6, 6, 0.6, 0, 0, 15, 0, '2017-07-01', '2018-02-01', '2017-10-25', NULL, 26, '2017-10-25 09:22:13', '106.208.68.80'),
(40, 19, 'TS/2017/10/15', 25, 8, 'KA001', 0, 0, 2, '2017-10-25', 0, 15, 0, 0, 0, 12, 1.8, 6, 0.9, 6, 0.9, 0, 0.9, 15, 15, '2017-07-01', '2018-02-01', '2017-10-25', NULL, 42, '2017-10-25 09:27:31', '106.208.68.80'),
(41, 30, 'PO/V001/2017/10/21', 15, 1, 'KAL001', 4, 225, 2, '2017-10-28', 100, 10, 0, 0, 0, 12, 12, 6, 6, 6, 6, 0, 0, 15, 60, '2017-06-15', '2018-03-31', '2017-10-28', NULL, 26, '2017-10-28 13:01:34', '106.203.85.93'),
(42, 31, 'PO/V007/2017/11/22', 24, 1, 'FLOW001', 1, 1, 2, '2017-11-03', 10, 5, 0, 0, 0, 12, 1.2, 0, 0, 0, 0, 12, 1.2, 15, 15, '2017-06-01', '2019-02-28', '2017-11-03', NULL, 26, '2017-11-03 12:35:10', '106.208.21.182'),
(44, 32, 'PO/V007/2017/11/23', 24, 1, 'DU01', 0, 0, 2, '2017-11-03', 10, 5, 0, 0, 0, 12, 1.2, 12, 1.2, 0, 0, 0, 0, 50, 0, '2017-11-27', '2017-12-02', '2017-11-28', NULL, 26, '2017-11-03 13:26:24', '183.83.51.82'),
(45, 22, 'TS/2017/11/18', 27, 12, 'DU01', 0, 0, 2, '2017-11-03', -6, 50, 0, 0, 0, 12, 6, 6, 3, 6, 3, 0, 3, 50, 50, '2017-11-27', '2017-12-02', '2017-11-28', NULL, 48, '2017-11-03 13:06:17', '183.83.51.82'),
(47, 38, 'PO/V020/2017/11/26', 28, 1, 'ICF002', 1, 1, 2, '2017-11-17', 175, 175, 0, 0, 0, 12, 21, 6, 10.5, 6, 10.5, 0, 0, 225, 225, '2017-11-01', '2019-11-30', '2017-11-17', NULL, 26, '2017-11-17 12:39:41', '122.174.33.82'),
(48, 38, 'PO/V020/2017/11/26', 28, 1, 'ICF001', 2, 2, 2, '2017-11-17', 700, 175, 0, 0, 0, 12, 84, 6, 42, 6, 42, 0, 0, 225, 450, '2017-08-01', '2019-05-31', '2017-11-17', NULL, 26, '2017-11-17 21:36:08', '122.174.33.82'),
(49, 24, 'TS/2017/11/20', 29, 13, 'ICF001', 2, 2, 2, '2017-11-17', 450, 225, 0, 0, 0, 12, 54, 6, 27, 6, 27, 0, 27, 225, 450, '2017-08-01', '2019-05-31', '2017-11-17', NULL, 50, '2017-11-17 21:37:45', '122.174.33.82'),
(50, 11, 'TS/2017/10/8', 16, 7, 'TAB001', 1, 1, 2, '2017-11-30', 44.8, 11.2, 0, 0, 0, 12, 5.376, 6, 2.688, 6, 2.688, 0, 2.688, 11.2, 44.8, '2017-10-01', '2018-01-31', '2017-10-21', NULL, 26, '2017-11-30 20:43:40', '49.206.126.68'),
(51, 20, 'TS/2017/10/16', 30, 9, 'KAL001', 4, 4, 2, '2017-11-30', 60, 15, 0, 0, 0, 12, 10.8, 6, 5.4, 6, 5.4, 0, 5.4, 15, 90, '2017-06-15', '2018-03-31', '2017-10-28', NULL, 26, '2018-01-26 16:32:34', '49.206.126.68'),
(52, 40, 'DS/V001/2017/12/28', 31, 1, '5678', 0, 0, 1, '2017-12-01', 12000, 12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 12, 0, '2017-12-24', '2017-12-17', '2017-12-01', NULL, 20, '2017-12-01 11:36:22', '49.206.126.68'),
(53, 27, 'TS/2017/12/23', 32, 15, '5678', 998, 883, 21, '2017-12-01', 10596, 12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 12, 12000, '2017-12-24', '2017-12-17', '2017-12-01', NULL, 52, '2018-01-29 15:47:17', '49.206.126.68'),
(54, 42, 'PO/V020/2017/12/29', 33, 1, 'XB122', 0, 90, 12, '2017-12-01', 200, 2, 0, 5, 10, 5, 10, 2.5, 5, 2.5, 5, 0, 0, 5, 450, '2017-12-27', '2017-12-31', '2017-12-01', NULL, 26, '2017-12-01 16:44:07', '49.206.126.68'),
(55, 43, 'PO/V020/2017/12/29', 28, 1, 'Xkl123', 0, 90, 12, '2017-12-01', 120, 1.2, 0, 0, 0, 6, 7.2, 3, 3.6, 3, 3.6, 0, 0, 2, 180, '2017-12-18', '2017-12-31', '2017-12-01', NULL, 26, '2017-12-01 16:44:22', '49.206.126.68'),
(56, 36, 'TS/2017/12/25', 34, 15, 'XB122', 10, 7, 20, '2017-12-01', 35.482, 5, 0, 5, 2.5, 5, 2.5, 2.5, 1.25, 2.5, 1.25, 0, 1.25, 5, 50, '2017-12-27', '2017-12-31', '2017-12-01', NULL, 52, '2018-01-30 15:33:20', '49.206.126.68'),
(57, 37, 'TS/2017/12/25', 35, 15, 'Xkl123', 10, 9, 20, '2017-12-01', 18.11, 2, 0, 0, 0, 6, 1.2, 3, 0.6, 3, 0.6, 0, 0.6, 2, 20, '2017-12-18', '2017-12-31', '2017-12-01', NULL, 52, '2017-12-06 16:15:07', '49.206.126.68'),
(58, 44, 'PO/V007/2017/12/30', 36, 1, 'Cm101', 0, 0, 12, '2017-12-01', 2000, 2, 0, 0, 0, 6, 120, 3, 60, 3, 60, 0, 0, 2.5, 0, '2017-12-18', '2017-12-31', '2017-12-01', NULL, 26, '2017-12-01 20:56:27', '49.206.126.68'),
(59, 45, 'PO/V007/2017/12/30', 24, 1, 'XC123', 90, 900, 12, '2017-12-01', 2000, 2, 0, 0, 0, 5, 100, 2.5, 50, 2.5, 50, 0, 0, 2.5, 2250, '2017-12-26', '2017-12-31', '2017-12-01', NULL, 26, '2017-12-01 20:56:12', '49.206.126.68'),
(60, 40, 'TS/2017/12/26', 37, 15, 'XC123', 10, -54, 12, '2017-12-01', -116.758, 2.5, 0, 0, 0, 5, 12.5, 2.5, 6.25, 2.5, 6.25, 0, 6.25, 2.5, 250, '2017-12-26', '2017-12-31', '2017-12-01', NULL, 26, '2017-12-07 14:35:25', '49.206.126.68'),
(61, 39, 'TS/2017/12/26', 38, 15, 'Cm101', 100, 773, 12, '2017-12-01', 1950.35, 2.5, 0, 0, 0, 6, 150, 3, 75, 3, 75, 0, 75, 2.5, 2500, '2017-12-18', '2017-12-31', '2017-12-01', NULL, 26, '2018-01-25 17:26:54', '49.206.126.68'),
(62, 55, 'DS/TEST1/2017/12/35', 39, 16, 'TEST', 1, 10, 35, '2017-12-28', 1100, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, '2017-01-01', '2017-12-31', '2017-12-28', NULL, 26, '2017-12-28 20:49:12', '49.207.188.110'),
(63, 57, 'PO/TEST1/2017/12/36', 39, 1, 'TEST1', 4, 40, 35, '2017-12-28', 100, 2, 0, 0, 0, 1, 1, 0.5, 0.5, 0.5, 0.5, 0, 0, 0, 0, '2017-12-25', '2017-12-31', '2017-12-28', NULL, 26, '2017-12-28 20:22:52', '49.207.188.110'),
(64, 41, 'TS/2017/12/27', 40, 1, 'TEST', 8, 80, 35, '2017-12-28', 900, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 900, '2017-01-01', '2017-12-31', '2017-12-28', NULL, 26, '2017-12-28 20:57:31', '49.207.188.110'),
(70, 121, 'PO/V022/2018/01/57', 41, 15, '12', 23, 22, 3, '2018-01-22', -5.5, 0.26087, 0, 1, 0.06, 0, 0, 0, 0, 0, 0, 0, 0, 11.5, 2, '2018-01-22', '2018-01-22', '2018-01-22', '1', 15, '2018-01-25 17:26:54', '192.168.1.5'),
(74, 125, 'PO/V001/2018/01/58', 44, 15, '12', 12, 120, 12, '2018-01-25', 1, 0.00833333, 0, 1, 0.01, 0, 0, 0, 0, 0, 0, 0, 0, 60, 2, '1900-02-22', '1900-02-06', '1900-03-01', '0', 15, '2018-01-25 12:37:43', '192.168.1.6'),
(75, 128, 'PO/V022/2018/01/59', 41, 15, '11', 5, 5, 3, '2018-01-25', 5, 1, NULL, 5, 0.25, 0, 0, 0, 0, 0, 0, 0, 0, 1, 5, '1900-01-17', '1900-01-05', '1900-01-05', '0', 15, '2018-01-25 17:53:43', '192.168.1.4'),
(76, 117, 'PO/V022/2018/01/56', 41, 15, '12356', 5, 7, 3, '2018-01-25', 500, 71.43, 2, 5, 25, 0, 0, 0, 0, 0, 0, 0, 0, 100, 700, '2016-02-01', '2019-07-11', '2018-01-25', '0', 15, '2018-01-25 18:39:10', '192.168.1.6'),
(79, 129, 'PO/V022/2018/01/59', 45, 15, '126', 5, 10, 8, '2018-01-25', 5, 1, 5, 2, 0.1, 0, 0, 0, 0, 0, 0, 0, 0, 0.2, 2, '2018-01-25', '2018-01-25', '2018-01-25', '1', 15, '2018-01-25 20:31:45', '192.168.1.3'),
(80, 129, 'PO/V022/2018/01/59', 45, 15, '128', 8, 16, 8, '2018-01-25', 5, 0.31, 8, 2, 0.1, 0, 0, 0, 0, 0, 0, 0, 0, 0.31, 5, '2018-01-25', '2018-01-25', '2018-01-25', '0', 15, '2018-01-25 20:50:25', '192.168.1.3'),
(81, 129, 'PO/V022/2018/01/59', 45, 15, '1', 2, 2, 8, '2018-01-25', 2, 1, NULL, 1, 0.02, 0, 0, 0, 0, 0, 0, 0, 0, 4, 8, '2018-01-25', '2018-01-25', '2018-01-25', '0', 15, '2018-01-25 20:52:53', '192.168.1.3'),
(82, 134, 'PO/V001/2018/01/59', 44, 15, '22', 12, 13, 2, '2018-01-27', 2, 0.15, 1, 1, 0.02, 0, 0, 0, 0, 0, 0, 0, 0, 0.15, 2, '2018-01-27', '2018-01-27', '2018-01-27', '0', 15, '2018-01-27 15:12:23', '192.168.1.4'),
(83, 134, 'PO/V001/2018/01/59', 44, 15, '2', 2, 50, 12, '2018-01-27', 6, 0.12, 3, 2, 0.12, 0, 0, 0, 0, 0, 0, 0, 0, 0.1, 5, '2018-01-10', '2018-01-30', '2018-01-08', '0', 15, '2018-01-27 21:14:54', '192.168.1.3'),
(84, 117, 'PO/V022/2018/01/56', 41, 15, '2', 2, 8, 3, '2018-01-29', 1, 0.12, 6, 1, 0.01, 0, 0, 0, 0, 0, 0, 0, 0, 0.12, 1, '2018-01-27', '2018-01-24', '2018-01-15', '0', 15, '2018-01-29 12:09:18', '192.168.1.3'),
(87, 148, 'PO/V001/2018/01/64', 32, 15, '1', 1, 7, 33, '2018-01-29', 6, 0.86, 6, 2, 0.12, 0, 0, 0, 0, 0, 0, 0, 0, 0.86, 6, '2018-01-29', '2018-01-29', '2018-01-29', '1', 15, '2018-01-29 18:23:48', '192.168.1.3'),
(88, 149, 'DS/V001/2018/02/65', 46, 1, '9465645', 100, 1000, 2, '2018-02-07', 93, 0.09, 0, 0, 0, 0, 3, 0, 1.5, 0, 1.5, 0, 0, 0.09, 93, '2018-02-27', '2018-02-20', '2018-02-07', NULL, 26, '2018-02-07 12:57:05', '192.168.1.84'),
(89, 152, 'PO/V001/2018/04/66', 47, 1, 'e3e3e3e3', 50, 550, 12, '2018-04-08', 3500, 7, 5, 0, 0, 18, 720, 9, 360, 9, 360, 14, 560, 8, 4000, '2018-03-26', '2018-12-31', '2018-04-08', NULL, 26, '2018-04-08 17:00:57', '192.168.1.21'),
(90, 42, 'TS/2017/12/28', 39, 16, 'TEST', 1, 10, 35, '2018-04-08', 100, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 100, '2017-01-01', '2017-12-31', '2017-12-28', NULL, 26, '2018-04-08 17:04:34', '192.168.1.21'),
(91, 153, 'DS/V001/2018/04/67', 48, 1, 'BC45', 1000, 1000, 1, '0000-00-00', 1000, 1, 0, 0, 0, 18, 270, 9, 135, 9, 135, 0, 0, 1.5, 1500, '2018-04-01', '2019-04-01', '1970-01-01', NULL, 26, '2018-04-08 18:01:44', '192.168.1.13');

-- --------------------------------------------------------

--
-- Table structure for table `stockreturn`
--

CREATE TABLE `stockreturn` (
  `stockreturnid` int(11) NOT NULL,
  `stockrequestid` int(11) NOT NULL,
  `request_code` varchar(200) NOT NULL,
  `stockid` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `batchnumber` varchar(100) NOT NULL,
  `receivedquantity` int(11) NOT NULL,
  `total_no_of_quantity` int(11) NOT NULL,
  `unitid` int(11) NOT NULL,
  `receiveddate` date NOT NULL,
  `purchaseprice` float NOT NULL,
  `priceperquantity` float NOT NULL,
  `manufacturedate` date NOT NULL,
  `expiredate` date NOT NULL,
  `purchasedate` date NOT NULL,
  `stock_status` varchar(10) DEFAULT NULL,
  `returndate` date NOT NULL,
  `returnquantity` int(11) NOT NULL,
  `updated_by` tinyint(3) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ipaddress` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockreturn`
--

INSERT INTO `stockreturn` (`stockreturnid`, `stockrequestid`, `request_code`, `stockid`, `branch_id`, `batchnumber`, `receivedquantity`, `total_no_of_quantity`, `unitid`, `receiveddate`, `purchaseprice`, `priceperquantity`, `manufacturedate`, `expiredate`, `purchasedate`, `stock_status`, `returndate`, `returnquantity`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1, 1, 'PO/V017/2017/10/1', 1, 1, '1234', 100, 100, 2, '1970-01-01', 100, 1, '2017-09-24', '2019-09-27', '2017-09-24', NULL, '2017-10-07', 20, 20, '2017-10-07 19:08:41', '49.206.120.32'),
(2, 4, 'PO/V017/2017/10/4', 2, 1, 'BN10', 100, 100, 12, '1970-01-01', 100, 1, '2017-09-24', '2018-09-07', '2017-09-24', NULL, '2017-10-09', 10, 20, '2017-10-09 20:49:32', '49.206.120.32'),
(3, 11, 'PO/V011/2017/10/10', 7, 1, 'OMM1', 50, 0, 2, '1970-01-01', 0, 2.24, '2017-10-01', '2017-12-01', '2017-10-13', NULL, '2017-10-16', 0, 26, '2017-10-16 19:29:04', '106.203.81.112'),
(4, 26, 'PO/V022/2017/10/18', 19, 1, 'v5', 5, 2, 3, '1970-01-01', 60, 30, '2017-10-28', '2018-03-05', '2017-10-24', NULL, '2017-10-21', 2, 26, '2017-10-21 20:42:40', '183.83.51.88'),
(5, 57, 'PO/TEST1/2017/12/36', 39, 1, 'TEST1', 5, 10, 35, '1970-01-01', 0, 0, '2017-12-25', '2017-12-31', '2017-12-28', NULL, '2017-12-28', 1, 26, '2017-12-28 20:22:52', '49.207.188.110');

-- --------------------------------------------------------

--
-- Table structure for table `taxgrouping`
--

CREATE TABLE `taxgrouping` (
  `taxgroupid` int(11) NOT NULL,
  `hsncode` varchar(20) NOT NULL,
  `groupid` int(11) NOT NULL,
  `groupname` varchar(100) DEFAULT NULL,
  `tax` double NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ipaddress` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxgrouping`
--

INSERT INTO `taxgrouping` (`taxgroupid`, `hsncode`, `groupid`, `groupname`, `tax`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(4, '000000000000', 1, NULL, 6, 1, '26', '2017-09-20 12:45:10', '49.206.120.32'),
(5, 'HEALTH230', 1, NULL, 6, 1, '26', '2017-09-26 19:16:05', '49.206.120.32'),
(6, 'TEST', 2, NULL, 11, 1, '26', '2017-12-29 11:54:06', '49.207.188.110');

-- --------------------------------------------------------

--
-- Table structure for table `taxmaster`
--

CREATE TABLE `taxmaster` (
  `taxid` bigint(20) NOT NULL,
  `taxvalue` double NOT NULL,
  `taxgroup` varchar(50) NOT NULL,
  `financialyear` varchar(100) NOT NULL,
  `additionaltax` double NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ipaddress` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxmaster`
--

INSERT INTO `taxmaster` (`taxid`, `taxvalue`, `taxgroup`, `financialyear`, `additionaltax`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1, 6, 'GST 6%', '2016', 2, 1, '26', '2017-09-01 16:58:56', '49.207.177.156'),
(2, 11, 'TEST1', '2017', 2, 1, '26', '2018-01-31 16:14:28', '192.168.1.84');

-- --------------------------------------------------------

--
-- Table structure for table `transferstock`
--

CREATE TABLE `transferstock` (
  `transferstockid` int(11) NOT NULL,
  `transferstock_requestcode` varchar(100) NOT NULL,
  `stockid` int(11) DEFAULT NULL,
  `productid` varchar(100) NOT NULL,
  `frombranch` int(11) NOT NULL,
  `tobranch` int(11) NOT NULL,
  `transferstockquantity` int(11) NOT NULL,
  `total_no_of_quantity` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `transferstockincrement` int(11) NOT NULL,
  `transferstockdate` date NOT NULL,
  `updated_by` tinyint(11) DEFAULT NULL,
  `updated_on` date NOT NULL,
  `updated_ipaddress` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transferstock`
--

INSERT INTO `transferstock` (`transferstockid`, `transferstock_requestcode`, `stockid`, `productid`, `frombranch`, `tobranch`, `transferstockquantity`, `total_no_of_quantity`, `unit`, `status`, `transferstockincrement`, `transferstockdate`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1, 'TS/V017/2017/10/1', NULL, '17', 5, 1, 10, 10, 2, 'Received', 1, '2017-10-09', 37, '2017-10-09', '49.206.120.32'),
(2, 'TS/V017/2017/10/2', NULL, '128', 5, 1, 10, 100, 12, 'Received', 2, '2017-10-10', 37, '2017-10-10', '49.206.120.32'),
(3, 'TS/VENTE01/2017/10/3', NULL, '233', 5, 1, 10, 500, 13, 'Returned', 3, '2017-10-11', 37, '2017-10-11', '49.206.120.32'),
(4, 'TS/V002/2017/10/4', NULL, '9', 6, 1, 10, 10, 2, 'Requested', 4, '2017-10-13', 39, '2017-10-13', '106.208.20.29'),
(5, 'TS/V002/2017/10/4', NULL, '10', 6, 1, 2, 2, 2, 'Requested', 4, '2017-10-13', 39, '2017-10-13', '106.208.20.29'),
(6, 'TS/V011/2017/10/5', NULL, '43', 6, 1, 15, 15, 2, 'Received', 5, '2017-10-13', 39, '2017-10-13', '106.208.20.29'),
(7, 'TS/V011/2017/10/6', NULL, '35', 5, 1, 10, 10, 2, 'Requested', 6, '2017-10-13', 37, '2017-10-13', '49.207.188.239'),
(8, 'TS/V011/2017/10/6', NULL, '43', 5, 1, 20, 20, 2, 'Requested', 6, '2017-10-13', 37, '2017-10-13', '49.207.188.239'),
(9, 'TS/V011/2017/10/6', NULL, '20', 5, 1, 30, 30, 6, 'Received', 6, '2017-10-13', 37, '2017-10-13', '49.207.188.239'),
(10, 'TS/V011/2017/10/7', NULL, '44', 6, 1, 1, 1, 2, 'Received', 7, '2017-10-13', 39, '2017-10-13', '106.208.20.29'),
(11, 'TS/2017/10/8', NULL, '17', 7, 1, 5, 5, 2, 'Received', 8, '2017-10-21', 40, '2017-10-21', '122.171.87.93'),
(12, 'TS/2017/10/9', NULL, '17', 7, 1, 1, 1, 2, 'Received', 9, '2017-10-21', 40, '2017-10-21', '122.171.87.93'),
(13, 'TS/2017/10/10', NULL, '128', 7, 1, 1, 10, 12, 'Returned', 10, '2017-10-21', 40, '2017-10-21', '122.171.87.93'),
(14, 'TS/2017/10/11', NULL, '51', 7, 1, 10, 10, 3, 'Returned', 11, '2017-10-21', 40, '2017-10-21', '183.83.51.88'),
(15, 'TS/2017/10/12', NULL, '51', 3, 1, 100, 100, 3, 'ReturnApproved', 12, '2017-10-23', 41, '2017-10-23', '183.83.51.88'),
(16, 'TS/2017/10/13', NULL, '177', 3, 1, 10, 100, 12, 'Received', 13, '2017-10-23', 41, '2017-10-23', '183.83.51.88'),
(17, 'TS/2017/10/14', NULL, '51', 3, 1, 21, 21, 3, 'ReturnApproved', 14, '2017-10-24', 41, '2017-10-24', '183.83.51.88'),
(18, 'TS/2017/10/15', NULL, '9', 8, 1, 3, 3, 2, 'Requested', 15, '2017-10-25', 42, '2017-10-25', '106.208.68.80'),
(19, 'TS/2017/10/15', NULL, '10', 8, 1, 1, 1, 2, 'Received', 15, '2017-10-25', 42, '2017-10-25', '106.208.68.80'),
(20, 'TS/2017/10/16', NULL, '17', 9, 1, 6, 6, 2, 'Received', 16, '2017-10-28', 44, '2017-10-28', '106.203.85.93'),
(21, 'TS/2017/11/17', NULL, '10', 11, 1, 1, 1, 2, 'Received', 17, '2017-11-03', 46, '2017-11-03', '106.208.21.182'),
(22, 'TS/2017/11/18', NULL, '10', 12, 1, 1, 1, 2, 'Received', 18, '2017-11-03', 48, '2017-11-03', '183.83.51.82'),
(23, 'TS/2017/11/19', NULL, '10', 12, 1, 1, 1, 2, 'Received', 19, '2017-11-03', 48, '2017-11-03', '183.83.51.82'),
(24, 'TS/2017/11/20', NULL, '31', 13, 1, 2, 2, 2, 'Received', 20, '2017-11-17', 50, '2017-11-17', '122.174.33.82'),
(25, 'TS/2017/11/21', NULL, '31', 14, 1, 10, 10, 2, 'Requested', 21, '2017-11-18', 51, '2017-11-18', '183.83.51.82'),
(26, 'TS/2017/12/22', NULL, '128', 15, 1, 50, 500, 12, 'Received', 22, '2017-12-01', 52, '2017-12-01', '49.206.126.68'),
(27, 'TS/2017/12/23', NULL, '2', 15, 1, 1000, 1000, 21, 'Received', 23, '2017-12-01', 52, '2017-12-01', '49.206.126.68'),
(28, 'TS/2017/12/24', NULL, '28', 1, 15, 10, 100, 12, 'Requested', 24, '2017-12-01', 26, '2017-12-01', '49.206.126.68'),
(29, 'TS/2017/12/24', NULL, '29', 1, 15, 10, 100, 12, 'Requested', 24, '2017-12-01', 26, '2017-12-01', '49.206.126.68'),
(30, 'TS/2017/12/24', NULL, '30', 1, 15, 10, 100, 12, 'Requested', 24, '2017-12-01', 26, '2017-12-01', '49.206.126.68'),
(31, 'TS/2017/12/24', NULL, '31', 1, 15, 10, 100, 12, 'Requested', 24, '2017-12-01', 26, '2017-12-01', '49.206.126.68'),
(32, 'TS/2017/12/24', NULL, '32', 1, 15, 10, 100, 12, 'Requested', 24, '2017-12-01', 26, '2017-12-01', '49.206.126.68'),
(33, 'TS/2017/12/24', NULL, '33', 1, 15, 10, 100, 12, 'Requested', 24, '2017-12-01', 26, '2017-12-01', '49.206.126.68'),
(34, 'TS/2017/12/25', NULL, '28', 15, 1, 10, 10, 2, 'Requested', 25, '2017-12-01', 52, '2017-12-01', '49.206.126.68'),
(35, 'TS/2017/12/25', NULL, '29', 15, 1, 10, 10, 2, 'Requested', 25, '2017-12-01', 52, '2017-12-01', '49.206.126.68'),
(36, 'TS/2017/12/25', NULL, '30', 15, 1, 10, 10, 20, 'Received', 25, '2017-12-01', 52, '2017-12-01', '49.206.126.68'),
(37, 'TS/2017/12/25', NULL, '31', 15, 1, 10, 10, 20, 'Received', 25, '2017-12-01', 52, '2017-12-01', '49.206.126.68'),
(38, 'TS/2017/12/25', NULL, '32', 15, 1, 10, 10, 2, 'Requested', 25, '2017-12-01', 52, '2017-12-01', '49.206.126.68'),
(39, 'TS/2017/12/26', NULL, '9', 15, 1, 10, 100, 12, 'Received', 26, '2017-12-01', 26, '2017-12-01', '49.206.126.68'),
(40, 'TS/2017/12/26', NULL, '10', 15, 1, 10, 100, 12, 'Received', 26, '2017-12-01', 26, '2017-12-01', '49.206.126.68'),
(41, 'TS/2017/12/27', NULL, '1163', 1, 16, 10, 100, 35, 'ReturnApproved', 27, '2017-12-28', 26, '2017-12-28', '49.207.188.110'),
(42, 'TS/2017/12/28', NULL, '1163', 16, 1, 1, 10, 35, 'Received', 28, '2017-12-28', 26, '2017-12-28', '49.207.188.110'),
(43, 'TS/2018/04/29', NULL, '4', 1, 2, 20, 200, 12, 'Requested', 29, '2018-04-08', 26, '2018-04-08', '192.168.1.21');

-- --------------------------------------------------------

--
-- Table structure for table `transferstockapprove`
--

CREATE TABLE `transferstockapprove` (
  `transferstockapproveid` int(11) NOT NULL,
  `transferstockid` int(11) NOT NULL,
  `stockid` int(11) NOT NULL,
  `stockresponseid` int(11) NOT NULL,
  `transferstock_requestcode` varchar(200) NOT NULL,
  `approveddate` date NOT NULL,
  `batchnumber` varchar(100) NOT NULL,
  `manufacturedate` date NOT NULL,
  `expiredate` date NOT NULL,
  `purchasedate` date NOT NULL,
  `approvedquantity` int(11) NOT NULL,
  `unitquantity` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `totalapprovedquantity` int(11) NOT NULL,
  `priceperquantity` float NOT NULL,
  `pricepertransferstock` float NOT NULL,
  `gstrate` float NOT NULL,
  `gstvalue` float NOT NULL,
  `discountrate` float NOT NULL,
  `discountvalue` float NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ipaddress` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transferstockapprove`
--

INSERT INTO `transferstockapprove` (`transferstockapproveid`, `transferstockid`, `stockid`, `stockresponseid`, `transferstock_requestcode`, `approveddate`, `batchnumber`, `manufacturedate`, `expiredate`, `purchasedate`, `approvedquantity`, `unitquantity`, `unit`, `totalapprovedquantity`, `priceperquantity`, `pricepertransferstock`, `gstrate`, `gstvalue`, `discountrate`, `discountvalue`, `status`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1, 1, 0, 0, 'TS/V017/2017/10/1', '2017-10-09', 't1', '2017-11-04', '2017-11-03', '2017-11-04', 10, 1, 2, 10, 20, 200, 0, 0, 0, 0, '', 20, '2017-10-09 19:39:30', '49.206.120.32'),
(2, 3, 3, 10, 'TS/VENTE01/2017/10/3', '2017-10-11', '1234', '2017-09-24', '2018-10-27', '2017-09-24', 10, 50, 13, 500, 1.06, 530, 6, 31.8, 0, 0, '', 20, '2017-10-11 20:10:35', '49.206.120.32'),
(3, 6, 9, 18, 'TS/V011/2017/10/5', '2017-10-13', 'null01', '2017-10-01', '2017-12-31', '2017-10-13', 3, 1, 2, 3, 1.12, 3.36, 12, 0.4032, 0, 0, '', 26, '2017-10-13 13:00:15', '106.208.20.29'),
(4, 6, 9, 19, 'TS/V011/2017/10/5', '2017-10-13', 'null02', '2017-10-01', '2017-12-21', '2017-10-13', 2, 1, 2, 2, 1.12, 2.24, 12, 0.2688, 0, 0, '', 26, '2017-10-13 13:00:15', '106.208.20.29'),
(5, 9, 11, 23, 'TS/V011/2017/10/6', '2017-10-13', '23', '2017-10-01', '2017-11-02', '2017-10-30', 10, 1, 6, 10, 5, 50, 10, 5, 0, 0, '', 26, '2017-10-13 13:31:35', '49.207.188.239'),
(6, 10, 13, 25, 'TS/V011/2017/10/7', '2017-10-13', '1', '2017-10-10', '2017-10-31', '2017-10-13', 1, 1, 2, 1, 1.12, 1.12, 12, 0.1344, 0, 0, '', 26, '2017-10-13 13:37:36', '106.208.20.29'),
(7, 11, 15, 27, 'TS/2017/10/8', '2017-10-21', 'TAB001', '2017-10-01', '2018-01-31', '2017-10-21', 4, 1, 2, 4, 11.2, 44.8, 12, 5.376, 0, 0, '', 26, '2017-10-21 12:59:54', '183.83.51.88'),
(8, 11, 15, 28, 'TS/2017/10/8', '2017-10-21', 'TAB002', '2017-10-01', '2018-01-31', '2017-10-21', 1, 1, 2, 1, 11.2, 11.2, 12, 1.344, 0, 0, '', 26, '2017-10-21 12:59:54', '183.83.51.88'),
(9, 11, 15, 27, 'TS/2017/10/8', '2017-10-21', 'TAB001', '2017-10-01', '2018-01-31', '2017-10-21', 4, 1, 2, 4, 11.2, 44.8, 12, 5.376, 0, 0, '', 26, '2017-10-21 12:59:54', '122.171.87.93'),
(10, 12, 15, 27, 'TS/2017/10/9', '2017-10-21', 'TAB001', '2017-10-01', '2018-01-31', '2017-10-21', 1, 1, 2, 1, 11.2, 11.2, 12, 1.344, 0, 0, '', 26, '2017-10-21 13:02:15', '183.83.51.88'),
(11, 13, 17, 30, 'TS/2017/10/10', '2017-10-21', 'TAB003', '2017-07-01', '2018-02-28', '2017-10-21', 1, 10, 12, 10, 2.24, 22.4, 12, 2.688, 0, 0, '', 26, '2017-10-21 13:31:35', '122.171.87.93'),
(12, 14, 19, 32, 'TS/2017/10/11', '2017-10-21', 'v5', '2017-10-28', '2018-03-05', '2017-10-24', 5, 1, 3, 5, 30, 150, 0, 0, 0, 0, '', 26, '2017-10-21 20:22:03', '183.83.51.88'),
(13, 15, 19, 34, 'TS/2017/10/12', '2017-10-23', 'v01', '2017-10-30', '2017-10-27', '2017-10-30', 20, 1, 3, 20, 10, 200, 0, 0, 0, 0, '', 26, '2017-10-23 12:44:10', '183.83.51.88'),
(14, 16, 22, 36, 'TS/2017/10/13', '2017-10-23', 'sss3', '2017-10-30', '2018-11-04', '2017-11-03', 100, 10, 12, 1000, 2, 2000, 0, 0, 0, 0, '', 26, '2017-10-23 20:12:10', '183.83.51.88'),
(15, 17, 19, 32, 'TS/2017/10/14', '2017-10-24', 'v5', '2017-10-28', '2018-03-05', '2017-10-24', 2, 1, 3, 2, 30, 60, 0, 0, 0, 0, '', 26, '2017-10-24 20:52:49', '183.83.51.88'),
(16, 19, 24, 39, 'TS/2017/10/15', '2017-10-25', 'KA001', '2017-07-01', '2018-02-01', '2017-10-25', 1, 1, 2, 1, 15, 15, 12, 1.8, 0, 0, '', 26, '2017-10-25 09:22:13', '106.208.68.80'),
(17, 20, 15, 41, 'TS/2017/10/16', '2017-10-28', 'KAL001', '2017-06-15', '2018-03-31', '2017-10-28', 6, 1, 2, 6, 15, 90, 12, 10.8, 0, 0, '', 26, '2017-10-28 13:01:34', '106.203.85.93'),
(18, 21, 24, 42, 'TS/2017/11/17', '2017-11-03', 'FLOW001', '2017-06-01', '2019-02-28', '2017-11-03', 1, 1, 2, 1, 15, 15, 12, 1.8, 0, 0, '', 26, '2017-11-03 12:35:10', '106.208.21.182'),
(19, 22, 24, 44, 'TS/2017/11/18', '2017-11-03', 'DU01', '2017-11-27', '2017-12-02', '2017-11-28', 1, 1, 2, 1, 50, 50, 12, 6, 0, 0, '', 26, '2017-11-03 12:56:16', '183.83.51.82'),
(20, 23, 24, 44, 'TS/2017/11/19', '2017-11-03', 'DU01', '2017-11-27', '2017-12-02', '2017-11-28', 1, 1, 2, 1, 50, 50, 12, 6, 0, 0, '', 26, '2017-11-03 13:26:24', '183.83.51.82'),
(21, 2, 2, 6, 'TS/V017/2017/10/2', '2017-11-17', 'BN10', '2017-09-24', '2018-09-07', '2017-09-24', 10, 10, 12, 100, 1.11111, 111.111, 0, 0, 0, 0, NULL, 26, '2017-11-17 14:04:46', '183.83.51.82'),
(22, 24, 28, 48, 'TS/2017/11/20', '2017-11-17', 'ICF001', '2017-08-01', '2019-05-31', '2017-11-17', 2, 1, 2, 2, 225, 450, 12, 54, 0, 0, NULL, 26, '2017-11-17 21:36:08', '122.174.33.82'),
(23, 26, 2, 6, 'TS/2017/12/22', '2017-12-01', 'BN10', '2017-09-24', '2018-09-07', '2017-09-24', 50, 10, 12, 500, 1.11111, 555.555, 0, 0, 0, 0, NULL, 20, '2017-12-01 11:26:05', '49.206.126.68'),
(24, 27, 31, 52, 'TS/2017/12/23', '2017-12-01', '5678', '2017-12-24', '2017-12-17', '2017-12-01', 1000, 1, 21, 1000, 12, 12000, 0, 0, 0, 0, NULL, 20, '2017-12-01 11:36:22', '49.206.126.68'),
(25, 36, 33, 54, 'TS/2017/12/25', '2017-12-01', 'XB122', '2017-12-27', '2017-12-31', '2017-12-01', 10, 1, 20, 10, 5, 50, 5, 2.5, 5, 2.5, NULL, 26, '2017-12-01 16:44:07', '49.206.126.68'),
(26, 37, 28, 55, 'TS/2017/12/25', '2017-12-01', 'Xkl123', '2017-12-18', '2017-12-31', '2017-12-01', 10, 1, 20, 10, 2, 20, 6, 1.2, 0, 0, NULL, 26, '2017-12-01 16:44:22', '49.206.126.68'),
(27, 40, 24, 59, 'TS/2017/12/26', '2017-12-01', 'XC123', '2017-12-26', '2017-12-31', '2017-12-01', 10, 10, 12, 100, 2.5, 250, 5, 12.5, 0, 0, NULL, 26, '2017-12-01 20:56:12', '49.206.126.68'),
(28, 39, 36, 58, 'TS/2017/12/26', '2017-12-01', 'Cm101', '2017-12-18', '2017-12-31', '2017-12-01', 100, 10, 12, 1000, 2.5, 2500, 6, 150, 0, 0, NULL, 26, '2017-12-01 20:56:27', '49.206.126.68'),
(29, 41, 39, 62, 'TS/2017/12/27', '2017-12-28', 'TEST', '2017-01-01', '2017-12-31', '2017-12-28', 10, 10, 35, 100, 10, 1000, 0, 0, 0, 0, NULL, 26, '2017-12-28 20:49:12', '49.207.188.110'),
(30, 42, 40, 64, 'TS/2017/12/28', '2017-12-28', 'TEST', '2017-01-01', '2017-12-31', '2017-12-28', 1, 10, 35, 10, 10, 100, 0, 0, 0, 0, NULL, 26, '2017-12-28 20:57:31', '49.207.188.110');

-- --------------------------------------------------------

--
-- Table structure for table `transferstockreceive`
--

CREATE TABLE `transferstockreceive` (
  `transferstockreceiveid` int(11) NOT NULL,
  `transferstockid` int(11) NOT NULL,
  `transferstock_requestcode` varchar(200) NOT NULL,
  `transferstockapproveid` int(11) NOT NULL,
  `batchnumber` varchar(100) NOT NULL,
  `receivedquantity` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `pricepertransferstock` float NOT NULL,
  `receiveddate` date NOT NULL,
  `priceperquantity` float NOT NULL,
  `total_no_of_quantity` int(11) NOT NULL,
  `manufacturedate` date NOT NULL,
  `expiredate` date NOT NULL,
  `purchasedate` date NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ipaddress` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transferstockreceive`
--

INSERT INTO `transferstockreceive` (`transferstockreceiveid`, `transferstockid`, `transferstock_requestcode`, `transferstockapproveid`, `batchnumber`, `receivedquantity`, `unit`, `pricepertransferstock`, `receiveddate`, `priceperquantity`, `total_no_of_quantity`, `manufacturedate`, `expiredate`, `purchasedate`, `status`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1, 1, 'TS/V017/2017/10/1', 1, 't1', 10, 2, 200, '2017-10-21', 20, 10, '2017-11-04', '2017-11-03', '2017-11-04', '', 26, '2017-10-21 20:19:41', '183.83.51.88'),
(2, 3, 'TS/VENTE01/2017/10/3', 2, '1234', 10, 13, 530, '2017-10-11', 1.06, 500, '2017-09-24', '2018-10-27', '2017-09-24', '', 37, '2017-10-11 20:40:16', '49.206.120.32'),
(3, 6, 'TS/V011/2017/10/5', 3, 'null01', 3, 2, 3.36, '2017-10-13', 1.12, 3, '2017-10-01', '2017-12-31', '2017-10-13', '', 39, '2017-10-13 13:01:16', '106.208.20.29'),
(4, 6, 'TS/V011/2017/10/5', 4, 'null02', 2, 2, 2.24, '2017-10-13', 1.12, 2, '2017-10-01', '2017-12-21', '2017-10-13', '', 39, '2017-10-13 13:01:16', '106.208.20.29'),
(5, 10, 'TS/V011/2017/10/7', 6, '1', 1, 2, 1.12, '2017-10-13', 1.12, 1, '2017-10-10', '2017-10-31', '2017-10-13', '', 39, '2017-10-13 13:37:49', '106.208.20.29'),
(6, 12, 'TS/2017/10/9', 10, 'TAB001', 1, 2, 11.2, '2017-10-21', 11.2, 1, '2017-10-01', '2018-01-31', '2017-10-21', '', 26, '2017-10-21 13:19:09', '122.171.87.93'),
(7, 13, 'TS/2017/10/10', 11, 'TAB003', 1, 12, 22.4, '2017-10-21', 2.24, 10, '2017-07-01', '2018-02-28', '2017-10-21', '', 40, '2017-10-21 13:35:41', '122.171.87.93'),
(8, 14, 'TS/2017/10/11', 12, 'v5', 5, 3, 150, '2017-10-21', 30, 5, '2017-10-28', '2018-03-05', '2017-10-24', '', 40, '2017-10-21 20:22:20', '183.83.51.88'),
(9, 15, 'TS/2017/10/12', 13, 'v01', 20, 3, 200, '2017-10-23', 10, 20, '2017-10-30', '2017-10-27', '2017-10-30', '', 41, '2017-10-23 12:44:40', '183.83.51.88'),
(10, 16, 'TS/2017/10/13', 14, 'sss3', 100, 12, 2000, '2017-10-23', 2, 1000, '2017-10-30', '2018-11-04', '2017-11-03', '', 26, '2017-10-23 20:13:19', '183.83.51.88'),
(11, 17, 'TS/2017/10/14', 15, 'v5', 2, 3, 60, '2017-10-24', 30, 2, '2017-10-28', '2018-03-05', '2017-10-24', '', 41, '2017-10-24 20:54:43', '183.83.51.88'),
(12, 19, 'TS/2017/10/15', 16, 'KA001', 1, 2, 15, '2017-10-25', 15, 1, '2017-07-01', '2018-02-01', '2017-10-25', '', 42, '2017-10-25 09:22:53', '106.208.68.80'),
(13, 21, 'TS/2017/11/17', 18, 'FLOW001', 1, 2, 15, '2017-11-03', 15, 1, '2017-06-01', '2019-02-28', '2017-11-03', '', 46, '2017-11-03 12:36:40', '106.208.21.182'),
(14, 22, 'TS/2017/11/18', 19, 'DU01', 1, 2, 50, '2017-11-03', 50, 1, '2017-11-27', '2017-12-02', '2017-11-28', '', 48, '2017-11-03 12:59:49', '183.83.51.82'),
(15, 23, 'TS/2017/11/19', 20, 'DU01', 1, 2, 50, '2017-11-03', 50, 1, '2017-11-27', '2017-12-02', '2017-11-28', '', 48, '2017-11-03 13:32:50', '183.83.51.82'),
(16, 24, 'TS/2017/11/20', 22, 'ICF001', 2, 2, 450, '2017-11-17', 225, 2, '2017-08-01', '2019-05-31', '2017-11-17', 'Received', 50, '2017-11-17 21:37:45', '122.174.33.82'),
(17, 2, 'TS/V017/2017/10/2', 21, 'BN10', 10, 12, 111.111, '2017-11-30', 1.11111, 100, '2017-09-24', '2018-09-07', '2017-09-24', 'Received', 26, '2017-11-30 20:43:16', '49.206.126.68'),
(18, 11, 'TS/2017/10/8', 7, 'TAB001', 4, 2, 44.8, '2017-11-30', 11.2, 4, '2017-10-01', '2018-01-31', '2017-10-21', 'Received', 26, '2017-11-30 20:43:40', '49.206.126.68'),
(19, 11, 'TS/2017/10/8', 8, 'TAB002', 1, 2, 11.2, '2017-11-30', 11.2, 1, '2017-10-01', '2018-01-31', '2017-10-21', 'Received', 26, '2017-11-30 20:43:40', '49.206.126.68'),
(20, 11, 'TS/2017/10/8', 9, 'TAB001', 4, 2, 44.8, '2017-11-30', 11.2, 4, '2017-10-01', '2018-01-31', '2017-10-21', 'Received', 26, '2017-11-30 20:43:41', '49.206.126.68'),
(21, 20, 'TS/2017/10/16', 17, 'KAL001', 6, 2, 90, '2017-11-30', 15, 6, '2017-06-15', '2018-03-31', '2017-10-28', 'Received', 26, '2017-11-30 20:43:51', '49.206.126.68'),
(22, 9, 'TS/V011/2017/10/6', 5, '23', 10, 6, 50, '2017-11-30', 5, 10, '2017-10-01', '2017-11-02', '2017-10-30', 'Received', 26, '2017-11-30 20:44:04', '49.206.126.68'),
(23, 26, 'TS/2017/12/22', 23, 'BN10', 50, 12, 555.555, '2017-12-01', 1.11111, 500, '2017-09-24', '2018-09-07', '2017-09-24', 'Received', 52, '2017-12-01 11:29:29', '49.206.126.68'),
(24, 27, 'TS/2017/12/23', 24, '5678', 1000, 21, 12000, '2017-12-01', 12, 1000, '2017-12-24', '2017-12-17', '2017-12-01', 'Received', 52, '2017-12-01 11:36:51', '49.206.126.68'),
(25, 36, 'TS/2017/12/25', 25, 'XB122', 10, 20, 50, '2017-12-01', 5, 10, '2017-12-27', '2017-12-31', '2017-12-01', 'Received', 52, '2017-12-01 17:02:36', '49.206.126.68'),
(26, 37, 'TS/2017/12/25', 26, 'Xkl123', 10, 20, 20, '2017-12-01', 2, 10, '2017-12-18', '2017-12-31', '2017-12-01', 'Received', 52, '2017-12-01 17:02:36', '49.206.126.68'),
(27, 40, 'TS/2017/12/26', 27, 'XC123', 10, 12, 250, '2017-12-01', 2.5, 100, '2017-12-26', '2017-12-31', '2017-12-01', 'Received', 26, '2017-12-01 20:57:01', '49.206.126.68'),
(28, 39, 'TS/2017/12/26', 28, 'Cm101', 100, 12, 2500, '2017-12-01', 2.5, 1000, '2017-12-18', '2017-12-31', '2017-12-01', 'Received', 26, '2017-12-01 20:57:01', '49.206.126.68'),
(29, 41, 'TS/2017/12/27', 29, 'TEST', 10, 35, 1000, '2017-12-28', 10, 100, '2017-01-01', '2017-12-31', '2017-12-28', 'Received', 26, '2017-12-28 20:52:17', '49.207.188.110'),
(30, 42, 'TS/2017/12/28', 30, 'TEST', 1, 35, 100, '2018-04-08', 10, 10, '2017-01-01', '2017-12-31', '2017-12-28', 'Received', 26, '2018-04-08 17:04:33', '192.168.1.21');

-- --------------------------------------------------------

--
-- Table structure for table `transferstockreturn`
--

CREATE TABLE `transferstockreturn` (
  `transferstockreturnid` int(11) NOT NULL,
  `transferstockid` int(11) NOT NULL,
  `stockid_tobranch` int(11) NOT NULL,
  `transferstock_requestcode` varchar(200) NOT NULL,
  `transferstockreceiveid` int(11) NOT NULL,
  `batchnumber` varchar(100) NOT NULL,
  `returnquantity` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `pricepertransferstock` float NOT NULL,
  `returndate` date NOT NULL,
  `priceperquantity` float NOT NULL,
  `total_no_of_quantity` int(11) NOT NULL,
  `manufacturedate` date NOT NULL,
  `expiredate` date NOT NULL,
  `purchasedate` date NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ipaddress` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transferstockreturn`
--

INSERT INTO `transferstockreturn` (`transferstockreturnid`, `transferstockid`, `stockid_tobranch`, `transferstock_requestcode`, `transferstockreceiveid`, `batchnumber`, `returnquantity`, `unit`, `pricepertransferstock`, `returndate`, `priceperquantity`, `total_no_of_quantity`, `manufacturedate`, `expiredate`, `purchasedate`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1, 3, 1, 'TS/VENTE01/2017/10/3', 2, '1234', 5, 13, 265, '2017-10-11', 1.06, 250, '2017-09-24', '2018-10-27', '2017-09-24', 37, '2017-10-11 20:42:18', '49.206.120.32'),
(2, 13, 1, 'TS/2017/10/10', 7, 'TAB003', 1, 12, 22.4, '2017-10-21', 2.24, 10, '2017-07-01', '2018-02-28', '2017-10-21', 40, '2017-10-21 13:46:57', '122.171.87.93'),
(3, 14, 1, 'TS/2017/10/11', 8, 'v5', 5, 3, 120, '2017-10-21', 30, 5, '2017-10-28', '2018-03-05', '2017-10-24', 40, '2017-10-21 20:40:51', '183.83.51.88'),
(4, 15, 1, 'TS/2017/10/12', 9, 'v01', 2, 3, 20, '2017-10-24', 10, 2, '2017-10-30', '2017-10-27', '2017-10-30', 41, '2017-10-24 21:02:52', '183.83.51.88'),
(5, 17, 1, 'TS/2017/10/14', 11, 'v5', 1, 3, 30, '2017-10-24', 30, 1, '2017-10-28', '2018-03-05', '2017-10-24', 41, '2017-10-24 20:58:31', '183.83.51.88'),
(6, 41, 16, 'TS/2017/12/27', 29, 'TEST', 1, 35, 100, '2017-12-29', 10, 10, '2017-01-01', '2017-12-31', '2017-12-28', 26, '2017-12-29 10:34:27', '49.207.188.110');

-- --------------------------------------------------------

--
-- Table structure for table `transferstockreturnapprove`
--

CREATE TABLE `transferstockreturnapprove` (
  `transferstockreturnapproveid` int(11) NOT NULL,
  `transferstockid` int(11) NOT NULL,
  `stockid_frombranch` int(11) NOT NULL,
  `transferstock_requestcode` varchar(200) NOT NULL,
  `transferstockreturnid` int(11) NOT NULL,
  `batchnumber` varchar(100) NOT NULL,
  `returnquantity` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `pricepertransferstock` float NOT NULL,
  `returndate` date NOT NULL,
  `priceperquantity` float NOT NULL,
  `total_no_of_quantity` int(11) NOT NULL,
  `manufacturedate` date NOT NULL,
  `expiredate` date NOT NULL,
  `purchasedate` date NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ipaddress` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transferstockreturnapprove`
--

INSERT INTO `transferstockreturnapprove` (`transferstockreturnapproveid`, `transferstockid`, `stockid_frombranch`, `transferstock_requestcode`, `transferstockreturnid`, `batchnumber`, `returnquantity`, `unit`, `pricepertransferstock`, `returndate`, `priceperquantity`, `total_no_of_quantity`, `manufacturedate`, `expiredate`, `purchasedate`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1, 17, 3, 'TS/2017/10/14', 5, 'v5', 1, 3, 30, '2017-10-24', 30, 1, '2017-10-28', '2018-03-05', '2017-10-24', 26, '2017-10-24 20:59:53', '183.83.51.88'),
(2, 15, 3, 'TS/2017/10/12', 4, 'v01', 4, 3, 40, '2017-10-24', 10, 4, '2017-10-30', '2017-10-27', '2017-10-30', 26, '2017-10-24 21:04:58', '183.83.51.88'),
(3, 41, 1, 'TS/2017/12/27', 6, 'TEST', 1, 35, 100, '2017-12-29', 10, 10, '2017-01-01', '2017-12-31', '2017-12-28', 26, '2017-12-29 10:38:55', '49.207.188.110');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unitid` bigint(20) NOT NULL,
  `unitname` int(11) NOT NULL,
  `unitvalue` varchar(50) NOT NULL,
  `no_of_unit` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ipaddress` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unitid`, `unitname`, `unitvalue`, `no_of_unit`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1, 71, 'Box', 1, 1, '26', '2018-02-06 15:32:53', '192.168.1.84'),
(2, 53, 'Tablets', 1, 1, '26', '2017-08-24 10:15:39', '49.207.187.48'),
(3, 54, 'Bottle', 1, 1, '26', '2017-08-24 10:17:47', '49.207.187.48'),
(4, 52, 'Bottle', 1, 1, '26', '2017-08-24 10:19:14', '49.207.187.48'),
(5, 57, 'Ampoule', 1, 1, '26', '2017-08-24 10:24:33', '49.207.187.48'),
(6, 60, 'Capsule', 1, 1, '26', '2017-08-24 10:28:44', '49.207.187.48'),
(7, 55, 'Box', 1, 1, '26', '2017-08-24 10:30:15', '49.207.187.48'),
(8, 80, 'Box', 1, 1, '26', '2017-08-25 11:43:07', '49.207.187.48'),
(9, 79, 'Bottle', 1, 1, '26', '2017-08-25 12:45:24', '49.207.187.48'),
(10, 81, 'Bottle', 1, 1, '26', '2017-08-25 13:24:47', '49.207.187.48'),
(11, 82, 'Box', 1, 1, '26', '2017-08-25 23:31:11', '49.207.187.48'),
(12, 53, 'Strips', 10, 1, '20', '2017-10-07 19:00:18', '49.206.120.32'),
(13, 84, 'HiF', 50, 1, '33', '2017-09-09 15:11:22', '49.207.177.156'),
(14, 72, 'Tube', 1, 1, '26', '2017-09-09 18:04:14', '49.207.187.48'),
(15, 73, 'Bottle', 1, 1, '26', '2017-09-15 12:53:12', '180.151.35.68'),
(16, 71, 'Rotacaps', 1, 1, '36', '2017-09-18 20:37:38', '117.249.223.241'),
(17, 86, 'Box', 1, 1, '26', '2017-09-17 11:37:26', '49.207.184.10'),
(18, 87, 'Respules', 1, 1, '26', '2017-09-17 11:39:49', '49.207.184.10'),
(19, 88, 'Sachet', 1, 1, '36', '2017-09-18 20:43:33', '117.249.223.241'),
(20, 53, 'box', 1, 0, '36', '2017-09-24 12:59:52', '139.59.47.79'),
(21, 77, 'Ointment', 1, 1, '36', '2017-09-24 23:50:29', '157.50.23.160'),
(22, 77, 'ointment', 1, 0, '36', '2017-09-24 23:49:55', '157.50.23.160'),
(23, 77, 'ointment', 1, 0, '36', '2017-09-24 23:49:49', '157.50.23.160'),
(24, 77, 'oniment', 1, 0, '36', '2017-09-24 23:49:35', '157.50.23.160'),
(25, 78, 'powder', 1, 1, '36', '2017-09-23 00:56:01', '117.201.17.250'),
(26, 78, 'powder', 1, 0, '36', '2017-09-25 00:23:10', '157.50.23.160'),
(27, 55, 'cream', 1, 0, '36', '2017-09-24 23:20:09', '157.50.23.160'),
(28, 92, 'suppository', 1, 1, '36', '2017-09-23 18:47:11', '117.201.24.231'),
(29, 75, 'general', 1, 1, '36', '2017-09-23 19:26:40', '117.201.24.231'),
(30, 93, 'spray', 1, 1, '36', '2017-09-23 19:49:41', '117.201.24.231'),
(31, 94, 'spary', 1, 0, '36', '2017-10-05 13:57:58', '157.50.15.153'),
(32, 95, 'infusion', 1, 1, '36', '2017-09-23 20:32:30', '117.201.24.231'),
(33, 77, 'oinment', 1, 0, '36', '2017-09-24 23:49:22', '157.50.23.160'),
(34, 77, 'oinment', 1, 0, '36', '2017-09-24 23:49:11', '157.50.23.160'),
(35, 97, 'TEST4', 10, 1, '26', '2017-12-28 16:16:32', '49.207.188.110');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `user_type` enum('A','U','P') COLLATE utf8_unicode_ci NOT NULL COMMENT 'A=Admin, U=User, P=Player',
  `city` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rights` text COLLATE utf8_unicode_ci NOT NULL,
  `status_flag` enum('A','I') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive',
  `user_level` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `designation` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `first_name`, `last_name`, `dob`, `user_type`, `city`, `auth_key`, `password_hash`, `password_reset_token`, `status`, `created_at`, `updated_at`, `rights`, `status_flag`, `user_level`, `mobile_number`, `designation`) VALUES
(1, 'admin2', 'Admin', 'a', '2016-04-06', 'A', 'City', '8nAQquRZCfOFOdOngHc2lEhhJ5brco1t', '$2y$13$EkMWMry.JBO99EYJxuywpuJmETFsipaV.VsTsDP34HhXfL4qtpGpm', NULL, 10, '0000-00-00 00:00:00', '2017-07-06 23:31:45', '', 'A', '', '', ''),
(2, 'ADMIN01', '', '', '0000-00-00', 'A', '', 'C3egK7zpe4z9S0suhTrXYfZ-r8MXdUYk', '$2y$13$.cz0tfFelPdXnLScH7RWO.D7YTCSGYk27.PhsK8xDbAYUS0zfrl52', NULL, 10, '2017-03-01 13:03:52', '2017-03-01 02:03:52', '', 'A', '', '', ''),
(3, 'ADMIN02', '', '', '0000-00-00', 'A', '', '3Ja05cqWNXosec8ZI1PMNDzW5MU1dE8T', '$2y$13$jdTjvFSr41X5tJZBQqA9lOnJwTRnPPFIKydtjagdZozZCQyiFdKEW', NULL, 10, '2017-03-01 13:05:18', '2017-03-01 02:05:18', '', 'A', '', '', ''),
(4, 'ADMIN03', '', '', '0000-00-00', '', '', '30rSeZnFkAWrTpuooUPWw3qj8xN33dKk', '$2y$13$0yV33puVlQd0OOwiu14nV.aZH8vLc7g8Qq4LOzRa10VsYpPBw7vna', NULL, 10, '2017-03-01 13:05:33', '2017-03-01 02:05:33', '', 'A', '', '', ''),
(5, 'ADMIN04', '', '', '0000-00-00', 'A', '', 'u0RTnoCtwDeLjv3DOGXa6zQ64jhU2EB4', '$2y$13$t475BY9U6I.YOxfQLQM5wOR5rQwtFzvgqEyFyg3lEI8XtVIVRHHKy', NULL, 10, '2017-03-01 13:05:51', '2017-03-01 02:05:51', '', 'A', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_mail` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_mobile_number` int(20) NOT NULL,
  `user_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_createdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`user_id`, `user_name`, `user_mail`, `user_password`, `user_mobile_number`, `user_timestamp`, `user_createdate`) VALUES
(1, 'asd', 'fsd@gmail.com', 'A', 45, '2016-09-03 01:33:10', '2016-09-03 09:03:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `user_id` int(20) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_dob` date NOT NULL,
  `user_mail` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_mobile_number` int(20) NOT NULL,
  `user_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_createdate` datetime NOT NULL,
  `branch_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`user_id`, `user_name`, `user_dob`, `user_mail`, `user_password`, `user_mobile_number`, `user_timestamp`, `user_createdate`, `branch_id`) VALUES
(10, 'sth', '0000-00-00', 'test@gmail.com', 'srth', 35676358, '2016-09-06 04:25:05', '2016-09-06 11:35:41', 'branch2'),
(11, 'teat', '0000-00-00', 'test@gmail.com', 'ppppppp', 2147483647, '2016-09-06 04:24:51', '2016-09-06 11:54:51', 'branch1');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendorid` bigint(20) NOT NULL,
  `vendorname` varchar(100) NOT NULL,
  `vendorcode` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ipaddress` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendorid`, `vendorname`, `vendorcode`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1, 'SRI S.R.MEDICAL AGENCIES', 'V001', 1, '26', '2017-10-02 16:42:32', '61.1.153.216'),
(2, 'SRI KEERTHI MEDICAL AGENCIES', 'V002', 1, '26', '2017-08-22 11:35:48', '49.206.117.149'),
(3, 'SRINIVASA MEDICCAL AGENCIES', 'V003', 1, '26', '2017-08-22 11:36:01', '49.206.117.149'),
(4, 'PRABHAKAR MEDICAL AGENCIES', 'V004', 1, '26', '2017-08-22 11:36:09', '49.206.117.149'),
(5, 'SIVA TEJAA PHAARMA', 'V005', 1, '26', '2017-08-22 11:36:40', '49.206.117.149'),
(6, 'A.R. MEDICAL AGENCIES', 'V007', 1, '26', '2017-08-22 11:37:55', '49.206.117.149'),
(7, 'VENKATA GANESH MEDICAL AGENCIES', 'V008', 1, '26', '2017-08-22 11:37:08', '49.206.117.149'),
(8, 'GAYATRI MEDICAL AGENCIES', 'V006', 1, '26', '2017-08-22 11:38:15', '49.206.117.149'),
(9, 'SRI VINAYAKA MEDICAL AGENCIES', 'V009', 1, '26', '2017-08-22 11:38:33', '49.206.117.149'),
(10, 'SREE BALAJI MEDICAL & SURGICALS', 'V010', 1, '26', '2017-08-22 11:38:43', '49.206.117.149'),
(11, 'SRI GAYATRI PHARMACEUTICALS', 'V011', 1, '26', '2017-08-22 11:38:52', '49.206.117.149'),
(12, 'SRI LAKSHMI DEVI MEDICAL AGENCIES', 'V012', 1, '26', '2017-08-22 11:39:00', '49.206.117.149'),
(13, 'SRI SAPTHAGIRI MEDICAL AGENCIES', 'V013', 1, '26', '2017-08-22 11:39:08', '49.206.117.149'),
(14, 'SRI RAMA KRISHNA MEDICAL AGENCIES', 'V014', 1, '26', '2017-08-22 11:39:19', '49.206.117.149'),
(15, 'SUDHAKAR MEDICAL AGENCIES', 'V015', 1, '26', '2017-08-22 11:39:31', '49.206.117.149'),
(16, 'RKR MEDICAL AGENCIES', 'V016', 1, '26', '2017-08-22 11:39:42', '49.206.117.149'),
(17, 'SRI TIRUMALA MEDICAL AGENCIES', 'V017', 1, '26', '2017-08-22 11:39:53', '49.206.117.149'),
(18, 'SUDHEER MEDICAL AGENCIES', 'V018', 1, '26', '2017-08-22 11:40:02', '49.206.117.149'),
(19, 'RAJKUMAR MEDICALS', 'V019', 1, '26', '2017-08-22 11:40:10', '49.206.117.149'),
(20, 'SRI ADITHYA MEDICAL & SURGICAL AGENCIES', 'V020', 1, '26', '2017-08-22 11:40:27', '49.206.117.149'),
(23, 'Sree M.V.R. Medical Distributors', 'V022', 1, '26', '2017-10-18 13:58:52', '49.207.184.24'),
(24, 'TEST1', 'TEST1', 1, '26', '2017-12-28 17:24:02', '49.207.188.110'),
(25, 'DHINESH', 'V023', 1, '26', '2018-02-07 14:35:53', '192.168.1.84');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_branch`
--

CREATE TABLE `vendor_branch` (
  `vendor_branchid` int(11) NOT NULL,
  `vendorid` varchar(50) NOT NULL,
  `branchcode` varchar(25) NOT NULL,
  `branchname` varchar(100) NOT NULL,
  `branch_emailid` varchar(30) NOT NULL,
  `branch_phonenumber` bigint(20) NOT NULL,
  `is_headoffice` tinyint(1) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `gstnumber` varchar(25) NOT NULL,
  `bankname` varchar(50) NOT NULL,
  `ifsccode` varchar(50) NOT NULL,
  `accnumber` varchar(50) NOT NULL,
  `creditperiod` varchar(50) NOT NULL,
  `contact_person` varchar(50) NOT NULL,
  `igstpercent` float NOT NULL,
  `person_mobilenumber` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ipaddress` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor_branch`
--

INSERT INTO `vendor_branch` (`vendor_branchid`, `vendorid`, `branchcode`, `branchname`, `branch_emailid`, `branch_phonenumber`, `is_headoffice`, `address1`, `address2`, `city`, `state`, `pincode`, `gstnumber`, `bankname`, `ifsccode`, `accnumber`, `creditperiod`, `contact_person`, `igstpercent`, `person_mobilenumber`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(6, '23', 'KA01', 'Kadapa', 'senthuran@rucsan.com', 8562243366, 0, '', '', 'Kadapa', '2', '', '37AADFM5093L1ZU', '', '', '', '', '', 12, '', 1, '26', '2018-02-02 18:35:09', '192.168.1.84'),
(7, '1', 'KA011', 'Kadapa', 'senthuran1@rucsan.com', 7550043079, 0, '', '', '', '2', '', '37AADFM5093L1ZU', '', '', '', '', '', 14, '', 1, '26', '2018-02-02 17:11:43', '192.168.1.84'),
(8, '23', 'BL3', 'LIUES', 'asd@sadf.com', 9487754437, 0, '', '', '', '2', '', '37AADFM5093L1ZU', '', '', '', '', '', 0, '', 1, '26', '2017-10-21 19:12:40', '183.83.51.88'),
(9, '6', 'KA02', 'Kadapa', 'sendil@rucsan.com', 7550043078, 0, '', '', 'Kadapa', '2', '', '37AADFM5093L1ZB', '', '', '', '', '', 12, '', 1, '26', '2018-02-02 18:35:19', '192.168.1.84'),
(10, '7', 'VEN 01', 'VEN 1', 'ddddd@fdh.sdaf', 3453453453, 0, '', '', '', '17', '', '11AADFM5093L1ZB', '', '', '', '', '', 0, '', 1, '45', '2017-11-02 13:21:44', '183.83.51.82'),
(11, '20', 'CHennai', 'Chennai', 'branch@mailinator.com', 75500430797, 0, '', '', 'Chennai', '35', '', '07AAAAA1234A1Z1', '', '', '', '', '', 0, '', 1, '26', '2017-11-17 11:57:38', '122.174.33.82'),
(12, '24', 'TESTCODE1', 'TESTER1', 'test1@gmail.com', 898898898891, 0, 'TEST1', 'TEST1', 'Gowdhi1', '4', '111111', '07AAAAA1234A1Z2', 'TEST1', 'TEST002', '8888888888881', '31', 'TEST1', 0, '8999999991', 1, '26', '2017-12-28 18:18:26', '49.207.188.110');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_gst`
--

CREATE TABLE `vendor_gst` (
  `vendor_gst_id` smallint(5) NOT NULL,
  `vendor_id` smallint(5) NOT NULL,
  `state` tinyint(3) NOT NULL,
  `gst_tax` varchar(50) NOT NULL,
  `is_active` tinyint(3) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` date DEFAULT NULL,
  `updated_ipaddress` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor_gst`
--

INSERT INTO `vendor_gst` (`vendor_gst_id`, `vendor_id`, `state`, `gst_tax`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(27, 23, 2, '37AADFM5093L1ZU', 1, NULL, NULL, NULL),
(28, 1, 2, '37AADFM5093L1ZU', 1, 26, '2017-10-21', '122.171.87.93'),
(30, 1, 1, '37AADFM5093L1Z4', 1, 26, '2017-10-21', '183.83.51.88'),
(31, 6, 2, '37AADFM5093L1ZB', 1, 26, '2017-10-25', '106.208.68.80'),
(32, 7, 17, '11AADFM5093L1ZB', 1, 45, '2017-11-02', '183.83.51.82'),
(33, 20, 35, '07AAAAA1234A1Z1', 1, 26, '2017-12-28', '49.207.188.110'),
(34, 24, 4, '07AAAAA1234A1Z2', 1, 26, '2017-12-28', '49.207.188.110'),
(35, 3, 3, '10AAAAA0000A1Z5', 1, 26, '2017-12-28', '49.207.188.110');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_log`
--
ALTER TABLE `admin_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `admin_theme_version`
--
ALTER TABLE `admin_theme_version`
  ADD PRIMARY KEY (`autoid`);

--
-- Indexes for table `api_log`
--
ALTER TABLE `api_log`
  ADD PRIMARY KEY (`autoid`);

--
-- Indexes for table `auth_project_module`
--
ALTER TABLE `auth_project_module`
  ADD PRIMARY KEY (`p_autoid`);

--
-- Indexes for table `auth_user_role`
--
ALTER TABLE `auth_user_role`
  ADD PRIMARY KEY (`ur_autoid`);

--
-- Indexes for table `branch_admin`
--
ALTER TABLE `branch_admin`
  ADD PRIMARY KEY (`ba_autoid`);

--
-- Indexes for table `branch_management`
--
ALTER TABLE `branch_management`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `bulkproducts`
--
ALTER TABLE `bulkproducts`
  ADD PRIMARY KEY (`bulkproductid`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`autoid`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `company_branch`
--
ALTER TABLE `company_branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `company_gst`
--
ALTER TABLE `company_gst`
  ADD PRIMARY KEY (`gstid`);

--
-- Indexes for table `composition`
--
ALTER TABLE `composition`
  ADD PRIMARY KEY (`composition_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insurance`
--
ALTER TABLE `insurance`
  ADD PRIMARY KEY (`insurance_typeid`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoiceid`);

--
-- Indexes for table `invoicereturn_payment`
--
ALTER TABLE `invoicereturn_payment`
  ADD PRIMARY KEY (`invoicepaymentreturnid`);

--
-- Indexes for table `invoice_payment`
--
ALTER TABLE `invoice_payment`
  ADD PRIMARY KEY (`invoicepaymentid`);

--
-- Indexes for table `manufacturermaster`
--
ALTER TABLE `manufacturermaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `module_action`
--
ALTER TABLE `module_action`
  ADD PRIMARY KEY (`actionid`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `patienttype`
--
ALTER TABLE `patienttype`
  ADD PRIMARY KEY (`patient_typeid`);

--
-- Indexes for table `paymenttype`
--
ALTER TABLE `paymenttype`
  ADD PRIMARY KEY (`payment_type_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`pm_autoid`);

--
-- Indexes for table `physicianmaster`
--
ALTER TABLE `physicianmaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `productgrouping`
--
ALTER TABLE `productgrouping`
  ADD PRIMARY KEY (`productgroupid`);

--
-- Indexes for table `producttype`
--
ALTER TABLE `producttype`
  ADD PRIMARY KEY (`product_typeid`);

--
-- Indexes for table `returndetail`
--
ALTER TABLE `returndetail`
  ADD PRIMARY KEY (`return_detailid`);

--
-- Indexes for table `saledetail`
--
ALTER TABLE `saledetail`
  ADD PRIMARY KEY (`opsale_detailid`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`opsaleid`);

--
-- Indexes for table `salesreturn`
--
ALTER TABLE `salesreturn`
  ADD PRIMARY KEY (`return_id`);

--
-- Indexes for table `serviceuser_login`
--
ALTER TABLE `serviceuser_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_centre`
--
ALTER TABLE `service_centre`
  ADD PRIMARY KEY (`center_autoid`);

--
-- Indexes for table `service_centre_admin`
--
ALTER TABLE `service_centre_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`stateid`);

--
-- Indexes for table `stickynotes`
--
ALTER TABLE `stickynotes`
  ADD PRIMARY KEY (`noteid`);

--
-- Indexes for table `sticky_notes_details`
--
ALTER TABLE `sticky_notes_details`
  ADD PRIMARY KEY (`autoid`);

--
-- Indexes for table `stockmaster`
--
ALTER TABLE `stockmaster`
  ADD PRIMARY KEY (`stockid`);

--
-- Indexes for table `stockrequest`
--
ALTER TABLE `stockrequest`
  ADD PRIMARY KEY (`requestid`);

--
-- Indexes for table `stockresponse`
--
ALTER TABLE `stockresponse`
  ADD PRIMARY KEY (`stockresponseid`);

--
-- Indexes for table `stockreturn`
--
ALTER TABLE `stockreturn`
  ADD PRIMARY KEY (`stockreturnid`);

--
-- Indexes for table `taxgrouping`
--
ALTER TABLE `taxgrouping`
  ADD PRIMARY KEY (`taxgroupid`);

--
-- Indexes for table `taxmaster`
--
ALTER TABLE `taxmaster`
  ADD PRIMARY KEY (`taxid`);

--
-- Indexes for table `transferstock`
--
ALTER TABLE `transferstock`
  ADD PRIMARY KEY (`transferstockid`);

--
-- Indexes for table `transferstockapprove`
--
ALTER TABLE `transferstockapprove`
  ADD PRIMARY KEY (`transferstockapproveid`);

--
-- Indexes for table `transferstockreceive`
--
ALTER TABLE `transferstockreceive`
  ADD PRIMARY KEY (`transferstockreceiveid`);

--
-- Indexes for table `transferstockreturn`
--
ALTER TABLE `transferstockreturn`
  ADD PRIMARY KEY (`transferstockreturnid`);

--
-- Indexes for table `transferstockreturnapprove`
--
ALTER TABLE `transferstockreturnapprove`
  ADD PRIMARY KEY (`transferstockreturnapproveid`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unitid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendorid`);

--
-- Indexes for table `vendor_branch`
--
ALTER TABLE `vendor_branch`
  ADD PRIMARY KEY (`vendor_branchid`);

--
-- Indexes for table `vendor_gst`
--
ALTER TABLE `vendor_gst`
  ADD PRIMARY KEY (`vendor_gst_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_log`
--
ALTER TABLE `admin_log`
  MODIFY `log_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admin_theme_version`
--
ALTER TABLE `admin_theme_version`
  MODIFY `autoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `api_log`
--
ALTER TABLE `api_log`
  MODIFY `autoid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `auth_project_module`
--
ALTER TABLE `auth_project_module`
  MODIFY `p_autoid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `auth_user_role`
--
ALTER TABLE `auth_user_role`
  MODIFY `ur_autoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `branch_admin`
--
ALTER TABLE `branch_admin`
  MODIFY `ba_autoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `branch_management`
--
ALTER TABLE `branch_management`
  MODIFY `branch_id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bulkproducts`
--
ALTER TABLE `bulkproducts`
  MODIFY `bulkproductid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `autoid` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `company_branch`
--
ALTER TABLE `company_branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `company_gst`
--
ALTER TABLE `company_gst`
  MODIFY `gstid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `composition`
--
ALTER TABLE `composition`
  MODIFY `composition_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2439;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `insurance`
--
ALTER TABLE `insurance`
  MODIFY `insurance_typeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoiceid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoicereturn_payment`
--
ALTER TABLE `invoicereturn_payment`
  MODIFY `invoicepaymentreturnid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice_payment`
--
ALTER TABLE `invoice_payment`
  MODIFY `invoicepaymentid` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `manufacturermaster`
--
ALTER TABLE `manufacturermaster`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
--
-- AUTO_INCREMENT for table `module_action`
--
ALTER TABLE `module_action`
  MODIFY `actionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT for table `patienttype`
--
ALTER TABLE `patienttype`
  MODIFY `patient_typeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `paymenttype`
--
ALTER TABLE `paymenttype`
  MODIFY `payment_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `pm_autoid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `physicianmaster`
--
ALTER TABLE `physicianmaster`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1164;
--
-- AUTO_INCREMENT for table `productgrouping`
--
ALTER TABLE `productgrouping`
  MODIFY `productgroupid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `producttype`
--
ALTER TABLE `producttype`
  MODIFY `product_typeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `returndetail`
--
ALTER TABLE `returndetail`
  MODIFY `return_detailid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `saledetail`
--
ALTER TABLE `saledetail`
  MODIFY `opsale_detailid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `opsaleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `salesreturn`
--
ALTER TABLE `salesreturn`
  MODIFY `return_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `serviceuser_login`
--
ALTER TABLE `serviceuser_login`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `service_centre`
--
ALTER TABLE `service_centre`
  MODIFY `center_autoid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `service_centre_admin`
--
ALTER TABLE `service_centre_admin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `stateid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `stickynotes`
--
ALTER TABLE `stickynotes`
  MODIFY `noteid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `sticky_notes_details`
--
ALTER TABLE `sticky_notes_details`
  MODIFY `autoid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `stockmaster`
--
ALTER TABLE `stockmaster`
  MODIFY `stockid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `stockrequest`
--
ALTER TABLE `stockrequest`
  MODIFY `requestid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;
--
-- AUTO_INCREMENT for table `stockresponse`
--
ALTER TABLE `stockresponse`
  MODIFY `stockresponseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `stockreturn`
--
ALTER TABLE `stockreturn`
  MODIFY `stockreturnid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `taxgrouping`
--
ALTER TABLE `taxgrouping`
  MODIFY `taxgroupid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `taxmaster`
--
ALTER TABLE `taxmaster`
  MODIFY `taxid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transferstock`
--
ALTER TABLE `transferstock`
  MODIFY `transferstockid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `transferstockapprove`
--
ALTER TABLE `transferstockapprove`
  MODIFY `transferstockapproveid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `transferstockreceive`
--
ALTER TABLE `transferstockreceive`
  MODIFY `transferstockreceiveid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `transferstockreturn`
--
ALTER TABLE `transferstockreturn`
  MODIFY `transferstockreturnid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `transferstockreturnapprove`
--
ALTER TABLE `transferstockreturnapprove`
  MODIFY `transferstockreturnapproveid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unitid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendorid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `vendor_branch`
--
ALTER TABLE `vendor_branch`
  MODIFY `vendor_branchid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `vendor_gst`
--
ALTER TABLE `vendor_gst`
  MODIFY `vendor_gst_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
