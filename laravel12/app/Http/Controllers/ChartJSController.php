<?php
  
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
    
class ChartJSController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $users = DB::table('USERS')
            ->select([
                DB::raw("TO_CHAR(created_at, 'Month') AS month_name"),
                DB::raw("id AS id"),
                DB::raw("count(*) AS email"),
                DB::raw("created_at AS created_at"),
                DB::raw("name AS name"),
            ])
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("TO_CHAR(created_at, 'Month')"), DB::raw("email"), DB::raw("id"), DB::raw("created_at"), DB::raw("name"))
            ->get();
            
        return ($users);
    }
}
