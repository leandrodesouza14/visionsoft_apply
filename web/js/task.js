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
    
                $.each(response.tasks, function (index, taskObj) {
                    var task = taskObj.task;
                    var status = taskObj.status;
                    
                    var row = '<tr ' +
                        'data-task-id="' + task.id + '" ' +
                        'data-task-title="' + task.title + '" ' +
                        'data-task-description="' + task.description + '" ' +
                        'data-task-conclusion_at="' + task.conclusion_at + '" ' +
                        'data-task-status_id="' + status.id + '">' +
                        '<td>' + task.title + '</td>' +
                        '<td>' + task.description + '</td>' +
                        '<td>' + task.created_at + '</td>' +
                        '<td>' + task.conclusion_at + '</td>' +
                        '<td>' + status.name + '</td>' +
                        '</tr>';
                    $('#listTasksTable tbody').append(row);
                });
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

        $.ajax({
            url: form.attr("action"),
            type: "post",
            data: form.serialize(),
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
            complete: function() {
                loadTable(); 
            }
        });
        
        return false;   
    });

    /**
    ** Captures the click on the table row and aplly style.
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
    });

    function colorRow(table, row) {
        $(table).find('tr').removeClass('table-info');
        $(row).addClass('table-info');
    }

    /**
    ** Open the task modal for editing
    **/

    $('#updateTaskButton').on('click', function () {
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
    })

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
