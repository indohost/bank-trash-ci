<?php

namespace App\Controllers\Profile;

use App\Controllers\BaseController;
use App\Models\ProfileModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class ExportPDFProfileController extends BaseController
{
    protected $profileModel;

    public function __construct()
    {
        $this->profileModel = new ProfileModel();
    }

    public function index()
    {
        $id = $this->request->getPost('id');
        $profile = $this->profileModel->getProfile($id);

        // Get Base64 of the image
        $path = 'uploads/profiles/' . $profile['photo'];
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $photoProfile = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view("super_admin/profiles/pdf_view", ['profile' => $profile, 'photoProfile' => $photoProfile]));
        $dompdf->setPaper('A3', 'potrait');
        $dompdf->render();
        $dompdf->stream("", array("Attachment" => false));
    }
}
