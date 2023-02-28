<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MEvaluacionControl;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class EvaluacionControlController extends BaseController
{
    use ResponseTrait;
    public function getEvaluacionControl(){

        try {
            $model = new MEvaluacionControl();
                $response = [
                    'data' =>  $model->getEvaluacionControl()
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
    public function getOpcionesEvaluacionControl(){

        try {
            $model = new MEvaluacionControl();
                $response = [
                    'data' =>  $model->getOpcionesEvaluacionControl()
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
    public function addEvaluacionControl()
    {
   
        try {
            $input = $this->getRequestInput($this->request);

      
            $model = new MEvaluacionControl();
        
            $valida = $model -> validaEvaluacionControl($input[0]);
            if(!$valida){
                $result = $model->saveEvaluacionControl($input);
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
    public function updateEvaluacionControl()
    {
   
        try {
            $input = $this->getRequestInput($this->request);
            $model = new MEvaluacionControl();
            $result = $model->updateEvaluacionControl($input);
        
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
    public function deleteEvaluacionControl()
    {
   
        try{
            $input = $this->getRequestInput($this->request);

        
            $model = new MEvaluacionControl();
            $result = $model->deleteEvaluacionControl($input);
        
            return $this->getResponse(
                [
                    'msg' =>  'Eliminado Correctamente'
                ]
            );
        } catch (Exception $ex) {
            return $this->getResponse(
                [
                    'error' => 'EvaluacionControl está asignado, no es posible eliminarlo',
                ]
            );
        }
      
        
    }
    public function getDisenioCalificacion(){

        try {
            $model = new MEvaluacionControl();
                $response = [
                    'data' =>  $model->getDisenioCalificacion()
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
    public function getOperatividadCalificacion(){

        try {
            $model = new MEvaluacionControl();
                $response = [
                    'data' =>  $model->getOperatividadCalificacion()
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
}