@extends('userpanel')
@section('userpanel')
<div class="container">
  <h2>Instruction page: How to setup this project and check redis data</h2><br>
  <div class="col-md-6">
    <h4>Clear cache from the project</h4><br>
    <h4>Down redis from server then install your local machine</h4><br>
    <h4>Download postgresql from server latest version thne install your machine</h4><br>
    <h4>fix the database connection then run "php artisan migrate"</h4><br>
    <h4>Then to customer view page <a href="{{ URL::to('view-customer-data') }}">http://localhost/redistest/view-customer-data</a> Where you can see all data. also you can filter by year and month. Filter data saved to redis cache then retrive from redis cache </h4><br>
    <h4>Download project then fix the connection then see the all customer data </h4>

  </div>
  <div class="col-md-6">
    <h4>Here some database connection code</h4><br>
    <p>
      <pre>
        'pgsql' => [
            'driver' => 'pgsql',
            'host' => 'localhost',
            'port' => '5432',
            'database' => 'redistest',
            'username' => 'postgres',
            'password' => 'jojo12',
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],
      </pre>
    </p>
    <h4>Redis connection information .env</h4>
    <p>
      <pre>
        REDIS_HOST=127.0.0.1
        REDIS_PASSWORD=null
        REDIS_PORT=6379
        REDIS_CLIENT=predis
    </pre>
  </p>
  </div>
  
  
</div>

@stop