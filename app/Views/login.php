<?php 

$usuario_sesion = session();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>

    <link href="<?php echo base_url(); ?>/css/styles.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <script src="<?php echo base_url(); ?>/js/all.min.js"></script>

</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Iniciar Sesion</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="<?php echo base_url(); ?>/usuarios/validacion" autocomplete="off">
                                        <div class="form-group">
                                            <label class="small mb-1" for="usuario">Usuario</label>
                                            <input class="form-control " id="usuario" name="usuario"  type="text" placeholder="Ingresa tu usuario" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="password">Contraseña</label>
                                            <input class="form-control" id="password" name="password" type="password" placeholder="Ingresa tu contraseña" />
                                        </div>

                                        <div class="form-group d-flex align-center justify-content-between mt-4 mb-0">

                                            <button class="btn btn-primary" type="submit">Login</button>
                                        </div>

                                        <?php if (isset($validation)) { ?>
                                            <div class="alert alert-danger">
                                                <?php echo $validation->listErrors(); ?>
                                            </div>
                                        <?php  } ?>

                                        <?php if (isset($error)) { ?>
                                            <div class="alert alert-danger">
                                                <?php echo $error; ?>
                                            </div>
                                        <?php  } ?>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
     
    </div>
    <script src="<?php echo base_url(); ?>/js/jquery-3.5.1.slim.min.js"></script>
    <script src="<?php echo base_url(); ?>/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>/js/scripts.js"></script>
</body>

</html>