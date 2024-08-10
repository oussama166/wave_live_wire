<div class="content">
    <section class="w-full bg-white rounded-lg p-5 space-y-4 font-Mulish">
        <div class="w-full inline-flex justify-end items-center">
            {{--        Add new User button     --}}
            <x-form-button
                tag="link"
                value="Add User"
                custom-class="max-w-[200px] w-full  bg-primary-400 cursor-pointer  hover:bg-transparent hover:border-primary-500 hover:text-primary-500 transition-colors ease-in-out"
            />
        </div>

        <livewire:utils.data-table
            :modelClass="App\Models\User::class"
            :relations="['position', 'contracts','experienceLevel']"
            :conditions="[]"
            :orderBy="'hiring_date'"
            :sortDirection="'desc'"
            :headers="['User', 'Phone Number', 'Position', 'Contract', 'Salary']"
            :actionOn="true"
            :extract_key="['name', 'lastname', 'role', 'phone', 'position' ,'experienceLevel','contracts','salary']"
        />
    </section>
</div>
