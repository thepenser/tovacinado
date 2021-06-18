<?php
session_name('ga');
session_start();

if ( isset($_POST['pass']) and !empty($_POST['pass']) &&
     isset($_POST['confirmpass']) and !empty($_POST['confirmpass']) ):

     $pass        = (string) filter_input(INPUT_POST, "pass", FILTER_DEFAULT);		
     $confirmpass = (string) filter_input(INPUT_POST, "confirmpass", FILTER_DEFAULT);

     if ( $confirmpass !== $pass ):
         echo "<script>alert('As senhas não coicidem!')</script>
            <meta http-equiv=\"refresh\" content=\"0; URL='/perfil?success=As senhas não coicidem!'\"/>";
        //header('Location: ' . url('/')."?error=As senhas não coicidem!&changePassword=".$_SESSION['apikey']);
        exit;
     endif;

        $url = "https://adm2.totalplayer.com.br/api/v01/atualizarsenha";
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
            CURLOPT_POSTFIELDS =>"{ \r\n\"senha\":\"$pass\"
                                }",
            CURLOPT_HTTPHEADER => array (
                                    "Content-type: application/json;charset=\"utf-8\"",
                                    "Accept: application/json",
                                    "Cache-Control: no-cache",
                                    "Pragma: no-cache",
                                    "X-AUTH-TOKEN: " . $_SESSION['apikey'] . ""
                                ),
        ));

        $response = json_decode(curl_exec($curl));

        curl_close($curl);

        if ( $response->status == "OK" ):
            echo "<script>alert('Senha alterada com sucesso!')</script>
            <meta http-equiv=\"refresh\" content=\"0; URL='/perfil?success=Senha alterada com sucesso!'\"/>";
            //header("Location: /?success=Senha alterada com sucesso!");
            exit;
        else:
            echo "<script>alert('$response->message')</script>
            <meta http-equiv=\"refresh\" content=\"0; URL='/perfil?error=$response->message'\"/>";
            //header("Location: /?error=$response->message");
            exit;
        endif;

endif;

$v->layout('_theme');
?>
<?php $v->start('style'); ?>

<?php $v->end(); ?>
<div id="main">
    <div id="main-content">
        <section id="primary" class="content-full-width">
            <div class="fullwidth-section dt-sc-paralax full-pattern3" style="background-position: 50% 162px;">
                <div class="container">
                    <div class="full-top"></div>
                    <div class="fill-top"></div>
                    <div class="content">
                        <div class="bx_body">
                            <br>
                            <div class='row'>
                                <?php //echo 'APIKEY=' . $_SESSION['apikey']; ?>
                                <?php //include('menu_perfil.php'); ?>
								<?php $v->insert("menu_perfil");?>
                            <h3 class='border-title'><span>ALTERAR SENHA</span></h3>
							<div class="carregaFormSenha"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php $v->start("modals"); ?>
<?php $v->end(); ?>

<?php $v->start("scripts"); ?>
<script type='text/javascript' lang='javascript'>
    var $ = jQuery;

    $(".carregaFormSenha").append(
		"<form name='changePassowrd' id='changePassowrded' action='' method='post'>" +
		"	<div class='col-sm-12 col-xs-12'>" +
		"		<input placeholder='Digite sua Senha' name='pass' required='required' size='25' type='password' style='margin-bottom: 5px;'>" +
		"		<input placeholder='Confirme sua Senha'  name='confirmpass' required='required' type='password' size='25' style='margin-bottom: 0px;'>" +
		"		<input class='dt-sc-button small col-sm-12 col-xs-12' onclick='this.form.submit();' name='changePassw' value='ALTERAR SENHA' type='submit' style='width: 100%!important;'>" +
		"	</div>" +
		"</form>");
</script>
<?php $v->end(); ?>

