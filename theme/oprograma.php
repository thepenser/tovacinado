<?php $v->layout('_theme') ?>

<?php $v->start("style"); ?>
<style>p {line-height: 16px!important;}
    .txt-programa{font-size: 16px;line-height: 22px!important;}
    @media (min-width:768px){.mt100{margin-top:100px}}

    @media (min-width:720px){.col-sm-offset-3{margin-left:18%!important}}
    .dt-sc-one-third {
        width: 31.6%;
    }
</style>
<?php $v->end(); ?>

<div id="main-content">
    <div class="dt-sc-hr-invisible"></div>
    <div class="dt-sc-hr-invisible"></div>
    <section id="primary" class="content-full-width">
        <div class="fullwidth-section dt-sc-paralax full-pattern3" style="background-position: 50% 162px;">
            <div class="container">
                <div class="dt-sc-one-half column first fadeInUp" data-animation="fadeInUp" data-delay="100" style="text-align: justify;font-size: 12px;line-height: 16px!important;">
                    <h2>O PROGRAMA</h2>

                    <p class="txt-programa">Cada vez mais a relação entre as grandes empresas e seus consumidores esta sendo aperfeiçoada, pensando nisso nós da Total Player desenvolvemos um programa de relacionamento e fidelização que visa  o maior conforto e comodidade para você estar cada vez mais próximo e por dentro das novidades que acontecem em nosso dia a dia.</p>
                    <p class="txt-programa">Dentro tantas novidades, criamos um sistema de acesso exclusivo aos eventos, rápido, seguro e moderno, com equipamentos de última geração que evitam filas e aborrecimentos.</p>
                    <p class="txt-programa">O programa possui uma forma segura e prática de pagamento das mensalidades, através de seu perfil no sistema, o torcedor realiza todas as funções desde sua casa utilizando seu computador, tablet ou telefone celular, com toda comodidade e conforto.</p>
                    <p class="txt-programa">Participe também de uma rede de vantagens em parceiros conveniados de diversos segmentos que oferecem descontos especiais para os associados do programa, voce pode se beneficiar desses descontos ou cadastrar sem custo algum sua empresa.</p>
                    <p class="txt-programa">Venha ser uma peça fundamental em nosso sucesso nesta temporada, afinal o torcedor é a razão de existirmos e a sua paixão é nosso maior orgulho.</p>
                    <p class="titulo3" class="txt-programa">Equipe CBSK.</p>
                    <div class="dt-sc-hr-invisible-small"></div>
                </div>
                <div class="dt-sc-one-half column fadeInRight" data-animation="fadeInRight" data-delay="100">
                    <img class="mt100"src="<?=url("theme/assets/images/o_programa.png");?>" alt="" title="">
                </div>
            </div>
        </div>
        <div class="dt-sc-hr-invisible"></div>

        <div class="fullwidth-section full-add top-banner">
            <div class="container">
                <div class="dt-sc-one-third column no-space col-sm-6 cl-xs-12 col-sm-offset-3">
                    <div class="add2">
                        <a href="<?=url("seja_socio");?>">
                            <img title="" alt="" src="<?=url("theme/assets/images/banner1.png");?>">
                        </a>
                    </div>
                </div>
                <div class="dt-sc-one-third column no-space col-sm-6 cl-xs-12">
                    <div class="add3">
                        <a href="https://www.totalticket.com.br/<?php echo CLIENT_NAME;?>" data-hover="Clique aqui">
                            <img title="" alt="" src="<?=url("theme/assets/images/banner2.png");?>">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- welcome-txt starts here -->
        <div class="fullwidth-section dt-sc-paralax" style="">
            <div class="container">
                <div class="welcome-txt zoomIn" data-animation="zoomIn" data-delay="100">
                    <h3 style="font-family: oswald;font-style: italic;">Confederação Brasileira Skate</h3>
                    <p style="font-family: oswald;font-style: italic;">#cbskskate</p>
                    <a href="<?=url("seja_socio");?>" class="dt-sc-button medium col-xs-12 col-sm-3" data-hover="Conheça os Planos" style="font-family: oswald;font-style: italic;">Filie-se</a>
<!--                    <a href="parceiros.php" class="dt-sc-button medium col-xs-12 col-sm-3" data-hover="Seja um Parceiro" style="font-family: oswald;font-style: italic;">Empresário?</a>-->
                </div>
            </div>
        </div>
        <!-- welcome-txt ends here -->
        <div class="dt-sc-hr-invisible-large"></div>
        <?php $v->insert("fb_likebox");?>

        <?php $v->insert("proximosEventos");?>
    </section>
</div>



<?php $v->start("scripts"); ?>

<?php $v->end(); ?>
