<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="addNewOrdenModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5 class="modal-title" id="myLargeModalLabel">Crear Orden de laboratorio</h5>
            </div>

            {{-- FORM --}}
            <form action="{{ route('orden.insert') }}" method="POST" role="form" autocomplete="off">
                @csrf

                {{-- BODY --}}
                <div class="modal-body">
                    <div class="form-wrap">
                        {{-- Checkboxes --}}
                        <x-cuadro-examenes />
                        <input type="hidden" name="consulta_id" value="{{ $consulta->id }}">
                    </div>
                </div>

                {{-- FOOTER (separado y abajo en su propia fila) --}}
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit"  class="btn btn-primary">
                        Crear Orden
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>