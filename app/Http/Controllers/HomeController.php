<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Models\Customdata;
use App\Models\Customer;
use DB;
use Validator;
use Illuminate\Validation;
use Redirect;
use Illuminate\Support\Facades\File;
use Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\SerializesModels;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
    //view redis data 
    public function view_redis_data(){
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $value = '';
        if (Cache::has('cus')) {
            //$data['prove'] = 'Cache';
            $all = Cache::get('cus');
            //dd($value);
            $myObj = collect($all);
            $data['customers'] = $this->paginate($myObj);

            return view('home/all',$data);

        }else{
            $data['prove'] = 'without cache';
            $value = Cache::remember('cus', 60, function () {
                return DB::table('customers')->where('status',0)->whereYear('date_of_birth','=',1990)->get();
            });
            echo "cached successfully";
        }
        
        //$data['customers'] = $value;
        //return view('home/all',$data);
    }
    // public function paginate($items,$perPage)
    // {
    //     $pageStart = Request::get('page', 1);
    //     // Start displaying items from this number;
    //     $offSet = ($pageStart * $perPage) - $perPage; 

    //     // Get only the items you need using array_slice
    //     $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

    //     return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    // }

    // public function paginate($perPage = 20)
    // {
    //     $page = request()->get('page', 1);
    //     $path = request()->url();

    //     return new LengthAwarePaginator(
    //         $this->forPage($page, $perPage),
    //         $this->count(),
    //         $perPage,
    //         $page,
    //         compact('path')
    //     );
    // }

    public function paginate($items, $perPage = 20, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
        'path' => Paginator::resolveCurrentPath()
    ]);
    }
    //cached redis data
    public function cached_redis_data(){
        // $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        // $value = Cache::remember('cus:{$currentPage}', 60, function () {
        //     return DB::table('customers')->where('status',0)->whereYear('date_of_birth','=',1990)->paginate(20);
        // });
        // echo "Successfully cached data";

        // $val = Customer::where('status',0)->orderBy('id','desc')->take(5);
        // Cache::put('cus', $val, $seconds = 60);
        // echo "Successfully cached data";


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        return view('Home/index');
    }
}
