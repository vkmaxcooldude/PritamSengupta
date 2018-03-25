<?php

// define variables and set to empty values
$fname_error = $lname_error = $email_error = $phone_error = $sub_error = "";
$fname = $lname = $email = $phone = $message = $subject = $success = "";

//form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["firstname"])) {
    $fname_error = "First Name is required";
  } else {
    $fname = test_input($_POST["firstname"]);
    // check if first name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
      $fname_error = "Only letters and white spaces are allowed";
    }
  }

  if (empty($_POST["lastname"])) {
    $lname_error = "Last Name is required";
  } else {
    $lname = test_input($_POST["lastname"]);
    // check if last name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
      $lname_error = "Only letters and white spaces are allowed";
    }
  }

  if (empty($_POST["email"])) {
    $email_error = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_error = "Invalid email format";
    }
  }

  if (empty($_POST["phone"])) {
    $phone_error = "Phone is required";
  } else {
    $phone = test_input($_POST["phone"]);
    // check if e-mail address is well-formed
    if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i",$phone)) {
      $phone_error = "Invalid phone number";
    }
  }

  if (empty($_POST["subject"])) {
    $sub_error = "Subject is required";
  } else {
    $subject = test_input($_POST["subject"]);
    // check if subject only contains letters, whitespaces and numbers
    if (!preg_match("/^[a-zA-Z0-9_]*$/",$subject)) {
      $sub_error = "Only letters, white spaces and numbers are allowed";
    }
  }

  if (empty($_POST["body"])) {
    $message = "";
  } else {
    $message = test_input($_POST["body"]);
  }

  if ($fname_error == '' and $lname_error == '' and $email_error == '' and $phone_error == '' and $sub_error == '' ){
      $message_body = '';
      $header = 'From:' . "$email" . "\r\n" . 'Reply-To:' . "$email" . "\r\n" . 'X-Mailer: PHP/' . phpversion();
      $to = 'vishalk.engg@gmail.com';
      $msg = "$fname $lname has sent you an E-mail\n" .
      "From: $email\n" .
      "Subject: $subject\n" .
      "Message: \n\n" .
      "$message\n" .
      'Phone: ' . "$phone";
      if (mail($to, $subject, $msg, $header)){
          $success = "Message sent, thank you for contacting us!";
          $fname = $lname = $email = $phone = $message = $subject = '';
      }
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
