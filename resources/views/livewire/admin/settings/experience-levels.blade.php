<div class="content">
    <section
        class="inline-flex items-start justify-start w-full gap-10 p-8 bg-white border border-gray-300 shadow-lg flex-nowrap rounded-xl font-Inter">
        <aside class="max-w-[calc(100%-60%)] w-full rounded-lg overflow-hidden border border-wave-secondary/80">
            <div id="settingTitle" class="p-5 text-center text-white bg-primary-700 ">
                <h1>All the experience levels</h1>
            </div>
            <ul class="flex-col w-full divide-y divide-wave-secondary/80">
                @forelse($experienceLevels as $exp)
                <li class="w-full py-5 text-center" id="{{$exp['id']}}">
                    <div class="relative w-full">
                        {{$exp['label']}}

                        <div
                            class="max-w-[80px] w-full absolute right-2 top-full -translate-y-full cursor-pointer inline-flex items-center gap-1">
                            <div class="w-6 h-6 text-primary-500"
                                @click="$dispatch('changeDataExperience',{id:'{{$exp['id']}}'})">
                                <x-eos-mode-edit-o />
                            </div>
                            <hr class="w-6 h-0.5 bg-primary500/40 rotate-90" />
                            <div class="w-6 h-6 text-primary-500"
                                @click="$dispatch('deleteDataExperience',{id:'{{$exp['id']}}'})">
                                <x-eos-delete-outline-o />
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
                <h1 class="text-2xl uppercase text-primary-500">New Experience levels or Modified the existing one</h1>
            </div>
            <form wire:submit.prevent="updateContractType" class="space-y-5">
                @csrf
                <x-form-input name="label" id="label" title="Label of the experience level"
                    placeholder="Insert label of for this experience levels" input-type="text"
                    labelStyle="text-wave-500" labelStyle="text-primary-700" formStyle="max-w-full w-full"
                    :label-on="true" form-style="flex-shrink-0 max-w-lg w-full " :set-disable="false" />

                <x-form-input name="description" id="description" title="Description"
                    placeholder="Insert small description about this experience level" labelStyle="text-primary-700"
                    formStyle="max-w-full w-full" input-type="textArea" :label-on="true"
                    form-style="flex-shrink-0 max-w-lg w-full" :set-disable="false" />

                <div class="inline-flex items-center justify-center w-full">
                    <x-form-button type="submit" value="Submit"
                        custom-class="max-w-[200px] w-full  bg-primary-400 cursor-pointer  hover:bg-transparent hover:border-primary-500 hover:text-primary-500 transition-colors ease-in-out" />
                </div>
            </form>
        </aside>

    </section>
</div>
