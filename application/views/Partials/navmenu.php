<body>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="home">Accueil<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact">Contact</a>
        </li>
        <li class="nav-item">
          <?php if(isset($this->session->user['id']) && !empty($this->session->user['id'])) : ?>
            <a class="nav-link" href="<?php echo base_url('Login/logout'); ?>">Se déconnecter</a>
          <?php else : ?>
            <a class="nav-link" href="login">Se connecter</a>
          <?php endif; ?>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="signin">S'enregistrer</a>
        </li>
       </ul>

      <form class="form-inline my-2 my-lg-0 pull-right">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
