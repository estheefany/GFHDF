<?php
use models\Medico;


#A classe devera sempre iniciar com letra maiuscula
#terá sempre o mesmo nome do arquivo
#e precisa terminar com a palavra Controller
class MedicoController {

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
		$model = new Medico();
		
		
		$send['data'] = null;
		#se for diferente de nulo é porque estou editando o registro
		if ($id != null){
			#então busca o registro do banco
			$send['data'] = $model->findById($id);
		}
		

		#busca todos os registros
		$send['lista'] = $model->all();

		$send['especialidades'] = $model->especialidades;
        

		#chama a view
		render("medico", $send);
	}

	
	function salvar($id=null){

		$model = new Medico();

		#validacao
		$requeridos = ["nome"=>"Nome é obrigatório",
		"dataNascimento"=>"Data de nascimento é obrigatória"];
		foreach($requeridos as $field=>$msg){
			#verifica se o campo está vazio
			if (!validateRequired($_POST,$field)){
				setValidationError($field, $msg);
			}
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
		
		redirect("medico/index/$id");
	}

	function deletar(int $id){
		
		$model = new Medico();
		$model->delete($id);

		redirect("medico/index/");
	}


}