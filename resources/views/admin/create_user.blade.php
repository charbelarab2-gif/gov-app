<h1>Create User</h1>

<form method="POST" action="/admin/users">
@csrf

<input type="text" name="name" placeholder="Name"><br><br>

<input type="email" name="email" placeholder="Email"><br><br>

<input type="password" name="password" placeholder="Password"><br><br>

<select name="role">
    <option value="citizen">Citizen</option>
    <option value="municipality">Municipality</option>
</select>
<br><br>

<button type="submit">Create User</button>

</form>