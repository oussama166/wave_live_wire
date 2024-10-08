<div class="content">
    <section
        class="inline-flex flex-nowrap items-start justify-start w-full gap-10 p-8 bg-white border border-gray-300 shadow-lg rounded-xl font-Inter">
        <aside class="max-w-[calc(100%-60%)] w-full rounded-lg overflow-hidden border border-wave-secondary/80">
            <div id="settingTitle" class="bg-primary-700 text-white p-5 text-center ">
                <h1>All the Family status</h1>
            </div>
            <ul class="w-full flex-col  divide-y divide-wave-secondary/80">
                @forelse($familyStatus as $stat)
                    <li
                        class="w-full text-center py-5"
                        id="{{$stat['id']}}"
                    >
                        <div class="w-full relative">
                            {{$stat['label']}}

                            <div
                                class="max-w-[80px] w-full absolute right-2 top-full -translate-y-full cursor-pointer inline-flex items-center gap-1"
                            >
                                <div class="w-6 h-6 text-primary-500"

                                     @click="$dispatch('changeData',{id:'{{$stat['id']}}'})"
                                >
                                    <x-eos-mode-edit-o />
                                </div>
                                <hr class="w-6 h-0.5 bg-primary500/40 rotate-90"/>
                                <div class="w-6 h-6 text-primary-500"
                                     @click="$dispatch('deleteData',{id:'{{$stat['id']}}'})"
                                >
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
                <h1 class="text-2xl text-primary-500 uppercase">New Family status or Modified the existing one</h1>
            </div>
            <form wire:submit.prevent="updateContractType" class="space-y-5">
                @csrf
                <x-form-input
                    name="label" id="label" title="Name of the family status"
                    placeholder="Insert the name of the family status" input-type="text"
                    labelStyle="text-wave-500"
                    labelStyle="text-primary-700"
                    formStyle="max-w-full w-full"
                    :label-on="true" form-style="flex-shrink-0 max-w-lg w-full "
                    :set-disable="false"
                />

                <x-form-input
                    name="description" id="description" title="Description"
                    placeholder="Insert small description about this contract type"
                    labelStyle="text-primary-700"
                    formStyle="max-w-full w-full"
                    input-type="textArea" :label-on="true" form-style="flex-shrink-0 max-w-lg w-full"
                    :set-disable="false"
                />

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
