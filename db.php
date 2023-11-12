<?php 
    $conn = mysqli_connect("localhost","root","","ims");
    function safuda ($data) {
        global $conn;
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = mysqli_real_escape_string($conn, $data);
        return $data;
    }
?>