<div class="container">
  <h2>Test redis data : {{ (!empty($prove))?$prove:'' }}</h2>            
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Phone</th>
        <th>Country</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse($customers as $customer)
      <tr>
        <td>{{ (!empty($customer->cus_name))?$customer->cus_name:'' }}</td>
        <td>{{ (!empty($customer->cus_phone))?$customer->cus_phone:'' }}</td>
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
      {{ $customers->withQueryString()->links() }}
  </ul>
  {{ "Showing ".$customers->firstItem()." to ".$customers->lastItem()." of ".$customers->total() }}
  </div>
</div>