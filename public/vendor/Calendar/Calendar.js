// public/js/calendar.js
import Calendar from "@toast-ui/calendar";
import "@toast-ui/calendar/dist/toastui-calendar.css";

export const MOCK_CALENDARS = [
    {
        id: "1",
        name: "Accepted",
        color: "#ffffff",
        bgColor: "#9e5fff",
        dragBgColor: "#9e5fff",
        borderColor: "#9e5fff",
    },
    {
        id: "2",
        name: "Pending",
        color: "#ffffff",
        bgColor: "#00a9ff",
        dragBgColor: "#00a9ff",
        borderColor: "#00a9ff",
    },
];

export function initCalendar(elementId, options = {}, events = [{}]) {
    const calendarEl = document.querySelector(elementId);
    if (!calendarEl) {
        return;
    }

    const defaultOptions = {
        defaultView: "month",
        calendars: MOCK_CALENDARS,
        theme: {
            week: {
                dayName: {
                    borderLeft: "none",
                    borderTop: "1px dotted red",
                    borderBottom: "1px dotted red",
                    backgroundColor: "rgba(81, 92, 230, 0.05)",
                },
                dayGrid: {
                    backgroundColor: "rgba(81, 92, 230, 0.05)",
                },
                dayGridLeft: {
                    borderRight: "none",
                    backgroundColor: "rgba(81, 92, 230, 0.05)",
                    width: "144px",
                },
                timeGridLeft: {
                    borderRight: "none",
                    backgroundColor: "rgba(81, 92, 230, 0.05)",
                    width: "144px",
                },
                timeGridLeftAdditionalTimezone: {
                    backgroundColor: "#e5e5e5",
                },
                timeGridHalfHourLine: {
                    borderBottom: "1px dotted #e5e5e5",
                },
                nowIndicatorPast: {
                    border: "1px dashed red",
                },
                futureTime: {
                    color: "red",
                },
            },
        },
        template: {
            allday(event) {
                console.log(event);
                return `<span class="text-white font-semibold">${event.title}</span>`;
            },
            task(event) {
                console.log(event);
                return `<span style="color: red;">${event.title}</span>`;
            },
        },
    };

    const calendar = new Calendar(calendarEl, defaultOptions);

    if (events.length !== 0) {
        console.log(events);
        calendar.createEvents(events);
    }

    return calendar;
}
