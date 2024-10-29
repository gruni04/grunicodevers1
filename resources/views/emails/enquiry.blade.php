<!DOCTYPE html>
<html>
<head>
    <title>New Enquiry Received</title>
</head>
<body>
    <h1>New Enquiry Details</h1>
    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Mobile:</strong> {{ $data['mobile'] }}</p>
    <p><strong>Admission City:</strong> {{ $data['admission_city'] }}</p>
    <p><strong>Message:</strong> {{ $data['message'] }}</p>
</body>
</html>
