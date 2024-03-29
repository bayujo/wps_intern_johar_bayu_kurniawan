function eventClicked() {
    document.getElementById("form-event").classList.add("view-event"),
        document
            .getElementById("event-title")
            .classList.replace("d-block", "d-none"),
        document
            .getElementById("event-category")
            .classList.replace("d-block", "d-none"),
        document.getElementById("btn-save-event").setAttribute("hidden", !0);
}
function editEvent(e) {
    var t = e.getAttribute("data-id");
    "new-event" == t
        ? ((document.getElementById("modal-title").innerHTML = ""),
          (document.getElementById("modal-title").innerHTML = "Add Event"),
          (document.getElementById("btn-save-event").innerHTML = "Add Event"),
          eventTyped())
        : "edit-event" == t
        ? ((e.innerHTML = "Cancel"),
          (document.getElementById("btn-save-event").innerHTML =
              "Update Event"),
          e.removeAttribute("hidden"),
          eventTyped())
        : ((e.innerHTML = "Edit"), eventClicked());
}
function eventTyped() {
    document.getElementById("form-event").classList.remove("view-event"),
        document
            .getElementById("event-title")
            .classList.replace("d-none", "d-block"),
        document
            .getElementById("event-category")
            .classList.replace("d-none", "d-block"),
        document.getElementById("btn-save-event").removeAttribute("hidden");
}
document.addEventListener("DOMContentLoaded", function () {
    var i = new bootstrap.Modal(document.getElementById("event-modal"), {
        keyboard: !1,
    });
    document.getElementById("event-modal");
    var t = document.getElementById("modal-title"),
        n = document.getElementById("form-event"),
        o = null,
        e = (document.getElementsByClassName("needs-validation"), new Date()),
        d = e.getDate(),
        a = e.getMonth(),
        l = e.getFullYear(),
        r = FullCalendar.Draggable,
        c = document.getElementById("external-events"),
        s = [
            { title: "All Day Event", start: new Date(l, a, 1) },
            {
                title: "Long Event",
                start: new Date(l, a, d - 5),
                end: new Date(l, a, d - 2),
                className: "bg-warning",
            },
            {
                id: 999,
                title: "Repeating Event",
                start: new Date(l, a, d - 3, 16, 0),
                allDay: !1,
                className: "bg-info",
            },
            {
                id: 999,
                title: "Repeating Event",
                start: new Date(l, a, d + 4, 16, 0),
                allDay: !1,
                className: "bg-primary",
            },
            {
                title: "Meeting",
                start: new Date(l, a, d, 10, 30),
                allDay: !1,
                className: "bg-success",
            },
            {
                title: "Lunch",
                start: new Date(l, a, d, 12, 0),
                end: new Date(l, a, d, 14, 0),
                allDay: !1,
                className: "bg-danger",
            },
            {
                title: "Birthday Party",
                start: new Date(l, a, d + 1, 19, 0),
                end: new Date(l, a, d + 1, 22, 30),
                allDay: !1,
                className: "bg-success",
            },
            {
                title: "Click for Google",
                start: new Date(l, a, 28),
                end: new Date(l, a, 29),
                url: "http://google.com/",
                className: "bg-dark",
            },
        ];
    new r(c, {
        itemSelector: ".external-event",
        eventData: function (e) {
            return {
                id: Math.floor(11e3 * Math.random()),
                title: e.innerText,
                allDay: !0,
                start: new Date(),
                className: e.getAttribute("data-class"),
            };
        },
    });
    var m = document.getElementById("calendar");
    function v(e) {
        document.getElementById("form-event").reset(),
            i.show(),
            n.classList.remove("was-validated"),
            n.reset(),
            (o = null),
            (t.innerText = "Create Event"),
            (newEventData = e);
    }
    function u() {
        return 768 <= window.innerWidth && window.innerWidth < 1200
            ? "timeGridWeek"
            : window.innerWidth <= 768
            ? "listMonth"
            : "dayGridMonth";
    }
    var g = new FullCalendar.Calendar(m, {
        timeZone: "local",
        editable: !0,
        droppable: !0,
        selectable: !0,
        navLinks: !0,
        initialView: u(),
        themeSystem: "bootstrap",
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth",
        },
        windowResize: function (e) {
            var t = u();
            g.changeView(t);
        },
        eventResize: function (t) {
            var e = s.findIndex(function (e) {
                return e.id == t.event.id;
            });
            s[e] &&
                ((s[e].title = t.event.title),
                (s[e].className = t.event.classNames[0]));
        },
        eventClick: function (e) {
            document.getElementById("edit-event-btn").removeAttribute("hidden"),
                document
                    .getElementById("btn-save-event")
                    .setAttribute("hidden", !0),
                document
                    .getElementById("edit-event-btn")
                    .setAttribute("data-id", "edit-event"),
                (document.getElementById("edit-event-btn").innerHTML = "Edit"),
                eventClicked(),
                i.show(),
                n.reset(),
                (o = e.event),
                (document.getElementById("modal-title").innerHTML = ""),
                console.log("selectedEvent", o),
                (document.getElementById("event-title").value = o.title),
                (document.getElementById("event-category").value = o.className),
                document
                    .getElementById("btn-delete-event")
                    .removeAttribute("hidden");
        },
        dateClick: function (e) {
            document
                .getElementById("edit-event-btn")
                .setAttribute("hidden", !0),
                document
                    .getElementById("btn-save-event")
                    .removeAttribute("hidden"),
                v(e);
        },
        events: s,
        eventReceive: function (e) {
            var t = {
                id: parseInt(e.event.id),
                title: e.event.title,
                className: e.event.classNames[0],
            };
            s.push(t);
        },
        eventDrop: function (t) {
            var e = s.findIndex(function (e) {
                return e.id == t.event.id;
            });
            s[e] &&
                ((s[e].title = t.event.title),
                (s[e].className = t.event.classNames[0]));
        },
    });
    g.render(),
        n.addEventListener("submit", function (e) {
            e.preventDefault();
            var t,
                n,
                d,
                a = document.getElementById("event-title").value,
                l = document.getElementById("event-category").value;
            o
                ? ((t = document.getElementById("eventid").value),
                  o.setProp("id", t),
                  o.setProp("title", a),
                  o.setProp("classNames", [l]),
                  (n = s.findIndex(function (e) {
                      return e.id == o.id;
                  })),
                  s[n] && ((s[n].title = a), (s[n].className = l)),
                  g.render())
                : ((d = {
                      id: (1e4 * Math.random()).toFixed(0),
                      title: a,
                      start: new Date(
                          document.querySelector("#calendar").value
                      ),
                      allDay: !0,
                      className: l,
                  }),
                  g.addEvent(d),
                  s.push(d)),
                i.hide();
        }),
        document
            .getElementById("btn-delete-event")
            .addEventListener("click", function (e) {
                if (o) {
                    for (var t = 0; t < s.length; t++)
                        s[t].id == o.id && (s.splice(t, 1), t--);
                    o.remove(), (o = null), i.hide();
                }
            }),
        document
            .getElementById("btn-new-event")
            .addEventListener("click", function (e) {
                v(), document.getElementById("edit-event-btn").click();
            });
});
