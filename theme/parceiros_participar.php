<?php
session_name('ga');
session_start();

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
</style>
<style type='text/css'>
    <!--
    label {
        width: 150px;
        display: inline-block;
    }
    dt,dd{ margin:0; padding: 0;}

    .dlg-body dd label{ display:block!important; }

    -->
    iframe {
        max-width: 100%;
        height: 100%!important;
        min-height: 1200px!important;
    }

    @media (min-width:768px){
        iframe {
            margin-top: 110px;
        }
    }
	label {
		width: 100%;
	}
</style>
<?php $v->end(); ?>

<div id="main-content">
    <section id="primary" class="content-full-width">
        <div class="dt-sc-hr-invisible"></div>
        <div class="dt-sc-hr-invisible"></div>
        <div class="fullwidth-section">
            <div class="container">
                <h3 class='border-title aligncenter'><span>CADASTRO DE PARCEIRO</span></h3>
                <?php //var_dump($_SESSION['nomePlano']); ?>
            </div>
            <div class="fullwidth-section">
                <div class="container">
                    <?php //var_dump(newAssociado($url));?>
                    <?php //var_dump($_SESSION['idPlano']);?>

                    <?php if($data == null){

                        echo "<div class=\"carregaFormPartner\"></div>";
                    } else{
                        echo "<div class=\"alert alert-success\" role=\"alert\">
                                       Cadastro efetuado com sucesso!
                                  </div>
                                  <div class=\"welcome-txt zoomIn\" data-animation=\"zoomIn\" data-delay=\"100\" style=\"margin-bottom: 20px\">
                                    <a href=\"/filial\" class=\"dt-sc-button medium col-xs-12 col-sm-3\" data-hover=\"Filie-se\" style=\"font-family: oswald;font-style: italic;\">
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

    $(".carregaFormPartner").append("<form name='frm_cadastro_partner' id='frm_cadastro_partner' method='POST' action=''>" +
        "                            <div class='col-sm-12 col-xs-12 two-list'>\n" +
        "                                <div class='col-sm-6 col-md-6 col-xs-6'>\n" +
        "                                    <div class='col-sm-12'>\n" +
        "                                        <label for='nome'>Área de Atuação:</label>\n" +
        "                                        <div class='text-left'>\n" +
        "                                            <input type='text' name='atuacao' id='atuacao' value='' size='30' class=\"form-control text-left\" required=\"required\" maxlength=\"45\" placeholder=\"Selecione sua área de atuação\" style=\"margin-bottom: 0px;\" >\n" +
        "                                        </div>\n" +
        "                                    </div>\n" +
        "                                    <div class=\"col-md-12 no-padding two-list\">\n" +
        "                                        <div class='col-sm-4 col-xs-12'>\n" +
        "                                            <label for='doc'>CNPJ:</label>\n" +
        "                                            <div class='form-group text-left'>\n" +
        "                                                <input type='text' name='doc' id='doc' value='' size='14' class=\"form-control text-left\" required=\"required\">\n" +
        "                                            </div>\n" +
        "                                        </div>\n" +
        "                                        <div class='col-sm-4 col-xs-6'>\n" +
        "                                            <label for='telefone'>TELEFONE:</label>\n" +
        "                                            <div class='form-group text-left'>\n" +
        "                                                <input type='text' name='telefone' id='telefone' value='<?php echo $telefone; ?>' size='14' class=\"form-control text-left\">\n" +
        "                                            </div>\n" +
        "                                        </div>\n" +
        "                                        <div class='col-sm-4 col-xs-6'>\n" +
        "                                            <label for='dt'>DATA ABERTURA:</label>\n" +
        "                                            <div class='form-group text-left'>\n" +
        "                                                <input type='date' name='abertura' id='abertura' value='' size='14' class=\"form-control text-left\" required=\"required\">\n" +
        "                                            </div>\n" +
        "                                        </div>\n" +
        "                                    </div>\n" +
	
        "                                    <div class='col-sm-12'>\n" +
        "                                        <label for='nome'>RAZÃO SOCIAL:</label>\n" +
        "                                        <div class='text-left'>\n" +
        "                                            <input type='text' name='razao' id='razao' value='' size='30' class=\"char-count form-control text-left\" required=\"required\" maxlength=\"45\" placeholder=\"Seu nome deve conter até 45 caracteres\" style=\"margin-bottom: 0px;\" >\n" +
        "                                            <p class=\"text-muted\"><small><span name=\"razao\">45</span></small> caracteres restantes</p>\n" +
        "                                        </div>\n" +
        "                                    </div>\n" +
        "                                    <div class='col-sm-12'>\n" +
        "                                        <label for='nome'>NOME FANTASIA:</label>\n" +
        "                                        <div class='text-left'>\n" +
        "                                            <input type='text' name='nome' id='nome' value='<?php echo $nome; ?>' size='30' class=\"char-count form-control text-left\" required=\"required\" maxlength=\"45\" placeholder=\"Seu nome deve conter até 45 caracteres\" style=\"margin-bottom: 0px;\" >\n" +
        "                                            <p class=\"text-muted\"><small><span name=\"nome\">45</span></small> caracteres restantes</p>\n" +
        "                                        </div>\n" +
        "                                    </div>\n" +
        "                                    <div class=\"col-md-12 no-padding two-list\">\n" +
        "                                        <div class='col-sm-6 col-xs-12'>\n" +
        "                                            <label for='cpf'>CPF DO REPRESENTANTE LEGAL:</label>\n" +
        "                                            <div class='form-group text-left'>\n" +
        "                                                <input type='text' name='cpf' id='cpf' value='' size='14' class=\"form-control text-left\" required=\"required\">\n" +
        "                                            </div>\n" +
        "                                        </div>\n" +
        "                                    	<div class='col-sm-6 col-xs-12'>\n" +
        "                                        	<label for='nome'>NOME COMPLETO DO REPRESENTANTE LEGAL:</label>\n" +
        "                                        	<div class='text-left'>\n" +
        "                                            	<input type='text' name='nomecompleto' id='nomecompleto' value='<?php echo $nome; ?>' size='30' class=\"char-count form-control text-left\" required=\"required\" maxlength=\"45\" placeholder=\"Seu nome deve conter até 45 caracteres\" style=\"margin-bottom: 0px;\" >\n" +
        "                                           	 <p class=\"text-muted\"><small><span name=\"nomecompleto\">45</span></small> caracteres restantes</p>\n" +
        "                                       	 </div>\n" +
        "                                    	</div>\n" +
        "                                    </div>\n" +
        "                                    <div class=\"col-md-12 no-padding two-list \">\n" +
        "                                        <div class='col-sm-6 col-xs-6'>\n" +
        "                                            <label for='dt'>Data de Nascimento:</label>\n" +
        "                                            <div class='form-group text-left'>\n" +
        "                                                <input type='text' name='nascimento' id='dt' value='<?php echo $dt; ?>' size='14' class=\"form-control text-left\" required=\"required\">\n" +
        "                                            </div>\n" +
        "                                        </div>\n" +
        "                                        <div class='col-sm-6 col-xs-6'>\n" +
        "                                            <label for='telefone'>TELEFONE:</label>\n" +
        "                                            <div class='form-group text-left'>\n" +
        "                                                <input type='text' name='telefone' id='telefone' value='<?php echo $telefone; ?>' size='14' class=\"form-control text-left\">\n" +
        "                                            </div>\n" +
        "                                        </div>\n" +
        "                                    </div>\n" +
        "                                </div>\n" +
        "                                <div class='col-sm-6 col-md-6 col-xs-6'>\n" +
        "                                    <div class='col-md-12 no-padding two-list'>\n" +
        "                                        <div class='col-12'>\n" +
        "                                            <label for='email'>EMAIL:</label>\n" +
        "                                            <div class='form-group text-left'>\n" +
        "                                                <input type='text' name='email' id='email' value='<?php echo $email; ?>' size='30' class=\"form-control text-left\" required=\"required\">\n" +
        "                                            </div>\n" +
        "                                        </div>\n" +
        "                                    </div>\n" +
        "                                    <div class=\"col-md-12 no-padding two-list\">\n" +
        "                                        <div class='col-sm-6 col-xs-2'>\n" +
        "                                            <label for='complemento'>SENHA:</label>\n" +
        "                                            <div class='form-group text-left'>\n" +
        "                                                <input type='password' name='complemento' id='' value='<?php echo $complemento; ?>' size='' class=\"form-control text-left\" required=\"required\">\n" +
        "                                            </div>\n" +
        "                                        </div>\n" +
        "                                        <div class='col-sm-6 col-xs-2'>\n" +
        "                                            <label for='bairro'>REPETIR SENHA:</label>\n" +
        "                                            <div class='form-group text-left'>\n" +
        "                                                <input type='password' name='bairro' id='' value='<?php echo $bairro; ?>' size='' class=\"form-control text-left\" required=\"required\">\n" +
        "                                            </div>\n" +
        "                                        </div>\n" +
        "                                    </div>\n" +
        "                                    <div class=\"col-md-12 no-padding two-list \">\n" +
        "                                        <div class='col-sm-3 col-xs-12'>\n" +
        "                                            <label for='cep'>CEP:</label>\n" +
        "                                            <div class='form-group text-left'>\n" +
        "                                                <input type='text' name='cep' id='cep' value='<?php echo $cep; ?>' size='14' class=\"form-control text-left\" required=\"required\">\n" +
        "                                            </div>\n" +
        "                                        </div>\n" +
        "                                            <div class='col-sm-7 col-xs-10'>\n" +
        "                                                <label for='endereco'>ENDERE&Ccedil;O:</label>\n" +
        "                                                <div class='form-group text-left'>\n" +
        "                                                    <input type='text' name='endereco' id='endereco' value='<?php echo $endereco; ?>' size='30' class=\"form-control text-left\" required=\"required\">\n" +
        "                                                </div>\n" +
        "                                            </div>\n" +
        "                                            <div class='col-sm-2 col-xs-2'>\n" +
        "                                                <label for='numero'>NUMERO:</label>\n" +
        "                                                <div class='form-group text-left' style='display: -webkit-box;'>\n" +
        "                                                    <input type='text' name='numero' id='numero' value='<?php echo $numero; ?>' size='5' class=\"form-control text-left\" required=\"required\" style=\"padding-left: 0px;padding-right: :0px;\">\n" +
        "                                                    <span class='btn-form btn-form-help'></span> <span class='box-info'>Campo do tipo numérico, aceita somente números. Caso não tenha um número ou seja composto por letras e números, <br>informe 0 ( ZERO ) no campo número e utilize o campo complemento para informar o número completo.<br />Ex: BAURU 50-38, NUMERO: 0 - COMPLEMENTO: 50-38...</span>\n" +
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
        "                                    <div class=\"col-md-12 no-padding two-list\">\n" +
        "                                        <div class='col-sm-6 col-xs-2'>\n" +
        "                                            <label for='complemento'>COMPLEMENTO:</label>\n" +
        "                                            <div class='form-group text-left'>\n" +
        "                                                <input type='text' name='complemento' id='complemento' value='<?php echo $complemento; ?>' size='14' class=\"form-control text-left\" required=\"required\">\n" +
        "                                            </div>\n" +
        "                                        </div>\n" +
        "                                        <div class='col-sm-6 col-xs-2'>\n" +
        "                                            <label for='bairro'>BAIRRO:</label>\n" +
        "                                            <div class='form-group text-left'>\n" +
        "                                                <input type='text' name='bairro' id='bairro' value='<?php echo $bairro; ?>' size='14' class=\"form-control text-left\" required=\"required\">\n" +
        "                                            </div>\n" +
        "                                        </div>\n" +
        "                                    </div>\n" +
        "                                    <div class='col-md-12 no-padding two-list'>\n" +
        "                                        <div class='col-md-4'>\n" +
        "                                            <label for='cidade'>CIDADE:</label>\n" +
        "                                            <div class='form-group text-left'>\n" +
        "                                                <input type='text' name='cidade' id='cidade' value='<?php echo $cidade; ?>' size='14' class=\"form-control text-left\" required=\"required\">\n" +
        "                                            </div>\n" +
        "                                        </div>\n" +
        "                                        <div class='col-md-2'>\n" +
        "                                            <label for='uf'>UF:</label>\n" +
        "                                            <div class='form-group text-left'>\n" +
        "                                                <input type='text' name='uf' id='uf' value='<?php echo $uf; ?>' size='2' maxlength='2' class=\"form-control text-left\" required=\"required\">\n" +
        "                                            </div>\n" +
        "                                        </div>\n" +
        "                                    </div>\n" +
        "                                    <div class='col-md-12 col-xs-12 no-padding two-list'>\n" +
        "                                        <button type='submit' name='btn_add_socio' value='' class='dt-sc-button medium col-md-12 col-xs-12'>ENVIAR</button>\n" +
        "                                    </div>\n" +
        "                               </div>\n" +
        "                            </div>\n" +
        "                        </form>");
    $(function(){

        console.log('informe validacao');

        $('#frm_cadastro_partner').validate({
            errorLabelContainer: $(".dlg-body", $(".bx_dialog")),
            wrapper: 'div',
            rules:{
                nome:{ required:true, minlength:8, maxlength:45 },
                sobrenome:{ required:true },
                nomecartao: { required:true },
                nomeMae:{ required:true },
                nomePai:{ required:true },
                dt: {
                    required:true,
                    dateBR:true
                },
                sexo: { required:true },
                rg: { required:true },
                doc: { required:true },
                pais:{ required:true },
                codpais:{ required:true },
                celular: { required:true, celular:true },
                cep: { required:true },
                endereco: { required:true },
                numero: {
                    required:true,
                    numero:true
                },
                bairro: { required:true },
                cidade: { required:true },
                uf: { required:true },
                email: { email:true, required:true },
                email_repete: { equalTo: $('#email') },
                pass:{ required:true, minlength:6, maxlength:12 },
                pass_rep:{ equalTo:$('#pass') },
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
                sobrenome:
                    {
                        required:'INFORME O SOBRENOME!'
                    },
                nomecartao:
                    {
                        required:'INFORME O NOME PARA O CARTÃO DE ACESSO!'
                    },
                nomeMae:
                    {
                        required:'INFORME O NOME COMPLETO DA MÃE!'
                    },
                nomePai:
                    {
                        required:'INFORME O NOME COMPLETO DO PAI!'
                    },
                dt:
                    {
                        required:'INFORME A DATA DE NASCIMENTO!',
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
                pais:
                    {
                        required:'INFORME SEU PAÍS'
                    },
                codpais:
                    {
                        required:'INFORME O CÓDIGO DO SEU PAÍS. EX.: 55'
                    },
                celular:
                    {
                        required:'INFORME UM CELULAR PARA CONTATO',
                        celular:'INFORME UM CELULAR VÁLIDO'
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
                        required:'INFORME O NÚMERO',
                        numero:'SOMENTE NÚMEROS PARA CAMPO NÚMERO'
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
                pass:
                    {
                        required:'INFORME UMA SENHA DE ACESSO',
                        minlength:'SENHA DEVE CONTER DE 6 A 12 CARACTERES',
                        maxlength:'SENHA DEVE CONTER DE 6 A 12 CARACTERES'
                    },
                pass_rep:
                    {
                        equalTo:'CAMPO REPETIR SENHA INVÁLIDO'
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

        $('#dt')
            .mask('99/99/9999')
            .bind('change',{},function(){

                var tmp_dt              = $(this).val().split('/');
                var dob                 = new Date(tmp_dt[2] + '-' + tmp_dt[1] + '-' + tmp_dt[0]);
                var currentDate         = new Date();
                var currentYear         = currentDate.getFullYear();
                var birthdayThisYear    = new Date(currentYear, dob.getMonth(), dob.getDate());
                var age = currentYear - dob.getFullYear();

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

