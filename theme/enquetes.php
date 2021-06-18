<?php
session_name('ga');
session_start();
if ( !isset($_SESSION['login']) ):
    header('Location: /?error=Você precisa se logar antes!');
    exit;
endif;

$curl2 = curl_init();

curl_setopt_array($curl2, array(
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

$planoMenu = json_decode(curl_exec($curl2));
$err = curl_error($curl2);

curl_close($curl2);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    //echo $plano;
}

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


$v->layout('_theme');
?>
<?php $v->start('style'); ?>
<style>
    th, .dt-sc-button, .dt-sc-sorting-container a.active-sort, .dt-sc-sorting-container a:hover, .widget.widget_tag_cloud .tagcloud a:hover, .widget.widget_product_tag_cloud .tagcloud a:hover, input[type="submit"], input[type="reset"], button, input[type="button"], .blog-entry .entry-meta .date, .dt-sc-toggle-frame .dt-sc-toggle-accordion.active, .dt-excersises:hover p.count, .portfolio:hover .portfolio-detail:before, .portfolio .fig-overlay a:hover, .dt-sc-ico-content.type3 .icon:after, .dt-sc-ico-content.type5 .icon:after, .dt-sc-ico-content.type7 .icon:after, .dt-sc-pricing-table.type1 .dt-sc-buy-now .dt-sc-button:hover, .dt-sc-pricing-table.type1 .selected .dt-sc-tb-header .dt-sc-price, .dt-sc-toggle-frame h5.dt-sc-toggle.active, ul.dt-sc-tabs-frame > li > a.current, ul.dt-sc-tabs-vertical-frame > li > a.current, .blog-post .blog-post-meta li.categories a:hover, .dt-sc-ico-content.type6 .dt-sc-iconbox .icon, .testimonial-pagination a.selected, .testimonial-pagination a:hover, .dt-sc-ico-content.type4:hover .icon, .selection-box:after, .dt-sc-button.bordered:hover, .dt-sc-titled-box h6.dt-sc-titled-box-title, blockquote.type2:before, .dt-menu-toggle, .pagination ul li a, .pagination .next-post a, .pagination .prev-post a, .dt-sc-ico-content.type2:hover .icon, .bx-controls a.bx-prev:hover, .bx-controls a.bx-next:hover, span.image-overlay-inside:before, .megamenu-child-container .dt-sc-pro-thumb .programs-overlay, .support, .full-service, blockquote.type6, .dt-sc-team.type2 .team-detail, .dt-sc-team.type2 .dt-sc-social-icons, .dt-sc-table-cnt, .dt-sc-event-thumb span, .dt-sc-event-new:hover .dt-sc-event-title p.count, .add1 .add-offer, .dt-sc-workout-detail .dt-excersise-title p.count, .dt-excersise-title.title p.count, #footer .social-media, footer .subscribe-frm input[type="submit"]:hover, .sticky .featured-post, .featured-post, .dt-sc-ico-content.type8 .icon .icon-overlay, .dt-excersise-detail-cnt, .post-nav-container .prev-post a, .post-nav-container .next-post a {
        background-color: #b5c15b;
    }
    .dt-excersises.type2 .dt-excersises p.count, .dt-excersises.type2 .dt-excersise-detail h5 {
        width: 100%;
    }
	@media (max-width:768px){
		.dt-sc-one-third {
			width: 100%;
		}
		.dt-sc-button.small, .dt-sc-button.small:hover {
			width: 100%!important;
		}
	}
</style>
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
								<?php $v->insert("menu_perfil");?>
                                <div class="dt-sc-one-half column first fadeInUp col-xs-12 col-sm-12" data-animation="fadeInUp" data-delay="100" style="text-align: justify;font-size: 12px;line-height: 16px!important;">
                                    <div class="fullwidth-section dt-sc-paralax" style="">
                                        <div class="container">
                                            <div class="welcome-txt zoomIn" data-animation="zoomIn" data-delay="100">
                                                <div class='container'>
                                                    <h1 class="border-title aligncenter"> <span>VOTAÇÕES</span></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if($arrEnquetes){ ?>
                                <div class="row col-sm-12 col-xs-12">
                                    <?php foreach ($arrEnquetes as $e): ?>
                                        <div class="dt-sc-one-third column animate fadeInLeft" id="<?=$e->id;?>" data-animation="fadeInLeft" data-delay="100" style="margin-top:20px;">
                                            <div class="dt-excersises type2">
                                                <div class="dt-excersise-detail">
                                                    <div class="dt-excersise-title">
                                                        <?php if( $e->reposta == "Respondida" ) {
                                                            echo "<div class='featured-post'><span>".$e->reposta."</span> ".$e->dtresposta." ".$e->ipadress." ".$e->navegador."</div>";
                                                        } else {
                                                            echo "<style>.featured-post.red {background-color: #ff0505;}</style>
                                                              <div class='featured-post red'><span>".$e->reposta."</span></div>";
                                                        }?>
                                                        <h5><a href="https://adm2.totalplayer.com.br/respostaenquete/acesso?k=<?=$_SESSION['hash'];?>&e=<?=$e->id;?>" target="blank"><?=$e->titulo;?></a></h5>
                                                        <h4><a href="https://adm2.totalplayer.com.br/respostaenquete/acesso?k=<?=$_SESSION['hash'];?>&e=<?=$e->id;?>" target="blank"><?=$e->descricao;?></a></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                                <a class="dt-sc-button small" style="text-align: center; display: block; margin: auto; margin-top: 60px; width: 20%;"
                                   href="https://adm2.totalplayer.com.br/respostaenquete/acesso?k=<?=$_SESSION['hash'];?>" target="blank" data-hover="VEJA SUAS VOTAÇÕES">
                                    VER VOTAÇÕES
                                </a>
                                <?php }else{
                                    echo "<p>Não existem votações para você participar</p>";
                                }?>
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

</script>
<?php $v->end(); ?>

