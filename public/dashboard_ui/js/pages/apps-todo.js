window.addEventListener("app:mounted",(function(){new Popper("#sidebar-label-menu",".popper-ref",".popper-root",{placement:"bottom-end",modifiers:[{name:"offset",options:{offset:[0,4]}}]}),new Popper("#top-header-menu",".popper-ref",".popper-root",{placement:"bottom-start",modifiers:[{name:"offset",options:{offset:[0,4]}}]});var e=document.querySelector("#todo-list");e._sortable=Sortable.create(e,{animation:200,easing:"cubic-bezier(0, 0, 0.2, 1)",direction:"vertical",delay:150,delayOnTouchOnly:!0}),document.querySelectorAll(".todo-checkbox").forEach((function(e){return e.addEventListener("click",(function(e){return e.stopPropagation()}))})),new Drawer("#edit-todo-drawer");var n=document.querySelector("#edit-todo-tags");n._tom=new Tom(n);var o=document.querySelector("#edit-todo-due-date");o._datepicker=flatpickr(o,{defaultDate:"2020-01-05"});var t=document.querySelector("#edit-todo-assigned");t._tom=new Tom(t,{valueField:"id",searchField:"title",options:[{id:1,name:"John Doe",job:"Web designer",src:"images/200x200.png"},{id:2,name:"Emilie Watson",job:"Developer",src:"images/200x200.png"},{id:3,name:"Nancy Clarke",job:"Software Engineer",src:"images/200x200.png"}],placeholder:"Select the user",render:{option:function(e,n){return'<div class="flex space-x-3">\n                      <div class="avatar w-8 h-8">\n                        <img class="rounded-full" src="'.concat(n(e.src),'" alt="avatar"/>\n                      </div>\n                      <div class="flex flex-col">\n                        <span> ').concat(n(e.name),'</span>\n                        <span class="text-xs opacity-80"> ').concat(n(e.job),"</span>\n                      </div>\n                    </div>")},item:function(e,n){return'<span class="inline-flex items-center">\n        <span class="avatar w-6 h-6">\n            <img class="rounded-full" src="'.concat(n(e.src),'" alt="avatar">\n        </span>\n        <span class="mx-2">').concat(n(e.name),"</span>\n      </span>")}}});var a=document.querySelector("#edit-todo-description");a._quill=new Quill(a,{modules:{toolbar:[["bold","italic","underline"],[{list:"ordered"},{list:"bullet"},{header:1},{background:[]}]]},placeholder:"Enter your content...",theme:"snow"})}),{once:!0});