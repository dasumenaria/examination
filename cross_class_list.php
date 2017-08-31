<?php 
include("index_layout.php"); 
include("database.php");
include("authentication.php");

$class_id=$_GET['cls'];

$st=mysql_query("select * from `school`");
$ft=mysql_fetch_array($st);
$school=$ft['school'];
$address=$ft['address'];

$st2=mysql_query("select `roman` from `master_class` where `id`='$class_id'");
$ft2=mysql_fetch_array($st2);
$class_name=$ft2['roman'];

?>

<html>
<head>
<?php css();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Index</title>
<style>
.table>thead>tr>th{
	font-size:12px !important;
}

 @media print
   {
     .printdata{
		 display:none;
	 }
   }

</style>
</head>
<?php contant_start(); menu();  ?>
<body>
	<div class="page-content-wrapper">
		 <div class="page-content">
			 
			 <div class="portlet box blue">
			<div class="portlet-title printdata">
				<div class="caption">
					<i class="icon-puzzle"></i> Roll No List
				</div>
			</div>			 
		 
			<div class="portlet-body">
				<div class="table-responsive">
				<p id="list_roll_stdnt">
					<div >
						<h2 align="center"><?php echo $school; ?></h3>
						<h4 align="center"><?php echo $address; ?></h4>
						<h3 align="center">Class - <?php echo $class_name; ?></h3>
					<br>
						<table style="text-align:center;font-size:13px;" class="table table-bordered" width="100%" align="left">
							<thead>
								<tr>
									<th>Sr.No</th>
									<th>Scholar No</th>
									<th>Roll No</th>
									<th>Student Name</th>
									<th>Father's Name</th>
									<th>Section</th>
									<th>Attendance</th>
									<th>Marks</th>
									<th>Percentage</th>
									<th>Status</th>
									<th>Remark</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$set=mysql_query("select * from `student` where `class_id`='$class_id'");
								while($fet=mysql_fetch_array($set))
								{
									$i++;
									$roll_no=$fet['roll_no'];
									$scholar_no=$fet['scholar_no'];
									$name=$fet['name'];
									$father_name=$fet['father_name'];
									$section_id=$fet['section_id'];
									
									$st3=mysql_query("select `section` from `master_section` where `id`='$section_id'");
									$ft3=mysql_fetch_array($st3);
									$section_name=$ft3['section'];

									$set2=mysql_query("select * from `student_result` where `class_id`='$class_id' && `section_id`='$section' && `roll_no`='$roll_no' && `scholar_no`='$scholar_no'");
									$fet2=mysql_fetch_array($set2);
									$total_marks_obtained=$fet2['total'];
									$total_marks=$fet2['total_marks'];
									$percentage=$fet2['per'];
									$status=$fet2['status'];
									$final_status=$fet2['final_status'];
									if($final_status=='Pass'){
										$count_promote++;
									}
									$set3=mysql_query("select `attendance` where `scholar_no`='$scholar_no'");
									$fet3=mysql_fetch_array($set3);
									
									$attendance=$fet3['attendance'];
									?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $scholar_no; ?></td>
										<td><?php echo $roll_no; ?></td>
										<td><?php echo $name; ?></td>
										<td><?php echo $father_name; ?></td>
										<td><?php echo $section_name; ?></td>
										<td><?php echo $attendance; ?></td>
										<td><?php echo $total_marks_obtained; ?></td>
										<td><?php echo $percentage; ?></td>
										<td><?php echo $status; ?></td>
										<td><?php echo $final_status; ?></td>
									</tr>
								<?php } ?>
							</tbody>
							 
						</table>
						<br>
						
					<table class="table" border="0">
					<tbody>
						<tr>
							<td>Promoted</td>
							<td><?php echo $count_promote; ?></td>
							<td></td>
							<td></td>
							<td>Exam Incharge</td>
							<td></td>
						</tr>
						<tr>
							<td>Promoted</td>
							<td></td>
							<td></td>
							<td></td>
							<td>Principal</td>
							<td></td>
						</tr>

						<tr>
							<td>Promoted</td>
							<td></td>
							<td></td>
							<td></td>
							<td>Prepared</td>
							<td></td>
						</tr>
					</tbody>
					</table>
					</div>
				</div>
			</div>
		 </div>
	</div>
</body>

<?php footer();?>
<?php scripts();?>

</html>
