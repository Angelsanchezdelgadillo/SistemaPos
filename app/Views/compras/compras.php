<div id="layoutSidenav_content">
    <main>
    
        <div class="container-fluid">
       
            <h1 class="mt-4"><?php echo $titulo; ?></h1>
            
            <ol class="breadcrumb mb-4">
               
               </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Tabla de compras
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Folio</th>
                                    <th>Total </th>
                                    <th>Fecha </th>
                                    <th>PDF</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($compras as $compra) { ?>
                                    <tr>
                                        <td><?php echo $compra['id'] ?></td>
                                        <td><?php echo $compra['folio'] ?></td>
                                        <td><?php echo $compra['total'] ?></td>
                                        <td><?php echo $compra['fecha_alta'] ?></td>
                                        <td align="center"><a href="<?php echo base_url() . '/compras/muestraCompraPdf/' . $compra['id']; ?> " class="btn btn-primary"> <i class="far fa-file-pdf"></i> </a> </td>
                                       
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
