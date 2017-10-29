<?php
namespace App\Model\Util;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Resposta
 *
 * @author anderson
 */
class Resposta {
    public static function erro($context, $mensagen = "Erro ao efetuar operaçao"){
        $context->httpStatusCode = 300;
        $context->apiResponse['mensagem'] = strval($mensagen);
    }
    public static function resposta_correta($context, $lista){
        if(!is_array($lista)){
            $context->httpStatusCode = 300;
            $context->apiResponse['mensagem'] = strval("Esta funçao requer um array");
            return ; 
        }
        $context->httpStatusCode = 200;
        foreach($lista as $key => $value){
            $context->apiResponse[$key] = strval($value);
        }
    }
}
