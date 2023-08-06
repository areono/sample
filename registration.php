<?php 
 error_reporting( E_ALL );
  ini_set( "display_errors", 1 );
//registration.php
    require ('db.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    function sendmail($email, $v_cod){
        
        require ('PHPMailer-master/src/PHPMailer.php');
        require ('PHPMailer-master/src/Exception.php');
        require ('PHPMailer-master/src/SMTP
        .php');

        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;            
            $mail->Username   = 'shjeon0126@gmail.com';
            $mail->Password   = 'fulfgeoajnwzpher';                    
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   
            $mail->Port       = 465;                           

            $mail->setFrom('shjeon0126@gmail.com', 'reo');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Email verification from aatmaninfo';
            $mail->Body    = "Thanks for registration.<br>click the link below to verify your email address
            <a href='http://localhost/project/verify.php?email=$email&v_cod=$v_cod'>verify</a>";

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    if (isset($_POST['login'])) {
        
        $email_username = $_POST['email_username'];
        $password_login = $_POST['password'];

        $sql = "SELECT * FROM member WHERE email = '$email_username' AND passwd = '$password_login' AND email_verified = '1'";
        $result = $conn->query($sql);
        
        if ($row = $result->fetch_assoc()) {
            $_SESSION['logged_in'] = true;
            $_SESSION['email'] = $row['email'];
            header('location: main.php');
        } else {
            echo "
                <script>
                    alert('Please verify your email!!');
                    window.location.href = 'login.php';
                </script>";
        } 
    }

    if (isset($_POST['register'])) {
        
        $fullName = $_POST['fullName'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user_exist_query = "SELECT * FROM member WHERE nickname = '$username' OR email = '$email' ";

        $result = $conn->query($user_exist_query);

        if ($result) {
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                
                if ($row['nickname'] === $username && $row['email'] === $email) {
                    echo "
                        <script>
                            alert('Username already taken!');
                            window.location.href = 'login.php';
                        </script>";
                } else {
                    echo "
                        <script>
                            alert('Email already registered');
                            window.location.href = 'login.php';
                        </script>";
                }
            
            } else {
                $v_cod = bin2hex(random_bytes(16));
                
                $query = "INSERT INTO member (id, passwd, nickname, email, verification_token, email_verified, role) 
                          VALUES ('$fullName', '$password', '$username', '$email', '$v_cod', '0', 'user')";
                    
                if ($conn->query($query) === true && sendmail($email, $v_cod) === true) {
                    echo "
                        <script>
                            alert('Registration successful. Check your mailbox (inbox or spam) and verify your account.');
                            window.location.href = 'login.php';
                        </script>"; 
                } else {
                    echo "
                        <script>
                            alert('Query can not run');
                            window.location.href = 'login.php';
                        </script>";
                }
            }
        } else {
            echo "
            <script>
                alert('Query can not run');
                window.location.href = 'login.php';
            </script>";
        }
    }
 ?>

