<?php

session_name('ga');
session_start();

if ( !isset($_SESSION['login']) ) {
    header('Location: ./?error=Você precisa se logar antes!');
} else {
    sleep(3);
    header('Location: ./perfil');
}

$v->layout('_theme');

?>
<?php $v->start('style'); ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<?php $v->end(); ?>
    <div id="main">
        <div id="main-content">
            <div class="dt-sc-hr-invisible"></div>
            <div class="dt-sc-hr-invisible"></div>
            <section id="primary" class="content-full-width">
                <div class="fullwidth-section dt-sc-paralax full-pattern3" style="background-position: 50% 162px;">
                    <div class="container">
                        <div class="full-top"></div>
                        <div class="fill-top"></div>
                        <div class="content">
                            <div class="bx_body">
                                <?php
                                if(empty($data == true)){
                                    echo "<div class='alert alert-success' role='alert'>
                                                Cadastro efetuado com sucesso!
                                          </div>
                                          <!--
                                          <div class='welcome-txt zoomIn' data-animation='zoomIn' data-delay='100' style='margin-bottom: 20px'>
                                            <a href='/filial' class='dt-sc-button medium col-xs-12 col-sm-3' data-hover='Filie-se' style='font-family: oswald;font-style: italic;'>
                                                Conheça os planos
                                            </a>
                                          </div>
                                          -->
                                    ";
                                } ?>


                                <div class='row' style='font-size:1.5em'>
                                    <p>Para ter acesso ao seu painel de s&oacute;cio, bastar entrar com o seu usuário e senha no box logo acima.</p>
                                    <p>Dentro do painel, voc&ecirc; pode:</p>
                                    <div class="col-sm-12 col-xs-12">
                                        <ol>
                                            <li>Fazer atualiza&ccedil;&atilde;o dos dados de cadastro.</li>
                                            <li>Cadastrar dependentes ao seu perfil.</li>
                                            <li>Efetuar o pagamento de seu plano.</li>
                                            <li>Emiss&atilde;o de cart&atilde;o de acesso provis&oacute;rio.</li>
                                            <li>Compra de ingressos e histórico de eventos.</li>
                                            <li>Alterar senha de acesso!</li>
                                        </ol>
                                    </div>
                                    <p>N&atilde;o perca tempo, efetue o pagamento do seu plano e retire seu cart&atilde;o de acesso provis&oacute;rio para ter acesso aos eventos do <?php echo CLIENT_NAME ;?>!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>



<?php $v->start("modals"); ?>
<?php $v->end(); ?>

<?php $v->start("scripts"); ?>
<?php $v->end(); ?>