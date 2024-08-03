<div class="content">
    <livewire:utils.table :modelClass="App\Models\Leaves::class" :relations="['User', 'VacationType', 'LeaveStatus']" :conditions="[['user_id', Auth::id()]]" :orderBy="'end_at'" :sortDirection="'desc'"
        :perPage="3" :headers="['Start date', 'End date', 'Type', 'State', 'Duration']" :extract_key="['start_at', 'end_at', 'vacation_type_id', 'leave_status_id', 'Duration']" />
</div>
