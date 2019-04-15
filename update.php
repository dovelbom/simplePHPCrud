<?php
 require_once('database.php');
 $tnumber = $_GET['task_number'];
 $res = $database->read($tnumber);
 
 
 if($res['status']=='failed'){
    echo $res['errorMessage'];
 }
 else
 {
 $r = mysqli_fetch_assoc($res['data']);
 if(isset($_POST) & !empty($_POST)){
	 $tname = $database->sanitize($_POST['tname']);
	 

    $res = $database->update($tname,$tnumber);      
	if($res){
		 echo "Successfully updated data";
		 header('location: view.php');
	}else{
	 	echo "failed to update data";
	}
  }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" href="styles.css" >
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Dov's project</title>
</head>
<body>
    <div class="container">
        <div class="row">
        <form method="post" class="form-horizontal col-md-6 col-md-offset-3">
		<h2> To do form</h2>
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Task number</label>
			    <div class="col-sm-10">
			      <input type="text" name="tnumber"  class="form-control" id="input1" value="<?php echo $r['task_number'] ?>" placeholder="Task number" />
			    </div>
			</div>
 
			<div class="form-group">
			    <label for="input1" class="col-sm-2 control-label">Task name</label>
			    <div class="col-sm-10">
			      <input type="text" name="tname"  class="form-control" id="input1" value="<?php echo $r['task_name'] ?>" placeholder="Task name" />
			    </div>
			</div>
 
			
 
			</div>
			</div>
            <input type="submit" class="btn btn-primary col-md-2 col-md-offset-5" value="update" />
			
		</form>
        </div>
    </div>

</body>
</html>