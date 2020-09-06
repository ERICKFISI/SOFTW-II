<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		echo view('header');
		echo view('login');
	}
	public function hola(){
		echo view('header');
		echo view('menu');
		echo view('registrar_usuario');
		echo view('footer');
	}
	//--------------------------------------------------------------------

}
