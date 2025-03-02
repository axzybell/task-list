@extends('layouts.app')

@section('title', 'List of Tasks')

@section('content')
    <nav class="mb-4">
        <a href="{{ route('tasks.create') }}"
            class="link">
            Add Task
        </a>
    </nav>
    {{-- @isset is to check variable name is defined --}}
    <div>
        {{-- @if (count($tasks)) --}}
        {{-- to get all task list --}}
            @forelse ($tasks as $task)
                <div>
                    <a href="{{ route('tasks.show', ['task' => $task->id]) }}"
                        @class(['line-through' => $task->completed])>
                        {{$task->title}}
                    </a>
                </div>
            @empty
                <div>There are no Tasks</div>
            @endforelse

            @if ($tasks->count())
            <nav class="mt-4">
                {{ $tasks->links() }}
            </nav>
            @endif
        {{-- @endif --}}
    </div>
@endsection
