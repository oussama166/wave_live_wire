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

document.addEventListener("livewire:navigated", () => {
    initGsap();
    initCalendar();
    InstanceDatePicker();
});
