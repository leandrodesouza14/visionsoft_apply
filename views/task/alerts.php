<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php 
    /**
     * This view contains views of alerts for Ajax operations.
     */  
?>

<?php 
    /**
     * This modal is used to display error and success messages.
     */  
?>

<div class="modal fade modal-priority" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alertModalLabel">Alerta!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<?php 
    /**
     * This modal is used to confirm whether you want to delete a task.
     */  
?>

<div class="modal fade modal-priority" id="deleteAlertModal" tabindex="-1" aria-labelledby="deleteAlertModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAlertModalLabel">Tem certeza?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <?php
                    $form = ActiveForm::begin([
                        'id' => 'deleteTaskForm',
                        'action' => ['task/delete'],
                    ]);
                ?>

                <?= $form->field($model, 'id')->hiddenInput(['name' => 'id'])->label(false) ?>

                <div class="form-group">
                    <?= Html::submitButton('Excluir', ['class' => 'btn btn-danger', 'id' => 'confirmDeleteTaskButton']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>