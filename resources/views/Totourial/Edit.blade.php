<x-app-layout>
      <h1>CREATE</h1>
      @if ($errors)

      @foreach ($errors->all() as $errors)
              <h6>{{ $errors }}</h6>
          @endforeach
      @endif
      <form action="{{ route('totourial.update',$totourial->id) }}" method="post">
          @csrf
          @method('patch')
          <input type="text" name="title" placeholder="title..." value="{{ $totourial->title }}">
  
          <textarea name="body" cols="30" rows="10">{{ $totourial->body }}</textarea>
  
          <button type="submit">UPDATE</button>
      </form>
  </x-app-layout>
<p>Edit Totourials</p>