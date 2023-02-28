<?php

namespace App\Models;

use CodeIgniter\Model;

class MEvaluacionControl extends Model
{
    
    public function validaEvaluacionControl($data){
        
        $query = $this->db->query("EXEC valida_Evaluacion_Control @disenio='".$data['disenio']."',
        @operatividad='".$data['operatividad']."', @calificacion='".$data['calificacion']."'");
        $query->getRow();
        if( $query->getRow()) return true;
        else return false;
    }
    public function getEvaluacionControl(){
        
        $query = $this->db->query("EXEC listar_Evaluacion_Control");
        return $query->getResultArray();
    }

    public function saveEvaluacionControl($data){       

        $query=$this->db->query("EXEC agregar_Evaluacion_Control @disenio='{$data[0]['disenio']}',
        @operatividad='{$data[0]['operatividad']}', @calificacion='{$data[0]['calificacion']}', @idUserAdd= {$data['user']}") ;

        return $query;
    }
    public function updateEvaluacionControl($data){  
        
        $query= $this->db->query("EXEC modificar_Evaluacion_Control @disenio='{$data[0]['disenio']}',
        @operatividad='{$data[0]['operatividad']}', @calificacion='{$data[0]['calificacion']}',@idUserAdd= {$data['user']},@idEvaluacionControl={$data[0]['id']}") ;
        return $query;
    }
    public function deleteEvaluacionControl($data){
            
        $query=$this->db->query("EXEC eliminar_Evaluacion_Control @idUserAdd={$data['user']}, @idEvaluacionControl={$data[0]['id']}") ;
        
        return $query;
    }

    public function getDisenioCalificacion(){
        
        $query=$this->db->query("SELECT * from caracteristica_control 
        where is_deleted=0 and clasificacion =1 and tipo='opcion' and idOpcion=19") ;
        
        return $query->getResultArray();
    }
    public function getOperatividadCalificacion(){
        
        $query=$this->db->query("SELECT * from caracteristica_control 
        where is_deleted=0 and clasificacion =1 and tipo='opcion' and idOpcion=35") ;
        
        return $query->getResultArray();
    }
  
    
}