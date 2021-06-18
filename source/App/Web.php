<?php


namespace Source\App;


use League\Plates\Engine;

class Web
{

    private $view;

    public function __construct($router)
    {
        $this->view = Engine::create(__DIR__ . "/../../theme","php");
        $this->view->addData(["router" => $router]);
    }

    public function home(): void
    {
      echo $this->view->render("home", [
          "title" => "Home | " . SITE_TITLE
      ]);

        $callback["data"] = $data;
        echo json_encode($data);
		
    }

    public function oprograma(): void
    {
        echo $this->view->render("oprograma", [
            "title" => "O Programa | " . SITE_TITLE
        ]);
    }

    public function filial(array $data): void
    {
        echo $this->view->render("filial", [
            "title" => "Filial | " . SITE_TITLE
        ]);

        $callback["data"] = $data;
        echo json_encode($data);
    }

    public function filialRequest(array $data): void
    {
        echo $this->view->render("filialRequest", [
            "title" => "Request | " . SITE_TITLE
        ]);

        $callback["data"] = $data;
    }

    public function join(array $data): void
    {
        echo $this->view->render("join", [
            "title" => "Cadastre-se | " . SITE_TITLE
        ]);

        $callback["data"] = $data;
        echo json_encode($data);

    }

    public function joinRequest(array $data): void
    {
        echo $this->view->render("joinRequest", [
            "title" => "Cadastre-se | " . SITE_TITLE
        ]);

        $callback["data"] = $data;
        echo json_encode($data);

    }

    public function login(array $data): void
    {
        echo $this->view->render("login", [
            "title" => "Login | " . SITE_TITLE
        ]);

        $callback["data"] = $data;

    }

    public function logout(): void
    {
        echo $this->view->render("logout", [
            "title" => "Logout | " . SITE_TITLE
        ]);

    }

    public function seja_socio(): void
    {
        echo $this->view->render("seja_socio", [
            "title" => "Seja Sócio | " . SITE_TITLE
        ]);
    }

    public function parceiros(): void
    {
        echo $this->view->render("parceiros", [
            "title" => "Parceiros | " . SITE_TITLE
        ]);
    }

    public function parceiros_exibir(): void
    {
        echo $this->view->render("parceiros_exibir", [
            "title" => "Conheça nossos Parceiros | " . SITE_TITLE
        ]);
    }

    public function parceiros_participar(): void
    {
        echo $this->view->render("parceiros_participar", [
            "title" => "Seja um Parceiro | " . SITE_TITLE
        ]);
    }

    public function contact(): void
    {
        echo $this->view->render("contact", [
            "title" => "Contato | " . SITE_TITLE
        ]);
    }
	
    public function sendContact(array $data): void
    {
        echo $this->view->render("sendContact", [
            "title" => "Contato | " . SITE_TITLE
        ]);
		
        //$callback["data"] = $data;
        //echo json_encode($data);
    }

    public function faq(): void
    {
        echo $this->view->render("faq", [
            "title" => "Perguntas Frequentes | " . SITE_TITLE
        ]);
    }

    public function congratulations(): void
    {
        echo $this->view->render("congratulations", [
            "title" => SITE_TITLE
        ]);
    }

    public function perfil(): void
    {
        echo $this->view->render("perfil", [
            "title" => SITE_TITLE
        ]);
    }

    public function changePassword(array $data): void
    {
        echo $this->view->render("changePassword", [
            "title" => SITE_TITLE
        ]);

        $callback["data"] = $data;
        echo json_encode($data);
    }
	
    public function changeProfile(array $data): void
    {
        echo $this->view->render("changeProfile", [
            "title" => SITE_TITLE
        ]);

        $callback["data"] = $data;
        echo json_encode($data);
    }
	
    public function changeModalidade(array $data): void
    {
        echo $this->view->render("changeModalidade", [
            "title" => SITE_TITLE
        ]);

        $callback["data"] = $data;
        echo json_encode($data);
    }
	
	
    public function recover(array $data): void
    {
        echo $this->view->render("recover", [
            "title" => SITE_TITLE
        ]);

        $callback["data"] = $data;
        echo json_encode($data);
    }	
	
    public function esquecisenha(array $data): void
    {
        echo $this->view->render("esqueci-senha", [
            "title" => "Recuperar Senha | " . SITE_TITLE
        ]);

        $callback["data"] = $data;
        echo json_encode($data);
    }

    public function enquetes(array $data): void
    {
        echo $this->view->render("enquetes", [
            "title" => SITE_TITLE
        ]);

        $callback["data"] = $data;
        echo json_encode($data);
    }

    public function changePhoto(array $data): void
    {
        echo $this->view->render("changePhoto", [
            "title" => SITE_TITLE
        ]);

        $callback["data"] = $data;
        echo json_encode($data);
    }

    public function uploadDoc(array $data): void
    {
        echo $this->view->render("uploadDoc", [
            "title" => SITE_TITLE
        ]);

        $callback["data"] = $data;
        echo json_encode($data);
    }
    
    public function plans(array $data): void
    {
        echo $this->view->render("plans", [
            "title" => "Escolha seu plano | " . SITE_TITLE
        ]);

        $callback["data"] = $data;
    }

    public function error(array $data): void
    {
        echo $this->view->render("error", [
            "title" => "{$data["errcode"]} | " . SITE_TITLE,
            "error" => "{$data["errcode"]}"
        ]);
        ///var_dump($data);
    }
}