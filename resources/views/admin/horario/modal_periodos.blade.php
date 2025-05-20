<div class="modal fade" id="modalFiltros" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h3 class="modal-title" id="exampleModalLabel"><strong>Filtros personalizados</strong>
                </h3>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="filtroPeriodo"><strong>Período académico</strong></label>
                    <select class="form-control" id="filtroPeriodo" name="filtroPeriodo">
                        <option value="">Seleccione un período</option>
                        @foreach ($periodos as $periodo)
                            <option value="{{ $periodo->id }}">{{ $periodo->periodo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button
                        style=" 
                    color:#1e2837d9  !important;
                    background-color: white !important;
                    border-color: #1572e8 !important;"
                        type="button" class="btn btn-warning" id="btnResetFiltros">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnAplicarFiltros">Aplicar filtros</button>
                </div>
            </div>
        </div>
    </div>
</div>
