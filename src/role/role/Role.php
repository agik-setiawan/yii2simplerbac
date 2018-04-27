<?php
namespace app\config\role;
/**
* 
*/
class Role
{
	public $role;
	public $dir;

	public function __construct()
	{
		$this->dir=__DIR__;
		$this->role=file_get_contents($this->dir.'/data/role.json');
		$this->role=json_decode($this->role);
	}
}