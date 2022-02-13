<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Katalog samochodów</title>
    <link rel="canonical" href="https://v5.getbootstrap.com/docs/5.0/examples/blog/">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="Template/style.css">
</head>

<body>
    <div class="container">
        <header class="blog-header py-3 mb-5">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-12 text-center blog-header-logo text-dark">
                    Katalog samochodów
                </div>
            </div>
        </header>

        <!-- lista -->
        <?php
        require "Logic/DataBase.php";
        require "Logic/Car.php";
        require "Template/CarToHtml.php";

        $db = new DataBase();
        $res = $db->Connection->query("select Id, Brand, Model, Year from Cars");

        while ($row = $res->fetch())
            CarToHtml($row);
        ?>

        <!-- dodawanie auta -->
        <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
            <div class="col-md-6 px-0">
                <h1 class="display-4 font-italic">Dodaj samochód</h1>

                <form enctype="multipart/form-data" method="post" action="Endpoints/RegisterCar.php">

                    <p class="lead my-3">

                        <input class="my-1" type="text" name="Brand" placeholder="Marka">
                        <br>
                        <input class="my-1" type="text" name="Model" placeholder="Model">
                        <br>
                        <input class="my-1" type="text" name="Year" placeholder="Rocznik">
                        <br>
                        <input class="my-3" type="file" name="Image">

                    </p>
                    <p class="lead mb-0">
                        <input type="submit" name="submit" class="text-white font-weight-bold btn btn-outline-light bg-primary" />
                    </p>
                </form>
            </div>
        </div>
    </div>

    <footer class="blog-footer">
        <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
        <p>
            <a href="#">Back to top</a>
        </p>
    </footer>

</body>

</html>