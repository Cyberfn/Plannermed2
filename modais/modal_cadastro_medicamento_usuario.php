<div class="modal fade" id="modal_cadastro_medicamento" tabindex="-1" aria-labelledby="modal_cadastro_medicamento_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_cadastro_medicamento_label">
                    <i class="bi bi-capsule"></i>
                    Cadastro de Medicação
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_cadastro_medicamento" method="POST" action="cadastro_remedios_crud.php">
                    <ul id="dosagem">
                        <li id="tituloArea">Dosagem do uso:</li>
                        <li>
                            <input type="number" name="num_dosagem" required>
                            <select name="dosagem" required>
                                <option value="">Unidade de dosagem</option>
                                <option value="comprimido">comprimido</option>
                                <option value="capsula">cápsula</option>
                                <option value="gota">gota</option>
                                <option value="colher">colher</option>
                                <option value="unidade">unidade</option>
                            </select>
                        </li>
                    </ul>

                    <ul id="concentracao">
                        <li id="tituloArea">Concentração do remédio:</li>
                        <li>
                            <input type="number" name="num_concentracao" required>
                            <select name="concentracao" required>
                                <option value="">Unidade de concentração</option>
                                <option value="mcg">mcg</option>
                                <option value="mg">mg</option>
                                <option value="g">g</option>
                                <option value="mL">mL</option>
                                <option value="L">L</option>
                            </select>
                        </li>
                    </ul>

                    <ul id="intervalo">
                        <li id="tituloArea">Intervalo (em horas) entre cada uso:</li>
                        <li>
                            <input type="number" name="frequencia" required>
                        </li>
                    </ul>

                    <ul id="duracao">
                        <li id="tituloArea">Duração (em dias) do tratamento:</li>
                        <li>
                            <input type="number" name="duracao" required>
                        </li>
                    </ul>

                    <ul id="inicio">
                        <li id="tituloArea">Data e horário de início: </li>
                        <li>
                            <input id="DataHora" type="datetime-local" name="inicio" required><br>
                        </li>
                    </ul>


                    <input type="hidden" name="id_remedio" value="1">
                    <input type="hidden" name="id_usuario" value="1">
                </form>
            </div>
            <div class="modal-footer">

                <button id="criar" type="submit" class="btn btn-primary" form="form_cadastro_medicamento">
                    Calcular horários e registrar
                </button>

                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>