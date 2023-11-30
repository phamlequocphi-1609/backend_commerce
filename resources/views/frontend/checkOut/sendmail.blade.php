<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <div>
        <h2>User Information</h2>
        <div>
            <h3>Name: {{htmlspecialchars($data['body']['username'])}}</h3>
            <h3>Email: {{htmlspecialchars($data['body']['email'])}}</h3>
            <h3>Phone: {{htmlspecialchars($data['body']['phone'])}}</h3>
            <h3>Address: {{htmlspecialchars($data['body']['address'])}}</h3>
        </div>
        <h2>Cart Information</h2>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="description">Name</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['body']['product'] as $value)
                    <tr>
                        <td class="cart_description">
                            <h4><a href="">{{htmlspecialchars($value['name'])}}</a></h4>
                            <p>Web ID: {{htmlspecialchars($value['id'])}}</p>
                        </td>
                        <td class="cart_price">
                            <p>$ {{htmlspecialchars($value['price'])}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <input class="cart_quantity_input" type="text" name="quantity" value="{{htmlspecialchars($value['qty'])}}" autocomplete="off" size="2">                 
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">$ {{htmlspecialchars($value['price']) * htmlspecialchars($value['qty'])}}</p>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>