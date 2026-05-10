<?php
//Thong so ket noi
$host = "localhost";
$username="root"; //Mac dinh cua laragon
$password=""; //Mac dinh cua Laragon
$dbname="web_qua_luu_niem"; // Thay bang ten database da tao 
// Tao ket noi
$conn = mysqli_connect($host, $username, $password, $dbname);

// Kiem tra ket noi
if (!$conn){
    die("Kết nối thất bại".mysqli_connect_error());
}
// Thiết kế để hiển thị tiếng việt có dấu
mysqli_set_charset($conn, "utf8");

//echo "Kết nối database thành công!";


?>