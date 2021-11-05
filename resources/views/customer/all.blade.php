@extends('userpanel')
@section('userpanel')
<div class="container">
  <h2>Customer Data</h2>
  <div class="col-md-6"></div>
  <div class="col-md-6"><p style="float:right; font-size: 26px;">Create 500 custom rows just <a href="{{ URL::to('create-data') }}">Click Here</a></p></div>
  
  <div class="col-md-12">
      @if(Session::has('success'))
          <div class="alert alert-success">
              <strong> {{ Session::get('success') }}</strong>
          </div>
      @endif
      @if(Session::has('error'))
          <div class="alert alert-danger">
              <strong> {{ Session::get('error') }}</strong>
          </div>
      @endif

      @if (count($errors) > 0)
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
  </div>
  <div class="col-md-12">
    <form method="POST" class="form-inline" action="{{ URL::to('post-year-month') }}">
      @csrf
    <div class="form-group">
      <label for="year">Year:</label>
      <input type="text" value="{{ (!empty(Session::get('year')))?Session::get('year'):'' }}" class="form-control" id="year" placeholder="Enter Year" name="year">
    </div>
    <div class="form-group">
      <label for="month">Month:</label>
      <input value="{{ (!empty(Session::get('month')))?Session::get('month'):'' }}" type="text" class="form-control" id="month" placeholder="Enter month" name="month">
    </div>
    <button type="submit" class="btn btn-default">Search</button>
  </form>
  </div>
  <div class="pagination col-end-12 float-right">
      {{ $customers->links() }}
  </ul>
  {{ "Showing ".$customers->firstItem()." to ".$customers->lastItem()." of ".$customers->total() }}
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Email</th>
        <th>Id</th>
        <th>Name</th>
        <th>Date of Birth</th>
        <th>Phone</th>
        <th>Ip</th>
        <th>Country</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse($customers as $customer)
      <tr>
        <td>{{ (!empty($customer->cus_email))?$customer->cus_email:'' }}</td>
        <td>{{ (!empty($customer->id))?$customer->id:'' }}</td>
        <td>{{ (!empty($customer->cus_name))?$customer->cus_name:'' }}</td>
        <td>{{ (!empty($customer->date_of_birth))?$customer->date_of_birth:'' }}</td>
        <td>{{ (!empty($customer->cus_phone))?$customer->cus_phone:'' }}</td>
        <td>{{ (!empty($customer->cus_ip_address))?$customer->cus_ip_address:'' }}</td>
        <td>{{ (!empty($customer->cus_country))?$customer->cus_country:'' }}</td>
        <td>Edit || Delete</td>
      </tr>
      @empty
      <tr>
        <td>No data found at this moment</td>
      </tr>
      @endforelse
    </tbody>
    
  </table>
  <div class="pagination">
      {{ $customers->links() }}
  </ul>
  {{ "Showing ".$customers->firstItem()." to ".$customers->lastItem()." of ".$customers->total() }}
  </div>
</div>
@stop