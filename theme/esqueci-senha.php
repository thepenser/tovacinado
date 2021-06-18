<?php
session_name('ga');
session_start();

if ( isset($_POST['email']) and !empty($_POST['email']) ):

     $email        = (string) filter_input(INPUT_POST, "email", FILTER_DEFAULT);		


    //if ( $confirmpass !== $email ):
         //echo "<script>alert('As senhas não coicidem!')</script>
        //    <meta http-equiv=\"refresh\" content=\"0; URL='/perfil?success=As senhas não coicidem!'\"/>";
        //header('Location: ' . url('/')."?error=As senhas não coicidem!&changePassword=".$_SESSION['apikey']);
        //exit;
     //endif;

        $url = "https://adm2.totalplayer.com.br/api/v01/esquecisenha";
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
            CURLOPT_POSTFIELDS =>"{ \r\n\"email\":\"$email\"
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
            echo "<script>alert('Sua senha foi enviada para o e-mail cadastrado')</script>
            <meta http-equiv=\"refresh\" content=\"0; URL='/'\"/>";
            //header("Location: /?success=Senha alterada com sucesso!");

            exit;
        else:
            //echo "<script>alert('$response->status: $response->message')</script>
            echo "<script>alert('Não conseguimos localizar o e-mail digitado, por favor verifique e tente novamente')</script>
            <meta http-equiv=\"refresh\" content=\"0; URL='/esqueci-senha'\"/>";
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
                            <h3 class='border-title'><span>RECUPERAR SENHA</span></h3>
                            <span>Recupere sua senha por e-mail</span>
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
		"		<input placeholder='Digite seu E-mail de cadastro' name='email' required='required' size='25' type='email' style='margin-bottom: 5px;'>" +
		"		<input class='dt-sc-button small col-sm-12 col-xs-12' onclick='this.form.submit();' name='changePassw' value='RECUPERAR SENHA' type='submit' style='width: 100%!important;'>" +
		"	</div>" +
		"</form>");
</script>
<?php $v->end(); ?>

