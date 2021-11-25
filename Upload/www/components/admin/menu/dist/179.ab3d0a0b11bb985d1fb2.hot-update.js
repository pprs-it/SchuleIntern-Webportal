self.webpackHotUpdatemenu(179,{3097:(t,e,s)=>{"use strict";s.d(e,{Z:()=>i});const i={components:{},props:{item:Array,pages:Array,items:Array},data:function(){return{deleteItem:!1,pagesOpen:!1,parentOpen:!1}},created:function(){},methods:{handlerToggleActive:function(t){1==this.item.access[t]?this.item.access[t]=0:this.item.access[t]=1},handlerParentOpen:function(){this.parentOpen?this.parentOpen=!1:this.parentOpen=!0},handlerParentSelect:function(t){t.id&&t.title&&(this.item.parent_id=t.id,this.item.parent_title=t.title),this.parentOpen=!1},handlerPagesSelect:function(t){if(!t.title||!t.url)return!1;this.item.page=t.url.page,this.item.params=JSON.stringify(t.url.params),this.pagesOpen=!1},handlerPagesOpen:function(){this.pagesOpen?this.pagesOpen=!1:this.pagesOpen=!0},handlerSubmit:function(){if(!this.item.title)return!1;this.deleteItem=!1,EventBus.$emit("item-form--submit",{item:this.item})},handlerBack:function(){this.deleteItem=!1,this.pagesOpen=!1,EventBus.$emit("show--set",{show:"items"})},handlerDelete:function(t){if(!t.id)return!1;this.deleteItem=t,this.pagesOpen=!1},handlerDeleteSure:function(){if(!this.item.id)return!1;this.deleteItem=!1,this.pagesOpen=!1,EventBus.$emit("item-form--delete",{item:this.item})}}}},3217:(t,e,s)=>{"use strict";s.r(e),s.d(e,{render:()=>i,staticRenderFns:()=>a});var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"form-style-2"},[s("div",{staticClass:"flex-row"},[s("div",{staticClass:"flex-1"},[s("button",{staticClass:"si-btn si-btn-light",on:{click:t.handlerBack}},[t._v(" Zurück")])]),t._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:t.item.id,expression:"item.id"}],staticClass:"flex flex-end"},[s("button",{directives:[{name:"show",rawName:"v-show",value:0==t.deleteItem,expression:"deleteItem == false"}],staticClass:"si-btn si-btn-light",on:{click:function(e){return t.handlerDelete(t.item)}}},[s("i",{staticClass:"far fa-trash-alt"}),t._v(" Löschen")]),t._v(" "),s("button",{directives:[{name:"show",rawName:"v-show",value:t.deleteItem,expression:"deleteItem"}],staticClass:"si-btn si-btn-red",on:{click:function(e){return t.handlerDeleteSure(t.item)}}},[s("i",{staticClass:"far fa-trash-alt"}),t._v("Löschen!")])])]),t._v(" "),s("br"),s("br"),t._v(" "),s("ul",{staticClass:"noListStyle"},[s("li",{staticClass:"line-oddEven padding-t-m padding-b-l padding-l-l"},[s("h3",{},[t._v("Menü Name")]),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.item.title,expression:"item.title"}],staticClass:"width-40vw",attrs:{type:"text"},domProps:{value:t.item.title},on:{input:function(e){e.target.composing||t.$set(t.item,"title",e.target.value)}}})]),t._v(" "),s("li",{staticClass:"line-oddEven padding-t-m padding-b-m"},[s("label",{staticClass:"width-12rem padding-l-l"},[t._v("Gruppe")]),t._v(" "),s("input",{staticClass:"select readonly width-20vw",attrs:{type:"text",readonly:""},domProps:{value:t.item.parent_title},on:{click:t.handlerParentOpen}})]),t._v(" "),s("li",{staticClass:"line-oddEven"}),t._v(" "),s("li",{directives:[{name:"show",rawName:"v-show",value:t.parentOpen,expression:"parentOpen"}],staticClass:"line-oddEven padding-t-m padding-b-m padding-l-l"},[s("div",{staticClass:"parent"},[s("h4",[t._v("Menu")]),t._v(" "),t._l(t.items,(function(e,i){return s("ul",{key:i,staticClass:"noListStyle",attrs:{value:t.item.id}},[s("li",{staticClass:"margin-b-s"},[s("button",{staticClass:"si-btn ",class:{"si-btn-active":e.id==t.item.parent_id},on:{click:function(s){return t.handlerParentSelect(e)}}},[s("i",{class:e.icon}),t._v(" "+t._s(e.title))]),t._v(" "),e.items.length>=1?s("ul",{staticClass:"noListStyle flex-row"},t._l(e.items,(function(e,i){return s("li",{key:i,staticClass:"margin-b-s padding-l-l margin-t-s",attrs:{value:e.id}},[s("button",{staticClass:"si-btn ",class:{"si-btn-active":e.id==t.item.parent_id},on:{click:function(s){return t.handlerParentSelect(e)}}},[s("i",{class:e.icon}),t._v(" "+t._s(e.title))])])})),0):t._e()])])}))],2)]),t._v(" "),s("li",{staticClass:"line-oddEven padding-t-m padding-b-m"},[s("label",{staticClass:"width-12rem padding-l-l"},[t._v("Seite")]),t._v(" "),s("input",{staticClass:"select readonly width-20vw",attrs:{type:"text",readonly:""},domProps:{value:t.item.page},on:{click:t.handlerPagesOpen}}),t._v(" "),t.item.params?s("span",{staticClass:"padding-l-s text-grey"},[t._v("Params: "+t._s(t.item.params))]):t._e()]),t._v(" "),s("li",{staticClass:"line-oddEven"}),t._v(" "),s("li",{directives:[{name:"show",rawName:"v-show",value:t.pagesOpen,expression:"pagesOpen"}],staticClass:"line-oddEven padding-t-m padding-b-m  padding-l-l"},t._l(t.pages,(function(e,i){return s("div",{key:i},[s("h4",[t._v(t._s(e.name))]),t._v(" "),s("div",{staticClass:"flex-row"},t._l(e.submenu,(function(a,n){return e.submenu?s("span",{key:i,staticClass:"margin-b-s"},[0!=a.menu?s("button",{staticClass:"si-btn margin-r-m",class:{"si-btn-red":1==a.admin,"si-btn-active":a.url.page==t.item.page&&JSON.stringify(a.url.params)==t.item.params},on:{click:function(e){return t.handlerPagesSelect(a)}}},[s("i",{class:a.icon}),t._v(t._s(a.title))]):t._e()]):t._e()})),0)])})),0),t._v(" "),s("li",{staticClass:"line-oddEven padding-t-m padding-b-m"},[s("label",{staticClass:"width-12rem padding-l-l"},[t._v("Icon")]),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.item.icon,expression:"item.icon"}],staticClass:"width-20vw",attrs:{type:"text"},domProps:{value:t.item.icon},on:{input:function(e){e.target.composing||t.$set(t.item,"icon",e.target.value)}}})]),t._v(" "),s("li",{staticClass:"line-oddEven padding-t-m padding-b-m"},[s("label",{staticClass:"width-12rem padding-l-l"},[t._v("Sichtbarkeit")]),t._v(" "),t.item.access?s("div",{staticClass:"blockInline"},[s("button",{staticClass:"si-btn margin-r-s",class:{"si-btn-active":1==t.item.access.teacher},on:{click:function(e){return t.handlerToggleActive("teacher")}}},[1==t.item.access.teacher?s("i",{staticClass:"fas fa-toggle-on"}):t._e(),t._v(" "),0==t.item.access.teacher?s("i",{staticClass:"fas fa-toggle-off"}):t._e(),t._v(" Lehrer")]),t._v(" "),s("button",{staticClass:"si-btn margin-r-s",class:{"si-btn-active":1==t.item.access.pupil},on:{click:function(e){return t.handlerToggleActive("pupil")}}},[1==t.item.access.pupil?s("i",{staticClass:"fas fa-toggle-on"}):t._e(),t._v(" "),0==t.item.access.pupil?s("i",{staticClass:"fas fa-toggle-off"}):t._e(),t._v(" Schüler")]),t._v(" "),s("button",{staticClass:"si-btn margin-r-s",class:{"si-btn-active":1==t.item.access.parents},on:{click:function(e){return t.handlerToggleActive("parents")}}},[1==t.item.access.parents?s("i",{staticClass:"fas fa-toggle-on"}):t._e(),t._v(" "),0==t.item.access.parents?s("i",{staticClass:"fas fa-toggle-off"}):t._e(),t._v(" Eltern")]),t._v(" "),s("button",{staticClass:"si-btn margin-r-s",class:{"si-btn-active":1==t.item.access.other},on:{click:function(e){return t.handlerToggleActive("other")}}},[1==t.item.access.other?s("i",{staticClass:"fas fa-toggle-on"}):t._e(),t._v(" "),0==t.item.access.other?s("i",{staticClass:"fas fa-toggle-off"}):t._e(),t._v(" Sonstige")]),t._v(" "),s("br"),t._v(" "),s("button",{staticClass:"si-btn margin-r-s",class:{"si-btn-active":1==t.item.access.adminGroup},on:{click:function(e){return t.handlerToggleActive("adminGroup")}}},[1==t.item.access.adminGroup?s("i",{staticClass:"fas fa-toggle-on"}):t._e(),t._v(" "),0==t.item.access.adminGroup?s("i",{staticClass:"fas fa-toggle-off"}):t._e(),t._v(" Moduladmin")]),t._v(" "),s("br"),t._v(" "),s("button",{staticClass:"si-btn margin-r-s",class:{"si-btn-active":1==t.item.access.admin},on:{click:function(e){return t.handlerToggleActive("admin")}}},[1==t.item.access.admin?s("i",{staticClass:"fas fa-toggle-on"}):t._e(),t._v(" "),0==t.item.access.admin?s("i",{staticClass:"fas fa-toggle-off"}):t._e(),t._v(" Admin")])]):t._e()]),t._v(" "),s("li",[s("br"),t._v(" "),s("button",{staticClass:"si-btn",on:{click:t.handlerSubmit}},[s("i",{staticClass:"fas fa-mouse-pointer"}),t._v(" Speichern")])])])])},a=[];i._withStripped=!0}},(function(t){"use strict";t.h=()=>"202511636f9413a0bbed"}));