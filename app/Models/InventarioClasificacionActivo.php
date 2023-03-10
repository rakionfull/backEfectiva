<?php

namespace App\Models;

use CodeIgniter\Model;

class InventarioClasificacionActivo extends Model
{
    protected $table            = 'inventario_clasificacion_activo';
    public $estados = [
        '1' => 'Borrador',
        '2' => 'Registrado',
        '3' => 'Observado',
        '4' => 'Aprobado',
        '5' => 'Por actualizar'
    ];

    public function getAllHistoricos(){
        $sql = "EXEC sp_list_inventario_clasificacion_activo_historial";
        $result = $this->db->query($sql)->getResultArray();
        return $result;
    }
    public function getAllHistoricosByUser($user_id){
        $sql = "EXEC sp_list_inventario_clasificacion_activo_historial_by_user ?";
        $result = $this->db->query($sql,[$user_id])->getResultArray();
        return $result;
    }

    public function getAll(){
        $sql = "EXEC sp_list_inventario_clasificacion_activo";
        $result = $this->db->query($sql)->getResultArray();
        return $result;
    }

    public function getById($id){
        $sql = "EXEC sp_get_inventario_clasificacion_activo ?";
        $result = $this->db->query($sql,[$id])->getResultArray();
        return $result;
    }

    public function getByUser($user_id){
        $sql = "EXEC sp_list_inventario_clasificacion_activo_by_user ? ";
        $result = $this->db->query($sql,[$user_id])->getResultArray();
        return $result;
    }

    public function store($data){
        $sql = "EXEC sp_add_inventario_clasificacion_activo ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?";
        $result = $this->db->query($sql,[
            $data['idempresa'],
            $data['idarea'],
            $data['idunidad'],
            $data['idmacroproceso'],
            $data['idproceso'],
            $data['activo'],
            $data['desc_activo'],
            $data['idtipo_activo'],
            $data['idcategoria_activo'],
            $data['idubicacion'],
            $data['idpropietario'],
            $data['idcustodio'],
            $data['val_c'],
            $data['val_i'],
            $data['val_d'],
            $data['idvalor'],
            $data['estado'],
            $data['comentario'],
            $data['id_user_added'],
            $data['date_add']
        ]);
        if($result){
            $sql = "EXEC sp_get_last_id";
            $result = $this->db->query($sql)->getResult();
            // $this->store_historial($result[0]->id,$data);
            if($data['estado'] == '2'){
                // return $data;
                $response = $this->sendMail($result[0]->id,"ansir.manuel@gmail.com");
                return $response;
            }
            return true;
        }
        return false;
    }
    public function store_historial($id_ica,$data){
        $sql = "EXEC sp_add_inventario_clasificacion_activo_historial ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?";
        $result = $this->db->query($sql,[
            $id_ica,
            $data['idempresa'],
            $data['idarea'],
            $data['idunidad'],
            $data['idmacroproceso'],
            $data['idproceso'],
            $data['activo'],
            $data['desc_activo'],
            $data['idtipo_activo'],
            $data['idcategoria_activo'],
            $data['idubicacion'],
            $data['idpropietario'],
            $data['idcustodio'],
            $data['val_c'],
            $data['val_i'],
            $data['val_d'],
            $data['idvalor'],
            $data['estado'],
            $data['comentario'],
            $data['id_user_added'],
            $data['date_add']
        ]);
        if($result){
            return true;
        }
        return false;
    }

    public function edit($id,$data){
        $sql = "EXEC sp_edit_inventario_clasificacion_activo ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?";
        $result = $this->db->query($sql,[
            $id,
            $data['idempresa'],
            $data['idarea'],
            $data['idunidad'],
            $data['idmacroproceso'],
            $data['idproceso'],
            $data['activo'],
            $data['desc_activo'],
            $data['idtipo_activo'],
            $data['idcategoria_activo'],
            $data['idubicacion'],
            $data['idpropietario'],
            $data['idcustodio'],
            $data['val_c'],
            $data['val_i'],
            $data['val_d'],
            $data['idvalor'],
            $data['estado'],
            $data['comentario'],
            $data['id_user_updated'],
            $data['date_modify'],
            $data['observacion']
        ]);
        if($result){
            if($data['estado'] == '2' || $data['estado'] == '3'){
                // return $data;
                // send email area seguridad informacion
                $response = $this->sendMail($id,"ansir.manuel@gmail.com");
                return $response;
            }
            return true;
        }
        return false;
    }

    public function destroy($id,$data){
        $sql = "EXEC sp_delete_inventario_clasificacion_activo ?,?,?";
        $result = $this->db->query($sql,[
            $id,
            $data['id_user_deleted'],
            $data['date_deleted']
        ]);
        if($result){
            return true;
        }
    }

    public function sendMail($id,$mail){
        try {
            $sql = "EXEC sp_get_info_to_email ?";
            $result = $this->db->query($sql,[
                $id
            ])->getResult();
            if(count($result)>0){
                log_message('info','Aquie sta');
                $email = \Config\Services::email();
                $email->setTo($mail);
                $email->setBCC($mail);
                $email->setFrom('noreply@gmail.com', 'Inventario Clasificacion Activo registrado');
                $email->setSubject('Inventario Clasificacion Activo registrado');
                $email->setMessage(
                   view('mail/register_inventario_clasificacion_activo',[
                    'data'=>$result[0]
                    ])
                );
                $email->send();
                return $email;
            }
            return false;
        } catch (\Throwable $th) {
            log_message('error',$th->getMessage()." linea ".$th->getLine()." file ".$th->getFile());
            return false;
        }
        
    }

    public function getValorByValoraciones($data){
        try {
            $sql = "EXEC sp_get_valor_combinacion_valoracion ?,?,?";
            $result = $this->db->query($sql,[
                $data['val_c'],
                $data['val_i'],
                $data['val_d'],
            ])->getResultArray();
            return $result;
        } catch (\Throwable $th) {
            log_message('error',$th->getMessage()." linea ".$th->getLine()." file ".$th->getFile());
            return false;
        }
    }
    public function listByValoraciones($data){
        try {
            $sql = "EXEC sp_list_ica_by_valoracion ?,?,?";
            $result = $this->db->query($sql,[
                $data['nom_val1'],
                $data['nom_val2'],
                $data['nom_val3'],
            ])->getResultArray();
            return $result;
        } catch (\Throwable $th) {
            log_message('error',$th->getMessage()." linea ".$th->getLine()." file ".$th->getFile());
            return false;
        }
    }

    public function update_valor_ica($id,$data){
        try {
            $sql = "EXEC update_valor_ica ?,?";
            $result = $this->db->query($sql,[
                $id,
                $data['id_valor_val']
            ]);
            if($result){
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            log_message('error',$th->getMessage()." linea ".$th->getLine()." file ".$th->getFile());
            return false;
        }
    }
    public function update_estado_ica($id,$data){
        try {
            $sql = "EXEC update_status_ica ?,?,?,?";
            $result = $this->db->query($sql,[
                $id,
                $data['estado'],
                $data['date_modify'],
                $data['id_user_updated'],
            ]);
            if($result){
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            log_message('error',$th->getMessage()." linea ".$th->getLine()." file ".$th->getFile());
            return false;
        }
    }

 
}
