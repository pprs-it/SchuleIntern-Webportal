self.webpackHotUpdatemenu(179,{3097:(t,e,i)=>{"use strict";i.d(e,{Z:()=>s});const s={components:{},props:{item:Array,pages:Array,items:Array},data:function(){return{deleteItem:!1,pagesOpen:!1,parentOpen:!1}},created:function(){},methods:{handlerParentOpen:function(){this.parentOpen?this.parentOpen=!1:this.parentOpen=!0},handlerParentSelect:function(t){t.id&&t.title&&(this.item.parent_id=t.id,this.item.parent_title=t.title),this.parentOpen=!1},handlerPagesSelect:function(t){if(!t.title||!t.url)return!1;this.item.page=t.url.page,this.item.params=JSON.stringify(t.url.params),this.pagesOpen=!1},handlerPagesOpen:function(){this.pagesOpen?this.pagesOpen=!1:this.pagesOpen=!0},handlerSubmit:function(){if(!this.item.title)return!1;this.deleteItem=!1,EventBus.$emit("item-form--submit",{item:this.item})},handlerBack:function(){this.deleteItem=!1,this.pagesOpen=!1,EventBus.$emit("show--set",{show:"items"})},handlerDelete:function(t){if(!t.id)return!1;this.deleteItem=t,this.pagesOpen=!1},handlerDeleteSure:function(){if(!this.item.id)return!1;this.deleteItem=!1,this.pagesOpen=!1,EventBus.$emit("item-form--delete",{item:this.item})}}}},3217:(t,e,i)=>{"use strict";i.r(e),i.d(e,{render:()=>s,staticRenderFns:()=>a});var s=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"form-style-2"},[i("div",{staticClass:"flex-row"},[i("div",{staticClass:"flex-1"},[i("button",{staticClass:"si-btn si-btn-light",on:{click:t.handlerBack}},[t._v(" Zurück")])]),t._v(" "),i("div",{directives:[{name:"show",rawName:"v-show",value:t.item.id,expression:"item.id"}],staticClass:"flex flex-end"},[i("button",{directives:[{name:"show",rawName:"v-show",value:0==t.deleteItem,expression:"deleteItem == false"}],staticClass:"si-btn si-btn-light",on:{click:function(e){return t.handlerDelete(t.item)}}},[i("i",{staticClass:"far fa-trash-alt"}),t._v(" Löschen")]),t._v(" "),i("button",{directives:[{name:"show",rawName:"v-show",value:t.deleteItem,expression:"deleteItem"}],staticClass:"si-btn si-btn-red",on:{click:function(e){return t.handlerDeleteSure(t.item)}}},[i("i",{staticClass:"far fa-trash-alt"}),t._v("Löschen!")])])]),t._v(" "),i("br"),i("br"),t._v(" "),i("ul",{staticClass:"noListStyle"},[i("li",{staticClass:"line-oddEven padding-t-m padding-b-l padding-l-l"},[i("h3",{},[t._v("Menü Name")]),t._v(" "),i("input",{directives:[{name:"model",rawName:"v-model",value:t.item.title,expression:"item.title"}],staticClass:"width-40vw",attrs:{type:"text"},domProps:{value:t.item.title},on:{input:function(e){e.target.composing||t.$set(t.item,"title",e.target.value)}}})]),t._v(" "),i("li",{staticClass:"line-oddEven padding-t-m padding-b-m"},[i("label",{staticClass:"width-12rem padding-l-l"},[t._v("Gruppe")]),t._v(" "),i("input",{staticClass:"select readonly width-20vw",attrs:{type:"text",readonly:""},domProps:{value:t.item.parent_title},on:{click:t.handlerParentOpen}})]),t._v(" "),i("li",{staticClass:"line-oddEven"}),t._v(" "),i("li",{directives:[{name:"show",rawName:"v-show",value:t.parentOpen,expression:"parentOpen"}],staticClass:"line-oddEven padding-t-m padding-b-m padding-l-l"},[i("div",{staticClass:"parent"},[i("h4",[t._v("Menu")]),t._v(" "),t._l(t.items,(function(e,s){return i("ul",{key:s,staticClass:"noListStyle",attrs:{value:t.item.id}},[i("li",{staticClass:"margin-b-s"},[i("button",{staticClass:"si-btn ",class:{"si-btn-active":e.id==t.item.parent_id},on:{click:function(i){return t.handlerParentSelect(e)}}},[i("i",{class:e.icon}),t._v(" "+t._s(e.title))]),t._v(" "),e.items.length>=1?i("ul",{staticClass:"noListStyle flex-row"},t._l(e.items,(function(e,s){return i("li",{key:s,staticClass:"margin-b-s padding-l-l margin-t-s",attrs:{value:e.id}},[i("button",{staticClass:"si-btn ",class:{"si-btn-active":e.id==t.item.parent_id},on:{click:function(i){return t.handlerParentSelect(e)}}},[i("i",{class:e.icon}),t._v(" "+t._s(e.title))])])})),0):t._e()])])}))],2)]),t._v(" "),i("li",{staticClass:"line-oddEven padding-t-m padding-b-m"},[i("label",{staticClass:"width-12rem padding-l-l"},[t._v("Seite")]),t._v(" "),i("input",{staticClass:"select readonly width-20vw",attrs:{type:"text",readonly:""},domProps:{value:t.item.page},on:{click:t.handlerPagesOpen}}),t._v(" "),t.item.params?i("span",{staticClass:"padding-l-s text-grey"},[t._v("Params: "+t._s(t.item.params))]):t._e()]),t._v(" "),i("li",{staticClass:"line-oddEven"}),t._v(" "),i("li",{directives:[{name:"show",rawName:"v-show",value:t.pagesOpen,expression:"pagesOpen"}],staticClass:"line-oddEven padding-t-m padding-b-m  padding-l-l"},t._l(t.pages,(function(e,s){return i("div",{key:s},[i("h4",[t._v(t._s(e.name))]),t._v(" "),i("div",{staticClass:"flex-row"},t._l(e.submenu,(function(a,n){return e.submenu?i("span",{key:s,staticClass:"margin-b-s"},[0!=a.menu?i("button",{staticClass:"si-btn margin-r-m",class:{"si-btn-red":1==a.admin,"si-btn-active":a.url.page==t.item.page&&JSON.stringify(a.url.params)==t.item.params},on:{click:function(e){return t.handlerPagesSelect(a)}}},[i("i",{class:a.icon}),t._v(t._s(a.title))]):t._e()]):t._e()})),0)])})),0),t._v(" "),i("li",{staticClass:"line-oddEven padding-t-m padding-b-m"},[i("label",{staticClass:"width-12rem padding-l-l"},[t._v("Icon")]),t._v(" "),i("input",{directives:[{name:"model",rawName:"v-model",value:t.item.icon,expression:"item.icon"}],staticClass:"width-20vw",attrs:{type:"text"},domProps:{value:t.item.icon},on:{input:function(e){e.target.composing||t.$set(t.item,"icon",e.target.value)}}})]),t._v(" "),i("li",{staticClass:"line-oddEven padding-t-m padding-b-m"},[i("label",{staticClass:"width-12rem padding-l-l"},[t._v("Sichtbarkeit")]),t._v(" "),i("input",{staticClass:"select readonly width-20vw",attrs:{type:"text",readonly:""},domProps:{value:t.item.access},on:{click:t.handlerPagesOpen}})]),t._v(" "),t._m(0),t._v(" "),i("li",[i("br"),t._v(" "),i("button",{staticClass:"si-btn",on:{click:t.handlerSubmit}},[i("i",{staticClass:"fas fa-mouse-pointer"}),t._v(" Speichern")])])])])},a=[function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("li",[i("button",{staticClass:"si-btn margin-r-m"},[t._v("Admin")]),t._v(" "),i("button",{staticClass:"si-btn margin-r-m"},[t._v("Moduladmin")]),t._v(" "),i("button",{staticClass:"si-btn margin-r-m"},[t._v("Lehrer")]),t._v(" "),i("button",{staticClass:"si-btn margin-r-m"},[t._v("Schüler")]),t._v(" "),i("button",{staticClass:"si-btn margin-r-m"},[t._v("Eltern")]),t._v(" "),i("button",{staticClass:"si-btn margin-r-m"},[t._v("Sonstige")])])}];s._withStripped=!0}},(function(t){"use strict";t.h=()=>"605b1e8665044cf1ef98"}));