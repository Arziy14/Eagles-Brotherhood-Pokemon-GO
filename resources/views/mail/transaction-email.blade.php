<h1>Thanks for your order!</h1>
<br>
<h2>Here's a summary of your order:</h2>
<br>
<h3>Order ID: {{ $data['id'] }}</h3><br>
<p>
    <b>{{ $data['name'] }}</b><br>
    <p>Quantity: {{ $data['quantity'] }}<br>
    <p>Price: {{ $data['price'] }}
    <p>Total: ₱ {{ $data['price'] * $data['quantity']}}</p>
</p>