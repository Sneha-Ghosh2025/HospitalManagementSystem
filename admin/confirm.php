<?php
include('../admin/mymethod.php');
include('../user/phpmailer/PHPMailerAutoload.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') 
{
    $app_id= $_GET['app_id'];
    $result = confirmApp($app_id);
    if($result==1)
    {
        $appDetails = getAppointmentDetails($app_id);
        if ($appDetails->num_rows > 0) 
        {
            $row = $appDetails->fetch_assoc();
            $email = $row['email'];

            
            
            $res=sendEmail($email, $row);
        
            if($res == "1")
            {
                return 'you confirmed patient appointment and email sent!';
                //header('location:doctorAppointmentDisplay.php');
            }
            else{
                return 'you did not confirmed patient appointment';
            }
            
        
        }
    }
    else{
        return "Appointmnet Not Confirm";
    }
}

function sendEmail($email, $row)
{
    $mail = new PHPMailer() ;
    $mail->isSMTP();  //Only enable when use in local server 

    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';

    $mail->Username = 'sneharupu@gmail.com';
    $mail->Password = 'ndxgpllzvlaidnhy';

    $mail->setFrom('sneharupu@gmail.com', 'Email Verification');
    $mail->addAddress($email);
    $mail->addReplyTo('sneharupu@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Appointment Confirmation';
    $mail->Body = "
                <h1>Appointment Confirmation</h1>
                <p>Dear " . htmlspecialchars($row['username']) . ",</p>
                <p>Your appointment has been confirmed!</p>
                <ul>
                    <li><strong>Date:</strong> " . htmlspecialchars($row['app_date']) . "</li>
                    <li><strong>Time:</strong> " . htmlspecialchars($row['app_time']) . "</li>
                </ul>
                <p>Thank you,<br>Clinic Team</p>
            ";
            $mail->AltBody = "Dear " . htmlspecialchars($row['username']) . ",\n\n" .
                            "Your appointment has been confirmed!\n\n" .
                             "Date: " . htmlspecialchars($row['app_date']) . "\n" .
                             "Time: " . htmlspecialchars($row['app_time']) . "\n\n" .
                             "Thank you,\nClinic Team";

    if($mail->send())
    {
        return "1";
    }
    else{
        return "0";
    }
}
?>