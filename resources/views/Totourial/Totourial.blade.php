{{ $totourial->title }}
{{ $totourial->body }}

@foreach ($totourial->tasks as $task)
    {{ $task->body }}
@endforeach
