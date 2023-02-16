@extends('00_plantillas_Blade.plantilla_General')
@section('contend')
    {{-- Cards --}}

    <div>
        <div class="row">
            <div class="col-xl-8 col-sm-6 mb-xl-4 mb-4 text-end">
                <div class="card my-3 ">
                    <div class="card-body p-3">
                        {{-- foodIcon --}}
                        <div class="col-12 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-basket text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>

                        <div class="row align-items-start">
                            <div class="col">
                                <p>IMAGEN MAZISA DEL PRODUCTO </p>
                            </div>
    
                            <div class="col">
                                <div class="card col-12 text-end">
                                    <div class="col-12 p-4">
                                        <div>
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold" aling>Disponibles: 10
                                            </p>
                                            <h5 class="font-weight-bolder">
                                                Comidas y bebidas
                                            </h5>
                                            <div class="col-12">
                                                <div>
                                                    <div>
                                                        <h3>Food_name</h3>
                                                        <p align="center">Description ipsum dolor sit amet consectetur adipisicing
                                                            elit. Obcaecati
                                                            veniam distinctio dignissimos, sequi corporis nobis voluptate inventore,
                                                            quisquam est illo perspiciatis cupiditate? Ducimus, ea sapiente?
                                                        <div>
                                                            <div >
                                                                <span>L 100</span>
                                                                <div>
                                                                    <a class="row btn btn-danger">Editar</a>
                                                                </div>
                                                                <div>
                                                                    <p>CHECK</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- End Cards --}}

@endsection
