$(document).ready(function () {

    /**
    ** Load the table that lists the tasks.
    **/

    function loadTable() {
        $.ajax({
            url: '/task/list',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $('#listTasksTable tbody').empty();
                if (response.tasks.length === 0) {
                    $('#listTasksTable tbody').html('<tr><td colspan="5">Não existem tarefas.</td></tr>');
                } else {
                    $.each(response.tasks, function (index, taskObj) {
                        var task = taskObj.task;
                        var status = taskObj.status;

                        var row = '<tr ' +
                            'data-task-id="' + task.id + '" ' +
                            'data-task-title="' + (task.title || '') + '" ' +
                            'data-task-description="' + (task.description || '') + '" ' +
                            'data-task-created_at="' + (task.created_at || '') + '" ' +
                            'data-task-conclusion_at="' + (task.conclusion_at || '') + '" ' +
                            'data-task-status_id="' + (status.id || '') + '">' +
                            '<td>' + (task.title || '') + '</td>' +
                            '<td>' + (task.description || '') + '</td>' +
                            '<td>' + (task.created_at || '') + '</td>' +
                            '<td>' + (task.conclusion_at || '') + '</td>' +
                            '<td>' + (status.name || '') + '</td>' +
                            '</tr>';
                        $('#listTasksTable tbody').append(row);
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error('Erro na requisição AJAX: ' + error);
            }
        });
    }

    /**
    ** Calls table load on page load
    **/

    loadTable();

    /**
    ** Used for the new task creation, edit and delete form to submit data.
    **/

    $("#editTaskForm, #newTaskForm, #deleteTaskForm").on("submit", function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        var form = $(this);
        var formData = {};
        form.find('input, textarea, select').each(function () {
            var field = $(this);
            formData[field.attr('name')] = field.val();
        });

        $.ajax({
            url: form.attr("action"),
            type: "post",
            contentType: "application/json",
            data: JSON.stringify(formData),
            success: function (data) {
                if (data.error) {
                    var errorList = '<ul>';
                    $.each(data.error, function (key, value) {
                        $.each(value, function (index, errorMessage) {
                            errorList += '<li>' + errorMessage + '</li>';
                        });
                    });
                    errorList += '</ul>';

                    $('#alertModal .modal-body').html('');
                    $('#alertModal .modal-body').append('<div class="alert alert-warning" role="alert">' + errorList + '</div>');
                } else if (data.success) {
                    $('#alertModal .modal-body').html('');
                    $('#alertModal .modal-body').append('<div class="alert alert-success" role="alert">' + data.message + '</div>');
                }

                $('.modal').modal('hide');

                $('#alertModal').modal('show');
            },
            error: function (xhr, status, error) {
                $('#alertModal .modal-body').html('');
                $('#alertModal .modal-body').append('<div class="alert alert-warning" role="alert">Ocorreu um erro no servidor!</div>');

                $('#alertModal').modal('show');
            },
            complete: function () {
                loadTable();
            }
        });

        return false;
    });

    /**
    ** Show and hide the edit button.
    **/
   
    function toggleUpdateButtonVisibility() {
        var $updateButton = $('#updateTaskButton');
        var hasDataTaskId = $updateButton.attr('data-task-id') !== undefined;
    
        if (hasDataTaskId) {
            $updateButton.show();
        } else {
            $updateButton.hide();
        }
    }

    /**
    ** Remove atributes for edit button.
    **/

    function removeDataAttributes(target) {
        var $target = $(target);

        $.each($target.data(), function (key) {
            var attr = 'data-' + key.replace(/([A-Z])/g, '-$1').toLowerCase();
            $target.removeAttr(attr);
        });
    };

    /**
    ** Capture the click on the table row and aplly style.
    **/

    $('#listTasksTable tbody').on('click', 'tr', function () {
        $(this).each(function () {
            $.each(this.attributes, function () {
                if (this.specified && this.name.startsWith('data-')) {
                    $('#updateTaskButton, #deleteTaskButton').attr(this.name, this.value);
                }
            });
        });
        colorRow('#listTasksTable tbody', this);
        toggleUpdateButtonVisibility();
    });

    function colorRow(table, row) {
        $(table).find('tr').removeClass('table-info');
        $(row).addClass('table-info');
    }
    
    toggleUpdateButtonVisibility();

    /**
    ** Capture the click outside the table and remove the style.
    **/

    $(document).on('click', function (event) {
        if (!$(event.target).closest('#listTasksTable').length) {
            var buttonIds = ['#updateTaskButton', '#deleteTaskButton'];

            $.each(buttonIds, function (index, buttonId) {
                removeDataAttributes(buttonId);
            });

            $('#listTasksTable tbody tr').removeClass('table-info');
        }
        toggleUpdateButtonVisibility();
    });

    /**
    ** Open the task modal for editing
    **/

    $('#updateTaskButton').on('click', function () {
        $('#editTaskForm').find('input, textarea').val('');
        $.each(this.attributes, function () {
            if (this.specified && this.name.startsWith('data-task-')) {
                var attributeName = this.name.replace('data-task-', '');
                var attributeValue = this.value;

                var $formElement = $('#editTaskForm').find('[name="' + attributeName + '"]');

                if ($formElement.is('select')) {
                    $formElement.find('option').each(function () {
                        if ($(this).val() == attributeValue) {
                            $(this).prop('selected', true);
                        } else {
                            $(this).prop('selected', false);
                        }
                    });
                } else {
                    $formElement.val(attributeValue);
                }
            }
        });

        $('#editTaskModal').modal('show');
    });

    /**
    ** Open the task alert for delete
    **/

    $('#deleteTaskButton').on('click', function () {
        $('#deleteAlertModal .modal-body').html('');

        var taskTitle = $(this).attr('data-task-title');
        var alertDiv = $('<div class="alert alert-warning" role="alert">Você está prestes a excluir a tarefa: <strong>' + taskTitle + '</strong></div>');

        $('#deleteAlertModal .modal-body').append(alertDiv);

        $('#deleteTaskForm').find('input[name="id"]').val($(this).attr('data-task-id'));

        $('#deleteAlertModal').modal('show');
    });
});
