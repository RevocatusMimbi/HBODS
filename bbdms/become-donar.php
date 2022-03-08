<?php
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit']))
{
    $fullname = $_POST['fullname'];
    $mobile = $_POST['mobileno'];
    $email = $_POST['emailid'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $blodgroup = $_POST['bloodgroup'];
    $address = $_POST['address'];
    $pwd = $_POST['pwd'];
    $img = "";
    $organ = 1;
    $age = floor((time() - strtotime($dob))/31556926);
    $now = date("Y-m-d H:i:s");
    if ($_POST['donate'] == 2){
        $organ = $_POST['organ'];
    }


    if (empty($_FILES["img"]["name"])){
        $img = "blood-donar.jpg";
    }else{
        $img = $_FILES["img"]["name"];
        $tgt = "images/".basename($_FILES['img']['name']);
        $ext = strtolower(pathinfo($tgt, PATHINFO_EXTENSION));
        $uploadOk = 1;

        if($ext != "jpg" && $ext!="png" && $ext != "jpeg" && $ext != "gif"){
            move_uploaded_file($_FILES['img']['tmp_name'], $tgt);
        }
    }


    $sql="INSERT INTO `tblblooddonars` (`id`, `FullName`, `MobileNumber`, `EmailId`, `Gender`, `Age`, `BloodGroup`, `Address`, `JoiningDate`, `status`, `dob`, `Password`, `OrganType`, `Image`) VALUES (NULL, '$fullname', '$mobile', '$email', '$gender', '$age', '$blodgroup', '$address', '$now', 1, '$dob', '$pwd', '$organ', '$img')";
    if(mysqli_query($con, $sql))
    {
    $msg = "Your info submitted successfully";
    }
    else 
    {
    $error = "Something went wrong. Please try again";
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Human Blood Organ Donation System | Become A Donar</title>
    <link rel="stylesheet" href="admin/css/font-awesome.min.css">
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="admin/css/fileinput.min.css">
	<link rel="stylesheet" href="admin/css/awesome-bootstrap-checkbox.css">
    <link href="css/modern-business.css" rel="stylesheet">
    <style>
    .navbar-toggler {
        z-index: 1;
    }
    
    @media (max-width: 576px) {
        nav > .container {
            width: 100%;
        }
    }
    </style>
        <style>
    .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
    </style>


</head>

<body>

<?php include('includes/header.php');?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Become a <small>Donor</small></h1>

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Become a Donor</li>
        </ol>
            <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }  
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
        <!-- Content Row -->
        <form class="mb-3" onsubmit="return confirmpass(this)" enctype="multipart/form-data" name="donar" method="post">
<div class="row">
<div class="col-lg-4 mb-4">
<div class="font-italic">Full Name<span style="color:red">*</span></div>
<div><input type="text" name="fullname" class="form-control" required></div>
</div>
<div class="col-lg-4 mb-4">
<div class="font-italic">Mobile Number<span style="color:red">*</span></div>
<div><input type="text" name="mobileno" class="form-control" required></div>
</div>
<div class="col-lg-4 mb-4">
<div class="font-italic">Email Id</div>
<div><input type="email" name="emailid" class="form-control" required></div>
</div>
</div>

<div class="row">
<div class="col-lg-4 mb-4">
<div class="font-italic">Date of Birth<span style="color:red">*</span></div>
<div><input type="date" name="dob" class="form-control" required max="<?php echo date('Y-m-d') ?>" min="1900-01-01"></div>
</div>


<div class="col-lg-4 mb-4">
<div class="font-italic">Gender<span style="color:red">*</span></div>
<div><select name="gender" class="form-control" required>
<option value="">Select</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
</select>
</div>
</div>

<div class="col-lg-4 mb-4">
<div class="font-italic">Blood Group<span style="color:red">*</span> </div>
<div>
<select class="form-control" required id="blood" name="blodgroup">
    <option value="">Select Blood type.</option>
    <option value="A+">A+</option>
    <option value="A-">A-</option>
    <option value="B+">B+</option>
    <option value="B-">B-</option>
    <option value="AB+">AB+</option>
    <option value="AB-">AB-</option>
    <option value="O+">O+</option>
    <option value="O-">O-</option>
</select>
</div>
</div>
</div>
<div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="font-italic" for="donate">Donate:<span style="color:red">*</span> </label><br>
                                            <input type="radio" name="donate" id="donateB" value="1" required> Blood &nbsp;
                                            <input type="radio" name="donate" id="donateO" value="2"> Organ
                                            <input type="text" name="bd" value="NULL" hidden>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="font-italic" for="organ">Organ type:</label>
                                            <select class="form-control" required id="organ" name="organ">
                                            <?php $sql = "SELECT * from  organ_type WHERE `oid`>1";
                                                $query = $dbh -> prepare($sql);
                                                $query->execute();
                                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt=1;
                                                if($query->rowCount() > 0)
                                                {
                                                foreach($results as $result)
                                                {               ?>  
                                                <option value="<?php echo htmlentities($result->oid);?>"><?php echo htmlentities($result->oname);?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <!-- new Row -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="font-italic" for="pwd">Password:<span style="color:red">*</span></label>
                                            <input type="password" name="pwd" class="form-control" id="pwd" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="font-italic" for="cpwd">Confirm password:<span style="color:red">*</span></label>
                                            <input type="password" name="cpwd" class="form-control" id="cpwd" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- new Row -->

<div class="row">
<div class="col-lg-4 mb-4">
<div class="font-italic">Address</div>
<div><textarea class="form-control" name="address" required></textarea></div>
</div>

<!-- new Row -->

<div class="col-lg-4 mb-4">
<div class="font-italic">Profile Picture</div>
<div><input type="file" class="form-control file" name="img" > </div>
</div>
</div>

<!-- new Row -->

<button type="submit" class="btn btn-primary ml-3" data-toggle="tooltip" name="submit" title="click here to submit."><i class="fa fa-upload"></i> Submit</button>
<input type="reset" value="reset" class="btn btn-danger">
        <!-- /.row -->
</form>   
        <!-- /.row -->
</div>
  <?php include('includes/footer.php');?>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/js/myjs.js"></script>

</body>

<script>
    $(document).ready(function(){
       
        //radio buttons
        $("#donateB").click(function(){
            if($(this).prop("checked"))  $("#organ").attr("disabled", "disabled");
            $("#organ").val("NULL");
        });
        $("#donateO").click(function(){
            if($(this).prop("checked"))  $("#organ").removeAttr("disabled", "disabled");
        });
    });
</script>

</html>
