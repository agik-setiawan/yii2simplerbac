<?php
namespace app\helpers\rbac;
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