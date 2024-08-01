import "./bootstrap";
import Swal from "sweetalert2";

document.addEventListener("livewire:init", () => {
    Livewire.on("alert", (event) => {
        console.log("event");
        Swal.fire({
            position: "center",
            icon: event.type,
            title: event.title,
            text: event.text,
            showConfirmButton: false,
            timer: 1500,
        });
    });
});
