@extends('layouts.app')

@section('content')

<div class="container">
    
    <div id="agenda"></div>
</div>
  
  <!-- Modal -->
  <div class="modal fade" id="evento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Evento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{-- Formulario con el evento --}}
          <form id="formEventos">
            <input type="hidden" id="id" value=""/>  
            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
            {{-- Título --}}
            <div class="form-group">
                <label for="">Título</label>
                <input class="form-control" type="text" id="title" placeholder="Título del evento...">
            </div>
            {{-- Descripción --}}
            <div class="form-group">
                <label for="">Descripción</label>
                <textarea class="form-control" id="descripcion" cols="30" rows="10"></textarea>
            </div>
            {{-- Inicio --}}
            <div class="form-group">
                <label for="">Fecha Inicio</label>
                <input class="form-control" type="text" id="start" placeholder="Fecha Inicio">
            </div>
            {{-- Fin --}}
            <div class="form-group">
                <label for="">Fecha Fin</label>
                <input class="form-control" type="text" id="end" placeholder="Fecha Inicio">
            </div>

            {{-- Horario --}}
            <div class="form-group">
              <label for="">Hora</label>
              <input class="form-control" type="text" id="hour" placeholder="Horario">
            </div>

            {{-- Día y hora completo --}}
            <div class="form-group">
              <label for="">Día y Hora completo</label>
              <input class="form-control" type="text" id="dayHour" placeholder="Día completo">
            </div>

          </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btnGuardar">Guardar</button>
            <button type="button" class="btn btn-warning" id="btnModificar">Modificar</button>
            <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

@endsection