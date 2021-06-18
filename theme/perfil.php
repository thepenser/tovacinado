<?php

session_name('ga');
session_start();

if ( !isset($_SESSION['login']) ):
    header('Location: /?error=Você precisa se logar antes!');
    exit;
endif;

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://adm2.totalplayer.com.br/api/v01/pAssociadoView",
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array (
        "Content-type: application/json;charset=\"utf-8\"",
        "Accept: application/json",
        "Cache-Control: no-cache",
        "Pragma: no-cache",
        "X-AUTH-TOKEN: ".$_SESSION['apikey'].""
    ),
));

$exe = curl_exec($curl);

$lAssociado = json_decode($exe);

curl_close($curl);

$arrMsgs = (array)$lAssociado->mensagens;
$arrDocs = (array)$lAssociado->documentos;
$arrCard = (array)$lAssociado->cartaoAcesso;
$arrEnquetes = (array)$lAssociado->enquetes;
$_SESSION['arrEnquetes'] = $lAssociado->enquetes;
$arrPerf = (array)$lAssociado->perfil;

$showAlert = false;
foreach( $arrDocs as $lined ):
    if ( $lined->situacao == "Env. Pendente" ):
        $showAlert = true;
    endif;
endforeach;

$showEnquetes = false;
foreach( $arrEnquetes as $enq ):
    if ( $enq->reposta == "A Responder" ):
        $showEnquetes = true;
    endif;
endforeach;


// seto nasc
$nascimento = $lAssociado->perfil->nascimento;
// crio array do nasc
$nascimento = explode('/',$nascimento);
// defino a data atual
$data = date("d/m/Y");
//crio array data atual
$data = explode('/',$data);
// pego o ano e subtraio pelo nasc
$days = $data[2]-$nascimento[2];

//var_dump($days);
$curlm = curl_init();

curl_setopt_array($curlm, array(
    CURLOPT_URL => "https://adm2.totalplayer.com.br/api/v01/pAssociadoView",
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array (
        "Content-type: application/json;charset=\"utf-8\"",
        "Accept: application/json",
        "Cache-Control: no-cache",
        "Pragma: no-cache",
        "X-AUTH-TOKEN: ".$_SESSION['apikey'].""
    ),
));

$exem = curl_exec($curlm);

$pModalidade = json_decode($exem);

curl_close($curlm);
$arrMod = (array)$pModalidade;


$v->layout('_theme');

?>
<?php $v->start('style'); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

<style>
    .modal-open .modal {
        z-index: 99999;
    }
    .ui-corner-all, .ui-corner-bottom, .ui-corner-right, .ui-corner-br {
        border-bottom-right-radius: 4px;
        z-index: 9999;
        height: auto!important;
        width: 33%!important;
        top: 160px!important;
        left: 30%!important;
    }
    .ui-draggable .ui-dialog-titlebar {
        cursor: move;
        top: 5px!important;
        width: 100%!important;
        left: 0px!important;
    }


    <!--
    label{ *display:inline; display:inline-block; width:180px; }
    .dlg-body dd{ text-align:left; }
    .dlg-body dd label{ cursor:pointer; }

    .bx_perfil
    {
        height: 120px;
        box-shadow: .3em .3em .3em .3em rgb(218, 218, 218);
        border-radius: .5em;
    }

    -->

    .bg-aviso{
        background: #b70e0e;
        padding: 20px;
        border-radius: 30px;
        margin-top: 15px;
        margin-bottom: 15px;
    }
    .bx_aviso{
        text-align: center;
        color: #fff;
        font-size: 18px;
    }
    .titulo-aviso{
        font-size: 21px;
        font-weight: 800;
        border-bottom: 1px solid #fff;
        padding-bottom: 15px;
    }
    input[type="text"], input[type="password"], input[type="email"], input[type="url"], input[type="tel"], input[type="number"], input[type="range"], input[type="date"], textarea, input.text, input[type="search"] {
        background: #e9e9e9;
        border: 1px solid #ffffff;
        color: #6a695e;
        padding: 10px 10px;
        display: block;
        font-size: 14px;
        margin: 0px 0 5px;
        width: 100%;
        box-sizing: border-box;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }
    label {
        display: -webkit-box;
        margin-bottom: 0rem;
        color: #b60000;
    }
    .list-mob{display: -webkit-box;}
    .changePhoto{
        font-size: 110px;
        color: #bfb8b8;
    }
    .welcome-txt p {
        line-height: 14px;
    }
    @media (max-width:720px){
        .list-mob{display: contents;}
    }
    .txtD{
        line-height: 12px;
        margin-bottom: 0px;
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
</style>
<?php $v->end(); ?>
<div id="main">
    <div id="main-content">
        <!--
		<div class="dt-sc-hr-invisible"></div>
        <div class="dt-sc-hr-invisible"></div>
		-->
        <section id="primary" class="content-full-width">
            <div class="fullwidth-section dt-sc-paralax full-pattern3" style="background-position: 50% 162px;">
                <div class="container">
                    <div class="full-top"></div>
                    <div class="fill-top"></div>
                    <div class="content">
                        <div class="bx_body">
                            <br>
                            <div class='row'>
							<?php //var_dump($arrMod); ?>
                                <?php //var_dump($_SESSION['hash']); ?>
                                <?php //include('menu_perfil.php'); ?>
                                <?php $v->insert("menu_perfil");?>
                                <div class="dt-sc-one-half column first fadeInUp col-xs-12 col-sm-12" data-animation="fadeInUp" data-delay="100" style="text-align: justify;font-size: 12px;line-height: 16px!important;">
                                    <div class="fullwidth-section dt-sc-paralax" style="">
                                        <div class="container">
                                            <div class="welcome-txt zoomIn" data-animation="zoomIn" data-delay="100">
                                                <div class='container'>
                                                    <h1 class="border-title aligncenter"> <span>EDI&Ccedil;&Atilde;O DE PERFIL</span></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if ( (isset($_GET['Bem-Vindo']) and $_GET['Bem-Vindo'] == $_SESSION['apikey']) ||
                                    ($showAlert == true) ||
                                    ($lAssociado->perfil->foto == "" || null) ||
                                    ($showEnquetes == true)
                                ): ?>
                                    <div class="dt-sc-one-half column first fadeInUp col-xs-12 col-sm-12" data-animation="fadeInUp" data-delay="100" style="text-align: justify;font-size: 12px;line-height: 16px!important;">
                                        <div class="fullwidth-section dt-sc-paralax" style="">
                                            <div class="container">
                                                <div class="welcome-txt zoomIn" data-animation="zoomIn" data-delay="100">
                                                    <div class='row bg-aviso' style='<?php //echo ((empty($s_avisos))?'display:none':''); ?>'>
                                                        <dl class='bx_aviso col-sm-12 col-xs-12'>
                                                            <dt class='titulo-aviso'>ATEN&Ccedil;&Atilde;O - AVISOS</dt>
                                                            <?php if ( isset($_GET['Bem-Vindo']) ):
                                                                echo "Você deve alterar sua senha! <a  href=\"#\" class=\"changePass\" data-toggle=\"modal\" data-target=\"#changePassword\">clique aqui para altera-la</a><br/><br/>";
                                                                //echo (!empty($arrMsgs)) ? $lAssociado->mensagens : '';
                                                            endif;
                                                            if ( $showEnquetes == true ):
                                                                //foreach ($arrEnquetes as $enq):
                                                                        //echo $enq->id ." ". $enq->titulo . " <a href=\"https://adm2.totalplayer.com.br/respostaenquete/acesso?k=".$_SESSION['hash']."\" class=\"\" alt=\"RESPONDER ENQUETE\" title=\"RESPONDER ENQUETE\">VER ENQUETES</a><br/>";
                                                                        echo "Você tem votações para responder. <a href=\"https://adm2.totalplayer.com.br/respostaenquete/acesso?k=".$_SESSION['hash']."\" target=\"blank\" class=\"\" alt=\"RESPONDER VOTAÇÃO\" title=\"RESPONDER VOTAÇÃO\">VER VOTAÇÕES</a><br/>";
                                                                //endforeach;
                                                            endif;
                                                            if ( !empty($arrDocs) ):
                                                                foreach ($arrDocs as $line):
                                                                    if ( $line->situacao == "Aguardando Envio" ):
                                                                        echo $line->tipo ." ". $line->situacao . " <a href=\"#\" class=\"uploadDocs\" data-toggle=\"modal\" data-target=\"#uploadDoc\">clique aqui para envia-lo</a><br/>";
                                                                    endif;
                                                                endforeach;
                                                            endif;
                                                            if ( $lAssociado->perfil->foto == "" || null):
                                                                echo "<a class='col-xs-4 col-sm-2 changePhoto'
                                                                       data-toggle=\"modal\" data-target=\"#changePhoto\"
                                                                       href='#changePhoto' 
                                                                       style='text-align: center;
                                                                        color: #fff;
                                                                        font-size: 18px;'>
                                                                        Cadastre uma foto de perfil 3x4. Clique aqui para enviar sua foto!
                                                                       </a>";
                                                            endif;
                                                            ?>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="dt-sc-one-half column first fadeInUp col-xs-12 col-sm-12" data-animation="fadeInUp" data-delay="100" style="text-align: justify;font-size: 12px;line-height: 16px!important;">
                                    <div class="fullwidth-section dt-sc-paralax" style="">
                                        <div class="container">
                                            <div class="welcome-txt zoomIn" data-animation="zoomIn" data-delay="100">
                                                <div class='row'>
                                                    <!-- div class='col bx_perfil' style='background: url(< ?php echo $_SESSION['foto']?>) no-repeat center; background-size: contain; cursor: pointer;' alt='ALTERAR FOTO' title='ALTERAR FOTO'></div -->
                                                    <!--<a class='col bx_perfil' style='background: url(<?php //echo $t_foto; ?>) no-repeat center; background-size: contain; cursor: pointer;' alt='ALTERAR FOTO' title='ALTERAR FOTO' href='upload_avatar.php'></a>-->
                                                    <?php
                                                    $fotop = $lAssociado->perfil->foto;
                                                    if ( $fotop == null || '' ){
                                                        echo "<a class='col-xs-4 col-sm-2 changePhoto'
                                                       data-toggle=\"modal\" data-target=\"#changePhoto\"
                                                       href='#changePhoto'><i class='fa fa-user-circle'></i>
                                                       </a>";
                                                    } else {
                                                        echo "<a class='col-xs-4 col-sm-2 changePhoto'
                                                       data-toggle='modal' data-target='#changePhoto'
                                                       href='#changePhoto'>
                                                       <img src='data:image/jpeg;base64, " . $lAssociado->perfil->foto . "' width='120' style='border-radius: 80px'>
                                                        </a>";
                                                    }
                                                    ?>
                                                    <div class='col-xs-4 col-sm-3 bx_perfil' style='margin:0 5px;'>
                                                        <div class='titulo1' style='margin: .5em; text-align: center;'><b>DOCUMENTOS</b></div>
                                                        <?php
                                                        if ( !empty($arrDocs) ):
                                                            foreach ($arrDocs as $line):
                                                                if ( $line->situacao == "Aguardando Envio" ):
                                                                    echo "<a href=\"#\" style=\"color:Red\" class=\"uploadDocs\" data-toggle=\"modal\" data-target=\"#uploadDoc\">
                                                                            ".$line->tipo ."- <b>". $line->situacao . "</b>". $line->dataEnvio ."
                                                                          </a>";
                                                                endif;
                                                                if ( $line->situacao == "Recusado" ):
                                                                    echo "<a href=\"#\" style=\"color:Red\" class=\"uploadDocs\" data-toggle=\"modal\" data-target=\"#uploadDoc\">
                                                                                ".$line->tipo ."- <b>". $line->situacao . "</b> ". $line->dataEnvio ."
                                                                           </a>";
                                                                endif;
                                                                if ( $line->situacao == "Aguardando Validação"):
                                                                    echo "<p class=\"txtD\" style=\"color:#f6cc00\">
                                                                                ".$line->tipo ."- <b>". $line->situacao . "</b> ". $line->dataEnvio ."
                                                                           </p>";
                                                                endif;
                                                                if ( $line->situacao == "Aceito"):
                                                                    echo "<p class=\"txtD\" style=\"color:green\">
                                                                                ".$line->tipo ."- <b>". $line->situacao . "</b> ". $line->dataEnvio ."
                                                                           </p>";
                                                                endif;
                                                            endforeach;
                                                        endif;
                                                        ?>
                                                    </div>
                                                    <?php
                                                    foreach ($arrCard as $c):
                                                        ?>
                                                        <div class='col-xs-4 col-sm-3 bx_perfil' style='margin:0 5px;'>
                                                            <div class='titulo1' style='margin: .5em; text-align: center;'><b>PLANO</b>: <?php echo $c->planos; ?></div>
                                                            <div class='titulo1' style='margin: .5em; text-align: center;'>Matrícula: <?php echo $c->matricula; ?></div>
                                                            <div class='titulo1' style='margin: .5em; text-align: center;line-height: 1px;'>Validade: <?php echo $c->validade; ?></div>
                                                            <div class='titulo1' style='margin: .5em; text-align: center;'>Tipo: <?php echo $c->tipo; ?></div>
                                                        </div>
                                                    <?php
                                                    endforeach;

                                                    foreach($planoMenu as $planM):
                                                        ?>
                                                        <div class='col-xs-12 col-sm-3 bx_perfil'>
                                                            <img src="data:image/jpeg;base64, <?=$planM->thumb;?>" width="90">
                                                            <p style="font-weight: bold;"><?php echo $lAssociado->perfil->filial; ?></p>
                                                        </div>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dt-sc-hr-invisible"></div>
                                <div class="dt-sc-hr-invisible"></div>
                                <div class="formProfile"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>



<?php $v->start("modals"); ?>
<!-- MODAL CHANGE PHOTO -->
<div class="modal fade" id="changePhoto" tabindex="1" role="dialog" aria-labelledby="changePhotoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePhotoLabel">ALTERAR FOTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="bx_login">
                    <h3 class="border-title aligncenter" style="margin-bottom: 15px;"> <span> <i class="fa fa-user"></i>ALTERAR Foto</span></h3>
                    <div class="login">
                        <div class="formPhoto"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- MODAL CHANGE PHOTO -->
<!-- MODAL CHANGE PASSWORD -->
<div class="modal fade" id="changePassword" tabindex="1" role="dialog" aria-labelledby="changePasswordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordLabel">ALTERAR SENHA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="bx_login">
                    <h3 class="border-title aligncenter" style="margin-bottom: 15px;"> <span> <i class="fa fa-user"></i>ALTERAR SENHA</span></h3>

                    <div class="login">
                    <div class="formPass"></div>
                        <br>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- MODAL CHANGE PASSWORD -->
<!-- MODAL SEND DOC -->
<div class="modal fade" id="uploadDoc" tabindex="-1" role="dialog" aria-labelledby="uploadDocLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadDocLabel">ENVIAR DOCUMENTOS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="bx_login">
                    <div class="formDoc"></div>
                    <small style="margin-bottom: 30px;color:red;"> <span>Apenas arquivos JPG, PNG e PDF serão aceitos. O tamanho máximo para envido de arquivos 2mb.</span></small>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- MODAL SEND DOC -->

<?php $v->end(); ?>

<?php $v->start("scripts"); ?>
<?php if (( $lAssociado->perfil->modalidade == "" || null )): ?>
<script type="text/javascript">
    var $ = jQuery;
$(document).ready(function() {
    $('#changeModalidade').modal('show');
})
</script>
<!-- MODAL CHANGE MODALIDADE -->
<div class="modal fade" id="changeModalidade" tabindex="1" role="dialog" aria-labelledby="changeModalidadeLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeModalidadeLabel">Preenchimento obrigatório</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="bx_login">
                    <h3 class="border-title aligncenter" style="margin-bottom: 15px;"> <span>POR QUAL MODALIDADE VOCÊ SE PROFISSIONALIZOU?</span></h3>
                    <div class="login">
                        <div class="formModalidade"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- MODAL CHANGE MODALIDADE -->
<?php endif; ?>
<script>
    var $ = jQuery;
        $(".formModalidade").append("<form name=\"frm_cadastro_mod\" id=\"frm_cadastro_mod\" method=\"POST\" action=\"perfil/changeModalidade\">\n"+
		"																	<select name='t_mod' id='t_mod' required>\n"+
		"																		<option value='Bowl & Park'>Bowl & Park</option>\n"+
		"																		<option value='Downhill Slide'>Downhill Slide</option>\n"+
		"																		<option value='Downhill Speed'>Downhill Speed</option>\n"+
		"																		<option value='Freestyle'>Freestyle</option>\n"+
		"																		<option value='Slalom'>Slalom</option>\n"+
		"																		<option value='Street'>Street</option>\n"+
		"																		<option value='Vertical'>Vertical</option>\n"+
		"																	</select>\n"+
		"                                                            <input type='hidden' name='t_nome' id='t_nome' value='<?php echo $lAssociado->perfil->nome; ?>' size='40'>\n"+
		"                                                            <input type='submit' name='btn_add_socio_mod' value='Enviar'>\n"+
        "                        </form>\n");

        $(".formPhoto").append("<form name=\"changePhoto\" action=\"perfil/changePhoto\" method=\"post\" enctype=\"multipart/form-data\">\n"+
        "                            <div class=\"col-sm-12 col-xs-12\">\n"+
        "                                <input name=\"image\" type=\"file\" style=\"margin-bottom: 0px;\" accept=\"image/jpeg,image/jpg,image/png,image/gif\">\n"+
        "                                <input class=\"dt-sc-button small col-sm-12 col-xs-12\" name=\"enviarPhoto\" value=\"SALVAR FOTO DE PERFIL\" type=\"submit\" style=\"width: 100%!important;\">\n"+
        "                             </div>\n" +
        "                        </form>\n");

        $(".formDoc").append("<form name=\"frm_login\" action=\"perfil/uploadDoc\" method=\"post\" enctype=\"multipart/form-data\">\n"+
        "                        <?php if ( !empty($arrDocs) ): ?>" +
        "                            <?php foreach ($arrDocs as $line): ?>\n "+
        "                                <?php if ( $line->situacao == 'Aguardando Envio'): ?>\n"+
        "                                    <div class=\"login\">\n"+
        "                                        <h6><?php echo $line->tipo; ?> </h6>\n"+
        "                                        <div class=\"col-sm-12 col-xs-12\">\n"+
        "                                            <input name=\"image[<?php echo $line->tipo; ?>]\" type=\"file\" style=\"margin-bottom: 0px;\" accept=\"image/*, application/pdf\">\n"+
        "                                        </div>\n"+
        "                                    </div>\n"+
        "                                    <br/>\n"+
        "                               <?php endif; ?> \n"+
            "                                <?php if ( $line->situacao == 'Recusado'): ?>\n"+
            "                                    <div class=\"login\">\n"+
            "                                        <h6><?php echo $line->tipo; ?> </h6>\n"+
            "                                        <div class=\"col-sm-12 col-xs-12\">\n"+
            "                                            <input name=\"image[<?php echo $line->tipo; ?>]\" type=\"file\" style=\"margin-bottom: 0px;\" accept=\"image/*, application/pdf\">\n"+
            "                                        </div>\n"+
            "                                    </div>\n"+
            "                                    <br/>\n"+
            "                               <?php endif; ?> \n"+
        "                           <?php endforeach; ?> \n"+
        "                       <?php endif; ?> \n"+
        "                        <input class=\"dt-sc-button small col-sm-12 col-xs-12\" name=\"enviarDoc\" value=\"ENVIAR DOCUMENTO(S)\" type=\"submit\" style=\"width: 100%!important;\">\n"+
        "                    </form>");

        $(".formPass").append("<form name=\"changePassowrd\" id=\"changePassowrded\" action=\"perfil/changePassword\" method=\"post\">\n"+
        "                            <div class=\"col-sm-12 col-xs-12\">\n"+
        "                                <input placeholder=\"Digite sua Senha\" name=\"pass\" required=\"required\" size=\"25\" type=\"password\" style=\"margin-bottom: 5px;\">\n"+
        "                                <input placeholder=\"Confirme sua Senha\"  name=\"confirmpass\" required=\"required\" type=\"password\" size=\"25\" style=\"margin-bottom: 0px;\">\n"+
        "                                <input class=\"dt-sc-button small col-sm-12 col-xs-12\" onclick=\"this.form.submit();\" name=\"changePassw\" value=\"ALTERAR SENHA\" type=\"submit\" style=\"width: 100%!important;\">\n"+
        "                            </div>\n"+
        "                        </form>");

                $(".formProfile").append("<form name=\"frm_cadastro_socio\" id=\"frm_cadastro_socio\" method=\"POST\" action=\"perfil/changeProfile\">\n"+
                "                                    <div class=\"dt-sc-one-half column first fadeInUp col-xs-12 col-sm-12\" data-animation=\"fadeInUp\" data-delay=\"100\" style=\"text-align: justify;font-size: 12px;line-height: 16px!important;\">\n"+
                "                                        <div class=\"fullwidth-section dt-sc-paralax\" style=\"\">\n"+
                "                                            <div class=\"container\">\n"+
                "                                                <div class=\"welcome-txt zoomIn\" data-animation=\"zoomIn\" data-delay=\"100\">\n"+
                "                                                    <div class='row'>\n"+
                "                                                        <div class='col-sm-6 col-xs-12'>\n"+
                "                                                            <div class=\"col-sm-12 col-xs-12\">\n"+
                "                                                                <label for='t_nome'>NOME COMPLETO</label>\n"+
                "                                                                <input type='text' name='t_nome' id='t_nome' value='<?php echo $lAssociado->perfil->nome; ?>' size='40'>\n"+
                "                                                            </div>\n"+
                "                                                            <div class=\"col-sm-12 col-xs-12\">\n"+
                "                                                                <label for='t_nomemae'>NOME COMPLETO DA M&Atilde;E</label>\n"+
                "                                                                <input type='text' name='t_nomemae' id='t_nomemae' value='<?php echo $lAssociado->perfil->nomeMae; ?>' size='30'>\n"+
                "                                                            </div>\n"+
                "                                                            <div class=\"col-sm-12 col-xs-12\">\n"+
                "                                                                <label for='t_nascimento'>NASCIMENTO <span id='respostadt' style='color:red'></span></label>\n"+
                "                                                                <input type='text' name='t_nascimento' id='t_nascimento' value='<?php echo $lAssociado->perfil->nascimento; ?>' maxlength='10'>\n"+
                "                                                            </div>\n"+
                "                                                            <div class=\"col-sm-12 col-xs-12\" style=\"height: 71px;text-align: left;\">\n"+
                "                                                                <label for='t_sexo'>SEXO</label>\n"+
                "                                                                <span>Masc.:</span><input type='radio' name='t_sexo' <?php echo (($lAssociado->perfil->sexo == 'M')?'checked':''); ?> id='t_sexo_m' value='M'>\n"+
                "                                                                <span>Fem.:</span><input type='radio' name='t_sexo' <?php echo (($lAssociado->perfil->sexo == 'F')?'checked':''); ?> id='t_sexo_f' value='F'>\n"+
                "                                                            </div>\n"+
                "                                                            <div class=\"col-sm-12 col-xs-12\">\n"+
                "                                                                <label for='t_rg'>CPF\n" +
                    " <span class=\"d-inline-block\" tabindex=\"0\" data-toggle=\"tooltip\" title=\"Para alterar CPF entre em contato com o administrador\">\n" +
                    "  <button class=\"btn btn-primary example\" style=\"pointer-events: none;pointer-events: none;\n" +
                    "    width: 15px;\n" +
                    "    height: 10px;\n" +
                    "    line-height: 0;\n" +
                    "    font-size: 11px;\n" +
                    "    padding-left: 5px;\n" +
                    "    border-radius: 50px;background: #4c936e;\n" +
                    "    border: #000;\" type=\"button\" disabled>?</button>\n" +
                    "</span>\n" +
                        " </label>\n"+
                "                                                                <input type='text' disabled name='t_doc' id='t_doc' value='<?php echo $lAssociado->perfil->doc; ?>' size='14'>\n"+
                "                                                            </div>\n"+
                "                                                            <div class=\"col-sm-12 col-xs-12\">\n"+
                "                                                                <label for='t_rg'>RG</label>\n"+
                "                                                                <input type='text' name='t_rg' id='t_rg' value='<?php echo $lAssociado->perfil->rg; ?>' size='14'>\n"+
                "                                                            </div>\n"+
                "                                                            <div class=\"col-sm-12 col-xs-12\">\n"+
                "                                                                <label for='t_telefone'>FONE FIXO</label>\n"+
                "                                                                <input type='text' name='t_telefone' id='t_telefone' value='<?php echo $lAssociado->perfil->telefone; ?>' size='20'>\n"+
                "                                                            </div>\n"+
                "                                                            <div class=\"col-sm-12 col-xs-12\">\n"+
                "                                                                <label for='t_celular'>CELULAR</label>\n"+
                "                                                                <input type='text' name='t_celular' id='t_celular' value='<?php echo $lAssociado->perfil->celular; ?>' size='20'>\n"+
                "                                                            </div>\n"+
                "                                                            <div class='bx_responsavel' style='display: <?php echo ($days <= 18)?'':'none'; ?>;'>\n"+
                "                                                                <div class=\"col-sm-12 col-xs-12\">\n"+
                "                                                                    <label for='t_nome_resp'>NOME RESPONS&Aacute;VEL</label>\n"+
                "                                                                    <input type='text' name='t_nome_resp' id='t_nome_resp' value='<?php echo $lAssociado->perfil->nomeResponsavel; ?>' size='30' require>\n"+
                "                                                                </div>\n"+
                "                                                                <div class=\"col-sm-12 col-xs-12\">\n"+
                "                                                                    <label for='t_cpf_resp'>CPF RESPONS&Aacute;VEL</label>\n"+
                "                                                                    <input type='text' name='t_cpf_resp' id='t_cpf_resp' value='<?php echo $lAssociado->perfil->docResponsavel; ?>' size='15' require>\n"+
                "                                                                </div>\n"+
                "                                                            </div>\n"+
                "                                                        </div>\n"+
                "                                                        <div class='col-sm-6 col-xs-12' style='float:right'>\n"+
                "                                                            <div class=\"col-sm-12 col-xs-12\">\n"+
                "                                                                <label for='t_cep'>CEP</label>\n"+
                "                                                                <input type='text' name='t_cep' id='t_cep' value='<?php echo $lAssociado->perfil->cep; ?>' size='14'>\n"+
                "                                                            </div>\n"+
                "                                                            <div class=\"col-sm-12 col-xs-12 list-mob\" style=\"padding-left: 0px;\">\n"+
                "                                                                <div class=\"col-sm-10 col-xs-10\" style=\"padding-right: 0px;\">\n"+
                "                                                                    <label for='t_endereco'>ENDERE&Ccedil;O</label>\n"+
                "                                                                    <input type='text' name='t_endereco' id='t_endereco' value='<?php echo $lAssociado->perfil->endereco; ?>' size='30'>\n"+
                "                                                                </div>\n"+
                "                                                                <div class=\"col-sm-2 col-xs-2\" style=\"padding-right: 0px;\">\n"+
                "                                                                    <label for='t_numero'>NUMERO</label>\n"+
                "                                                                    <input type='text' name='t_numero' id='t_numero' value='<?php echo $lAssociado->perfil->numero; ?>' size='5'>\n"+
                "                                                                </div>\n"+
                "                                                            </div>\n"+
                "                                                            <div class=\"col-sm-12 col-xs-12\">\n"+
                "                                                                <label for='t_complemento'>COMPLEMENTO</label>\n"+
                "                                                                <input type='text' name='t_complemento' id='t_complemento' value='<?php echo $lAssociado->perfil->complemento; ?>' size='14'>\n"+
                "                                                            </div>\n"+
                "                                                            <div class=\"col-sm-12 col-xs-12\">\n"+
                "                                                                <label for='t_bairro'>BAIRRO</label>\n"+
                "                                                                <input type='text' name='t_bairro' id='t_bairro' value='<?php echo $lAssociado->perfil->bairro; ?>' size='30'>\n"+
                "                                                            </div>\n"+
                "                                                            <div class=\"col-sm-12 col-xs-12 list-mob\" style=\"padding-left: 0px;\">\n"+
                "                                                                <div class=\"col-sm-10 col-xs-10\" style=\"padding-right: 0px;\">\n"+
                "                                                                    <label for='t_cidade'>CIDADE</label>\n"+
                "                                                                    <input type='text' name='t_cidade' id='t_cidade' value='<?php echo $lAssociado->perfil->cidade; ?>' size='14'>\n"+
                "                                                                </div>\n"+
                "                                                                <div class=\"col-sm-2 col-xs-2\" style=\"padding-right: 0px;\">\n"+
                "                                                                    <label for='t_uf'>UF</label>\n"+
                "                                                                    <input type='text' name='t_uf' id='t_uf' value='<?php echo $lAssociado->perfil->uf; ?>' size='2' maxlength='2'>\n"+
                "                                                                </div>\n"+
                "                                                            </div>\n"+
                "                                                            <div class=\"col-sm-12 col-xs-12\">\n"+
                "                                                                <label for='t_email'>EMAIL" +
                    " <span class=\"d-inline-block\" tabindex=\"0\" data-toggle=\"tooltip\" title=\"Para alterar seu E-MAIL entre em contato com o administrador\">\n" +
                    "  <button class=\"btn btn-primary example\" style=\"pointer-events: none;pointer-events: none;\n" +
                    "    width: 15px;\n" +
                    "    height: 10px;\n" +
                    "    line-height: 0;\n" +
                    "    font-size: 11px;\n" +
                    "    padding-left: 5px;\n" +
                    "    border-radius: 50px;background: #4c936e;\n" +
                    "    border: #000;\" type=\"button\" disabled>?</button>\n" +
                    "</span>\n" +
                    "</label>\n"+
                "                                                                <input disabled type='text' name='t_email' id='t_email' value='<?php echo $lAssociado->perfil->email; ?>' size='30'>\n"+
                "                                                            </div>\n"+
                "                                                            <div class=\"col-sm-12 col-xs-12 list-mob\" style=\"padding-left: 0px;\">\n"+
                "                                                                <div class=\"col-sm-10 col-xs-10\" style=\"padding-right: 0px;\">\n"+
                "                                                                    <label for='t_modalidade'>MODALIDADE</label>\n"+
				"																	<select name='t_modalidade' id='t_modalidade' required>\n"+
				"																		<option value='<?php echo $lAssociado->perfil->modalidade; ?>'><?php echo $lAssociado->perfil->modalidade; ?></option>\n"+
				"																		<option value='Bowl & Park'>Bowl & Park</option>\n"+
				"																		<option value='Downhill Slide'>Downhill Slide</option>\n"+
				"																		<option value='Downhill Speed'>Downhill Speed</option>\n"+
				"																		<option value='Freestyle'>Freestyle</option>\n"+
				"																		<option value='Slalom'>Slalom</option>\n"+
				"																		<option value='Street'>Street</option>\n"+
				"																		<option value='Vertical'>Vertical</option>\n"+
				"																	</select>\n"+
                "                                                                </div>\n"+
                "                                                            </div>\n"+
                "                                                        </div>\n"+
                "                                                    </div>\n"+
                "                                                </div>\n"+
                "                                            </div>\n"+
                "                                        </div>\n"+
                "                                    </div>\n"+
                "                                    <div class=\"dt-sc-one-half column first fadeInUp col-xs-12 col-sm-12\" data-animation=\"fadeInUp\" data-delay=\"100\" style=\"text-align: justify;font-size: 12px;line-height: 16px!important;\">\n"+
                "                                        <div class=\"fullwidth-section dt-sc-paralax\" style=\"\">\n"+
                "                                            <div class=\"container\">\n"+
                "                                                <div class=\"welcome-txt zoomIn\" data-animation=\"zoomIn\" data-delay=\"100\">\n"+
                "                                                    <div class='row' style=\"clear: both; margin: 2em 0;\">\n"+
                "                                                        <div class=\"col-sm-12 col-xs-12\">\n"+
                "                                                            <input type='submit' name='btn_add_socio' value='Enviar'>\n"+
                "                                                        </div>\n"+
                "                                                    </div>\n"+
                "                                                </div>\n"+
                "                                            </div>\n"+
                "                                        </div>\n"+
                "                                    </div>\n"+
                "                                </form>");


	                $('#t_nascimento').mask('99/99/9999').on('blur',{},function(){
						try{
							
						
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
								document.getElementById("t_nascimento").select();
							}else{
								$("#respostadt").html('');
							}
						}catch(Exception){
							alert('Formato de data inválido');
						}
					});
	
	
    $('.example').tooltip()
	

                </script>
                <?php $v->end(); ?>
