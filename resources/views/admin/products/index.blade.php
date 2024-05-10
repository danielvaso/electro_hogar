@extends('layouts.app')

@section('title')
    PRODUCTOS
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css"/>
@endsection
@section('content')
    <div class="card p-3 position-relative">
        <h2 class="content-heading"><i class="fa fa-box me-2"></i>PRODUCTOS</h2>
        <button type="button" class="btn btn-secondary w-25 btn-add" onclick="app.openModalCreate()"><i
                    class="fa fa-plus"></i> Agregar producto
        </button>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tableProducts" class="table table-bordered table-hover table-striped table-sm">
                    <thead>
                    <th>Id</th>
                    <th>Tipo</th>
                    <th>Marca</th>
                    <th>Referencia</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>notas</th>
                    
                    <th class="text-center">Acciones</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="modal" id="createProduct" tabindex="-1" role="dialog" aria-labelledby="modal-normal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded shadow-none mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title text-uppercase">Agregar Producto</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm mb-4">
                        <form id="createProductForm">
                            <div class="form-group mb-3">
                                <label for="create_type">Tipo</label>
                                <input type="text" class="form-control" id="create_type" name="type">
                            </div>
                            <div class="form-group mb-3">
                                <label for="create_marca">marca</label>
                                <textarea class="form-control" id="create_marca" name="marca" rows="3"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="create_referencia">referencia</label>
                                <input type="text" class="form-control" id="create_referencia" name="referencia">
                            </div>
                            <div class="form-group mb-3">
                                <label for="create_drescription">Descripcion</label>
                                <input type="text" class="form-control" id="create_description" name="description">
                            </div>
                            <div class="form-group mb-3">
                                <label for="create_cantidad">Cantidad</label>
                                <input type="text" class="form-control" id="create_cantidad" name="cantidad">
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="create_notes">Notas</label>
                                <textarea class="form-control" id="create_notes" name="notes" rows="3"></textarea>
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar
                                </button>
                                <button type="button" class="btn btn-primary" onclick="app.saveProduct()">Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="showProduct" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded shadow-none mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title text-uppercase"></h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm mb-4">
                        <ul class="list-group">
                            
                            <li class="list-group-item"><b>Tipo</b> <label id="type"></label></li>
                            <li class="list-group-item"><b>marca:</b> <label id="marca"></label></li>
                            <li class="list-group-item"><b>referencia:</b> <label id="referencia"></label></li>
                            <li class="list-group-item"><b>descripsion:</b> <label id="description"></label></li>
                            <li class="list-group-item"><b>cantidad:</b> <label id="cantidad"></label></li>
                            
                            <li class="list-group-item"><b>Notas:</b> <label id="notes"></label></li>
                            <li class="list-group-item"><b>Fecha de Creación:</b> <label id="created_at"></label></li>
                            <li class="list-group-item"><b>Fecha de Actualización:</b> <label id="updated_at"></label></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="updateProduct" tabindex="-1" role="dialog" aria-labelledby="modal-normal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded shadow-none mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title text-uppercase">Editar Producto</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm mb-4">
                        <form id="editProductForm">
                            @csrf
                            <input type="hidden" id="editProductId" name="id">
                            <div class="form-group">
                                <label for="editProductType">Tipo</label>
                                <input type="text" class="form-control" id="editProductType" name="type">
                            </div>
                            <div class="form-group">
                                <label for="editProductMarca">Marca</label>
                                <textarea class="form-control" id="editProductMarca" name="marca"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="editProductReferencia">Referencia</label>
                                <input type="text" class="form-control" id="editProductReferencia" name="referencia">
                            </div>
                            <div class="form-group">
                                <label for="editProducDescription">Descripcion</label>
                                <input type="text" class="form-control" id="editProductDescription" name="description">
                            </div>
                            <div class="form-group">
                                <label for="editProductCantidad">Cantidad</label>
                                <input type="text" class="form-control" id="editProductCantidad" name="cantidad">
                            </div>
                            
                            <div class="form-group">
                                <label for="editProductNotes">Notas</label>
                                <textarea class="form-control" id="editProductNotes" name="notes"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="editProductCreatedAt">Fecha de Creación</label>
                                <input type="text" class="form-control" id="editProductCreatedAt" name="created_at">
                            </div>
                            <div class="form-group">
                                <label for="editProductUpdatedAt">Fecha de Actualización</label>
                                <input type="text" class="form-control" id="editProductUpdatedAt" name="updated_at">
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="close">Cancelar</button>
                                <button type="summit" class="btn btn-primary">Guardar cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script>
      $(document).ready(function () {
        // Manejar el envío del formulario de edición de producto
        $('#editProductForm').submit(function (event) {
          event.preventDefault(); // Evitar el envío del formulario por defecto

          // Obtener los datos del formulario
          const formData = $(this).serialize();

          // Enviar los datos actualizados al servidor a través de una solicitud AJAX
          $.ajax({
            url: '/products/' + $('#editProductId').val(), // URL para la actualización del producto
            type: 'PUT', // Método HTTP para la actualización
            data: formData, // Datos del formulario serializados
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
              // Manejar la respuesta exitosa del servidor
              alert('Producto actualizado correctamente');
              $('#updateProduct').modal('hide'); // Cerrar el modal de edición después de la actualización
              location.reload();
            },
            error: function (err) {
              // Manejar errores de la solicitud AJAX
              console.error('Error al actualizar el producto:', err);
              alert('Hubo un error al actualizar el producto');
            }
          });
        });
      });
    </script>
    <script>
      $(document).ready(function () {
        let dataTabla = null;
        dataTabla = $('#tableProducts').DataTable({
          ajax: route('products'),
          filter: true,
          columns: [
            {data: 'id'},
            {data: 'type', orderable: false},
            {data: 'marca', orderable: false},
            {data: 'referencia', orderable: false},
            {data: 'description', orderable: false},
            {data: 'cantidad', orderable: false},
            {data: 'notes', orderable: false},
            
            {data: 'btns', orderable: false}
          ],
          bLengthChange: false,
          info: false,
          pageLength: 100,
          processing: false,
          serverSide: true,
          language: {
            decimal: "",
            emptyTable: "No hay información",
            info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
            infoFiltered: "(Filtrado de _MAX_ total entradas)",
            infoPostFix: "",
            thousands: ",",
            lengthMenu: "Mostrar _MENU_ Entradas",
            loadingRecords: "Cargando lista de productos...",
            processing: "Procesando...",
            search: "Buscar:",
            zeroRecords: "Sin resultados encontrados",
            paginate: {
              first: "Primero",
              last: "Ultimo",
              next: "Siguiente",
              previous: "Anterior"
            }
          },
          order: [[0, "desc"]]
        });
        dataTabla.columns([0]).visible(false);
      });

      const app = {
        openModalCreate() {
          $('#createProduct').modal('show');
        },
        btnShow: async function (id) {
          const {data} = await axios.get(route('products.show', id));
          const product = data.data;
          if (data.status) {
            $('#showProduct .block-title').text(product.name);
            for (let key in product) {
              if (product.hasOwnProperty(key)) {
                if (document.getElementById(key)) {
                  $(`#${key}`).text(product[key]);
                }
              }
            }
            $('#showProduct ').modal('show');

          }
        },

        btnEdit: async function (id) {
          try {
            // Hacer una solicitud AJAX GET para obtener los datos del producto
            const response = await axios.get(`/products/${id}`);

            // Verificar si la solicitud fue exitosa
            if (response.status === 200 && response.data.status) {
              const product = response.data.data;

              // Rellenar un formulario modal con los datos del producto
              $('#updateProduct #editProductId').val(product.id);
              $('#updateProduct #editProductType').val(product.type);
              $('#updateProduct #editProductMarca').val(product.marca);
              $('#updateProduct #editProductReferencia').val(referencia.description);
              $('#updateProduct #editProductDescription').val(product.description);
              $('#updateProduct #editProductCantidad').val(product.Cantidad);
              $('#updateProduct #editProductNotes').val(product.notes);
              $('#updateProduct #editProductCreatedAt').val(product.created_at);
              $('#updateProduct #editProductUpdatedAt').val(product.updated_at);

              // Mostrar el formulario modal para permitir la edición
              $('#updateProduct').modal('show');
            } else {
              // Manejar el caso en el que no se encuentre el producto o haya un error
              alert('No se pudo obtener la información del producto');
            }
          } catch (error) {
            console.error('Error al obtener la información del producto:', error);
            alert('Hubo un error al obtener la información del producto');
          }
        },
        btnDelete: function (id) {
          if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
            $.ajax({
              url: '/products/' + id,
              type: 'DELETE',
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function (response) {
                alert('producto eliminado correctamente');
                location.reload();

              },

            });
          }
        },
        saveProduct: function () {
          const form = $('#createProductForm').serializeArray();
          const data = form.reduce((obj, item) => {
            obj[item.name] = item.value;
            return obj;
          }, {});
          axios({
            method: 'post',
            url: route('products.store'),
            data: data,
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
          }).then(response => {
            if (response.status === 200) {

              $('#createProductForm')[0].reset();
              $('#createProduct').modal('hide');
              $.toast({
                text: 'Cliente creado exitosamente',
                position: 'top-right',
                stack: false,
                icon: 'success'
              });
              location.reload();
            } else {
              $.toast({
                text: 'Error al crear el cliente',
                position: 'top-right',
                stack: false,
                icon: 'error'
              })
            }
          }).catch(error => {
            console.error(error);
          });
        }
      };
    </script>
@endsection
