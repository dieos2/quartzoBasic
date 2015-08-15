<?php

namespace app\models;


use Yii;
use app\models;
class Setup extends \yii\db\ActiveRecord
{
    const DATE_FORMAT = 'php:Y-m-d';
    const DATETIME_FORMAT = 'php:Y-m-d H:i:s';
    const TIME_FORMAT = 'php:H:i:s';
 
    public static function AntesDeSalvar($dateStr, $type='date', $format = null) {
      
        if($dateStr != '1970-01-01 00:00:00' && $dateStr != '' ){
        $parts = explode('/', $dateStr);
        $dateStr = $parts[2] . '-' . $parts[1] . '-' . $parts[0];
        if ($type === 'datetime') {
              $fmt = ($format == null) ? self::DATETIME_FORMAT : $format;
        }
        elseif ($type === 'time') {
              $fmt = ($format == null) ? self::TIME_FORMAT : $format;
        }
        else {
              $fmt = ($format == null) ? self::DATE_FORMAT : $format;
        }
        return \Yii::$app->formatter->asDate($dateStr, $fmt);
        }else
        {
         return $dateStr = '';
        }
        
    }
    
    const DATE_FORMATD = 'php:d/m/Y';
    const DATETIME_FORMATD = 'php:d/m/Y H:i:s';
    const TIME_FORMATD = 'php:H:i:s';
    
     public static function DepoisDePegar($dateStr, $type='date', $format = null) {
        if($dateStr != '1970-01-01 00:00:00' && $dateStr != ''){
        if ($type === 'datetime') {
              $fmt = ($format == null) ? self::DATETIME_FORMATD : $format;
        }
        elseif ($type === 'time') {
              $fmt = ($format == null) ? self::TIME_FORMATD : $format;
        }
        else {
              $fmt = ($format == null) ? self::DATE_FORMATD : $format;
        }
        return \Yii::$app->formatter->asDate($dateStr, $fmt);
        }else
        {
         return $dateStr = '';
        }
        
    }
    
    
    
 
    public static function ExtraiMes($dateStr, $type='date', $format = null) {
      
        if($dateStr != '1970-01-01 00:00:00' && $dateStr != '' ){
        $parts = explode('-', $dateStr);
        $dateStr = $parts[1];
       
        return $dateStr;
        }else
        {
         return $dateStr = '';
        }
        
    }
    
    public static function ExtraiAno($dateStr, $type='date', $format = null) {
      
        if($dateStr != '1970-01-01 00:00:00' && $dateStr != '' ){
        $parts = explode('-', $dateStr);
        $dateStr = $parts[0];
       
        return $dateStr;
        }else
        {
         return $dateStr = '';
        }
        
    }
      public static function ExtraiDia($dateStr, $type='date', $format = null) {
      
        if($dateStr != '1970-01-01 00:00:00' && $dateStr != '' ){
        $parts = explode('-', $dateStr);
        $dateStr = $parts[2];
       
        return $dateStr;
        }else
        {
         return $dateStr = '';
        }
        
    }
     public static function AtualizaAluguel() {
      $teste = "-";
        $contratos = models\Contrato::getAtivos();
        foreach($contratos as $item){
            $contrato = models\Contrato::findOne($item->id);
            
            if(\app\models\Despesa::verificaAluguel($contrato->id)){
              
               $despesa  = \app\models\Despesa::verificaAluguel($contrato->id);
              
               if(Setup::VerificaDia($despesa->data)){
                $aluguel =   models\Despesa::LancaAluguel(Setup::VerificaDia($despesa->data), $contrato->id);
               }
               
              
            }else
            {
                 if(Setup::VerificaDia($contrato->data_inicio)){
                 $aluguel =   models\Despesa::LancaAluguel($contrato->data_inicio, $contrato->id);
                 }
            }
           
        }
    }
     public static function VerificaDia($data) {
         $hoje = date(self::DATE_FORMAT);
        $mesAluguel = Setup::ExtraiMes($data);
        $mesAtual = self::ExtraiMes($hoje);
        if($mesAluguel <= $mesAtual){
          $dia =  self::ExtraiDia($hoje);
          if($dia >= 25 )
          {
             return date('Y-m-d', strtotime("+1 months", strtotime($data)));
             
          }else
          {
               return false;
          }
        }else
        {
            return false;
        }
        
     
     }
     public static function FormataMoeda($valor){
         return 'R$ '.number_format($valor,2,",",".");
     }
     
     public static function CalculaPorcentagem($porcentagem, $valor){
         $porcentagem = $porcentagem /100;
         $valor = $valor*$porcentagem;
         return $valor;
     }
}