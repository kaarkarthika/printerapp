// JavaScript Document

function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload(true);",timeoutPeriod);
//JavaScript:timedRefresh(900000);	
}
function call_conform()
{
	if(confirm("Are you sure you want to delete?"))
	{
		return true;
	}
	else
	{
		return false;
	}
}
function call_branch()
{
	//alert(js_base+"/userexception/"+document.getElementById('branch').value+"/get/");
	window.location=js_base+"/index.php/ad/ip_block_branch/"+document.getElementById('branch').value+"/get";
}
function call_delete()
{
	//alert(js_base+"/userexception/"+document.getElementById('branch').value+"/get/");
	if(confirm("Are you sure you want to delete?"))
	{
		window.location=js_base+"/index.php/ad/ip_block_branch/"+document.getElementById('branch').value+"/delete";
	}
	else
	{
		return false;
	}
	
}
function back_to(form_name,url) {
	var url="document."+form_name+".action='"+url+"'";
	var sub="document."+form_name+".submit()";
	eval(url);
	eval(sub);
}

function show_task(id)
{
	if (document.getElementById)
	{
		var obj = document.getElementById(id);
		if (obj.style.display == "none") 
		{
			obj.style.display = "inline";
		}
	}
}
function hide_task(id)
{
	
	if (document.getElementById)
	{
		var obj = document.getElementById(id);
		if (obj.style.display == "inline")
		{
			obj.style.display = "none";
		}
	}
}


function isArray(obj) {
//returns true is it is an array
if (obj.constructor.toString().indexOf('Array') == -1)
return false;
else
return true;
}
function updateClock ( )
    {
    var currentTime = new Date ( );
    
    var currentDay = currentTime.getDate();
    var currentMonth = currentTime.getUTCMonth();
    
    var currentYear = currentTime.getFullYear ( );
    
    var currentHours = currentTime.getHours ( );
    var currentMinutes = currentTime.getMinutes ( );
    var currentSeconds = currentTime.getSeconds ( );
 
    // Pad the minutes and seconds with leading zeros, if required
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
 
    // Choose either "AM" or "PM" as appropriate
    var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
 
    // Convert the hours component to 12-hour format if needed
    currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
 
    // Convert an hours component of "0" to "12"
    currentHours = ( currentHours == 0 ) ? 12 : currentHours;
 
    // Compose the string for display
    var currentTimeString = "Last Saved  : "+(currentMonth+1)+"/"+currentDay+"/"+currentYear+"  "+currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
 
    $("#clock").html(currentTimeString);
 
 }
 function validate_form (val_id) {
 	
 	var temp=document.getElementById(val_id).value;
 	if(temp=="true")
	{
		alert("All Fields marked with a red asterisk (*) are required");
		return false;
		
	}
	else
	{
		return true;
	}
 } 
///Set timout for error DIV
window.setTimeout(afterDelay, 3000); // on page load set the value 
function afterDelay() {
		$('.msg_yes').hide();
		$('.msg_no').hide();
}
var in_type_temp;
var in_id_temp;
function add_new_gp(in_type,in_id,in_val) {
	//alert("sdf");
   if(in_val=="addgp"){
   		show_mask('#group_div');
		document.getElementById("new_group").value="";
	}else if(in_id=="105"){
			//alert("Stoped");
			if(in_val=="291"){
				document.getElementById("215").value="0";
			}
			//$('#'+in_id).addClass('validate[required]');
			//$('#215').addClass('validate[required]');
	}else if(in_val=="52" || in_val=="59" || in_val=="282" || in_val=="283"){
		show_mask('#group_div');
		document.getElementById("new_group").value="";
	}
	in_id_temp=in_id;
	in_type_temp=in_type;
}
var outside_val="";
function add_new_gp1(in_type,in_id,in_val) {
	 outside_val="";
	if(in_id=="35" && in_val=="226"){
	 	outside_val=in_val;
   		show_mask('#group_div1');
		//document.getElementById("new_group").value="";
	}else if(in_id=="34"  && in_val=="223"){
		show_mask('#group_div2');
	}	
	
}
function show_log_div(in_type,in_id,in_val) {
   	show_mask('#log_div');
	document.getElementById("log_reason").value="";
}
function hide_log_div(in_val) {
   	hide_mask('#log_div');
   	document.getElementById("hid_reason").value=document.getElementById("log_reason").value;
}

function add_new_value(in_val){
	var temp_ret;
    $.ajax({
        url: js_base+"/index.php/ad_send/save_dropdown_value",
        type: "post",
        data: {'cl_type':'add','mg_type':in_type_temp,'dvalue':in_val},
        success: function(response, textStatus, jqXHR){
        temp_ret= response;
          $("#"+in_id_temp).append($("<option selected='selected' value="+temp_ret+">"+in_val+"</option>")
          .text(in_val)
          );
       },
    });
	hide_mask('#group_div');	}
// for Post press in add_job page 
function show_post_Press_div() {
  if(document.getElementById('post_press_check').checked){
  	show_task('post_press_container');
  }else{
  	hide_task('post_press_container');
  }
}
var alert_for_save=false;
var xmlfreetimd;
function call_start_ajax(task_id,user_id,url_base,user_type,user_dep,edit_mod)
{
	
	var ret_sp_name1="a_start1"+task_id;	
	var type_edit="";
	
	if(edit_mod=="aj_hold"){
		type_edit="aj_hold";
		
	}else if(document.getElementById(ret_sp_name1).title=="Finish"){
		type_edit="aj_edit";
	}else if(document.getElementById(ret_sp_name1).title=="Finish"){
		type_edit="aj_move";
		CopySelected('#list3','#list4');
	}else if(document.getElementById(ret_sp_name1).title=="Move To Scheduled"){
		type_edit="aj_move";
		CopySelected('#list4','#list3');
		alert_for_save=true;
	}else if(document.getElementById(ret_sp_name1).title=="Move To NC"){
		type_edit="aj_move_nc";
		CopySelected('#list3','#list4');
		alert_for_save=true;
	}else if(document.getElementById(ret_sp_name1).title=="Deliver"){
		type_edit="aj_deliver";
	}else{
		type_edit="aj_save";
	}
	
    xmlfreetimd=GetXmlHttpObject();
    if (xmlfreetimd==null)
    {
        alert ("Browser does not support HTTP Request");
        return;
    }
    var url=url_base+"/index.php/ad/ajax_counter/";
    url=url+task_id+"/"+user_id+"/"+type_edit+"/"+user_type+"/"+user_dep;
	//alert(url);
    xmlfreetimd.onreadystatechange=passallaction;
    xmlfreetimd.open("GET",url,true);
    xmlfreetimd.send(null);
}
function call_finise_job(job_id,is_todo,form_id) {

	if(is_todo!="stoped"){
  	var selected_todo= new Array();
  	var not_selected_todo= new Array();
  	$("input[class='jc_p']").each(function(){
		 not_selected_todo.push($(this).attr('name'));
	});
    $("input[class='jc_p']:checked").each(function(){
		  selected_todo.push($(this).attr('name'));
	});
	//alert(not_selected_todo.length);
	//alert(selected_todo.length);
	
	if(selected_todo.length<0 || selected_todo.length=="" || selected_todo.length<not_selected_todo.length){
		alert("Complete the Checklist");
		show_todo_div('','','false');
	}else if(not_selected_todo.length==selected_todo.length){
  		var valid = $("#f"+form_id).validationEngine('validate');
		if(valid){
  			var temp_action="document.f"+form_id+".action='"+js_base+"/index.php/ad/up_job/"+job_id+"/aj_edit'";
   			eval(temp_action);
   			var temp="document.f"+form_id+".submit();";
			eval(temp);
		}
    }
   }else{
   	var valid = $("#f"+form_id).validationEngine('validate');
	if(valid){
   		var temp_action="document.f"+form_id+".action='"+js_base+"/index.php/ad/up_job/"+job_id+"/aj_edit'";
   		eval(temp_action);
   		var temp="document.f"+form_id+".submit();";
		eval(temp);
	}	
   	//	 window.location=js_base+"/index.php/ad/up_job/"+job_id+"/aj_edit";
   }
}
function CopySelected(fromGrid, toGrid)
    {	
        var grid = jQuery(fromGrid);
        var rowKey = grid.getGridParam("selrow");
        if(rowKey != null)
        {
            var row = grid.jqGrid('getRowData', rowKey);
            grid.delRowData(rowKey);
            jQuery(toGrid).addRowData("bla_"+rowKey, row);
        }
    }
function passallaction()
{
   if (xmlfreetimd.readyState==4)
    {
		var retArray=(xmlfreetimd.responseText.split("^^")); 
		var ret_sp_name1="a_start1"+retArray[0];
		var ret_sp_name2="a_start2"+retArray[0];
		//var ret_time_name="time_start"+retArray[0];
		if(document.getElementById(ret_sp_name1)){
		if(document.getElementById(ret_sp_name1).title=="Finish"){
			document.getElementById(ret_sp_name1).title="Start";
			document.getElementById(ret_sp_name2).title="";
		}else if(document.getElementById(ret_sp_name1).title=="Move To Scheduled"){
			document.getElementById(ret_sp_name1).title="Move To NC";
			document.getElementById(ret_sp_name2).title="Hold";
		}else{
			document.getElementById(ret_sp_name1).title="Finish";
			document.getElementById(ret_sp_name2).title="Hold";
		}
		}
		// if(ret_time_name!="")
		// {
			// document.getElementById(ret_time_name).innerHTML=retArray[1];
		// }
		// else
		// {
			// document.getElementById(ret_time_name).innerHTML=retArray[1];
		// }
	}
}

//Comme AJAX object function
function GetXmlHttpObject()
{
    if (window.ActiveXObject)
    {
        return new ActiveXObject("Microsoft.XMLHTTP");
    }

    if (window.XMLHttpRequest)
    {
        return new XMLHttpRequest();
    }

    return null;
}
function show_msgbox(msg3){
  alert(msg3);
}
function call_view_ajax(in_val){
	    $.ajax({
        url: js_base+"/index.php/ad/view_job_value/"+in_val,
        type: "post",
        data: {'cl_type':'add','mg_type':in_type_temp,'dvalue':in_val},
        success: function(response, textStatus, jqXHR){
        	//alert(response);
        show_mask('#View_job_value_ajax');
        $("#View_job_value_ajax").html(response);
       },
    });
	hide_mask('#group_div');	
}
function show_job_value_ajax (in_val) {
	
	 $.ajax({
        url: js_base+"/index.php/ad/get_payment_value/"+in_val,
        type: "post",
        data: {'dvalue':in_val},
        success: function(response, textStatus, jqXHR){
        show_mask('#payment_view_div'); 
        $("#payment_view_div").html(response);
       },
    });
		
  
}
function call_in_time_ajax(in_val){
	//alert(in_val);
	    $.ajax({
        url: js_base+"/index.php/ad/save_in_time_value/"+getTimestamp(in_val),
        type: "post",
        data: {'cl_type':'add','mg_type':in_type_temp,'dvalue':in_val},
        success: function(response, textStatus, jqXHR){
        	//alert(js_base+"/index.php/ad_send/save_in_time_value/"+getTimestamp(in_val));
        	//var newDate=myDate[1]+"/"+myDate[0]+"/"+myDate[2];
        	//alert(response);
			if(response=="sy"){
				hide_task('set_new_date_div');
				$('.msg_yes').show();
        		$('.msg_yes').text('Data Saved Successfully');
        		window.setTimeout(afterDelay, 3000);
        		window.location=js_base+"/index.php/ad/job_scheduler/";
        		hide_mask('#set_new_date_div');
        	}else if(response=="sf"){
        		alert("Please Set Time between the branch Time.");
        	}else if(response=="sx"){
        		alert("Please Set Time Greater than the Last Job Time.");
			}else if(response=="sy"){
				$('.msg_no').show();
        		$('.msg_no').text('Error');
        		window.setTimeout(afterDelay, 3000);
        		hide_mask('#set_new_date_div');
			}
        
        
       },
    });
		//
		
		
}
function getTimestamp(str) {
  var d = str.match(/\d+/g); // extract date parts
  return (+new Date(d[2], d[1] - 1, d[0], d[3], d[4],d[5]))/1000; // build Date object
  
}
function day_shift_job(task_id,user_id,user_type,user_dep,edit_mod)
{
	window.location=js_base+"/index.php/ad/shift_job/"+task_id+"/"+edit_mod;

}


function close_ajax(){
	$("#View_job_value_ajax").hide();
	hide_mask('#View_job_values_ajax');
}
function alert_stop(argument) {
	//alert(alert_for_save);
 if(alert_for_save==true){
  return false;
 }
}
function change_session (newbranch) {
if(newbranch!=""){
  	window.location=js_base+"/index.php/ad/branch_change/"+newbranch;
 }
}
/*openWindow();
function openWindow(){
var browser=navigator.appName;
if (browser=='Microsoft Internet Explorer')
{
window.opener=self;

}
window.open('ihttp://192.168.1.11/2012/ascendas/dev','null’,width=900,height=750,toolbar=no,scrollbars=no,location=no,resizable =yes');
window.moveTo(0,0);
window.resizeTo(screen.width,screen.height-100);
self.close();
}
var popup = window.open("http://www.vivek.x10.bz", "myPopup", 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=120,height=120')
*/