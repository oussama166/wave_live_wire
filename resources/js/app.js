import "./bootstrap";
import Swal from "sweetalert2";
import { initCalendar } from "../../public/vendor/Calendar/Calendar";
import { InstanceDatePicker ,InstanceDate} from "../../public/vendor/Flowbite/flowbiteIntsance";
import { dropGsap, initGsap } from "../../public/vendor/GSAP/Gsap";
import {initializeChart} from "../../public/vendor/ChartJs/Chart.js";


// Register

window.InitGsap = initGsap;
window.dropGsap = dropGsap;

window.initCalendar = initCalendar;

window.InstanceDatePicker = InstanceDatePicker;
window.InstanceDate = InstanceDate;

window.initializeChart = initializeChart;



// Live Wire listner
document.addEventListener("livewire:init", () => {
    Livewire.on("alert", (event) => {
        const swalOptions = {
            position: 'center',
            icon: event.type,
            title: event.title,
            text: event.text,
            showConfirmButton: event.confirm ?? false,
        };

        if(event.confirSet){
            swalOptions.timer = event.timer ?? 1500;
        }


        Swal.fire(swalOptions);
    });

    Livewire.on("toast", (event) => {
        Swal.fire({
            toast: true,
            position: "top-end",
            icon: event.type,
            title: event.title,
            text: event.text,
            showConfirmButton: false,
            timer: 3500,
        });
    });
});


// Handling the navigated event
document.addEventListener("livewire:navigated", () => {
    initGsap();
    initCalendar();
    InstanceDatePicker();
});

Livewire.hook('element.initialized',() => {
    window.Alpine.discoverUninitializedComponents((el) => {
        window.Alpine.initializeComponent(el);
    })
});
