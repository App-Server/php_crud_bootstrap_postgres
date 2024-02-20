<?php

include 'theme.php';

?>

<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><strong>Create User</strong></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/create-user.php">Create User</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/show-user.php">Show User</a>
        </li>
        <ul class="dropdown-menu">
            
          </ul>
        </li>
        
      </ul>
        
        <form class="d-flex" role="search">
        <a href="/login.php">Sair</a>
      </form>
    </div>
  </div>
</nav>