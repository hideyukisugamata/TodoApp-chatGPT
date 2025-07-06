@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Todoリスト</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">＋ 新規作成</a>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach ($tasks as $task)
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            @if ($task->done)
                                <span class="badge bg-success">完了</span>
                            @else
                                <span class="badge bg-warning text-dark">未完了</span>
                            @endif
                            {{ $task->title }}
                        </h5>
                        <p class="card-text">{{ $task->description }}</p>
                        <p class="text-muted mb-0" style="font-size: 0.9em;">
                            作成日時: {{ $task->created_at->timezone('Asia/Tokyo')->format('Y-m-d H:i') }}<br>
                            更新日時: {{ $task->updated_at->timezone('Asia/Tokyo')->format('Y-m-d H:i') }}
                        </p>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-secondary">編集</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('削除しますか？')">削除</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
