<?php
session_name('ga');
session_start();
$v->layout('_theme');

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

$_SESSION['idPlan'] = 2;
if ( isset($_GET['idPlan']) and !empty($_GET['idPlan']) ):
    $idPlan = (int) filter_input(INPUT_GET, 'idPlan', FILTER_DEFAULT);

    if ( isset($_SESSION['idplan']) ):
        
        unset($_SESSION['idplan']);
        $_SESSION['idplan'] = $idPlan;

    else:

        $_SESSION['idplan'] = $idPlan;
    endif;

    header('Location: ./');
    exit;

else:
    if ( !isset($_SESSION['idplan']) ):
        header('Location: ./plans');
        exit;
    endif;
endif;


$curli = curl_init();

curl_setopt_array($curli, array(
    CURLOPT_URL => "https://adm2.totalplayer.com.br/api/v01/pPlanos/".CLIENT_KEY,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_POSTFIELDS => "first_name=Robson&last_name=Leite&email=cursos%40upinside.com.br",
    CURLOPT_HTTPHEADER => array (
        "Content-type: application/json;charset=\"utf-8\"",
        "Accept: application/json",
        "Cache-Control: no-cache",
        "Pragma: no-cache",
        TOKEN_HEAD
    ),
));

$plano = json_decode(curl_exec($curli));
$err = curl_error($curli);

curl_close($curli);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    //echo $plano;
}

?>
<?php $v->start('style'); ?>
<!--
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
-->
<style>
    .wizard-container{
        padding-top: 50px!important;
    }
    .wizard-card {
        box-shadow: 0 16px 24px 2px #f443364f, 0 6px 30px 5px #f44336, 0 8px 10px -5px #f443363b;
    }
    .wizard-header img{
        width:18%;
    }
    .wizard-header{
        padding: 10px 0 35px!important;
    }
    <!--
    label{ *display:inline; display:inline-block; width:230px; }
    .dlg-body dd{ text-align:left; }
    .dlg-body dd label{ cursor:pointer; }

    .box-info{
        position: absolute;
        width: 450px;
        background: white;
        border: solid 3px #000;
        padding: .8em;
        border-radius: .5em;
        box-shadow: .5em .5em .5em .05em rgba(0, 0, 0, 0.5);
        line-height: 1.3em;
        right: 0px;
        margin: 0 13em 0 0;
        display:none;
    }

    #t_aceite{
        height: 25px;
        width: 25px;
        vertical-align: middle;
    }

    -->        .no-padding {            padding-right: 0px;            padding-left: 0px;            }
    .box-info{            position: absolute;            width: 450px;            background: white;            border: solid 3px #000;            padding: .8em;            border-radius: .5em;            box-shadow: .5em .5em .5em .05em rgba(0, 0, 0, 0.5);            line-height: 1.3em;            right: 0px;            margin: 0 13em 0 0;            display:none;            z-index:999;        }        .content .bx_top .menu {            vertical-align: top;            position: relative;            display: inline-block;            margin-top: 70px;        }
    .content .bx_top .bx_placar .lb_dthora {            text-align: center;            position: relative;            bottom: 0;            margin: 30px auto;        }

    @media (min-width: 768px){
        .two-list{
            display:-webkit-box!important;
        }
    }
	input[type="text"], input[type="password"], input[type="email"], input[type="url"], input[type="tel"], input[type="number"], input[type="range"], input[type="date"], textarea, input.text, input[type="search"] {
		background: #ffffff;
		border: 1px solid #e5e5d8;
		color: #6a695e;
		padding: 5px 10px;
		display: block;
		font-size: 14px;
		margin: 0px 0 0px;
		width: 100%;
		box-sizing: border-box;
		height: 32px;
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
	}
	.heightForm{
		height:65px;
	}
	.text-muted{
		margin-bottom: 0px;
		font-size: 75%;
	}
    label.error{
        font-size: 8px;
        color: red;
        margin: auto;
        position: relative;
        top: -52px;
    }
	.selection-box select {
		border: 1px solid #e5e5d8;
		padding: 0px 10px;
		height: 35px;
		border-radius: 5px;
	}
	.selection-box:after {
		width: 50px;
		height: 35px;
		background: #b5c05b!important;
		right: 0px;
		top: 0px;
		border-radius: 0px 5px 5px 0px;
	}
    .form-group.label-floating label.control-label, .form-group.label-placeholder label.control-label {
        top: -20px;
        font-size: 12px;
    }
    .wizard-card .info-text {
        color: #f44336;
        font-weight: 800;
        text-transform: uppercase;
        margin: auto;
        padding-top: 30px;
    }
	@media (max-width:768px){
		.heightForm {
			height: auto;
		}
	}
</style>
<?php $v->end(); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
            <?php //var_dump($_SESSION['message']);
                if (isset($_SESSION['message'])) {
                    echo "<div class=\"alert alert-danger\" role=\"alert\" id=\"errorFilial\">$response->message</div>";
                }
            ?>
                <div class="wizard-container">
                    <div class="card wizard-card" data-color="red" id="wizard">
                            <div class="wizard-header">
                                <?php
                                if($plano){
                                    foreach($plano as $plan){
                                        ?>
                                            <img class="col-sm-12 col-xs-12" title="" alt="" src="data:image/jpeg;base64, <?=$plan->thumb;?>">
                                            <h3 class="wizard-title">
                                                <?=$plan->nome;?>
                                            </h3>
                                            <?=$plan->descricao;?>
                                        <?php  } }else{ ?>
                                        <h3 class="wizard-title">
                                            ESTOU VACINADO!
                                        </h3>
                                    <?php
                                }
                                ?>
                            </div>
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
                    </div>
                </div> <!-- wizard container -->
            </div>
        </div> <!-- row -->
    </div> <!--  big container -->
    <?php $v->insert("footer");?>
</div>
<?php $v->start("scripts"); ?>

<script type="text/javascript">
    $(window).load(function() {
        $('#myModal').modal('show');
    });

    $("setaPlano").submit(function (e) {
    e.preventDefault();
    let form = $(this);
        $.ajax({
        url: form.attr("action"),
        data: form.serialize(),
        type: "POST",
        dataType: "json",

        });
    });

    $("body").on("click", "[data-action]", function (e) {
        e.preventDefault();
        let data = $(this).data();
        let div = $(this).parent();

        $.post(data.action, data, function () {
            div.fadeout();
        }, "json")
    })

    
        $(function(){

            console.log('informe validacao');

            $('#frm_cadastro_socio').validate({
                errorLabelContainer: $(".dlg-body", $(".bx_dialog")),
                wrapper: 'div',
                rules:{
                    nome:{ required:true, minlength:8, maxlength:45 },
                    nomeMae:{ required:true },
                    dt: {
                        required:true,
                        dateBR:true
                    },
                    sexo: { required:true },
                    rg: { required:true },
                    doc: { required:true },
                    celular: { required:true },
                    cep: { required:true },
                    endereco: { required:true },
                    numero: {
                        required:true
                    },
                    bairro: { required:true },
                    cidade: { required:true },
                    uf: { required:true },
                    email: { email:true, required:true },
                    email_repete: { equalTo: $('#email') },
                    captcha_code: { required:true },
                    t_aceite: { required:true }
                },
                messages:{
                    nome:
                        {
                            required:'INFORME O NOME!',
                            minlength:'Seu nome de conter no máximo 38 caracteres',
                            maxlength:'Seu nome de conter no mínimo 8 caracteres'
                        },
                    nomeMae:
                        {
                            required:'INFORME O NOME COMPLETO DA MÃE!'
                        },
                    dt:
                        {
                            required:'INFORME A DATA DE NASCIMENTO COMPOSTA POR XX/XX/XXXX!',
                            dateBR:'INFORME UMA DATA VÁLIDA'
                        },
                    sexo:
                        {
                            required:'INFORME O SEXO!'
                        },
                    rg:
                        {
                            required:'INFORME O RG'
                        },
                    doc:
                        {
                            cpf:'INFORME UM CPF VÁLIDO',
                            required:'INFORME O CPF'
                        },
                    celular:
                        {
                            required:'INFORME UM CELULAR PARA CONTATO'
                        },
                    cep:
                        {
                            required:'INFORME O CEP'
                        },
                    endereco:
                        {
                            required:'INFORME O ENDEREÇO'
                        },
                    numero:
                        {
                            required:'INFORME O NÚMERO'
                        },
                    bairro:
                        {
                            required:'INFORME O BAIRRO'
                        },
                    cidade:
                        {
                            required:'INFORME A CIDADE'
                        },
                    uf:
                        {
                            required:'INFORME O ESTADO'
                        },
                    email:
                        {
                            required:'CAMPO EMAIL OBRIGATÓRIO',
                            email:'INFORME UM EMAIL VÁLIDO PARA CONTATO!'
                        },
                    email_repete:
                        {
                            equalTo:'CAMPO REPETIR EMAIL INVÁLIDO!'
                        },
                    captcha_code:
                        {
                            required:'INFORME O CÓDIGO CAPTCHA'
                        },
                    t_aceite:
                        {
                            required:'PARA CONTINUAR, ACEITE OS TERMOS DO CONTRATO'
                        }
                },
                invalidHandler: function (form, validator) {
                    $('.bx_dialog .dlg-body').html('');
                    $('.bx_dialog .dlg-title').html('ERRO FORMULÁRIO');
                    $('.dlg-bx-mask').fadeIn(function(){ $('.dlg-body dd label').on('click',function(){ $('.dlg_close').trigger('click'); }); });
                }
            });


        });
    function CPF(){"user_strict";function r(r){for(var t=null,n=0;9>n;++n)t+=r.toString().charAt(n)*(10-n);var i=t%11;return i=2>i?0:11-i}function t(r){for(var t=null,n=0;10>n;++n)t+=r.toString().charAt(n)*(11-n);var i=t%11;return i=2>i?0:11-i}var n="Inválido",i="Válido";this.gera=function(){for(var n="",i=0;9>i;++i)n+=Math.floor(9*Math.random())+"";var o=r(n),a=n+"-"+o+t(n+""+o);return a},this.valida=function(o){for(var a=o.replace(/\D/g,""),u=a.substring(0,9),f=a.substring(9,11),v=0;10>v;v++)if(""+u+f==""+v+v+v+v+v+v+v+v+v+v+v)return n;var c=r(u),e=t(u+""+c);return f.toString()===c.toString()+e.toString()?i:n}}

    var CPF = new CPF();

    $("#doc").on('blur',function() {
        var vld = CPF.valida($(this).val());
        if (vld == 'Inválido'){
            $("#resposta").html('Inválido');
            document.getElementById("doc").select();
        }else{
            $("#resposta").html('');
        }
    });

		$(document).ready(function() {
                function limpa_formulário_cep() {
                    // Limpa valores do formulário de cep.
                    $("#endereco").val("");
                    $("#bairro").val("");
                    $("#cidade").val("");
                    $("#uf").val("");
                    $("#ibge").val("");
                }

                //Quando o campo cep perde o foco.
                $("#cep").blur(function() {

                    //Nova variável "cep" somente com dígitos.
                    var cep = $(this).val().replace(/\D/g, '');

                    //Verifica se campo cep possui valor informado.
                    if (cep != "") {

                        //Expressão regular para validar o CEP.
                        var validacep = /^[0-9]{8}$/;

                        //Valida o formato do CEP.
                        if(validacep.test(cep)) {

                            //Preenche os campos com "..." enquanto consulta webservice.
                            $("#endereco").val("...");
                            $("#bairro").val("...");
                            $("#cidade").val("...");
                            $("#uf").val("...");
                            $("#ibge").val("...");

                            //Consulta o webservice viacep.com.br/
                            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                                if (!("erro" in dados)) {
                                    //Atualiza os campos com os valores da consulta.
                                    $("#endereco").val(dados.logradouro);
                                    $("#bairro").val(dados.bairro);
                                    $("#cidade").val(dados.localidade);
                                    $("#uf").val(dados.uf);
                                    $("#ibge").val(dados.ibge);
                                } //end if.
                                else {
                                    //CEP pesquisado não foi encontrado.
                                    limpa_formulário_cep();
                                    alert("CEP não encontrado.");
                                }
                            });
                        } //end if.
                        else {
                            //cep é inválido.
                            limpa_formulário_cep();
                            alert("Formato de CEP inválido.");
                        }
                    } //end if.
                    else {
                        //cep sem valor, limpa formulário.
                        limpa_formulário_cep();
                    }
                });
            });		

            //$('#dt').mask('99/99/9999')
                $('#dt').on('blur',{},function(){
                    var tmp_dt              = $(this).val().split('/');
                    var dob                 = new Date(tmp_dt[2] + '-' + tmp_dt[1] + '-' + tmp_dt[0]);
                    var currentDate         = new Date();
                    var currentYear         = currentDate.getFullYear();
                    var birthdayThisYear    = new Date(currentYear, dob.getMonth(), dob.getDate());
                    var age = currentYear - dob.getFullYear();
                    var oldYear             = dob.getFullYear();

                    if (oldYear < 1920 ){
                        //alert('Ano inválido');
                        $("#respostadt").html('Inválido');
                        document.getElementById("dt").select();
                    }else{
                        $("#respostadt").html('');
                    }

                    if(birthdayThisYear > currentDate) age--;
                    console.log('IDADE = ' + age);
                    if(age < 18)
                    {
                        $('.bx_responsavel').fadeIn(function(){
                            $('#docResp').rules('add',{
                                required:true,
                                messages:{
                                    required:'INFORME O CPF DO RESPONÁVEL'
                                }
                            });

                            $('#nomeResp').rules('add',{
                                required:true,
                                messages:{
                                    required:'INFORME O NOME DO RESPONÁVEL'
                                }
                            });

                        });

                    }else
                    {
                        $('.bx_responsavel').fadeOut(function(){
                            $('#docResp,#nomeResp').rules('remove');
                        });
                    }

                });
				
           $('#doc').mask('999.999.999-99');
            $('#docResp').mask('999.999.999-99');
            $('#celular').mask('(99)99999-9999');
            $('#telefone').mask('(99)9999-9999');
            $('#cep').mask('99999-999');
            //$('#dt').mask('99/99/9999');
            

            $('#upd_captcha').on('click',function(){
                $('#captcha').attr('src','https://eusoutorcedor.com.br/portal/includes/captcha/securimage_show.php?' + Math.random());
                return false;
            });

            $('.btn-form-help')
                .on('mouseover',function(){
                    $('.box-info').slideDown();
                })
                .on('mouseout',function(){
                    $('.box-info').slideUp();
                });
				
        $(document).ready(function(){
            $('.char-count').keyup(function() {
                var maxLength = parseInt($(this).attr('maxlength'));
                var length = $(this).val().length;
                var newLength = maxLength-length;
                var name = $(this).attr('name');
                $('span[name="'+name+'"]').text(newLength);
            });
        });
    </script>
</script>

<?php $v->end(); ?>