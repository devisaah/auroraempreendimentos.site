<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'lib/PHPMailer/src/Exception.php';
require 'lib/PHPMailer/src/PHPMailer.php';
require 'lib/PHPMailer/src/SMTP.php';

$errors = array();
$file = null;

if (!isset($_POST['name']) || empty(trim($_POST['name']))) {
	array_push($errors, "O nome deve ser preenchido.");
} 

if (!isset($_POST['email']) || empty(trim($_POST['email']))) {
	array_push($errors, "O e-mail deve ser preenchido.");
}

if (!isset($_POST['phone']) || empty(trim($_POST['phone']))) {
	array_push($errors, "Informe seu whatsapp!");
}

if (!isset($_POST['cidade']) || empty(trim($_POST['cidade']))) {
	array_push($errors, "Informe sua cidade.!");
}

if (empty($errors)) {
	$mail = new PHPMailer(true);
	try {
		$mail->From = $_POST['email'];
		$mail->Sender = $_POST['email'];
		$mail->FromName = $_POST['name'];
		$mail->SetFrom($_POST['email'], $_POST['name']); //Name is optional
		$mail->addReplyTo($_POST['email'], $_POST['name']);
		$mail->WordWrap = 50; // Definir quebra de linha
		$mail->IsHTML = true ; // Enviar como HTML
		$mail->Subject   = 'Novo Contato | Site | ' . $_POST['name'] . ' | ' . $_POST['email'] . ' | ' . $_POST['phone'] . ' | ' . $_POST['cidade'];
		$mail->Body      = 'DE: '.$_POST['name'].' <br/> E-MAIL: '.$_POST['email'].' <br/> Whatsapp: '.$_POST['phone'].' <br/> Cidade: '.$_POST['cidade'];
		$mail->AltBody = 'DE: '.$_POST['name'].' || email: '.$_POST['email'].' || Whatsapp: '.$_POST['phone'].' || Cidade: '.$_POST['cidade']; //PlainText, para caso quem receber o email não aceite o corpo HTML
		$mail->AddAddress('contato@auroraempreendimentos.site');
		$mail->Send();
		echo "E-mail enviado com sucesso!";
	} catch (Exception $e) {
		array_push($errors, "Preencha todos os campos.".$mail->ErrorInfo);
		http_response_code(422);
		echo json_encode($errors);
	}
} else {
	http_response_code(422);
	echo json_encode($errors);
}
?>
