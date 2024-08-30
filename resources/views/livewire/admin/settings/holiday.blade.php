<div class="content">
    <section
        class="inline-flex items-start justify-start w-full gap-10 p-8 bg-white border border-gray-300 shadow-lg flex-nowrap rounded-xl font-Inter">
        <aside class="max-w-[calc(100%-50%)] w-full rounded-lg overflow-hidden border border-wave-secondary/80">
            <div id="settingTitle" class="p-5 text-center text-white bg-primary-700 ">
                <h1>Holidays add for this year</h1>
            </div>
            <ul class="flex-col w-full divide-y divide-wave-secondary/80">
                @forelse($Holidays as $holiday)
                <li class="w-full py-5 text-center" id="{{$holiday['id']}}">
                    <div class="relative w-full">
                        {{$holiday['name']}}

                        @if($holiday['status'] == "religious" && $holiday['date'] == '')
                        <span class="italic text-wave-disable">
                            (Cal religious)
                        </span>
                        @else
                        <span class="italic text-wave-disable">
                            ({{$holiday['date']}})
                        </span>
                        @endif

                        <div
                            class="max-w-[80px] w-full absolute right-1 top-full -translate-y-full cursor-pointer inline-flex items-center justify-end">
                            <div class="w-6 h-6 text-primary-500"
                                @click="$dispatch('changeDataHoliday',{id:'{{$holiday['id']}}'})">
                                <x-eos-mode-edit-o />
                            </div>
                            <hr class="w-6 h-0.5 bg-primary500/40 rotate-90" />
                            <div class="w-6 h-6 text-primary-500"
                                @click="$dispatch('deleteDataHoliday',{id:'{{$holiday['id']}}'})">
                                <x-eos-delete-outline-o />
                            </div>

                        </div>
                    </div>
                </li>
                @empty
                <li class="w-full py-5 text-center">No items added</li>
                @endforelse
            </ul>

        </aside>
        <aside class="w-max-[50%] w-full space-y-5">

            <div>
                <h1 class="text-2xl uppercase text-primary-500">Add new holiday date or modified one</h1>
            </div>
            <form wire:submit="updateHoliday" class="space-y-5">
                @csrf
                <input type="hidden" wire:model="id" />
                <div class="inline-flex gap-5">
                    <x-form-input name="holidayName" id="holidayName" title="Name of the holiday"
                        placeholder="Insert the name of the holiday" input-type="text" labelStyle="text-wave-500"
                        form-style="max-w-[250px] w-full" labelStyle="text-primary-700" :label-on="true"
                        :set-disable="false" />
                    <x-form-input name="dateHoliday" id="dateHoliday" title="Date of  the holiday"
                        placeholder="Insert the date of the holiday" input-type="datePicker"
                        labelStyle="text-primary-700" form-style="w-full" :label-on="true" :set-disable="false"
                        :sub-max="-5" :sub-min="3" />
                </div>

                <x-form-input name="holidayDayNumber" id="holidayDayNumber" title="Number of day the holiday"
                    placeholder="Insert the how much day" input-type="number" labelStyle="text-wave-500"
                    form-style="max-w-[500px] w-full" labelStyle="text-primary-700" :label-on="true"
                    :set-disable="false" />
                <div class="flex-col items-center justify-center w-max-[250px]">
                    <label for="isReligious" class="w-full text-sm font-medium ms-2 text-wave-500">Is religious
                        event</label>
                    <input checked id="isReligious" type="checkbox" wire:model="isReligious"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                </div>


                <div class="inline-flex items-center justify-center w-full">
                    <x-form-button type="submit" value="Submit"
                        custom-class="max-w-[200px] w-full  bg-primary-400 cursor-pointer  hover:bg-transparent hover:border-primary-500 hover:text-primary-500 transition-colors ease-in-out" />
                </div>
            </form>
        </aside>

    </section>
</div>
