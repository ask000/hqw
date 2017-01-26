<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Add Event | Ultimate Bootstrap Forms</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta http-equiv="pragma" content="no-cache">
    <META HTTP-EQUIV="Expires" CONTENT="-1">
    <!-- bootstrap 3.3.7 -->
    <!--global css starts-->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="css/ionicons.min.css" />

    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <!--global css end-->
    <!--page level css starts-->
    <link type="text/css" rel="stylesheet" href="vendors/daterangepicker/daterangepicker.css" />
    <link type="text/css" rel="stylesheet" href="vendors/select2/css/select2.min.css">
    <link rel="stylesheet" href="vendors/bootstrap_select2/css/select2-bootstrap.min.css">
    <link rel="stylesheet" href="vendors/sweetalert2/dist/sweetalert2.min.css">
    <link type="text/css" rel="stylesheet" href="vendors/bootstrapvalidator/dist/css/bootstrapValidator.min.css"/>
    <link type="text/css" rel="stylesheet" href="vendors/bootstrap-tags/dist/bootstrap-tagsinput.css" />
    <link type="text/css" rel="stylesheet" href="vendors/datetimepicker/css/bootstrap-datetimepicker.min.css" />
    <link type="text/css" rel="stylesheet" href="css/blue_skin.css" />
    <link type="text/css" rel="stylesheet" href="css/custom.css" />
    <!--page level css end-->
</head>

<body>
<?php
$event_titleErr = $event_typeErr = $event_durationErr = $commentsErr = "";
$event_title = $event_type = $event_duration = $comments = "";

 if($_SERVER["REQUEST_METHOD"]== "POST"){
	 if (empty($_POST["event_title"])){
		$event_titleErr = "Please enter Event title";
		}else{
		$event_title=test_input($_POST["event_title"]);	
		}
		
	 if (empty($_POST["event_type"])){
		 $event_typeErr = "please enter Event type";
	 }else{
		 $event_type = test_input($_POST["event_type"]);
	 }
	 
	 if (empty($_POST["event_duration"])){
		 $event_durationErr = "please enter Event duration";
	 }else{
		$event_duration = test_input($_POST["event_duration"]); 
	 }	
	 
	 if (empty($_POST["comments"])){
		 $commentsErr = "please enter comments";
	 }else{
		 $comments = test_input($_POST["comments"]);
	 }
	 

 }
 
 function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
if(!empty($_POST["event_title"])&& !empty($_POST["event_type"])&& !empty($_POST["event_duration"])&& !empty($_POST["comments"])) {

    mysqli_connect("localhost", "root", "");
    mysqli_select_db("u_forms");
    mysqli_query("insert addevent_tbl values('','$event_title','$event_type','$event_duration','$comments')");
}else{ echo "";
}
 
?>

<div class="container">
    <div class="row ">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <!--panel title-->
                    <div class="panel-title"><i class="ion-calendar icon_header"></i> Add Event</div>
                </div>
                <div class="panel-body">
                    <div id="container_demo">
                        <div id="wrapper">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  autocomplete="on" method="post" id="event-form">
                                <div class="form-group">
                                    <label for="InputTitle"><i class="field_icon ion-edit"></i>Event Title</label>
                                    <input type="text"  name="event_title" class="form-control content" id="InputTitle" placeholder="" >
                                    <span class="error"><?php echo $event_titleErr;?></span>
                                </div>
                                <div class="form-group for_select">
                                    <label for="EventType" class="without_icon">Event Type</label>
                                    <select class="form-control addevent content" style="width: 100%" id="EventType" name="event_type">
                                        <option selected disabled>Select</option>
                                        <option value="team">Team Level</option>
                                        <option value="asiatic">Asiatic Black Bear</option>
                                        <option value="brown">Brown Bear</option>
                                        <option value="giant">Giant Panda</option>
                                        <option value="sloth">Sloth Bear</option>
                                    </select>
                                    <span class="error"><?php echo $event_typeErr;?></span>
                                </div>
                                <div class="form-group picker">
                                    <label for="EventDuration"><i class="field_icon ion-calendar"></i>Event Duration</label>
                                    <input type="text"  name="event_duration" class="form-control dob content" id="EventDuration" placeholder="MM/DD/YYYY HH:MM AM - MM/DD/YYYY HH:MM AM" readonly >
                                    <span class="error"><?php echo $event_durationErr;?></span>
                                </div>
                                <div class="half-right-space">
                                    <div class="form-group for_select">
                                        <label for="RemindBy" class="without_icon">Remind By</label>
                                        <select class="form-control addevent content" id="RemindBy" name="remindby" style="width: 100%" >
                                            <option selected disabled>Select</option>
                                            <option value="mail">Mail</option>
                                            <option value="sms">SMS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="half-left-space">
                                    <div class=" form-group for_select">
                                        <label for="RemindBefore" class="without_icon">Remind Before</label>
                                        <select class="form-control addevent content" id="RemindBefore" name="remindbefore" style="width: 100%" >
                                            <option selected disabled>Select</option>
                                            <option value="1">1 Hour</option>
                                            <option value="6">6 Hours</option>
                                            <option value="1day">1 Day</option>
                                            <option value="2day">2 Days</option>
                                            <option value="1week">1 Week</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message" ><i class="field_icon ion-compose"></i> Comments</label>
                                    <textarea class="form-control content" rows="3" id="message" name="comments"  style="resize: none"></textarea>
                                    <span class="error"><?php echo $commentsErr;?></span>
                                </div>
                                <div class="form-group">
                                    <label for="tags" class="without_icon">Send Invitation To</label>
                                    <input type="text"  class="form-control" name="mails" id="tags" value="iamguest@g3.com,iamguestas@g4.com" data-role="tagsinput" />
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Submit" class="btn btn-lg btn-block btn-primary result" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- global js start-->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- global js end -->
<!--page level js starts-->
<script type="text/javascript" src="vendors/moment/moment.min.js"></script>
<script type="text/javascript" src="vendors/bootstrap-tags/dist/bootstrap-tagsinput.min.js"></script>
<script type="text/javascript" src="vendors/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="vendors/bootstrapvalidator/dist/js/bootstrapValidator.js"></script>
<script type="text/javascript" src="vendors/select2/js/select2.min.js"></script>
<script type="text/javascript" src="vendors/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="vendors/iCheck/icheck.min.js"></script>
<script type="text/javascript" src="vendors/sweetalert2/dist/sweetalert2.min.js"></script>
<script type="text/javascript" src="js/addevent.js"></script>
<!--page level js end-->
</body>

</html>

<?php

	
?>
