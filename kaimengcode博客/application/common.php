<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


function mailto($to,$title,$content){
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //服务器配置
        $mail->CharSet ="UTF-8";                     //设定邮件编码
        $mail->SMTPDebug = 0;                        // 调试模式输出
        $mail->isSMTP();                             // 使用SMTP
        $mail->Host = 'smtp.163.com';                // SMTP服务器
        $mail->SMTPAuth = true;                      // 允许 SMTP 认证
        $mail->Username = '17349898076@163.com';                // SMTP 用户名  即邮箱的用户名
        $mail->Password = 'JUPOXZBPVSYCGPQZ';             // SMTP 密码  部分邮箱是授权码(例如163邮箱)
        $mail->SMTPSecure = 'ssl';                    // 允许 TLS 或者ssl协议
        $mail->Port = 465;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持

        $mail->setFrom('17349898076@163.com', 'Kaimeng');  //发件人
        $mail->addAddress($to);
        $mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
        $mail->Subject = $title;
        $mail->Body    = $content .'<br>'. date('Y-m-d H:i:s');
        $mail->AltBody = '如果邮件客户端不支持HTML则显示此内容';

       return $mail->send();
    } catch (Exception $e) {
        echo '邮件发送失败: ', $mail->ErrorInfo;
    }
}
function replace($data)
{
    return str_replace('span', 'a', $data);
}
function strToArray($data)
{
    return explode('|', $data);
}