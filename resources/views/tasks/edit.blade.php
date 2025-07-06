@extends('layouts.app')

@section('content')
    <h1 class="mb-4">タスク編集</h1>

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">タイトル</label>
            <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">説明</label>
            <textarea name="description" class="form-control">{{ $task->description }}</textarea>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="done" value="1" {{ $task->done ? 'checked' : '' }}>
            <label class="form-check-label">完了</label>
    </div>
        <button type="submit" class="btn btn-primary">更新</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">戻る</a>
    </form>
@endsection
