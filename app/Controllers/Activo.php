<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Muser;
use App\Models\MconfigPass;
use App\Models\Mperfil;
use App\Models\Mcaptcha;
use App\Models\Mempresa;
use App\Models\Marea;
use App\Models\MclasInformacion;
use App\Models\Mtipoactivo;
use App\Models\Mvaloractivo;
use App\Models\MaspectoSeg;
use App\Models\Munidades;
use App\Models\Mmacroprocesos;
use App\Models\MProceso;
use App\Models\MPosicion;
use App\Models\MValoracionActivo;
use App\Models\MCatActivo;
use App\Models\MPais;
use App\Models\MUbicActivo;
use App\Models\Mestado;
use App\Models\Mprioridad;
use App\Models\Malerta_seguimiento;


use App\Models\MriesgoPlanAccion;

use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Libraries\Capcha;
use App\Models\InventarioClasificacionActivo;
use Exception;
use ReflectionException;

class Activo extends BaseController
{
    use ResponseTrait;


    //activos para nuevo controlador
    public function getEmpresas(){

        try {
            $model = new Mempresa();
                $response = [
                    'data' =>  $model->getEmpresas()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    public function getEmpresasByActivo(){

        try {
            $model = new Mempresa();
                $response = [
                    'data' =>  $model->getEmpresasByActivo()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    public function addEmpresa()
    {
   
        
        $input = $this->getRequestInput($this->request);

      
        $model = new Mempresa();
        $valida = $model -> validaEmpresa($input);
        if(!$valida){
            $result = $model->saveEmpresa($input);
            $msg = 'Registrado Correctamente';
            $error = 1;
        }else{
            $msg = 'Empresa ya registrada';
            $error = 0;
        }
        
    
        return $this->getResponse(
            [
                'msg' =>  $msg,
                'error' =>  $error
            ]
        );
      
        
    }
    public function updateEmpresa()
    {
   
        
        $input = $this->getRequestInput($this->request);

      
        $model = new Mempresa();
        $result = $model->updateEmpresa($input);
    
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    public function deleteEmpresa()
    {
   
        try{
            $input = $this->getRequestInput($this->request);

        
            $model = new Mempresa();
            $result = $model->deleteEmpresa($input['id']);
        
            return $this->getResponse(
                [
                    'msg' =>  'Eliminado Correctamente'
                ]
            );
        } catch (Exception $ex) {
            return $this->getResponse(
                [
                    'error' => 'Empresa est?? asignado, no es posible eliminarlo',
                ]
            );
        }
      
        
    }
    public function getArea(){

        try {
            $model = new Marea();
                $response = [
                    'data' =>  $model->getArea()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    public function getAreasByActivo(){

        try {
            $model = new Marea();
            $input = $this->getRequestInput($this->request);
                $response = [
                    'data' =>  $model->getAreasByActivo($input['idempresa'])
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    public function addArea()
    {
   
        
        $input = $this->getRequestInput($this->request);

      
        $model = new Marea();
    
        $valida = $model -> validaArea($input);
        if(!$valida){
            $result = $model->saveArea($input);
            $msg = 'Registrado Correctamente';
            $error = 1;
        }else{
            $msg = 'Arera ya registrada';
            $error = 0;
        }
        
    
        return $this->getResponse(
            [
                'msg' =>  $msg,
                'error' =>  $error
            ]
        );
      
        
    }
    public function updateArea()
    {
   
        
        $input = $this->getRequestInput($this->request);

      
        $model = new Marea();
        $result = $model->updateArea($input);
    
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    public function deleteArea()
    {
   
        try{
            $input = $this->getRequestInput($this->request);

        
            $model = new Marea();
            $result = $model->deleteArea($input['id']);
        
            return $this->getResponse(
                [
                    'msg' =>  'Eliminado Correctamente'
                ]
            );
        } catch (Exception $ex) {
            return $this->getResponse(
                [
                    'error' => '??rea est?? asignado, no es posible eliminarlo',
                ]
            );
        }
      
        
    }
    public function getAreasEmpresa($id){

        try {
            $model = new Marea();
                $response = [
                    'data' =>  $model->getAreasEmpresa($id)
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    public function addAreaEmpresa()
    {
   
        
        $input = $this->getRequestInput($this->request);

      
        $model = new Marea();
        $result = $model->saveAreaEmpresa($input);
    
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    public function updateAreaEmpresa()
    {
   
        
        $input = $this->getRequestInput($this->request);

      
        $model = new Marea();
        $result = $model->updateAreaEmpresa($input);
    
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    public function addConfigPass()
    {
        $rules = [
            'duracion' => 'required|is_natural',
            'sesion' => 'required|is_natural',
            'inactividad' => 'required|is_natural',
            'intentos' => 'required|is_natural',
            'tama_min' => 'required|is_natural',
            'tama_max' => 'required|is_natural',
                       
        ];
        $errors = [
            'duracion' => [
                'required' => 'Debe ingresar valor',
               
            ],
            'sesion' => [
                'required' =>'Debe ingresar valor',
              
            ],
            'inactividad' => [
                'required' =>'Debe ingresar valor',
              
            ],
            
            'intentos' => [
                'required' => 'Debe ingresar valor',
             
            ],
            'tama_min' => [
                'required' => 'Debe ingresar valor',
             
            ],
            'tama_max' => [
                'required' => 'Debe ingresar valor',
             
            ],
        
            
        ];
        
        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules, $errors)) {
            $error = [
                'error' => 'valida',
                'datos' => $this->validator->getErrors()
            ];
            return ($this->getResponse($error,ResponseInterface::HTTP_OK));
          
        }

        $model = new MconfigPass();
        $result = $model->updateConfigPass($input);
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    public function getConfigPass(){

        try {
            $model = new MconfigPass();
                $response = [
                    'data' =>  $model->getConfigPass()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
      //------------------------------------------------------------------------------

      
      public function getValorActivo(){

        try {
            $model = new Mvaloractivo();
                $response = [
                    'data' =>  $model->getValorActivo()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    public function validarValorActivo(){
        try {
            $model = new Mvaloractivo();
            $input = $this->getRequestInput($this->request);
                $response = [
                    'msg' =>  $model->validaValorActivo($input['valor']),
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }
    }
    public function getValorActivoByActivo(){

        try {
            $model = new Mvaloractivo();
                $response = [
                    'data' =>  $model->getValorActivoByActivo()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    public function addValorActivo()
    {
   
        
        $input = $this->getRequestInput($this->request);

      
        $model = new Mvaloractivo();
        $result = $model->saveValorActivo($input);
    
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    public function updateValorActivo()
    {
   
        
        $input = $this->getRequestInput($this->request);

      
        $model = new Mvaloractivo();
        $result = $model->updateValorActivo($input);
    
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    public function deleteValorActivo()
    {
   
        try{
            $input = $this->getRequestInput($this->request);

        
            $model = new Mvaloractivo();
            $result = $model->deleteValorActivo($input['id']);
        
            return $this->getResponse(
                [
                    'msg' =>  'Valor Activo eliminado Correctamente'
                ]
            );
        } catch (Exception $ex) {
            return $this->getResponse(
                [
                    'error' => 'El Valor activo est?? asignado, no es posible eliminarlo',
                ]
            );
        }
      
        
    }
    public function getTipoActivo(){

        try {
            $model = new Mtipoactivo();
                $response = [
                    'data' =>  $model->getTipoActivo()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    public function getTipoActivoByActivo(){

        try {
            $model = new Mtipoactivo();
                $response = [
                    'data' =>  $model->getTipoActivoByActivo()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    public function addTipoActivo()
    {
   
        
        $input = $this->getRequestInput($this->request);

      
        $model = new Mtipoactivo();
        $result = $model->saveTipoActivo($input);
    
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    public function validarTipoActivo(){
        try {
            $model = new Mtipoactivo();
            $input = $this->getRequestInput($this->request);
                $response = [
                    'msg' =>  $model->validarTipoActivo($input['tipo']),
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }
    }
    public function updateTipoActivo()
    {
   
        
        $input = $this->getRequestInput($this->request);

      
        $model = new Mtipoactivo();
        $result = $model->updateTipoActivo($input);
    
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }

    public function deleteTipoActivo()
    {
   
        try{
            $input = $this->getRequestInput($this->request);

        
            $model = new Mtipoactivo();
            $result = $model->deleteTipoActivo($input['id']);
        
            return $this->getResponse(
                [
                    'msg' =>  'Eliminado Correctamente'
                ]
            );
        } catch (Exception $ex) {
            return $this->getResponse(
                [
                    'error' => 'El tipo de activo est?? asignado, no es posible eliminarlo',
                ]
            );
        }
      
        
    }
    //clasificaicon de informacion
    public function getClasInformacion(){

        try {
            $model = new MclasInformacion();
                $response = [
                    'data' =>  $model->getClasInformacion()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    public function validarClasInfo(){
        try {
            $model = new MclasInformacion();
            $input = $this->getRequestInput($this->request);
                $response = [
                    'msg' =>  $model->validarClasInfo($input['clasificacion']),
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }
    }
    public function addClasInformacion()
    {
   
        
        $input = $this->getRequestInput($this->request);

      
        $model = new MclasInformacion();
        $result = $model->saveClasInformacion($input);
    
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    public function updateClasInformacion()
    {
   
        
        $input = $this->getRequestInput($this->request);

      
        $model = new MclasInformacion();
        $result = $model->updateClasInformacion($input);
    
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    public function deleteClasInfo()
    {
   
        try{
            $input = $this->getRequestInput($this->request);

        
            $model = new MclasInformacion();
            $result = $model->deleteClasInfo($input['id']);
        
            return $this->getResponse(
                [
                    'msg' =>  'Eliminado Correctamente'
                ]
            );
        } catch (Exception $ex) {
            return $this->getResponse(
                [
                    'error' => 'La clasificaci??n de infromaci??n est?? asignado, no es posible eliminarlo',
                ]
            );
        }
      
        
    }
    //aspecto de seguridad
    public function getAspectoSeg(){

        try {
            $model = new MaspectoSeg();
                $response = [
                    'data' =>  $model->getAspectoSeg()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    public function getAspectoByActivo(){

        try {
            $model = new MaspectoSeg();
                $response = [
                    'data' =>  $model->getAspectoByActivo()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    public function validarApectoSeg(){
        try {
            $model = new MaspectoSeg();
            $input = $this->getRequestInput($this->request);
                $response = [
                    'msg' =>  $model->validaAspectoSeg($input['aspecto']),
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }
    }
    public function addAspectoSeg()
    {
           
        $input = $this->getRequestInput($this->request);

      
        $model = new MaspectoSeg();
        $result = $model->saveAspectoSeg($input);
    
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    public function updateAspectoSeg()
    {
           
        $input = $this->getRequestInput($this->request);

      
        $model = new MaspectoSeg();
        $result = $model->updateAspectoSeg($input);
    
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    public function deleteAspectoSeg()
    {
   
        try{
            $input = $this->getRequestInput($this->request);

        
            $model = new MaspectoSeg();
            $result = $model->deleteAspectoSeg($input['id']);
        
            return $this->getResponse(
                [
                    'msg' =>  'Apecto de Seguridad eliminado Correctamente'
                ]
            );
        } catch (Exception $ex) {
            return $this->getResponse(
                [
                    'error' => 'El Apecto de Seguridad est?? asignado, no es posible eliminarlo',
                ]
            );
        }
      
        
    }
    //Unidades
    public function getUnidades(){

        try {
            $model = new Munidades();
            $input = $this->getRequestInput($this->request);
                $response = [
                    'data' =>  $model->getUnidades($input)
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    public function getUnidadByActivo(){

        try {
            $model = new Munidades();
            $input = $this->getRequestInput($this->request);
                $response = [
                    'data' =>  $model->getUnidadByActivo($input)
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    public function addUnidades()
    {
           
        $input = $this->getRequestInput($this->request);

      
        $model = new Munidades();
        
    
        $valida = $model -> validaUnidad($input);
        if(!$valida){
            $result = $model->saveUnidades($input);
            $msg = 'Registrado Correctamente';
            $error = 1;
        }else{
            $msg = 'Unidad ya registrada';
            $error = 0;
        }
        
    
        return $this->getResponse(
            [
                'msg' =>  $msg,
                'error' =>  $error
            ]
        );
        
    }

    public function updateUnidades()
    {
           
        $input = $this->getRequestInput($this->request);

      
        $model = new Munidades();
        $result = $model->updateUnidades($input);
    
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    
    public function deleteUnidad()
    {
   
        try{
            $input = $this->getRequestInput($this->request);

        
            $model = new Munidades();
            $result = $model->deleteUnidad($input['id']);
        
            return $this->getResponse(
                [
                    'msg' =>  'Eliminado Correctamente'
                ]
            );
        } catch (Exception $ex) {
            return $this->getResponse(
                [
                    'error' => 'Unidad est?? asignado, no es posible eliminarlo',
                ]
            );
        }
      
        
    }
    //macroproceso
    public function getMacroproceso(){

        try {
            $model = new Mmacroprocesos();
                $response = [
                    'data' =>  $model->getMacroproceso()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    public function getMacroprocesoByActivo(){

        try {
            $model = new Mmacroprocesos();
            $input = $this->getRequestInput($this->request);
                $response = [
                    'data' =>  $model->getMacroprocesoByActivo($input)
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    
    
    public function addMacroproceso()
    {
           
        $input = $this->getRequestInput($this->request);

      
        $model = new Mmacroprocesos();
      
    
        $valida = $model -> validaMacroproceso($input);
        if(!$valida){
            $result = $model->saveMacroproceso($input);
            $msg = 'Registrado Correctamente';
            $error = 1;
        }else{
            $msg = 'Macroproceso ya registrada';
            $error = 0;
        }
        
    
        return $this->getResponse(
            [
                'msg' =>  $msg,
                'error' =>  $error
            ]
        );
      
        
    }
    public function updateMacroproceso()
    {
           
        $input = $this->getRequestInput($this->request);

      
        $model = new Mmacroprocesos();
        $result = $model->updateMacroproceso($input);
    
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    public function deleteMacroproceso()
    {
   
        try{
            $input = $this->getRequestInput($this->request);

        
            $model = new Mmacroprocesos();
            $result = $model->deleteMacroproceso($input['id']);
        
            return $this->getResponse(
                [
                    'msg' =>  'Eliminado Correctamente'
                ]
            );
        } catch (Exception $ex) {
            return $this->getResponse(
                [
                    'error' => 'Macroproceso est?? asignado, no es posible eliminarlo',
                ]
            );
        }
      
        
    }

    public function getProcesoByActivo(){

        try {
            $model = new Mproceso();
                $response = [
                    'data' =>  $model->getProcesoByActivo()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    
    //proceso
    public function getProceso(){

        try {
            $model = new Mproceso();
                $response = [
                    'data' =>  $model->getProceso()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    
    //proceos
    public function addProceso()
    {
           
        $input = $this->getRequestInput($this->request);

      
        $model = new Mproceso();
        $valida = $model->validaProceso($input);
    
        if(!$valida){
            $result = $model->saveProceso($input);
            $msg = 'Registrado Correctamente';
            $error = 1;
        }else{
            $msg = 'Proceso ya registrada';
            $error = 0;
        }
        
    
        return $this->getResponse(
            [
                'msg' =>  $msg,
                'error' =>  $error
            ]
        );
      
        
    }
    public function updateProceso()
    {
           
        $input = $this->getRequestInput($this->request);

      
        $model = new Mproceso();
        $result = $model->updateProceso($input);
    
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    public function deleteProceso()
    {
   
        try{
            $input = $this->getRequestInput($this->request);

        
            $model = new Mproceso();
            $result = $model->deleteProceso($input['id']);
        
            return $this->getResponse(
                [
                    'msg' =>  'Eliminado Correctamente'
                ]
            );
        } catch (Exception $ex) {
            return $this->getResponse(
                [
                    'error' => 'Proceso est?? asignado, no es posible eliminarlo',
                ]
            );
        }
      
        
    }

    //posicion y puesto
    public function getPosicion(){

        try {
            $model = new MPosicion();
                $response = [
                    'data' =>  $model->getPosicion()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    public function getPosicionByArea($area_id){
        try {
            $model = new MPosicion();
            $response = [
                'data' =>  $model->getPosicionByArea($area_id)
            ];
            return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }
    }
    public function getPosicionByActivo(){

        try {
            $model = new MPosicion();
            $input = $this->getRequestInput($this->request);
                $response = [
                    'data' =>  $model->getPosicionByActivo($input['idempresa'])
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    public function validarPosicion(){
        try {
            $model = new MPosicion();
            $input = $this->getRequestInput($this->request);
                $response = [
                    'msg' =>  $model->validaPosicion($input),
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }
    }
    public function addPosicion()
    {
           
        $input = $this->getRequestInput($this->request);

      
        $model = new MPosicion();
        $result = $model->savePosicion($input);
    
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    public function updatePosicion()
    {
           
        $input = $this->getRequestInput($this->request);

      
        $model = new MPosicion();
        $result = $model->updatePosicion($input);
    
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    public function deletePosicion()
    {
   
        try{
            $input = $this->getRequestInput($this->request);

        
            $model = new MPosicion();
            $result = $model->deletePosicion($input['id']);
        
            return $this->getResponse(
                [
                    'msg' =>  'Posicion/Puesto eliminado Correctamente'
                ]
            );
        } catch (Exception $ex) {
            return $this->getResponse(
                [
                    'error' => 'Posicion/Puesto est?? asignado, no es posible eliminarlo',
                ]
            );
        }
      
        
    }

    //valoracion de activo
    public function getValActivo(){

        try {
            $model = new MValoracionActivo();
                $response = [
                    'data' =>  $model->getValActivo()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    public function validarValActivo(){
        try {
            $model = new MValoracionActivo();
            $input = $this->getRequestInput($this->request);
                $response = [
                    'msg' =>  $model->validarValActivo($input),
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }
    }
    public function addValActivo()
    {
           
        $input = $this->getRequestInput($this->request);

      
        $model = new MValoracionActivo();
        $result = $model->saveValActivo($input);
    
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    public function updateValActivo()
    {
        $input = $this->getRequestInput($this->request);

      
        $model = new MValoracionActivo();
        // $model_ica = new InventarioClasificacionActivo();
        $result = $model->updateValActivo($input);
        
        // $icas = $model_ica->listByValoraciones($input);

        // if(count($icas) > 0){
        //     foreach ($icas as $ica) {
        //         $model_ica->update_valor_ica($ica['id'],$input);
        //         $model_ica->store_historial(
        //             $ica['id'],$ica
        //         );
        //     }
        // }
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    public function deleteValActivo()
    {
   
        try{
            $input = $this->getRequestInput($this->request);

        
            $model = new MValoracionActivo();
            $result = $model->deleteValActivo($input['id']);
        
            return $this->getResponse(
                [
                    'msg' =>  'Eliminado Correctamente'
                ]
            );
        } catch (Exception $ex) {
            return $this->getResponse(
                [
                    'error' => 'No es posible eliminarlo, ya que esta siendo usado',
                ]
            );
        }
      
        
    }
    //categoria de activo
    public function getCatActivo(){

        try {
            $model = new MCatActivo();
                $response = [
                    'data' =>  $model->getCatActivo()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    public function validarCatActivo(){
        try {
            $model = new MCatActivo();
            $input = $this->getRequestInput($this->request);
                $response = [
                    'msg' =>  $model->validarCatActivo($input),
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }
    }
    public function addCatActivo()
    {
           
        $input = $this->getRequestInput($this->request);

      
        $model = new MCatActivo();
        $result = $model->saveCatActivo($input);
    
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    public function updateCatActivo()
    {
           
        $input = $this->getRequestInput($this->request);

      
        $model = new MCatActivo();
        $result = $model->updateCatActivo($input);
    
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    public function deleteCatActivo()
    {
   
        try{
            $input = $this->getRequestInput($this->request);

        
            $model = new MCatActivo();
            $result = $model->deleteCatActivo($input['id']);
        
            return $this->getResponse(
                [
                    'msg' =>  'Eliminado Correctamente'
                ]
            );
        } catch (Exception $ex) {
            return $this->getResponse(
                [
                    'error' => 'No es posible eliminarlo, est?? siendo usado por otra relaci??n',
                ]
            );
        }
      
        
    }

    //Ubicacion de activo
    public function getUbiActivo(){

        try {
            $model = new MUbicActivo();
                $response = [
                    'data' =>  $model->getUbiActivo()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    public function validarUbiActivo(){
        try {
            $model = new MUbicActivo();
            $input = $this->getRequestInput($this->request);
                $response = [
                    'msg' =>  $model->validarUbiActivo($input),
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }
    }
    public function addUbiActivo()
    {
           
        $input = $this->getRequestInput($this->request);

      
        $model = new MUbicActivo();
      
    
        $valida = $model -> validarUbiActivo($input);
        if(!$valida){
            $result = $model->saveUbiActivo($input);
            $msg = 'Registrado Correctamente';
            $error = 1;
        }else{
            $msg = 'Ubicacion de activo registrado ya registrada';
            $error = 0;
        }
        
    
        return $this->getResponse(
            [
                'msg' =>  $msg,
                'error' =>  $error
            ]
        );
      
        
    }
    public function updateUbiActivo()
    {
           
        $input = $this->getRequestInput($this->request);

      
        $model = new MUbicActivo();
        $result = $model->updateUbiActivo($input);
    
        return $this->getResponse(
            [
                'msg' =>  $result
            ]
        );
      
        
    }
    public function deleteUbiActivo()
    {
   
        try{
            $input = $this->getRequestInput($this->request);

        
            $model = new MUbicActivo();
            $result = $model->deleteUbiActivo($input['id']);
        
            return $this->getResponse(
                [
                    'msg' =>  'Eliminado Correctamente'
                ]
            );
        } catch (Exception $ex) {
            return $this->getResponse(
                [
                    'error' => 'No es posible eliminarlo, est?? siendo usado por otra relaci??n',
                ]
            );
        }
      
        
    }
     //continente
     public function getContinente(){

        try {
            $model = new MPais();
                $response = [
                    'data' =>  $model->getContinente()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
      //Pais
    public function getPais(){

        try {
            $model = new MPais();
            $input = $this->getRequestInput($this->request);
                $response = [
                    'data' =>  $model->getPaises($input['continente'])
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }
    //Ciudad
    public function getCiudad(){

        try {
            $model = new MPais();
            $input = $this->getRequestInput($this->request);
                $response = [
                    'data' =>  $model->getCiudad($input['pais'])
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }

           
    }


    public function getEstado(){

        try {
            $model = new Mestado();
                $response = [
                    'data' =>  $model->getEstado()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }
    
           
    }
    
    public function addEstado(){
        
        try {
            $input = $this->getRequestInput($this->request);
    
      
            $model = new Mestado();
        
            $valida = $model -> validaEstado($input[0]['estado']);
            if(!$valida){
                $result = $model->saveEstado($input);
                $msg = 'Registrado Correctamente';
                $error = 1;
            }else{
                $msg = 'Estado ya registrado';
                $error = 0;
            }
            return $this->getResponse(
                [
                    'msg' =>  $msg,
                    'error' =>  $error
                ]
            );
        } catch (Exception $ex) {
            return $this->getResponse(
                [
                    'error' => $ex->getMessage(),
                ],
                ResponseInterface::HTTP_OK
        );
        }
    }
    
    public function updateEstado(){
        
        try {
            
            $input = $this->getRequestInput($this->request);
        
            $model = new Mestado();
            $result = $model->updateEstado($input);
        
            return $this->getResponse([
                'msg' => 'Estado actualizado correctamente',
                'error' => 1
            ]);
        
        } catch (Exception $ex) {
            
            return $this->getResponse([
                'error' => $ex->getMessage()
            ], ResponseInterface::HTTP_OK);
        }
        
    }
    
    public function deleteEstado(){
        
        try {
            
            $input = $this->getRequestInput($this->request);       
            $model = new Mestado();    
            
            $result = $model->deleteEstado($input);   
            
            return $this->getResponse([
                'msg' => 'Estado Eliminado correctamente',
                'error' => 0
            ]);
        
        } catch (Exception $ex) {
            
            return $this->getResponse([
                'error' => $ex->getMessage()
            ], ResponseInterface::HTTP_OK);
        }
    }
    
    public function getPrioridad(){
    
        try {
            $model = new Mprioridad();
                $response = [
                    'data' =>  $model->getPrioridad()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }
    
           
    }
    
    public function addPrioridad(){
        
        try {
            $input = $this->getRequestInput($this->request);
    
      
            $model = new Mprioridad();
        
            $valida = $model -> validaPrioridad($input[0]['prioridad']);
            if(!$valida){
                $result = $model->savePrioridad($input);
                $msg = 'Registrado Correctamente';
                $error = 1;
            }else{
                $msg = 'Prioridad ya registrada';
                $error = 0;
            }
            return $this->getResponse(
                [
                    'msg' =>  $msg,
                    'error' =>  $error
                ]
            );
        } catch (Exception $ex) {
            return $this->getResponse(
                [
                    'error' => $ex->getMessage(),
                ],
                ResponseInterface::HTTP_OK
        );
    }
    }
    
    public function updatePrioridad(){
    
        try {
            
            $input = $this->getRequestInput($this->request);
        
            $model = new Mprioridad();
            $result = $model->updatePrioridad($input);
        
            return $this->getResponse([
                'msg' => 'Prioridad actualizada correctamente',
                'error' => 1
            ]);
        
        } catch (Exception $ex) {
            
            return $this->getResponse([
                'error' => $ex->getMessage()
            ], ResponseInterface::HTTP_OK);
        }
      
        
    }
    
    public function deletePrioridad(){
    
        try {
            
            $input = $this->getRequestInput($this->request);       
            $model = new Mprioridad();    
            
            $result = $model->deletePrioridad($input);   
            
            return $this->getResponse([
                'msg' => 'Prioridad Eliminado correctamente',
                'error' => 0
            ]);
        
        } catch (Exception $ex) {
            
            return $this->getResponse([
                'error' => $ex->getMessage()
            ], ResponseInterface::HTTP_OK);
        }
    }
    
    public function getAlerta_seguimiento(){
    
            try {
                $model = new Malerta_seguimiento();
                    $response = [
                        'data' =>  $model->getAlerta_seguimiento()
                    ];
                    return $this->respond($response, ResponseInterface::HTTP_OK);
            
            } catch (Exception $ex) {
                return $this->getResponse(
                        [
                            'error' => $ex->getMessage(),
                        ],
                        ResponseInterface::HTTP_OK
                    );
            }
    
               
    }
              
    public function addAlerta_seguimiento(){
       
            
            try {
                $input = $this->getRequestInput($this->request);
        
          
                $model = new Malerta_seguimiento();
            
                $valida = $model -> validaAlerta_seguimiento($input[0]['alerta']);
                if(!$valida){
                    $result = $model->saveAlerta_seguimiento($input);
                    $msg = 'Registrado Correctamente';
                    $error = 1;
                }else{
                    $msg = 'Alerta ya registrada';
                    $error = 0;
                }
                return $this->getResponse(
                    [
                        'msg' =>  $msg,
                        'error' =>  $error
                    ]
                );
            } catch (Exception $ex) {
                return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
            );
        }
    }
    
    public function updateAlerta_seguimiento(){
       
        try {
            
            $input = $this->getRequestInput($this->request);
        
            $model = new Malerta_seguimiento();
            $result = $model->updateAlerta_seguimiento($input);
        
            return $this->getResponse([
                'msg' => 'Alerta actualizada correctamente',
                'error' => 1
            ]);
        
        } catch (Exception $ex) {
            
            return $this->getResponse([
                'error' => $ex->getMessage()
            ], ResponseInterface::HTTP_OK);
        }
          
            
    }
    
    public function deleteAlerta_seguimiento()
        {
       
            try {
            
                $input = $this->getRequestInput($this->request);       
                $model = new Malerta_seguimiento();    
                
                $result = $model->deleteAlerta_seguimiento($input);   
                
                return $this->getResponse([
                    'msg' => 'Estado Eliminado correctamente',
                    'error' => 0
                ]);
            
            } catch (Exception $ex) {
                
                return $this->getResponse([
                    'error' => $ex->getMessage()
                ], ResponseInterface::HTTP_OK);
            }
    }  
    
    
    
    
        //-----------------------------RIESGO PLAN DE ACCI??N-------------------------------------------------
    
    
    
    
    
    public function getPlanAccion(){
    
        try {
            $model = new MriesgoPlanAccion();
                $response = [
                    'data' =>  $model->getPlanAccion()
                ];
                return $this->respond($response, ResponseInterface::HTTP_OK);
        
        } catch (Exception $ex) {
            return $this->getResponse(
                    [
                        'error' => $ex->getMessage(),
                    ],
                    ResponseInterface::HTTP_OK
                );
        }
    
           
    }
    
    public function addPlanAccion(){
        
        try {
            $input = $this->getRequestInput($this->request);
    
      
            $model = new Mestado();
        
            $valida = $model -> validaEstado($input[0]['estado']);
            if(!$valida){
                $result = $model->saveEstado($input);
                $msg = 'Registrado Correctamente';
                $error = 1;
            }else{
                $msg = 'Estado ya registrado';
                $error = 0;
            }
            return $this->getResponse(
                [
                    'msg' =>  $msg,
                    'error' =>  $error
                ]
            );
        } catch (Exception $ex) {
            return $this->getResponse(
                [
                    'error' => $ex->getMessage(),
                ],
                ResponseInterface::HTTP_OK
        );
        }
    }
    
    
    public function updatePlanAccion(){
        
        try {
            
            $input = $this->getRequestInput($this->request);
        
            $model = new Mestado();
            $result = $model->updateEstado($input);
        
            return $this->getResponse([
                'msg' => 'Estado actualizado correctamente',
                'error' => 1
            ]);
        
        } catch (Exception $ex) {
            
            return $this->getResponse([
                'error' => $ex->getMessage()
            ], ResponseInterface::HTTP_OK);
        }
        
    }
    
    
    public function deletePlanAccion(){
        
        try {
            
            $input = $this->getRequestInput($this->request);       
            $model = new Mestado();    
            
            $result = $model->updateEstado([
                'id' => $input['id'],
                'is_delete' => 1
            ]);
        
            
            return $this->getResponse([
                'msg' => 'Estado Eliminado correctamente',
                'error' => 0
            ]);
        
        } catch (Exception $ex) {
            
            return $this->getResponse([
                'error' => $ex->getMessage()
            ], ResponseInterface::HTTP_OK);
        }
    }
    


}