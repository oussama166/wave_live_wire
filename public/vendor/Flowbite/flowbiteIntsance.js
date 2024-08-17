import {Datepicker, Dropdown} from "flowbite";
import {DateRangePicker} from "flowbite-datepicker";
import {format, subYears} from "date-fns";


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


/**
 * This function Initialize the Flow-bite instance date
 *
 * @property SUB_MIN
 * @property SUB_MAX
 *
 * @return void
 * */

export function InstanceDate(el,SUB_MIN = 0, SUB_MAX = 0) {
    // set the target element of the input field
    const $datepickerEl = document.getElementById(el);


    // optional options with de]fault values and callback functions
    const options = {
        defaultDatepickerId: null,
        autohide: false,
        format: 'y-mm-dd',
        maxDate: (SUB_MAX === 0) ? null : subYears(new Date(), parseInt(SUB_MAX)),
        minDate: (SUB_MAX === 0) ? null : subYears(new Date(), parseInt(SUB_MIN)),
        orientation: 'bottom',
        buttons: true,
        autoSelectToday: true,
        title: null,
        rangePicker: false,

    };

    const datepicker = new Datepicker($datepickerEl, options);
    // console.log("datepicker");
    // console.log(SUB_MIN, SUB_MAX);
    // console.warn(subYears(new Date(), parseInt(SUB_MAX)));
    // console.warn(subYears(new Date(), parseInt(SUB_MIN)));

    // listen to the datepicker events
    const handleDateBlur = () => {
        // format the date to y-mm-dd
        const selectedDates = datepicker.getDate();

        if (selectedDates === null || selectedDates === undefined) {
            return;
        }
        Livewire.dispatch('handleTimeChange', {
            model: el,
            value: format(selectedDates, 'y-MM-dd')
        });
    };

    // implement the blur event
    // i want to dispatch only when the form will be submited
     $datepickerEl.addEventListener('changeDate', handleDateBlur);




}
