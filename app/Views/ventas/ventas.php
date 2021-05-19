
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"><?php echo $titulo; ?></h1>
                        <ol class="breadcrumb mb-4">
                           <p>
                              <a href="<?php echo base_url(); ?>/ventas/eliminados" class="btn btn-danger">Elimidaos</a> 
                           </p>
                        </ol>
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Tabla de ventas realizadas
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Folio</th>
                                                <th>Cliente</th>
                                                <th>Total</th>
                                                <th>cajero</th>
                                                <th>Ticket</th>
                                                <th>Cancelacion</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                           <?php
                                           foreach($datos as $dato){?>
                                           <tr>
                                               <td><?php echo $dato['fecha_alta'] ?></td>
                                               <td><?php echo $dato['folio'] ?></td>
                                               <td><?php echo $dato['cliente'] ?></td>
                                               <td><?php echo $dato['total'] ?></td>
                                               <td><?php echo $dato['cajero'] ?></td>
                                               <td align="center"><a href="<?php echo base_url().'/ventas/muestraTicket/'. $dato['id']; ?> "class="btn btn-primary"> <i class="far fa-file-pdf"></i></a> </td>
                                               <td align="center"><a href="<?php echo base_url().'/ventas/eliminar/'. $dato['id']; ?> " class="btn btn-danger " > <i class="far fa-trash-alt"></i> </a> </td>
                                              
                                               
                                           </tr>

                                          <?php } ?>
                                           
                                         
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
               
          