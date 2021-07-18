<x-app-layout>
    <div class="w-full h-44 grid grid-cols-4 px-4">
        @foreach ($totourials as $totourial)
            <div class="bg-white rounded-md p-2 border-4">
                <a href="{{ route('totourial.show', $totourial->id) }}"
                    class="block text-center text-blue-200 underline hover:text-red-500">
                    {{ $totourial->title }}
                </a>
                <h6 class="leading-loose text-center">
                    {{ Illuminate\Support\Str::limit($totourial->body, 130) }}
                </h6>
            </div>
        @endforeach


    </div>
</x-app-layout>
