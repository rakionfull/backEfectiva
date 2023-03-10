<?php

namespace App\Models;

use CodeIgniter\Model;

class MAplicacionImpacto extends Model
{
    
    public function validaAplicacionImpacto($data){
        
        $query = $this->db->query("EXEC valida_AplicacionImpacto @escenario='".$data['escenario']."' ,
        @disenio='".$data['disenio']."', @posicion='".$data['posicion']."'");
        $query->getRow();
        if( $query->getRow()) return true;
        else return false;
    }
    public function getAplicacionImpacto(){
        
        $query = $this->db->query("EXEC listar_AplicacionImpacto");
        return $query->getResultArray();
    }


    public function saveAplicacionImpacto($data){       

        $query=$this->db->query("EXEC agregar_AplicacionImpacto @disenio='{$data[0]['disenio']}',
        @posicion='{$data[0]['posicion']}', @escenario={$data[0]['escenario']}, @descripcion='{$data[0]['descripcion']}', @idUserAdd= {$data['user']}") ;

        return $query;
    }
    public function updateAplicacionImpacto($data){  
        
        $query= $this->db->query("EXEC modificar_AplicacionImpacto @disenio='{$data[0]['disenio']}',
        @posicion='{$data[0]['posicion']}', @escenario={$data[0]['escenario']}, @descripcion='{$data[0]['descripcion']}',@idUserAdd= {$data['user']},@idAplicacionImpacto={$data[0]['id']}") ;
        return $query;
    }
    public function deleteAplicacionImpacto($data){
            
        $query=$this->db->query("EXEC eliminar_AplicacionImpacto @idUserAdd={$data['user']}, @idAplicacionImpacto={$data[0]['id']}") ;
        
        return $query;
    }
}