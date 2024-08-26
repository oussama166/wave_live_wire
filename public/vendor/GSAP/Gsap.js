import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

export function initGsap() {
    gsap.registerPlugin(ScrollTrigger);

    const tween = gsap.fromTo(
        "#sidebar",
        { top: "0%", translateY: "0%" },
        { top: "50%", translateY: "-50%", ease: "power1.inOut" }
    );

    const tween2 = gsap.fromTo(
        "#header",
        { background: "transparent" },
        {
            display: "flex",
            translateY: "-80px",
            background: "white",
            borderRadius: "0px 0px 40px 40px",
            ease: "power1.inOut",
        }
    );

    const tween3 = gsap.fromTo(
        ".content",
        {
            position: "sticky",
            top: "300px",
        },
        {
            top: "100px",
            display: "block",
            ease: "power1.inOut",
        }
    );

    ScrollTrigger.create({
        trigger: ".content",
        start: "top-=200px top",
        end: "top-=200px bottom",
        onUpdate: (self) => {
            if (self.direction > 0) {
                tween.play();
                tween2.play();
                tween3.play();
            } else {
                tween.reverse();
                tween2.reverse();
                tween3.reverse();
            }
        },
        markers: true,
    });
}

export function dropGsap(open = true, selector = "item") {
    let submenuItems = document.querySelectorAll(selector);
    submenuItems.forEach((sub, index) => {
        if (open) {
            sub.classList.add("block");
            sub.classList.remove("hidden");
            gsap.fromTo(
                sub,
                {
                    y: -50,
                    opacity: 0,
                },
                {
                    y: 0,
                    opacity: 1,
                    duration: 0.5,
                    ease: "power1.inOut",
                    delay: index * 0.1,
                }
            );
        } else {
            gsap.to(sub, {
                y: -50,
                opacity: 0,
                duration: 0.5,
                ease: "power1.inOut",
            });
        }
    });
}
