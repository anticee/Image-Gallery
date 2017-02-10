<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>Account options</title>


        <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
        <script src="<?= asset('js/jquery-1.12.3.min.js') ?>"></script>
        <script src="<?= asset('app/lib/angular/angular.min.js') ?>"></script>
        <script src="<?= asset('js/bootstrap.min.js') ?>"></script>

        <link href="<?= asset('css/bootstrap.min.css') ?>" rel="stylesheet">
        <!-- AngularJS Application Scripts -->
        <script src="<?= asset('app/app.js') ?>"></script>
    </head>
    <body ng-app="kuvaApp">
        <div class="col-md-10">
            <div class="row">
                <h2>MORO</h2>
                <p>
                    tere. {{ accountOptionsAng }}
                </p>
            </div>
        </div>
    </body>
</html>