window.addEventListener(
    "app:mounted",
    function () {
        var e = document.querySelector("#flatpickr1");
        e._datepicker = flatpickr(e);
        var t = document.querySelector("#flatpickr2");
        t._datepicker = flatpickr(t, {
            altInput: !0,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });
        var r = document.querySelector("#flatpickr3");
        r._datepicker = flatpickr(r, {
            disable: [
                function (e) {
                    return 0 === e.getDay() || 6 === e.getDay();
                },
            ],
            locale: { firstDayOfWeek: 1 },
        });
        var a = document.querySelector("#flatpickr4");
        a._datepicker = flatpickr(a, {
            mode: "multiple",
            dateFormat: "Y-m-d",
            defaultDate: ["2022-10-10", "2022-10-12", "2022-10-18"],
        });
        var c = document.querySelector("#flatpickr5");
        c._datepicker = flatpickr(c, {
            mode: "range",
            dateFormat: "Y-m-d",
            defaultDate: ["2016-10-10", "2016-10-20"],
        });
        var l = document.querySelector("#flatpickr6");
        l._datepicker = flatpickr(l, { wrap: !0 });
        var i = document.querySelector("#flatpickr7");
        i._datepicker = flatpickr(i, { inline: !0 });
    },
    { once: !0 }
);
