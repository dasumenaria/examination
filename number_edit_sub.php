<?php
include("index_layout.php");
include("database.php");
include("authentication.php");

$class_id=$_GET['cls'];
$section_id=$_GET['sec'];
$exam_id=$_GET['exm'];
$subject=$_GET['subject'];
$cat_id=$_GET['cat'];

$subjects=explode(',', $subject);

 	$subject_id=$subjects[0];
 	$sub_subject_id=$subjects[1];
	$sect_id=$section_id;
 
 ?>
<html >
<head>
<?php ?>
<style>
td{
	border: 1px solid #ddd;
	
}
th{
	border: 2px solid #ddd;
	
}
tr{
	border: 1px solid #ddd;
	
}
.table-bordered {
    border: 1px solid #ddd;
	
	
}
.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
}
.table {
    background-color: transparent;
}
.table {
    border-spacing: 0;
    border-collapse: collapse;
	    white-space: normal;
    line-height: normal;
    font-weight: normal;
    font-size: medium;
    font-variant: normal;
    font-style: normal;
    color: -webkit-text;
    text-align: start;
	    display: table;
}

</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit | Subject</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<?php css(); ?>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>


</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body style="background-color:#FFF;">
<!-- BEGIN HEADER -->

<!-- BEGIN CONTAINER -->
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	
		<div class="page-content">
			<div class="row">
				<div class="col-md-12">
					<?php 
		$cl=mysql_query("select `roman` from `master_class` where `id`='$class_id'");
		$sf=mysql_fetch_array($cl);
		
		$cl_romn=$sf['roman'];
		
		$cl1=mysql_query("select `section` from `master_section` where `id`='$section_id'");
		$sf1=mysql_fetch_array($cl1);
		
		$sc_name=$sf1['section'];
		?>
		
		
			<div class="portlet box pink">
			<div class="portlet-title">
				<div class="caption"  style="text-align:center;">
					<h3 color="black" style="background-color:#0078D7 !important;"><center><i class="icon-puzzle"></i> Edit Detail Of Class: <?php echo $cl_romn; ?> and Section: <?php echo $sc_name; ?></center></h3>
				</div>
			</div>
			<div class="portlet-body form">
			<!-- BEGIN FORM-->
			
				<input type="hidden" name="cls" value="<?php echo $class_id; ?>">
				<input type="hidden" name="sec" value="<?php echo $section_id; ?>">
				<input type="hidden" name="exm" value="<?php echo $exam_id; ?>">
					<div class="form-body">
						 
						 <div class="table-responsive">
								<table id="user" class="table table-bordered table-striped">
								<thead>
								<tr>
									<th rowspan='3'>
										 Sr.no
									</th>
									<th rowspan='3'>
										 Name
									</th>
									<?php 
									 
									$qry=mysql_query("select `subject_id` from `subject_allocation` where `class_id`='$class_id' && `section_id`='$sect_id' && `elective`='0' && `subject_id`='$subject_id'");
									$frq=mysql_fetch_array($qry);
									
										$sub_id=$frq['subject_id'];
										
										$st=mysql_query("select `subject` from `subject` where `id`='$sub_id'");
										$ft=mysql_fetch_array($st);
										
										$sub_name=$ft['subject'];
										
										$slt=mysql_query("select `name` from 	`master_sub_subject` where `id`='$sub_subject_id'");
										$flt=mysql_fetch_array($slt);
										
										$sub_subject_name=$flt['name'];
										$col=0;
										$qt=mysql_query("select `exam_category_type_id` from `exam_mapping` where `class_id`='$class_id' && `section_id`='$sect_id' && `subject_id`='$sub_id' && `sub_subject_id`='$sub_subject_id' && `term_id`='$exam_id' && `exam_category_id`='$cat_id'");
									while($fqt=mysql_fetch_array($qt))
									{$col++;
										$exam_type_id=$fqt['exam_category_type_id'];
										 
									}
									
									?>
									
									<th style="text-align:center" colspan="<?php echo $col; ?>">
										 <?php echo $sub_name; ?><?php if(!empty($sub_subject_name)){ echo '-'.$sub_subject_name; } ?>
 									</th>
									 
									
									
									
										<?php 
									 
									$qry1=mysql_query("select `elective` from `subject_allocation` where `class_id`='$class_id' && `section_id`='$sect_id' && `subject_id`='0' && `elective`='$subject_id'");
									$frq1=mysql_fetch_array($qry1);
									$count_elective=mysql_num_rows($qry1);
									if($count_elective > 0 )
									{
										  $elec_id=$frq1['elective'];
										
										$st1=mysql_query("select `subject` from `subject` where `id`='$elec_id'");
										$ft1=mysql_fetch_array($st1);
										
										  $elec_name=$ft1['subject'];
										  
										  $slt1=mysql_query("select `name` from 	`master_sub_subject` where `id`='$sub_subject_id'");
										$flt=mysql_fetch_array($slt1);
										
										$sub_subject_name=$flt1['name'];
										$col=0;
										$qt1=mysql_query("select `exam_category_type_id` from `exam_mapping` where `class_id`='$class_id' && `section_id`='$sect_id' && `subject_id`='$elec_id' && `sub_subject_id`='$sub_subject_id' && `term_id`='$exam_id' && `exam_category_id`='$cat_id'");
									while($fqt1=mysql_fetch_array($qt1))
									{$col++;
										   $exam_type_id=$fqt1['exam_category_type_id'];
										 
									}
									
									
									?>
									
									<th style="text-align:center" colspan="<?php echo $col; ?>">
										<?php echo $elec_name; ?><?php if(!empty($sub_subject_name)){ echo '-'.$sub_subject_name; } ?>
									</th>
									 <?php } ?> 
								</tr>
								<!--------------------NEW---CONCEPT------------------------>
								<tr>
								<?php 
								
								$slt=mysql_query("select * from `exam_category` where `id`='$cat_id'");
								$flt=mysql_fetch_array($slt);
								
								$category_name=$flt['name'];
								?>
								<th style="text-align:center" colspan="100">
								<?php echo $category_name; ?>
								</th>
								
								</tr>
								<!------------END-----NEW----COncept------------------------>
								
								
								<tr>
								
								<?php 
								
									$qry=mysql_query("select `subject_id` from `subject_allocation` where `class_id`='$class_id' && `section_id`='$sect_id' && `elective`='0' && `subject_id`='$subject_id'");
									$frq=mysql_fetch_array($qry);
									
										$sub_id=$frq['subject_id'];
										
								$qt=mysql_query("select `exam_category_type_id` from `exam_mapping` where `class_id`='$class_id' && `section_id`='$sect_id' && `subject_id`='$sub_id' && `sub_subject_id`='$sub_subject_id' && `term_id`='$exam_id' && `exam_category_id`='$cat_id'");
									while($fqt=mysql_fetch_array($qt))
									{
										$exam_type_id=$fqt['exam_category_type_id'];
										
										$query=mysql_query("select * from `exam_category_type` where `id`='$exam_type_id'");
										$fetc=mysql_fetch_array($query);

										$Exam=$fetc['Exam'];
										  
										?> 
									<th style="text-align:center">
										 <?php echo $Exam; ?>

										 

									</th>
										<?php } ?>
									
									
									
								<?php 
								
									$qry1=mysql_query("select `elective` from `subject_allocation` where `class_id`='$class_id' && `section_id`='$sect_id' && `subject_id`='0' && `elective`='$subject_id'");
									$frq1=mysql_fetch_array($qry1);
									
										$elec_id=$frq1['elective'];
										
								$qt1=mysql_query("select `exam_category_type_id` from `exam_mapping` where `class_id`='$class_id' && `section_id`='$sect_id' && `subject_id`='$elec_id' && `sub_subject_id`='$sub_subject_id' && `term_id`='$exam_id' && `exam_category_id`='$cat_id'");
									while($fqt1=mysql_fetch_array($qt1))
									{
										  $exam_type_id1=$fqt1['exam_category_type_id'];
										
										$query1=mysql_query("select * from `exam_category_type` where `id`='$exam_type_id1'");
										$fetc1=mysql_fetch_array($query1);

										  $Exam=$fetc1['Exam'];
										
										?>
									 
									<th style="text-align:center">
										 <?php echo $Exam; ?>

									</th>
										<?php }?>
								
								</tr>
								</thead>
								<tbody>
									
								<?php 
								$w=0;
								
									$qr=mysql_query("select * from `student` where `class_id`='$class_id' && `section_id`='$section_id' ORDER BY `name`");
									while($fr=mysql_fetch_array($qr))
									{$w++;
									$schlr_id=$fr['id'];
									$scholar_no=$fr['scholar_no'];
									$name=$fr['name'];
									?>
									<tr>
									<td><?php echo $scholar_no; ?></td>
									<td><?php echo $name; ?></td>
								<?php
									$qry=mysql_query("select `subject_id` from `subject_allocation` where `class_id`='$class_id' && `section_id`='$sect_id' && `elective`='0' && `subject_id`='$subject_id' && `sub_subject_id`='$sub_subject_id'");
									$frq=mysql_fetch_array($qry);
									
										$sub_id=$frq['subject_id'];
										
										$st=mysql_query("select `subject` from `subject` where `id`='$sub_id'");
										$ft=mysql_fetch_array($st);
										
										$sub_name=$ft['subject'];
										$col=0;
										 
										$qt=mysql_query("select `exam_category_type_id`,`max_marks` from `exam_mapping` where `class_id`='$class_id' && `section_id`='$sect_id' && `subject_id`='$sub_id' && `sub_subject_id`='$sub_subject_id' && `term_id`='$exam_id' && `exam_category_id`='$cat_id'");
									while($fqt=mysql_fetch_array($qt))
									{$col++;
										$exam_type_id=$fqt['exam_category_type_id'];
										$max_marks=$fqt['max_marks'];
									  
									$qst=mysql_query("select `id` from `exam_category_type` where `id`='$exam_type_id'");
									$fst=mysql_fetch_array($qst);
									
									$retrive_type=$fst['id'];
									$value_sub=0;
										 
									$query=mysql_query("select `id`,`marks` from `student_marks` where `scholar_no`='$scholar_no' && `term_id`='$exam_id' && `subject_id`='$sub_id' && `sub_subject_id`='$sub_subject_id' && `master_exam_type_id`='$exam_type_id' && `exam_category_id`='$cat_id'");
									$fetch=mysql_fetch_array($query);
									
									 $value_sub=$fetch['marks'];

									?>
									
									<td style="text-align:center">
										
 <a href="#" class="number" max="<?php echo $max_marks; ?>" stdnt_id="<?php echo $fetch['id']; ?>" stdnt_sub="<?php echo $retrive_type; ?>" data-type="text" data-pk="1" data-original-title="Enter Number"><?php if(!empty($value_sub)){ echo $value_sub;} else{ echo"-";} ?></a>
									</td>
									 
										<?php } ?>
										
			<?php	///////////////////////////////////////ELECTIVE	./////////////////////	?>				
										
										
										
							<?php  
							
 									$qry1=mysql_query("select `elective` from `subject_allocation` where `class_id`='$class_id' && `section_id`='$sect_id' && `subject_id`='0' && `elective`='$subject_id'");
									$frq1=mysql_fetch_array($qry1);
									
										   $sub_id=$frq1['elective'];
										  
										  
										$qwer=mysql_query("select * from `elective` where `subject_id`='$sub_id' && `scholar_id`='$scholar_no'");
										$count=mysql_num_rows($qwer);
										
										$st1=mysql_query("select `subject` from `subject` where `id`='$sub_id'");
										$ft1=mysql_fetch_array($st1);
										
										$sub_name=$ft1['subject'];
										$col=0;
										$qt=mysql_query("select `exam_category_type_id`,`max_marks` from `exam_mapping` where `class_id`='$class_id' && `section_id`='$sect_id' && `subject_id`='$sub_id' && `sub_subject_id`='$sub_subject_id' && `term_id`='$exam_id' && `exam_category_id`='$cat_id'");
									while($fqt=mysql_fetch_array($qt))
									{$col++;
										$exam_type_id=$fqt['exam_category_type_id'];
										 
										  $max_marks=$fqt['max_marks'];
										
										  
									$qst=mysql_query("select `id` from `exam_category_type` where `id`='$exam_type_id'");
									$fst=mysql_fetch_array($qst);
									
									$retrive_type=$fst['id'];
									$value_sub=0;
								 		$query=mysql_query("select `marks`,`id` from `student_marks` where `scholar_no`='$scholar_no' && `term_id`='$exam_id' && `subject_id`='$sub_id' && `sub_subject_id`='$sub_subject_id' && `master_exam_type_id`='$exam_type_id' && `exam_category_id`='$cat_id'");
									$fetch=mysql_fetch_array($query);
									
									   $value_sub=$fetch['marks'];
									?>
									
									<td style="text-align:center">
									<?php if($count>0){ ?>
										 <a href="#" class="number" max="<?php echo $max_marks; ?>" stdnt_id="<?php echo $fetch['id']; ?>" stdnt_sub="<?php echo $retrive_type; ?>" data-type="text" <?php if($count>0){} else { ?> disabled <?php } ?> data-pk="1" data-original-title="Enter Number"><?php echo $value_sub; ?></a>
									<?php } else { ?> <?php } ?>	
									</td>
									 
										<?php } ?></tr><?php }?>
										
									 
								</tbody>
								</table>
							</div>
						 
						 
					</div>
					

				
			</div>
				<!-- END FORM-->
				</div>
			</div>
			
			<!-- END PAGE CONTENT-->
		</div>
	
	<!-- END CONTENT -->
	
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 2016 &copy; PHPPoets IT Solutions Pvt Ltd.
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->

<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- BEGIN PLUGINS USED BY X-EDITABLE -->

<script type="text/javascript" src="assets/global/plugins/moment.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery.mockjax.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js"></script>
<!-- END X-EDITABLE PLUGIN -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/form-editable.js"></script>
<script>

function check(){
		var max=$(this).closest('td').find('a').attr('max');
	
}

jQuery(document).ready(function() {
// initiate layout and plugins
Metronic.init(); // init metronic core components
FormEditable.init();

	$('.editable-submit').live('click', function(e){
		var id=$(this).closest('td').find('a').attr('stdnt_id');
		var sub_column=$(this).closest('td').find('a').attr('stdnt_sub');
		var number=$(this).closest('form').find('input').val();
		//var max=$(this).closest('td').find('a').attr('max');
 		$.ajax({
				url: "update_marks.php?id="+id+"&sub_column="+sub_column+"&number="+number,
			});
	});
	
	
	
	$('form input[type=text]').live('keyup', function(e){
		var inputtxt=  $(this).val();
		var numbers =  /^[0-9ATML]*\.?[0-9]*$/;
		if(inputtxt.match(numbers))  
		{}else  
		{  
			$(this).val('');
			return false;  
		}
		
		var no=eval($(this).val());
		 var max=eval($(this).closest('td').find('a').attr('max'));
		 var value=eval($(this).closest('td').find('a').text());

		  if(max<no)
		 {
			 $(this).val(value);
		 }
		 else if('AB'==no || 'M'==no || 'T'==no || no=='0' || 'L'==no)
		 {
			 
		 }
 
		 
	});
});
</script>
<?php //scripts(); ?>
<!-- END PAGE LEVEL SCRIPTS -->
</body>
<!-- END BODY -->
</html>