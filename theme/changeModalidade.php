<?php

session_name('ga');
session_start();

if ( !isset($_SESSION['login']) ):
    header('Location: /?error=Você precisa se logar antes!');
    exit;
endif;


if ( isset($_POST['t_mod']) ):

	//date_default_timezone_set('America/Bahia');

    $t_nome		= (string) filter_input(INPUT_POST, "t_nome", FILTER_DEFAULT);
    $t_mod		= (string) filter_input(INPUT_POST, "t_mod", FILTER_DEFAULT);


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
			\r\n\"modalidade\":\"$t_mod\"
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
        echo "<script>alert('Modalidade alterada com sucesso!')</script>
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