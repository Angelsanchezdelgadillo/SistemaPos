<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?php echo $titulo; ?></h1>
            <ol class="breadcrumb mb-4">
                <p>
                    <a href="<?php echo base_url(); ?>/unidades/mostrarExel" class="btn btn-info">Agregar</a>
                    
                </p>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                   Unidades
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Nombre corto</th>
                             
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($datos as $dato) { ?>
                                    <tr>
                                        <td><?php echo $dato['id'] ?></td>
                                        <td><?php echo $dato['nombre'] ?></td>
                                        <td><?php echo $dato['nombre_corto'] ?></td>
                                        
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
