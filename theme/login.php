<?php

session_name('ga');
session_start();

$url = "https://adm2.totalplayer.com.br/api/v01/login";

if ( isset($_POST['login']) and !empty($_POST['login']) &&
     isset($_POST['pass']) and !empty($_POST['pass']) ):

        $login = (string) filter_input(INPUT_POST, "login", FILTER_DEFAULT);		
        $pass = (string) filter_input(INPUT_POST, "pass", FILTER_DEFAULT);	

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{
                                    \r\n\"usuario\":\"$login\",
                                    \r\n\"senha\": \"$pass\"\r\n
                                }",
            CURLOPT_HTTPHEADER => array (
                "Content-type: application/json;charset=\"utf-8\"",
                "Accept: application/json",
                "Cache-Control: no-cache",
                "Pragma: no-cache",
                TOKEN_HEAD
            ),
        ));

        $response = curl_exec($curl);
        $_response = json_decode($response);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        //if ( $httpcode == 200 && $_response->usuario == $login ):
        if ( $httpcode == 200 ):

            $_SESSION['login'] = $_response->usuario;
            $_SESSION['apikey'] = $_response->apikey;
            $_SESSION['hash'] = $_response->hash;

            header("Location: /perfil");
            exit;
        else:
            echo "<script>alert('$response')</script>
                  <meta http-equiv=\"refresh\" content=\"0; URL='/'\"/>";
            //header("Location: /?error=$response");
            exit;
        endif;

else:
    echo "<script>alert('Dados obrigatórios não preenchidos')</script>
          <meta http-equiv=\"refresh\" content=\"0; URL='/'\"/>";
    //header("Location: /?error=Dados obrigatórios não preenchidos");
    exit;
endif;