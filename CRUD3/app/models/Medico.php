<?php

namespace models;

class Medico extends Model {

    protected $table = "medico";
    #nao esqueça da ID
    protected $fields = ["id","nome","crm","especialidade"];

    public $especialidades =[1=>"médico", 2=>"dentista", 3=>"enfermeiro"];
}