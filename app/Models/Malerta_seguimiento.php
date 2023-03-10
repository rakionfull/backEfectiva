<?php

namespace App\Models;

use CodeIgniter\Model;

class Malerta_seguimiento extends Model
{

    public function validaAlerta_seguimiento($data){
        
        $query = $this->db->query("EXEC validaAlerta_seguimiento @alert='".$data."'");
        $query->getRow();
        if( $query->getRow()) return true;
        else return false;
    }

    public function getAlerta_seguimiento(){

        $query = $this->db->query("EXEC listar_alert_seguimiento");
        return $query->getResultArray();
    }

    public function saveAlerta_seguimiento($data){

        $query=$this->db->query("EXEC agregar_AlertSeguimiento
        @alerta='{$data[0]['alerta']}',
        @descripcion='{$data[0]['descripcion']}',
        @valor='{$data[0]['valor']}',@idUserAdd= {$data['user']}") ;
        return $query;
    }

    public function updateAlerta_seguimiento($data){
        $query=$this->db->query("EXEC modificar_AlertSeguimiento @alerta='{$data[0]['alerta']}',
        @valor='{$data[0]['valor']}',@descripcion='{$data[0]['descripcion']}',@idUserAdd= {$data['user']},@idAlerta={$data[0]['id']} ") ;
        
        return $query;
    }

    public function deleteAlerta_seguimiento($data){

        $query = $this->db->query("EXEC eliminar_alertSeguimiento @idUserAdd={$data['id']}, @idAlerta={$data[0]['id']} ");
        return $query;
    }


}