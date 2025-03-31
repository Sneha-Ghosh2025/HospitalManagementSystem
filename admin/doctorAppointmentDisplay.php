<?php
//session_start();
if (isset($_SESSION['email']) && $_SESSION['type'] == 'doctor') 
{
    $doc_id = $_SESSION['doc_id']; // Access the doc_id from the session
}
include('../admin/mymethod.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System</title>
    <?php
			include('../user/csslink.php');
		?>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        header {
            color: blue;
            text-align: center;
            padding: 1rem;
        }
        .container1 {
            margin: 20px auto;
            max-width: 900px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .appointment {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .appointment:last-child {
            border-bottom: none;
        }
        .appointment-info {
            flex: 1;
        }
        .appointment-actions {
            display: flex;
            gap: 10px;
        }
        button {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
        }
        .confirm {
            background-color: #28a745;
        }
        .cancel {
            background-color: #dc3545;
        }
        button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <?php
        include('../user/header.php');
        $doc_id = $_SESSION['doc_id'];
    ?>
    <header>
        <h1>Your Appointments</h1>
    </header>
    <div class="container1">
        <input name="doc_id" type="text" value="<?php echo htmlspecialchars($doc_id); ?>">
    <?php
    //session_start();
       
         $result = displayDoctorAppointment($doc_id);
    if ($result && $result->num_rows > 0) 
    {
        while ($row = $result->fetch_assoc()) 
        {
            $email = $row['email'];
            $res = getUserInfo($email);
            //$row1 = $res->fetch_assoc();

            if ($res && $res->num_rows > 0) 
            {
                $row1 = $res->fetch_assoc();
            } 
            else {
                echo '<p>Invalid user data.</p>';
                continue;
            }


            echo '
            <div class="appointment">
                <div class="appointment-info">
                    <p><strong>Patient:</strong>' . htmlspecialchars($row1["username"]) . '</p>
                    <p><strong>Date:</strong>' . htmlspecialchars($row["app_date"]) . '</p>
                    <p><strong>Time:</strong>' . htmlspecialchars($row["app_time"]) . '</p>
                    <p><strong>Message:</strong>' . htmlspecialchars($row["app_msg"]) . '</p>
                    <p><strong>APP id:</strong>' . htmlspecialchars($row["app_id"]) . '</p>
  
                </div>
                <div class="appointment-actions">';

                if($row['app_status']== "Pending")
                {
                    echo '
                    <button class="confirm" onclick="confirmApp('.$row["app_id"].')">Confirm</button>
                    <button class="cancel"  onclick="cancel('.$row["app_id"].')">Cancel</button>
                    ';
                }
                else{
                      echo  $row['app_status'];
                }
                
                echo '    </div>
            </div>';
        }
    } 
    else 
    {
        echo '<p>No appointments found.</p>';
    }
        ?>
        
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        function confirmApp(app_id) 
        {
           
            if( confirm("Are you sure to confirm the appointment?"))
            {
                
                $.ajax({
                            url:"confirm.php",
                            method:"get",
                            data:{"app_id":app_id},
                            success: function(response)
                                {
                                    alert(response);
                                    window.location.href = "";
                                }
                        })
            }
        }
    </script>

<script>
  function cancel(app_id)
    {  
       // alert(id)
        if( confirm("Are you sure to delete the appointment?"))
        {
            $.ajax({
                        url:"cancel.php",
                        method:"get",
                        data:{"app_id":app_id},
                        success: function(response)
                            {
                                alert(response);
                                window.location.href = "";
                            }
                    })
        }
    }
    
</script>
<?php
        include('../user/footer.php');
    ?>
    <?php
        include('../user/jslink.php');
    ?>
</body>
</html>