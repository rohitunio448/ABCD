<?php 
include("../includes/include.inc.php");
/***custom Package**/
//@customUg Package


include('../get-files/connect-files.php');   // all common record 
include('../includes/function/function-action.php');

include("../includes/array-short.inc.php");


//////////////////page data////////////////
$nextPageUrl="./manage-sub-category.php";
$prevPageUrl="./error.php";
$selfUrl=$_SERVER['PHP_SELF']; #cureentPageUrl
if(empty($_SESSION['ADM_ID'])||$_SESSION['ADM_ID']==""||$_SESSION['ADM_ID']==''){
echo "<script>location.href='./logout.php';</script>";
}



//$settings_data=mysql_fetch_assoc(mysql_query("select * from book_cat where id='".$_GET['up']."'"));
//$admin_data=mysql_fetch_assoc(mysql_query("select * from book_cat where id='".$_GET['up']."'"));
// @extract($record_data);













   





$tableName="book_cat"; // for statusChange  ::  main table ,Listing , Global
$recordId="id"; #deleteRecordbyWhichPrimaryKey
$subRootArr=array("best","large","small","thumb");
#incaseFiletoUpload
 $uploadPath="../domain-images/";
$imageRoot="../domain-images/";
	
$DB_IMG_INDEX='image'; #fieldValueofImageInDatabaseOrdbFileIndexValue
$currentSession=date('Y'); #sessionYear

##############@@@@@@opration@@@@@@@@@@@@@@####################
# $directValue=n2n_delete(); 

   
   
 if(isset($_GET['del_id'])&&$_GET['del_id']!=NULL){

   mysql_query("DELETE from domain_details WHERE domain_id='".$_GET['del_id']."' "); // delete other 

		if(n2n_delete($tablePass="book_cat",$deleteId=$_GET['del_id'],$dbImageIndex="image")===true)
	 msgDisplay("success","Record deleted successfully. !",$_SERVER['PHP_SELF']);
	else
	 msgDisplay("error","<strong>Sorry,</strong> Record can not be delete now. !",$_SERVER['PHP_SELF']);
}
 
 /****deleteFunction***/





#deleteArecord






/****multiple delete**/
@extract($_POST);
if(isset($_POST['Submit_Delete'])&&$_POST['Submit_Delete']=="Delete"){

# cout array
if(!is_array($checkbox_id)){
$_SESSION['WARN_MSG2']="<strong>Warning:-</strong> Please, select an option. !"; 
header("Location:".$_SERVER['PHP_SELF']);exit;
}

if(is_array($checkbox_id)&&count($checkbox_id)>0){
  #n2n_delete_multi($tablePass="",$deleteIdArr,$dbImageIndex="image")
  n2n_delete_multi($tablePass="",$deleteIdArr=$checkbox_id,$dbImageIndex="image");
 #msgDisplay("warning","<strong>Sorry,</strong> Function error to delete, action can not be completed. !",$_SERVER['PHP_SELF']);
 
}
			

}















/******ChangeSelectedStatusOnly******/
if(isset($_POST['submit_status'])){   
$status_val=$_POST['submit_status'];
# function n2n_statusChange($tableName,$field="status",$satusValue="inactive",$recordArr){
	
	if(!isset($checkbox_id)){
$_SESSION['WARN_MSG2']="<strong>Warning:-</strong> Please, select an option. !"; 
}else{


     if(n2n_statusChange($tableName,$field="status",$satusValue=$status_val,$checkbox_id)===true)
        $_SESSION['SUCCESS_MSG2']=count($checkbox_id)."&nbsp;record marked as $status_val . !"; 

}


#  
   
   
 
		
}



//sort order
include("../includes/position-inc.php");   //  sor main table 
// record by position




/*****recordListings******/
#getRecords()   // fetching all records


/***pagingListing***/



$change_query=" "; 
$total=0;

//$change_query.=$orderby.$limits;  // order by add_date and limit 25
 //$change_query=" order by position ASC "; 
 $change_query=" order by position DESC "; 
#$getResult=getRecords($tableName="book_cat");
$getResult=getRecords($tableName="book_cat","*","1 ".$change_query);
$total=mysql_num_rows($getResult);
 
 //  getResult  total
 /**domain by member**/










?>
<!DOCTYPE html>
<html>
    

<head>
        
        <!-- Title -->
        <title>View <?php echo ucwords($ARR_PAGE_KEY['main_cat'])  ?> | <?=ucwords(MAIN_KEY)."&nbsp;".SITE_TITLE?> </title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
       <meta name="description" content="<?=ucwords(MAIN_KEY)."&nbsp;".SITE_TITLE?>" />
        <meta name="keywords" content="<?=ucwords(MAIN_KEY)."&nbsp;".SITE_TITLE?>" />
        <meta name="author" content="<?=ucwords(MAIN_KEY)."&nbsp;".SITE_TITLE?>" />
         <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" /> 
        <!-- Styles -->
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
        <link href="assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css">
        <link href="assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
        
        <!-- Theme Styles -->
        <link href="assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
        
		 <link href="./ugt-files/colorBg-css.css" rel="stylesheet" type="text/css" />   
        <script src="assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
		 <script src="function.js" type="text/javascript"></script>
        
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
		<!--<script type="text/jscript" src="multi-check-allJs.js" ></script> -->
		
		
		 <script type="text/javascript">
						  function show_msg_box(){
						  alert('Double click not allowed. !');
						  return false;
						  }
						 </script>
						 
						 
     <script type="text/javascript">
 function check_sub(num){ 
  if($('#main'+num).parent('span').hasclass('checked')){ 
  $('.sub'+num).each(function(){ 
    $(this).parent('span').addClass('checked');
  });
  }else{
  $('.sub'+num).each(function(){
    $(this).parent('span').removeClass('checked');
  });
  }
 }
 
 function check_all_list(thisid){
 //var className = $('#'+thisid).parent().attr('class');
 //alert(className);
   if($('#'+thisid).parent('span').attr('class')!='checked'){ 
     $('input[name^="checkbox_id"]').each(function(){ 
	  $(this).parent('span').addClass('checked');
	  $(this).attr('checked',true);
	 });
   }else{ 
     $('input[name^="checkbox_id"]').each(function(){
	  $(this).parent('span').removeClass('checked');
	  $(this).attr('checked',false);
	 });
   }
   
 }
 
 
 function check_all(thiss){
 
   if($('#all').attr('checked')=='checked'){ 
     $('#'+thiss).find(':checkbox').each(function(){ 
	  $(this).parent('span').addClass('checked');
	 });
   }else{ 
     $('#'+thiss).find(':checkbox').each(function(){
	  $(this).parent('span').removeClass('checked');
	 });
   }
   
 }
 
 
 
 
 function remove_all(){
   $('#all').parent('span').removeClass('checked');
   $('#all').attr('checked',false);
 }
 

</script>   
    </head>
    <body class="page-header-fixed compact-menu page-horizontal-bar">
        <div class="overlay"></div>
        <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s1">
            <h3><span class="pull-left"> <?=ucwords(MAIN_KEY)?> </span><a href="javascript:void(0);" class="pull-right" id="closeRight"><i class="fa fa-times"></i></a></h3>
			
       
			
			  <!--- chat dive--->
			
		</nav>
        <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
            <h3><span class="pull-left"> <?=ucwords(MAIN_KEY)?> </span> <a href="javascript:void(0);" class="pull-right" id="closeRight2"><i class="fa fa-angle-right"></i></a></h3>
          <div class="slimscroll chat" style=" display:none;">
			</div>
			
			
            <div class="chat-write">
                <form class="form-horizontal" action="javascript:void(0);">
                    <input type="text" class="form-control" >
                </form>
            </div>
			
		</nav>
		
		
        <form class="search-form" action="#" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control search-input" placeholder="Search...">
                <span class="input-group-btn">
                    <button class="btn btn-default close-search waves-effect waves-button waves-classic" type="button"><i class="fa fa-times"></i></button>
                </span>
            </div><!-- Input Group -->
        </form><!-- Search Form -->
		
		
		
     <main class="page-content content-wrap">
          <?php include("./ugt-files/header-1.php"); ?>
            <!-- Page Sidebar -->
            <div class="page-inner">
                <div class="page-breadcrumb">
                    <ol class="breadcrumb container">
                        <li><a href="<?=$ADMIN_HOME?>">Home</a></li>
                        <li><a href="#"><?php echo ucwords($ARR_PAGE_KEY['main_cat'])  ?> </a></li>
                    
                    </ol>
                </div>
                <div class="page-title">
                    <div class="container">
                        <h3><span class="color-theme"><?=ucwords($ARR_PAGE_KEY['main_cat'])?></span></h3>
                    </div>
                </div>
				
                <div id="main-wrapper" class="container">
                    <div class="row">
                        <div class="col-md-12">
						
			 <?php  include('../includes/error-message2.php');$_SESSION['ERROR_MSG2']=NULL;$_SESSION['SUCCESS_MSG2']=NULL;$_SESSION['WARN_MSG2']=NULL;?>
				 
				 
				<form name="listing-news-form"  enctype="multipart/form-data" method="post">
							
									
                            <div class="panel panel-white">
                                <div class="panel-heading clearfix">
                        <h4 class="panel-title" title="Add Domain">
						<i class="menu-icon glyphicon glyphicon-menu-hamburger">&nbsp;&nbsp;</i><a href="<?php echo $nextPageUrl?>"><?="Add&nbsp;".$ARR_PAGE_KEY['main_cat']?></a></h4>   
						
						
                                </div>
                                <div class="panel-body">
                                   <div class="table-responsive">
								   
								    <span class="btn btn-default m-b-xs">
								   <input type="checkbox" name="check_all" id="check_all_li" value="checkb" onClick="check_all_list('check_all_li');" style="width:10px;" />Select All&nbsp; </span>
	       <button type="submit" name="Submit_Delete" onClick="return confirm('Are you sure to delete?');" title="Delete <?php echo ucwords($ARR_PAGE_KEY['main_cat'])  ?>"	 value="Delete" class="btn btn-danger m-b-xs" >Delete</button>
		   
		   
		<button type="submit" name="submit_status" onClick="return confirm('Are you sure to mark record as Active?');"	 title="Mark&nbsp;<?php echo ucwords($ARR_PAGE_KEY['main_cat'])  ?>&nbsp; as Active" value="active" class="btn btn-success m-b-xs" >Mark Active</button>  
		<button type="submit" name="submit_status"  onclick="return confirm('Are you sure to mark record as Active?');" title="Mark&nbsp;<?php echo ucwords($ARR_PAGE_KEY['main_cat'])  ?>&nbsp; as Inactive" value="inactive" class="btn btn-warning m-b-xs" >Mark Inactive</button>
									   						      
									   <script type="text/javascript">
									   	function onDoubleClick(goUrl) {
										window.location.href =goUrl;
										
		         //  alert('Double click not allowed');
				    // return false;
                         /*if (timer) {
                     clearTimeout(timer);
                         timer = null;
                         }*/

}

function onSingleClick(goUrl) {
           window.location.href =goUrl; 
        /*  if (!timer)
        timer = setTimeout(function() { alert('Single'); }, 500);*/
		
		
		
		
}
									   </script>
								   
								   <table id="example" class="display table" style="width: 100%; cellspacing: 0;" >
                                        <thead>
                                            <tr>
                                                <th width="7%">
												S.No.
												</th>
                                             <!-- select all -->
											 
											  <th width="7%" style="text-align:center;"> Position </th>
										 
                                                
												 <th width="20%" style="text-align:center;"> Title </th>
												
												 <th width="25%" style="text-align:center;"> Detail </th>
												<!-- <th width="36%"> Product Details </th> -->
												
											    <th width="10%">Status</th>
												
												<th width="9%"> Added date </th>
												
												 <!--action -->
												<th width="20%"> Action </th>
                                            </tr>
                                        </thead>
										
										
                                        
										
										
                                        <tbody>
										
										<?  //  getResult  total?>
								   <?php //
								   
								   
								  
								     if($total>0){
									  
										 $i=1;
										while($line_data=mysql_fetch_assoc($getResult)){ 		
							  # $cat_details=mysql_fetch_assoc(mysql_query("SELECT cat_title from brand_categories where id='$catCode' "));
						
							   
										$imageRoot="../domain-images/"; # for view only Thumb
										 $request_class="label label-info";
							
										 #prodOffer
									  if($line_data['status']=='active')
									  $request_class="label label-success";
									  
									   if($line_data['status']=='inactive')
									   $request_class="label label-warning";
									   
									   
									   
										$string=$line_data['remark'];
											 $string=strip_tags($string);
											 $string = (strlen($string) > 200) ? substr($string,0,197).'...' : $string;
										
									    
									   
									   
								        #defaultImages
									
										$default_image="";	 $default_image=(!empty($line_data['image'])&&file_exists($imageRoot.$line_data['image']))?$imageRoot.$line_data['image']:"../notavailable.jpg";	
										#$string=$line_data['remark'];$string=strip_tags($string);
                  # $string = (strlen($string) > 200) ? substr($string,0,197).'...' : $string;
										?>
										
										    
									
										  
										    <tr>
                                                <td>
								<input type="checkbox" name="checkbox_id[]" value="<?php echo $line_data['id'];?>" style="width:15px;" />
												<?php echo $i.".";?>
												</td>
									
										
										<td > <?='Position:-'.$line_data['position']?> <br/>
										<? if($i!=1){?>
								<a href="<?=$_SERVER['PHP_SELF']."?up_id=".$line_data['id']?>" title="Up position of <?=ucwords($line_data['cat_title'])?>"><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i></a>&nbsp;&nbsp;<? }?>
								<? if($i!=$total){?>
				 <a href="<?=$_SERVER['PHP_SELF']."?down_id=".$line_data['id']?>" title="Down position of <?=ucwords($line_data['cat_title'])?>"> <i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i></a> <? }?>
										
										
										 </td>
										
										
										
										
										
										
										<td > <?=strtoupper($line_data['cat_title'])?> </td>
											
												 <td > <?=$string?>  </td>
												 
							
											
                                       
										 
												
								
											<td><span class="<?php echo $request_class;?>"><?=ucwords($line_data['status'])?></span></td>
											
												
												 <td><?php  echo ucwords($line_data['add_date']);?></td>
												
                                               
											   
										   
                                                <td>
<a class="btn btn-info m-b-sm" href="#editModal<?php echo $line_data['id'];?>" data-sfid='"<?php echo $line_data['id'];?>"' data-toggle="modal">View</a>

	<a id="link" href="javascript:void(0);" onClick="onSingleClick('<?=$_SERVER['PHP_SELF']."?del_id=".$line_data['id']?>'); return false;" onDblClick="onDoubleClick('<?=$_SERVER['PHP_SELF']?>'); return false;"> Delet it!</a>
 
 

             
 
	  <!--return confirm('Are you sure to mark record as Active?');  onDblClick="window.stop(); show_msg_box();" -->
	  

	
	  
	  
	<div class="modal fade" id="editModal<?php echo $line_data['id'];?>" tabindex="-2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                          
					  <h4 class="modal-title color-theme" id="myModalLabel"  align="center">
				        	 <?="&nbsp; Details "?> 
							  </h4>
					 
					 
															<hr/>
                                                        </div>
														
														
                                                        <div class="modal-body">
														
														
														
														
											
								
					
							
			 <p align="justify"><strong style="color:#6a5fac"> Title:&nbsp;</strong><?="Title"?> </p> 
			  
						  
						  
						  
						
						  
						  
						  
						   <p align="justify" style=" padding: 5% 5%;">
								
								</p>
								
								
								
		         
			                     
								 
								 
								 <p align="justify">
							      <span><strong> Detail</strong>:&nbsp;&nbsp;<?=$line_data['remark']?> </span>  <br/>  
								 
								
								
								  </p>
						
						  
						  
			 
			  
		                     <!-- <p align="justify"> </p>  -->
		 
									
									
									
									
									
									
									
									
						       <p align="justify"><strong>Added Date:</strong>&nbsp;&nbsp;<?php echo $line_data['add_date']?> </p>
										  
										  <?php if(!empty($line_data['mod_date'])){?>
										<p align="justify"><strong>Modified Date:</strong>&nbsp;&nbsp;<?php echo $line_data['mod_date']?> </p>
										<?php }  ?>			
													
													
												
													
														
														
                                                       
													   
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                       
	
	
	
   
   
									
									          </td>
                                            </tr>  
										  
										  <?php
										  
										  $i++;  }}
										  ?>
										 	
                                   
								   </tbody>
                                    </table> 
									   						      
									   
                                    </div>
                                </div>
                            </div>
							<!--- end rocord  listing--->
							</form>
              
			  
			  
			  
			  
			  
			  
			
                    
<!-----popUp model##---->                          
                           
	 <!-- Modal -->
	    
	 
	 
	 
	 
                                    					
						
							
                        </div>
                    </div><!-- Row -->
                </div><!-- Main Wrapper -->
              <?php include("./ugt-files/footer.php")?>
				
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
		
		
        <?php include("./ugt-files/footer-nav.php")?>
		
		
        <div class="cd-overlay"></div>
	

        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
        <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/plugins/pace-master/pace.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>
        <script src="assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="assets/plugins/classie/classie.js"></script>
        <script src="assets/plugins/waves/waves.min.js"></script>
        <script src="assets/plugins/3d-bold-navigation/js/main.js"></script>
        <script src="assets/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
        <script src="assets/plugins/moment/moment.js"></script>
        <script src="assets/plugins/datatables/js/jquery.datatables.min.js"></script>
        <script src="assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>
        <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="assets/js/modern.min.js"></script>
        <script src="assets/js/pages/table-data.js"></script>
        
    </body>


</html>