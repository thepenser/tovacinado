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

$v->layout('_theme');
?>
<?php $v->start('style'); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

<style type='text/css'>
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
	@media (max-width:768px){
		.heightForm {
			height: auto;
		}
	}
</style>

<?php $v->end(); ?>
        <div id="main-content">
            <section id="primary" class="content-full-width">
                <div class="dt-sc-hr-invisible"></div>
                <div class="dt-sc-hr-invisible"></div>
                <div class="fullwidth-section">
                    <div class="container">
                        <h3 class='border-title aligncenter'><span>CADASTRE-SE</span></h3>
                        <?php //var_dump($_SESSION['nomePlano']); ?>
                    </div>
                <?php //var_dump($_SESSION['message']);
                if (isset($_SESSION['message'])) {
                    echo "<div class=\"alert alert-danger\" role=\"alert\" id=\"errorFilial\">$response->message</div>";
                }
                ?>
                <div class="fullwidth-section">
                    <div class="container">
                        <?php //var_dump(newAssociado($url));?>
                        <?php //var_dump($_SESSION['idPlano']);?>

                        <?php if($data == null){

                            echo "<div class=\"carregaForm\"></div>";
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
                </div>
            </section>
        </div>

        <?php $v->insert("proximosEventos");?>

    </section>
</div>

<?php $v->start("modals"); ?>
<?php $v->end(); ?>

<?php $v->start("scripts"); ?>
<script type='text/javascript' lang='javascript'>
    var $ = jQuery;

    $(".carregaForm").append("<form name='frm_cadastro_socio' id='frm_cadastro_socio' method='POST' action=''>" +
	        "                            <div class='col-sm-12 col-xs-12 two-list'>\n" +
            "                                <div class='col-sm-6 col-md-6 col-xs-6'>\n" +
            "                                    <div class=\"col-md-12 no-padding two-list heightForm\">\n" +
            "                                        <div class='col-sm-6 col-xs-6'>\n" +
            "                                            <label for='doc'>CPF <span id='resposta' style='color:red'></span>*</label>\n" +
            "                                            <div class='form-group text-left'>\n" +
            "                                                <input type='text' name='doc' autocomplete='on' id='doc' value='<?=$_SESSION['doc']?><?=$doc?>' size='14' class=\"form-control text-left\" required>\n" +
            "                                            </div>\n" +
            "                                        </div>\n" +
            "                                        <div class='col-sm-6 col-xs-6'>\n" +
            "                                            <label for='rg'>RG*</label>\n" +
            "                                            <div class='form-group text-left'>\n" +
            "                                                <input type='text' name='rg' id='rg' value='<?=$_SESSION['rg']?><?=$doc?>' size='14' class=\"form-control text-left\" required>\n" +
            "                                            </div>\n" +
            "                                        </div>\n" +
            "                                    </div>\n" +
            "                                    <div class='col-sm-12'>\n" +
            "                                        <label for='nome'>NOME COMPLETO*</label>\n" +
            "                                        <div class='text-left'>\n" +
            "                                            <input type='text' name='nome' id='nome' value='<?=$_SESSION['nome']?>' size='30' class=\"char-count form-control text-left\" required maxlength=\"45\" placeholder=\"Seu nome deve conter até 45 caracteres\" style=\"margin-bottom: 0px;\" >\n" +
            "                                            <p class=\"text-muted\"><small><span name=\"nome\">45</span></small> caracteres restantes</p>\n" +
            "                                        </div>\n" +
            "                                    </div>\n" +
            "                                    <div class=\"col-md-12 no-padding two-list heightForm\">\n" +
            "                                        <div class='col-sm-6 col-xs-6'>\n" +
            "                                            <label for='dt'>NASCIMENTO <span id='respostadt' style='color:red'></span>*</label>\n" +
            "                                            <div class='form-group text-left'>\n" +
            "                                                <input type='date' name='nascimento' id='dt' value='<?=$_SESSION['dt']?>' maxlength='10' class=\"form-control text-left\" required>\n" +
            "                                            </div>\n" +
            "                                        </div>\n" +
            "                                        <div class='col-md-12 no-padding two-list heightForm'>\n" +
            "                                            <div class='col-sm-12 col-xs-12'>\n" +
            "                                                <label for='sexo' style='width: 50px;'>SEXO*</label>\n" +
            "                                                <div class='form-group text-left'>\n" +
            "                                                    <span>Masc.:</span>\n" +
            "                                                    <input type='radio' name='sexo' checked='' id='r_sexo_m' value='M'>\n" +
            "                                                    <span>Fem.:</span>\n" +
            "                                                    <input type='radio' name='sexo' checked='' id='r_sexo_f' value='F'>\n" +
            "                                                </div>\n" +
            "                                            </div>\n" +
            "                                        </div>\n" +
            "                                    </div>\n" +
            "                                    <div class=\"col-md-12 no-padding two-list heightForm\">\n" +
            "                                        <div class='col-sm-6 col-xs-6'>\n" +
            "                                            <label for='telefone'>TELEFONE</label>\n" +
            "                                            <div class='form-group text-left'>\n" +
            "                                                <input type='text' name='telefone' id='telefone' value='<?=$_SESSION['telefone']?>' size='14' class=\"form-control text-left\">\n" +
            "                                            </div>\n" +
            "                                        </div>\n" +
            "                                        <div class='col-sm-6 col-xs-6'>\n" +
            "                                            <label for='celular'>CELULAR*</label>\n" +
            "                                            <div class='form-group text-left'>\n" +
            "                                                <input type='text' name='celular' id='celular' value='<?=$_SESSION['celular']?>' size='14' class=\"form-control text-left\" required>\n" +
            "                                            </div>\n" +
            "                                        </div>\n" +
            "                                    </div>\n" +
            "                                    <div class=\"col-md-12 no-padding two-list heightForm\">\n" +
            "                                        <div class='col-sm-12 col-xs-12'>\n" +
            "                                            <label for='nomeMae'>NOME COMPL. M&Atilde;E*</label>\n" +
            "                                            <div class='form-group text-left'>\n" +
            "                                                <input type='text' name='nomeMae' id='nomeMae' value='<?=$_SESSION['nomeMae']?>' size='30' class=\"form-control text-left\" required>\n" +
            "                                            </div>\n" +
            "                                        </div>\n" +
            "                                    </div>\n" +
            "                                    <div class='col-sm-12 bx_responsavel' style='display: none;'>\n" +
            "                                        <label for='docResp'>CPF RESPONS&Aacute;VEL*</label>\n" +
            "                                        <div class='form-group text-left'>\n" +
            "                                            <input type='text' name='docResp' id='docResp' value='<?=$docResp?>' size='14' class=\"form-control text-left\" required>\n" +
            "                                        </div>\n" +
            "                                        <label for='nomeResp'>NOME RESPONS&Aacute;VEL*</label>\n" +
            "                                        <div class='form-group text-left'>\n" +
            "                                            <input type='text' name='nomeResp' id='nomeResp' value='<?=$nomeResp?>' size='14' class=\"form-control text-left\" required>\n" +
            "                                        </div>\n" +
            "                                    </div>\n" +
            "                                </div>\n" +
            "                                <div class='col-sm-6 col-md-6 col-xs-6'>\n" +
            "                                    <div class=\"col-md-12 no-padding two-list heightForm\">\n" +
            "                                        <div class='col-sm-3 col-xs-12'>\n" +
            "                                            <label for='cep'>CEP*</label>\n" +
            "                                            <div class='form-group text-left'>\n" +
            "                                                <input type='text' name='cep' id='cep' value='<?=$_SESSION['cep']?>' size='14' class=\"form-control text-left\" required>\n" +
            "                                            </div>\n" +
            "                                        </div>\n" +
            "                                            <div class='col-sm-7 col-xs-10'>\n" +
            "                                                <label for='endereco'>ENDERE&Ccedil;O*</label>\n" +
            "                                                <div class='form-group text-left'>\n" +
            "                                                    <input type='text' name='endereco' id='endereco' value='<?=$_SESSION['endereco']?>' size='30' class=\"form-control text-left\" required>\n" +
            "                                                </div>\n" +
            "                                            </div>\n" +
            "                                            <div class='col-sm-2 col-xs-2'>\n" +
            "                                                <label for='numero'>NUMERO*</label>\n" +
            "                                                <div class='form-group text-left' style='display: -webkit-box;'>\n" +
            "                                                    <input type='text' name='numero' id='numero' value='<?=$_SESSION['numero']?>' size='5' class=\"form-control text-left\" required style=\"padding-left: 0px;padding-right: :0px;\">\n" +
            "                                                </div>\n" +
            "                                            </div>\n" +
            "                                    </div>\n" +
			/*
            "                                    <div class='col-sm-12 col-xs-12'>\n" +
			"											<input name='endereco' id='endereco' value='<?php echo $endereco; ?>' style='width:100%'>\n" +
			"											<input name='bairro' id='bairro' value='<?php echo $bairro; ?>' style='width:50%'>\n" +
			"											<input name='cidade' id='cidade' value='<?php echo $cidade; ?>' style='width:30%'>\n" +
			"											<input name='uf' id='uf' value='<?php echo $uf; ?>' style='width:10%'>\n" +
			"									</div>\n" +
			*/
            "                                    <div class=\"col-md-12 no-padding two-list heightForm\">\n" +
            "                                        <div class='col-sm-6 col-xs-2'>\n" +
            "                                            <label for='complemento'>COMPLEMENTO</label>\n" +
            "                                            <div class='form-group text-left'>\n" +
            "                                                <input type='text' name='complemento' id='complemento' value='<?=$_SESSION['complemento']?>' size='14' class=\"form-control text-left\">\n" +
            "                                            </div>\n" +
            "                                        </div>\n" +
            "                                        <div class='col-sm-6 col-xs-2'>\n" +
            "                                            <label for='bairro'>BAIRRO*</label>\n" +
            "                                            <div class='form-group text-left'>\n" +
            "                                                <input type='text' name='bairro' id='bairro' value='<?=$_SESSION['bairro']?>' size='14' class=\"form-control text-left\" required>\n" +
            "                                            </div>\n" +
            "                                        </div>\n" +
            "                                    </div>\n" +
            "                                    <div class='col-md-12 no-padding two-list heightForm'>\n" +
            "                                        <div class='col-md-4'>\n" +
            "                                            <label for='cidade'>CIDADE*</label>\n" +
            "                                            <div class='form-group text-left'>\n" +
            "                                                <input type='text' name='cidade' id='cidade' value='<?=$_SESSION['cidade']?>' size='14' class=\"form-control text-left\" required>\n" +
            "                                            </div>\n" +
            "                                        </div>\n" +
            "                                        <div class='col-md-2'>\n" +
            "                                            <label for='uf'>UF*</label>\n" +
            "                                            <div class='form-group text-left'>\n" +
            "                                                <input type='text' name='uf' id='uf' value='<?=$_SESSION['uf']?>' size='2' maxlength='2' class=\"form-control text-left\" required>\n" +
            "                                            </div>\n" +
            "                                        </div>\n" +
            "                                    </div>\n" +
            "                                    <div class='col-md-12 no-padding two-list heightForm'>\n" +
            "                                        <div class='col-sm-6 col-xs-12'>\n" +
            "                                            <label for='email'>EMAIL*</label>\n" +
            "                                            <div class='form-group text-left'>\n" +
            "                                                <input type='text' name='email' id='email' value='<?=$_SESSION['email']?>' size='30' class=\"form-control text-left\" required style=\"text-transform: lowercase;\">\n" +
            "                                            </div>\n" +
            "                                        </div>\n" +
            "                                        <div class='col-sm-6 col-xs-12'>\n" +
            "                                            <label for='email_repete'>REPETIR EMAIL*</label>\n" +
            "                                            <div class='form-group text-left'>\n" +
            "                                                <input type='text' name='email_repete' id='email_repete' value='<?=$_SESSION['email_repete']?>' size='30' class=\"form-control text-left\" required style=\"text-transform: lowercase;\">\n" +
            "                                            </div>\n" +
            "                                        </div>\n" +
            "                                    </div>\n" +
            "                                    <input type='hidden' name='pais' id='pais' value='Brasil' size='14' class=\"form-control text-left\">\n" +
            "                                    <input type='hidden' name='codpais' id='codpais' value='55' placeholder=\"55\" size='2' maxlength='2' class=\"form-control text-left\">\n" +
            "                                </div>\n" +
            "                            </div>\n" +
	        "                            <div class='col-sm-12 col-xs-12 two-list'>\n" +
            "                                    <div class='col-md-12 two-list'>\n" +
            "                                        <div class='col-sm-6 col-xs-12'>\n" +
            "                                            <label for='modalidade' style='width:100%'>POR QUAL MODALIDADE VOCÊ SE PROFISSIONALIZOU*</label>\n" +
            "                                            <div class='form-group text-left'>\n" +
			"												<select name='modalidade' id='modalidade' required>\n"+
			"												<?php foreach($arrCard as $f){ ?>\n"+
			"													<option name='<?=$f;?>'><?=$f;?></option>'\n"+
			" 												<?php } ?>	\n"+	
			"												</select>\n"+
            "                                            </div>\n" +
            "                                        </div>\n" +
            "                                    </div>\n" +
            "                            </div>\n" +
            "                            <div class='col-sm-12 col-md-12 col-xs-12' style='margin-top:40px'>\n" +
            "                                <div class='row'>\n" +
            "                                    <h1 class='titulo1'>CONTRATO</h1>\n" +
            "                                    <embed width=\"100%\" height=\"450px\" name=\"plugin\" src='/theme/contrato.pdf' type=\"application/pdf\">\n" +
            "                                </div>\n" +
            "                                <div class='row'>\n" +
            "                                    <div class='col-sm-12 col-md-12 col-xs-12'>\n" +
            "                                        <br /><br />\n" +
            "                                        <input type='checkbox' name='t_aceite' id='t_aceite' value='SIM'>\n" +
            "                                        <label for='t_aceite' style='width: 500px; font-size: 1.5em;'>Li e aceito os termos do contrato:</label>\n" +
            "                                    </div>\n" +
            "                                </div>\n" +
            "                                <div class='row'>\n" +
            "                                    <div class='col-sm-12 col-md-12 col-xs-12'>\n" +
            "                                        <img id='captcha' src='<?=url("/")?><?php echo "/theme/portal/includes/captcha/securimage_show.php"?>'><br />\n" +
            "                                        <a href='#' id='upd_captcha'>ALTERAR CAPTCHA</a>\n" +
            "                                        <label>Informe o codigo acima:</label>\n" +
            "                                        <input type='text' name='captcha_code' id='captcha_code' size='10' maxlength='6' class='col-sm-3' >\n" +
            "                                        <button type='submit' name='btn_add_socio' value='' class='dt-sc-button medium' style='float:left;'>Cadastre-se</button>\n" +
            "                                    </div>\n" +
            "                                </div>\n" +
            "                            </div>\n" +
            "                        </form>");
			

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
                    modalidade: { required:true },
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
                    modalidade:
                        {
                            required:'INFORME SUA MODALIDADE'
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
    <?php $v->end(); ?>
