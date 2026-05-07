<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Exports\DonorsExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportController extends Controller
{
    /**
     * تصدير قائمة المتبرعين إلى Excel
     */
    public function exportDonors(): BinaryFileResponse
    {
        // اسم الملف مع التاريخ
        $fileName = 'donors_report_' . now()->format('Y_m_d_H_i') . '.xlsx';
        
        return Excel::download(new DonorsExport, $fileName);
    }
}