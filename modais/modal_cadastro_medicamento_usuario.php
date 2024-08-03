<div class="modal fade" id="modal_cadastro_medicamento" tabindex="-1" aria-labelledby="modal_cadastro_medicamento_label" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Alterado para modal-lg para um tamanho mais compacto -->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_cadastro_medicamento_label">
                    <i class="bi bi-capsule"></i> Cadastro de Medicação
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form id="form_cadastro_medicamento" method="POST" action="cadastro_remedios_crud.php">
                    <div class="row mb-3">
                        <label for="num_dosagem" class="col-sm-4 col-form-label fw-bold">Dosagem:</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control form-control-sm" id="num_dosagem" name="num_dosagem" placeholder="Qtde" required>
                        </div>
                        <div class="col-sm-4">
                            <select name="dosagem" class="form-select form-select-sm" required>
                                <option value="" disabled selected>Unidade</option>
                                <option value="comprimido">Comprimido</option>
                                <option value="capsula">Cápsula</option>
                                <option value="gota">Gota</option>
                                <option value="colher">Colher</option>
                                <option value="unidade">Unidade</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="num_concentracao" class="col-sm-4 col-form-label fw-bold">Concentração:</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control form-control-sm" id="num_concentracao" name="num_concentracao" placeholder="Qtde" required>
                        </div>
                        <div class="col-sm-4">
                            <select name="concentracao" class="form-select form-select-sm" required>
                                <option value="" disabled selected>Unidade</option>
                                <option value="mcg">mcg</option>
                                <option value="mg">mg</option>
                                <option value="g">g</option>
                                <option value="mL">mL</option>
                                <option value="L">L</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="frequencia" class="col-sm-4 col-form-label fw-bold">Intervalo (horas):</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control form-control-sm" id="frequencia" name="frequencia" placeholder="Ex: 6" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="duracao" class="col-sm-4 col-form-label fw-bold">Duração (dias):</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control form-control-sm" id="duracao" name="duracao" placeholder="Ex: 14" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="DataHora" class="col-sm-4 col-form-label fw-bold">Início:</label>
                        <div class="col-sm-8">
                            <input type="datetime-local" class="form-control form-control-sm" id="DataHora" name="inicio" required>
                        </div>
                    </div>

                    <input type="hidden" name="id_remedio" value="1">
                    <input type="hidden" name="id_usuario" value="1">
                </form>
            </div>
            <div class="modal-footer">
                <button id="criar" type="submit" class="btn btn-primary btn-sm" form="form_cadastro_medicamento">
                </button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                </button>
            </div>
        </div>
    </div>
</div>
