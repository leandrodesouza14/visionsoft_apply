<div class="row">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-striped table-hove" id="listTasksTable">
                <thead>
                    <tr>
                        <th>Título da Tarefa</th>
                        <th>Descrição</th>
                        <th>Data de Criação</th>
                        <th>Data de Conclusão</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col text-end">
        <button class="btn btn-outline-danger" id="deleteTaskButton">Excluir</button>
        <button class="btn btn-outline-primary" id="updateTaskButton">Editar</button>
        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#newTaskModal">
            Adicionar
        </button>
    </div>
</div>

<?= $this->render('alerts', ['model' => $model]) ?>
<?= $this->render('forms', ['model' => $model, 'status' => $status]) ?>