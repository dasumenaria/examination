<?php
include("database.php");
$user_id=$_GET['pon'];
 
?> 
			<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th style="text-align:center">
										 Sr.No
									</th>
									<th style="text-align:center">
										 Subject Name
									</th>
									 
									<th style="text-align:center">
										 Check All
										<div class="checkbox-list">
												 <span><input type="checkbox" class="chk_input" onclick="check();" value="0"></span>
										 </div>
									</th>
								</tr>
								</thead>
								<tbody>
						<?php
						
						
							$que=mysql_query("select * from `modules` ORDER BY `id`");
							while($fet=mysql_fetch_array($que))
							{$f++;
						
							$id=$fet['id'];
							$module_name=$fet['name'];
							$main_menu=$fet['main_menu'];
							
							 
							 $qt=mysql_query("select * from `user_settings` where `role_id`='$user_id' && `module_id`='$id'");
							 $count=mysql_fetch_array($qt);
						?>
						<tr>
							<td style="text-align:center">
								<?php echo $f; ?>
							</td>
							
							<td style="text-align: ">
								 <?php echo $module_name; ?> 
							</td>
							
							<td style="text-align:center">
								
								 <div class="checkbox-list">
                                         <span><input type="checkbox" class="all_chk" <?php if($count>0){ ?> checked="checked" <?php }?> name="check[]" value="<?php echo $id; ?>"></span>
								 </div>
							</td>
						</tr>	
							<?php } ?>
							
					</tbody>
				</table>
			 
			</div>
				
				
					<div class="form-actions top">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<button type="submit" name="sub" class="btn green">Submit</button>
								<button type="button" class="btn default">Cancel</button>
							</div>
						</div>
					</div>
						
							
	<script>
		var test = $("input[type=checkbox]:not(.toggle), input[type=radio]:not(.toggle)");
		if (test) {
		test.uniform();
		}
	</script>

							
							
							
							
							
							