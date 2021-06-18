<?php
session_name('ga');
session_start();

$v->layout('_theme');


$c = CLIENT_KEY;
$u = (isset($_SESSION['login'])?$_SESSION['login']:'');


function popup() {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://sistema.poup.com.br/store.listAllActiveStores.action",
        CURLOPT_CONNECTTIMEOUT => 5,
        CURLOPT_ENCODING => "UTF-8",
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
        ),
    ));

    $file_contents = json_decode(curl_exec($curl),true);

    curl_close($curl);

    $lst = '';

    foreach($file_contents as $k => $v)
    {
        $o = (object)$v;
        $lst .= "
        <div class='col-sm-2 col-xs-12'>
        <div class='thumbnail'>
        <div class='image view view-first' style=\"background: url('{$o->imagePath}') no-repeat center center;\">
        <div class='mask' style='height: 150px;'>     
        <p style='text-align: center;'>{$o->name}</p>
        <div class='tools tools-bottom' style='margin-top: 0px;'>
        <a href='{$o->urlKey}' target='_BLANK' class='btn-link red'>CUPOM</a>
        </div>
        </div>
        </div>
        <div class='caption' style='height:60px;'>
        <p style='text-align: center;'>{$o->name}</p>
        </div>
        </div>
        </div>
        ";
    }

    return $lst;
}

?>
<?php $v->start('style'); ?>
<!-- Custom Theme Style -->
<link href="<?=url("theme/assets/css/customADMtotal.css");?>" rel="stylesheet">

<!-- Bootstrap -->
<link href="<?=url("theme/assets/css/bootstrapADMtotal.css");?>" rel="stylesheet">

<style type='text/css'>

    .ui-dialog{ left:50%!important; margin-top:-250px; margin-left:-350px; }
    .ui-widget-overlay{
        background: #aaaaaa url(images/ui-bg_flat_0_aaaaaa_40x100.png) 100% 100% repeat-x;
        opacity: .3;
        filter: Alpha(Opacity=30);
    }

    .bx_dlgPart
    {
        line-height: 1;
        display: inline-block;
        vertical-align: top;
        width: 49%;
        height: 95%;
        border-radius:.5em;
    }

    .bx_dlgPart label{ *display: inline; display: inline-block; width: 90px; }
    .bx_dlgPart dl dd{ margin: .5em 0; padding: .3em; background: whitesmoke; }

    .fill-top{ left:0px; }
    .selection-box:after {
        width: 30px;
        height: 34px;
        right: 0px;
        top: 0px;
    }
    .selection-box:before {
        z-index: 1;
        right: 8px;
        top: 3px;
        bottom: 0px;
        height: 0px;
        margin: auto;
        border-left: 7px solid transparent;
        border-right: 7px solid transparent;
        border-top: 7px solid #fff;
    }
    @media (min-width:768px){
        .mtopdesk{
            margin-top:125px;
        }
    }

    .view p {
        line-height: 1;

    }


</style>

<?php $v->end(); ?>


    <div id="main-content">
        <section id="primary" class="content-full-width">
            <div id="">
                <div class="fullwidth-section dt-sc-paralax mtopdesk" style="background-position: 50% 152px;">
                    <div class="container">
                        <div class="row container col-xs-12 col-sm-12 form-group">
                            <div class="col-xs-12 col-sm-2">
                                <label>NOME</label>
                                <input style="border: solid 1px;" id="t_nome" class="form-control" type="text" name="t_nome">
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <label>CIDADE</label>
                                <input style="border: solid 1px;" id="t_cidade" class="form-control" type="text" name="t_cidade">
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <label>ESTADO</label>
                                <select style="border: solid 1px; text-transform: uppercase;" name="t_estado" id="t_estado" class="form-control">
                                    <option value="">Selecione</option>
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espirito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <label>RAMO/ATIVIDADE</label>
                                <select style="border: solid 1px;" class="form-control" name="t_ramo_atividade" id="t_ramo_atividade">
                                    <option value="">SELECIONE</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                                <br>
                                <button type="button" style="margin-top: 5px;" name="btnBuscar" onclick="getParceiro();" class="btn btn-success">Buscar</button>
                                <button type="button" style="margin-top: 5px;" name="btnBuscar" onclick="getList();" class="btn btn-warning">Voltar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row container col-xs-12 col-sm-12" id="parceiros_clube" style="margin: 5px;z-index: 9999;"></div>
                <div class="row container col-xs-12 col-sm-12" id="popup" style="margin: 5px; display: none;z-index: 9999;">
                    <?php //echo popup(); ?>
                </div>
                <div class="row container col-xs-12 col-sm-12" id="demais_parceiros" style="margin: 5px;"></div>
            </div>
        </section>
    </div>


<?php $v->start("modals"); ?>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" style="z-index:9999">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class='razao_social'></span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body col-xs-12 col-sm-12">
                <div class="col-xs-4 col-sm-4">
                    <img id="logopoup" class="img img-responsive" width="250" src="">
                </div>
                <div class="col-xs-4 col-sm-4" id="col1">
                    <p style="display: none;">ID: <span id="id"></span></p>
                    <p>Razão Social: <span class='razao_social'></span></p>
                    <p>CNPJ:  <span id="cnpj"></span></p>
                    <p>E-mail: <span id="email"></span></p>
                    <p>Telefone 1: <span id="tel1"></span></p>
                    <p>Telefone 2: <span id="tel2"></span></p>
                    <p>Celular: <span id="cel"></span></p>
                </div>

                <div class="col-xs-4 col-sm-4" id="col2">
                    <p>Cep: <span id="cep"></span></p>
                    <p>Endereço: <span id="end"></span></p>
                    <p>Nº <span id="numero"></span></p>
                    <p>Complemento: <span id="complemento"></span></p>
                    <p>Bairro: <span id="bairro"></span></p>
                    <p>Cidade: <span id="cidade"></span></p>
                    <p>UF: <span id="uf"></span></p>
                </div>

                <div class="col-xs-8" id="colexibe" style="display: hidden;">
                    <span id="exibe"></span>
                </div>

                <div class="clearfix"></div>

                <div class="col-xs-12" id="col3">
                    <br>
                    <p>Beneficios: <span id="beneficios"></span></p>
                </div>

            </div>

            <div class="modal-footer ">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button"  onclick="gerarCupom();" class="btn btn-success">Cupom de Desconto</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<?php $v->end(); ?>

<?php $v->start("scripts"); ?>
<script type="text/javascript">var $ = jQuery;</script>
<script src="<?=url("theme/assets/script/bootstrapADMtotal.js");?>"></script>
<script type='text/javascript'>

    var page = 0;
    var actscroll = true;

    $(document).ready(function() {
        getRamoAtv();
        getList();

        /*    $(document).scroll(function() {

        //if ($(this).scrollTop() + $(this).height() == $(this).get(0).scrollHeight) {
        if($("html, body").scrollTop() >= ($("html, body").height() - $(window).height())){
        if(actscroll == true) {
        getList();
        }
        }
        });                      */
    });

    function getRamoAtv() {
        $.post('https://parceiros.totalplayer.com.br/lista_json.php',{act:'RAMO_ATIVIDADE'},function(JSon){

            $(JSon).each(function(k,v){
                $('#t_ramo_atividade').append($('<option>',{value:v.ID,text:v.NOME}));
            });

        },'json');
    }


    function openModal(id)
    {

        $.post('https://parceiros.totalplayer.com.br/lista_json.php',{act:'GET',t_id:id},function(JSon){
            $('#id').text(JSon.ID);
            $('#logopoup').attr('src',JSon.LOGO);
            $('.razao_social').text(JSon.RAZAO_SOCIAL);
            $('#cnpj').text(JSon.CNPJ);
            $('#email').text(JSon.EMAIL);
            $('#tel1').text(JSon.TELEFONE);
            $('#tel2').text(JSon.TELEFONE2);
            $('#cel').text(JSon.CELULAR);
            $('#cep').text(JSon.CEP);
            $('#end').text(JSon.ENDERECO);
            $('#numero').text(JSon.NUMERO);
            $('#complemento').text(JSon.COMPLEMENTO);
            $('#bairro').text(JSon.BAIRRO);
            $('#cidade').text(JSon.CIDADE);
            $('#uf').text(JSon.UF);
            $('#beneficios').text(JSon.BENEFICIOS);


            if(JSon.EXIBE != "" && JSon.EXIBE !== null && JSon.EXIBE !== "<p><br></p>" && JSon.EXIBE !== " ") {
                $('#col1').hide();
                $('#col2').hide();
                $('#col3').hide();
                $('#colexibe').html(JSon.EXIBE);
                $('#colexibe').show();

            } else {
                $('#col1').show();
                $('#col2').show();
                $('#col3').show();
                $('#colexibe').hide();
            }

        },'json');

        $("#myModal").modal();
    }

    function gerarCupom() {
        id_parceiro = $('#id').text();
        clube_id = '<?php echo $c; ?>';
        user_id = '<?php echo $u; ?>';
        if(clube_id != '' && user_id != '') {
            window.open('https://www.parceiros.totalplayer.com.br/adm_voucher.php?pa='+id_parceiro+'&c='+clube_id+'&u='+user_id+'&p=1','_blank');
        } else {
            alert('Você Precisa estar logado para Gerar seu Cupom de Desconto!');
        }
    }

    function getParceiro() {
        cidade = $('#t_cidade').val();
        estado = $('#t_estado option:selected').val();
        ramo = $('#t_ramo_atividade option:selected').val();
        nome = $('#t_nome').val();
        clube_id = '<?php echo CLIENT_KEY; ?>';
        projeto_id = 1;
        $('#dv_carregando').show();

        var t = '';


        $.post('https://parceiros.totalplayer.com.br/lista_json.php',{page:page,t_cidade:cidade,t_estado:estado,t_ramo_atividade:ramo, t_projeto_id:projeto_id,t_nome:nome},function(JSon){

            $(JSon).each(function(k,v){

                t += "<div class='tplayer col-sm-2 col-xs-12' onclick=openModal('"+v.ID+"');>";
                t += "<div class='thumbnail'>";
                t += "    <div class='image view view-first' style='background: url("+v.LOGO+") no-repeat center center;background-size: 50%' >";
                t += "        <div class='mask' style='height: 150px;'>";
                t += "            <p style='text-align: center;'>" + v.NOME + "</p>";
                t += "            <div class='tools tools-bottom' style='margin-top: 0px;'>";
                t += "                <button type='button' class='btn-link col-sm-12 col-xs-12' onclick=openModal('"+v.ID+"'); style='color: #fff;'>CUPOM</button>";
                t += "            </div>";
                t += "        </div>";
                t += "    </div>";
                t += "    <div class='caption' style='height:60px;'>";
                t += "        <p style='text-align: center;'>"+v.NOME+"</p>";
                t += "    </div>";
                t += "</div>";
                t += "</div>";

            });

            $('#parceiros_clube').html(t);
            $('#demais_parceiros').hide();
            $('#popup').hide();
            $('#dv_carregando').hide();


        },'json');

    }

    function getList(p)
    {

        clube_id = '<?php echo CLIENT_KEY; ?>';
        projeto_id = 1;
        $('#dv_carregando').show();


        $.post('https://parceiros.totalplayer.com.br/lista_json.php',{t_clube_id: clube_id,t_projeto_id:projeto_id},function(JSon){
            page++;

            var t = '';

            $(JSon).each(function(k,v){

                t += "<div class='tplayer col-sm-2 col-xs-12' onclick=openModal('"+v.ID+"');>";
                t += "<div class='thumbnail'>";
                t += "    <div class='image view view-first' style='background: url("+v.LOGO+") no-repeat center center;background-size: 50%' >";
                t += "        <div class='mask' style='height: 150px;'>";
                t += "            <p style='text-align: center;'>" + v.NOME + "</p>";
                t += "            <div class='tools tools-bottom' style='margin-top: 0px;'>";
                t += "                <button type='button' class='btn-link col-sm-12 col-xs-12' onclick=openModal('"+v.ID+"'); style='color: #fff;'>CUPOM</button>";
                t += "            </div>";
                t += "        </div>";
                t += "    </div>";
                t += "    <div class='caption' style='height:60px;'>";
                t += "        <p style='text-align: center;'>"+v.NOME+"</p>";
                t += "    </div>";
                t += "</div>";
                t += "</div>";

            });

            $('#parceiros_clube').html(t);

        },'json');

        $.post('https://parceiros.totalplayer.com.br/lista_json.php',{t_projeto_id:projeto_id, t_ignora_clube: clube_id},function(JSon){

            var t = '';
            /*
            if(JSon == null || JSon == '')
            {
            actscroll = false;
            //document.getElementById('popup').style.display = 'block';

            }else
            {     */

            $(JSon).each(function(k,v){

                t += "<div class='tplayer col-sm-2 col-xs-12' onclick=openModal('"+v.ID+"');>";
                t += "<div class='thumbnail'>";
                t += "    <div class='image view view-first' style='background: url("+v.LOGO+") no-repeat center center;background-size: 50%' >";
                t += "        <div class='mask' style='height: 150px;'>";
                t += "            <p style='text-align: center;'>" + v.NOME + "</p>";
                t += "            <div class='tools tools-bottom' style='margin-top: 0px;'>";
                t += "                <button type='button' class='btn-link col-sm-12 col-xs-12' onclick=openModal('"+v.ID+"'); style='color: #fff;'>CUPOM</button>";
                t += "            </div>";
                t += "        </div>";
                t += "    </div>";
                t += "    <div class='caption' style='height:60px;'>";
                t += "        <p style='text-align: center;'>"+v.NOME+"</p>";
                t += "    </div>";
                t += "</div>";
                t += "</div>";

            });

            $('#demais_parceiros').html(t);
            $('#dv_carregando').hide();

        },'json');

        $('#popup').show();
        $('#demais_parceiros').show();

    }
</script>
<?php $v->end(); ?>

