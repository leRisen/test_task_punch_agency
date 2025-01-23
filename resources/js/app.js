import './bootstrap'

$(document).ready(function () {
    $('#login-button').click(function () {
        axios.post('/api/login', {
            login: $('#login').val(),
            password: $('#password').val(),
        }).then(() => window.location.href = '/dashboard');
    });

    let editTaskId = null;

    const modal = $('#modal');
    const counter = $('#counter');
    const todoList = $('.todo-list');

    function renderTasks() {
        todoList.text('Loading...');
        counter.text('Loading...');

        axios.get(`/api/tasks`)
            .then((response) => {
                todoList.empty();
                let completedTasks = 0;

                response.data.forEach(task => {
                    if (task.is_completed) {
                        completedTasks++;
                    }

                    const item = $(`
                      <div class="todo-item" data-id="${task.id}">
                        <div class="details">
                          <h3>${task.title}</h3>
                          <p>${task.description}</p>
                          <small>Due: ${task.due_date} | Completed: ${task.is_completed ? 'Yes' : 'No'}</small>
                        </div>
                        <div class="actions">
                          <button class="button edit-button">Edit</button>
                          <button class="button delete-button">Delete</button>
                        </div>
                      </div>
                    `);

                    item.find('.edit-button').click(() => openModal(task));
                    item.find('.delete-button').click(() => deleteTask(task.id));
                    todoList.append(item);
                });

                counter.text(`Completed tasks ${completedTasks}/${response.data.length}`);
            });
    }

    function openModal(task = null) {
        editTaskId = task ? task.id : null;
        modal.find('.modal-title').text(task ? 'Edit Task' : 'Add Task');
        $('#task-title').val(task ? task.title : '');
        $('#task-description').val(task ? task.description : '');
        $('#task-date').val(task ? task.due_date : '');
        $('#task-completed').prop('checked', task ? task.is_completed : false);
        modal.addClass('active');
    }

    function closeModal() {
        modal.removeClass('active');
    }

    async function saveTask() {
        const title = $('#task-title').val();
        const description = $('#task-description').val();
        const date = $('#task-date').val();
        const isCompleted = $('#task-completed').is(':checked');

        if (editTaskId) {
            await axios.patch(`/api/tasks/${editTaskId}`, {
                title,
                description,
                due_date: date,
                is_completed: isCompleted,
            });
        } else {
            await axios.post('/api/tasks', {
                title,
                description,
                due_date: date,
                is_completed: isCompleted,
            });
        }

        renderTasks();
        closeModal();
    }

    async function deleteTask(id) {
        await axios.delete(`/api/tasks/${id}`);
        renderTasks();
    }

    $('#add-task-button').click(() => openModal());
    $('#save-task-button').click(saveTask);

    modal.click(e => {
        if (e.target.id === 'modal') closeModal();
    });

    renderTasks();
});
