<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;
use App\Models\Customdata;
use Response;
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

class PeopleController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //create some custom rows
        for($i=0; $i<10; $i++){
            $people = new People();
            $people->people_name = Customdata::getRandomName();
            $people->address = Customdata::getAddress();
            $people->phone = Customdata::getPhoneNumber();
            $people->save();
        } 
        echo "Data saved successfully";
    }
    // view speople data 
    public function view_people_data(){
        $getData = Redis::get('people_data');
        $getPeople = json_decode($getData);
        //dd($getPeople);
        $myObj = collect($getPeople);
        $data['peoples'] = $this->paginate($myObj);
        //dd($data['peoples']);
        return view('People/all',$data);
        //dd($data['peoples']);
    }
    //store cache data
    public function store_redis_data(){
        $people = People::all();
        $minutes_to_expire = 4;
        $key = "people_data";
        Redis::set($key, $people);
        // if(!Redis::get($key)){
            
        // }
        Redis::expire($key, ($minutes_to_expire * 60));
        echo "Data store to redis cache";
    }
    public function paginate($items, $perPage = 4, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
        'path' => Paginator::resolveCurrentPath()
    ]);
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
