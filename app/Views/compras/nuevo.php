<?php
$id_compra = uniqid();

?>



<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">

            <ol class="breadcrumb mb-4">

            </ol>
            <form method="POST" id="form_compras" name="form_compras" action="<?php echo base_url() ?>/compras/guarda" autocomplete="off">

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <input type="hidden" id="id_producto" name="id_producto">
                            <input type="hidden" id="id_compra" name="id_compra" value="<?php echo $id_compra; ?>">
                            <label>Codigo</label>
                            <input class="form-control" id="codigo" name="codigo" type="text" placeholder="Escribe el codigo y enter" onkeyup="buscarProducto(event, this, this.value)" autofocus>
                            <label for="codigo" id="resultado_error" style="color: red;"></label>
                        </div>

                        <div class="col-12 col-sm-4">
                            <label>Nombre </label>
                            <input class="form-control" id="nombre" name="nombre" disabled type="text">
                        </div>

                        <div class="col-12 col-sm-4">
                            <label>Cantidad</label>
                            <input class="form-control" id="cantidad" name="cantidad" type="text">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label>Precio de Compra</label>
                            <input class="form-control" id="precio_compra" name="precio_compra" disabled type="text">
                        </div>

                        <div class="col-12 col-sm-4">
                            <label>Subtotal </label>
                            <input class="form-control" id="subtotal" name="subtotal" disabled type="text">
                        </div>

                        <div class="col-12 col-sm-4" >
                            
                            <label>&nbsp;</label>
                           <div class="">
                           <button  id="agregar_producto" name="agregar_producto" type="button"  class="btn btn-primary"  onclick="agregarProducto(id_producto.value , cantidad.value, '<?php echo $id_compra; ?>')">   Agregar Producto  </button>
                           </div>
                        </div>
                    </div>
                </div>

                <ol class="breadcrumb mb-4">
                </ol>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Productos Comprados
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

                <ol class="breadcrumb mb-4">
                </ol>

                <div class="row">
                        <div class="col-12 col-sm-4">
                           
                        </div>

                        <div class="col-sm-2">
                          
                        </div>

                        <div class="col-8 ">
                            <br>
                            <div class="form-group row">
                                <label style="font-weight: bold; font-size: 30px; text-align: center;">Total $</label>
                                <div class="col-sm-8">
                                <input class="form-control" type="text" id="total" name="total" readonly="true" value="0.00" style="font-weight: bold; font-size: 30px; text-align: center;">
                       
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <br>
                            
                        <button type="button" id="completa_compras"  class="btn btn-success btn-lg btn-block">Completar compra</button>
                        </div>
                    </div>

              

            </form>
        </div>
    </main>
    <script>
        function buscarProducto(e, tagCodigo, codigo) {
            var keycode = e.keyCode || e.which;

            if (codigo != '') {
                if (keycode == 13) {
                    alert("Buscando el producto...");
                    $.ajax({
                        url: '<?php echo base_url(); ?>/productos/buscarPorCodigo/' + codigo,
                        dataType: "json",
                        success: function(resultado) {
                            if (resultado == 0) {
                                $(tagCodigo).val('');
                            } else {

                                $('#resultado_error').html(resultado.error);

                                if (resultado.existe) {
                                    $('#id_producto').val(resultado.datos.id);
                                    $('#nombre').val(resultado.datos.nombre);
                                    $('#cantidad').val(1);
                                    $('#precio_compra').val(resultado.datos.precio_compra);
                                    $('#subtotal').val(resultado.datos.precio_compra);
                                    $('#cantidad').focus();
                                } else {
                                    $('#id_producto').val('');
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

        function agregarProducto(id_producto, cantidad, id_compra) {


            if (id_producto != null && id_producto != 0 && cantidad > 0) {

                alert("agregando el producto");
                $.ajax({
                    url: '<?php echo base_url(); ?>/TemporalCompra/inserta/' + id_producto + "/" + cantidad + "/" + id_compra,
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

        $(document).ready(function() {
            $("#completa_compras").click(function(){
                alert('boton compras');
                let nFila =$('#tablaProductos tr').length;
                if(nFila < 2){
                 alert('no hay venta');
                }else{
                    $("#form_compras").submit();
                }
            });
        });

        function eliminarProducto(id_producto,id_compra) {

                $.ajax({
                    url: '<?php echo base_url(); ?>/TemporalCompra/eliminar/' + id_producto + "/" + id_compra,
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
    </script>