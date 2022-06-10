<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        $this->mahasiswaModel->update($id, [
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

    public function export_pdf()
    {
        $id = $this->request->getPost('id');
        $mahasiswa = $this->mahasiswaModel->getProfile($id);

        // Get Base64 of the image
        $path = '../public/uploads/images/' . $mahasiswa['image'];
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $photoMahasiswa = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view("super_admin/mahasiswa/pdf_view", ['mahasiswa' => $mahasiswa, 'photoMahasiswa' => $photoMahasiswa]));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream("data_cv", array("Attachment" => false));
    }

    public function export_excel()
    {
        $profiles = $this->mahasiswaModel->getMahasiswa();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama')
            ->setCellValue('B1', 'Alamat')
            ->setCellValue('C1', 'Pendidikan')
            ->setCellValue('D1', 'Keahlian')
            ->setCellValue('E1', 'Telephone')
            ->setCellValue('F1', 'Pengalaman')
            ->setCellValue('G1', 'Image')
            ->setCellValue('H1', 'Email');

        $column = 2;
        // tulis data mobil ke cell
        foreach ($profiles as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['nama'])
                ->setCellValue('B' . $column, $data['alamat'])
                ->setCellValue('C' . $column, $data['pendidikan'])
                ->setCellValue('D' . $column, $data['keahlian'])
                ->setCellValue('E' . $column, $data['telephone'])
                ->setCellValue('F' . $column, $data['pengalaman'])
                ->setCellValue('G' . $column, $data['image'])
                ->setCellValue('H' . $column, $data['email']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Mahasiswa';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
