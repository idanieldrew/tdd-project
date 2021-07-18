<x-app-layout>
    <div class="w-full h-full grid grid-cols-5 px-4">
        <div class="bg-white rounded-md p-2 border-4 col-span-3">
            <a href="{{ route('totourial.show', $totourial->id) }}"
                class="block text-center text-blue-200 underline hover:text-red-500">
                {{ $totourial->title }}
            </a>
            <h6 class="leading-loose text-center">
                {!! $totourial->body !!}
            </h6>
        </div>
        <div class="bg-blue-100 h-full rounded-md p-2 border-4 col-span-2">
            <form action="{{ route('task.store', $totourial->id) }}" method="POST">
                @csrf
                <div class="flex">
                    <div>
                        <input name="body" type="text" placeholder="add task to totourial ..."
                            class="bg-transparent px-2 py-2 mx-auto text-black border-0 rounded-lg focus:text-red-500 focus:bg-white">
                    </div>
                    <div class="pl-24">
                        <button type="submit"
                            class="bg-blue-600 px-2 py-2  hover:bg-blue-700 rounded-lg text-white">Submit</button>
                    </div>
                </div>
            </form>
            @foreach ($totourial->tasks as $task)
                {{ $task->body }}
            @endforeach
        </div>

    </div>
</x-app-layout>
