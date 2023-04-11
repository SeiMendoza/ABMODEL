@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Registro')    
@section('miga')
<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Registro de Mesas</li>
@endsection
@section('content')
    <div class="page-wrapper font-robo">
        <div class="wrapper wrapper--w960 ">
            <div class="card border-radius-sm border-0">
                <div class="card-body border-radius-sm border-0">
                    <h2 class="title">Registrar Información</h2>
                    <form method="POST">
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="font-robo">
                                    <label for="name">Nombre:</label>
                                    <input class="form-control border-radius-sm" type="text" placeholder="Nombre" name="name">
                                </div>   
                            </div>
                            <div class="col-6">
                                <div class="font-robo form-group">
                                    <label for="birthday">Cumpleaños:</label>
                                    <input class="form-control js-datepicker border-radius-sm" type="text" placeholder="Fecha: 00/00/0000" name="birthday">
                                    <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                </div>
                            </div>
                            <div class="col">
                                <div class="font-robo form-group">
                                    <label for="gender">Opciones: </label> <br>
                                   
                                        <select name="gender" class="form-control border-radius-sm ">
                                            <option disabled="disabled" selected="selected">Seleccione</option>
                                            <option>Opción 1</option>
                                            <option>Opción 2</option>
                                            <option>Otro</option>
                                        </select>
                                     
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="font-robo form-group">
                                    <label for="class">Clases: </label>
                                    
                                        <select name="class" class="form-control border-radius-sm">
                                            <option disabled="disabled" selected="selected">Clase</option>
                                            <option>Clase 1</option>
                                            <option>Clase 2</option>
                                            <option>Clase 3</option>
                                        </select>
                                        

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="font-robo form-group">
                                    <label for="res_code">Número: </label>
                                    <input class=" form-control input--style-2 border-radius-sm ps-2" type="number" placeholder="Ingrese un número" name="res_code">
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