<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // access
        $secretKey = '6Ldxd68UAAAAAF0HKjwfn4HoYRczB_PGFaf14qxH';
        $captcha = $_POST['g-recaptcha-response'];

        if(!$captcha){
          echo '<p class="alert alert-warning">Please check the the captcha form.</p>';
          exit;
        }

        # FIX: Replace this email with recipient email
        $mail_to = "test@gmail.com";
        
        # Sender Data
        $subject = 'Take a look: Enquiry From Website';
        $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["name"])));
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $phone = trim($_POST["tel"]);
        $message = trim($_POST["message"]);
        
        if ( empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($phone) OR empty($subject1) OR empty($message)) {
            # Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo '<p class="alert alert-warning">Please complete the form and try again.</p>';
            exit;
        }

        $ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
        $responseKeys = json_decode($response,true);

        if(intval($responseKeys["success"]) !== 1) {
          echo '<p class="alert alert-warning">Please check the the captcha form.</p>';
        } else {
            # Mail Content

            $content = "<table cellspacing=1 cellpadding=1 width=600px border=0>
        <tr>
          <td height=20 colspan=2 align=center><strong>Enquiry From Website</strong></td>
         <tr>
          <td align=left width=250>
           <b>Name </b>    </td>
          <td >".$name."</td>
        </tr>
        <tr>
          <td align=left>
          <b>Email</b>    </td>
          <td >".$email."</td>
        </tr>
        <tr>
          <td align=left>
          <b>Telephone</b>    </td>
          <td >".$phone."</td>
        </tr>
        
        <tr>
          <td align=left>
          <b>Message </b>    </td>
          <td >".$message."</td>
        </tr>
      </table>";
            # email headers.
           // $headers = "From: $name <$email>";
      $headers = "From: ". $email ."\r\n";
      $headers .= "BCC:test@gmail.com\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            # Send the email.
            $success = mail($mail_to, $subject, $content, $headers);
            if ($success) {
                # Set a 200 (okay) response code.
               http_response_code(200);
               header("Location:thanks.html");

            } else {
                # Set a 500 (internal server error) response code.
                http_response_code(500);
                echo '<p class="alert alert-warning">Oops! Something went wrong, we could not send your message.</p>';
            }
        }

    } else {
        # Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo '<p class="alert alert-warning">There was a problem with your submission, please try again.</p>';
    }

?>
