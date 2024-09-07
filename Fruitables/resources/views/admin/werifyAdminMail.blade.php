<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #000;
    font-family: Arial, sans-serif;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    width: 100%;
}

.form-box {
    background-color: #1e1e2f;
    padding: 20px 40px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    text-align: center;
    color: #fff;
    max-width: 400px;
    width: 100%;
}

.admin {
    color: red;
    display: inline-block;
    margin-right: auto;
    font-size: 1.5em;
}

.change-password {
    display: inline-block;
    margin-left: auto;
    font-size: 1.5em;
}

.input-box {
    margin-top: 20px;
    margin-bottom: 20px;
    text-align: left;
}

.input-box label {
    display: block;
    font-size: 0.9em;
    margin-bottom: 5px;
}

.input-box input {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #333;
    color: #fff;
    font-size: 1em;
}

.verify-button {
    display: inline-block;
    width: 100%;
    text-decoration: none
    padding: 10px;
    background-color: red;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.verify-button:hover {
    background-color: darkred;
}

.footer-text {
    margin-bottom: 20px;
    font-size: 0.9em;
    color: #bbb;
}

.footer-text a {
    color: red;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-text a:hover {
    color: darkred;
}

    </style>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <p class="footer-text">
                Please Click The Below Button To Verify Your Mail
            </p>
            <a href="{{route('admin.verified',['token'=>$token])}}" class="verify-button">Verify Mail</a>
          
        </div>
    </div>
</body>
</html>
