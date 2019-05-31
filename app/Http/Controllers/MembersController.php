<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\MembersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\HeadingRowImport;

class MembersController extends Controller
{
    //
    public function import()
    {
//        $headings = (new HeadingRowImport)->toArray('624.xlsx');

//        $array = (new MembersImport)->toArray('624.xlsx');
//        dd ($array);


        Excel::import(new MembersImport, "624.xlsx");
        return redirect('/')->with('success', 'All good!');

    }
}
