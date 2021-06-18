<?php 

session_name('ga');
session_start();

if ( !isset($_SESSION['login']) ):
    header('Location: /?error=Você precisa se logar antes!');
    exit;
endif;

if ( isset($_FILES['image']) ):

     //$typed  = (string) filter_input(INPUT_POST, "type", FILTER_DEFAULT);		
     //$image = $_FILES['image'];

    foreach($_FILES['image']['name'] as $key => $value):


        $allowed_ext = array('jpg','jpeg','png','gif', 'pdf');
        $file_name   = $_FILES['image']['name']["$key"];
        $file_ext    = strtolower( end(explode('.',$file_name)));

        $file_size   = $_FILES['image']['size']["$key"];
        $file_tmp    = $_FILES['image']['tmp_name']["$key"];

        $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
        $data = file_get_contents($file_tmp);
        $base64 = base64_encode($data); // 'data:image/' . $type . ';base64,' || data://application/pdf;base64,

        // tirando a validação do front
        if ( in_array($file_ext, $allowed_ext) === false ):
            $error = 'Formato de arquivo não autorizado!';
			echo "<script>alert('Aviso: A imagem deve ser menor que 2MB')</script>
			<meta http-equiv=\"refresh\" content=\"1; URL='/perfil'\"/>";
        endif;

		if ( $file_size > 2097152 ):
			$error = 'A imagem deve ser menor que 2mb';
		endif;

        if ( isset($error) ):
            /*
			echo "
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' integrity='sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z' crossorigin='anonymous'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css' integrity='sha512-hwwdtOTYkQwW2sedIsbuP1h0mWeJe/hFOfsvNKpRB3CkRxq8EW7QMheec1Sgd8prYxGm1OM9OZcGW7/GUud5Fw==' crossorigin='anonymous'/>

                <div class='alert alert-danger' role='alert'>
                  <h4 class='alert-heading'>$error</h4>
                    <button onclick='goBack()' class='btn btn-danger'>Voltar</button>
                  
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js' integrity='sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf' crossorigin='anonymous'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js' integrity='sha512-XVz1P4Cymt04puwm5OITPm5gylyyj5vkahvf64T8xlt/ybeTpz4oHqJVIeDtDoF5kSrXMOUmdYewE4JS/4RWAA==' crossorigin='anonymous'></script>
  
                    <script>
                     var $ = jQuery;
                    $('.alert').alert('Arquivo enviado com sucesso e aguardando validação!')
                    function goBack() {
                        window.history.back();
                    }
                    </script>
                </div>
                <meta http-equiv=\"refresh\" content=\"1; URL = '/perfil'\"/>
                ";
				*/
            header('Location: ' . url('perfil')."?error=$error");
            exit;
        endif;

            $url = "https://adm2.totalplayer.com.br/api/v01/enviaDoc";
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS =>"{ 
                                        \r\n\"tipo\":\"$key\",
                                        \r\n\"extensao\":\"$file_ext\",
                                        \r\n\"image\":\"$base64\"
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
		
			//var_dump($file_ext);
			//var_dump($base64);
			//var_dump($key);
			//die();
        endforeach;

        //if ( $response->status == "Aguardando Validação" ):
		if ( $file_size > 2097152 ):
			$error = 'A imagem deve ser menor que 2mb';
			echo "<script>alert('Aviso: A imagem deve ser menor que 2mb')</script>
			<meta http-equiv=\"refresh\" content=\"1; URL='/perfil'\"/>";
			exit;
		endif;
		
        if ( $response->status == "Avaliação Pedente" ):
            //echo "<script>alert('Arquivo enviado com sucesso e aguardando validação!')</script>";
            header("Location: /perfil?success=Arquivo enviado com sucesso e aguardando validação!");
            exit;
        else:
            echo "<script>alert('Aviso: $response->status $response->message')</script>
            <meta http-equiv=\"refresh\" content=\"1; URL='/perfil'\"/>";
            //header("Location: /perfil?error=$response->message");
            exit;
        endif;
else:
    echo "<script>alert('Aviso: A imagem deve ser menor que 2MB.')</script>
    <meta http-equiv=\"refresh\" content=\"0; URL='/perfil'\"/>";
    //header("Location: /perfil?error=O Arquivo é obrigatório");
    exit;
endif;
$v->layout('_theme');
?>
<?php $v->start('style'); ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<?php $v->end(); ?>

<?php $v->start("modals"); ?>
<?php $v->end(); ?>

<?php $v->start("scripts"); ?>
<?php $v->end(); ?>
