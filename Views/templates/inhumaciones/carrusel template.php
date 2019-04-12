<!-- The Modal -->
<div class="modal fade" id="modalNuevaInhumacion">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Agregar Parcela</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">



                <div id="carruselAgregarNicho" class="carousel slide" data-pause="true">
                    <!-- The slideshow -->
                    <div class="carousel-inner w-100 h-100">


                        <div class="carousel-item active">
                            
                        </div>
                        <div class="carousel-item">
                            
                        </div>


                    </div>
                </div>

                
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalNuevaInhumacion" data-slide-to="0">Agregar</button>


<button type="button" class="btn btn-primary btn-block" data-target="#carruselAgregarNicho" data-slide-to="1">Continuar</button>

<button id="btnSave" type="submit" class="btn btn-primary btn-block">Guardar</button>