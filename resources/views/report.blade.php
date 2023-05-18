<!-- report.blade.php -->

<!-- Add necessary CSS and JavaScript libraries -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<!-- Create a form for filtering -->
<form action="{{ route('report.filter') }}" method="GET">
    <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" id="start_date">

    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" id="end_date">

    <label for="user_id">User ID:</label>
    <input type="text" name="user_id" id="user_id">

    <button type="submit">Filter</button>
</form>

<!-- Display the report table -->
<table id="report-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Amount</th>
            <th>Buyer</th>
            <th>Receipt ID</th>
            <th>Items</th>
            <th>Buyer Email</th>
            <th>Note</th>
            <th>City</th>
            <th>Phone</th>
            <th>Entry At</th>
            <th>Entry By</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($submissions as $submission)
            <tr>
                <td>{{ $submission->id }}</td>
                <td>{{ $submission->amount }}</td>
                <td>{{ $submission->buyer }}</td>
                <td>{{ $submission->receipt_id }}</td>
                <td>{{ $submission->items }}</td>
                <td>{{ $submission->buyer_email }}</td>
                <td>{{ $submission->note }}</td>
                <td>{{ $submission->city }}</td>
                <td>{{ $submission->phone }}</td>
                <td>{{ $submission->entry_at }}</td>
                <td>{{ $submission->entry_by }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {
        // Initialize the DataTable
        $('#report-table').DataTable();

        // Add date range and user ID filters to the DataTable
        $('#report-table').DataTable().columns().every(function() {
            var column = this;
            $('input', this.footer()).on('keyup change', function() {
                if (column.search() !== this.value) {
                    column.search(this.value).draw();
                }
            });
        });
    });
</script>
