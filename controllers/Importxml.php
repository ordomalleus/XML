<?php

namespace Aplication\Controllers;

//require __DIR__ . '/../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

use Aplication\Models\Importxml as ImportxmlModels;
use Aplication\Classes\Views;

class Importxml
{
    public function actionAddForm()
    {
        $view = new Views();
        $view->display('importxml/importxmlAdd.php');
    }

    public function actionAdd()
    {
        $file = $_FILES['newXml']['tmp_name'];
        $xml = new ImportxmlModels();
        $xml->importXml($file);
        $result = $xml->getOtchet();

        //===отправка письма====
        $mail = new \PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mail.ru'; //свои данные проверял на mail.ru
        $mail->SMTPAuth = true;
        $mail->Username = 'Uemail'; //свои данные
        $mail->Password = 'Upassword'; //свои данные
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->From = 'Uemail';//свои данные
        $mail->addAddress('Uemail');//свои данные
        $mail->Body = 'add BD: ' . $result['addBd'] . "\r\n";
        $mail->Body .= 'update name BD: ' . $result['updateName'] . "\r\n";
        $mail->Body .= 'update password BD: ' . $result['updatePassword'] . "\r\n";
        $mail->Body .= 'update email BD: ' . $result['updateEmail'] . "\r\n";
        $mail->Body .= 'delete BD: ' . $result['delBd'] . "\r\n";
        if(!$mail->send()) {
            $errorMail = 'Ошибка: ' . $mail->ErrorInfo;
        } else {
            $errorMail = 'Сообщение отправленно';
        }
        //======================

        $view = new Views();
        $view->xml = $result;
        $view->mail = $errorMail;
        $view->display('importxml/importxmlOne.php');
    }
}