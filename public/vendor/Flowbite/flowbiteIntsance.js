import {Datepicker, Dropdown} from "flowbite";
import { DateRangePicker } from "flowbite-datepicker";
import {format} from "date-fns";


export function InstanceDatePicker() {
    // set the target element of the input field
    const $datepickerEl = document.getElementById('date-range-picker');

    const $datepickerElStart = document.getElementById('datepicker-range-start');
    const $datepickerElEnd = document.getElementById('datepicker-range-end');


    // optional options with de]fault values and callback functions
    const options = {
        defaultDatepickerId: null,
        autohide: false,
        format: 'y-mm-dd',
        maxDate: null,
        minDate: Date.now(),
        orientation: 'bottom',
        buttons: true,
        autoSelectToday: true,
        title: null,
        rangePicker: false,

    };

    const datepicker = new DateRangePicker($datepickerEl, options);


    // listen to the datepicker events
    const handleDateBlur = () => {
        // format the date to y-mm-dd
        const selectedDates = datepicker.getDates();
        if (
            selectedDates[0] === null && selectedDates[1] === null ||
            selectedDates[0] === undefined && selectedDates[1] === undefined
        ) {
            return;
        }
        Livewire.dispatch('datesSelected', {
            startAt: format(selectedDates[0], 'y-MM-dd'),
            endAt: format(selectedDates[1], 'y-MM-dd')
        });
    };

    $datepickerElStart.addEventListener('blur', handleDateBlur);
    $datepickerElEnd.addEventListener('blur', handleDateBlur);
}
