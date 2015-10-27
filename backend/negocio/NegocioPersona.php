<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\negocio;

/**
 * Description of NegocioPersona
 *
 * @author root
 */
use backend\models\Persona;
class NegocioPersona {
  
    public function generarInsercionesDinamicas($cantidad){
        $tiempo_inicio = microtime(true);
        if($cantidad>0){
            for($i=0;$i<$cantidad;$i++){
                $persona=new Persona();
                $persona->nombre_completo="nombre ".$i;
                $persona->pais="pais ".$i;
                $persona->email="email ".$i;
                $persona->save();
            }
        }
        
        $tiempo_fin = microtime(true);
        return "Tiempo empleado: " . ($tiempo_fin - $tiempo_inicio);
    }
    public function buscarPorNombre($nombre){
        return Persona::find()->where(['like','nombre_completo',$nombre]);
    }
}
