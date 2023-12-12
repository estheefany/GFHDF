<?php
use models\Consulta;
use models\Medico;

#A classe devera sempre iniciar com letra maiuscula
#terá sempre o mesmo nome do arquivo
#e precisa terminar com a palavra Controller
class ConsultaController {


	function index($id = null){

		#variáveis que serao passados para a view
		$send = [];

		#cria o model
		$model = new Consulta();
		
		
		$send['data'] = null;
		#se for diferente de nulo é porque estou editando o registro
		if ($id != null){
			#então busca o registro do banco
			$send['data'] = $model->findById($id);
		}
		

		#busca todos os registros
		if ($_SESSION['user']['tipo'] == 'paciente'){
			$send['lista'] = $model->minhasConsultas($_GET);
		} else {
			$send['lista'] = $model->allFiltros($_GET);
		}


		$modelmedico = new Medico();
		$send['medicos'] = $modelmedico->all();
        

		#chama a view
		render("consulta", $send);
	}

	function agendar(int $id){
		
		$model = new Consulta();
		$consulta=$model->findById($id);
		#adicionar a id da pessoa que esta logada
		$consulta["paciente_id"] = $_SESSION['user']['id'];
		$model->update($id,$consulta);

		$send =[];
		$send['consulta']=$model->findById($id);

		render("confirmacao", $send);
	}

	
	function salvar($id=null){

		$model = new Consulta();
		
		if ($id == null){
			$id = $model->save($_POST);
		} else {
			$id = $model->update($id, $_POST);
		}
		
		redirect("consulta/index/$id");
	}

	function deletar(int $id){
		
		$model = new Consulta();
		$model->delete($id);

		redirect("consulta/index/");
	}

	function desmarcar(int $id){
		
		$model = new Consulta();
		$model->desmarcar($id);

		redirect("consulta/index/");
	}


}