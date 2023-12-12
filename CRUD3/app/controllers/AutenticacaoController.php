<?php
use models\Paciente;
use models\Funcionario;


class AutenticacaoController {

    private $home = "principal";

    function index(){

        if (isset($_SESSION['user'])){
            redirect("consulta");
            die();
        }

        #variáveis que serao passados para a view
        $send = [];
        #chama a view
        render("auth/login", $send);
    }


    function logar(){

        $model = new Paciente();
        #busca o usuario pelo email e senha
        $user = $model->findByEmailAndSenha($_POST["email"],  $_POST["senha"]);
    
        if ($user != null){
            #se encontrar salva na sessao
            $_SESSION['user'] = $user;
            $_SESSION['user']['tipo'] = 'paciente';
            redirect("consulta");
        } else {
            #caso contrario, testa o funcionario

            $model = new Funcionario();
            #busca o usuario pelo email e senha
            $user = $model->findByEmailAndSenha($_POST["email"],  $_POST["senha"]);

            if ($user != null){
                #se encontrar salva na sessao
                $_SESSION['user'] = $user;
                $_SESSION['user']['tipo'] = 'funcionario';
                redirect("horarios");
            } else {
                $send = ["msg"=>"Login ou senha inválida"];
                render("auth/login", $send);
            }
        }
    }

    function logout(){
        session_destroy();
        redirect("autenticacao");
    }


    function novo_usuario(){
		$send = ["data"=>[]];
		#chama a view
		render("auth/cadastro", $send);
	}

    /*function salvar_usuario(){
		$model = new Usuario();

		$rules = ["nome"=>["func"=>"validateRequired", "msg"=>"O campo Nome é obrigatório"], 
				  "email"=>[
							["func"=>"validateEmail", "msg"=>"O campo E-mail precisa ser um e-mail válido"],
                            ["func"=>"validateRequired", "msg"=>"O campo E-mail é obrigatório"],
                            ["func"=>"validateUnique", "msg"=>"Este E-mail já está sendo utilizado", "params"=>["usuarios.email"]],
				  		   ],
				  "senha" =>["func"=>"validateEqual", "msg"=>"A confirmação da senha não foi igual à senha digitada", "params"=>[$_POST["senhaConfirm"]]], 
				];
		validate($rules, $_POST, "Falha ao salvar usuário.");
		
		$id = $model->save($_POST);
		
		redirect("autenticacao");
	}*/

    function recuperar_senha(){
        $send = [];
        render("auth/recuperar_senha", $send);
    }

    /*
    function recuperar_senha_send_email(){
        
        $model = new Usuario();
        $token = $model->createToken($_POST['email']);
        if($token){
            
            $url = route("autenticacao/alterar_senha?tk=$token");
            $msg = "Você solicitou a alteração da sua senha? Se sim, <a href='$url'>clique aqui para alterar a sua senha</a>.";
            
            $sent = send_email("Recuperação de senha", $_POST['email'], $msg);
            if ($sent) {
                setFlash("success", "Foi enviado um e-mail com o link para a recuperação da sua senha. Verifique sua caixa de e-mail.");
            } else {
                setFlash("error", "Serviço indisponível, tente novamente mais tarde.");
            }

            redirect("autenticacao?show_last_email=1");

        } else {
            setValidationError("email","O E-mail digitado não foi encontrado");
            validate([], [], "Falha ao solicitar a alteração da senha.");
        }
    }

    function alterar_senha(){
        $send["token"] = $_GET['tk'];
        render("auth/alterar_senha", $send);
    }

    function salvar_alteracao_senha(){
        $model = new Usuario();

		$rules = [
                    "senha" =>["func"=>"validateEqual", "msg"=>"A confirmação da senha não foi igual à senha digitada", "params"=>[$_POST["senhaConfirm"]]], 
				];
		validate($rules, $_POST, "Falha ao alterar a senha.");
		
        $user = $model->getByToken($_POST['token']);
		if ($user){
            $model->update($user['id'],["senha"=>$_POST['senha'], "pass_token"=>null]);
            setFlash("success","Senha alterada com sucesso.");
        } else {
            setFlash("error","Token de usuário não encontrado.");
        }

		redirect("autenticacao");
    }*/
    

}