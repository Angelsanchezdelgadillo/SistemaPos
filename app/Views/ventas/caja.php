
 
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
        <?php $id_VentaTmp = uniqid(); ?>
            <ol class="breadcrumb mb-4">
            </ol>
            

            <form id="form_venta" name="form_venta" class="form-horizontal" method="POST" action="<?php echo base_url(); ?>/ventas/guarda" autocomplete="off">
            <input type="hidden" id="id_venta" name="id_venta" value="<?php echo $id_VentaTmp; ?>">
    
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="ui-widget">
                                <label for="cliente">Cliente:</label>
                                <input type="hidden" id="id_cliente" name="id_cliente" value="1">
                                <input type="text" class="form-control" id="cliente" name="cliente" placeholder="escribe el nombre del cliente" value="publico en general" autocomplete="off" required>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="">Forma de Pago:</label>
                            <select name="forma_pago" id="forma_pago" class="form-control" required>
                                <option value="001">Efectivo</option>
                                <option value="002">Tarjeta</option>
                                <option value="003">Transferencia</option>

                            </select>
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <input type="hidden" id="id_producto" name="id_producto">
                            <label>Codigo de barras</label>
                            <input class="form-control" id="codigo" name="codigo" type="text" placeholder="Escribe el codigo y enter" onkeyup="agregarProducto(e,this.value ,1, <?php echo $id_VentaTmp; ?> );" autofocus>
                        </div>

                        <div class="col-sm-2">
                            <label for="codigo" id="resultado_error" style="color: red;"></label>
                        </div>

                        <div class="col-12 col-sm-4 ">
                            <div class="form-group row">
                                <label style="font-weight: bold; font-size: 30px; text-align: center;">Total $</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" id="total" name="total" readonly="true" value="0.00" style="font-weight: bold; font-size: 30px; text-align: center;">
                                    <button type="button" id="completa_venta" name="completa_venta" class="btn btn-success btn-lg btn-block">Completar compra</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <ol class="breadcrumb mb-4">
                </ol>



                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Productos de la Venta
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered tablaProductos" id="tablaProductos" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                        <th width="1%">eliminar</th>
                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



            </form>
        </div>
    </main>

    <script>
        $(function() {
            $("#cliente").autocomplete({
                source: "<?php echo base_url(); ?>/clientes/autocompleteData",
                minLength: 1,
                select: function(event, ui) {
                    event.preventDefault();
                    $("#id_cliente").val(ui.item.id);
                    $("#cliente").val(ui.item.value);
                }
            });
        });
        $(function() {
            $("#codigo").autocomplete({
                source: "<?php echo base_url(); ?>/productos/autocompleteData",
                minLength: 1,
                select: function(event, ui) {
                    event.preventDefault();
                    $("#codigo").val(ui.item.value);
                    setTimeout(
                        function() {
                            e = jQuery.Event("keypress");
                            e.which = 13;
                            agregarProducto(e, ui.item.id, 1, '<?php echo $id_VentaTmp; ?>');
                        }
                    )
                }
            });
        });

        function agregarProducto(e, id_producto, cantidad, id_venta) {




            let enterKey = 13;
            if (codigo != '') {
                if (e.which == enterKey) {
                    if (id_producto != null && id_producto != 0 && cantidad > 0) {
                        $.ajax({
                            url: '<?php echo base_url(); ?>/TemporalCompra/inserta/' + id_producto + "/" + cantidad + "/" + id_venta,
                            success: function(resultado) {
                                if (resultado == 0) {

                                } else {
                                    var resultado = JSON.parse(resultado);
                                    if (resultado.error == '') {

                                        $('#tablaProductos tbody').empty();
                                        $('#tablaProductos tbody').append(resultado.datos);
                                        $('#total').val(resultado.total);

                                        $('#id_producto').val('');
                                        $('#codigo').val('');
                                        $('#nombre').val('');
                                        $('#cantidad').val('');
                                        $('#precio_compra').val('');
                                        $('#subtotal').val('');


                                    }
                                }
                            }
                        });


                    }
                }
            }

        }

        function eliminarProducto(id_producto, id_venta) {

            $.ajax({
                url: '<?php echo base_url(); ?>/TemporalCompra/eliminar/' + id_producto + "/" + id_venta,
                success: function(resultado) {
                    if (resultado == 0) {
                        $(tagCodigo).val('');

                    } else {
                        var resultado = JSON.parse(resultado);
                        $('#tablaProductos tbody').empty();
                        $('#tablaProductos tbody').append(resultado.datos);
                        $('#total').val(resultado.total);
                    }
                }
            });
        }

        $(function() {
            $("#completa_venta").click(function() {
                let nFilas = $("#tablaProductos tr").length;
                if (nFilas < 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Debes agregar Productos ...',
                       
                    });
                } else {
                    $('#form_venta').submit();


                }
            });
        });
    </script>