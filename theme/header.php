<?php

session_name('ga');
session_start();

$curl = curl_init();

curl_setopt_array($curl, array(
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

$planoMenu = json_decode(curl_exec($curl));
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    //echo $plano;
}

?>
<!--
<?php
if(count($planoMenu)){
    $i = 0;
    foreach($planoMenu as $planM){
        $i++;
        ?>
            <a href="<?php echo url("join") . '?idPlan=' . $planM->id; ?>">
                <div class="logo-container">
                    <div class="logo">
                        <img src="data:image/jpeg;base64, <?=$planM->thumb;?>">
                    </div>
                    <div class="brand">
                        <?=$planM->nome;?>
                    </div>
                </div>
            </a>
<?php
    }
}?>
-->
<?php if ( isset($_SESSION['login']) ): ?>
    <a href="<?php echo url("perfil");?>" class="made-with-mk">
        <div class="brand"><i class="material-icons">dashboard</i></div>
        <div class="made-with">Acessar <strong>Dashboard</strong></div>
    </a>
<?php else: ?>
    <a href="#" data-toggle="modal" data-target="#exampleModal" class="made-with-mk">
        <div class="brand"><i class="material-icons">login</i></div>
        <div class="made-with">Logar ou <strong>Cadastrar</strong></div>
    </a>
<?php endif; ?>

        <!-- MODAL LOGIN -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ACESSO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="bx_login">
                            <h3 class="border-title aligncenter" style="margin-bottom: 15px;"> <span> <i class="fa fa-user"></i>Acesse sua Conta</span></h3>

                            <div class="login">
                                <form name="frm_login" id="frm_login" action="<?=url("login");?>" method="post">
                                    <div class="col-sm-12 col-xs-12">
                                        <input placeholder="Digite seu Email" name="login" id="t_login" required="required" size="25" type="text" style="margin-bottom: 5px;">
                                        <input placeholder="Digite sua Senha"  name="pass" id="t_senha" required="required" type="password" size="25" style="margin-bottom: 0px;">
                                        
                                        <p style="font-size: 12px;margin-bottom: -6px;padding-left: 18px;">Perdeu ou Esqueceu sua senha? <a href="<?=url("esqueci-senha");?>" title="">Clique aqui</a> para alterá-la.</p>
                                        
                                        <input class="dt-sc-button small col-sm-12 col-xs-12" name="btn_login" value="Login" type="submit" style="width: 100%!important;">
                                        <!--<a href="<?php //echo $loginUrl; ?>" class="sprites sprites-btn-fb'>&nbsp;</a>-->
                                    </div>

                                </form>
                                <br>
                                <div class="page_info aligncenter" style="padding-top: 20px;">
                                    <h4 class="title">Precisa de ajuda para fazer o login?</h4>
                                    <p>Se você ainda não tem uma conta e não sabe como se cadastrar, <a href="<?=url("plans");?>" title="">basta clicar aqui</a>, selecionar uma categoria e fazer seu cadastro.</p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- MODAL LOGIN -->
