<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MAplicacionImpacto;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class AplicacionImpactoController extends BaseController
{
    use ResponseTrait;
    public function getAplicacionImpacto(){

        try {
            $model = new MAplicacionImpacto();
                $response = [
                    'data' =>  $model->getAplicacionImpacto()
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
    
    public function addAplicacionImpacto()
    {
   
        try {
            $input = $this->getRequestInput($this->request);

      
            $model = new MAplicacionImpacto();
        
            $valida = $model -> validaAplicacionImpacto($input[0]);
            if(!$valida){
                $result = $model->saveAplicacionImpacto($input);
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
    public function updateAplicacionImpacto()
    {
   
        try {
            $input = $this->getRequestInput($this->request);
            $model = new MAplicacionImpacto();
            $result = $model->updateAplicacionImpacto($input);
        
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
    public function deleteAplicacionImpacto()
    {
   
        try{
            $input = $this->getRequestInput($this->request);

        
            $model = new MAplicacionImpacto();
            $result = $model->deleteAplicacionImpacto($input);
        
            return $this->getResponse(
                [
                    'msg' =>  'Eliminado Correctamente'
                ]
            );
        } catch (Exception $ex) {
            return $this->getResponse(
                [
                    'error' => 'AplicacionImpacto está asignado, no es posible eliminarlo',
                ]
            );
        }
      
        
    }
}