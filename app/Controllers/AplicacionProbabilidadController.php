<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MAplicacionProbabilidad;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class AplicacionProbabilidadController extends BaseController
{
    use ResponseTrait;
    public function getAplicacionProbabilidad(){

        try {
            $model = new MAplicacionProbabilidad();
                $response = [
                    'data' =>  $model->getAplicacionProbabilidad()
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
    
    public function addAplicacionProbabilidad()
    {
   
        try {
            $input = $this->getRequestInput($this->request);

      
            $model = new MAplicacionProbabilidad();
        
            $valida = $model -> validaAplicacionProbabilidad($input[0]);
            if(!$valida){
                $result = $model->saveAplicacionProbabilidad($input);
                $msg = 'Registrado Correctamente';
                $error = 1;
            }else{
                $msg = 'Ya registrada';
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
    public function updateAplicacionProbabilidad()
    {
   
        try {
            $input = $this->getRequestInput($this->request);
            $model = new MAplicacionProbabilidad();
            $result = $model->updateAplicacionProbabilidad($input);
        
            return $this->getResponse(
                [
                    'msg' =>  true
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
    public function deleteAplicacionProbabilidad()
    {
   
        try{
            $input = $this->getRequestInput($this->request);

        
            $model = new MAplicacionProbabilidad();
            $result = $model->deleteAplicacionProbabilidad($input);
        
            return $this->getResponse(
                [
                    'msg' =>  'Eliminado Correctamente'
                ]
            );
        } catch (Exception $ex) {
            return $this->getResponse(
                [
                    'error' => 'AplicacionProbabilidad está asignado, no es posible eliminarlo',
                ]
            );
        }
      
        
    }
}