<div>
    <div class="w-full overflow-hidden border rounded-2xl">
        <table class="w-full text-sm text-left text-gray-500 bg-white border-0 rounded-2xl">
            <thead class="text-base text-gray-700 uppercase border-0 bg-gray-50">
                <tr class="border rounded-2xl">
                    @foreach ($headers as $header)
                        <th scope="col" class="px-6 pt-8 pb-3">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse ($data->items() as $item)

                    <tr class="bg-white border-b dark:border-gray-700 dark:bg-gray-800">
                        @foreach ($extract_key as $key)
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                @php
                                    // Handle different keys dynamically
                                    $value = data_get($item, $key);
                                @endphp

                                @if ($key == 'leave_status_id' && isset($item->leaveStatus))
                                    @php
                                        $status = $item->leaveStatus->label;
                                        $statusClass = match ($status) {
                                            'Rejected' => 'bg-red-500',
                                            'Approved' => 'bg-green-500',
                                            'Pending' => 'bg-yellow-400',
                                            default => '',
                                        };
                                    @endphp
                                    <span class="text-white rounded-2xl px-2 py-1 font-semibold {{ $statusClass }}">
                                        {{ $status }}
                                    </span>
                                @elseif ($key == 'vacation_type_id' && isset($item->vacationType))
                                    {{ $item->vacationType->label }}
                                @elseif ($key == 'Duration')
                                    {{ detect_holiday(new DateTime($item->start_at), new DateTime($item->end_at)) }}
                                    Days
                                @else
                                    {{ $value }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($headers) }}" class="py-4 text-center text-gray-500">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
            {{ $data->links() }}
{{--    <div class="flex items-end justify-end w-full bg-red-500">--}}
{{--        --}}{{-- <div class="w-[15vw] my-5">--}}
{{--        </div> --}}
{{--    </div>--}}
</div>
