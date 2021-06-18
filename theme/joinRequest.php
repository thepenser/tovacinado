<?php

session_name('ga');
session_start();


if ( isset($_SESSION['login']) ):
    echo "<script>alert('Você já é cadastrado!')</script>
          <meta http-equiv=\"refresh\" content=\"0; URL='/perfil?error=Você já é cadastrado!'\"/>";
    //header('Location: ./perfil?error=Você já é cadastrado!');
    exit;
endif;

if ( isset($_POST['doc']) and !empty($_POST['doc']) &&
     isset($_POST['rg']) and !empty($_POST['rg']) &&
     isset($_POST['nome']) and !empty($_POST['nome']) &&
     isset($_POST['nascimento']) and !empty($_POST['nascimento']) &&
     isset($_POST['celular']) and !empty($_POST['celular']) &&
     isset($_POST['uf']) and !empty($_POST['uf']) &&
     //isset($_POST['modalidade']) and !empty($_POST['modalidade']) &&
     isset($_POST['email']) and !empty($_POST['email']) && isset($_SESSION['idplan']) ):

        //date_default_timezone_set('America/Bahia');

        $doc         = (string) filter_input(INPUT_POST, "doc", FILTER_DEFAULT);		
        $rg          = (string) filter_input(INPUT_POST, "rg", FILTER_DEFAULT);		
        $nome        = (string) filter_input(INPUT_POST, "nome", FILTER_DEFAULT);		
        $dt          = filter_input(INPUT_POST, "nascimento", FILTER_DEFAULT);
        //echo $dt."<br>";
        //$dt          = date('Y-m-d', strtotime($dt));
        //die($dt);
        $sexo        = (string) filter_input(INPUT_POST, "sexo", FILTER_DEFAULT);
        $telefone    = (string) filter_input(INPUT_POST, "telefone", FILTER_DEFAULT);		
        $celular     = (string) filter_input(INPUT_POST, "celular", FILTER_DEFAULT);		
        $nomeMae     = (string) filter_input(INPUT_POST, "nomeMae", FILTER_DEFAULT);		
        $nomePai     = (string) filter_input(INPUT_POST, "nomePai", FILTER_DEFAULT);		
        $nomeResp    = (string) filter_input(INPUT_POST, "nomeResp", FILTER_DEFAULT);		
        $docResp     = (string) filter_input(INPUT_POST, "docResp", FILTER_DEFAULT);
        $cep         = (string) filter_input(INPUT_POST, "cep", FILTER_DEFAULT);
        $endereco    = (string) filter_input(INPUT_POST, "endereco", FILTER_DEFAULT);
        $numero      = (string) filter_input(INPUT_POST, "numero", FILTER_DEFAULT);
        $complemento = (string) filter_input(INPUT_POST, "complemento", FILTER_DEFAULT);
        $bairro      = (string) filter_input(INPUT_POST, "bairro", FILTER_DEFAULT);
        $cidade      = (string) filter_input(INPUT_POST, "cidade", FILTER_DEFAULT);
        $uf          = (string) filter_input(INPUT_POST, "uf", FILTER_DEFAULT);
        //$modalidade  = (string) filter_input(INPUT_POST, "modalidade", FILTER_DEFAULT);
        $pais        = (string) filter_input(INPUT_POST, "pais", FILTER_DEFAULT);
        $codpais     = (string) filter_input(INPUT_POST, "codpais", FILTER_DEFAULT);
        $email       = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $email_repete= filter_input(INPUT_POST, "email_repete", FILTER_VALIDATE_EMAIL);
        //$filial      = 1;
        $plano       = $_SESSION['idplan'];
        $titular     = 0;


        $_SESSION['doc']         = $doc;
        $_SESSION['rg']          = $rg;
        $_SESSION['nome']        = $nome;	
        $_SESSION['dt']          = $dt;
        $_SESSION['sexo']        = $sexo;
        $_SESSION['telefone']    = $telefone;
        $_SESSION['celular']     = $celular;	
        $_SESSION['nomeMae']     = $nomeMae;	
        $_SESSION['nomePai']     = $nomePai;		
        $_SESSION['nomeResp']    = $nomeResp;		
        $_SESSION['docResp']     = $docResp;
        $_SESSION['cep']         = $cep;
        $_SESSION['endereco']    = $endereco;
        $_SESSION['numero']      = $numero;
        $_SESSION['complemento'] = $complemento;
        $_SESSION['bairro']      = $bairro;
        $_SESSION['cidade']      = $cidade;
        $_SESSION['uf']          = $uf;
        //$_SESSION['modalidade']  = $modalidade;
        $_SESSION['pais']        = $pais;
        $_SESSION['codpais']     = $codpais;
        $_SESSION['email']       = $email;
        $_SESSION['email_repete']= $email_repete;
        //$_SESSION['filial']      = $filial;
        $_SESSION['plano']       = $plano;
        $_SESSION['titular']     = $titular;

        header("Location: /filial?uf=$uf");
        exit;
 
else:
        echo "<script>alert('Dados obrigatórios não preenchidos!')</script>
          <meta http-equiv=\"refresh\" content=\"0; URL='/?error=Dados obrigatórios não preenchidos'\"/>";
       //header('Location: ./join?error=Dados obrigatórios não preenchidos');
        //echo "<script>alert('Dados obrigatórios não preenchidos')</script>";
        exit;
endif;
