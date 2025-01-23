@extends('layouts.app')
@section('content')
    <h2>Todo List</h2>
    <button class="button" id="add-task-button">Add Task</button>

    <span id="counter"></span>
    <div class="todo-list"></div>

    <div class="modal" id="modal">
        <div class="modal-content">
            <h3 class="modal-title">Add Task</h3>
            <div class="form-group">
                <label for="task-title">Title</label>
                <input type="text" id="task-title" required>
            </div>
            <div class="form-group">
                <label for="task-description">Description</label>
                <textarea id="task-description" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="task-date">Due Date</label>
                <input type="date" id="task-date" required>
            </div>
            <div class="form-group">
                <label for="task-completed">Is Completed?</label>
                <input type="checkbox" id="task-completed">
            </div>
            <button class="button" id="save-task-button">Save</button>
        </div>
    </div>
@endsection
