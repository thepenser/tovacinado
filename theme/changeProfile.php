<?php

session_name('ga');
session_start();

if ( !isset($_SESSION['login']) ):
    header('Location: /?error=Você precisa se logar antes!');
    exit;
endif;


if ( isset($_POST['t_nome']) ):

	//date_default_timezone_set('America/Bahia');

    $t_nome			= (string) filter_input(INPUT_POST, "t_nome", FILTER_DEFAULT);
    $t_nomemae 		= (string) filter_input(INPUT_POST, "t_nomemae", FILTER_DEFAULT);
    $t_nascimento	= (string) filter_input(INPUT_POST, "t_nascimento", FILTER_DEFAULT);
    $t_sexo			= (string) filter_input(INPUT_POST, "t_sexo", FILTER_DEFAULT);
    $t_rg			= (string) filter_input(INPUT_POST, "t_rg", FILTER_DEFAULT);
    $t_doc			= (string) filter_input(INPUT_POST, "t_doc", FILTER_DEFAULT);
    $t_telefone		= (string) filter_input(INPUT_POST, "t_telefone", FILTER_DEFAULT);
    $t_celular		= (string) filter_input(INPUT_POST, "t_celular", FILTER_DEFAULT);
    $t_nome_resp	= (string) filter_input(INPUT_POST, "t_nome_resp", FILTER_DEFAULT);
    $t_cpf_resp		= (string) filter_input(INPUT_POST, "t_cpf_resp", FILTER_DEFAULT);
    $t_cep			= (string) filter_input(INPUT_POST, "t_cep", FILTER_DEFAULT);
    $t_endereco		= (string) filter_input(INPUT_POST, "t_endereco", FILTER_DEFAULT);
    $t_numero		= (string) filter_input(INPUT_POST, "t_numero", FILTER_DEFAULT);
    $t_complemento	= (string) filter_input(INPUT_POST, "t_complemento", FILTER_DEFAULT);
    $t_bairro		= (string) filter_input(INPUT_POST, "t_bairro", FILTER_DEFAULT);
    $t_cidade		= (string) filter_input(INPUT_POST, "t_cidade", FILTER_DEFAULT);
    $t_uf			= (string) filter_input(INPUT_POST, "t_uf", FILTER_DEFAULT);
    $t_modalidade	= (string) filter_input(INPUT_POST, "t_modalidade", FILTER_DEFAULT);
    $t_email		= (string) filter_input(INPUT_POST, "t_email", FILTER_DEFAULT);

	//$t_nascimento = date('Y-m-d', strtotime($dt));
	$t_nascimento = implode("-", array_reverse(explode("/",$t_nascimento)));
	try{
		$d = new DateTime($t_nascimento);
	}catch(Exception $e){
        echo "<script>alert('Formato de data inválido')</script>
            <meta http-equiv=\"refresh\" content=\"0; URL='/perfil'\"/>";
		die();
	}
	//var_dump($t_nascimento);
	//die();

    $url = "https://adm2.totalplayer.com.br/api/v01/pAssociadoUpd";
	
	
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>"{ 
			\r\n\"nome\":\"$t_nome\",
			\r\n\"nomeMae\":\"$t_nomemae\",
			\r\n\"nascimento\":\"$t_nascimento\",
			\r\n\"sexo\":\"$t_sexo\",
			\r\n\"rg\":\"$t_rg\",
			\r\n\"telefone\":\"$t_telefone\",
			\r\n\"celular\":\"$t_celular\",
			\r\n\"nomeResp\":\"$t_nome_resp\",
			\r\n\"docResp\":\"$t_cpf_resp\",
			\r\n\"cep\":\"$t_cep\",
			\r\n\"endereco\":\"$t_endereco\",
			\r\n\"numero\":\"$t_numero\",
			\r\n\"complemento\":\"$t_complemento\",
			\r\n\"bairro\":\"$t_bairro\",
			\r\n\"cidade\":\"$t_cidade\",
			\r\n\"uf\":\"$t_uf\",
			\r\n\"modalidade\":\"$t_modalidade\"
                                }",
        CURLOPT_HTTPHEADER => array (
            "Content-type: application/json;charset=\"utf-8\"",
            "Accept: application/json",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "X-AUTH-TOKEN: " . $_SESSION['apikey'] . ""
        ),
    ));

    $response = json_decode(curl_exec($curl));

    curl_close($curl);

    if ( $response->status == "OK" ):
        echo "<script>alert('Dados alterados com sucesso!')</script>
            <meta http-equiv=\"refresh\" content=\"0; URL='/perfil'\"/>";
        //header("Location: /perfil?success=Dados alterados com sucesso!");
        exit;
    else:
        echo "<script>alert('$response->message')</script>
            <meta http-equiv=\"refresh\" content=\"0; URL='/perfil'\"/>";
        //header("Location: /perfil?error=$response->message");
        exit;
    endif;

endif;