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
                id: "name",
                name: "Producto",
                formatter: function(e) {
                    return Gridjs.html('<span class="text-slate-700 dark:text-navy-100 font-medium">'.concat(e, "</span>"))
                }
            }, {
                id: "image_url",
                name: "Imagen",
                sort: !1,
                formatter: function(e) {
                    return Gridjs.html('<div class="avatar flex">\n                                  <img class="rounded-full" src="'.concat(e, '" alt="imagen">\n                              </div>'))
                }
            }, {
                id: "price",
                name: "Precio"
            }, {
                id: "stock",
                name: "Stock"
            },             {
                name: "Acciones",
                sort: !1,
                formatter: function(_, row) {
                    const productId = row.cells[0].data;
                    return Gridjs.html(`
                        <div class="flex justify-start space-x-2">
                            <a href="/dashboard/products/${productId}/edit" class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="/dashboard/products/${productId}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este producto?');">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="${csrf_token}">
                                <button type="submit" class="btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    `);
                }
            },],
            data: productsData,
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