<h1>Payment</h1>

<form method="POST" action="{{ route('citizen.payment') }}">
    @csrf
    <input type="hidden" name="request_id" value="{{ $serviceRequest->id }}">

    <label>Amount</label>
    <input type="text" name="amount">

    <br><br>
    <label>Payment Method</label>
    <select name="method">
        <option value="card">Card</option>
        <option value="crypto">Crypto</option>
    </select>

    <br><br>
    <button type="submit">Pay</button>
</form>