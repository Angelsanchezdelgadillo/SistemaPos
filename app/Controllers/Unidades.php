<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UnidadesModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class Unidades extends BaseController
{
    protected $unidades;
    protected $reglas;


    public function __construct()
    {
        $this->unidades = new UnidadesModel();
        helper(['form']);

        $this->reglas = [
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
            'nombre_corto' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]

        ]; 
    }
    public function index($activo = 1)
    {
        $unidades = $this->unidades->where('activo', $activo)->findAll();

        $data = ['titulo' => 'Unidades', 'datos' => $unidades];
        echo view('header');
        echo view('unidades/unidades', $data);
        echo view('footer');
    }
    public function nuevo()
    {
        $data = ['titulo' => 'Agregar Unidades'];
        echo view('header');
        echo view('unidades/nuevo', $data);
        echo view('footer');
    }
    public function insertar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $this->unidades->save(['nombre' => $this->request->getPost('nombre'), 'nombre_corto' =>
            $this->request->getPost('nombre_corto')]);
           
            return redirect()->to(base_url() . '/unidades');
        } else {
            $data = ['titulo' => 'Agregar unidad', 'validation' => $this->validator];
            echo view('header');
            echo view('unidades/nuevo', $data);
            echo view('footer');
        }
    }
    public function editar($id ,$valid=null)
    {

        $unidad = $this->unidades->where('id', $id)->first();

        if($valid != null){
            $data = ['titulo' => 'Editar Unidad', 'datos' => $unidad , 'validation' =>$valid];
        }else{
            $data = ['titulo' => 'Editar Unidad', 'datos' => $unidad];
        }
        
        echo view('header');
        echo view('unidades/editar', $data);
        echo view('footer');
    }
    public function actualizar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
        $this->unidades->update($this->request->getPost('id'), ['nombre' => $this->request->getPost('nombre'), 'nombre_corto' => $this->request->getPost('nombre_corto')]);
        return redirect()->to(base_url() . '/unidades');
        }else{
            return $this->editar($this->request->getPost('id'),$this->validator);
        }
    }
    public function eliminar($id)
    {
        $this->unidades->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . '/unidades');
    }
    public function eliminados($activo = 0)
    {
        $unidades = $this->unidades->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Unidades Eliminadas', 'datos' => $unidades];
        echo view('header');
        echo view('unidades/eliminados', $data);
        echo view('footer');
    }
    public function reingresar($id)
    {
        $this->unidades->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . '/unidades');
    }

    function mostrarUnidades($activo=1)
    {
        $unidades = $this->unidades->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Unidades en el Sistema', 'datos' => $unidades];
        echo view('header');
        echo view('unidades/ver_unidades',$data);
        echo view('footer');
    }
    public function mostrarExel()
    {
        $phpExel = new Spreadsheet();
        $phpExel->getProperties()->setCreator("Angel")->setTitle('Reporte Pos');
        $hoja = $phpExel->getActiveSheet();
        $hoja->mergeCells("A3:D3");
        $hoja->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $hoja->getStyle('A3')->getFont()->setSize(14);
        $hoja->getStyle('A3')->getFont()->setName('Arial');
        $hoja->setCellValue("A3",'Reporte de Unidades');
        $hoja->setCellValue("A5",'Numero');
        $hoja->getColumnDimension('A')->setWidth(20);
        $hoja->setCellValue("B5",'Nombre');
        $hoja->getColumnDimension('B')->setWidth(40);
        $hoja->setCellValue("C5",'Nombre Corto');
        $hoja->getColumnDimension('C')->setWidth(20);
        $hoja->setCellValue("D5",'Fecha de alta');
        $hoja->getColumnDimension('D')->setWidth(20);
        $datosUnidades = $this->unidades->mostrarUnidades();
        $fila =6;
        foreach ($datosUnidades as $unidades) {
             $hoja->setCellValue("A".$fila,$unidades['id']);
             $hoja->setCellValue("B".$fila,$unidades['nombre']);
             $hoja->setCellValue("C".$fila,$unidades['nombre_corto']);
             $hoja->setCellValue("D".$fila,$unidades['fecha_alta']);
             $fila++;
           
        }
        $writer = new Xls($phpExel);
        $writer->save('Unidades.xls');
    }
}
