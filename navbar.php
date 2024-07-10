<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($titulo_pagina) ? $titulo_pagina : 'Título Padrão'; ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <?php if (isset($nome_style)) echo '<link href="' . $nome_style . '" rel="stylesheet">'; ?>
</head>

<link rel="stylesheet" href="css/navbar.css">
<script src="js/menulateral.js"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-custom">
  <a class="navbar-brand" href="#">
    <img src="img/logo_plannermed.png" alt="PlannerMed Logo" style="height: 40px;">
  </a>
  
  <div class="collapse navbar-collapse justify-content-end">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#" data-target="diario">Diário</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" data-target="remedios">Remédios</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" data-target="sobrenos">Sobre nós</a>
      </li>
    </ul>
    <div class="navbar-separator"></div>
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="bi bi-person-circle"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Profile</a>
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
