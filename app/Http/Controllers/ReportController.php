<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use App\Models\User;

class ReportController extends Controller
{
    public function generateExcelReport()
    {
        $user =  User::getUsuariosWithCurses();
        // return $user;
        $export = new ReportExport($user->toArray());
        return Excel::download($export, 'invoices.xlsx');        
    }
}
