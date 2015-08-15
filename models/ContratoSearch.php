<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

/**
 * Description of ContratoSearch
 *
 * @author Eriko
 */
class ContratoSearch extends Contrato{
    
    public $Inquilino;
    
     // now set the rules to make those attributes safe
    public function rules()
    {
        return [
            
            [['Inquilino'], 'safe'],
            
        ];
    }
    
}
