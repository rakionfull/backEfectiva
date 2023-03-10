<?php

namespace App\Models;

use CodeIgniter\Model;

class Mestado extends Model
{

    public function validaEstado($data){
        
        $query = $this->db->query("EXEC validaEstado @estado='".$data."'");
        $query->getRow();
        if( $query->getRow()) return true;
        else return false;
    }

    public function getEstado(){

        $query = $this->db->query("EXEC listar_estado");
        return $query->getResultArray();
    }

    public function saveEstado($data){

        $query=$this->db->query("EXEC agregar_estado
        @estado='{$data[0]['estado']}',
        @descripcion='{$data[0]['descripcion']}',@idUserAdd= {$data['user']}") ;
        return $query;
    }

    
    public function updateEstado($data){
        $query=$this->db->query("EXEC modificar_estado @estado='{$data[0]['estado']}',
        @descripcion='{$data[0]['descripcion']}',@idUserAdd= {$data['user']},@idEstado={$data[0]['id']} ");
        
        return $query;
    }


    public function deleteEstado($data){

        $query = $this->db->query("EXEC eliminar_estado @idUserAdd={$data['id']}, @idEstado={$data[0]['id']}");
        return $query;
    }

}