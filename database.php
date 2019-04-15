<?php
class Database{

    private $connection;

     
    function __construct(){
        $this->connect_db();
    }

    public function connect_db(){
        $this->connection = mysqli_connect('localhost','root','','crud');
        if(mysqli_connect_error()){
            die("Database Connection Failed" . mysqli_connect_error() .mysqli_connect_errno());
        }
    }

    public function create($tname){
        $sql ="INSERT INTO `crud` (task_name) VALUES ('$tname') ";
        $res = mysqli_query($this->connection,$sql);
        if($res){
           return true;
        }
        else{
            return false;
        }
    }

    public function read($tnumber=null){
        $res = [];
        $sql = "SELECT * FROM `crud`";
        
        if(isset($_GET['orderby'])){
            $sql.= " ORDER BY $_GET[orderby] $_GET[sort]";
        }
        if($tnumber){ $sql .= " WHERE task_number=$tnumber";}
        $sqlRes = mysqli_query($this->connection, $sql);
        if($sqlRes){
            $res['status'] = 'success';
            $res['data'] = $sqlRes;
         }else{
            $res['status'] = 'failed';
            $res['errorMessage'] = mysqli_error($this->connection);
         }
        return $res;
    }

    public function update($tname,$tnumber){
        $res = [];
		$sql = "UPDATE `crud` SET task_name='$tname' WHERE task_number=$tnumber";
        $sqlRes = mysqli_query($this->connection, $sql);
        if($sqlRes){
            $res['status'] = 'success';
            $res['data'] = $sqlRes;
         }else{
            $res['status'] = 'failed';
            $res['errorMessage'] = mysqli_error($this->connection);
         }
        return $res;
    }
    
    public function delete($tnumber){
		$sql = "DELETE FROM `crud` WHERE task_number= $tnumber";
         $res = mysqli_query($this->connection, $sql);
 		if($res){
 			return true;
 		}else{
 			return false;
 		}
    }



    public function sanitize($var){
        $return = mysqli_real_escape_string($this->connection, $var);
        return $return;
        
    }

    public function checkErrors(){
       echo "".mysqli_error($this->connection);
    }

   

}


$database = new Database();
?>