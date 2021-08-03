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
                <form action="{{ route('task.update', [$totourial->id, $task->id]) }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="flex py-2">
                        <div>
                            <input name="body" type="text" value="{{ $task->body }}" placeholder="{{ $task->body }}"
                                class="bg-white px-2 py-2 mx-auto text-black border-0 rounded-lg focus:text-red-500 focus:bg-white">
                        </div>
                        <div class="pl-24">
                            <input type="checkbox" name="complete" onchange="this.form.submit()"
                                {{ $task->complete ? 'checked' : '' }} }}>
                        </div>
                    </div>
                </form>
                
            </div>
            @endforeach
            <div class="block w-full text-center py-10">
                <div>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
                <form action="{{ route('totourial.update',$totourial->id) }}" method="POST">
                @csrf
                @method('patch')
                <div>
                    <textarea name="tips" cols="15" rows="5" placeholder="TIPS">{{ $totourial->tips }}</textarea>
                </div>
                <div class="p-1">
                    <p>Add Tips</p>
                    <button class="p-2 bg-yellow-400 hover:bg-yellow-600 text-black rounded-md" type="submit">Save</button>
                </div>
                </form>
        </div>
    </div>
 
</x-app-layout>
