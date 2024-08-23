<div class="content font-Roboto space-y-4">
    <section class="w-full inline-flex justify-between">
        {{--    Salut   --}}
        <div class="space-y-3">
            <h1
                class="text-2xl font-semibold text-wave-primary"
            >{{$salute}}</h1>
            <p
                class="text-sm text-wave-disable"
            >You have {{$pendingRequest}} leave request pending</p>

        </div>
        {{--   Time    --}}
        <div
            class="w-full max-w-xs bg-white rounded-lg py-2 px-6 inline-flex items-center justify-between gap-5 border border-wave-disable/40">
            <div class="space-y-1">
                <p class="text-sm text-wave-disable">Current Time</p>
                <h1 class="text-lg font-normal text-wave-primary">{{date("j M Y, H:i A")}}</h1>
            </div>
            <div class="flex items-center justify-center">
                <x-bi-clock-history class="h-10 w-10 text-wave-primary"/>

            </div>


        </div>
    </section>
    <section class="w-full flex gap-5 flex-wrap">
        <div class="w-[35vw] h-[50vh] bg-white border border-gray-300 rounded-lg p-5 shadow-lg">
            <canvas wire:ignore id="myChart1"></canvas>
        </div>
        <div class="w-[35vw] h-[50vh] bg-white border border-gray-300 rounded-lg shadow-lg overflow-y-auto">
            <h1 class="text-xl font-bold text-primary-600 p-4 bg-white sticky top-0 z-10">
                Upcoming Two-Month Holiday Schedule
            </h1>
            <div class="space-y-4 p-4 pt-0">
                @forelse($dataSetNextHolidays as $holiday)
                    <div class="p-4 bg-gray-50 rounded-lg shadow-sm hover:shadow-md transition-shadow flex justify-between items-center">
                        <div class="max-w-[170px] w-full text-lg font-medium text-gray-800 truncate whitespace-nowrap overflow-hidden">
                            {{$holiday->name}}
                        </div>
                        <div class="text-sm text-gray-600">
                            {{$holiday->date}}
                        </div>
                        <div class="text-sm text-blue-600">
                            {{$holiday->days_number}} Days
                        </div>
                        <div class="text-sm {{$holiday->status === 'national' ? 'text-green-600' : 'text-red-600'}}">
                            {{$holiday->status}}
                        </div>
                    </div>
                @empty
                    <div class="w-full p-4 text-center text-gray-500">
                        No holiday schedule for next month
                    </div>
                @endforelse
            </div>
        </div>


    </section>
</div>


<script>
    document.addEventListener("DOMContentLoaded", () => {


        let ctx1 = document.getElementById('myChart1').getContext('2d');



        // Initialled the first one
        initializeChart(ctx1, {
            labels:@json($dataSet->labels),
            datasets: [{
                label: 'Employer Salary (Average)',
                data: @json($dataSet->data),
                backgroundColor: [
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(255, 99, 132, 0.5)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1,
            }],
        }, 'bar', {
            scales: {
                y: {
                    beginAtZero: false,
                    title: {
                        display: false,
                        text: 'Revenue in MAD',
                        padding: 10
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Monthly Revenue'
                }
            }
        });
    });
    window.addEventListener("livewire:navigated", () => {
        let ctx1 = document.getElementById('myChart1').getContext('2d');


        // Initialled the first one
        initializeChart(ctx1, {
            labels:@json($dataSet->labels),
            datasets: [{
                label: 'Employer Salary (Average)',
                data: @json($dataSet->data),
                backgroundColor: [
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(255, 99, 132, 0.5)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1,
            }],
        }, 'bar', {
            scales: {
                y: {
                    beginAtZero: false,
                    title: {
                        display: false,
                        text: 'Revenue in MAD',
                        padding: 10
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Monthly Revenue'
                }
            }
        });
    })
</script>
