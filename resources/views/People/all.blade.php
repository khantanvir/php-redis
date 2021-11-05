@extends('userpanel')
@section('userpanel')
<div class="container">
  <h2>Test redis data : {{ (!empty($prove))?$prove:'' }}</h2>            
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse($peoples as $people)
      <tr>
        <td>{{ (!empty($people->people_name))?$people->people_name:'' }}</td>
        <td>{{ (!empty($people->phone))?$people->phone:'' }}</td>
        <td>{{ (!empty($people->address))?$people->address:'' }}</td>
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
      {{ $peoples->withQueryString()->links() }}
  </ul>
  {{ "Showing ".$peoples->firstItem()." to ".$peoples->lastItem()." of ".$peoples->total() }}
  </div>
</div>
@stop