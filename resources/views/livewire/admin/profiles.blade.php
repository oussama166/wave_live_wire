<div class="content">
    <section class="w-full p-5 space-y-4 bg-white rounded-lg font-Mulish">
        <div class="inline-flex items-center justify-end w-full">
            {{-- Add new User button --}}
            <x-form-button value="Add User"
                custom-class="max-w-[200px] w-full  bg-primary-400 cursor-pointer  hover:bg-transparent hover:border-primary-500 hover:text-primary-500 transition-colors ease-in-out"
                wire:click="redirectToCreate" />
        </div>

        <livewire:utils.data-table :modelClass="App\Models\User::class"
            :relations="['position', 'contracts', 'experienceLevel']" :conditions="[]" :orderBy="'hiring_date'"
            :sortDirection="'desc'" :headers="['User', 'Phone Number', 'Position', 'Contract', 'Salary']"
            :actionOn="true"
            :extract_key="['name', 'lastname', 'role', 'phone', 'position', 'experienceLevel', 'contracts', 'salary']"
            :searchOn="true" :pagination-area="true" />
    </section>
</div>
