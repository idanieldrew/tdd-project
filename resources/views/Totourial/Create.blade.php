<x-app-layout>
    <h1>CREATE</h1>
    @if ($errors)

        @foreach ($errors->all() as $errors)
            <h6>{{ $errors }}</h6>
        @endforeach
    @endif
    <form action="{{ route('totourial.store') }}" method="post">
        @csrf
        <input type="text" name="title" placeholder="title...">

        <textarea name="body" cols="30" rows="10"></textarea>

        <button type="submit">OKKKKKKK</button>
    </form>
</x-app-layout>