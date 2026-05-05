<!DOCTYPE html>
<html>
<head>

<style>
body{
    font-family: Arial;
    background: #f4f4f4;
    margin: 0;
}

.container{
    width: 85%;
    margin: 40px auto;
    background: white;
    padding: 20px;
    border-radius: 5px;
}

table{
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    margin-bottom: 25px;
}

th, td{
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

h1, h2{
    margin-top: 20px;
}
</style>

</head>

<body>

<div class="container">

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

</div>

</body>
</html>