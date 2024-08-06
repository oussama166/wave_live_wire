import "./bootstrap";
import Swal from "sweetalert2";
import { initCalendar } from "../../public/vendor/Calendar/Calendar";
import { InstanceDatePicker } from "../../public/vendor/Flowbite/flowbiteIntsance";
import { dropGsap, initGsap } from "../../public/vendor/GSAP/Gsap";


window.InitGsap = initGsap;
window.dropGsap = dropGsap;

window.initCalendar = initCalendar;

window.InstanceDatePicker = InstanceDatePicker;


document.addEventListener("livewire:init", () => {
    Livewire.on("alert", (event) => {
        Swal.fire({
            position: "center",
            icon: event.type,
            title: event.title,
            text: event.text,
            showConfirmButton: false,
            timer: 1500,
        });
    });

    Livewire.on("toast", (event) => {
        console.log(event);
        Swal.fire({
            toast: true,
            position: "top-end",
            icon: event.type,
            title: event.message,
            showConfirmButton: false,
            timer: 3500,
        });
    });
});

document.addEventListener("livewire:navigated", () => {
    initGsap();
    initCalendar();
    InstanceDatePicker();
});
