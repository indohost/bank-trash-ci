<?php

namespace App\Controllers\Profile;

use App\Controllers\BaseController;
use App\Models\ProfileModel;

class ProfileController extends BaseController
{
    protected $profileModel;

    public function __construct()
    {
        $this->profileModel = new ProfileModel();
    }

    public function index()
    {
        $profiles = $this->profileModel->getProfiles();

        $data = [
            'title' => 'Profile Data',
            'profiles' => $profiles,
        ];

        return view("super_admin/profiles/index", $data);
    }

    public function create()
    {
        return view("super_admin/profiles/create");
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

        $this->profileModel->insert([
            'contact' => $this->request->getPost('contact'),
            'full_name' => $this->request->getPost('full_name'),
            'position' => $this->request->getPost('position'),
            'location' => $this->request->getPost('location'),
            'photo' => $fileName,
            'summary' => $this->request->getPost('summary'),
            'skills' => $this->request->getPost('skills'),
            'work_experiece' => $this->request->getPost('work_experiece'),
            'portofolio' => $this->request->getPost('portofolio'),
            'education' => $this->request->getPost('education'),
        ]);

        $dataImage->move('uploads/profiles/', $fileName);

        return redirect('super_admin/profiles')->with('success', 'Data Added Successfully');
    }

    public function edit($id)
    {
        $profiles = $this->profileModel->getProfile($id);
        $data = [
            'title' => 'Profile Data',
            'profiles' => $profiles,
        ];

        return view("super_admin/profiles/edit", $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id');

        $this->profileModel->update($id, [
            'contact' => $this->request->getPost('contact'),
            'full_name' => $this->request->getPost('full_name'),
            'position' => $this->request->getPost('position'),
            'location' => $this->request->getPost('location'),
            'summary' => $this->request->getPost('summary'),
            'skills' => $this->request->getPost('skills'),
            'work_experiece' => $this->request->getPost('work_experiece'),
            'portofolio' => $this->request->getPost('portofolio'),
            'education' => $this->request->getPost('education'),
        ]);

        return redirect('super_admin/profiles')->with('success', 'Data Update Successfully');
    }

    public function delete()
    {
        $id = $this->request->getPost('id');

        $this->profileModel->delete($id);

        return redirect('super_admin/profiles')->with('success', 'Data Deleted Successfully');
    }
}
