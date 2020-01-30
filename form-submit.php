<?php
    require('config.php');
    date_default_timezone_set('Australia/Sydney');
    // collect all the data from the form field
    $insert_date = date("Y-m-d H:i:s");
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $organization = $_POST['organization'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $post = $_POST['role'];
    $comments = $_POST['comments'];
                    
    // execute the query
    $query = "INSERT INTO work_form (fname, lname, email, phone, organization, post, comments, insert_date) VALUES ('".$fname."', '".$lname."', '".$email."', '".$phone."', '".$organization."','".$post."','".$comments."','".$insert_date."');";
    $conn->query($query);
    //var_dump($query);die();

    // format the data to be sent
    $all_data_html = '<strong>The following person has just submitted the form on:  http://crestron.com.au</strong><br/><br/>'.
        '<table border=1>
        <tr><td>First Name</td><td>'.$fname.'</td></tr>
        <tr><td>Last Name</td><td>'.$lname.'</td></tr>
        <tr><td>Phone</td><td>'.$phone.'</td></tr>
        <tr><td>Email</td><td>'.$email.'</td></tr>
        <tr><td>Role</td><td>'.$role.'</td></tr>
        <tr><td>Comments</td><td>'.$comments.'</td></tr>
        <tr><td>Organization</td><td>'.$organization.'</td></tr>
        <tr><td>Form Fill Date</td><td>'.$insert_date.'</td></tr>
        </table>';
$to = 'francis@bang.com.au';
$subject = 'Crestron Data Work Form submit';
$subjectSender = "";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'CC:amar@bang.com.au' . "\r\n";
$headers .= 'From: no-reply@crestron.com' . "\r\n" ;
$headers .= 'Reply-To: no-reply@crestron.com' . "\r\n";
$headers .= "X-Priority: 3\r\n";
$headers .= "X-Mailer: PHP". phpversion() ."\r\n";

    if (mail($to, $subject, $all_data_html, $headers)) {
        print "1";
    } 
    else {
        print "0"; 
    }	
?>