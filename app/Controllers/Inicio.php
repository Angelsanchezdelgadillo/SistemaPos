<?php

namespace App\Controllers;
use App\Models\ProductosModel;
use App\Models\VentasModel;
use CodeIgniter\CLI\Console;

class Inicio extends BaseController
{
	protected $productosModel;
	protected $ventasModel;

	public function __construct(){
   $this->productosModel = new ProductosModel();
   $this->ventasModel = new VentasModel();
	}
	public function index()
	{
		$total = $this->productosModel->totalProductos();
		$totalVentas = $this->ventasModel->totalDia(date('Y-m-d'));
		$minimos = $this->productosModel->productosMinimo();
		
		$datos = ['total' =>$total ,'totalVentas' => $totalVentas,'minimos' => $minimos];
		echo view('header');
		echo view('dashboard',$datos);
		echo view('footer');
	}
	public function a(){
		$p = $this->productosModel->where('existencia <=10')->findAll();
		$datos = ['p'=>$p];
		return $datos;
	}
}
 