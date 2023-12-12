<?php
namespace models;

class Model {

    protected $pdo;

    protected $table = null;
    protected $fields = [];
    

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getTable(){
        return $this->table;
    }

    protected function prepare($sql){
        $stmt = $this->pdo->prepare($sql);
        
        if ($stmt == false){
            print_pdo_error($sql);
        }
        return $stmt;
    }

    protected function execute($stmt, $data=[]){
        $stmt->execute($data);
        
        if ($stmt == false){
            print_pdo_error($stmt->queryString, $data);
        }
        return $stmt;
    }

    public function findById($id){
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->prepare($sql);
        $data = [':id' => $id];
        $this->execute($stmt, $data);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }


    protected $filterSQL    = "";
    protected $filterValues = [];
    public function addPaginateFilter($arr){
        #sobrescreva esse metodo no seu model
        #ele deve construir um WHERE em $this->filterSQL
        #e colocar os valores em $this->filterValues
    }

    public function clearFilters(){
        $this->filterSQL    = "";
        $this->filterValues = [];
    }

    public function paginate($page=null, $limit=10){

        if ($page == null){
            if (isset($_GET['page'])){
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
        }

        #Caso implemente algum filtro, ambos os SQL abaixo tem que ter o filtro implementado
        #porém no primeiro só é pra trazer o count(*)

        #a primeira consulta é somente para contar a quantidade de registros
        $sql = "SELECT count(*) as count FROM {$this->table}";
        $sql .= $this->filterSQL;
        $stmt = $this->prepare($sql, $this->filterValues);
        $this->execute($stmt);
        
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        $count = $row['count'];
        $pageCount = ceil($count/$limit);

        #dado a pagina iniciando da pagina 1, converte para a instrução sql
        $from = ($page-1)*$limit;


        $sql = "SELECT * FROM {$this->table} {$this->filterSQL} limit :from,:limit";
        $data = array_merge($this->filterValues, [':from'=>$from, ':limit' => $limit]);
        
        $stmt = $this->prepare($sql);
        $this->execute($stmt,$data);
                
        $list = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($list,$row);
        }

        return ["data"=>$list, "pages"=>$pageCount, "count"=>$count, "actualPage"=>$page];
    }

    public function all(){
        $sql = "SELECT * FROM {$this->table}";
        $sql .= $this->filterSQL;

        $stmt = $this->prepare($sql, $this->filterValues);
        
        $this->execute($stmt);
        
        $list = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($list,$row);
        }

        return $list;
    }

    public function save($data){
        #filtra, para que só tenha nos values os campos que realmente existem na tabela
        $values = array_intersect_key($data, array_flip($this->fields));
        $fields = array_keys($values);

        $sql = "INSERT INTO {$this->table} (".implode(",",$fields).") 
                    VALUES 
                (:".implode(",:",$fields).")";
        
        #caso voce queira ver como está o SQL descomente a linha
        #dd($sql);

        $stmt = $this->prepare($sql);
        
        if ($this->execute($stmt, $values)) {
            return $this->pdo->lastInsertId();
        } else {
            print_pdo_error($sql, $data);
            return false;
        }
    }

    public function update($id, $data){
        #filtra, para que só tenha nos values os campos que realmente existem na tabela
        $values = array_intersect_key($data, array_flip($this->fields));
        $fields = array_keys($values);
        #seta a ID
        $values["id"] = $id;

        #constroi o SQL do UPDATE
        $sql ="UPDATE {$this->table} SET ";
        foreach($fields as $field){
            $sql .= "$field = :$field,";
        }
        $sql = trim($sql,",")." WHERE id = :id";

        #caso voce queira ver como está o SQL descomente a linha
        #dd($sql);
        
        $stmt = $this->prepare($sql);
        
        if ($this->execute($stmt, $values)) {
            return $id;
        } else {
            print_pdo_error($sql, $data);
            return false;
        }
    }

    public function delete($id){
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $values = ["id"=>$id];
        $stmt = $this->prepare($sql);
        $this->execute($stmt, $values);
        return true;
    }


}