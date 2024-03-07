<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Status Update By Admin</title>
</head>
<body>
    <strong>Hello,</strong>
    <p>This is to inform you that your account has been  {{ ucwords(str_replace('_', ' ', $status)) }} by Admin</p>
</body>
</html>