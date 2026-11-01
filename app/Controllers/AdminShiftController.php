<?php

namespace App\Controllers;

use App\Models\ShiftModel;

class AdminShiftController extends BaseController
{
    protected ShiftModel $shiftModel;

    public function __construct()
    {
        $this->shiftModel = new ShiftModel();
    }

    /**
     * List Shifts
     */
    public function index()
    {
        $shifts = $this->shiftModel->findAll();

        $data = [
            'title'  => 'Manajemen Shift & Jam Kerja | Attendify',
            'shifts' => $shifts,
        ];

        return view('admin/shifts/index', $data);
    }

    /**
     * Store or Update Shift
     */
    public function save()
    {
        $rules = [
            'name'                   => 'required|min_length[3]|max_length[100]',
            'start_time'             => 'required',
            'end_time'               => 'required',
            'late_tolerance_minutes' => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $id = $this->request->getPost('id');
        $data = [
            'name'                   => $this->request->getPost('name'),
            'start_time'             => $this->request->getPost('start_time'),
            'end_time'               => $this->request->getPost('end_time'),
            'late_tolerance_minutes' => (int)$this->request->getPost('late_tolerance_minutes'),
        ];

        if (!empty($id)) {
            $this->shiftModel->update((int)$id, $data);
            $msg = 'Data shift berhasil diperbarui!';
        } else {
            $this->shiftModel->insert($data);
            $msg = 'Shift baru berhasil ditambahkan!';
        }

        return redirect()->to('/admin/shifts')->with('success', $msg);
    }

    /**
     * Delete Shift
     */
    public function delete($id = null)
    {
        $id = (int)$id;
        $this->shiftModel->delete($id);

        return redirect()->to('/admin/shifts')->with('success', 'Data shift berhasil dihapus.');
    }
}
