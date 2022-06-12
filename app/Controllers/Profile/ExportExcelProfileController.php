<?php

namespace App\Controllers\Profile;

use App\Controllers\BaseController;
use App\Models\ProfileModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportExcelProfileController extends BaseController
{
    protected $profileModel;

    public function __construct()
    {
        $this->profileModel = new ProfileModel();
    }

    public function index()
    {
        $profiles = $this->profileModel->getProfiles();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Full Name')
            ->setCellValue('B1', 'Summary')
            ->setCellValue('C1', 'Contact')
            ->setCellValue('D1', 'Position')
            ->setCellValue('E1', 'Location')
            ->setCellValue('F1', 'Skills')
            ->setCellValue('G1', 'Work Experiece')
            ->setCellValue('H1', 'Portofolio')
            ->setCellValue('I1', 'Education');

        $column = 2;
        // tulis data mobil ke cell
        foreach ($profiles as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['full_name'])
                ->setCellValue('B' . $column, $data['summary'])
                ->setCellValue('C' . $column, $data['contact'])
                ->setCellValue('D' . $column, $data['position'])
                ->setCellValue('E' . $column, $data['location'])
                ->setCellValue('F' . $column, $data['skills'])
                ->setCellValue('G' . $column, $data['work_experiece'])
                ->setCellValue('H' . $column, $data['portofolio'])
                ->setCellValue('I' . $column, $data['education']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Profile Developer';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
