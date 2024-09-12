


</html>
<!DOCTYPE html>
<html ng-app="confirmation">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title> ConTech |</title>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/semantic-ui/2.2.10/semantic.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular.min.js"></script>
    <!--Reference https://goo.gl/9ZXF8T-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/angular-translate/2.15.2/angular-translate.min.js"></script>
    <script src="app.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

    </style>
</head>
<body ng-controller="ConfirmController">
<div class="ui text container">
    <br><br>
    <div class="ui grid">
        <h1 class="ui dividing huge header centered column row"> Password Successfully Reset!</h1>
        <h2 class="ui center aligned icon header column row">
            <i class="circular hand peace icon"></i>
              Thanks
        </h2>
        <div class="ui row">
            <p class="ui center aligned column"> Congratulations! Your password has been successfully reset. You can now go to your account. </p>
        </div>
        <div class="ui divider column row"></div>
        <div class="ui row">
            <p class="ui center aligned column"><strong>   © {{ date('Y') }} ConTech </strong></p>
        </div>
    </div>
</div>
</body>
</html>
