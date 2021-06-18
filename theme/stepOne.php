<?php
//ini_set("display_errors",'on');
//error_reporting(E_ALL);

session_name('ga');
session_start();

//$cidade = $_SESSION['cidade'] = $_POST['cidade'];

//$_SESSION['cidade'] = $cidade;

//$cidade = $_POST['cidade'];
//$_SESSION['cidade'] = $cidade;

//setcookie("cidade", $cidade, time()+3600);

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://adm2.totalplayer.com.br/api/v01/pModalidade/".CLIENT_KEY,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => [],
    CURLOPT_HTTPHEADER => array (
        "Content-type: application/json;charset=\"utf-8\"",
        "Accept: application/json",
        "Cache-Control: no-cache",
        "Pragma: no-cache",
        TOKEN_HEAD
    ),
));

$lModalidade = json_decode(curl_exec($curl)); 
//$obj = $lModalidade['Modalidade'];
$arrCard = (array)$lModalidade->Modalidade;
//var_dump($obj);

//die();


curl_close($curl);
//$arrPerf = (array)$lModalidade->Modalidade;


if ( isset($_SESSION['login']) ):
    //header('Location: ./?error=Você já é cadastrado!');
    header('Location: ./perfil');
    exit;
endif;

if ( isset($_GET['idPlan']) and !empty($_GET['idPlan']) ):
    $idPlan = (int) filter_input(INPUT_GET, 'idPlan', FILTER_DEFAULT);

    if ( isset($_SESSION['idplan']) ):
        
        unset($_SESSION['idplan']);
        $_SESSION['idplan'] = $idPlan;

    else:

        $_SESSION['idplan'] = $idPlan;
    endif;

    header('Location: ./join');
    exit;

else:
    if ( !isset($_SESSION['idplan']) ):
        header('Location: ./plans');
        exit;
    endif;
endif;


?>
    <?php //var_dump(newAssociado($url));?>
    <?php //var_dump($_SESSION['idPlano']);?>
    <?php //var_dump($_SESSION['message']);
        if (isset($_SESSION['message'])) {
            echo "<div class=\"alert alert-danger\" role=\"alert\" id=\"errorFilial\">$response->message</div>";
        }
    ?>
    <?php if($data == null){ 
        //echo "<div class=\"carregaForm\"></div>";
        ?>
        <form name='frm_cadastro_socio' id='frm_cadastro_socio' method='POST' action=''>
        <div class="wizard-navigation">
            <ul>
                <li><a href="#details" data-toggle="tab">Dados Pessoais</a></li>
                <li><a href="#captain" data-toggle="tab">Contato</a></li>
                <li><a href="#description" data-toggle="tab">Endereço</a></li>
            </ul>
        </div>
        
        <div class="tab-content">
            <div class="tab-pane" id="details">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="info-text"> Se você já se vacinou começe seu cadastro agora mesmo.</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">fingerprint</i>
                                </span>
                            <div class="form-group label-floating">
                                <label class="control-label">CPF*</label>
                                <input type='text' name='doc' autocomplete='on' id='doc' value='<?=$_SESSION['doc']?><?=$doc?>' size='14' class='form-control text-left' required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">fingerprint</i>
                                </span>
                            <div class="form-group label-floating">
                                <label class="control-label">RG*</label>
                                <input type='text' name='rg' id='rg' value='<?=$_SESSION['rg']?><?=$doc?>' size='14' class='form-control text-left' required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">badge</i>
                                </span>
                            <div class="form-group label-floating">
                                <label class="control-label" for='nome'>NOME COMPLETO*</label>
                                <input type='text' name='nome' id='nome' value='<?=$_SESSION['nome']?>' size='30' class='char-count form-control text-left' required maxlength='45' style='margin-bottom: 0px;' >
                                 <p class='text-muted'><small><span name='nome'>45</span></small> caracteres restantes</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">cake</i>
                                </span>
                            <div class="form-group label-floating">
                                <label class="control-label" for='dt'>NASCIMENTO <span id='respostadt' style='color:red'></span>*</label>
                                <input type='date' name='nascimento' id='dt' value='<?=$_SESSION['dt']?>' maxlength='10' class='form-control text-left' style='line-height: 10px;' required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">transgender</i>
                                </span>
                            <div class="form-group label-floating">
                                <label class="control-label" for='sexo'>SEXO*</label>
                                <span>Masc.:</span>
                                <input class='form-check-input' type='radio' name='sexo' checked='' id='r_sexo_m' value='M'>
                                <span>Fem.:</span>
                                <input class='form-check-input' type='radio' name='sexo' checked='' id='r_sexo_f' value='F'>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">pregnant_woman</i>
                                </span>
                            <div class="form-group label-floating">
                                <label class="control-label" for='nomeMae'>NOME COMPLEMENTO DA M&Atilde;E*</label>
                                <input type='text' name='nomeMae' id='nomeMae' value='<?=$_SESSION['nomeMae']?>' size='30' class='form-control text-left' required>
                            </div>
                        </div>
                        <div class='col-sm-12 bx_responsavel' style='display: none;padding:0px;'>
                            <div class="col-sm-6" style='padding:0px;'>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">fingerprint</i>
                                    </span>
                                    <div class='form-group label-floating'>
                                        <label class="control-label" for='docResp'>CPF RESPONS&Aacute;VEL*</label>
                                        <input type='text' name='docResp' id='docResp' value='<?=$docResp?>' size='14' class='form-control text-left' required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" style='padding:0px;'>
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">badge</i>
                                        </span>
                                    <div class='form-group label-floating'>
                                        <label class="control-label" for='nomeResp'>NOME RESPONS&Aacute;VEL*</label>
                                        <input type='text' name='nomeResp' id='nomeResp' value='<?=$nomeResp?>' size='14' class='form-control text-left' required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="captain">
                <h4 class="info-text">Preencha seus dados para contato </h4>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">phone</i>
                                </span>
                            <div class="form-group label-floating">
                                <label for='telefone' class="control-label">TELEFONE</label>
                                <input type='text' name='telefone' id='telefone' value='<?=$_SESSION['telefone']?>' size='14' class='form-control text-left'>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">phone_iphone</i>
                                </span>
                            <div class="form-group label-floating">
                                <label for='celular' class="control-label">CELULAR*</label>
                                <input type='text' name='celular' id='celular' value='<?=$_SESSION['celular']?>' size='14' class='form-control text-left'>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">email</i>
                                </span>
                            <div class="form-group label-floating">
                                <label for='email' class="control-label">E-MAIL*</label>
                                <input type='text' name='email' id='email' value='<?=$_SESSION['email']?>' size='30' class='form-control text-left' required style='text-transform: lowercase;'>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">mark_email_read</i>
                                </span>
                            <div class="form-group label-floating">
                                <label for='email_repete' class="control-label">REPETIR E-MAIL*</label>
                                <input type='text' name='email_repete' id='email_repete' value='<?=$_SESSION['email_repete']?>' size='30' class='form-control text-left' required style='text-transform: lowercase;'>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="description">
                <div class="row">
                    <h4 class="info-text"> Chegamos no final, agora é só preencher seu endereço.</h4>
                    <div class="col-sm-3 col-xs-12">
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">markunread_mailbox</i>
                                </span>
                            <div class="form-group label-floating">
                                <label for='cep' class="control-label">CEP*</label>
                                <input type='text' name='cep' id='cep' value='<?=$_SESSION['cep']?>' size='14' class='form-control text-left' required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7 col-xs-10">
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">cottage</i>
                                </span>
                            <div class="form-group label-floating">
                                <label for='endereco' class="control-label">ENDERE&Ccedil;O*</label>
                                <input type='text' name='endereco' id='endereco' value='<?=$_SESSION['endereco']?>' size='30' class='form-control text-left' required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 col-xs-2">
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">pin</i>
                                </span>
                            <div class="form-group label-floating">
                                <label for='numero' class="control-label">NUMERO*</label>
                                <input type='text' name='numero' id='numero' value='<?=$_SESSION['numero']?>' size='5' class='form-control text-left' required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">maps_home_work</i>
                                </span>
                            <div class="form-group label-floating">
                                <label for='complemento' class="control-label">COMPLEMENTO</label>
                                <input type='text' name='complemento' id='complemento' value='<?=$_SESSION['complemento']?>' size='14' class='form-control text-left'>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">holiday_village</i>
                                </span>
                            <div class="form-group label-floating">
                                <label for='bairro' class="control-label">BAIRRO*</label>
                                <input type='text' name='bairro' id='bairro' value='<?=$_SESSION['bairro']?>' size='14' class='form-control text-left' required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-10">
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">location_city</i>
                                </span>
                            <div class="form-group label-floating">
                                <label for='cidade' class="control-label">CIDADE*</label>
                                <input type='text' name='cidade' id='cidade' value='<?=$_SESSION['cidade']?>' size='14' class='form-control text-left' required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 col-xs-2">
                        <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">flag</i>
                                </span>
                            <div class="form-group label-floating">
                                <label for='uf' class="control-label">UF*</label>
                                <input type='text' name='uf' id='uf' value='<?=$_SESSION['uf']?>' size='2' maxlength='2' class='form-control text-left' required>
                            </div>
                        </div>
                    </div>
                    <input type='hidden' name='pais' id='pais' value='Brasil' size='14' class='form-control text-left'>
                    <input type='hidden' name='codpais' id='codpais' value='55' placeholder='55' size='2' maxlength='2' class='form-control text-left'>
                </div>
            </div>
        </div>
        <div class="wizard-footer">
            <div class="pull-right">
                <input type='button' class='btn btn-next btn-fill btn-danger btn-wd' name='next' value='Próximo' />
                <input type='submit' name='btn_add_socio' class='btn btn-finish btn-fill btn-danger btn-wd' value='Cadastrar' />
            </div>
            <div class="pull-left">
                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Anterior' />
            </div>
            <div class="clearfix"></div>
        </div>
    </form>
    <?php
    } else{
        echo "<div class=\"alert alert-success\" role=\"alert\">
                    Cadastro efetuado com sucesso!
                </div>
                <div class=\"welcome-txt zoomIn\" data-animation=\"zoomIn\" data-delay=\"100\" style=\"margin-bottom: 20px\">
                <a href=\"/filial\" class=\"dt-sc-button medium col-xs-12 col-sm-3\" data-hover=\"Cadastre-se\" style=\"font-family: oswald;font-style: italic;\">
                    Conheça os planos
                </a>
                </div>
                ";
    }
    ?>
