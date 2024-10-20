<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Reports\ReportRepositoryInterface;

class ReportController extends Controller
{
    private $reports;

    public function __construct(ReportRepositoryInterface $reports)
    {
        $this->reports = $reports;
    }

    public function borrowedReport() {
        return $this->reports->borrowedReport();
    }

    public function popularReport() {
        return $this->reports->popularReport();
    }
}
