<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h1><b>Hello: {{$user->student->name}}</b></h1>
    <br>
    <p>Your avg marks is: {{number_format($user->student->marks->avg('mark'),2)}}</p>
</body>
</html>
