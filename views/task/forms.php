<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php 
    /*
    ** Create Task Form 
    */  
?>

<div class="modal fade" id="newTaskModal" tabindex="-1" aria-labelledby="newTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="newTaskModalLabel">Inserir Nova Tarefa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php 
                    $form = ActiveForm::begin([
                        'id' => 'newTaskForm',
                        'action' => ['task/create'],
                    ]);
                ?>

                <?= $form->field($model, 'title', ['inputOptions' => ['name' => 'title']])->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                <?= $form->field($model, 'description', ['inputOptions' => ['name' => 'description']])->textArea(['maxlength' => true, 'class' => 'form-control']) ?>
                <?= $form->field($model, 'status', ['inputOptions' => ['name' => 'status_id']])->dropDownList($status, ['prompt' => 'Selecione', 'class' => 'form-select']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<?php 
    /*
    ** Edit Task Form 
    */  
?>

<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editTaskModalLabel">Editar Tarefa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php 
                    $form = ActiveForm::begin([
                        'id' => 'editTaskForm',
                        'action' => ['task/update'],
                    ]);
                ?>

                <?= $form->field($model, 'id')->hiddenInput(['name' => 'id'])->label(false) ?>
                <?= $form->field($model, 'title', ['inputOptions' => ['name' => 'title']])->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                <?= $form->field($model, 'description', ['inputOptions' => ['name' => 'description']])->textArea(['maxlength' => true, 'class' => 'form-control']) ?>
                <?= $form->field($model, 'status', ['inputOptions' => ['name' => 'status_id']])->dropDownList($status, ['prompt' => 'Selecione', 'class' => 'form-select']) ?>
                <?= $form->field($model, 'conclusion_at', ['inputOptions' => ['name' => 'conclusion_at']])->textInput(['type' => 'date', 'class' => 'form-control']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

