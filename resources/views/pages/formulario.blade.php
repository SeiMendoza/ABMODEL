@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Registro')    
@section('miga')
<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Registro</li>
@endsection
@section('content')
    <div class="page-wrapper font-robo">
        <div class="wrapper wrapper--w960">
            <div class="card-2 border-radius-sm">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Registrar Información</h2>
                    <form method="POST">
                        <div class="font-robo input-group">
                            <label for="name">Nombre:</label>
                            <input class="input--style-2" type="text" placeholder="Nombre" name="name">
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="font-robo input-group">
                                    <label for="birthday">Cumpleaños:</label>
                                    <input class="input--style-2 js-datepicker" type="text" placeholder="Fecha" name="birthday">
                                    <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="font-robo input-group">
                                    <label for="gender">Opciones: </label>
                                    <div class="rs-select2 js-select-simple select--no-search" style="width: 200px">
                                        <select name="gender">
                                            <option disabled="disabled" selected="selected">Seleccione</option>
                                            <option>Opción 1</option>
                                            <option>Opción 2</option>
                                            <option>Otro</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="font-robo input-group">
                                    <label for="class">Clases: </label>
                                    <div class="rs-select2 js-select-simple select--no-search" style="width: 500px">
                                        <select name="class">
                                            <option disabled="disabled" selected="selected">Clase</option>
                                            <option>Clase 1</option>
                                            <option>Clase 2</option>
                                            <option>Clase 3</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="font-robo input-group">
                                    <label for="res_code">Número: </label>
                                    <input class="input--style-2" type="number" placeholder="Ingrese un número" name="res_code">
                                </div>
                            </div>
                        </div>
                        
                    <div id="" ><br></div>
                    <div style="text-align:center">
                        <button onclick="" type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" onclick="cancelar('mesas/registro')" class="btn btn-danger">Cancelar</button>
                    </div>
              </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection