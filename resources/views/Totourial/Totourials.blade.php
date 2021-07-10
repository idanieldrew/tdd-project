@extends('layouts.app')
@section('content')
    <div class="w-full h-44 grid grid-cols-4 px-4">
        @foreach($posts as $post)
        <div class="bg-white rounded-md p-2 border-4">
            <a href="{{ route('post.show', $post->id) }}"
                class="block text-center text-blue-200 underline hover:text-red-500">
                {{ $post->title }}
            </a>
            <h6 class="leading-loose text-center">
                {{ Illuminate\Support\Str::limit($post->body, 130) }}
            </h6>
        </div>
        @endforeach

  
    </div>
@endsection
