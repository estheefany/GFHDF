<?php
use models\Funcionario;


#A classe devera sempre iniciar com letra maiuscula
#terá sempre o mesmo nome do arquivo
#e precisa terminar com a palavra Controller
class FuncionarioController {

	function __construct() {
		
		
		
		#se nao existir é porque nao está logado
		if (!isset($_SESSION["user"])){
			redirect("autenticacao");
			die();
		}

        
		#proibe o usuário de entrar caso não tenha autorização
		if ($_SESSION['user']['tipo'] != 'funcionario'){
			header("HTTP/1.1 401 Unauthorized");
			die();
		}
	}

	function index($id = null){

		#variáveis que serao passados para a view
		$send = [];

		#cria o model
		$model = new Funcionario();
		
		
		$send['data'] = null;
		#se for diferente de nulo é porque estou editando o registro
		if ($id != null){
			#então busca o registro do banco
			$send['data'] = $model->findById($id);
		}
		

		#busca todos os registros
		$send['lista'] = $model->all();

		#$send['tipos'] = [0=>"Escolha uma opção", 1=>"Usuário comum", 2=>"Admin"];
        

		#chama a view
		render("funcionario", $send);
	}

	
	function salvar($id=null){

		$model = new Funcionario();

		    #validacao
			$requeridos = ["nome"=>"Nome é obrigatório",
			"dataNascimento"=>"Data de nascimento é obrigatória"];
			foreach($requeridos as $field=>$msg){
				#verifica se o campo está vazio
				if (!validateRequired($_POST,$field)){
					setValidationError($field, $msg);
				}
			}
				#valida a data
				if (!validateDate(_v($_POST,"dataNascimento"),"d/m/Y")){
					setValidationError("dataNascimento", "Tem que ser uma data válida no formato dd/mm/yyyy");
				}
				#se alguma validação tiver falhado
				if (count($_SESSION['errors'])){
					setFlash("error","Falha ao salvar usuário.");
					#volta para a página que estava
					header('Location: ' . $_SERVER['HTTP_REFERER']);
					die();
			    }

		
			if ($id == null){
				$id = $model->save($_POST);
			} else {
				$id = $model->update($id, $_POST);
			}

			setFlash("success","Salvo com sucesso.");
			
			redirect("funcionario/index/$id");
		
    

		function deletar(int $id){
			
			$model = new Funcionario();
			$model->delete($id);

			redirect("funcionario/index/");
		}
	}


}