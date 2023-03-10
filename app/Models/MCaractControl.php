<?php

namespace App\Models;

use CodeIgniter\Model;

class MCaractControl extends Model
{
    
    public function validaCaractControl($data){
        
        $query = $this->db->query("EXEC valida_caractControl @caracteristica='".$data[0]['caracteristica']."', @idOpcion='".$data[0]['id']."'");
        $query->getRow();
        if( $query->getRow()) return true;
        else return false;
    }
    public function getCaractControl($id,$tipo,$calificacion){
        
        // $query = $this->db->query("EXEC listar_caractControl");
        if($id == 0){
            $query = $this->db->query("SELECT * FROM caracteristica_control where tipo='menu' and estado=1 and is_deleted=0 ");
        }else{
           
                
                    $query = $this->db->query("SELECT * FROM caracteristica_control 
                    where estado=1 and is_deleted=0  and idOpcion={$id}");
               
          
         
                
        
           
        
        }
        
        return $query->getResultArray();
    }

    // public function getOpcionesCaracteristica(){
        
    //     $query = $this->db->query("SELECT * from caracteristica_control where is_deleted=0 and estado=1 order by caracteristica");
    //     return $query->getResultArray();
    // }
    public function getOpcionesCaracteristica($tipo){
        
        $query = $this->db->query("SELECT * from caracteristica_control where is_deleted=0 and estado=1 and tipo='{$tipo}' order by date_add ");
        return $query->getResultArray();
    }
    public function saveCaractControl($data){       

        $query=$this->db->query("EXEC agregar_caractControl @caracteristica='{$data[0]['caracteristica']}',
        @descripcion='{$data[0]['descripcion']}',  @estado='{$data[0]['estado']}',
        @peso='{$data[0]['peso']}',@valor='{$data[0]['valor']}',@condicion='{$data[0]['condicion']}',
        @tipo='{$data[0]['tipo']}',@idOpcion='{$data[0]['id']}',@calificacion='{$data[0]['calificacion']}'
        ,@check_tabla='{$data[0]['check_tabla']}'
        ,@nom_tabla='{$data[0]['nom_tabla']}',
        @idUserAdd= {$data['user']}") ;

        return $query;
    }
    public function updateCaractControl($data){  
        
        $query= $this->db->query("EXEC modificar_caractControl 
        @caracteristica='{$data[0]['caracteristica']}',
        @descripcion='{$data[0]['descripcion']}',  
        @estado='{$data[0]['estado']}',
        @peso='{$data[0]['peso']}',@valor='{$data[0]['valor']}',
        @condicion = '{$data[0]['condicion']}',
        @check_tabla='{$data[0]['check_tabla']}',
        @nom_tabla='{$data[0]['nom_tabla']}',
        @idUserAdd= '{$data['user']}',
        @idCaractControl='{$data[0]['id_op']}'") ;
        return $query;
    }
    public function deleteCaractControl($data){
            
        $query=$this->db->query("EXEC eliminar_caractControl @idUserAdd={$data['user']}, @idCaractControl={$data[0]['id_op']}") ;
        
        return $query;
    }
}