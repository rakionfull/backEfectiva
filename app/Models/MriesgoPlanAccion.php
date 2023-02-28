<?php

namespace App\Models;

use CodeIgniter\Model;

class MriesgoPlanAccion extends Model
{

    
    public function validaPlanAccion($data){
        
        $query = $this->db->query("EXEC validaEstado @estado='".$data."'");
        $query->getRow();
        if( $query->getRow()) return true;
        else return false;
    }

  
    public function getPlanAccion(){

        $query = $this->db->query("exec listar_plan_accion");
        return $query->getResultArray();
    }
    
    

/*
SELECT PC.id,pc.plan_accion, PC.actividades, A.area, e.estado, p.prioridad, pc.fecha_inicio, pc.fecha_fin, PC.detalles
        FROM plan_accion pc
        INNER JOIN area A ON A.id = pc.idarea
        INNER JOIN estado e ON e.id = pc.idestado
        INNER JOIN prioridad p ON p.id = pc.idprioridad;
*/


/*
    public function getPlanAccion(){

        $query = $this->db->query("EXEC listar_planAccion");
        return $query->getResultArray();
    }
*/
    
    public function savePlanAccion($data){

        $query=$this->db->query("EXEC agregar_estado
        @estado='{$data[0]['estado']}',
        @descripcion='{$data[0]['descripcion']}',@idUserAdd= {$data['user']}") ;
        return $query;
    }

    
    public function updatePlanAccion($data){
        $query=$this->db->query("EXEC modificar_estado @estado='{$data[0]['estado']}',
        @descripcion='{$data[0]['descripcion']}',@idUserAdd= {$data['user']},@idEstado={$data[0]['id']} ");
        
        return $query;
    }


    public function deletePlanAccion($data){

        $query = $this->db->query("EXEC eliminar_estado @idUserAdd={$data['user']}, @idEstado={$data[0]['id']}");
        return $query;
    }

}