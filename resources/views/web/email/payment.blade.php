<!DOCTYPE html>
<html>
<head>
    <title>Flipina Fiance Visa || Payment Recipt</title>
</head>
<body>
    <b>Hello {{ Auth::user()->name }},</b>    
    <p>Your payment has been sucessfully credited</p>
    <p>Name:- {{ Auth::user()->name }}</p>
    <p>Email:- {{ Auth::user()->email }}</p>
    <p>Application:- {{ ucfirst(Auth::user()->chosen_application) }} Visa</p>
    <p>Amount:- ${{ @$data['price'] }}</p>
    <p>Transaction Id:- {{ @$data['transaction_id'] }}</p>
    <p>Please fill your {{ ucfirst(Auth::user()->chosen_application) }} Visa details by clicking below link</p>
    <a href="{{ $data['route'] }}">Click Here</a>
</body>
</html>