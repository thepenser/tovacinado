<?php
require __DIR__ . "/vendor/autoload.php";
use CoffeeCode\Router\Router;
session_start();
$route = new Router(URL_BASE);
/**
 * APP
 */
$route->namespace("Source\App");

/**
 * Web
 */
$route->group(null);
$route->get("/","Web:home");
$route->post("/","Web:home");
$route->post("/","Web:joinRequest");
$route->get("/oprograma","Web:oprograma");
$route->get("/contato","Web:contact");
$route->post("/contato","Web:contact");
$route->post("/sendContact","Web:sendContact");
$route->get("/sendContact","Web:sendContact");
$route->get("/seja_socio","Web:seja_socio");
$route->post("/seja_socio","Web:seja_socio");
$route->get("/parceiros","Web:parceiros");
$route->post("/parceiros","Web:parceiros");
$route->get("/parceiros_exibir","Web:parceiros_exibir");
$route->post("/parceiros_exibir","Web:parceiros_exibir");
$route->get("/parceiros_participar","Web:parceiros_participar");
$route->post("/parceiros_participar","Web:parceiros_participar");
$route->get("/faq","Web:faq");
$route->get("/congratulations","Web:congratulations");
$route->post("/congratulations","Web:congratulations");
$route->get("/recover","Web:recover");
$route->post("/recover","Web:recover");
$route->get("/esqueci-senha","Web:esquecisenha");
$route->post("/esqueci-senha","Web:esquecisenha");
$route->post("/enquetes","Web:enquetes");
$route->get("/enquetes","Web:enquetes");

$route->group(perfil);
$route->get("/","Web:perfil");
$route->post("/","Web:perfil");
$route->post("/changePassword","Web:changePassword");
$route->post("/uploadDoc","Web:uploadDoc");
$route->post("/changeProfile","Web:changeProfile");
$route->post("/changeModalidade","Web:changeModalidade");
$route->post("/changePhoto","Web:changePhoto");

$route->group(filial);
$route->get("/","Web:filial");
$route->get("/filialRequest","Web:filialRequest");

$route->group(join);
$route->get("/","Web:join");
$route->post("/","Web:joinRequest");

$route->group(login);
$route->post("/","Web:login");
$route->get("/forget","Web:login");
$route->post("/forget","Web:login");
$route->get("/logout","Web:logout");

$route->group(plans);
$route->get("/","Web:plans");
$route->post("/","Web:plans");


/**
 * ERROR
 */
$route->group("ops");
$route->get("/{errcode}", "Web:error");

/**
 * PROCESS
 */
$route->dispatch();

if($route->error()){
    $route->redirect("/ops/{$route->error()}");
}
