<html>
<head>
  <title>Your Message has been received</title>
</head>
<body>
  <h2><p>You have successfully sent your message. We will contact you as soon as possible.</p><p>Thank You for contacting us.</p></h2>

  <?php
  $first_name = $_POST['firstname'];
  $last_name = $_POST['lastname'];
  $email = $_POST['email'];
  $body = $_POST['body'];
  $to = 'vishalk.engg@gmail.com';
  $subject = $_POST['subject'];
  $msg = "$first_name $last_name has sent you an E-mail\n" .
  "From: $email\n" .
  "Subject: $subject\n" .
  'Message: \n\n' .
  "$body\n";
  mail($to, $subject, $msg, 'From:' . $email);
  echo 'Thanks for submitting the form' . '<br />';
  echo "Your message has been sent $first_name" . '<br />';
  echo 'We will revert back to you as soon as possible' . '<br />';
  ?>

 </body>
 </html>
