<x-app-layout>
    <div class="w-full h-44 grid grid-cols-4 px-4">
        @foreach ($totourials as $totourial)
            <div class="bg-white rounded-md p-2 border-4">
                <a href="{{ route('totourial.show', $totourial->id) }}"
                    class="block text-center no-underline text-blue-500 hover:underline hover:text-red-500">
                    {{ $totourial->title }}
                </a>
                <h6 class="leading-loose text-center">
                    {{ Illuminate\Support\Str::limit($totourial->body, 130) }}
                </h6>
                @can('delete',$totourial)
                    <footer class="pt-2">
                        <form action="{{ route('totourial.destroy', $totourial->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <div class="items-center ml-28">
                                <button class="rounded-md bg-red-600 text-white p-2">Delete</button>
                            </div>
                        </form>
                    </footer>
                @endcan
            </div>
        @endforeach


    </div>
</x-app-layout>
