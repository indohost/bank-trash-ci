<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;

class MahasiswaController extends BaseController
{
    protected $mahasiswaModel;



    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->db = \Config\Database::connect();
    }


    public function index()
    {
        $mahasiswa = $this->mahasiswaModel->getMahasiswa();

        $data = [
            'title' => 'CV Mahasiswa',
            'mahasiswa' => $mahasiswa,
        ];

        return view("super_admin/mahasiswa/index", $data);
    }
    public function create()
    {
        return view("super_admin/mahasiswa/create");
    }
    public function store()
    {
        if (!$this->validate([
            'image' => [
                'rules' => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]|max_size[image,5120]',
                'errors' => [
                    'uploaded' => 'There must be a file uploaded',
                    'mime_in' => 'File Extension Must Be jpg,jpeg,gif,png',
                    'max_size' => 'File Size Max 5 MB'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $dataImage = $this->request->getFile('image');
        $fileName = $dataImage->getRandomName();

        $this->mahasiswaModel->insert([
            'nama' => $this->request->getPost('nama'),
            'pendidikan' => $this->request->getPost('pendidikan'),
            'alamat' =>  $this->request->getPost('alamat'),
            'telephone' =>  $this->request->getPost('telephone'),
            'keahlian' =>  $this->request->getPost('keahlian'),
            'pengalaman' =>  $this->request->getPost('pengalaman'),
            'email' =>  $this->request->getPost('email'),
            'image' =>  $fileName,
        ]);


        $dataImage->move('uploads/images/', $fileName);

        return redirect('super_admin/mahasiswa')->with('success', 'Data CV Added Successfully');
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        if (!$this->validate([
            'image' => [
                'rules' => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]|max_size[image,5120]',
                'errors' => [
                    'uploaded' => 'There must be a file uploaded',
                    'mime_in' => 'File Extension Must Be jpg,jpeg,gif,png',
                    'max_size' => 'File Size Max 5 MB'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $dataImage = $this->request->getFile('image');
        $fileName = $dataImage->getRandomName();
        $this->MahasiswaModel->update([
            'nama' => $this->request->getPost('nama'),
            'pendidikan' => $this->request->getPost('pendidikan'),
            'alamat' =>  $this->request->getPost('alamat'),
            'telephone' =>  $this->request->getPost('telephone'),
            'keahlian' =>  $this->request->getPost('keahlian'),
            'pengalaman' =>  $this->request->getPost('pengalaman'),
            'email' =>  $this->request->getPost('email'),
            'image' =>  $fileName,
        ]);
        $dataImage->move('uploads/images/', $fileName);
        return redirect('super_admin/mahasiswa')->with('success', 'Data Update Successfully');
    }

    public function delete()
    {

        $id = $this->request->getPost('id');

        $this->mahasiswaModel->delete($id);

        return redirect('super_admin/mahasiswa')->with('success', 'Data Deleted Successfully');
    }
}
