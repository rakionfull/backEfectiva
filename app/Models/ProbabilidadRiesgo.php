<?php

namespace App\Models;

use CodeIgniter\Model;

class ProbabilidadRiesgo extends Model
{
    protected $table = 'probabilidad_riesgo';

    protected $allowedFields = [
        'descripcion',
        'tipo_regla',
        'tipo_valor',
        'formula',
        'operador1',
        'valor1',
        'operador2',
        'valor2',
        'comentario',
        'estado',
        'escenario'
    ];

    public function getAll($scene){
        $sql = "EXEC sp_list_probabilidad ?";
        $result = $this->db->query($sql,[$scene])->getResultArray();
        return $result;
    }

    public function store_1($data){
        $sql = "EXEC sp_add_probabilidad_1 ?,?,?,?,?,?,?,?,?";
        $result = $this->db->query($sql,[
            $data['formula'],
            $data['descripcion'],
            $data['tipo_regla'],
            $data['tipo_valor'],
            $data['comentario'],
            $data['estado'],
            '1',
            $data['id_user_added'],
            $data['date_add']
        ]);
        if($result){
            return true;
        }
        return false;
    }

    public function store_2($data){
        $sql = "EXEC sp_add_probabilidad_2 ?,?,?,?,?,?,?,?,?,?,?,?";
        $result = $this->db->query($sql,[
            $data['descripcion'],
            $data['tipo_regla'],
            $data['tipo_valor'],
            $data['operador1'],
            $data['valor1'],
            $data['operador2'],
            $data['valor2'],
            $data['comentario'],
            $data['estado'],
            '2',
            $data['id_user_added'],
            $data['date_add']
        ]);
        if($result){
            return true;
        }
        return false;
    }
    public function edit_1($data){
        $sql = "EXEC sp_edit_probabilidad_1 ?,?,?,?,?,?,?,?,?";
        $result = $this->db->query($sql,[
            $data['id'],
            $data['descripcion'],
            $data['tipo_regla'],
            $data['tipo_valor'],
            $data['comentario'],
            $data['estado'],
            $data['formula'],
            $data['id_user_updated'],
            $data['date_modify']
        ]);
        if($result){
            return true;
        }
        return false;
    }
    public function edit_2($data){
        $sql = "EXEC sp_edit_probabilidad_2 ?,?,?,?,?,?,?,?,?,?,?,?";
        $result = $this->db->query($sql,[
            $data['id'],
            $data['descripcion'],
            $data['tipo_regla'],
            $data['tipo_valor'],
            $data['operador1'],
            $data['valor1'],
            $data['operador2'],
            $data['valor2'],
            $data['comentario'],
            $data['estado'],
            $data['id_user_updated'],
            $data['date_modify']
        ]);
        if($result){
            return true;
        }
        return false;
    }
    public function destroy($id,$data){
        $sql = "EXEC sp_delete_probabilidad ?,?,?";
        $result = $this->db->query($sql,[
            $id,
            $data['id_user_deleted'],
            $data['date_deleted']
        ]);
        if($result){
            return true;
        }
    }

    public function updateScene($data,$scene){
        $sql = "EXEC sp_update_scene_probabilidad_user ?,?";
        $result = $this->db->query($sql,[
            $data['user_id'],
            $scene
        ]);
        if($result){
            return true;
        }
        return false;
    }

    public function getActivesScene1(){
        $sql = "EXEC sp_get_active_escenario_1";
        $result = $this->db->query($sql)->getResultArray();
        return $result;
    }
    public function validateCombinatoria($data){
        $sql = "EXEC sp_validate_combinatoria_probabilidad ?,?,?,?";
        $result = $this->db->query($sql,[
            $data['operador1'],
            $data['valor1'],
            $data['operador2'],
            $data['valor2'],
        ])->getResultArray();
        return $result;
    }
}