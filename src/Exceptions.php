<?php
namespace agik\yii2simplerbac;
use yii\base\Component;
use yii\web\ForbiddenHttpException;
/**
* 
*/
class Exceptions extends Component
{

public function __construct(){

}

public function notAllowed($msg){
throw new ForbiddenHttpException($msg);
}

}