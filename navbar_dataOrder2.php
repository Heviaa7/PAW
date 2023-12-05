<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>

<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="javascript:void(0)"><i data-feather="copy"></i> Heviaa Resto Order</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Pesan</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="1_pesan.php">Pesan Biasa</a></li>
                <li><a class="dropdown-item" href="0_viewQr.php">Pesan Via Code</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Order Detil</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="5_dataOrder.php">Order Aktive</a></li>
                <li><a class="dropdown-item" href="12_Sselesai.php">Order Selesai</a></li>
                <li><a class="dropdown-item" href="1_pesan.php">Tambah Order</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
      <form class="d-flex" method="get">
        <input class="form-control me-2" type="text" placeholder="Search" name="cari" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
        <button class="btn btn-primary" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

    <script>
        feather.replace();
    </script>

</body>
</html>


