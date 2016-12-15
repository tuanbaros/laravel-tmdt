<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Admin</title>

    <!-- Bootstrap -->
    <link href="admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="admin/css/custom.css" rel="stylesheet">
</head>

<body style="background:#F7F7F7;">
<div class="">
    <div id="wrapper">
        <div id="login" class=" form">
            <section class="login_content">
                <form action="loginadmin" method="post">
                    <h1>Login Admin</h1>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Username" required />
                    </div>
                    <div>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required />
                    </div>
                    <div>
                        <input type="submit" value="Log in" class="btn btn-default submit">
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <div class="clearfix"></div>
                        <br />
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
</html>