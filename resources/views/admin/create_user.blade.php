<!DOCTYPE html>
<html>
<head>
<style>
body {font-family: Arial; background:#f4f4f4; margin:0;}
.container {width:70%; margin:40px auto; background:white; padding:20px; border-radius:5px;}
input, select {width:100%; padding:8px; margin:5px 0 15px;}
button {padding:10px 15px; background:#333; color:white; border:none;}
</style>
</head>
<body>

<div class="container">

<h1>Create User</h1>

<form method="POST" action="/admin/users">
@csrf

<input type="text" name="name" placeholder="Name">
<input type="email" name="email" placeholder="Email">
<input type="password" name="password" placeholder="Password">

<select name="role">
    <option value="citizen">Citizen</option>
    <option value="municipality">Municipality</option>
</select>
<br><br>

<button type="submit">Create User</button>

</form>

</div>
</body>
</html>