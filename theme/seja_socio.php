<?php
include('nusoap.php');
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
$xmlRet = '';
$msg = '';

class CONSULTACPF
{

    private
        $NOM    = '',
        $DOC    = '',
        $TID    = 0,
        $URI    = 'http://wsnv.novavidati.com.br/?wsdl',
        $USER   = 'TotalPlayer',
        $PASS   = 'TotalPlayer',
        $CLIT   = 'AKSPORT';

    public function getNOME(){
        return $this->NOM;
    }

    public function getNOMELIMPO(){
        return UTIL::removerAcento($this->NOM);
    }

    public function getDOC($format=false){
        return UTIL::FORMAT_CPFCNPJ($this->DOC,$format);
    }

    public function getTID()
    {
        return intval($this->TID);
    }

    public function __construct()
    {

    }

    public function formatarCPF_CNPJ($campo, $formatado = true)
    {

        $codigoLimpo = preg_replace("[' '-./ t]",'',$campo);
        $tamanho = (strlen($codigoLimpo) -2);

        if ($tamanho != 9 && $tamanho != 12) return false;

        if ($formatado){
            $mascara = ($tamanho == 9) ? '###.###.###-##' : '##.###.###/####-##';

            $indice = -1;
            for ($i=0; $i < strlen($mascara); $i++) {
                if ($mascara[$i]=='#') $mascara[$i] = $codigoLimpo[++$indice];
            }

            $retorno = $mascara;

        }else
            $retorno = $codigoLimpo;

        return $retorno;

    }

    /**
     * @param
     * $clb - Código do clube a ser consultado
     */
    public function getReference($clb=0)
    {
        try
        {

            $Conn = ConnDB::getConnectSys();

            $stm = $Conn->prepare("SELECT ref FROM tb_clube WHERE id={$clb}");

            if(!$stm->execute()) throw new PDOException('ERRO REFERENCIA.');

            if($stm->rowCount() == 0) throw new PDOException('ERRO REFERENCIA!');

            $rs = $stm->fetchObject();

            $ref = "eusoutor_" . $rs->ref;

            unset($Conn);

        }catch(PDOException $ex)
        {
            die($ex->getMessage());
        }

        return $ref;
    }

    /**
     * @param
     *  $cpf - cpf a ser consultado
     *  $clb - codigo do clube
     */
    public function consulta()
    {
        $t_cpf = '';
        extract($_POST,EXTR_IF_EXISTS);

        try
        {

            $bRet = false;
            if(empty($t_cpf))
            {
                $bRet = false;
                throw new PDOException("[ {$t_cpf} ] - CPF EM BRANCO");
            }

            $t_cpf = $this->formatarCPF_CNPJ($t_cpf,false);
            $ref = $this->getReference(CLIENT_KEY);

            $Conn = ConnDB::getConnect();
            $stm = $Conn->prepare("SELECT id as TID, doc AS DOC,nome AS NOM FROM {$ref}.torcedor WHERE doc =:doc");

            if(!$stm->execute(array(':doc'=>$t_cpf))) throw new PDOException('ERRO AO CONSULTAR CPF');

            if($stm->rowCount() > 0)
            {
                $rs = $stm->fetchObject();

                $this->NOM = $rs->NOM;
                $this->DOC = $rs->DOC;
                $this->TID = $rs->TID;

                $bRet = true;
            }else
            {




                $client = new \SoapClient('http://diretrixon.com/diretrixws/autocompleta.asmx?wsdl', ["trace" => 1]);
                $soapParameters = ['Usuario' => 'totalplayer', 'Senha' => 'totalplayer202@', 'Cliente' => 'totalplayer'];
                $header = new SoapHeader('http://diretrixon.com/WebServices','Login',$soapParameters,false);
                $client->__setSoapHeaders($header);

                $parameters = ['cpf' => $t_cpf, 'idProduto' => '10'];

                $wcf = $client->LocalizadorPf($parameters, $header);
                $ret = json_decode($wcf->LocalizadorPfResult);

                if(!empty($ret))
                {

                    //$xml = simplexml_load_string($ret->PessoasEmpresasTkResult);

                    $this->DOC = $t_cpf;

                    $prm = array();

                    if(strlen($t_cpf) > 11)
                    {

                        $this->NOM = strval($ret->pessoa[0]->NOME);
                        $stm = $Conn->prepare("INSERT INTO {$ref}.torcedor(doc,nome,nascimento,xml)VALUES('{$this->DOC}','{$this->NOM}','".strval($ret->pessoa[0]->NASCIMENTO)."','" . json_encode($ret) . "')");

                    }else
                    {
                        $this->NOM  = strval($ret->pessoa[0]->NOME);

                        if(!empty($ret->pessoa[0]->NASCIMENTO))
                        {
                            $aNascimnento = explode('-',$ret->pessoa[0]->NASCIMENTO);
                            $nsc = chop($aNascimnento[0]);
                            $nascimento = implode('-',array_reverse(explode('/',$nsc)));
                        }
                        else
                            $nascimento = date('Y-m-d');

                        switch($ret->pessoa[0]->SEXO)
                        {
                            case 'MASCULINO': $sexo = "M"; break;
                            case 'FEMININO': $sexo = "F"; break;
                        }

                        $stm = $Conn->prepare("INSERT INTO {$ref}.torcedor(doc,nome,sexo,mae,nascimento,signo,situacao,xml)VALUES('{$this->DOC}','".addslashes($this->NOM)."','{$sexo}','".addslashes(strval($ret->pessoa[0]->NOME_MAE))."','{$nascimento}','".strval($ret->pessoa[0]->SIGNO)."','','" . addslashes(json_encode($ret)) . "')");

                    }

                    if(empty($this->NOM))
                    {
                        $bRet = false;
                        throw new PDOException("[ {$t_cpf} ] - NÃO LOCALIZADO");
                    }

                    if(!$stm->execute()) throw new PDOException('ERRO AO CADASTRAR TORCEDOR');
                    $torcedor_id = $Conn->lastInsertId();
                    $this->TID = $torcedor_id;

                    foreach($ret->telefones as $k => $v)
                    {
                        try
                        {
                            $tel = strval($v->DDD) . strval($v->TELEFONE);
                            if(!empty($tel))
                            {
                                $stm = $Conn->prepare("INSERT INTO {$ref}.torcedor_contato(torcedor_id,valor,tipo)VALUES({$torcedor_id},'{$tel}','TELEFONE')");
                                if(!$stm->execute()) throw new Exception('ERRO CADASTRO TELEFONES');
                            }

                        }catch(Exception $ex)
                        {
                            UTIL::WRITELOG($ex->getMessage());
                        }

                    }

                    foreach($ret->emails as $k => $v)
                    {
                        try
                        {

                            $mail = strval($v->EMAIL);
                            if(!empty($mail))
                            {
                                $stm = $Conn->prepare("INSERT INTO {$ref}.torcedor_contato(torcedor_id,valor,tipo)VALUES({$torcedor_id},'{$mail}','EMAIL')");
                                if(!$stm->execute()) throw new PDOException('ERRO CADASTRO EMAIL');
                            }

                        }catch(Exception $ex)
                        {
                            UTIL::WRITELOG($ex->getMessage());
                        }
                    }

                    foreach($ret->enderecos as $k => $v)
                    {
                        try
                        {
                            $logr = strval($v->ENDERECO);

                            if(!empty($logr))
                            {

                                $stm = $Conn->prepare("INSERT INTO {$ref}.torcedor_endereco(torcedor_id,logradouro,numero,complemento,bairro,cidade,cep,uf)VALUES({$torcedor_id},'{$logr}',0,'','".strval($v->BAIRRO)."','".strval($v->CIDADE)."','".strval($v->CEP)."','".strval($v->UF)."')");
                                if(!$stm->execute()) throw new PDOException('ERRO CADASTRO ENDERECO');

                            }

                        }catch(Exception $ex)
                        {
                            die($msg);
                        }

                    }

                    $bRet = true;
                }else
                    $bRet = false;

            }

        }catch(PDOException $ex)
        {
            echo $ex->getMessage();
            //UTIL::WRITELOG($ex->getMessage());
        }

        unset($Conn);
        return $bRet;

    }

    public function display()
    {
        $ret = $t_cpf = '';

        extract($_POST,EXTR_IF_EXISTS);

        try
        {

            if(empty($t_cpf)) throw new Exception('DOCUMENTO NÃO INFORMADO');

            $t_cpf = $this->formatarCPF_CNPJ($t_cpf,false);

            $Conn = ConnDB::getConnect();
            $stm = $Conn->prepare("select id,doc,nome,sexo,mae,nascimento,signo,situacao,xml from torcedor where doc ='{$t_cpf}'");

            if(!$stm->execute()) throw new Exception('ERRO CONSULTA 1');
            if($stm->rowCount() == 0) throw new Exception('ERRO CONSULTA 2');

            $rs = $stm->fetchObject();

            $ret = "<dt>DADOS CADASTRAIS</dt>";

            if(strlen($t_cpf) > 11)
            {
                $ret .= "<dd>
                <p><b>CNPJ</b>&nbsp;".$this->formatarCPF_CNPJ($rs->doc,true)."</p>
                <p><b>NOME_FANTASIA</b>&nbsp;{$rs->nome}</p>
                </dd>";
            }else
            {
                $ret .= "<dd>
                <p><b>CPF</b>&nbsp;".formatarCPF_CNPJ($rs->doc,true)."</p>
                <p><b>NOME</b>&nbsp;{$rs->nome}</p>
                <p><b>SEXO</b>&nbsp;{$rs->sexo}</p>
                <p><b>NOME DA MÃE</b>&nbsp;{$rs->mae}</p>
                <p><b>NASCIMENTO</b>&nbsp;".implode('/',array_reverse(explode('-',$rs->nascimento)))."</p>
                <p><b>IDADE</b>&nbsp;{$rs->idade}</p>
                <p><b>SIGNO</b>&nbsp;{$rs->signo}</p>
                <p><b>SITUAÇÃO</b>&nbsp;{$rs->situacao}</p>
                </dd>";

            }

            $stm2 = $Conn->prepare("SELECT logradouro,numero,complemento,bairro,cidade,uf,cep FROM torcedor_endereco WHERE torcedor_id = {$rs->id}");
            if(!$stm2->execute()) throw new PDOException('ERRO ENDEREÇO');

            if($stm2->rowCount() > 0)
            {
                $ret .= "<dt>ENDEREÇOS CADASTRADOS</dt>";

                $ret .= "<dd>";

                while($rs2 = $stm2->fetchObject())
                    $ret .= sprintf("<p><b>END:</b>&nbsp;%s %s %s %s %s</p>",$rs2->logradouro,$rs2->bairro,$rs2->cep,$rs2->cidade,$rs2->uf);

                $ret .= "</dd>";
            }

            $ret .= "<dt>TELEFONES CADASTRADOS</dt>";
            $stm2 = $Conn->prepare("SELECT tipo,valor FROM torcedor_contato WHERE tipo = 'TELEFONE' AND torcedor_id = {$rs->id} order by tipo");
            if(!$stm2->execute()) throw new PDOException('ERRO CONTATO');
            if($stm2->rowCount() > 0)
            {
                while($rs2 = $stm2->fetchObject())
                    $ret .= sprintf("<dd><p><b>TELEFONE:</b>&nbsp;%s</p></dd>",$rs2->valor);
            }


            $ret .= "<dt>EMAILS CADASTRADOS</dt>";
            $stm2 = $Conn->prepare("SELECT tipo,valor FROM torcedor_contato WHERE tipo = 'EMAIL' AND torcedor_id = {$rs->id} order by tipo");
            if(!$stm2->execute()) throw new PDOException('ERRO CONTATO');
            if($stm2->rowCount() > 0)
            {
                while($rs2 = $stm2->fetchObject())
                    $ret .= sprintf("<dd><p><b>EMAIL:</b>&nbsp;%s</p></dd>",$rs2->valor);
            }

            $ret .= "<dt id='dspxml' style='cursor:pointer'>CONSULTA NAO FORMATADA<address style='float: right; font-size: .6em; padding: .4em 0;'>clique para exibir</address></dt>";
            $ret .= "<dd style='display:none' id='bx_xml'><pre>{$rs->xml}</pre></dd>";

        }catch(Exception $ex){ $ret = $ex->getMessage(); }

        return $ret;

    }

}

function consultaCPFWS()
{
    $ret = $t_cpf = '';
    extract($_POST,EXTR_IF_EXISTS);

    try
    {

        if(empty($t_cpf)) throw new Exception('DOCUMENTO NÃO INFORMADO');

        if(!file_exists(_XMLF_))
            $upd = true;
        else
        {
            $xml        = simplexml_load_file(_XMLF_);
            $dt         = $xml->DATE;
            $TOKN       = $xml->TOKEN;
            $upd        = ( $dt < date('Ymd') );
        }

        if($upd)
        {

            $ws = new nusoap_client(_URI_,true);
            $ret = $ws->call('GerarToken',array(
                'usuario' => _USER_,
                'senha'   => _PASS_,
                'cliente' => _CLIT_
            ));

            if(empty($ret)) throw new Exception("SEM RETORNO");

            $TOKN = $ret['GerarTokenPassandoVersaoWebServiceResult'];

            $xml = new DOMDocument();

            $r  = $xml->createElement('EUSOUTORCEDOR');
            $r->appendChild($xml->createElement('DATE',date('Ymd')));
            $r->appendChild($xml->createElement('TOKEN',$TOKN));
            $xml->appendChild($r);

            $xml->save(_XMLF_);

        }

        $doc = formatarCPF_CNPJ($t_cpf,false);

        $ws = new nusoap_client(_URI_,true);
        $ret = $ws->call('LocalizaPessoasTk',array(
            'documento' => $doc,
            'token'     => $TOKN
        ));

        $xml = simplexml_load_string($ret['LocalizaPessoasTkResult']);

        $ret = "<dt>DADOS CADASTRAIS</dt>";

        if(strlen($doc) > 11)
        {
            $ret .= "<dd>
            <p><b>CNPJ</b>&nbsp;{$xml->DADOS_CADASTRAIS->CNPJ}</p>
            <p><b>RAZAO</b>&nbsp;{$xml->DADOS_CADASTRAIS->RAZAO}</p>
            <p><b>NOME_FANTASIA</b>&nbsp;{$xml->DADOS_CADASTRAIS->NOME_FANTASIA}</p>
            <p><b>DT_ABERTURA</b>&nbsp;{$xml->DADOS_CADASTRAIS->DT_ABERTURA}</p>
            <p><b>COD_CNAE</b>&nbsp;{$xml->DADOS_CADASTRAIS->COD_CNAE}</p>
            <p><b>DESCRICAO_CNAE</b>&nbsp;{$xml->DADOS_CADASTRAIS->DESCRICAO_CNAE}</p>
            <p><b>QTD_FUNCIONARIOS</b>&nbsp;{$xml->DADOS_CADASTRAIS->QTD_FUNCIONARIOS}</p>
            <p><b>NJUR</b>&nbsp;{$xml->DADOS_CADASTRAIS->NJUR}</p>
            <p><b>NATUREZA</b>&nbsp;{$xml->DADOS_CADASTRAIS->NATUREZA}</p>
            <p><b>PORTE</b>&nbsp;{$xml->DADOS_CADASTRAIS->PORTE}</p>
            <p><b>QTD_PROP</b>&nbsp;{$xml->DADOS_CADASTRAIS->QTD_PROP}</p>
            </dd>";
        }else
        {
            $ret .= "<dd>
            <p><b>CPF</b>&nbsp;{$xml->DADOS_CADASTRAIS->CPF}</p>
            <p><b>NOME</b>&nbsp;{$xml->DADOS_CADASTRAIS->NOME}</p>
            <p><b>SEXO</b>&nbsp;{$xml->DADOS_CADASTRAIS->SEXO}</p>
            <p><b>NOME DA MÃE</b>&nbsp;{$xml->DADOS_CADASTRAIS->NOME_MAE}</p>
            <p><b>NASCIMENTO</b>&nbsp;{$xml->DADOS_CADASTRAIS->DATANASC}</p>
            <p><b>IDADE</b>&nbsp;{$xml->DADOS_CADASTRAIS->IDADE}</p>
            <p><b>SIGNO</b>&nbsp;{$xml->DADOS_CADASTRAIS->SIGNO}</p>
            <p><b>SITUAÇÃO</b>&nbsp;{$xml->DADOS_CADASTRAIS->SITUACAO_RECEITA}</p>
            </dd>";

        }



        $ret .= "<dt>ENDEREÇOS CADASTRADOS</dt>";

        $ret .= "<dd>";

        foreach($xml->ENDERECOS as $k => $v)
            $ret .= sprintf("<p><b>END:</b>&nbsp;%s %s %s %s %s</p>",$v->LOGRADOURO,$v->BAIRRO,$v->CEP,$v->CIDADE,$v->UF);

        $ret .= "</dd>";

        $ret .= "<dt>TELEFONES CADASTRADOS</dt>";
        $ret .= "<dd>";
        foreach($xml->TELEFONES as $k => $v) $ret .= sprintf("<p><b>TELEFONE:</b>&nbsp;%s</p>",$v->TELEFONE);
        $ret .= "</dd>";

        $ret .= "<dt>EMAILS CADASTRADOS</dt>";
        $ret .= "<dd>";
        foreach($xml->EMAILS as $k => $v) $ret .= sprintf("<p><b>EMAILS:</b>&nbsp;%s</p>",$v->EMAIL);
        $ret .= "</dd>";

        $ret .= "<dt id='dspxml' style='cursor:pointer'>CONSULTA NAO FORMATADA<address style='float: right; font-size: .6em; padding: .4em 0;'>clique para exibir</address></dt>";
        $ret .= "<dd style='display:none' id='bx_xml'><pre>" . htmlentities($xml->asXML()) . "</pre></dd>";

    }catch(Exception $ex){ $ret = $ex->getMessage(); }

    return $ret;

}

    $btn_consultar = '';
    extract($_POST,EXTR_IF_EXISTS);

    if(!empty($btn_consultar))
    {
        $cpf = new CONSULTACPF();
        $cpf->consulta();
        $xmlRet = $cpf->display();
        //$xmlRet = consultaCPFWS();
    }



?>

<?php $v->start('style'); ?>
<style type="text/css">

    label{ width:120px; }
    #lstRetWS dt, #lstRetWS dd{ margin:0; padding:0; }
    #lstRetWS dd p{ margin:.3em; }

    #lstRetWS dt{
        background-color: green;
        font-size: 1.2em;
        color: white;
        padding: .3em 1em;
    }

    #lstRetWS dd{ background-color: white; }

    fieldset{
        border: solid 2px #CCC;
        background: #FFF;
    }

</style>
<link rel="stylesheet" type="text/css" href="/theme/assets/css/AdmSys_estilo.css">
<?php $v->end(); ?>

<div id="box_container" class="box_container">


        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="frm_ConsultaCPF">
            <input type="hidden" name="t_cod" id="t_cod" value="0">
            <fieldset style="margin: .5em; width:900px">
                <legend>CONSULTAR DADOS 2.0</legend>
                <p>
                    <label for="t_cpf">INFORME O CPF:</label>
                    <input type="text" name="t_cpf" id="t_cpf" value="" size="20"><br />
                </p>
                <p>
                    <input class="btn_action" type="submit" name="btn_consultar" value="ENVIAR">
                </p>
                <p>
                    <span><?php echo $msg; ?></span>
                </p>
            </fieldset>
            <fieldset style="margin: .5em; width:900px">
                <legend>RESULTADO DA CONSULTA</legend>
                <dl id="lstRetWS"><?php echo $xmlRet; ?></dl>
            </fieldset>

        </form>

</div>

<?php $v->start("modals"); ?>
<?php $v->end(); ?>

<?php $v->start("scripts"); ?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js"></script>
<script type="text/javascript" src="/theme/assets/js/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('#dspxml').on('click',function(){
            $('#bx_xml').slideToggle();
        })
    });
</script>
<?php $v->end(); ?>

