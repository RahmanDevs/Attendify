<?php

namespace App\Controllers;

use App\Models\OfficeLocationModel;

class AdminGeofenceController extends BaseController
{
    protected OfficeLocationModel $officeModel;

    public function __construct()
    {
        $this->officeModel = new OfficeLocationModel();
    }

    /**
     * View Geofence Settings
     */
    public function index()
    {
        $office = $this->officeModel->first() ?? [
            'id'            => null,
            'name'          => 'Kantor Pusat Attendify Jakarta',
            'address'       => 'Jl. Jend. Sudirman Kav. 52-53, Jakarta Selatan',
            'latitude'      => -6.22501400,
            'longitude'     => 106.80965600,
            'radius_meters' => 150,
            'is_active'     => 1,
        ];

        $data = [
            'title'  => 'Pengaturan Geofencing GPS | Attendify',
            'office' => $office,
        ];

        return view('admin/geofence/index', $data);
    }

    /**
     * Update Geofence Settings
     */
    public function update()
    {
        $rules = [
            'name'          => 'required|min_length[3]|max_length[150]',
            'address'       => 'required',
            'latitude'      => 'required|decimal',
            'longitude'     => 'required|decimal',
            'radius_meters' => 'required|integer|greater_than[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $id = $this->request->getPost('id');
        $data = [
            'name'          => $this->request->getPost('name'),
            'address'       => $this->request->getPost('address'),
            'latitude'      => (float)$this->request->getPost('latitude'),
            'longitude'     => (float)$this->request->getPost('longitude'),
            'radius_meters' => (int)$this->request->getPost('radius_meters'),
            'is_active'     => 1,
        ];

        if (!empty($id)) {
            $this->officeModel->update((int)$id, $data);
        } else {
            $this->officeModel->insert($data);
        }

        return redirect()->to('/admin/settings/geofence')->with('success', 'Konfigurasi Geofencing lokasi kantor berhasil disimpan!');
    }
}
