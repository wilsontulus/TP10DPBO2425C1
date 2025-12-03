<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">Gaming Lounge DB</a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?php if (!isset($page) || $page == "home" || $page == "") { echo "active"; } ?>" aria-current="page" href="index.php">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($page == "games") { echo "active"; } ?>" href="?page=games">List Game</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($page == "players") { echo "active"; } ?>" href="?page=players">List Pemain</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($page == "events") { echo "active"; } ?>" href="?page=events">List Event</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($page == "genres") { echo "active"; } ?>" href="?page=genres">List Genre</a>
        </li>
      </ul>
    </div>
  </div>
</nav>