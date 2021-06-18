
<style type='text/css'>

    .mnu_edit{ 
	    width: 100%;
        margin:.8em 0; padding: 0px; 
        border-top: solid 1px #ccc;
        border-left: solid 1px #ccc;
        border-right: solid 1px #ccc;
        border-radius: .5em .5em 0 0;
    }
    ul li{ *display:inline; display:inline-block; }
    
    .sprites-menu{
        *display:inline; 
        display:inline-block; 
        width: 85px;
        height: 85px;
        background:url('/theme/images/menu_perfil.png');
    }
    .sprites-menu-profile{ background-position: -3px 0px; }
    .sprites-menu-dependent{ background-position: -95px 0px; }
    .sprites-menu-payment{ background-position: -189px 1px; }
    .sprites-menu-card{ background-position: -280px 1px; }
    .sprites-menu-ticket{ background-position: -461px 0px; }
    .sprites-menu-calendar{ background-position: -371px -1px; }
    .sprites-menu-loyalty{ background-position: -554px -1px; }
    .sprites-menu-security{ background-position: -647px -1px; }
    .sprites-menu-exit{ background-position: -739px -1px; }
    .sprites-menu-indique{ background-position: -834px -1px; }

</style>
<ul class="mnu_edit">
    <li><a class='sprites-menu sprites-menu-profile' alt='PERFIL' title='PERFIL' href="<?=url("perfil");?>"></a>
        <p style="text-align: center;font-size: 10px;">PERFIL</p>
    </li>
    <?php
    //var_dump($arrEnquetes);
    if ( $_SESSION['arrEnquetes'] != "" || null ):
        echo "<li><a href='".url('enquetes')."' class='sprites-menu sprites-menu-ticket' alt='RESPONDER VOTAÇÃO' title='RESPONDER VOTAÇÃO'></a>
                <p style='text-align: center;font-size: 10px;'>VOTAÇÕES</p>
              </li>";
    endif;
    ?>
    <?php if($exibe_menu) { ?>
        <li><a class='sprites-menu sprites-menu-dependent' alt='DEPENDENTE' title='DEPENDENTE' href="dependente_associado.php"></a></li>
    <?php } ?>
    
    <!--<li><a class='sprites-menu sprites-menu-payment' alt='PAGAMENTO' title='PAGAMENTO' href="pgto.php"></a></li>
    <li><a class='sprites-menu sprites-menu-card' alt='CART&Atilde;O ACESSO' title='CART&Atilde;O ACESSO' href="assento_associado.php"></a></li>
    <li><a class='sprites-menu sprites-menu-card' alt='CART&Atilde;O ACESSO' title='CART&Atilde;O ACESSO' href="cartao_acesso.php"></a></li>
    <li><a class='sprites-menu sprites-menu-ticket' alt='COMPRAR INGRESSOS' title='COMPRAR INGRESSOS' href="ingresso_associado.php"></a></li>
    <li><button style="border: none; cursor: pointer;" form='frm_buttonAc' class='sprites-menu sprites-menu-ticket' alt='COMPRAR INGRESSOS' title='COMPRAR INGRESSOS' formaction="totalplayer_ticketst.php" formmethod='POST' formtarget="_blank" type="submit"></button></li>
    <li><a class='sprites-menu sprites-menu-calendar' alt='HIST&Oacute;RICO EVENTOS' title='HIST&Oacute;RICO EVENTOS' href="evento_associado_hist.php"></a></li>
    <li><a class='sprites-menu sprites-menu-loyalty' alt='MEUS PONTOS' title='MEUS PONTOS' href="fidelizacao.php"></a></li>
	-->
    <li><a class='sprites-menu sprites-menu-security' alt='ALTERAR SENHA' title='ALTERAR SENHA' href="<?=url("recover");?>"></a>
            <p style="text-align: center;font-size: 10px;">SENHA</p>
    </li>
	<!--
    <li><a class='sprites-menu sprites-menu-indique' alt='INDIQUE UM AMIGO' title='INDIQUE UM AMIGO' href="indique.php"></a></li>-->
    <li><a class='sprites-menu sprites-menu-exit' alt='SAIR' title='SAIR' href="<?php echo url("login/logout");?>"></a>
        <p style="text-align: center;font-size: 10px;">SAIR</p>
    </li>
</ul>
