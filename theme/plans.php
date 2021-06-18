<?php
$v->layout('_theme');

session_name('ga');
session_start();

/*if ( isset($_SESSION['login']) ):
    //header('Location: ./?error=Você já é cadastrado!');
    header('Location: ./plans');
endif;*/

$_SESSION['idPlano'] = (string) strtoupper(filter_input(INPUT_POST, 'id', FILTER_DEFAULT));
$_SESSION['nomePlano'] = (string) strtoupper(filter_input(INPUT_POST, 'nome', FILTER_DEFAULT));

if ( $_SESSION['idPlano']):
    header('Location: ./');
endif;

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
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => [],
    CURLOPT_HTTPHEADER => array (
        "Content-type: application/json;charset=\"utf-8\"",
        "Accept: application/json",
        "Cache-Control: no-cache",
        "Pragma: no-cache",
        TOKEN_HEAD
    ),
));

$lPlanos = json_decode(curl_exec($curl));
curl_close($curl);
?>

<?php $v->start('style'); ?>
<style>
    .wizard-container{
        padding-top: 50px!important;
    }
    .wizard-card {
        box-shadow: 0 16px 24px 2px #f443364f, 0 6px 30px 5px #f44336, 0 8px 10px -5px #f443363b;
    }
    .wizard-header img{
        width:18%;
    }
    .wizard-header{
        padding: 10px 0 35px!important;
    }
    .dt-sc-tb-title{
        margin: auto;
        display: block;
        text-align: center;
    }
</style>
<?php $v->end(); ?>


<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">

            <div class="wizard-container">
                <div class="card wizard-card" data-color="red" id="wizard">

                        <div class="wizard-header">
                            <h3 class="wizard-title">
                            Conheça nossas Categorias
                            </h3>
                        </div>

        <?php //var_dump($lPlanos);?>
        <?php //echo $teste;?>
        <?php
        if(count($lPlanos)){
            $i = 0;
            foreach($lPlanos as $f){
                $i++;
                ?>
                <?php if ($i % 3 == 1) { ?>
                    <div class="row col-sm-12 col-xs-12">
                <?php } ?>


                    <div class="dt-sc-one-two column first">
                        <div class="dt-sc-pr-tb-col type3 red">
                            <div class="dt-sc-pr-tb-col-wrapper">
                                <div class="dt-sc-tb-header">
                                    <div class="dt-sc-tb-title">
                                        <img src="data:image/jpeg;base64, <?=$f->thumb;?>" style="width:30%">
                                        <br>
                                        <small></small><h3><?=$f->nome;?></h3>
                                        <p><span><?=$f->descricao;?></span></p>
                                    </div>
                                    <div class="dt-sc-price" style="font-family:montserrat;font-weight: 900;">
                                        <div class="dt-sc-buy-now" style="text-align:center;">
                                            <a class="btn btn-fill btn-danger btn-wd" href="<?php echo url("") . '?idPlan=' . $f->id; ?>">CADASTRE-SE</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php if ($i % 3 == 0) { ?>
                </div>
                <?php } } }else{ ?>
            Nenhum plano cadastrado
            <?php
        }
        ?>
        </div>
    </div> <!-- row -->
</div> <!--  big container -->

<?php $v->start("modals"); ?>
<?php $v->end(); ?>

<?php $v->start("scripts"); ?>

<?php $v->end(); ?>
