<h1 style="text-align: center;">Học lập trình laravel tại Unicode</h1>
<?php
    if (env('APP_ENV')=='production'){
        //Call Api Live 
        echo 'Call api Live';
    }
    else{
        //Call Api Sandbox 
        echo 'Call api Sandbox';
    }

    // echo date('Y-m-d H:i:s');
    // echo env('APP_ENV');
    // echo config('app.env');

?>