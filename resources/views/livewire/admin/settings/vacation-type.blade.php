<div class="content">
    <section
        class="inline-flex flex-nowrap items-start justify-start w-full gap-10 p-8 bg-white border border-gray-300 shadow-lg rounded-xl font-Inter">
        <aside class="max-w-[calc(100%-60%)] w-full rounded-lg overflow-hidden border border-wave-secondary/80">
            <div id="settingTitle" class="bg-primary-700 text-white p-5 text-center ">
                <h1>All the vacations types</h1>
            </div>
            <ul class="w-full flex-col  divide-y divide-wave-secondary/80">
                @forelse($vacationTypes as $vacation)
                    <li
                        class="w-full text-center py-5"
                        id="{{$vacation['id']}}"
                    >
                        <div class="w-full relative">
                            <div class="w-4 h-4 rounded-full absolute left-10 top-full -translate-y-full"
                                 style="background-color: {{$vacation['bgColor']}};"></div>
                            {{$vacation['label']}}

                            <div
                                class="max-w-[80px] w-full absolute right-2 top-full -translate-y-full cursor-pointer inline-flex items-center gap-1"
                            >
                                <div class="w-6 h-6 text-primary-500"

                                     @click="$dispatch('changeData',{id:'{{$vacation['id']}}'})"
                                >
                                    <x-eos-mode-edit-o/>
                                </div>
                                <hr class="w-6 h-0.5 bg-primary500/40 rotate-90"/>
                                <div class="w-6 h-6 text-primary-500"
                                     @click="$dispatch('deleteData',{id:'{{$vacation['id']}}'})"
                                >
                                    <x-eos-delete-outline-o/>
                                </div>

                            </div>
                        </div>
                    </li>
                @empty
                    <li>No items added</li>
                @endforelse
            </ul>

        </aside>
        <aside class="w-max-[50%] w-full space-y-5">

            <div>
                <h1 class="text-2xl text-primary-500 uppercase">New vacation type or Modified the existing one</h1>
            </div>
            <form wire:submit.prevent="updateContractType" class="space-y-5">
                @csrf
                <div class="inline-flex gap-3">

                    <x-form-input
                        name="label" id="label" title="Vacation Type"
                        placeholder="Insert label of for this vacation type" input-type="text"
                        labelStyle="text-wave-500"
                        labelStyle="text-primary-700"
                        form-style="flex-shrink-0 max-w-[300px] w-full"
                        :label-on="true"
                        :set-disable="false"
                    />
                    <x-form-input
                        name="duration" id="duration" title="Max Leave Duration"
                        placeholder="e.g., 30 days" input-type="number"
                        labelStyle="text-wave-500"
                        labelStyle="text-primary-700"
                        form-style="flex-shrink-0 max-w-[300px] w-full"
                        :label-on="true"
                        :set-disable="false"
                    />
                </div>
                <div class="inline-flex gap-3">
                    <x-form-input
                        name="reduction" id="reduction" title="Vacation Reduction Percentage"
                        placeholder="e.g., 15%" input-type="number"
                        labelStyle="text-wave-500"
                        labelStyle="text-primary-700"
                        form-style="flex-shrink-0 max-w-[300px] w-full"
                        :label-on="true"
                        :set-disable="false"
                    />
                    <x-form-input
                        name="color" id="color" title="Calendar Color for Vacation"
                        placeholder="This color is will be refer to this vacation in calendar" input-type="colorPicker"
                        labelStyle="text-wave-500"
                        labelStyle="text-primary-700"
                        form-style="flex-shrink-0 max-w-[300px] w-full"
                        input-style="h-[46px]"
                        :label-on="true"
                        :set-disable="false"
                    />
                </div>

                <x-form-input
                    name="description" id="description" title="Description"
                    placeholder="Insert small description about this experience level"
                    labelStyle="text-primary-700"
                    form-style="flex-shrink-0 w-full"
                    input-type="textArea" :label-on="true"
                    :set-disable="false"
                />

                <div class="flex-col items-center justify-center w-max-[250px]">
                    <input checked
                           id="isPaid"
                           type="checkbox"
                           wire:model="isPaid"
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                    />
                    <label for="isPaid" class="w-full ms-2 text-sm font-medium text-wave-500">Is paid vacation type</label>
                </div>

                <div class="w-full inline-flex justify-center items-center">
                    <x-form-button
                        type="submit"
                        value="Submit"
                        custom-class="max-w-[200px] w-full  bg-primary-400 cursor-pointer  hover:bg-transparent hover:border-primary-500 hover:text-primary-500 transition-colors ease-in-out"
                    />
                </div>
            </form>
        </aside>

    </section>
</div>
