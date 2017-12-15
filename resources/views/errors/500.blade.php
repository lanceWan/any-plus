<!DOCTYPE html>
<html>
    <head>
        <title>500</title>
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
            .cancel{
                font-size: 16px;
                color: #B0BEC5;
                text-decoration: none;
                font-family: 'Lato', sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">{{$exception->getMessage()}}</div>
                <div><a href="{{url()->previous()}}" class="cancel">返回</a></div>
            </div>
        </div>
    </body>
</html>