<?php 

session_name('ga');
session_start();

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

if ( isset($_POST['t_email']) && !empty($_POST['t_email']) ){
	$t_nome 	= $_POST['t_nome'];
	$t_email 	= $_POST['t_email'];
	$t_assunto 	= $_POST['t_assunto'];
	$t_mensagem = $_POST['t_mensagem'];

	//$to = "marcellasouzat@gmail.com";
	$to = "cbsk@totalticket.com.br";
	$cc = "comunicacao@cbsk.com.br";
	$subject = "Contato Site Filiado CBSK";
	$body = "Nome: " .$t_nome. "\n".
			"E-mail: ".$t_email. "\n".
			"Assunto: ".$t_assunto. "\n".
			"Mensagem: ".$t_mensagem;
			
	$header =   "From:filiadocbskcom@filiadocbsk.com.br"."\r\n".
				"Reply-To:".$to."\r\n".
				"Cc:".$cc."\r\n".
				"X=Mailer:PHP/".phpversion();
	
	if ( mail($to, $subject, $body, $header) ){
		//var_dump($body);
		//die();
		echo "<script>alert('E-mail Enviado com sucesso!')</script>
		<meta http-equiv=\"refresh\" content=\"0; URL='/contato'\"/>";
	}else{
		echo "<script>alert('Seu E-mail não pode ser enviado')</script>
		<meta http-equiv=\"refresh\" content=\"0; URL='/contato'\"/>";
	}
} else{
		echo "<script>alert('Dados Obrigatórios não preenchidos')</script>
		<meta http-equiv=\"refresh\" content=\"0; URL='/contato'\"/>";
}