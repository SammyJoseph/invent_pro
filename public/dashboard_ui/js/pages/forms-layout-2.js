window.addEventListener(
    "app:mounted",
    function () {
        var e = document.querySelector("#category");
        e._tom = new Tom(e, {
            create: !0,
            sortField: { field: "text", direction: "asc" },
        });
        
        var t = document.querySelector("#images");
        t._filepond = FilePond.create(t);
    },
    { once: !0 }
);
