@extends('layouts.app')

@section('content')
    <h1 class="mb-4">タスク作成</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">タイトル</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">説明</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="done" value="1">
            <label class="form-check-label">完了</label>
        </div>
        <button type="submit" class="btn btn-success">登録</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">戻る</a>
    </form>
@endsection
