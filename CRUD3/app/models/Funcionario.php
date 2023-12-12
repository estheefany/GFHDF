<?php

namespace models;

class Funcionario extends Model {

    #use UserTrait;

    protected $table = "funcionario";
    #nao esqueça da ID
    protected $fields = ["id","nome","email","senha"];


    protected $encriptPassword = false;

    protected function encriptPass($pass){
        if ($this->encriptPassword){
            return hash("sha256", $pass);
        }
        return $pass;
    }

    public function findByEmailAndSenha($email, $senha){
        $sql = "SELECT * FROM {$this->table} "
                ." WHERE email = :email and senha = :senha";
        $stmt = $this->prepare($sql);
        $data = [':email' => $email, ":senha"=> $this->encriptPass($senha)];
        $this->execute($stmt, $data);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    #sobrescreve a funcao salve da classe mae Model
    public function save($data){
        if (_v($data,"senha") != ""){
            $data["senha"] = $this->encriptPass($data["senha"]);
        } else
        if (_v($data,"senha") == ""){
            #caso a senha nao seja enviada
            #remove do data, para que nao seja alterada
            #a senha anterior que já está salva
            unset($data["senha"]);
        }
        #chama a funcao save original da classe mae
        return parent::save($data);
    }

    public function update($id, $data){
        if (_v($data,"senha") != ""){
            $data["senha"] = $this->encriptPass($data["senha"]);
        } else
        if (_v($data,"senha") == ""){
            unset($data["senha"]);
        }
        return parent::update($id, $data);
    }

    public function createToken($email){
        $token = md5($email. rand());

        //verifica se existe um usuario com esse e-mail no banco
        $sql = "SELECT COUNT(*) as qtd FROM {$this->table} WHERE email = :email";
        $stmt = $this->prepare($sql);
        $data = [':email' => $email];
        $this->execute($stmt, $data);
        $rw = $stmt->fetch(\PDO::FETCH_ASSOC);

        //se existir, cria o token
        if ($rw["qtd"] > 0){
            $sql = "update {$this->table} set pass_token = :token where email = :email";
            $stmt = $this->prepare($sql);
            $data = [':email' => $email, ":token"=> $token];
            $this->execute($stmt, $data);
            //retorna o token criado/salvo
            return $token;
        } else {
            return false;
        }
    }

    public function getByToken($token){
        $sql = "SELECT * FROM {$this->table} WHERE pass_token = :token";
        $stmt = $this->prepare($sql);
        $data = [':token' => $token];
        $this->execute($stmt, $data);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

}