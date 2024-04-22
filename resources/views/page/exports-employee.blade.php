<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Purchase Date</th>
            <th scope="col">Total Purchase</th>
            <th scope="col">Created By</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $value)
            <tr>
                <td scope="row">{{ $key + 1 }}</td>
                <td>{{ $value->customers->name }}</td>
                <td>{{ date('d F Y', strtotime($value->created_at)) }}</td>
                <td>{{ $value->total_purchase }}</td>
                <td>{{ $value->users->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
