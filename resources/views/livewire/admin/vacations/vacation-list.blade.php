<div class="content">
    <section class="w-full p-5 space-y-4 bg-white rounded-lg font-Mulish">
        <div class="inline-flex items-center justify-end w-full">
            {{-- Add new User button --}}
            <x-form-button
                value="Create vacation"
                custom-class="max-w-[200px] w-full  bg-primary-400 cursor-pointer  hover:bg-transparent hover:border-primary-500 hover:text-primary-500 transition-colors ease-in-out"
                tag="link"
                href="/admin/vacationRequest/create"

            />
        </div>

        <livewire:utils.data-table
            type="dynamic" :modelClass="App\Models\Leaves::class"
            :relations="['User', 'leaveStatus']"
            :orderBy="'start_at'" :sortDirection="'desc'"
            :headers="['User name','Start Date', 'End Date','Duration', 'Status']"
            :actionOn="false"
            :extract_key="[['user'=>['lastname','name']],'start_at', 'end_at','leaves_days', ['leaveStatus'=>'label']]"
            :searchOn="true"
            :pagination-area="true" :holidayCounter="true"/>
    </section>
</div>
