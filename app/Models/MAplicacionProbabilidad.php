<?php

namespace App\Models;

use CodeIgniter\Model;

class MAplicacionProbabilidad extends Model
{
    
    public function validaAplicacionProbabilidad($data){
        
        $query = $this->db->query("EXEC valida_AplicacionProbabilidad @escenario='".$data['escenario']."' ,
        @disenio='".$data['disenio']."', @posicion='".$data['posicion']."'");
        $query->getRow();
        if( $query->getRow()) return true;
        else return false;
    }
    public function getAplicacionProbabilidad(){
        
        $query = $this->db->query("EXEC listar_AplicacionProbabilidad");
        return $query->getResultArray();
    }


    public function saveAplicacionProbabilidad($data){       

        $query=$this->db->query("EXEC agregar_AplicacionProbabilidad @disenio='{$data[0]['disenio']}',
        @posicion='{$data[0]['posicion']}', @escenario={$data[0]['escenario']}, @descripcion='{$data[0]['descripcion']}', @idUserAdd= {$data['user']}") ;

        return $query;
    }
    public function updateAplicacionProbabilidad($data){  
        
        $query= $this->db->query("EXEC modificar_AplicacionProbabilidad @disenio='{$data[0]['disenio']}',
        @posicion='{$data[0]['posicion']}', @escenario={$data[0]['escenario']}, @descripcion='{$data[0]['descripcion']}',@idUserAdd= {$data['user']},@idAplicacionProbabilidad={$data[0]['id']}") ;
        return $query;
    }
    public function deleteAplicacionProbabilidad($data){
            
        $query=$this->db->query("EXEC eliminar_AplicacionProbabilidad @idUserAdd={$data['user']}, @idAplicacionProbabilidad={$data[0]['id']}") ;
        
        return $query;
    }
}