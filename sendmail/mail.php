<?php
// file 03-gmail.php
//Nhúng thư viện phpmailer
require_once('phpmailer/class.phpmailer.php');
//Khởi tạo đối tượng
$mail = new PHPMailer();

/*=====================================
* THIET LAP THONG TIN GUI MAIL
*=====================================*/

$mail->IsSMTP(); // Gọi đến class xử lý SMTP
$mail->Host = "smtp.googlemail.com"; // tên SMTP server
$mail->SMTPDebug = 2; // enables SMTP debug information (for testing)
// 1 = errors and messages
// 2 = messages only
$mail->SMTPAuth = true; // Sử dụng đăng nhập vào account
$mail->SMTPSecure = "none";
$mail->Host = "ssl://smtp.googlemail.com"; // Thiết lập thông tin của SMPT
$mail->Port = 465; // Thiết lập cổng gửi email của máy
$mail->Username = "dangtinnhadatnoreply@gmail.com"; // SMTP account username
$mail->Password = "dangtinnhadat@123!"; // SMTP account password

//Thiet lap thong tin nguoi gui va email nguoi gui
$mail->SetFrom('dangtinnhadatnoreply@gmail.com','ĐĂNG TIN NHÀ ĐẤT');
 
//Thiết lập thông tin người nhận
$mail->AddAddress("dinhmy90@gmail.com", "ĐĂNG TIN NHÀ ĐẤT");

//Thiết lập email nhận email hồi đáp
//nếu người nhận nhấn nút Reply

  /*=====================================
* THIET LAP NOI DUNG EMAIL
*=====================================*/

//Thiết lập tiêu đề
$mail->Subject = "THÔNG TIN KHÁCH HÀNG";

//Thiết lập định dạng font chữ
$mail->CharSet = "utf-8";

//Thiết lập nội dung chính của email
$body = "<h2>ĐĂNG TIN NHÀ ĐẤT</h2>";
$mail->MsgHTML($body);

if(!$mail->Send()) {
echo "Mailer Error: " . $mail->ErrorInfo;
} else {
echo "Message sent!";
}
