<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DepartmentModel;
use App\Models\ShiftModel;
use App\Models\FaceBiometricModel;

class AdminEmployeeController extends BaseController
{
    protected UserModel $userModel;
    protected DepartmentModel $departmentModel;
    protected ShiftModel $shiftModel;
    protected FaceBiometricModel $biometricModel;

    public function __construct()
    {
        $this->userModel       = new UserModel();
        $this->departmentModel = new DepartmentModel();
        $this->shiftModel      = new ShiftModel();
        $this->biometricModel  = new FaceBiometricModel();
    }

    /**
     * List Employees
     */
    public function index()
    {
        $employees = $this->userModel
            ->select('users.*, departments.name as department_name, shifts.name as shift_name')
            ->join('departments', 'departments.id = users.department_id', 'left')
            ->join('shifts', 'shifts.id = users.shift_id', 'left')
            ->orderBy('users.id', 'DESC')
            ->findAll();

        $data = [
            'title'       => 'Manajemen Karyawan | Attendify',
            'employees'   => $employees,
            'departments' => $this->departmentModel->findAll(),
            'shifts'      => $this->shiftModel->findAll(),
        ];

        return view('admin/employees/index', $data);
    }

    /**
     * Store New Employee
     */
    public function store()
    {
        $rules = [
            'nik'           => 'required|min_length[3]|is_unique[users.nik]',
            'name'          => 'required|min_length[3]|max_length[100]',
            'email'         => 'required|valid_email|is_unique[users.email]',
            'password'      => 'required|min_length[8]',
            'role'          => 'required|in_list[admin,employee]',
            'department_id' => 'permit_empty|integer',
            'shift_id'      => 'permit_empty|integer',
            'phone'         => 'permit_empty|min_length[8]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->save([
            'nik'           => $this->request->getPost('nik'),
            'name'          => $this->request->getPost('name'),
            'email'         => $this->request->getPost('email'),
            'password'      => $this->request->getPost('password'),
            'role'          => $this->request->getPost('role'),
            'department_id' => $this->request->getPost('department_id') ?: null,
            'shift_id'      => $this->request->getPost('shift_id') ?: null,
            'phone'         => $this->request->getPost('phone'),
            'is_active'     => 1,
        ]);

        return redirect()->to('/admin/employees')->with('success', 'Data karyawan baru berhasil ditambahkan!');
    }

    /**
     * Update Employee
     */
    public function update($id = null)
    {
        $id = (int)$id;
        $employee = $this->userModel->find($id);
        if (!$employee) {
            return redirect()->to('/admin/employees')->with('error', 'Karyawan tidak ditemukan.');
        }

        $rules = [
            'name'          => 'required|min_length[3]|max_length[100]',
            'role'          => 'required|in_list[admin,employee]',
            'department_id' => 'permit_empty|integer',
            'shift_id'      => 'permit_empty|integer',
            'phone'         => 'permit_empty|min_length[8]',
        ];

        $newPassword = $this->request->getPost('password');
        if (!empty($newPassword)) {
            $rules['password'] = 'min_length[8]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'name'          => $this->request->getPost('name'),
            'role'          => $this->request->getPost('role'),
            'department_id' => $this->request->getPost('department_id') ?: null,
            'shift_id'      => $this->request->getPost('shift_id') ?: null,
            'phone'         => $this->request->getPost('phone'),
            'is_active'     => $this->request->getPost('is_active') !== null ? (int)$this->request->getPost('is_active') : 1,
        ];

        if (!empty($newPassword)) {
            $updateData['password'] = $newPassword;
        }

        $this->userModel->update($id, $updateData);

        return redirect()->to('/admin/employees')->with('success', 'Data karyawan berhasil diperbarui!');
    }

    /**
     * Reset Face Biometrics
     */
    public function resetBiometrics($id = null)
    {
        $id = (int)$id;
        $this->biometricModel->where('user_id', $id)->delete();
        $this->userModel->update($id, ['avatar' => null]);

        return redirect()->to('/admin/employees')->with('success', 'Data biometrik wajah karyawan berhasil direset. Karyawan dapat mendaftarkan ulang wajahnya.');
    }

    /**
     * Delete Employee
     */
    public function delete($id = null)
    {
        $id = (int)$id;
        if ($id === (int)session()->get('user_id')) {
            return redirect()->to('/admin/employees')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri saat sedang login!');
        }

        $this->biometricModel->where('user_id', $id)->delete();
        $this->userModel->delete($id);

        return redirect()->to('/admin/employees')->with('success', 'Data karyawan berhasil dihapus.');
    }
}
