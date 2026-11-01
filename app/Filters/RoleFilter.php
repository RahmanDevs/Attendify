<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    /**
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu!');
        }

        if (!empty($arguments)) {
            $userRole = session()->get('role') ?? 'employee';
            if (!in_array($userRole, $arguments, true)) {
                if ($userRole === 'admin') {
                    return redirect()->to('/admin/dashboard')->with('error', 'Akses dialihkan ke dashboard Administrator.');
                }
                return redirect()->to('/employee/dashboard')->with('error', 'Akses ditolak! Anda tidak memiliki wewenang untuk halaman ini.');
            }
        }
    }

    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
