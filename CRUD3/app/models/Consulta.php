<?php

namespace models;

class Consulta extends Model {

    protected $table = "consulta";
    #nao esqueça da ID
    protected $fields = ["data_agenda","hora", "medico_id", "paciente_id"];


    public function minhasConsultas($filtros){
        $sql = "SELECT consulta.* , medico.nome as medico_nome, paciente.nome as paciente_nome FROM {$this->table} 
        left join medico on medico.id = consulta.medico_id
        left join paciente on paciente.id = consulta.paciente_id
        
        where (consulta.paciente_id is null or consulta.paciente_id = :pid)   ";


        $data = [':pid' => $_SESSION['user']['id']];

        if (_v($filtros,'data_agenda') != ""){
            $sql .= " and data_agenda = :data_agenda ";
            $data[':data_agenda'] = $filtros['data_agenda'];
        }

        if (_v($filtros,'hora') != ""){
            $sql .= " and hora = :hora ";
            $data[':hora'] = $filtros['hora'];
        }

        if (_v($filtros,'medico_id') != ""){
            $sql .= " and consulta.medico_id = :medico_id ";
            $data[':medico_id'] = $filtros['medico_id'];
        }

        

        $stmt = $this->pdo->prepare($sql);
        if ($stmt == false){
            $this->showError($sql);
        }
        $stmt->execute($data);
        
        $list = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($list,$row);
        }

        return $list;
    }
    

    public function allFiltros($filtros=[]){
        $sql = "SELECT consulta.* , medico.nome as medico_nome, paciente.nome as paciente_nome FROM {$this->table} 
        left join medico on medico.id = consulta.medico_id
        left join paciente on paciente.id = consulta.paciente_id";


        $data = [];

        if (_v($filtros,'data_agenda') != ""){
            $sql .= " and data_agenda = :data_agenda ";
            $data[':data_agenda'] = $filtros['data_agenda'];
        }

        if (_v($filtros,'hora') != ""){
            $sql .= " and hora = :hora ";
            $data[':hora'] = $filtros['hora'];
        }

        if (_v($filtros,'medico_id') != ""){
            $sql .= " and consulta.medico_id = :medico_id ";
            $data[':medico_id'] = $filtros['medico_id'];
        }
        
        $stmt = $this->pdo->prepare($sql);
        if ($stmt == false){
            $this->showError($sql);
        }
        $stmt->execute($data);
        
        $list = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($list,$row);
        }

        return $list;
    }
    
    public function findById($id){
        $sql = "SELECT consulta.*, medico.nome as medico_nome, medico.crm, paciente.nome as paciente_nome 
        FROM {$this->table} 
        
        left join medico on medico.id = consulta.medico_id
        left join paciente on paciente.id = consulta.paciente_id
        
        WHERE consulta.id = :id";
        
        $stmt = $this->pdo->prepare($sql);
        $data = [':id' => $id];
        $stmt->execute($data);
        if ($stmt == false){
            $this->showError($sql,$data);
        }
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function desmarcar($id){
        $sql = "UPDATE {$this->table} SET cancelado = 1 WHERE id = :id";
        $values = ["id"=>$id];
        $stmt = $this->prepare($sql);
        $this->execute($stmt, $values);
        return true;
    }
}