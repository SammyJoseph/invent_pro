window.addEventListener("app:mounted", (function() {
    var e = {
        placement: "bottom-start",
        modifiers: [{
            name: "offset",
            options: {
                offset: [0, 4]
            }
        }]
    };
    var o = document.querySelector("#grid-table-4"),
        c = {
            columns: [{
                id: "id",
                name: "ID",
                formatter: function(e) {
                    return Gridjs.html('<span class="mx-2">'.concat(e, "</span>"))
                }
            }, {
                id: "sale_date",
                name: "Fecha de venta",
                formatter: function(e) {
                    const date = new Date(e);
                    const formattedDate = date.toLocaleString('es-ES', {
                        day: '2-digit', month: '2-digit', year: 'numeric',
                        hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false
                    }).replace(/\//g, '-').replace(',', '');
                    return Gridjs.html('<span class="text-slate-700 dark:text-navy-100 font-medium">'.concat(formattedDate, "</span>"))
                }
            }, {
                id: "total_amount",
                name: "Venta total"
            }, {
                id: "total_cost",
                name: "Inversión total",
                formatter: function(e) {
                    return Gridjs.html('<span>' + parseFloat(e).toFixed(2) + '</span>');
                }
            }, {
                id: "total_profit",
                name: "Ganancia total",
                formatter: function(e) {
                    return Gridjs.html('<span>' + parseFloat(e).toFixed(2) + '</span>');
                }
            }, {
                id: "units_sold",
                name: "Unidades vendidas"
            }, {
                id: "payment_method",
                name: "Método de pago"
            }, {
                name: "Acciones",
                sort: !1,
                formatter: function(_, row) {
                    const saleId = row.cells[0].data;
                    return Gridjs.html(`
                        <div class="flex justify-start space-x-2">
                            <a href="/dashboard/sales/${saleId}" class="btn h-8 w-8 p-0 text-secondary hover:bg-secondary/20 focus:bg-secondary/20 active:bg-secondary/25">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </div>
                    `);
                }
            },],
            data: salesData,
            sort: !0,
            search: !0,
            pagination: {
                enabled: !0,
                limit: 20
            }
        };
    o._table = new Gridjs.Grid(c).render(o)
}), {
    once: !0
});