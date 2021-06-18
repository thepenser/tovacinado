<?php

define("URL_BASE", "https://tovacinado.com.br");
//define("URL_BASE", "http://localhost/tovacinado");
define("SITE_TITLE", "Programa de Cadastro Tô Vacinado");
define("ID_ENTIDADE", "2");
define("WHATSAPP", "11988219026");
define("TOKEN_HEAD", "X-AUTH-TOKEN: b84cf455ee2d18056cd8432e6df3af86abdc412d");

define('HOST_SMTP','mail.eusoutorcedor.com.br');
define('USER_SMTP','sistema+eusoutorcedor.com.br');
define('PASS_SMTP','RD0AOZZwE3upmtN6k6Dp');
define('MAIL_SMTP','sistema@eusoutorcedor.com.br');
define('SUBJ_SMTP','Eu sou torcedor <contato@eusoutorcedor.com.br>');
define('MAIL_CONTATO','contato@eusoutorcedor.com.br');
define('PGTO','/pgto/pages');

//Redes Sociais
define('FACEBOOK_API_ID','233670046786978');
define('FACEBOOK_SECRET','40d310486550d97ad175a1bdfec4ca33');
define('FACEBOOK_REDIRECT_URL','http://www.tovacinado.com.br/loginsocial.php');

define('CLIENT_KEY','2');
define('CLIENT_REF','tovacinado');
define('CLIENT_NAME','TÔ VACINADO');
define('VIDEO_CLUB','gweT-XGjEXM');
define('UF_DEFAULT','SP');
define('TIPOCOLETOR','zoom:2.5');
define('TIPOPLANOCLUBE','true');

define('MAPA_URL','!1m18!1m12!1m3!1d3657.1375324781457!2d-46.656635285022176!3d-23.563503484681824!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce59b8bef0c08d%3A0x1e5b40890eac320d!2sAv.%20Paulista%2C%201313%20-%20Centro%20Hist%C3%B3rico%20de%20S%C3%A3o%20Paulo%2C%20S%C3%A3o%20Paulo%20-%20SP%2C%2001310-300!5e0!3m2!1spt-BR!2sbr!4v1599187166330!5m2!1spt-BR!2sbr');
define('APP_LINK');
define('FB_URL','cbskoficial');
define('_TOKEN_','ac80094e6aa2d5ea32517a9ecc5080744fc318c7');

/*
 *  @param string|null $uri
 *  @return string
 */
function url(string $uri = null): string {
    if($uri){
        return URL_BASE . "/{$uri}";
    }
    return URL_BASE;
}