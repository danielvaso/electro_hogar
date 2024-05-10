@extends('layouts.app')

@section('title')
    CLIENTES
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css"/>
@endsection
@section('content')
    <div class="card p-3 position-relative">
        <h2 class="content-heading"><i class="fa fa-users me-2"></i>CLIENTES</h2>
        <button type="button" class="btn btn-secondary w-25 btn-add" onclick="app.openModalCreate()"><i
                    class="fa fa-plus"></i> Agregar cliente
        </button>

        <div class="card-body">
            <div class="table-responsive">
                <table id="tableCustomers" class="table table-bordered table-hover table-striped table-sm">
                    <thead>
                    <th>ID</th>
                    <th>TIPO DE DOCUMENTO</th>
                    <th>DOCUMENTO</th>
                    <th>NOMBRE</th>
                    <th>TELEFONO</th>
                    <th>DIRECCION</th>
                    <th class="text-center">ACCIONES</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="modal" id="createCustomer" tabindex="-1" role="dialog" aria-labelledby="modal-normal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded shadow-none mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title text-uppercase">Agregar Cliente</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm mb-4">
                        <form id="createCustomerForm" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="createDocumentType">Tipo de Documento</label>
                                <input type="text" class="form-control" id="createDocumentType" name="type_document">
                            </div>
                            <div class="form-group">
                                <label for="createDocument">Documento</label>
                                <input type="text" class="form-control" id="createDocument" name="document">
                            </div>
                            <div class="form-group">
                                <label for="createName">Nombre</label>
                                <input type="text" class="form-control" id="createName" name="name">
                            </div>
                            <div class="form-group">
                                <label for="createPhone">Teléfono</label>
                                <input type="text" class="form-control" id="createPhone" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="createAddress">Dirección</label>
                                <input type="text" class="form-control" id="createAddress" name="address">
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" onclick="app.saveCustomer()">Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="showCustomer" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
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
                            <li class="list-group-item"><b>Tipo documento:</b> <label id="document_type"></label></li>
                            <li class="list-group-item"><b>Documento:</b> <label id="document"></label></li>
                            <li class="list-group-item"><b>Nombre:</b> <label class="text-capitalize" id="name"></label>
                            </li>
                            <li class="list-group-item"><b>Teléfono:</b> <label id="phone"></label></li>
                            <li class="list-group-item"><b>Dirección:</b> <label id="address"></label></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="updateCustomer" tabindex="-1" role="dialog" aria-labelledby="modal-normal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded shadow-none mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title text-uppercase">Editar Cliente</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm mb-4">
                        <form id="editForm">
                            @csrf
                            <input type="hidden" id="editId" name="id">
                            <div class="form-group">
                                <label for="editName">Nombre</label>
                                <input type="text" class="form-control" id="editName" name="name">
                            </div>
                            <div class="form-group">
                                <label for="editDocumentType">Tipo de Documento</label>
                                <input type="text" class="form-control" id="editDocumentType" name="document_type">
                            </div>
                            <div class="form-group">
                                <label for="editDocument">Documento</label>
                                <input type="text" class="form-control" id="editDocument" name="document">
                            </div>
                            <div class="form-group">
                                <label for="editPhone">Teléfono</label>
                                <input type="text" class="form-control" id="editPhone" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="editAddress">Dirección</label>
                                <input type="text" class="form-control" id="editAddress" name="address">
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
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
        $('#createForm').submit(function (event) {
          event.preventDefault();

          // Obtener los datos del formulario
          const formData = $(this).serialize();

          // Enviar los datos del formulario al servidor
          $.ajax({
            url: '/customers', // Ruta para la creación de clientes
            type: 'POST', // Método HTTP para la creación
            data: formData, // Datos del formulario serializados
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
              // Manejar la respuesta exitosa del servidor
              alert('Cliente no correctamente');
              $('#createCustomerModal').modal('hide'); // Cerrar el modal de creación después de la creación
              // Actualizar la tabla si es necesario
              location.reload();
            },
            error: function (err) {
              // Manejar errores de la solicitud AJAX
              console.error('Error al crear el cliente:', err);
              alert('Hubo un error al crear el cliente');
            }
          });
        });
      });
    </script>
    <script>
      $(document).ready(function () {

        $('#editForm').submit(function (event) {
          event.preventDefault();


          const formData = $(this).serialize();


          $.ajax({
            url: '/customers/' + $('#editId').val(),
            type: 'PUT',
            data: formData,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {

              alert('Cliente actualizado correctamente');
              $('#updateCustomers').modal('hide');
              location.reload();
            },
            error: function (err) {

              console.error('Error al actualizar el cliente:', err);
              alert('Hubo un error al actualizar el cliente');
            }
          });
        });
      });
    </script>
    <script>
      const customersRoute = "{{ route('customers') }}";
      let dataTabla = null;
      $(document).ready(function () {
        dataTabla = $('#tableCustomers').DataTable({
          ajax: customersRoute,
          filter: true,
          columns: [
            {data: 'id'},
            {data: 'document_type', orderable: false},
            {data: 'document', orderable: false},
            {data: 'name', orderable: false},
            {data: 'phone', orderable: false},
            {data: 'address', orderable: false},
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
            loadingRecords: "Cargando lista de clientes...",
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
          $('#createCustomer').modal('show');
        },
        btnShow: async function (id) {
          const {data} = await axios.get(route('customers.show', id));
          const customer = data.data;
          if (data.status) {
            $('#showCustomer .block-title').text(customer.name);
            for (let key in customer) {
              if (customer.hasOwnProperty(key)) {
                $(`#${key}`).text(customer[key]);
              }
            }
            $('#showCustomer').modal('show');
          }

        },
        btnDelete: function (id) {
          if (confirm('¿Estás seguro de que deseas eliminar este cliente?')) {
            $.ajax({
              url: '/customers/' + id,
              type: 'DELETE',
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function (response) {
                alert('Cliente eliminado correctamente');
                location.reload();

              },
            });
          }
        },
        btnEdit: async function (id) {
          try {
            const response = await axios.get(`/customers/${id}`);
            if (response.status === 200 && response.data.status) {
              const customer = response.data.data;
              $('#updateCustomer #editId').val(customer.id);
              $('#updateCustomer #editDocumentType').val(customer.document_type);
              $('#updateCustomer #editDocument').val(customer.document);
              $('#updateCustomer #editName').val(customer.name);
              $('#updateCustomer #editAddress').val(customer.address);
              $('#updateCustomer #editPhone').val(customer.phone);
              $('#updateCustomer #editEmail').val(customer.email);
              $('#updateCustomer').modal('show');
            } else {

              alert('No se pudo obtener la información del cliente');
            }
          } catch (error) {
            console.error('Error al obtener la información del cliente:', error);
            alert('Hubo un error al obtener la información del cliente');
          }


        },
        saveCustomer: function () {
          const form = $('#createCustomerForm').serializeArray();
          const data = form.reduce((obj, item) => {
            obj[item.name] = item.value;
            return obj;
          }, {});
          axios({
            method: 'post',
            url: route('customers.store'),
            data: data,
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
          }).then(response => {
            if (response.status === 200) {
              
              $('#createCustomerForm')[0].reset();
              $('#createCustomer').modal('hide');
              $.toast({
                text: 'Cliente creado exitosamente',
                position: 'top-right',
                stack: false,
                icon: 'success'
              });
              dataTabla.ajax.reload();
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
