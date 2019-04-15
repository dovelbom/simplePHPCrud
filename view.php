<?php
    require_once('database.php');
    $res = $database->read();
    $sort="ASC";
    if(isset($_GET['sort'])&&$_GET['sort']=="ASC"){
        $sort="desc";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>view page</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>Task id</th>
                        <th>Task name</th>
                        <th>Issued date<a href="?orderby=issued_date&sort=<?= $sort?>" class="glyphicon glyphicon-sort" aria-hidden="true"></a></th>
                      
                    </tr>
                </thead>
                <tbody>                   
                <?php 
                if($res['status']=='failed'){
                   echo $res['errorMessage'];
                }
                else{
                while($r = mysqli_fetch_assoc($res['data'])){
                ?>
                    <tr>
                        <td><?php echo $r['task_number']?></td>
                        <td><?php echo $r['task_name']?></td>
                        <td><?php echo $r['issued_date']?></td>
                        <td>
                            <a href="update.php?task_number=<?php echo $r['task_number']; ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true">Edit</span></a>
                            <a href="delete.php?task_number=<?php echo $r['task_number']; ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true">Delete</span></a>
                            
                        </td>
                    </tr>
                <?php }} ?>

                </tbody>
            </table>
            

        </div>


    </div>
</body>

</html>
