<head>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/css/style.css' ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .row {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #F5F5F5;
        }

        h1 {
            font-size: 28px;
        }
    </style>
</head>

<div class="container">
    <div class="row">
        <div class="col-5">
            <h1 class="text-danger font-weight-bold">ERROR 403: ACCES NON AUTORISE</h1>
            <p class="text-dark">Lorem ipsum dolor sit amet consectetur adipisicing elit. 403 Error necessitatibus.</p>
            <a class="site-btn btn-2" href="<?php echo home_url(); ?>">Retourner à l'accueil</a>
        </div>
        <div class="col-7">
            <img class="img-fluid" src="<?php echo get_template_directory_uri() . '/img/team/3.jpg' ?>" alt="">
        </div>
    </div>
</div>