<?php
include('_core.php');
include('header.php');
?>
<?php
if ($_SESSION["admin"] == 4) {
?>
    <div class="row">
        <div class="col-sm-3">
            <div class="tile-stats tile-primary" style="cursor:pointer;">
                <div class="icon"><i class="entypo-network"></i></div>
                <?php
                $sql_sentencia = _query("SELECT * FROM torres");
                $cantida_torres = _num_rows($sql_sentencia);
                ?>
                <div class="num" data-start="0" data-end="<?php echo $cantida_torres ?>" data-postfix="" data-duration="1500" data-delay="0"><?php echo $cantida_torres ?></div>
                <h3>Torres</h3>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="tile-stats tile-cyan" style="cursor:pointer;">
                <div class="icon"><i class="entypo-globe"></i></div>
                <?php
                $sql_sentencia = _query("SELECT * FROM ips WHERE id_estadoip='2'");
                $cantida_ip1 = _num_rows($sql_sentencia);
                ?>
                <div class="num" data-start="0" data-end="<?php echo $cantida_ip1 ?>" data-postfix="" data-duration="1500" data-delay="0"><?php echo $cantida_ip1 ?></div>
                <h3>Ips asignadas a clientes</h3>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="tile-stats tile-red" style="cursor:pointer;">
                <div class="icon"><i class="entypo-rss"></i></div>
                <?php
                $sql_sentencia = _query("SELECT * FROM ap");
                $cantida_aps = _num_rows($sql_sentencia);
                ?>
                <div class="num" data-start="0" data-end="<?php echo $cantida_aps ?>" data-postfix="" data-duration="1500" data-delay="0"><?php echo $cantida_aps ?></div>
                <h3>Aps</h3>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="tile-stats tile-green" style="cursor:pointer;">
                <div class="icon"><i class="entypo-user"></i></div>
                <?php
                $sql_sentencia = _query("SELECT * FROM usuarios");
                $cantida_user = _num_rows($sql_sentencia);
                ?>
                <div class="num" data-start="0" data-end="<?php echo $cantida_user ?>" data-postfix="" data-duration="1500" data-delay="0"><?php echo $cantida_user ?></div>
                <h3>Usuarios</h3>
            </div>
        </div>
    </div>
<?php
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">Estadisticas</div>
            </div>
        </div>
        <div class="panel-body">
            <?php
            $torres = "SELECT * FROM torres";
            $resultados = _query($torres);
            $items = _num_rows($resultados);
            for ($i = 0; $i < $items; $i++) {
                $row = _fetch_array($resultados);
                $id = $row['id_torre'];
                $menu = $row['nombre_torre'];
                $cantidadtotal = _num_rows(_query("SELECT * FROM ips WHERE id_torre='$id'"));
                if ($cantidadtotal != 0) {
            ?>
                    <div class="row">
                        <h5><?php echo $menu ?></h5>
                        <div class="col-md-12">
                            <?php
                            $libres = _num_rows(_query("SELECT * FROM ips WHERE id_torre='$id' AND id_estadoip='1'"));
                            $ocupadas = _num_rows(_query("SELECT * FROM ips WHERE id_torre='$id' AND id_estadoip='2'"));
                            $reservadas = _num_rows(_query("SELECT * FROM ips WHERE id_torre='$id' AND id_estadoip='3'"));
                            $noutilizar = _num_rows(_query("SELECT * FROM ips WHERE id_torre='$id' AND id_estadoip='4'"));
                            $primero = round(($libres * 100) / $cantidadtotal, 2);
                            $segundo = round(($ocupadas * 100) / $cantidadtotal, 2);
                            $tercero = round(($reservadas * 100) / $cantidadtotal, 2);
                            $cuarto = round(($noutilizar * 100) / $cantidadtotal, 2);
                            echo "<div class='progress'>";
                            echo "<div class='progress-bar progress-bar-success' data-toggle='tooltip' data-placement='top' title='" . $libres . " ips libres' style='width:" . $primero . "%;'>";
                            echo "<span class='sr-only'>" . $primero . "% Ips Libres</span>";
                            echo "</div>";
                            echo "<div class='progress-bar progress-bar-danger' data-toggle='tooltip' data-placement='top' title='" . $ocupadas . " ips ocupadas' style='width:" . $segundo . "%;'>";
                            echo "<span class='sr-only'>" . $segundo . "% Ips Ocupadas</span>";
                            echo "</div>";
                            echo "<div class='progress-bar progress-bar-warning' data-toggle='tooltip' data-placement='top' title='" . $reservadas . " ips reservadas' style='width:" . $tercero . "%;'>";
                            echo "<span class='sr-only'>" . $tercero . "% Ips Reservadas</span>";
                            echo "</div>";
                            echo "<div class='progress-bar progress-bar-info' data-toggle='tooltip' data-placement='top' title='" . $noutilizar . " ips para no ocupar' style='width:" . $cuarto . "%;'>";
                            echo "<span class='sr-only'>" . $cuarto . "% Ips No utilizar</span>";
                            echo "</div>";
                            echo "</div>";
                            ?>

                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<br />
<!-- Footer -->
<footer class="main">
</footer>
</div>
</div>
<?php
include('footer.php');
?>