<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<h1>Admin Dashboard</h1>

<!-- ADDED: Admin Navigation Menu -->
<hr>

<h2>Admin Menu</h2>

<ul>
<li><a href="/admin/dashboard">Dashboard</a></li>
<li><a href="/admin/offices">Manage Offices</a></li>
<li><a href="/admin/manage">Manage</a></li>
<li><a href="/admin/users">Manage Users</a></li>
<li><a href="/admin/requests">Service Requests</a></li>
<li><a href="/admin/reports">Reports</a></li>
</ul>

<hr>
<!-- END ADDED -->

<div class="row">

<div class="col-md-4">
<div class="card">
<div class="card-body">
<h3>Total Users</h3>
<p>{{ $users }}</p>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card">
<div class="card-body">
<h3>Total Offices</h3>
<p>{{ $offices }}</p>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card">
<div class="card-body">
<h3>Total Requests</h3>
<p>{{ $requests }}</p>
</div>
</div>
</div>

</div>

</div>

<div class="container mt-5">
<canvas id="requestsChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

var ctx = document.getElementById('requestsChart');

new Chart(ctx,{
type:'bar',
data:{
labels: {!! json_encode($officeNames) !!},
datasets:[{
label:'Requests',
data: {!! json_encode($officeRequestCounts) !!}
}]
}
});

</script>

</body>
</html>