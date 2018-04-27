<?php
namespace agik\yii2simplerbac;
use yii\base\Component;
use app\config\role\Role;
use agik\yii2simplerbac\Exceptions;
/**
* 
*/
class CheckRole extends Component
{
	public $level;
	public $modules;
	public $module;
	public $controllers;
	public $controller;
	public $actions;
	public $action;
	public $data;
	public $layout;
	public $menus;
	public $user;

	public function __construct(){
		$excpt=new Exceptions();
		if(\Yii::$app->user->identity){
			$this->level=\Yii::$app->user->identity->level;
			$this->user=\Yii::$app->user->identity;
		}else{
			$excpt->notAllowed('You Dont Have Permission');
		}
		$this->layout='';
	}

	public function check($app,$msg=['notAllowed'=>''],$type=''){
		if(!$msg['notAllowed']){
			$msg['notAllowed']='You Dont Have Permission';
		}
		$roles=new Role();
		$excpt=new Exceptions();

		//role check
		if(array_key_exists($this->level, $roles->role->role)){
			foreach ($roles->role->role as $key => $value) {
				if($key==$this->level){
					$this->data=$value;
				}
			}
		}else{
			$excpt->notAllowed($msg['notAllowed']);
			$this->layout='error';
		}

		//modules check
		if(array_key_exists($app->controller->module->id, $this->data->module)){
			$this->modules=$app->controller->module->id;
			foreach ($this->data->module as $key => $value) {
				if($key==$this->modules){
					$this->controllers=$value;
				}
			}
		}else{
			$excpt->notAllowed($msg['notAllowed']);
		}

		//controllers check
		if(array_key_exists($app->controller->id, $this->controllers->controller)){
			$this->controller=$app->controller->id;
			foreach ($this->controllers->controller as $key => $value) {
				if($key==$this->controller){
					$this->actions=$value;
				}
			}
		}else{
			$excpt->notAllowed($msg['notAllowed']);
		}

		//action check
		if(!in_array($app->id, $this->actions)){
			$excpt->notAllowed($msg['notAllowed']);
		}

		return true;
	}

	public function getMenus(){
		$roles=new Role();
		$menu=$roles->role->menu;
		$menu=(array)$menu;
		$menu=$menu[$this->user->level];
		return $menu;
	}

}