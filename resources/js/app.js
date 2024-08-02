import { initCalendar } from "../../public/vendor/Calendar/Calendar";
import { dropGsap, initGsap } from "../../public/vendor/GSAP/Gsap";
import "./bootstrap";
import Swal from "sweetalert2";

window.InitGsap = initGsap;
window.dropGsap = dropGsap;

window.initCalendar = initCalendar;

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
    initCalendar();
    initGsap();
    dropGsap();
});
