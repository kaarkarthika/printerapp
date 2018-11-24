<?php
namespace backend\assets;
use yii\web\AssetBundle;
use yii\web\View;
class DashboardAsset extends AssetBundle
{
	   public function init() {
        $this->jsOptions['position'] = View::POS_BEGIN;
        parent::init();
    }
	
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      "ubold/plugins/jquery.steps/css/jquery.steps.css",
    "ubold/css/bootstrap.min.css",
	'ubold/plugins/morris/morris.css',
	'ubold/css/core.css',
	'ubold/css/components.css',
	'ubold/css/icons.css',
	'ubold/css/pages.css',
	'ubold/css/emoji.css',
	'ubold/css/responsive.css',
  /*
	"ubold/plugins/datatables/jquery.dataTables.min.css",
	"ubold/plugins/datatables/buttons.bootstrap.min.css",
	"ubold/plugins/datatables/fixedHeader.bootstrap.min.css",
	"ubold/plugins/datatables/responsive.bootstrap.min.css",
	"ubold/plugins/datatables/scroller.bootstrap.min.css",
	"ubold/plugins/datatables/dataTables.colVis.css",
	"ubold/plugins/datatables/dataTables.bootstrap.min.css",
	"ubold/plugins/datatables/fixedColumns.dataTables.min.css",
  */
	"ubold/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" ,
	"ubold/plugins/jsgrid/css/jsgrid.min.css",
    "ubold/plugins/jsgrid/css/jsgrid-theme.min.css" ,
    "ubold/plugins/magnific-popup/css/magnific-popup.css",
  //  "ubold/plugins/jquery-datatables-editable/datatables.css",
    "ubold/plugins/bootstrap-select/css/bootstrap-select.min.css",
    "ubold/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css",
    "ubold/plugins/bootstrap-sweetalert/sweet-alert.css",
    "ubold/plugins/summernote/summernote.css",
    "ubold/plugins/custombox/css/custombox.css",
    "ubold/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css",
   "ubold/plugins/bootstrap-daterangepicker/daterangepicker.css" ,
    "ubold/plugins/bootstrap-table/css/bootstrap-table.min.css",
    "ubold/datetimepicker/build/css/bootstrap-datetimepicker.css",
    
    //Alban Added
     "alert/jquery-confirm.min.css",
	  // "plugins/datatables/media/css/dataTables.bootstrap.css",
	      //"plugins/datatables/media/css/dataTables.bootstrap.css",
    ];
    public $js = [
   
      "ubold/js/modernizr.min.js",
	  
    // "ubold/js/jquery.min.js",
      "ubold/js/bootstrap.min.js",
      "ubold/js/detect.js",
      "ubold/js/fastclick.js",
      "ubold/js/jquery.slimscroll.js",
      "ubold/js/jquery.blockUI.js", 
      "ubold/js/waves.js",
     "ubold/js/wow.min.js",
      "ubold/js/jquery.nicescroll.js",
      "ubold/js/jquery.scrollTo.min.js",
      "ubold/plugins/peity/jquery.peity.min.js",
      "ubold/plugins/waypoints/lib/jquery.waypoints.js",
      "ubold/plugins/counterup/jquery.counterup.min.js",
     // "ubold/plugins/morris/morris.min.js",
      "ubold/plugins/raphael/raphael-min.js",
      "ubold/plugins/jquery-knob/jquery.knob.js",
    //  "ubold/pages/jquery.dashboard.js",
      "ubold/js/jquery.core.js",
      "ubold/js/jquery.app.js", 
      "ubold/js/jquery.chat.js", 
      /*
     "ubold/plugins/datatables/jquery.dataTables.min.js",
      "ubold/plugins/datatables/dataTables.bootstrap.js",
      "ubold/plugins/datatables/dataTables.buttons.min.js",
      "ubold/plugins/datatables/buttons.bootstrap.min.js",
      "ubold/plugins/datatables/jszip.min.js",
      "ubold/plugins/datatables/pdfmake.min.js",
      "ubold/plugins/datatables/vfs_fonts.js",
      "ubold/plugins/datatables/buttons.html5.min.js",
      "ubold/plugins/datatables/buttons.print.min.js",
      "ubold/plugins/datatables/dataTables.fixedHeader.min.js",
      "ubold/plugins/datatables/dataTables.keyTable.min.js",
      "ubold/plugins/datatables/dataTables.responsive.min.js",
      "ubold/plugins/datatables/responsive.bootstrap.min.js",
      "ubold/plugins/datatables/dataTables.scroller.min.js",
      "ubold/plugins/datatables/dataTables.colVis.js",
      "ubold/plugins/datatables/dataTables.fixedColumns.min.js",
      "ubold/pages/datatables.init.js", */
      "ubold/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js",
       "ubold/plugins/jsgrid/js/jsgrid.min.js",
      "ubold/pages/jquery.jsgrid.init.js",
      "ubold/plugins/magnific-popup/js/jquery.magnific-popup.min.js",
     "ubold/plugins/jquery-datatables-editable/jquery.dataTables.js",
    // "ubold/plugins/datatables/dataTables.bootstrap.js",
     
	 
      "ubold/plugins/tiny-editable/mindmup-editabletable.js",
      "ubold/plugins/tiny-editable/numeric-input-example.js",
      //"ubold/pages/datatables.editable.init.js",
      "ubold/plugins/select2/js/select2.min.js",
      "ubold/plugins/bootstrap-select/js/bootstrap-select.min.js",
       "ubold/plugins/custombox/js/custombox.min.js",
       "ubold/plugins/custombox/js/legacy.min.js",
       "ubold/plugins/jquery.steps/js/jquery.steps.min.js",
       "ubold/plugins/jquery-validation/js/jquery.validate.min.js",
      "ubold/pages/jquery.wizard-init.js",
       "ubold/plugins/bootstrap-sweetalert/sweet-alert.min.js",
       "ubold/pages/jquery.sweet-alert.init.js",
	   
     
      
//emoji	 
	  "ubold/js/util.js",
	  "ubold/js/config.js",
	  "ubold/js/emoji-picker.js",
	  "ubold/js/jquery.emojiarea.js",
        
       
	   "ubold/plugins/notifyjs/js/notify.js",
       "ubold/plugins/notifications/notify-metro.js",
       "ubold/plugins/summernote/summernote.js",
       "ubold/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js",
       "ubold/plugins/autoNumeric/autoNumeric.js",
       "ubold/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js",
       "ubold/plugins/moment/moment.js",
       "ubold/plugins/timepicker/bootstrap-timepicker.js",
     	"ubold/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js",
        "ubold/plugins/clockpicker/js/bootstrap-clockpicker.min.js",
        "ubold/plugins/bootstrap-daterangepicker/daterangepicker.js",
        "ubold/pages/jquery.form-pickers.init.js",
        "ubold/datetimepicker/build/js/bootstrap-datetimepicker.min.js",
         "ubold/plugins/bootstrap-table/js/bootstrap-table.min.js",
      "ubold/pages/jquery.bs-table.js",
     
     //Alban Added
      "alert/jquery-confirm.min.js",
     
    /* "ubold/plugins/datatables/jquery.dataTables.min.js",
      "ubold/plugins/datatables/dataTables.bootstrap.js",
      "ubold/plugins/datatables/dataTables.buttons.min.js",
      "ubold/plugins/datatables/buttons.bootstrap.min.js",
      "ubold/plugins/datatables/jszip.min.js",
      "ubold/plugins/datatables/pdfmake.min.js",
      "ubold/plugins/datatables/vfs_fonts.js",
      "ubold/plugins/datatables/buttons.html5.min.js",
      "ubold/plugins/datatables/buttons.print.min.js",
      "ubold/plugins/datatables/dataTables.fixedHeader.min.js",
      "ubold/plugins/datatables/dataTables.keyTable.min.js",
      "ubold/plugins/datatables/dataTables.responsive.min.js",
      "ubold/plugins/datatables/responsive.bootstrap.min.js",
      "ubold/plugins/datatables/dataTables.scroller.min.js",
      "ubold/plugins/datatables/dataTables.colVis.js",
      "ubold/plugins/datatables/dataTables.fixedColumns.min.js",
      "ubold/pages/datatables.init.js",
      "ubold/pages/datatables.editable.init.js",*/
        
        
    ];
	

	
	
	
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
