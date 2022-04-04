<!doctype html>
<html lang="en">

<head>

    <title>Top Up Murah Resmi Cepat </title>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Data Tables -->
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">



    <!-- Bootstrap CSS -->
    <link href="<?= base_url('/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- JQuery -->
    <script src="<?= base_url('/js/jquery-3.5.1.min.js'); ?>"></script>

    <!-- Font -->


    <!-- Additional CSS -->
    <link href="<?= base_url('/css/template.css'); ?>" rel="stylesheet">

</head>

<body>
    <!-- Navbar -->
    <?= $this->include('layout/navbar'); ?>

    <div class="container-fluid">
        <?= $this->renderSection('content'); ?>
    </div>

    <!-- Footer -->
    <?= $this->include('layout/footer'); ?>

    <!-- Data Tables -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

    <!-- JS -->
    <script>
    </script>

    <!-- Font Awesone -->
    <script src="https://kit.fontawesome.com/9275b0bddd.js" crossorigin="anonymous"></script>

    <!-- Navbar JS -->
    <script src="<?= base_url('/js/navbar.js'); ?>" crossorigin="anonymous"></script>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="<?= base_url('/js/bootstrap.bundle.min.js'); ?>"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        -->
</body>

</html>