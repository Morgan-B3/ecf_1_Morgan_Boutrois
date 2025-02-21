<x-layout>
    <x-slot:heading>
        Modifier {{$sport->name}}
    </x-slot:heading>

    <form method="post" action="/sports/{{ $sport->id }}">
        @csrf
        @method('PATCH')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="name" class="block text-sm/6 font-medium text-gray-900">Intitulé</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <div class="shrink-0 text-base text-gray-500 select-none sm:text-sm/6"></div>
                                <input type="text" name="name" id="name" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" placeholder="Nom du sport" value="{{ $sport->name }}">
                            </div>
                            @error('name')
                            <p class="text-red-500 text-xs font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="description" class="block text-sm/6 font-medium text-gray-900">Description</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <div class="shrink-0 text-base text-gray-500 select-none sm:text-sm/6"></div>
                                <textarea type="text" name="description" id="description" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" placeholder="Un super sport ! :)"  value="{{ $sport->description }}" >{{ $sport->description }}</textarea>
                            </div>
                            @error('description')
                            <p class="text-red-500 text-xs font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                </div>

                @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="text-red-500 italic">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">

            <button form="delete-form" class="text-red-500 text-sm font-bold">Supprimer</button>
            <a class="text-sm/6 font-semibold text-gray-900" href="/sport/{{$sport->id}}">Annuler</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>

    <form method="POST">
        @csrf
        @method('PATCH')
        <div class="">
            <label class="block text-sm/6 font-medium text-gray-900">Créneaux affichés</label>
            @foreach ($sport->timeslots as $timeslot )
            <div class="flex items-center gap-5 py-1.5">
                <input type="time" name="starts_at" id="starts_at" class="block min-w-0  py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" value="{{ $timeslot->starts_at }}">
                <input type="time" name="ends_at" id="ends_at" class="block min-w-0 py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" value="{{ $timeslot->ends_at }}">
                <p>{{($timeslot->capacity - $timeslot->bookings->count())}}/{{$timeslot->capacity}} places</p>
                <a class="text-red-500 text-sm font-bold" href="/timeslot/{{$timeslot->id}}/destroy">Supprimer</a>
            </div>
            <a href="/timeslot/create"></a>
            @endforeach
        </div>
    </form>

    <form method="POST" action="/sports/{{$sport->id}}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>

</x-layout>
