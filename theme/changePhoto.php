<?php

session_name('ga');
session_start();

if ( !isset($_SESSION['login']) ):
    header('Location: /?error=Você precisa se logar antes!');
    exit;
endif;

if ( isset($_FILES['image']) ):

    $allowed_ext = array('jpg','jpeg','png','gif');
    $file_name   = $_FILES['image']['name'];
    $file_ext    = strtolower( end(explode('.',$file_name)));

    $file_size   = $_FILES['image']['size'];
    $file_tmp    = $_FILES['image']['tmp_name'];

    $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
    $data = file_get_contents($file_tmp);
    $base64 = base64_encode($data); // 'data:image/' . $type . ';base64,' || data://application/pdf;base64,


    if ( in_array($file_ext, $allowed_ext) === false ):

        $error = 'Formato de arquivo não autorizado!';
    endif;

    if ( $file_size > 2097152 ):

        $error = 'A imagem deve ser menor que 2mb';
    endif;

    if ( isset($error) ):
        header('Location: ' . url('perfil')."?error=$error");
        exit;
    endif;

    $url = "https://adm2.totalplayer.com.br/api/v01/pAssociadoUpd";
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>"{ 
                                    \r\n\"foto\":\"$base64\"
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

        header("Location: /perfil?success=Foto de perfil salva com sucesso!");
        exit;
    else:

        header("Location: /perfil?error=$response->message");
        exit;
    endif;
else:
    header("Location: /perfil?error=A imagem é obrigatório");
    exit;
endif;