<?php 
echo $useragent=$_SERVER['HTTP_USER_AGENT']; exit;
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
{
	echo "Mobile";
}
else
{
	echo "Dasktop";
}
exit;	

include("index_layout.php"); 
include("database.php");
include("authentication.php");

if(isset($_POST['submit_sec_change']))
{
	$update_id=$_POST['update_id'];
	$name=$_POST['name'];
	$roll_no=$_POST['roll_no'];
 	$gallery_pic=$_FILES["upload_image"]["tmp_name"];
 	$file_name=$_FILES["upload_image"]["name"];
	/* echo"<pre>";
	print_r($gallery_pic); exit;
	print_r($update_id); exit;
	echo"</pre>"; */
	
	$dob=$_POST['dob'];
	$new_sec=$_POST['new_sec'];
	$t=0;
	
	
	foreach($update_id as $updates_id)
	{
		echo $updates_id; exit;
		$fileacutal_name=$file_name[$t];
		$Studntname=$name[$t];
		$imageupdated=$gallery_pic[$t];
 		$Studntroll_no=$roll_no[$t];
		$Studntdob=$dob[$t];
		$Studntnew_sec=$new_sec[$t];
 		if(!empty($Studntdob))
		{
			$Studntdob=date('Y-m-d',strtotime($Studntdob));	
		}
		if(!empty($imageupdated))
		{
			$file_name='student'.$updates_id;  
 			$target ="user/";
			
  			@$ext = pathinfo($fileacutal_name,  PATHINFO_EXTENSION); 
 			$random=rand(100, 10000);
			$target=$target.basename($file_name.'.'.$ext);
			move_uploaded_file($imageupdated,$target);
			 
			$item_image=$file_name.'.'.$ext;  
			echo "update `student` set `name`='$Studntname' ,`roll_no`='$Studntroll_no',`dob`='$Studntdob',`section_id`='$Studntnew_sec','photo_path'='$item_image' where `id` = '$updates_id'"; exit;
			mysql_query("update `student` set `name`='$Studntname' ,`roll_no`='$Studntroll_no',`dob`='$Studntdob',`section_id`='$Studntnew_sec','photo_path'='$item_image' where `id` = '$updates_id'");
 		}
		else
		{
 			mysql_query("update `student` set `name`='$Studntname' ,`roll_no`='$Studntroll_no',`dob`='$Studntdob',`section_id`='$Studntnew_sec' where `id` = '$updates_id'");
 		}
		$t++;
	}
}		
		
?>
<html>
<head>
<?php css();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Index</title>
</head>
<?php contant_start(); menu();  ?>
<body>
	<div class="page-content-wrapper">
		 <div class="page-content">
			 <div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-puzzle"></i> Student Section Change
				</div>
			</div>			 
			<div class="portlet-body">
				<div class="table-responsive">
				<form method="post" enctype="multipart/form-data">
					<table width="80%" style="text-align:center">
					<tr>
					<td width="40%">Enter Class</td>
					<td width="60%">
					<select name="class" class="form-control input-medium" id="autocomplete_class"  onchange="show_secc_change()">
					<option value=""> -Select-</option>
					<?php
							$resultx=mysql_query("SELECT * FROM `master_class`");
							while($rowc=mysql_fetch_array($resultx))
							{
							 $clsss=$rowc['class'];
							  $clsss_id=$rowc['id'];
							?>
					<option value="<?php echo $clsss_id; ?>"> <?php echo $clsss; ?></option>
					<?php } ?>
					</select>
					 </td>
					 </tr>
					 </table>
					<span  class="hide_print" id="list_rol_sc"></span>
					<span id="list_stddl_sec"></span>
				 
				</form>
								
				</div>
			</div>
		</div>
	</div>
</div>
</body>

<?php footer();?>
<script>
	function show_secc_change()
	{  
		var c1=$('#autocomplete_class').val(); 
		var query="?con=" + encodeURIComponent(c1);
		$('#list_rol_sc').load('stdnt_sec_chng_all.php'+query)   
	}
	function std_edit_sec()
	{
		var c1=$('#cls').val(); 
		var c2=$('#autocomplete_section').val(); 
		var query="?con=" + encodeURIComponent(c1) + "&con1=" + encodeURIComponent(c2);
		$('#list_stddl_sec').load('std_dtl_section.php'+query); 
	}
	function auto_roll_no()
	{ 
		var first_roll=eval($("#start_roll_no").val());
		var std_cnt=eval($("#tot_student").val());
		for(var i=1;i<=std_cnt;i++)	
		{
			$("#roll_no"+ i).val(first_roll) ;	
			first_roll=eval(first_roll + 1) ;
		}
	}
</script>
<?php scripts();?>

</html>
