<?php
session_name('ga');
session_start();

$v->layout('_theme');

?>
<?php $v->start('style'); ?>

<?php $v->end(); ?>

    <div id="main-content">
        <section id="primary" class="content-full-width">
            <div id="">
                <div class="dt-sc-hr-invisible"></div>
                <div class="dt-sc-hr-invisible"></div>
                <div class="fullwidth-section dt-sc-paralax" style="background-position: 50% 152px;">
                    <div class="container">
                        <div class="welcome-txt zoomIn" data-animation="zoomIn" data-delay="100">
                            <h3>PARCEIROS</h3>
                            <p>Junte-se a nós neste novo desafio, venha fazer parte do programa Filiado CBSK, ajude seu atleta e sua cidade contribuindo neste esforço em busca de títulos e sucesso. Cadastre-se e veja como é fácil ter mais visibilidade de sua marca e relacioná-la com o esporte.</p>
                            <p>Contando com ferramentas de última geração você pode incrementar seu negócio com um programa de pontos e de recompensas on-line.</p>
                            <p>Traga o cliente para dentro de seu estabelecimento, propicie descontos e benefícios exclusivos para juntos multiplicarmos seus clientes. Seja parceiro do CBSK.</p>
                            <p>Eventuais custos de cadastro e divulga&ccedil;&atilde;o dever&atilde;o ser acordados diretamente com o CBSK.</p>
                            <br />
                            <a href="<?=url("parceiros_exibir");?>" class="dt-sc-button medium" data-hover="Benefícios">Parceiros</a>
                            <a href="<?=url("parceiros_participar");?>" class="dt-sc-button medium" data-hover="Seja um Parceiro">Participar</a>
                        </div>
                    </div>
                </div>


            </div>

            <?php $v->insert("proximosEventos");?>

        </section>
    </div>

<?php $v->start("modals"); ?>
<?php $v->end(); ?>

<?php $v->start("scripts"); ?>

<?php $v->end(); ?>

