/*=====================================
* THIET LAP THONG TIN GUI MAIL
*=====================================*/

$mail->IsSMTP(); // Gọi đến class xử lý SMTP
$mail->Host = "mail.zend.vn"; // tên SMTP server
$mail->SMTPDebug = 2; // enables SMTP debug information (for testing)
// 1 = errors and messages
// 2 = messages only
$mail->SMTPAuth = true; // Sử dụng đăng nhập vào account
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com"; // Thiết lập thông tin của SMPT
$mail->Port = 465; // Thiết lập cổng gửi email của máy
$mail->Username = "zendvn.demo@gmail.com"; // SMTP account username
$mail->Password = "123456"; // SMTP account password

//Thiet lap thong tin nguoi gui va email nguoi gui
$mail->SetFrom('zendvn.demo@gmail.com','ZendVN Demo email');
 
//Thiết lập thông tin người nhận
$mail->AddAddress("zendvn@gmail.com", "ZendVN Group");
$mail->AddAddress("zendvn@yahoo.com", "ZendVN Group");

//Thiết lập email nhận email hồi đáp
//nếu người nhận nhấn nút Reply
$mail->AddReplyTo("khanhpham@zend.vn","Pham Vu Khanh");

  /*=====================================
* THIET LAP NOI DUNG EMAIL
*=====================================*/

//Thiết lập tiêu đề
$mail->Subject = "PHPMailer training by ZendVN Group";

//Thiết lập định dạng font chữ
$mail->CharSet = "utf-8";

//Thiết lập nội dung chính của email
$body = "Khóa học Lập Trình PHP được thực hiện bởi ZendVN Group";
$mail->Body = $body;

if(!$mail->Send()) {
echo "Mailer Error: " . $mail->ErrorInfo;
} else {
echo "Message sent!";
}