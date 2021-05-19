<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RolesModel;


class Roles extends BaseController
{
    protected $roles;
    protected $reglas;



    public function __construct()
    {
        $this->roles = new  RolesModel();


        helper(['form']);

        $this->reglas = [
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                ]
            ]
        ];
    }
    public function index($activo = 1)
    {
        $roles = $this->roles->where('activo', $activo)->findAll();

        $data = ['titulo' => 'roles', 'datos' => $roles];
        echo view('header');
        echo view('roles/roles', $data);
        echo view('footer');
    }
    public function nuevo()
    {

        $data = ['titulo' => 'Agregar Rol'];
        echo view('header');
        echo view('roles/nuevo', $data);
        echo view('footer');
    }
    public function insertar()
    {
        if ($this->request->getMethod() == "post" && $this->validate($this->reglas)) {
            $this->roles->save([
                'nombre' => $this->request->getPost('nombre')
            ]);

            return redirect()->to(base_url() . '/roles');
        } else {


            $data = ['titulo' => 'Agregar Rol', 'validation' => $this->validator];
            echo view('header');
            echo view('roles/nuevo', $data);
            echo view('footer');
        }
    }
    public function editar($id)
    {


        $roles = $this->roles->where('id', $id)->first();
        $data = ['titulo' => 'Editar Rol', 'roles' => $roles];

        echo view('header');
        echo view('roles/editar', $data);
        echo view('footer');
    }
    public function actualizar()
    {
        $this->roles->update($this->request->getPost('id'), [
            'nombre' => $this->request->getPost('nombre')
        ]);

        return redirect()->to(base_url() . '/roles');
    }
    public function eliminar($id)
    {
        $this->roles->update($id, ['activo' => 0]);
        return redirect()->to(base_url() . '/roles');
    }
    public function eliminados($activo = 0)
    {
        $roles = $this->roles->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Roles Eliminados', 'datos' => $roles];
        echo view('header');
        echo view('roles/eliminados', $data);
        echo view('footer');
    }
    public function reingresar($id)
    {
        $this->roles->update($id, ['activo' => 1]);
        return redirect()->to(base_url() . '/roles');
    }
}
