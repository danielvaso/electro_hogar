<div class="content-buttons d-flex justify-content-center" data-id="{{$id}}">
@if(isset($show))
    <a class="btn btn-secondary me-1 btn-action" href="#" onclick="{{$obj}}.btnShow({{$id}}); return false" title="Ver"><i
            class="fa fa-eye"></i></a>
@endif
@if(isset($edit))
    <a class="btn btn-secondary me-1 btn-action" href="#" onclick="{{$obj}}.btnEdit({{$id}}); return false" title="Editar"><i
            class="fa fa-pencil-alt"></i></a>
@endif
@if(isset($delete))
    <a class="btn btn-secondary me-1 btn-action" href="#" onclick="{{$obj}}.btnDelete({{$id}}); return false" title="Eliminar"><i
            class="fa fa-trash"></i></a>
    @endif
    </div>
