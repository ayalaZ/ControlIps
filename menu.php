<ul id="main-menu" class="main-menu">
  <li class="opened active">
    <a href="index.php">
      <i class="entypo-gauge"></i>
      <span class="title">Pagina Principal</span>
    </a>
  </li>
  <li class="has-sub">
    <a href="informacion.php"><i class="entypo-network"></i><span class="title">Torres</span></a>
    <ul>
      <?php
      $torres = "SELECT * FROM torres";
      $resultados = _query($torres);
      $items = _num_rows($resultados);
      for ($i = 0; $i < $items; $i++) {
        $row = _fetch_array($resultados);
        $id = $row['id_torre'];
        $menu = $row['nombre_torre'];
        $link = "datos.php?t=" . $id;
        echo "<li><a href='" . $link . "'>" . ucfirst($menu) . "</a></li>";
      }
      ?>
    </ul>
  </li>
  <?php 
     if($_SESSION["admin"] == 4 || $_SESSION["admin"] == 1 ){
  ?>
  <li>
    <a href="aps.php"><i class="entypo-rss"></i><span class="title">Ap's</span></a>
  </li>
  <?php 
     }
  ?>
  <li>
    <a href="reportegeneral.php"><i class="entypo-doc-text"></i><span class="title">Reportes</span></a>
  </li>

 
</ul>