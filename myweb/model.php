<?php
class User{
    public $email;
    public $password;
    public  $server_name='localhost';
    public  $user_name='root';
    public  $server_password='';
    public  $database_name = 'website';
    // public  $name = ''; 

    public  function server_connection()
    {
        $connection = new mysqli($this->server_name,$this->user_name,$this->server_password);
        if($connection->connect_error)
        {
            // echo "<br>Connection Failed. Cause error:".$connection->connect_error;
        }
        else
        {
            // echo "<br>Connection stablished";
        }
    }
    public function create_database($database_name)
    {
        $connection = new mysqli($this->server_name,$this->user_name,$this->server_password);
            $sql = "CREATE DATABASE $database_name";
        if($connection->query($sql) == TRUE)
        {
            // echo '<br>Successfully Database created';
        }
        else
        { 
            // echo '<br>Error'.$connection->error;
        }

        $connection->close();
    }
    public function database_connection($database_name)
    {
        $this->database_name = $database_name;
        $connection = new mysqli($this->server_name,$this->user_name,$this->server_password,$database_name);
        if($connection->connect_error)
        {
            // echo "<br>Connection Failed. Cause error:".$connection->connect_error;
        }
        else
        {
            // echo "<br>Connection stablished to database: ".$database_name;
        }
    }
    public function check_static_method()
    {
        echo "<br>";
        echo $this->server_name;
        echo "<br>Static Method<br>";
    } 
    public function create_db_table($table_name,$database_name)
    {
        $connection = new mysqli($this->server_name,$this->user_name,$this->server_password,$database_name);
        if($table_name === 'visitor')
        {
            $sql = "CREATE TABLE $table_name (
                SL INT(6) AUTO_INCREMENT PRIMARY KEY,
                EMAIL VARCHAR(20) ,
                PASS_WORD VARCHAR (10)
            )";
        }
        else
        {
            $sql ="";
        }
        if($connection->query($sql) == TRUE)
        {
            // echo '<br>Successfully Table created';
        }
        // else{ echo '<br>Error'.$connection->error;}

        $connection->close();

    }
    public function insert_data($database_name,$db_table)
    {
        $connection = new mysqli($this->server_name,$this->user_name,$this->server_password,$database_name);
        if($db_table === 'visitor')
        {
            $email = $this->email;
            $password = $this->password;

            $sql = "INSERT INTO $db_table (EMAIL,PASS_WORD)
                VALUES('$email','$password')";
        }
        else
        {
            $sql =" ";
        }

        if($connection->query($sql) == TRUE)
        {
            // echo '<br>Successfully Table updated';
            return TRUE;
        }
        else
        {
            // echo '<br>Error : '.$connection->connect_error;
            return FALSE;
        }

        $connection->close();
    }
    public function delete_data($database_name,$db_table)
    {
        $connection = new mysqli($this->server_name,$this->user_name,$this->server_password,$database_name);
        if($db_table === 'visitor')
        {
            $email = $_SESSION['visitor_email'];
            $sql = "DELETE FROM $db_table WHERE EMAIL = '$email' ";
        }
        else
        {
            $sql = " ";
        }

        if($connection->query($sql) == TRUE)
        {
            // echo '<br>Successfully Table data deleted';
        }
        else
        { 
            // echo '<br>Error'.$connection->connect_error;
        }

        $connection->close();
    }
    public function select_data($database_name,$db_table)
    {
        $connection = new mysqli($this->server_name,$this->user_name,$this->server_password,$database_name);
        if($db_table === 'visitor')
        {
            $email = $this->email;
            $sql = "SELECT * FROM $db_table WHERE EMAIL = '$email'";
        }
        else
        {
            $sql = " ";
        }
        $result = $connection->query($sql);
        if($result == TRUE)
        {
            $row = $result->fetch_assoc();
            //echo 'Successfully Table data deleted';
            return $row;
        }
        else
        {
            echo 'Error'.$connection->error;
            return FALSE;
        }

        $connection->close();
    }
    public function log_in($EMAIL, $PASSWORD)
    {
        //$database_name = 'website';
        $this->server_connection();
        $this->database_connection($this->database_name);
        $db_table = 'visitor';
        $this->email = $EMAIL;
        $this->password = $PASSWORD;
        //check
        $database = $this->select_data($this->database_name,$db_table);
        if($database !==FALSE)
        {
            if($this->password == $database['PASS_WORD'])
            {
                return "home";
            }
            else
            {
                return "login";
            }
        }
        else
        {
            //signup
            return "signup";

        }
        

    }
    public function sign_up($EMAIL, $PASSWORD)
    {
        //$database_name = 'website';
        $this->server_connection();
        $this->database_connection($this->database_name);
        $db_table = 'visitor';
        $this->email = $EMAIL;
        $this->password = $PASSWORD;
        //check
        $database = $this->select_data($this->database_name,$db_table);
        if($database == FALSE)
        {
            $result = $this->insert_data($this->database_name,$db_table);

            if($result === TRUE )
            {
                return "home";
            }
            else
            {
                return "signup";
            }
        }
        else
        {
            //signup
            return "login";

        }

    }
    public function __construct()
    {
        $this->server_connection();
        $this->create_database($this->database_name);
        $this->database_connection($this->database_name);
        $this->create_db_table('visitor',$this->database_name);
    }

}

?>