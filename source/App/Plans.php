<?php


namespace Source\App;


use League\Plates\Engine;

class Plans
{
    private $view;

    public function __construct($router)
    {
        $this->view = Engine::create(__DIR__ . "/../../theme","php");
        $this->view->addData(["router" => $router]);
    }

    public function plans(): void
    {
        echo $this->view->render("plans", [
            "title" => "Escolha seu plano | " . SITE_TITLE
        ]);
    }
}