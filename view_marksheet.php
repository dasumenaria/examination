<?php
include_once('database.php');
require_once("marksheet_function.php");

	$scholar_no=$_GET['sch'];
	$class_id=$_GET['cls'];
	$section_id=$_GET['sec'];
	$exam_name=$_GET['exm'];
	$term_id=$exam_name;
	
$set=mysql_query("select `name` from `master_term` where `id`='$exam_name'");
	$fet=mysql_fetch_array($set);
	$term=$fet['name'];

	$prmt_id=$class_id+1;
$sset=mysql_query("select `roman` from `master_class` where `id`='$prmt_id'");
	$sfet=mysql_fetch_array($sset);
	$promt_class=$sfet['roman'];
	
	 
$CuttentStatust=mysql_query("select `roman` from `master_class` where `id`='$class_id'");
	$FtcCuttentStatust=mysql_fetch_array($CuttentStatust);
	$CurrentClass=$FtcCuttentStatust['roman'];
  
  
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<title>Marksheet</title>
	<style>
    .a1
    {width: 1000px; height: auto; border: 1px solid; font-family: Arial, Helvetica, sans-serif; page-break-after:always;
    }
	.center_align {	text-align:center; }
    table
    {
		border-collapse:collapse;
    }
    div
    {
		border-collapse:collapse;
    }
	.header_font
	{
		font-weight:bold;
		font-size:15px;
	}
	.header_sub
	{
		font-weight:bold;
		font-size:13px;
	}
    </style>
</head>
<!-- BEGIN BODY -->
<body>
	<?php 
    //** Find Elevtive Subject In array
	$stdunt=mysql_query("select `id`,`roll_no`,`name` from `student` where `class_id`='$class_id' && `section_id` = '$section_id' && `scholar_no`='$scholar_no'");
    $ftc_stdunt=mysql_fetch_array($stdunt);
	$id=$ftc_stdunt['id'];
	$StudentRollNo=$ftc_stdunt['roll_no'];
	$StudentName=$ftc_stdunt['name'];
 		$stdunt_elev=mysql_query("select `subject_id` from `elective` where `scholar_id`='$scholar_no'");
		while($fte_elev=mysql_fetch_array($stdunt_elev))
		{
			$sub_id_1[]=$fte_elev['subject_id'];
		}
	//**/ END of Elecative Subject 
	//* Header Started
		 ?>
<div class="a1">
   		<?php header_info_CBA($id,$exam_name);?><br>
  
	<!-- Header End ---> 
    <table width="100%"  cellspacing="0px" height="300" cellpadding="0px" border="1">
         <tr class="header_font">
         	<th rowspan="3">S.No</th>
            <th height="33"  width="22%" style="margin-left:5px">Subject / Exam</th>
				<?php 
                $st=mysql_query("select DISTINCT(term_id) from `master_architecture` where `marksheet_term_id`='$term_id' && `class_id`='$class_id' && `section_id`='$section_id'");
                while($ft=mysql_fetch_array($st))
                {
                    $heading_term=$ft['term_id'];
                    $st3=mysql_query("select `name` from `master_term` where `id`='$heading_term'");
                    $ft3=mysql_fetch_array($st3);
                    $heading_name=$ft3['name'];
					$colspan=0;
					$category_wisecolumn=mysql_query("select * from `master_architecture` where `marksheet_term_id`='$term_id' && `class_id`='$class_id' && `section_id`='$section_id'");
					while($ftc_categorywise=mysql_fetch_array($category_wisecolumn))
					{
						$categoryidd=$ftc_categorywise['category_id'];	
 						$st4=mysql_query("select DISTINCT(exam_category_id) from `exam_mapping` where `class_id`='$class_id' && `section_id`='$section_id' && `term_id`='$heading_term' && `exam_category_id` = '$categoryidd' ORDER BY `exam_category_id`");
						$countexam_mapping=mysql_num_rows($st4);
						if($countexam_mapping>0)
						{	
							while($ft4=mysql_fetch_array($st4))
							{	$colspan++;
								$find_id=$ft4['exam_category_id'];
								$st7=mysql_query("select `name` from `exam_category` where `id`='$find_id'");
								$ft7=mysql_fetch_array($st7);
								$category_name=$ft7['name'];
							} 	
						}
						else
						{ for($x=0; $x<$countArchitecure; $x++){echo"<td></td>";}}
					}
					?>
					<th colspan="<?php echo $colspan; ?>"><b><?php echo $heading_name; ?></b></th>
					<?php
                }
                ?>	
            <th>Total</th>
			<th rowspan="3">Grade</th>
        </tr>
        <tr>
        	<td class="header_font" height="30px" align="center"><strong>Maximum</strong></td>
            <?php 
				$totalMx=0;
                $st=mysql_query("select DISTINCT(term_id) from `master_architecture` where `marksheet_term_id`='$term_id' && `class_id`='$class_id' && `section_id`='$section_id'");
                while($ft=mysql_fetch_array($st))
                {
                    $heading_term=$ft['term_id'];
                    $st3=mysql_query("select `name` from `master_term` where `id`='$heading_term'");
                    $ft3=mysql_fetch_array($st3);
                    $heading_name=$ft3['name'];
					$category_wisecolumn=mysql_query("select * from `master_architecture` where `marksheet_term_id`='$term_id' && `class_id`='$class_id' && `section_id`='$section_id'");
					while($ftc_categorywise=mysql_fetch_array($category_wisecolumn))
					{
						$categoryidd=$ftc_categorywise['category_id'];
 						$st4=mysql_query("select DISTINCT(exam_category_id),`max_marks` from `exam_mapping` where `class_id`='$class_id' && `section_id`='$section_id' && `term_id`='$heading_term' && `exam_category_id` = '$categoryidd' ORDER BY `exam_category_id`");
						$countexam_mapping=mysql_num_rows($st4);
						if($countexam_mapping>0)
						{	
							while($ft4=mysql_fetch_array($st4))
							{
								$max_marks=$ft4['max_marks'];
								$totalMx+=$max_marks;
								
						} 
					?><td align="center"><strong><?php echo $max_marks; ?></strong></td>
					<?php						
					}
					else
					{for($x=0; $x<$countArchitecure; $x++){echo"<td></td>";}}
					}
                }
                ?>
            <td align="center"><strong><?php echo $totalMx;?></strong></td>
        </tr>
        <tr>
        	<td height="30px" class="header_font" align="center"><strong>Minimum</strong></td>
             <?php 
			 	
                $st=mysql_query("select DISTINCT(term_id) from `master_architecture` where `marksheet_term_id`='$term_id' && `class_id`='$class_id' && `section_id`='$section_id'");
                while($ft=mysql_fetch_array($st))
                {
                    $heading_term=$ft['term_id'];
                    $st3=mysql_query("select `name` from `master_term` where `id`='$heading_term'");
                    $ft3=mysql_fetch_array($st3);
                    $heading_name=$ft3['name'];
					$category_wisecolumn=mysql_query("select * from `master_architecture` where `marksheet_term_id`='$term_id' && `class_id`='$class_id' && `section_id`='$section_id'");
					while($ftc_categorywise=mysql_fetch_array($category_wisecolumn))
					{
						$categoryidd=$ftc_categorywise['category_id'];	
 						$st4=mysql_query("select DISTINCT(exam_category_id) from `exam_mapping` where `class_id`='$class_id' && `section_id`='$section_id' && `term_id`='$heading_term' && `exam_category_id` = '$categoryidd' ORDER BY `exam_category_id`");
						$countexam_mapping=mysql_num_rows($st4);
						if($countexam_mapping>0)
						{	
							while($ft4=mysql_fetch_array($st4))
							{
 								?>
								<td></td>
								<?php
						    } 	
						}
						else
						{for($x=0; $x<$countArchitecure; $x++){echo"<td></td>";}}
						}
                	}
                ?>
            <td></td>
        </tr>
        
        
       
        	<?php 
 			$OverAllTotalGetMarks=0;
			$OverAllTotalMaxMarks=0;
			$Result=0;
			$FailedInSubSubject=array();
			$FaildInSubject=array();
			///*- SUVJECT ALLOCSTYION LOOP
			$SNo=0;
 			$FindSubject=mysql_query("select * from `subject_allocation` where `class_id`='$class_id'  && `section_id`='$section_id'");
			while($ftc_subject=mysql_fetch_array($FindSubject))
			{
				$SNo++;
				$subject_id=$ftc_subject['subject_id'];
				if(empty($subject_id))
				{
					$subject_id=$ftc_subject['elective'];
					
					$ElectiveQuery=mysql_query("select * from `elective` where `scholar_id`='$scholar_no' && `subject_id`='$subject_id'");
					$ElectiveQueryCount=mysql_num_rows($ElectiveQuery);
					if($ElectiveQueryCount==0)
					{
						continue;
					}
						
				}
				$sub_subject_id=$ftc_subject['sub_subject_id'];
				
				$qry=mysql_query("select `subject`,`elective`,`grade` from `subject` where `id`='$subject_id'");
				$fet=mysql_fetch_array($qry);
				$subject=$fet['subject'];
				$grade=$fet['grade'];
				
				$qtr=mysql_query("select `name` from `master_sub_subject` where `id`='$sub_subject_id'");
				$ftr=mysql_fetch_array($qtr);
				$sub_subject_name=$ftr['name'];
				
				if($grade=='G')
				{
					continue;
				}
				?>
                 <tr>
                 	<th><?php echo $SNo; ?></th>
                    <th height="33" width="8%" class="header_sub" style="margin-left:5px"><?php echo $subject; if(!empty($sub_subject_name)){ ?>-<?php echo $sub_subject_name; } ?></th> 
                <?php
					$TotalMaxMarks=0;
					$TotalGetMarks=0;
					$forCOl=0;
 				//* Architacher Loop
					$ArchitacherQuery=mysql_query("select DISTINCT(term_id) from `master_architecture` where `marksheet_term_id`='$term_id' && `class_id`='$class_id' && `section_id`='$section_id'");
					while($ftc_ArchitacherQuery=mysql_fetch_array($ArchitacherQuery))
					{
						$ftc_ArchitacherQueryTerm_id=$ftc_ArchitacherQuery['term_id'];
						
						$total_one=0;
						$category_wisecolumn=mysql_query("select * from `master_architecture` where `marksheet_term_id`='$term_id' && `class_id`='$class_id' && `section_id`='$section_id'");
						while($ftc_categorywise=mysql_fetch_array($category_wisecolumn))
						{
							$categoryidd=$ftc_categorywise['category_id'];
							$exam_category_query=mysql_query("select DISTINCT(exam_category_id) from `exam_mapping` where `class_id`='$class_id' && `section_id`='$section_id' && `term_id`='$ftc_ArchitacherQueryTerm_id' && `subject_id`='$subject_id' && `sub_subject_id`='$sub_subject_id' && `exam_category_id` = '$categoryidd' ORDER BY `exam_category_id` ASC");
							$Countexam_category_query=mysql_num_rows($exam_category_query);
							while($exam_category_Fetch=mysql_fetch_array($exam_category_query))
							{
								$FetchExamCategoryId=$exam_category_Fetch['exam_category_id'];
								$TotalOneSubject=0;
								$TotalOneSubjectMax=0;
								//** Exam Mapping Table ------- FInd Exam Category TYpe
								$exam_categoryTYpe_query=mysql_query("select `exam_category_type_id`,`max_marks` from `exam_mapping` where `class_id`='$class_id' && `section_id`='$section_id' && `term_id`='$ftc_ArchitacherQueryTerm_id' && `subject_id`='$subject_id' && `sub_subject_id`='$sub_subject_id' && `exam_category_id`='$FetchExamCategoryId' ORDER BY `exam_category_id` ASC");
								while($exam_categoryType_Fetch=mysql_fetch_array($exam_categoryTYpe_query))
								{
									$exam_category_type_id=$exam_categoryType_Fetch['exam_category_type_id'];
									$MainMaxMarks=$exam_categoryType_Fetch['max_marks'];
									// Count Total Max Marks One subject and Overall
									$TotalMaxMarks+=$MainMaxMarks;
									$TotalOneSubjectMax+=$MainMaxMarks;
									$OverAllTotalMaxMarks+=$MainMaxMarks;
					 
									$StudentMarksQuery=mysql_query("select * from `student_marks` where `scholar_no`='$scholar_no' && `term_id`='$ftc_ArchitacherQueryTerm_id' && `exam_category_id`='$FetchExamCategoryId' && `subject_id`='$subject_id' && `sub_subject_id`='$sub_subject_id' && `master_exam_type_id` = '$exam_category_type_id'");
									$FetchStudentMarks=mysql_fetch_array($StudentMarksQuery);
									$SubjectMarks=$FetchStudentMarks['marks'];
									// Count Total Get Marks One subject and Overall
									$TotalGetMarks+=$SubjectMarks;
									$TotalOneSubject+=$SubjectMarks;
									$OverAllTotalGetMarks+=$SubjectMarks;
								}
								?>
								<th><?php echo $TotalOneSubject;//.'( '.$TotalOneSubjectMax.' )'; ?> </th>
							<?php
							$forCOl++;
							}
 						}
					}
					//** END Exam Mapping Table ------- FInd Exam Category 
 						$MinumumPassingPercentage=(($TotalMaxMarks/100)*33);
						if($TotalGetMarks<$MinumumPassingPercentage)
						{
							$Result+=1;
							$FailedInSubSubject[]=$sub_subject_id;
							$FaildInSubject[]=$subject;
						}
						?>
                         	<th><?php echo $TotalGetMarks;//.'( '.$TotalMaxMarks.' )'; ?></th>
                        <?php
						//** FInd Grade
						if($TotalGetMarks==0 || $TotalMaxMarks==0){$GetOneSubjectPercentage=0;}
						else
						{
							$GetOneSubjectPercentage=(($TotalGetMarks/$TotalMaxMarks)*100);
						}
						
						if($GetOneSubjectPercentage>=75)
						{  
							$DistInSubject[]=$subject;
						}
							$GradeQuery=mysql_query("select `grade` from `master_grade` where `class_id`='$class_id' && `section_id`='$section_id' && `range_from`<='$GetOneSubjectPercentage' && `range_to`>='$GetOneSubjectPercentage'");
							$FtcGradeQuery=mysql_fetch_array($GradeQuery);
							$grade=$FtcGradeQuery['grade'];
						?>
                            <th><?php echo $grade;  ?></th>
						</tr>
						<?php
					 
				//* END  Architacher Loop
 			}
 			///*- END SUVJECT ALLOCSTYION LOOP
			?>
             <tr>
                <th style="height:35px" colspan="<?php echo $forCOl+2;?>">Grand Total</th>
                <th width="14%" style="color:#F00"><?php echo $OverAllTotalGetMarks; ?>/<?php echo $OverAllTotalMaxMarks; ?></th>
				<td>-</td>
            </tr>
 		<?php 
			
			
//--- Grading Subject
		$SNo=0;
		$SubjectDataQuery=mysql_query("select * from `subject` where `grade`='G'");
		while($FtcSubjectDataQuery=mysql_fetch_array($SubjectDataQuery))
		{
			$SubjectIdGrade=$FtcSubjectDataQuery['id'];
 			$FindSubject=mysql_query("select * from `subject_allocation` where `class_id`='$class_id'  && `section_id`='$section_id' && `subject_id` = '$SubjectIdGrade'");
			while($ftc_subject=mysql_fetch_array($FindSubject))
			{
				$SNo++;
				$subject_id=$ftc_subject['subject_id'];
				if(empty($subject_id))
				{
					$subject_id=$ftc_subject['elective'];
				}
				$sub_subject_id=$ftc_subject['sub_subject_id'];
				
				$qry=mysql_query("select `subject`,`elective`,`grade` from `subject` where `id`='$subject_id'");
				$fet=mysql_fetch_array($qry);
				$subject=$fet['subject'];
				$grade=$fet['grade'];
				
				$qtr=mysql_query("select `name` from `master_sub_subject` where `id`='$sub_subject_id'");
				$ftr=mysql_fetch_array($qtr);
				$sub_subject_name=$ftr['name'];
				
				 	 
				 
				?>
                 <tr>
                 	<th><?php echo $SNo; ?></th>
                    <th height="33" width="8%" style="margin-left:5px"><?php echo $subject; if(!empty($sub_subject_name)){ ?>-<?php echo $sub_subject_name; } ?></th> 
                <?php
					 $TotalMaxMarks=0;
						$TotalGetMarks=0;
 				//* Architacher Loop
					$ArchitacherQuery=mysql_query("select DISTINCT(term_id) from `master_architecture` where `marksheet_term_id`='$term_id' && `class_id`='$class_id' && `section_id`='$section_id'");
					while($ftc_ArchitacherQuery=mysql_fetch_array($ArchitacherQuery))
					{
						$ftc_ArchitacherQueryTerm_id=$ftc_ArchitacherQuery['term_id'];
						
						$total_one=0;
						$category_wisecolumn=mysql_query("select * from `master_architecture` where `marksheet_term_id`='$term_id' && `class_id`='$class_id' && `section_id`='$section_id'");
						while($ftc_categorywise=mysql_fetch_array($category_wisecolumn))
						{
							$categoryidd=$ftc_categorywise['category_id'];
							$exam_category_query=mysql_query("select DISTINCT(exam_category_id) from `exam_mapping` where `class_id`='$class_id' && `section_id`='$section_id' && `term_id`='$ftc_ArchitacherQueryTerm_id' && `subject_id`='$subject_id' && `sub_subject_id`='$sub_subject_id' && `exam_category_id` = '$categoryidd' ORDER BY `exam_category_id` ASC");
							$Countexam_category_query=mysql_num_rows($exam_category_query);
							while($exam_category_Fetch=mysql_fetch_array($exam_category_query))
							{
								$FetchExamCategoryId=$exam_category_Fetch['exam_category_id'];
								$TotalOneSubject=0;
								$TotalOneSubjectMax=0;
								//** Exam Mapping Table ------- FInd Exam Category TYpe
								$exam_categoryTYpe_query=mysql_query("select `exam_category_type_id`,`max_marks` from `exam_mapping` where `class_id`='$class_id' && `section_id`='$section_id' && `term_id`='$ftc_ArchitacherQueryTerm_id' && `subject_id`='$subject_id' && `sub_subject_id`='$sub_subject_id' && `exam_category_id`='$FetchExamCategoryId' ORDER BY `exam_category_id` ASC");
								while($exam_categoryType_Fetch=mysql_fetch_array($exam_categoryTYpe_query))
								{
									$exam_category_type_id=$exam_categoryType_Fetch['exam_category_type_id'];
									$MainMaxMarks=$exam_categoryType_Fetch['max_marks'];
									// Count Total Max Marks One subject and Overall
									$TotalMaxMarks+=$MainMaxMarks;
									$TotalOneSubjectMax+=$MainMaxMarks;
									$OverAllTotalMaxMarks+=$MainMaxMarks;
					 
									$StudentMarksQuery=mysql_query("select * from `student_marks` where `scholar_no`='$scholar_no' && `term_id`='$ftc_ArchitacherQueryTerm_id' && `exam_category_id`='$FetchExamCategoryId' && `subject_id`='$subject_id' && `sub_subject_id`='$sub_subject_id' && `master_exam_type_id` = '$exam_category_type_id'");
									$FetchStudentMarks=mysql_fetch_array($StudentMarksQuery);
									$SubjectMarks=$FetchStudentMarks['marks'];
									// Count Total Get Marks One subject and Overall
									$TotalGetMarks+=$SubjectMarks;
									$TotalOneSubject+=$SubjectMarks;
									$OverAllTotalGetMarks+=$SubjectMarks;
								}
								?>
								<th><?php echo $TotalOneSubject;//.'( '.$TotalOneSubjectMax.' )'; ?> </th>
							<?php
							}
 						}
					}
					//** END Exam Mapping Table ------- FInd Exam Category 
 					?>
                         	<th><?php echo $TotalGetMarks;//.'( '.$TotalMaxMarks.' )'; ?></th>
                    <?php
						//** FInd Grade
						if($TotalGetMarks==0 || $TotalMaxMarks==0){$GetOneSubjectPercentage=0;}
						else
						{
							$GetOneSubjectPercentage=(($TotalGetMarks/$TotalMaxMarks)*100);
						}
					 
						$GradeQuery=mysql_query("select `grade` from `master_grade` where `class_id`='$class_id' && `section_id`='$section_id' && `range_from`<='$GetOneSubjectPercentage' && `range_to`>='$GetOneSubjectPercentage'");
						$FtcGradeQuery=mysql_fetch_array($GradeQuery);
						$grade=$FtcGradeQuery['grade'];
						?>
                            <th><?php echo $grade;  ?></th>
						</tr>
						<?php
					 
				//* END  Architacher Loop
 			}
		}
		?>
        </table>
		 
        <!---- Maximum Rows---->
        
		
		
        <!----End Maximum Rows---->
		<table width="100%" >
			<tr>
				<td width="63%">
					<table width="100%"  cellspacing="0px" cellpadding="0px" border="1">
						<tr>
							 <th style="height:55px" >Report B - Attendance</th>
							 <?php 
							$st=mysql_query("select DISTINCT(term_id) from `master_architecture` where `marksheet_term_id`='$term_id' && `class_id`='$class_id' && `section_id`='$section_id'");
							while($ft=mysql_fetch_array($st))
							{
								$heading_term=$ft['term_id'];
								$st3=mysql_query("select `name` from `master_term` where `id`='$heading_term'");
								$ft3=mysql_fetch_array($st3);
								$heading_name=$ft3['name'];
								?>
								<th ><?php echo $heading_name; ?></th>
								<?php
							}
							?>
							<th>Over All</th>
						 </tr>
						 <tr>
							<th style="height:55px" >Number of Meetings</th>
							<?php 
							$totalAttend=0;
							$st=mysql_query("select DISTINCT(term_id) from `master_architecture` where `marksheet_term_id`='$term_id' && `class_id`='$class_id' && `section_id`='$section_id'");
							while($ft=mysql_fetch_array($st))
							{
								$heading_term=$ft['term_id'];
								$st3=mysql_query("select `max_attendance` from `attendance` where `term`='$heading_term' && `scholar_no`='$scholar_no'");
								$ft3=mysql_fetch_array($st3);
								$max_attendance=$ft3['max_attendance'];
								$totalAttend+=$max_attendance;
								?>
								<th><?php echo $max_attendance; ?></th>
								<?php
							}
							?>
							<th><?php echo $totalAttend;?></th>
						 </tr>
						 <tr>
							<th style="height:55px" >No. of Meetings <br> on work present</th>
							<?php 
							$totalAttendP=0;
							$st=mysql_query("select DISTINCT(term_id) from `master_architecture` where `marksheet_term_id`='$term_id' && `class_id`='$class_id' && `section_id`='$section_id'");
							while($ft=mysql_fetch_array($st))
							{
								$heading_term=$ft['term_id'];
								$st3=mysql_query("select `attendance` from `attendance` where `term`='$heading_term' && `scholar_no`='$scholar_no'");
								$ft3=mysql_fetch_array($st3);
								$attendance=$ft3['attendance'];
								$totalAttendP+=$attendance;
								?>
								<th><?php echo $attendance; ?></th>
								<?php
							}
							?>
							<th><?php echo $totalAttendP;?></th>
						 </tr>
						 <tr>
							<th style="height:55px" >Percentage</th>
							<?php 
							$totalAttendP=0;
							$totalAttendPGET=0;
							$st=mysql_query("select DISTINCT(term_id) from `master_architecture` where `marksheet_term_id`='$term_id' && `class_id`='$class_id' && `section_id`='$section_id'");
							while($ft=mysql_fetch_array($st))
							{
								$heading_term=$ft['term_id'];
								$st3=mysql_query("select `attendance`,`max_attendance` from `attendance` where `term`='$heading_term' && `scholar_no`='$scholar_no'	");
								$ft3=mysql_fetch_array($st3);
								$attendance=$ft3['attendance'];
								$max_attendance=$ft3['max_attendance'];
								$totalAttendP+=$attendance;
								$totalAttendPGET+=$max_attendance;
								$GetPercentageAttend=(($attendance/$max_attendance)*100);
								?>
								<th><?php echo round($GetPercentageAttend , 2 ); ?>%</th>
								<?php
							}
							$GetPercentageAttendOverAll=(($totalAttendP/$totalAttendPGET)*100);
							?>
							<th><?php echo round($GetPercentageAttendOverAll , 2);?>%</th>
						 </tr>
					</table>
				</td>
				<td width="35%">
					<table  width="100%" border="1" cellspacing="0" cellpadding="0" style="text-align:center" >
                         
                        <?php
						 //** Calculate Percentage
							$GetPercentage=(($OverAllTotalGetMarks*100)/$OverAllTotalMaxMarks);
							$OverAllPersentage=number_format($GetPercentage,2);
						//*** Check Fail Or Promote
						//FailedInSubSubject    FaildInSubject
						if($Result=='0')
						{
							$status="Promoted to Class ".$promt_class;
							$Promotion=$promt_class;
							$FinalStatusOfResult="Pass";
						}
						else if($Result=='1')
						{   
							$c=0;
							$FinalStatusOfResult="Supplementary";
							$StatusOfSubSubject='';
							$DistSubject='';
							foreach($FaildInSubject as $sub)
							{
								$FailedInSubSubject[$c];
								$DistInSubject[$c];
								$DistInSubSubject[$c];
								if($FailedInSubSubject[$c]!='')
								{
									$StatusOfSubSubject=$sub.'('.$FailedInSubSubject[$c].')';
								}
								else
								{
									$StatusOfSubSubject=$sub;
								}
								//-- DIST
							}
							$status=$StatusOfSubSubject;
							$Compartment=$StatusOfSubSubject;
						} 
						else if($Result>1)
						{
							$status="Detained in Class ".$CurrentClass;
							$Detained=$CurrentClass;					
							$FinalStatusOfResult="Fail";
							$c=0;
							foreach($FaildInSubject as $sub)
							{
								$FailedInSubSubject[$c];
								if($FailedInSubSubject[$c]!='')
								{
									$sub.'('.$FailedInSubSubject[$c].')';
								}
								else
								{
									$sub;
								}
 							}
						} 
						else {}
					//-//*** End Check Fail Or Promote
					
					//*** Student Result Table ENtry
						mysql_query("delete from `student_result` where `scholar_no`='$scholar_no' && `roll_no`='$StudentRollNo' && `class_id`='$class_id' && `section_id`='$section_id' && `term_id`='$term_id'");
						
						if($FinalStatusOfResult=='Pass')
						{
							$next_class=$prmt_id;
						}
						else
						{
							$next_class=$class_id;
						}
						mysql_query("insert into `student_result` SET `class_id`='$class_id',`section_id`='$section_id',`roll_no`='$StudentRollNo',`scholar_no`='$scholar_no',`status`='$status',`final_status`='$FinalStatusOfResult',`per`='$OverAllPersentage',`total`='$OverAllTotalGetMarks',`term_id`='$term_id',`total_marks`='$OverAllTotalMaxMarks',`next_class_id`='$next_class'");
						
						?>
						<tr>
                            <td style="text-align:left;height:43px; width:50%; padding-left:15px;">Result</td>	
                            <td><b><?php echo $FinalStatusOfResult; ?></b></td>	
                        </tr>
						<tr>
                            <td style="text-align:left; height:44px; padding-left:15px;">Compartment</td>
                            <td><?php $Compartment;?></td>
                        </tr>
						<tr>
                            <td style="text-align:left; height:44px; padding-left:15px;">Detained in</td>
                            <td><?php echo $Detained;?></td>
                        </tr>
						<tr>
                            <td style="text-align:left; height:44px; padding-left:15px;">Compartment Result</td>
                            <td>-</td>
                        </tr>
						<tr>
                            <td style="text-align:left; height:43px; padding-left:15px;">Promotion Granted to</td>
                            <td><?php echo $Promotion;?></td>
                        </tr>
                     </table>
				</td>
			<tr>
		</table>
		<table width="100%" height="240" border="1"  cellspacing="0" cellpadding="0"  >
            <tr>
                <th width="50%" colspan="2">Final Report</th>
				<th width="50%"><?php echo $status; ?></th>
			</tr>
            <tr>
                <th width="50%" colspan="2">DISTINCTION</th>
				<th width="50%"><?php if(!empty($DistInSubject)){ echo implode(' , ',$DistInSubject);}?></th>
			</tr>
			<tr>
			<?php
				if($OverAllPersentage<45)
				{
					$Division='III';
				}
				if($OverAllPersentage>=45 && $OverAllPersentage<=59)
				{
					$Division='II';
				}
				if($OverAllPersentage>=60)
				{
					$Division='I';
				}
				?>
				<td style="text-align:left; padding-left:15px;" >Division</td>
				<td style="text-align:left; padding-left:10px;"><span style="color:#F00;"><b><?php echo $Division; ?> </b></span></td>
				<td></td>
			</tr>
			<tr>
				<td style="text-align:left; padding-left:15px;">Percentage </td>
				<td style="text-align:left; padding-left:10px;"><span style="color:#F00"><b><?php echo $OverAllPersentage; ?> %</b></span></td>
				<td></td>
			</tr>
			<tr>
                <td style="text-align:left; padding-left:15px;">Rank</th>
				<td></th>
				<td></td>
			</tr>
		</table>
		<table width="100%"   border="0"  cellspacing="0" cellpadding="0"  >
            <tr>
                <th height="100px" width="25%">image  </th>
                <th width="25%">image </th>
                <th width="25%">image </th>
                <th width="25%">image </th>
			</tr>
			 <tr>
                <th height="10px" width="25%">Class Teacher</th>
                <th width="25%">Examination incharge</th>
                <th width="25%">School Seal</th>
                <th width="25%">Sign of Principal</th>
			</tr>
			 
		</table>
		
		
		
    
    
</div>
</body>
</html>
