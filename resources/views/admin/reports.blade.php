<h1>Reporting & Analytics</h1>

<table border="1">

<tr>
<th>Report Type</th>
<th>Value</th>
</tr>

<tr>
<td>Total Requests</td>
<td>{{ $totalRequests }}</td>
</tr>

<tr>
<td>Approved Requests</td>
<td>{{ $approvedRequests }}</td>
</tr>

<tr>
<td>Rejected Requests</td>
<td>{{ $rejectedRequests }}</td>
</tr>

<tr>
<td>Pending Requests</td>
<td>{{ $pendingRequests }}</td>
</tr>


</table>  


<h2>Requests Per Office</h2>

<table border="1">
<tr>
<th>Office</th>
<th>Number of Requests</th>
</tr>

@foreach($requestsPerOffice as $office)
<tr>
<td>{{ $office->name }}</td>
<td>{{ $office->requests_count }}</td>
</tr>
@endforeach

</table>


<h2>Revenue Per Office</h2>

<table border="1">
<tr>
<th>Office</th>
<th>Total Revenue</th>
</tr>

@foreach($revenuePerOffice as $row)
<tr>
<td>{{ $row['office_name'] }}</td>
<td>{{ $row['revenue'] }}</td>
</tr>
@endforeach

</table>