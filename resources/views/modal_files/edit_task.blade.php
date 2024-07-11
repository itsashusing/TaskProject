@php
use App\Models\Task;
$task= Task::find($request['id']);
@endphp

<div class="card-body p-2">
    <h5 class="mb-4">Edit a Task</h5>

    <form class="row g-3" method="POST" action="{{ route('user.add_task') }}">
        @csrf
        @method('PUT')
        <div class="col-md-12">
            <input type="text" hidden name="id" value="{{ $task->id }}">
            <label for="input3" class="form-label">Task Name<span class="star">★</span></label>
            <input type="text" id="input3" class="form-control" required name="task" value="{{ $task->task }}" />
        </div>

        <div class="col-md-12 form-group mt-4 d-flex justify-content-en d">
            <div class="d-md-flex d-grid align-items-center gap-3">
                <button type="submit" name="submit" class="btn btn-primary px-4">Submit</button>
            </div>
        </div>
    </form>
</div>