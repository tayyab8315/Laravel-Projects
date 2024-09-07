  <!DOCTYPE html>
  <html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Order Confirmation</title>
      <style>
          body {
              font-family: Arial, sans-serif;
              background-color: #f8f9fa;
              margin: 0;
              padding: 0;
          }
          .container {
              max-width: 600px;
              margin: 0 auto;
              padding: 20px;
              background-color: #ffffff;
              border-radius: 8px;
              box-shadow: 0 0 10px rgba(0,0,0,0.1);
          }
          .header {
              background-color:  #81c408;
              color: #ffffff;
              padding: 20px;
              border-radius: 8px 8px 0 0;
              text-align: center;
          }
          .order-details {
              padding: 20px;
          }
          .order-details h2 {
              margin-top: 0;
          }
          .product-list {
              width: 100%;
              margin-bottom: 20px;
          }
          .product-list th, .product-list td {
              padding: 15px;
              text-align: left;
          }
          .product-list th {
              background-color:  #81c408;
              color: #ffffff;
          }
          .product-list td {
              border-bottom: 1px solid #dddddd;
          }
          .footer {
              background-color: #f1f1f1;
              padding: 20px;
              text-align: center;
              border-radius: 0 0 8px 8px;
          }
          .footer p {
              margin: 0;
              color: #666666;
          }
          .confirm_btn{
            margin: 10px 0px;
            width: 100%;
            background-color: #81c408;
            display: inline-block;
            padding: 10px 0px;
            text-align: center;

            font-size: 20px;
            cursor: pointer;
            text-decoration: none;
            color:white;
        
          }
      </style>
  </head>
  @php
          $ordertotal =0;
  @endphp
  <body>
      <div class="container">
          <div class="header">
              <h1>Order Confirmation</h1>
          </div>
          <div class="order-details">
              <h2>Thank you for your order!</h2>
              <p>Hello,{{$sender}},</p>
              <p>Your order has been placed successfully. Here are the details:</p>
  
              <table class="product-list">
                  <thead>
                      <tr>
                          <th>Product</th>
                          <th>Quantity</th>
                          <th>Price</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($cart as $productId => $product)
                      <tr>
                          <td>{{ $product['Pname'] }}</td>
                          <td>{{ $product['Pquantity'] }}</td>
                          <td>${{ $product['Pprice'] }}</td>
                      </tr>
                          @php
                                      $totalprice = $product['Pprice'] * $product['Pquantity']; 
                                      $ordertotal  =    $ordertotal + $totalprice; 
  
                                  @endphp
                      @endforeach
                  </tbody>
              </table>
  
              <p><strong>Total: ${{ $ordertotal }}</strong></p>
              <br><br>
              <p>Kindly Confirm The Order By Clicking The below Button</p>
              <a class="confirm_btn" href="{{route('MailVerified',['order_number'=>$ordernum])}}">Confirm Order</a>
          </div>
      
          <div class="footer">
              <p>Need help? <a href="mailto:support@example.com">Contact our support team</a></p>
              <p>Thank you for shopping with us!</p>
          </div>
      </div>
  </body>
  </html>
    