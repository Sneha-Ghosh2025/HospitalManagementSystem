<?php
    function connect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hospital";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    function registerUser($data)
    {
        $username=$_POST['username'];
        $email=$_POST['email'];
        $contact=$_POST['contact'];
        $password=$_POST['password'];
        $conn = connect();
        $sql = "INSERT INTO user (username, email, contact, password)
        VALUES ('$username', '$email', '$contact', '$password')";

        if ($conn->query($sql) === TRUE) {
            return 1;
        } else {
            return 0;
        }
        $conn->close();
    }

    function loginUser($data)
    {
        $email=$data['email'];
        $password=$data['password'];
        $conn = connect();
        $sql = "SELECT * FROM user WHERE email = '$email' and password = '$password'";
        $result = $conn->query($sql);
        return $result;
    }

    function displayUserData()
    {
        $conn = connect();
        $sql = "SELECT * FROM user";
        $result = $conn->query($sql);
        return $result;
    }

    function updateUser($data)
    {
        $reg_id=$data['reg_id'];
        $username=$data['username'];
        $email=$data['email'];
        $contact=$data['contact'];

        $conn = connect();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          
          $sql = "UPDATE user SET username='$username',email='$email',contact='$contact' WHERE reg_id='$reg_id'";
          
          if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
          } else {
            echo "Error updating record: " . $conn->error;
          }
          
          $conn->close();
          
    }

    function getInfo($reg_id)
    {
        $conn = connect();
        $sql = "SELECT * FROM user WHERE reg_id='$reg_id'";
        $result = $conn->query($sql);
        return $result;
    }

  
    function deleteInfo($reg_id)
    {
        $conn = connect();
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
          
          // sql to delete a record
          $sql = "DELETE FROM user where reg_id = '$reg_id'";
          
          if ($conn->query($sql) === TRUE) 
          {  /*value+datatype match*/
            echo "Record deleted successfully";
            return 1;
          } else {
            echo "Error deleting record: " . $conn->error;
            return 0;
          }
          
          $conn->close();
    }


    function userDisplay($email)
    {
        $conn = connect();
        $sql = "SELECT d.username, appointment.app_id, appointment.email, appointment.app_date,
        appointment.app_time, appointment.app_msg, appointment.app_status 
        FROM appointment 
        JOIN doctor d ON appointment.doc_id = d.doc_id
        WHERE appointment.email = '$email'";
        $result = $conn->query($sql);
        return $result;
    }
?>