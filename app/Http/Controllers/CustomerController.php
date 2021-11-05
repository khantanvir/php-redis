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
use Illuminate\Support\Facades\Redis;
use Illuminate\Queue\SerializesModels;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    //function test program 
    public function testing(){
        $data = new Customdata();
        $str = $data->getRandomName();
        $email = $data->emailCreate($str);
        $birth = $data->getBirthday();
        $country = $data->getCountry();
        $ip = $data->randomIP();
        $phone = $data->getPhoneNumber();
        return "Name:".$str." Email:".$email." Birthday:".$birth." Country:".$country." IP:".$ip." Phone:".$phone;
    }
    //create custom customer data. create 500 customer rows per click
    public function create_data(){
        $data = new Customdata();
        for($i=0; $i<500; $i++){
            $customer = new Customer();
            $customer->cus_name = $data->getRandomName();
            $customer->cus_email = $data->emailCreate($customer->cus_name);
            $customer->cus_tags = $data->getTag();
            $customer->date_of_birth = $data->getBirthday();
            $customer->cus_phone = $data->getPhoneNumber();
            $customer->cus_ip_address = $data->randomIP();

            $customer->cus_country = $data->getCountry();
            $customer->create_by = 1;
            $customer->update_by = 1;
            $customer->status = 0;
            $customer->is_deleted = 0;
            $customer->save();
        }
        $this->flushAll();
        return redirect('view-customer-data');
    }
    //list of customer data
    public function view_customer_data(){
        //first check is data available in cache or not
        $values = Redis::get('cus');
        $minutes_to_expire = 1;
        $key = 'cus';
        //dd($values);
        if(isset($values)){
            //update redis key time if needed 
            //Redis::expire($key, ($minutes_to_expire * 60));
            $cusData = json_decode($values);
            $myObj = collect($cusData);
            $data['customers'] = $this->paginate($myObj);
        }else{
            //clean all session and cache data then query from database 
            $this->flushAll();
            $data['customers'] = Customer::where('status',0)->where('is_deleted',0)->paginate(20);
        }
        return view('customer/all',$data);
        // if (Cache::has('cus')){
        //     $values = Cache::get('cus');
        //     $myObj = collect($values);
        //     $data['customers'] = $this->paginate($myObj);
        // }else{
        //     //clean all session and cache data then query from database 
        //     $this->flushAll();
        //     $data['customers'] = Customer::where('status',0)->where('is_deleted',0)->paginate(20);
        // }
        
    }
    //get customer by year and month 
    public function getCus(){
        $data['result'] = Customer::whereYear('date_of_birth','=',1993)->get();
        //return Response::json($data);
        dd($data['result']);
    }
    //post year and month data
    public function post_year_month(Request $request){
        $year = $request->input('year');
        $month = $request->input('month');
        //$val = 4;
        $minutes_to_expire = 1;
        $key = 'cus';

        if(empty($year) && empty($month)){
            $this->flushAll();
            return redirect('view-customer-data');
        }
        elseif(!empty($year) && !empty($month)){
            if(is_numeric($year) && is_numeric($month)){
                Redis::command('flushdb');
                Session::put('year',$year);
                Session::put('month',$month);
                // $value = Cache::remember('cus', 60, function () {
                //     return DB::table('customers')->where('status',0)->whereMonth('date_of_birth','=',Session::get('month'))->whereYear('date_of_birth','=',Session::get('year'))->get();
                // });
                //get value from database then set to redis 
                $cus = Customer::where('status',0)->whereMonth('date_of_birth','=',Session::get('month'))->whereYear('date_of_birth','=',Session::get('year'))->get();
                Redis::set($key, $cus);
                Redis::expire($key, ($minutes_to_expire * 60));
                return redirect('view-customer-data');
            }else{
                $this->flushAll();
                Session::flash('error','Year and month must be number. Month 2 digit and year 4 digit for better serach');
                return redirect('view-customer-data');
            }
            
        }
        elseif(!empty($year) && empty($month)){
            if(is_numeric($year)){
                Redis::command('flushdb');
                Session::put('year',$year);
                Session::forget('month');
                // $value = Cache::remember('cus', 60, function () {
                //     return DB::table('customers')->where('status',0)->whereYear('date_of_birth','=',Session::get('year'))->get();
                // });
                $cus = Customer::where('status',0)->whereYear('date_of_birth','=',Session::get('year'))->get();
                Redis::set($key, $cus);
                Redis::expire($key, ($minutes_to_expire * 60));
                return redirect('view-customer-data');
            }else{
                $this->flushAll();
                Session::flash('error','Year must be number and put 4 digit for better serach');
                return redirect('view-customer-data');
            }
        }
        elseif(!empty($month) && empty($year)){
            if(is_numeric($month)){
                Redis::command('flushdb');
                Session::forget('year');
                Session::put('month',$month);
                // $value = Cache::remember('cus', 60, function () {
                //     return DB::table('customers')->where('status',0)->whereMonth('date_of_birth','=',Session::get('month'))->get();
                // });
                $cus = Customer::where('status',0)->whereMonth('date_of_birth','=',Session::get('month'))->get();
                Redis::set($key, $cus);
                Redis::expire($key, ($minutes_to_expire * 60));
                return redirect('view-customer-data');
            }else{
                $this->flushAll();
                Session::flash('error','Month must be number and put 2 digit for better serach');
                return redirect('view-customer-data');
            }
        }
        return redirect('view-customer-data');

    }
    //flush all data
    public function flushAll(){
        //Cache::flush();
        Redis::command('flushdb');
        Session::forget('year');
        Session::forget('month');
    }
    public function paginate($items, $perPage = 20, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
        'path' => Paginator::resolveCurrentPath()
    ]);
    }
    //get test redis data
    public function get_redis_test_data(){
        if (Cache::has('cus')){
            $val = Cache::get('cus');
            dd($val);
            exit();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
