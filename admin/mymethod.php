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

    function registerDoctor($data)
    {
        $target_dir = "doctors/";
        $target_file = $target_dir . basename($_FILES["doc_img"]["name"]);

        $username=$_POST['username'];
        $email=$_POST['email'];
        $contact=$_POST['contact'];
        $password=$_POST['password'];
        $experience= $_POST['experience'];
        $specialization= $_POST['specialization'];
        $conn = connect();

        if (move_uploaded_file($_FILES["doc_img"]["tmp_name"], $target_file)) 
        {
                 $sql = "INSERT INTO doctor (username, email, contact, password,specialization,experience, doc_img)
                VALUES ('$username', '$email', '$contact', '$password','$specialization','$experience', '$target_file')";

                if ($conn->query($sql) === TRUE)
                {
                    return 1;
                } 
                else 
                {
                    return 0;
                }
        } 
        else
        {
            return 2;
        }

        
        $conn->close();
    }

    function loginDoctor($data)
    {
        $email=$data['email'];
        $password=$data['password'];
        $conn = connect();
        $sql = "SELECT * FROM doctor WHERE email='$email' AND  password='$password' ";
        $result = $conn->query($sql);
        return $result;
    }

    function displayDoctorDetails()
    {
        $conn = connect();
        $sql = "SELECT * FROM doctor";
        $result = $conn->query($sql);
        return $result;

    }

    function getDoctorData($doc_id)
    {
        $conn = connect();
        $sql = "SELECT * FROM doctor WHERE doc_id='$doc_id'";
        $result = $conn->query($sql);
        return $result;
    }

    function appointment($data)
    {
        // Sanitize input data
        $app_date = $data['app_date'];
        $app_time = $data['app_time'];
        $app_msg = $data['app_msg'];
        $doc_id = $data['doc_id'];
        $email = $data['email'];

        $conn = connect(); // Ensure this function returns a valid DB connection.

        // Use prepared statements to prevent SQL injection
        $sql = "INSERT INTO appointment (doc_id, email, app_date,app_time, app_msg) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            return "Error in statement preparation: " . $conn->error;
        }

        $stmt->bind_param("sssss", $doc_id, $email, $app_date, $app_time, $app_msg);

        if ($stmt->execute()) {
            return 1; // Success
        } else {
            return "Error: " . $stmt->error;
        }
    }

    function displayDoctorAppointment($doc_id)
    {
        $conn=connect();
        $sql="SELECT * FROM appointment where doc_id = '$doc_id'";
       
      
        /*$sql = "SELECT 
        a.appointment_id,
        a.appointment_time,
        u.username
        FROM 
            appointment a
        JOIN 
            user u ON a.reg_id = u.reg_id
        JOIN 
            doctor d ON a.doc_id = d.doc_id
        WHERE 
            a.doc_id = '$doc_id'"; */
        $result = $conn->query($sql);

        return $result;
    }

    function getUserInfo($email)
    {
        $conn = connect();
        $sql = "SELECT * FROM user WHERE email='$email'";
        $result = $conn->query($sql);
        return $result;
    }

    function confirmApp($app_id)
    {
        $conn = connect(); 
        $sql = "UPDATE appointment SET app_status='confirmed' WHERE app_id='$app_id'";
        $result = $conn->query($sql);
        return $result;

    }

    function cancel($app_id)
    {
        $conn = connect();
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
          
          // sql to delete a record
          $sql = "DELETE FROM user where app_id = '$app_id'";
          
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

    function getAppointmentDetails($app_id)
    {
        $conn = connect();
        $sql = "SELECT u.username, u.email, appointment.app_id, appointment.app_date,
        appointment.app_time, appointment.app_msg, appointment.app_status 
        FROM appointment 
        JOIN user u ON appointment.email = u.email
        WHERE appointment.app_id = '$app_id'";
        $result = $conn->query($sql);
        return $result;
    }

    function doctorDisplay($email)
    {
        $conn=connect();
        $sql="SELECT * FROM doctor where email='$email' ";
        $result = $conn->query($sql);
        return $result;
    }

    function displayDoctorAppointmentbyDate($doc_id, $todayDate)
    {
        $conn=connect();
        $sql="SELECT * FROM appointment where doc_id = '$doc_id' and app_date = '$todayDate' ";
        $result = $conn->query($sql);

        return $result;
    }
?>