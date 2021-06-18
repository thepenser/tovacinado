<?php
$v->layout('_theme')

?>
<?php $v->start("style"); ?>
<style>
    input[type="text"], input[type="password"], input[type="email"], input[type="url"], input[type="tel"], input[type="number"], input[type="range"], input[type="date"], textarea, input.text, input[type="search"] {
        background: #ffffff00;
        border: 1px solid #e5e5d8;
        color: #000;
    }
    /* POR HORA DEIXAR O CONTATO SEM IMAGEM DE FUNDO */
    .full-contact {
        BACKGROUND: #fff;
    }
    .full-contact h3 {
        color: #000;
    }
    .full-contact {
        color: #000;
    }
    .full-contact a:hover {
        color: #b3c05c;
    }
    .full-contact a, .timetable ul li.dt-sc-table-cnt span {
        color: #59996c;
    }
    .full-contact .dt-sc-contact-info.type1 i {
        border-color: #000;
        color: #000;
    }
</style>

<?php $v->end(); ?>
<div id="main-content">
    <div class="dt-sc-hr-invisible"></div>
    <div class="dt-sc-hr-invisible"></div>
    <section id="primary" class="content-full-width">
        <div class="fullwidth-section full-contact dt-sc-paralax" style="background-position: 50% 122px;">
            <div class="container">
                <div class="dt-sc-one-half column first">
                    <h3>CONTATO</h3>
                    <div id="ajax_contact_msg"></div>
                    <form name='frm_contato' id='frm_contato' action='<?=url("sendContact");?>' method='POST'>
                        <div class="dt-sc-one-half column first">
                            <input type='text' name='t_nome' id='t_nome' placeholder='Nome' value='' size='30' >
                        </div>
                        <div class="dt-sc-one-half column">
                            <input type='text' name='t_email' id='t_email' placeholder='E-mail' value='' size='30'>
                        </div>
                        <!--
						<div class="dt-sc-one-half column first">
                            <input type='text' name='t_matricula' placeholder='Matrícula' id='t_matricula' value='<?php echo $t_matricula; ?>' size='30'>
                        </div>
						-->
                        <div class="dt-sc-one-half column">
                            <input type='text' name='t_assunto' placeholder='Assunto' id='t_assunto' value='' size='30'>
                        </div>
                        <div class="clear"></div>
                        <textarea cols='32' rows='5' placeholder="Como podemos te ajudar?" name='t_mensagem' id='t_mensagem'></textarea>
                        <p>
                            <br><br>
                            <img id='captcha' src='https://eusoutorcedor.com.br/portal/includes/captcha/securimage_show.php'><br><br>
                            <a href='#' id='upd_captcha'>ALTERAR CAPTCHA</a><br><br>
                            <label>Informe o codigo acima:</label>
                            <input type='text' name='captcha_code' id='captcha_code' size='10' maxlength='6'>
                        </p>
                        <input type='submit' name='btn_enviar' value='Enviar'>
                    </form>
                </div>
                <div class="dt-sc-one-half column">
                    <iframe src="https://www.google.com/maps/embed?pb=<?php echo MAPA_URL; ?>" width="800" height="400" frameborder="0" style="border:0"></iframe>
                    <br>
                    <h3>Localização</h3>
                    <div class="dt-sc-hr-invisible"></div>
                    <div class="dt-sc-one-half column first">
                        <div class="dt-sc-contact-info type1 address">
                            <p>
                                <i class="fa fa-rocket"></i>Av. Paulista, 1313 sala 1010<br>Centro - São Paulo/SP - 01310-300
                            </p>
                        </div>
                        <div class="dt-sc-hr-invisible-small"></div>

                        <div class="dt-sc-contact-info type1 time">
                            <p>
                                <!--<a target="blank" href="https://api.whatsapp.com/send?phone=55114024-1665&text=Ol%C3%A1,%20estou%20entrando%20em%20contato%20referente%20ao%20site%20do%20Socio%20Torcedor"><i class="fa fa-whatsapp"></i>Fone: +55 (11) 4024-1665</a>-->
                                <!--<a target="blank" href="phone:1140241665"><i class="fa fa-phone"></i>Fone: +55 (11) 4024-1665</a>-->
                            </p>
                        </div>
                    </div>
                    <div class="dt-sc-one-half column">

                        <div class='dt-sc-contact-info type1'>
                            <p>
                                <i class='fa fa-phone'></i>
                                <a href='phone:1132851239'>(11) 3285-1239</a>
                            </p>
                        </div>
                        <div class="dt-sc-contact-info type1">
                            <p>
                                <i class="fa fa-globe"></i>
                                <a href="https://www.cbsk.com.br" target="_blank">www.cbsk.com.br</a>
                            </p>
                        </div>
                        <div class="dt-sc-hr-invisible-small"></div>
                        <div class="dt-sc-contact-info type1">
                            <p>
                                <i class="fa fa-envelope"></i>
                                <a href="mailto:cbsk@totalticket.com.br">cbsk@totalticket.com.br</a>
                                <a href="mailto:comunicacao@cbsk.com.br">comunicacao@cbsk.com.br</a>
                                <!--<a href="mailto:<?php // echo $oClub->get_EMAIL(); ?>"><?php //echo $oClub->get_EMAIL(); ?></a>  -->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php $v->start("scripts"); ?>
    <script type="text/javascript">
        var $ = jQuery;

        $(function(){

            $('#upd_captcha').on('click',function(){
                $('#captcha').attr('src','http://eusoutorcedor.com.br/portal/includes/captcha/securimage_show.php?' + Math.random());
                return false;
            });

        })

        $(function(){

            console.log('informe validacao');

            $('#frm_contato').validate({
                rules:{
                    t_nome:{ required:true, minlength:8, maxlength:38 },
                    t_email: { email:true, required:true },
                    t_matricula: {
                        required:true,
                        numero:true
                    },
                    t_assunto:{ required:true },
                    t_mensagem:{ required:true },
                    captcha_code: { required:true }
                },
                messages:{
                    t_nome:
                        {
                            required:'INFORME O NOME'
                        },
                    t_email:
                        {
                            required:'INFORME SEU E-MAIL',
                            email:'INFORME UM EMAIL VÁLIDO PARA CONTATO!'
                        },
                    t_matricula:{
                        required:'INFORME SEU NÚMERO DE MATRICULA',
                        numero:'SUA MATRÍCULA É COMPOSTA APENAS POR NÚMEROS'
                    },
                    t_assunto:{
                        required:'INFORME UM ASSUNTO PARA O CONTATO'
                    },
                    t_mensagem:{
                        required:'PRECISAMOS QUE DIGA QUAL SUA DÚVIDA'
                    },
                    captcha_code:
                        {
                            required:'INFORME O CÓDIGO CAPTCHA'
                        }
                }
            });
        });
    </script>
<?php $v->end(); ?>
