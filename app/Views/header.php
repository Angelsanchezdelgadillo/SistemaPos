<?php

$usuario_sesion = session();


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>POS</title>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="<?php echo base_url(); ?>/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>/css/styles.css" rel="stylesheet" />
    <script src="<?php echo base_url(); ?>/js/all.min.js"></script>
    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>





</head>


<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo base_url(); ?>/inicio">Sistema POS</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->

        <!-- Navbar-->
        <ul class="navbar-nav ml-auto  mr-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $usuario_sesion->nombre; ?> <i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?php echo base_url(); ?>/usuarios/cContraseña">Cambiar Contraseña</a>
                    <a class="dropdown-item" href="#">Activity Log</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>/usuarios/logout">Cerrar Sesion </a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-bag"></i></div>
                            Productos
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>/productos">Productos</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>/unidades">Unidades</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>/categorias">Categorias</a>
                            </nav>
                        </div>

                        <a class="nav-link" href="<?php echo base_url(); ?>/clientes">
                            <div class="sb-nav-link-icon"><i class="fas fa-address-card"></i></div> Clientes
                        </a>

                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menucompras" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></i></div>
                            Compras
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="menucompras" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>/compras/nuevo">Nueva compra</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>/compras">Compras</a>

                            </nav>
                        </div>

                        <a class="nav-link" href="<?php echo base_url(); ?>/ventas/venta">
                            <div class="sb-nav-link-icon"><i class="fas fa-cash-register"></i></div> Caja
                        </a>

                        <a class="nav-link" href="<?php echo base_url(); ?>/ventas">
                            <div class="sb-nav-link-icon"><i class="fas fa-cart-arrow-down"></i></i></div> Ventas
                        </a>


                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menureportes" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></i></div>
                            Reportes
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="menureportes" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>/productos/mostrarMinimos">Reporte Minimos</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>/productos/mostrarExel">Reporte Minimos en Exel</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>/unidades/mostrarUnidades">Reporte de Usuarios Exel</a>


                            </nav>
                        </div>



                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#subAdmin" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-wrench"></i></div>
                            Administracion
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="subAdmin" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url(); ?>/configuracion">Configuracion</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>/usuarios">Usuarios</a>
                                <a class="nav-link" href="<?php echo base_url(); ?>/roles">Roles</a>


                            </nav>
                        </div>



                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Eres un:</div>
                    <?php

                    $a = $usuario_sesion->id_rol;

                    if ($a == '2') {
                        echo 'Administrador';
                    } else {
                        echo 'Empleado';
                    }
                    ?>
                </div>
            </nav>
        </div>