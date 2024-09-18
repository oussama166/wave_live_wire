<div class="content">
    <section class="w-full p-5 space-y-4 bg-white rounded-lg font-Mulish">
        <div class="inline-flex items-center justify-end w-full gap-5">
            {{-- Add users from xlsx file --}}
            <form action="/admin/export/users" method="POST" class="max-w-[300px] w-full">
                @csrf
                @method('POST')
                <x-form-button type='submit' value="Download Users list XLSX"
                    custom-class="max-w-[300px] w-full  bg-primary-400 cursor-pointer  hover:bg-transparent hover:border-primary-500 hover:text-primary-500 transition-colors ease-in-out" />
            </form>

            <x-modal title="Upload List of users">
                <x-slot name="trigger">
                    <x-form-button tag='link' value="Upload from XLSX"
                        custom-class="max-w-[200px] w-full  bg-primary-400 cursor-pointer  hover:bg-transparent hover:border-primary-500 hover:text-primary-500 transition-colors ease-in-out"
                        @click="modalOpen = true" />

                </x-slot>
                <x-slot name="body">
                    <div class="flex flex-row flex-wrap gap-5 content">
                        <form method="post" action="{{ route('Admin.ImportUsers') }}" enctype="multipart/form-data">
                            @csrf
                            <section class="flex flex-wrap items-center justify-center w-full gap-5 p-8 bg-white">
                                <div class="w-full min-w-full">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        for="file_input">
                                        Please upload the xlsx users files
                                    </label>
                                    <input
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        aria-describedby="file_input_help" id="file_input" name="file_input"
                                        type="file">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">xlsx,
                                        xls</p>
                                    <x-form-button type="submit" value="Upload"
                                        custom-class="max-w-[200px] w-full bg-primary-400 cursor-pointer hover:bg-transparent hover:border-primary-500 hover:text-primary-500 transition-colors ease-in-out" />
                                </div>
                            </section>
                        </form>
                    </div>

                </x-slot>
            </x-modal>
            {{-- Add new User button --}}
            <x-form-button tag='link' value="Add User"
                custom-class="max-w-[200px] w-full  bg-primary-400 cursor-pointer  hover:bg-transparent hover:border-primary-500 hover:text-primary-500 transition-colors ease-in-out"
                href="/admin/users/create" />
        </div>

        <livewire:utils.data-table type="static" :modelClass="App\Models\User::class"
            :relations="['position', 'contracts', 'experienceLevel']" :conditions="[]" :orderBy="'hiring_date'"
            :sortDirection="'desc'" :headers="['User', 'Phone Number', 'Position', 'Contract', 'Salary']"
            :actionOn="true"
            :extract_key="['name', 'lastname', 'role', 'phone', 'position', 'experienceLevel', 'contracts', 'salary']"
            :searchOn="true" :pagination-area="true" />
    </section>
</div>
