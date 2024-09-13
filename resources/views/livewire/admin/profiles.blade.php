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
            <x-form-button tag='link' value="Upload from XLSX"
                custom-class="max-w-[200px] w-full  bg-primary-400 cursor-pointer  hover:bg-transparent hover:border-primary-500 hover:text-primary-500 transition-colors ease-in-out"
                href="/admin/users/upload" />
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
