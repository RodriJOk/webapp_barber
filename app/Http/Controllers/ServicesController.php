<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Services;

class ServicesController extends Controller
{
    public function my_services()
    {
        $branch_id = session()->get('branch_id');
        $myServicesByIdBranch = Services::getServicesByBranch($branch_id);
        return view('services.index', ['myServicesByIdBranch' => $myServicesByIdBranch]);
    }
}