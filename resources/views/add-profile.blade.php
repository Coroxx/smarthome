@extends('layouts.header')

@section('title', 'Ajouter un profil')



@section('content')
    <div class="pb-4">
        @if (session('success') || $errors->any())
            <div class="w-9/12 m-auto mb-4 @if (session('success')) bg-green-600  @else bg-red-500 @endif rounded">
                <p class="font-bold text-lg text-center text-white">
                    @if (session('success')) {{ session('success') }}
                    @elseif($errors->any()) {{ $errors->first() }} @endif
                </p>
            </div>
        @endif

        <div class="w-11/12 h-auto pb-4 m-auto text-center text-white bg-gray-800 rounded lg:text-lg lg:w-9/12">
            <form action="{{ route('device.profile.add') }}" method="POST">
                @csrf

                <h2 class="py-2 text-2xl font-bold">Ajouter une automatisation</h2>

                <div class="py-2 font-semibold">
                    <p class="lg:inline">Sur quel appareil :</p>
                    <select required name="id"
                        class="px-2 py-1 m-auto my-2 bg-gray-600 rounded outline-none appearance-none lg:py-0 lg:my-0 focus:outline-none">
                        <option value="" selected>- Selectionner un appareil -</option>
                        @foreach ($devices as $device)
                            <option value="{{ $device->id }}">{{ $device->name }}</option>
                        @endforeach
                    </select>
                    @error('id')
                        <div class="py-2 text-center">
                            <p class="text-red-500">{{ $message }}</p>
                        </div>
                    @enderror
                    <br>
                </div>
                <div class="py-2 mt-4 font-semibold">
                    <label for="action">Type d'action : </label>
                    <select required name="action"
                        class="px-2 py-1 m-auto my-2 bg-gray-600 rounded outline-none appearance-none lg:py-0 lg:my-0 focus:outline-none id="
                        action">
                        <option value="1">Allumer</option>
                        <option value="0">Eteindre</option>
                    </select>
                    @error('action')
                        <div class="py-2 text-center">
                            <p class="text-red-500">{{ $message }}</p>
                        </div>
                    @enderror
                </div>

                <div id="time" class="mt-12 font-semibold">
                    <label for="time_select">Quand ? </label>
                    <select required name="time_select"
                        class="px-2 py-1 m-auto my-2 bg-gray-600 rounded outline-none appearance-none lg:py-0 lg:my-0 focus:outline-none"
                        id="time_select">
                        <option value="00:00">00:00</option>
                        <option value="00:30">00:30</option>
                        <option value="01:00">1:00</option>
                        <option value="01:30">1:30</option>
                        <option value="02:00">2:00</option>
                        <option value="02:30">2:30</option>
                        <option value="03:00">3:00</option>
                        <option value="03:30">3:30</option>
                        <option value="04:00">4:00</option>
                        <option value="04:30">4:30</option>
                        <option value="05:00">5:00</option>
                        <option value="05:30">5:30</option>
                        <option value="06:00">6:00</option>
                        <option value="06:30">6:30</option>
                        <option value="07:00">7:00</option>
                        <option value="07:30">7:30</option>
                        <option value="08:00">8:00</option>
                        <option value="08:30">8:30</option>
                        <option value="09:00">9:00</option>
                        <option value="09:30">9:30</option>
                        <option value="10:00">10:00</option>
                        <option value="10:30">10:30</option>
                        <option value="11:00">11:00</option>
                        <option value="11:30">11:30</option>
                        <option value="12:00">12:00</option>
                        <option value="12:30">12:30</option>
                        <option value="13:00">13:00</option>
                        <option value="13:30">13:30</option>
                        <option value="14:00">14:00</option>
                        <option value="14:30">14:30</option>
                        <option value="15:00">15:00</option>
                        <option value="15:30">15:30</option>
                        <option value="16:00">16:00</option>
                        <option value="16:30">16:30</option>
                        <option value="17:00">17:00</option>
                        <option value="17:30">17:30</option>
                        <option value="18:00">18:00</option>
                        <option value="18:30">18:30</option>
                        <option value="19:00">19:00</option>
                        <option value="19:30">19:30</option>
                        <option value="20:00">20:00</option>
                        <option value="20:30">20:30</option>
                        <option value="21:00">21:00</option>
                        <option value="21:30">21:30</option>
                        <option value="22:00">22:00</option>
                        <option value="22:30">22:30</option>
                        <option value="23:00">23:00</option>
                        <option value="23:30">23:30</option>
                    </select>
                    @error('time_select')
                        <div class="py-2 text-center">
                            <p class="text-red-500">{{ $message }}</p>
                        </div>
                    @enderror
                    <br>
                    <br>
                    <label for="monday">Lundi</label>
                    <input type="checkbox" class="checked:bg-blue-600 rounded checked:border-transparent text-gray-600"
                        id="monday" style="position : relative ; top : 0.5px" name="Monday">
                    <label for="Tuesday">Mardi</label>
                    <input type="checkbox" class="checked:bg-blue-600 rounded checked:border-transparent text-gray-600"
                        id="Tuesday" style="position : relative ; top : 0.5px" name="Tuesday">
                    <label for="Wednesday">Mercredi</label>
                    <input type="checkbox" class="checked:bg-blue-600 rounded checked:border-transparent text-gray-600"
                        id="Wednesday" style="position : relative ; top : 0.5px" name="Wednesday">
                    <label for="Thursday">Jeudi</label>
                    <input type="checkbox" class="checked:bg-blue-600 rounded checked:border-transparent text-gray-600"
                        id="Thursday" style="position : relative ; top : 0.5px" name="Thursday">
                    <label for="Friday">Vendredi</label>
                    <input type="checkbox" class="checked:bg-blue-600 rounded checked:border-transparent text-gray-600"
                        id="Friday" style="position : relative ; top : 0.5px" name="Friday">
                    <label for="Saturday">Samedi</label>
                    <input type="checkbox" class="checked:bg-blue-600 rounded checked:border-transparent text-gray-600"
                        id="Saturday" style="position : relative ; top : 0.5px" name="Saturday">
                    <label for="Sunday">Samedi</label>
                    <input type="checkbox" class="checked:bg-blue-600 rounded checked:border-transparent text-gray-600"
                        id="Sunday" style="position : relative ; top : 0.5px" name="Sunday">
                </div>

                <div class="pb-3 mt-6 text-lg">
                    <input type="submit" value="Ajouter" class="px-4 py-1 bg-gray-600 rounded cursor-pointer">
                </div>

            </form>
        </div>
        <div class="w-9/12 m-auto mt-3">
            <div class="pl-2.5 mt-2 w-full mb-12">
                <label class="flex items-center cursor-pointer">
                    <div class="relative">
                        <input type="checkbox" onclick="vacationMode(this)" @if ($vacationMode) checked @endif class="sr-only" />
                        <div class="w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow dot -left-1 -top-1">
                        </div>
                    </div>

                    <div class="ml-3 text-lg font-bold text-white">
                        Mode vacance<svg xmlns="http://www.w3.org/2000/svg" class="inline-flex ml-1.5 -mt-1.5 h-6 w-6"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </div>
            </div>
        </div>

        <div class="-mt-6">
            @foreach ($tasks as $task)
                <div class="w-9/12 rounded text-white h-auto m-auto my-4 bg-gray-800">
                    <div>
                        <p class="px-2 text-lg py-2">{{ $task->device_name }}</p>
                        <p class="px-2 ml-0.5 inline font-bold @if ($task->action == '1') text-green-500
                        @else
                            text-red-500 @endif">
                        @if ($task->action == '1') Allumer à @else Éteindre
                                à
                                @endif {{ $task->date }} @if (strlen($task->days) == 50)
                                    Toute la semaine @else le @if (stristr($task->days, 'Monday')) Lundi @endif @if (stristr($task->days, 'Tuesday')) Mardi
                                            @endif @if (stristr($task->days, 'Wednesday'))
                                                Mercredi
                                            @endif
                                            @if (stristr($task->days, 'Thursday'))
                                                Jeudi
                                                @endif @if (stristr($task->days, 'Friday'))
                                                    Vendredi @endif @if (stristr($task->days, 'Saturday')) Samedi
                                                    @endif
                                                    @if (stristr($task->days, 'Sunday'))
                                                        Dimanche
                                                    @endif
                                                @endif
                        </p>
                        <div onclick="deleteTask(this)" data-id="{{ $task->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="inline float-right relative right-1 cursor-pointer -top-6 h-5 w-5"
                                viewBox="0 0 20 20" fill="red">
                                <path fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="pb-1"></div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        let url = window.location.href.match('^(?:https?:\/\/)?(?:[^@\n]+@)?(?:www\.)?([^:\/\n?]+)')[0]

        function deleteTask(e) {
            let r = confirm('Souhaitez-vous vraiment supprimer cette automatisation ?')
            if (r == true) {
                window.axios.post(url + `/task/delete/${e.dataset.id}`).then((r) => {
                    if (r.status == 200) {
                        VanillaToasts.create({
                            title: 'Opération réussie',
                            positionClass: 'bottomRight',
                            type: 'info',
                            timeout: 3000,
                            text: `Tâche supprimée avec succès, la page va s'actualiser dans quelques secondes...`,
                        });
                        setTimeout(function() {
                            document.location.reload()
                        }, (2500))
                    }
                });
            }
        }


        function vacationMode(e) {

        }
    </script>


@endsection
