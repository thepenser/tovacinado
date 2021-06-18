<?php
session_start();

function newAssociado($url){

        $doc = $_SESSION['doc'] = $_POST['doc'];
        $rg = $_SESSION['rg'] = $_POST['rg'];
        $nome = $_SESSION['nome'] = $_POST['nome'];
        $dt = $_SESSION['dt'] = $_POST['dt'];
        $sexo = $_SESSION['sexo'] = $_POST['sexo'];
        $telefone = $_SESSION['telefone'] = $_POST['telefone'];
        $celular = $_SESSION['celular'] = $_POST['celular'];
        $nomeMae = $_SESSION['nomeMae'] = $_POST['nomeMae'];
        $nomeResp = $_SESSION['nomeResp'] = $_POST['nomeResp'];
        $docResp = $_SESSION['docResp'] = $_POST['docResp'];
        $cep = $_SESSION['cep'] = $_POST['cep'];
        $endereco = $_SESSION['endereco'] = $_POST['endereco'];
        $numero = $_SESSION['numero'] = $_POST['numero'];
        $complemento = $_SESSION['complemento'] = $_POST['complemento'];
        $bairro = $_SESSION['bairro'] = $_POST['bairro'];
        $cidade = $_SESSION['cidade'] = $_POST['cidade'];
        $uf = $_SESSION['uf'] = $_POST['uf'];
        $pais = $_SESSION['pais'] = $_POST['pais'];
        $codpais = $_SESSION['codpais'] = $_POST['codpais'];
        $email = $_SESSION['email'] = $_POST['email'];
        $filial = $_SESSION['filial'] = $_POST['filial'];
        $titular = $_SESSION['titular'] = $_POST['titular'];

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
        CURLOPT_POSTFIELDS =>"{\r\n\"nome\":\"$nome\",
            \r\n\"rg\":\"$rg\",
            \r\n\"doc\":\"$doc\",
            \r\n\"dt\":\"$dt\",
            \r\n\"sexo\":\"$sexo\",
            \r\n\"telefone\":\"$telefone\",
            \r\n\"celular\":\"$celular\",
            \r\n\"email\":\"$email\",
            \r\n\"nomeMae\":\"$nomeMae\",
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

    $err = curl_error($curl);
    $response = curl_exec($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo "<div class=\"alert alert-success\" role=\"alert\" style=\"padding-top:60px\">
                   ". $response ."
              </div>";
        //header('Location: congratulations');
        //exit;
    }
}return;