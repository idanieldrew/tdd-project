<x-app-layout>
    <div>
    <div class="w-full flex justify-end">
        @foreach ($invite as $invite)
        <div class="p-3">
            <img class="w-10 h-10 rounded-full" src="{{ asset($invite->avatar) }}" alt="{{ $invite->name }}">
        </div>
        @endforeach
    </div>
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
                            class="bg-transparent ring-2 ring-black px-2 py-2 mx-auto text-black border-0 rounded-lg focus:text-red-500 focus:bg-white">
                    </div>
                    <div class="pl-24">
                        <button type="submit"
                            class="bg-blue-600 px-2 py-2  hover:bg-blue-700 rounded-lg text-white">Submit</button>
                    </div>
                </div>
            </form>
            @foreach ($tasks as $task)
                <form action="{{ route('task.update', [$totourial->id, $task->id]) }}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="flex py-2">
                        <div>
                            <input name="body" type="text" value="{{ $task->body }}" placeholder="{{ $task->body }}"
                                class="bg-white px-2 py-2 mx-auto text-black ring-1 shadow-lg ring-yellow-400 border-0 rounded-lg focus:text-red-500 focus:bg-white">
                        </div>
                        <div class="pl-24">
                            <input type="checkbox" class="ring-1" name="complete" onchange="this.form.submit()"
                                {{ $task->complete ? 'checked' : '' }}>
                        </div>
                    </div>
                </form>
            @endforeach
        </div>
    </div>
    @can('view',$totourial)
    <div class="flex text-center justify-center space-x-10">
        <div class="w-2/8 px-4">
            <div class="text-center py-5">
                @if ($errors)
                    <div>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
            <form action="{{ route('totourial.update', $totourial->id) }}" method="POST">
                @csrf
                @method('patch')
                <div>
                    <textarea class="w-full" name="tips" cols="15" rows="5"
                        placeholder="TIPS">{{ $totourial->tips }}</textarea>
                    <div>
                        <button class="p-2 bg-yellow-400 hover:bg-yellow-600 text-black rounded-md"
                            type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="bg-gray-200 mt-5 rounded-lg w-3/12">
            @foreach ($activities_Task as $activity)
                <p>
                    <h1>s</h1>
                    {{ $activity->title }}
                    {{ \Carbon\Carbon::createFromTimeStamp(strtotime($activity->created_at))->diffForHumans() }}
                </p>
            @endforeach
            @foreach ($activities_Totourial as $active)
                <p>
                    {{ $active->title }}
                    {{ \Carbon\Carbon::createFromTimeStamp(strtotime($activity->updated_at))->diffForHumans() }}
                </p>
            @endforeach
        </div>
        <div class="h-28 bg-gray-300 mt-5 rounded-md w-3/12">
            @foreach ($totourial->activities as $active)
                <p>
                    {{ $active->title }}
                    {{ \Carbon\Carbon::createFromTimeStamp(strtotime($activity->created_at))->diffForHumans() }}
                </p>
            @endforeach
        </div>
        <div class="mt-5 w-4/12 bg-blue-100 h-28 px-4 py-2">
            <form action="{{ route('invite',$totourial->id) }}" method="POST">
                @csrf
                <div>
                    <input type="text" class="w-full rounded-lg" name="mail" id="" placeholder="Invite Friends :)">
                </div>
                <div class="mt-2">
                    <button type="submit" class="p-2 rounded-lg bg-blue-500">Invite</button>
                </div>
            </form>
        </div>
    </div>
    @endcan
</div>
</x-app-layout>
