<?php

namespace App\Interfaces\Reports;


use Illuminate\Database\Eloquent\Model;

/**
* Interface ReportRepositoryInterface
* @package App\Repositories
*/
interface ReportRepositoryInterface
{
    public function borrowedReport();
    public function popularReport();
}
