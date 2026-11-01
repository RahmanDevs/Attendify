<?php

namespace App\Controllers;

use App\Models\LeaveRequestModel;

class AdminLeaveController extends BaseController
{
    protected LeaveRequestModel $leaveModel;

    public function __construct()
    {
        $this->leaveModel = new LeaveRequestModel();
    }

    /**
     * List all leave requests
     */
    public function index()
    {
        $statusFilter = $this->request->getGet('status');
        $leaves = $this->leaveModel->getAllWithDetails($statusFilter);

        $data = [
            'title'        => 'Pusat Persetujuan Cuti & Izin | Attendify',
            'leaves'       => $leaves,
            'statusFilter' => $statusFilter,
        ];

        return view('admin/leaves/index', $data);
    }

    /**
     * Action: Approve / Reject
     */
    public function action($id = null)
    {
        $id = (int)$id;
        $leave = $this->leaveModel->find($id);

        if (!$leave) {
            return redirect()->to('/admin/leaves')->with('error', 'Permohonan tidak ditemukan.');
        }

        $status = $this->request->getPost('status'); // approved or rejected
        $notes  = $this->request->getPost('admin_notes');
        $adminId = (int)session()->get('user_id');

        if (!in_array($status, ['approved', 'rejected'], true)) {
            return redirect()->to('/admin/leaves')->with('error', 'Status tidak valid.');
        }

        $this->leaveModel->update($id, [
            'status'      => $status,
            'approved_by' => $adminId,
            'admin_notes' => $notes,
        ]);

        $message = ($status === 'approved')
            ? 'Permohonan izin berhasil DISETUJUI.'
            : 'Permohonan izin telah DITOLAK.';

        return redirect()->to('/admin/leaves')->with('success', $message);
    }
}
