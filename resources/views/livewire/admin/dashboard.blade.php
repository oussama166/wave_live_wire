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
        <div class="w-[35vw] h-[50vh] bg-white border rounded-lg p-5">
            <canvas wire:ignore id="myChart1"></canvas>
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
                label: 'Average Salary',
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
                label: 'Average Salary',
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
