<?php
$page = "collection";
include 'header.php';


$mode1=1;
$monthlyFee=$messages=$collectionDate=$lastInsertedDate=$penalty='';
if(isset($_POST['submit']))
{
	$studentId 		  = $_POST['studentList'];
    $lastInsertedDate = $_POST['hidden'];
    $penalty 	 	  = $_POST['penalty'];
	$mode        	  = $_POST['mode'];
	$monthlyFee       = $_POST['amount'];
	$month    	 	  = $_POST['month'];
	$messages     	  = $_POST['messages'];
	$collectionDate   = $_POST['collectionDate'];

	$getObj=array(
		'studentClassMappingId'=> $studentId,
		'lastInsertedDate' => $lastInsertedDate,
		'penalty'          => $penalty,
		// 'type'     	   => $_collection,
		'mode'     	       => $mode,	
		// 'admissionFee'     => $admissionFee,
		// 'othersFee'        => $othersFee,
		'amount'   	       => $monthlyFee,
		'month'  	       => $month,
		'messages' 	       => $messages,
		'collectionDate'   => $collectionDate,
	);	
	$getObj = (object) $getObj;
	$status=$master->addFeeCollection($getObj);
	// echo $status['test'];
	echo $master->showAlert($status['message']);

}
?>

<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
	  <li><i class="ace-icon fa fa-home home-icon"></i><a href="index.php">Home</a></li>
	  <li>Add Fee Collection</li>
	</ul>					
</div>

<div class="page-content">	
	<div class="row">
		<div class="col-md-12">
			
				
			<form class="form-horizontal" method="POST">	
				<div class="form-group col-md-4">
					<label class="col-md-4 control-label no-padding-right"> Session Name </label>
					<div class="col-md-8">
						
						<select class="form-control mycontrol class_session" name="sessionId">
			                <option value="Select Session">Select Session</option>
				                <?php 
				                global $id;
				                $sessionList = $master->getSession($id); 
				                if($sessionList['status']) { 
				                    foreach ($sessionList['sessionList'] as $session) {
				                    	global $sessionId;
				                    	?>
				                      <option value="<?php echo $session['id']; ?>" <?php if($sessionId==$session['id']) echo 'selected'; ?>><?php echo $session['sessionName']; ?></option>
				                  <?php } 
				               }?>                   
			            </select>
			       
					</div>
				</div>	
				<div class="form-group col-md-4">
					<label class="col-md-4 control-label no-padding-right"> Class Name </label>
					<div class="col-md-8">
					    <input type="hidden" value="2" id="paymentType">
						<select class="form-control mycontrol load_class" name="className">
						 <option>Select Session First</option>	
			                               
			            </select>
			        
					</div>
				</div>	
				<div class="form-group col-md-4 preStdent">
					<label class="col-md-4 control-label no-padding-right">Student Name</label>
					<div class="col-md-8">
						<select class="form-control mycontrol studentList" name="studentList" id="dropdown_id">
						 <option>Select Class First</option>	
						</select>
					</div>
				</div><!-- <div class="form-group col-md-4">
					<label class="col-md-4 control-label no-padding-right"> Student Name </label>
					<div class="col-md-8">
						<select class="form-control mycontrol admission_no1" name="admissionNumber" id="dropdown_id">                 
			            </select>
			        
					</div>
				</div> -->
				<div class="load_fee">
					
				</div>
				<div class="load_date1">
				
				</div>
				
				<!-- <div class="form-group col-md-4">
					<label class="col-md-4 control-label no-padding-right"> Type </label>
					<div class="col-md-8">
						<select class="form-control mycontrol" name="_collection" onchange='CheckColors(this.value);'>
							<!--  <option value="0">Select Type</option> -->
                            <!--<option value="<?php echo $type1; ?>" <?php if($type1) echo "selected"; ?>><?php echo $type1; ?></option>
                            <option value="<?php echo $type2; ?>" <?php if($type2) echo "selected"; ?>><?php echo $type2; ?></option>                            
                       </select>
					</div>
				</div> -->
				<div class="form-group col-md-4">
					<label class="col-md-4 control-label no-padding-right"> Mode </label>
					<div class="col-md-8">
						<select class="form-control mycontrol" name="mode" Id="dropdown1" onchange="chkind()">
                            <!-- <option value="0">Select Mode</option> -->
                            <option value="<?php echo $mode1; ?>" >Cash</option>
                            <option value="<?php echo $mode2; ?>" >Cheque</option>                    
                        </select>
					</div>
				</div>
				<div class="form-group col-md-4">
					<label class="col-md-4 control-label no-padding-right"> Message </label>
					<div class="col-md-8">
						<input type="text" id="textbox" name="messages" placeholder="Enter message" value="<?php echo $messages; ?>" />
					</div>
				</div><br>
				
				<!-- <div id="color" name="color" style='display:none;'>
				<div class="form-group col-md-4">
					<label class="col-md-4 control-label no-padding-right"> Admission Fee </label>
					<div class="col-md-8">
						<input type="text" name="admissionFee" placeholder="Enter Admission Fee" value="<?php echo $admissionFee; ?>" required="required" />
					</div>
				</div>
				<div class="form-group col-md-4">
					<label class="col-md-4 control-label no-padding-right"> Others Fee </label>
					<div class="col-md-8">
						<input type="text" name="othersFee" placeholder="Enter Other Amount" value="<?php echo $othersFee; ?>" />
					</div>
				</div>
			
				</div> -->
				<div class="form-group col-md-4">
					<label class="col-md-4 control-label no-padding-right"> No. of month </label>
					<div class="col-md-8">
						<select class="form-control mycontrol" name="month">     
						<!-- <option value="">Select month</option>          -->
                            <?php 
                            for($month1=1;$month1<=12;$month1++){
                            	?>
                            	<option value="<?php echo $month1; ?>"><?php echo $month1; ?></option>
                            	<?php
                            }
                            ?>
                        </select>
					</div>
				</div>		
				
				<div class="form-group col-md-4">
					<label class="col-md-4 control-label no-padding-right" for="id-date-picker-1">Collection Date</label>
					<div class="col-md-8">
						<div class="input-group">
							<input name="collectionDate" class="form-control date-picker" id="id-date-picker-1" type="text" data-date-format="yyyy-mm-dd" value="<?php echo $collectionDate; ?>" />
							<span class="input-group-addon">
								<i class="fa fa-calendar bigger-110"></i>
							</span>
						</div>
					</div>
				</div>

				<div class="clearfix"></div>
				<div class="clearfix form-actions">
					<div class="col-md-offset-3 col-md-9">
						<input class="btn btn-info" type="submit" name="submit" value="Submit">	
					</div>
				</div>
			</form>		
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


<script type="text/javascript">
$(document).ready(function(){
$(document).on('change','.studentList',function(){
var IDa = $(this).val();
// alert(ID);
$.ajax({
type:'POST',
url:'auto-load-monthlyFee.php',
data:'scmId='+IDa,
success:function(html){
$('.load_date1').html(html);

}
});

});
});
</script>

<?php 
include 'footer.php';
?>
