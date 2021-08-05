<?php
include('_core.php');
include('header.php');
?>
<h2>Ajustes</h2>
<div class="row">
    <div class="col-sm-3">
        <div class="tile-stats tile-primary" onclick="$(location).attr('href','torres.php');" style="cursor:pointer;">
            <div class="icon"><i class="entypo-network"></i></div>
            <h3>Torres</h3>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="tile-stats tile-red" onclick="$(location).attr('href','aps.php');" style="cursor:pointer;">
            <div class="icon"><i class="entypo-rss"></i></div>
            <h3>Ap´s</h3>
        </div>
    </div>
    <?php
        if($_SESSION["admin"] == 4){
    ?>
    <div class="col-sm-3">
        <div class="tile-stats tile-blue" onclick="$(location).attr('href','usuarios.php');" style="cursor:pointer;">
            <div class="icon"><i class="entypo-user"></i></div>
            <h3>Usuarios</h3>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="tile-stats tile-purple" onclick="$(location).attr('href','codigo.php');" style="cursor:pointer;">
            <div class="icon"><i class="entypo-code"></i></div>
            <h3>Codigo</h3>
        </div>
    </div>
    <?php 
        }
    ?>
</div>

<br />


<!-- Footer -->
<footer class="main">

    &copy; 2020 <strong>Aplicacion</strong> Creado por <a href="#" target="_blank">Zenón Ayala</a>

</footer>
</div>













</div>
<?php
include('footer.php');
?>