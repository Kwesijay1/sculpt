<?php
      
            $name = $_POST['name'];
            $phoneCode = $_POST['phoneCode'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message']; 
        
if (!empty($name) || !empty($phoneCode) || !empty($phone) || !empty($email) || !empty($subject) || !empty($message) ){

    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "tara";

    $conn = new mysqli ($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error('.mysqli_connect_errno().')'. mysqli_connect_error());
    }else {
        $SELECT = "SELECT email From register Where email = ? Limit = 1";
        $INSERT = "INSERT INTO register (name, phoneCode, phone, email, subject, message) values(?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($SELECT);
        $stmt -> bind_param("s", $email);
        $stmt -> execute();
        $stmt -> bind_results($email);
        $stmt -> store_results();
        $rnum = $stmt->num_rows;

} if($rnum ==0){
    $stmt->close();

    $stmt ->$conn_prepare($INSERT);
    $stmt ->bind_param("s,i,i,s,s,s", $name, $phoneCode, $phone, $email, $subject, $message );

    $stmt ->execute();

    echo "Message sent successfully";
}else{
    echo "Someone has already used this credentials";
}
$stmt->close();
$conn->close();
}
else{
    echo "All fields are required";
    die();
}

?>