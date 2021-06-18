<?php

session_name('ga');
session_start();

if ( !isset($_SESSION['doc']) ):
    header('Location: /');
    exit;
endif;

if ( isset($_GET['idFilial']) and !empty($_GET['idFilial'])):

    $_SESSION['filial'] = filter_input(INPUT_GET, 'idFilial', FILTER_DEFAULT);
else: 

    header('Location: /filial');
    exit;
endif;

$doc         = $_SESSION['doc'];
$rg          = $_SESSION['rg'];
$nome        = $_SESSION['nome'];	
$dt          = $_SESSION['dt'];
$sexo        = $_SESSION['sexo'];
$telefone    = $_SESSION['telefone'];
$celular     = $_SESSION['celular'];	
$nomeMae     = $_SESSION['nomeMae'];	
$nomePai     = $_SESSION['nomePai'];		
$nomeResp    = $_SESSION['nomeResp'];		
$docResp     = $_SESSION['docResp'];
$cep         = $_SESSION['cep'];
$endereco    = $_SESSION['endereco'];
$numero      = $_SESSION['numero'];
$complemento = $_SESSION['complemento'];
$bairro      = $_SESSION['bairro'];
$cidade      = $_SESSION['cidade'];
$uf          = $_SESSION['uf'];
$pais        = $_SESSION['pais'];
$codpais     = $_SESSION['codpais'];
$email       = $_SESSION['email'];
$filial      = $_SESSION['filial'];
$plano       = $_SESSION['plano'];
$titular     = $_SESSION['titular'];

$url = "https://adm2.totalplayer.com.br/api/v01/pAssociadoNew";
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
                            \r\n\"nome\":\"$nome\",
                            \r\n\"rg\":\"$rg\",
                            \r\n\"doc\":\"$doc\",
                            \r\n\"nascimento\":\"$dt\",
                            \r\n\"sexo\":\"$sexo\",
                            \r\n\"telefone\":\"$telefone\",
                            \r\n\"celular\":\"$celular\",
                            \r\n\"email\":\"$email\",
                            \r\n\"nomeMae\":\"$nomeMae\",
                            \r\n\"nomePai\":\"$nomePai\",
                            \r\n\"nomeResp\":\"$nomeResp\",
                            \r\n\"docResp\":\"$docResp\",
                            \r\n\"cep\":\"$cep\",
                            \r\n\"endereco\":\"$endereco\",
                            \r\n\"numero\":\"$numero\",
                            \r\n\"complemento\":\"$complemento\",
                            \r\n\"bairro\":\"$bairro\",
                            \r\n\"cidade\":\"$cidade\",
                            \r\n\"uf\":\"$uf\",
                            \r\n\"pais\":\"$pais\",
                            \r\n\"codpais\":\"$codpais\",
                            \r\n\"filial\":\"$filial\",
                            \r\n\"plano\":\"$plano\",
                            \r\n\"foto\":\"\",
                            \r\n\"titular\":\"$titular\"
                        }",
    CURLOPT_HTTPHEADER => array (
        "Content-type: application/json;charset=\"utf-8\"",
        "Accept: application/json",
        "Cache-Control: no-cache",
        "Pragma: no-cache",
        TOKEN_HEAD
    ),
));

$response = json_decode(curl_exec($curl));

curl_close($curl);

if ( $response->status == "OK" ):

    // limpar e destruir sessões

    unset($_SESSION['doc']);
    unset($_SESSION['rg']);
    unset($_SESSION['nome']);
    unset($_SESSION['dt']);
    unset($_SESSION['sexo']);
    unset($_SESSION['telefone']);
    unset($_SESSION['celular']);
    unset($_SESSION['nomeMae']);
    unset($_SESSION['nomePai']);
    unset($_SESSION['nomeResp']);
    unset($_SESSION['docResp']);
    unset($_SESSION['cep']);
    unset($_SESSION['endereco']);
    unset($_SESSION['numero']);
    unset($_SESSION['complemento']);
    unset($_SESSION['bairro']);
    unset($_SESSION['cidade']);
    unset($_SESSION['uf']);
    unset($_SESSION['pais']);
    unset($_SESSION['codpais']);
    unset($_SESSION['email']);
    unset($_SESSION['filial']);
    unset($_SESSION['plano']);
    unset($_SESSION['titular']);

    // session_destroy();

    // session_name('ga');
    // session_start();

    $_SESSION['login'] = $email;
    $_SESSION['apikey'] = $response->apikey;
    $_SESSION['hash'] = $response->hash;
    //"<script>alert('Cadastro realizado com sucesso')</script>
    //<meta http-equiv=\"refresh\" content=\"0; URL='/perfil?success=Cadastro realizado com sucesso!&changePassword=$response->apikey'\"/>";
    //header("Location: /perfil?success=Cadastro realizado com sucesso!&changePassword=$response->apikey");
    header("Location: /perfil?Bem-Vindo");
    exit;
else:
    //$response->message = $_SESSION['message'];
/*    echo "
            <script>
            let error = document.getElementById('errorFilial');
            let response = document.createElement('$response->message');
            error.append(response);
            </script>
         ";*/
    //echo "<script>window.location.replace('/join?uf=$uf&error=$response->message')</script>";
    echo "<script>alert('$response->message')</script>
          <meta http-equiv=\"refresh\" content=\"0; URL='/?uf=$uf&error=$response->message'\"/>";
    //header("Location: /join?uf=$uf&error=$response->message");
    //var_dump($response->message);
    exit;
endif;