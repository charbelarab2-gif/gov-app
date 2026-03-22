<!DOCTYPE html>
<html>
<head>
    <title>Citizen Login</title>
</head>
<body>

<h1>Citizen Login</h1>

<form method="POST" action="/citizen/login">
    @csrf

    <div>
        <label>Email</label><br>
        <input type="email" name="email" required>
    </div>

    <br>

    <div>
        <label>Password</label><br>
        <input type="password" name="password" required>
    </div>

    <br>

    <button type="submit">Login</button>

</form>

<br>

<a href="/citizen/register">Create account</a>

</body>
</html>