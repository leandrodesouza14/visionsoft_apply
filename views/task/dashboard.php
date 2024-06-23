<div class="row">
    <div class="col">
        <table class="table" id="listTasksTable">
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
<div class="row">
    <div class="col text-end">
        <button class="btn btn-danger" id="deleteTaskButton">Excluir</button>
        <button class="btn btn-warning" id="updateTaskButton">Editar</button>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newTaskModal">
            Adicionar
        </button>
    </div>
</div>

<?= $this->render('alerts', ['model' => $model]) ?>
<?= $this->render('forms', ['model' => $model, 'status' => $status]) ?>