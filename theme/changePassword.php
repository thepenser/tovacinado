<?php 

session_name('ga');
session_start();

if ( !isset($_SESSION['login']) ):
    header('Location: /?error=Você precisa se logar antes!');
    exit;
endif;


if ( isset($_POST['pass']) and !empty($_POST['pass']) &&
     isset($_POST['confirmpass']) and !empty($_POST['confirmpass']) ):

     $pass        = (string) filter_input(INPUT_POST, "pass", FILTER_DEFAULT);		
     $confirmpass = (string) filter_input(INPUT_POST, "confirmpass", FILTER_DEFAULT);

     if ( $confirmpass !== $pass ): 
        header('Location: ' . url('perfil')."?error=As senhas não coicidem!&changePassword=".$_SESSION['apikey']);
        exit;
     endif;

        $url = "https://adm2.totalplayer.com.br/api/v01/atualizarsenha";
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
            CURLOPT_POSTFIELDS =>"{ \r\n\"senha\":\"$pass\"
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
            echo "<script>alert('Senha alterada com sucesso!')</script>
            <meta http-equiv=\"refresh\" content=\"0; URL='/perfil?success=Senha alterada com sucesso!'\"/>";
            //header("Location: /perfil?success=Senha alterada com sucesso!");
            exit;
        else:
            echo "<script>alert('$response->message')</script>
            <meta http-equiv=\"refresh\" content=\"0; URL='/perfil?error=$response->message'\"/>";
            //header("Location: /perfil?error=$response->message");
            exit;
        endif;

endif;