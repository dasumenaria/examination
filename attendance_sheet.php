<?php
include("database.php");
  $class=$_GET['cls'];
  $section=$_GET['sec'];
  $subject=$_GET['sub'];
  $exam_name=$_GET['exm'];
   
  $sect=0;
  
  if($class>10){
	  
	  $sect_id=$section;
  }
  
 $ster=mysql_query("select `roman` from `class` where `id`='$class'");
$fter=mysql_fetch_array($ster); 

$cl_name=$fter['roman'];

$ster1=mysql_query("select `section` from `section` where `id`='$section'");
$fter1=mysql_fetch_array($ster1); 

$se_name=$fter1['section'];
 
$ster2=mysql_query("select `subject` from `subject` where `id`='$subject'");
$fter2=mysql_fetch_array($ster2); 
 

  // file name for download
 $filename="Class-$cl_name-$se_name-$su_name";
header ("Expires: 0");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . "GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=".$filename.".csv");
header ("Content-Description: Generated Report" );
  
		if($exam_name==1){
				$fct="S.No.,Roll No,Student Name,Scholar no,Attendance,Term-I";
		}
			if($exam_name==2){
					$fct="S.No.,Roll No,Student Name,Scholar no,Attendance,Final-Term";
			}
		$last;
 

	
	 $qwq=$fct;
 
 
$qwq.="\n";


 						 $query=mysql_query("select * from `student` where `class_id`='$class' && `section_id`='$section' order By `name`");
						 while($fets=mysql_fetch_array($query))
						 {$f++;
							  $roll_no=$fets['roll_no'];
						      $scholar_no=$fets['scholar_no'];
							  $student_name=$fets['name'];
 						$query7=mysql_query("select `subject` from `subject` where `id`='$subject'");
						$fet7=mysql_fetch_array($query7);
							
							$subject_name=$fet7['subject'];

				 
				$qwq.="$f,$roll_no,$student_name,$scholar_no,Attendance";
				 			
					
					 
								$qwq.="\n";
						 
							 			
						 }
  						
echo $qwq;
?>

 