<?php 
include("database.php");
include("authentication.php");

$term_id=$_GET['term'];
$time_from=$_GET['time_from'];
$time_to=$_GET['time_to'];
 ?>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Master | Time Table</title>
</head>
<body>

						<?php 
						$st=mysql_query("select * from `school`");
						$ft=mysql_fetch_array($st);
						
						$school_name=$ft['school'];
						$school_address=$ft['address'];
						
						$st1=mysql_query("select `name` from `master_term` where `id`='$id'");
						$ft2=mysql_fetch_array($st1);
						$term_name=$ft2['name'];
						?>
								<h2 style="text-align:center"><?php echo $school_name; ?></h2>
								<h4 style="text-align:center"><?php echo $school_address; ?></h4>
								<h3 style="text-align:center">Time Table of - <?php echo $term_name; ?></h3>
								<table class="table table-striped table-bordered table-hover " width="100%" border="1">
								<caption style="text-align:center;">Exam Time From - <?php echo $time_from; ?> To -<?php echo $time_to; ?></caption>
								<thead>
									<tr>
										<th style="text-align:center;">
											 Date/Class
										</th>
										<?php
										$set=mysql_query("select * from `master_class`");
										while($fet=mysql_fetch_array($set))
										{
											$class_id=$fet['id'];
											$roman=$fet['roman'];
										?>
										<th style="text-align:center"  width="9%">
											 <?php echo $roman; ?>
										</th>
										<?php } ?>
									</tr>
								</thead>
								<tbody>
									<?php 
									$slt=mysql_query("select Distinct(date) from `time_table` where `term_id`='$term_id'");
									while($flt=mysql_fetch_array($slt)){ 
										$date=$flt['date'];
										$org_date=date('d-M-Y', strtotime($date));
									?>
									<tr>
										<td>
											<?php echo $org_date; ?>
										</td>
										<?php 
										$set1=mysql_query("select * from `master_class`");
										while($fet1=mysql_fetch_array($set1))
										{
											$class_id=$fet1['id'];	
										$set2=mysql_query("select * from `time_table` where `term_id`='$term_id' && `date`='$date' && `class_id`='$class_id'");
										$fet2=mysql_fetch_array($set2);
										
										$time_from=$fet2['time_from'];
										$time_to=$fet2['time_to'];
										$sub_id=$fet2['subject_id'];
										$subject_views=explode(',', $sub_id);
										 
										?>
										<th>
										<?php 
										foreach($subject_views as $subject_view)
										{
										$subject_id=$subject_view;
										$stl=mysql_query("select `subject` from `subject` where `id`='$subject_id'");
										$ftl=mysql_fetch_array($stl);
											echo $subject_name=$ftl['subject'];
											echo '<br>';
										} ?>
										
										</th>
										<?php } ?>
									</tr>
								<?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan='100'>
											<h3>Instructions</h3>
											<input type="text" ><br>
											<input type="text" ><br>
											<input type="text" ><br>
											<input type="text" ><br>
											<input type="text" ><br>
										</td>
									</tr>
								</tfoot>
							</table>
						
</body>
</html>