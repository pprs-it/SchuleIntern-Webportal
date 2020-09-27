(function(e){function t(t){for(var r,n,o=t[0],l=t[1],c=t[2],f=0,u=[];f<o.length;f++)n=o[f],Object.prototype.hasOwnProperty.call(i,n)&&i[n]&&u.push(i[n][0]),i[n]=0;for(r in l)Object.prototype.hasOwnProperty.call(l,r)&&(e[r]=l[r]);d&&d(t);while(u.length)u.shift()();return s.push.apply(s,c||[]),a()}function a(){for(var e,t=0;t<s.length;t++){for(var a=s[t],r=!0,o=1;o<a.length;o++){var l=a[o];0!==i[l]&&(r=!1)}r&&(s.splice(t--,1),e=n(n.s=a[0]))}return e}var r={},i={app:0},s=[];function n(t){if(r[t])return r[t].exports;var a=r[t]={i:t,l:!1,exports:{}};return e[t].call(a.exports,a,a.exports,n),a.l=!0,a.exports}n.m=e,n.c=r,n.d=function(e,t,a){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:a})},n.r=function(e){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"===typeof e&&e&&e.__esModule)return e;var a=Object.create(null);if(n.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(a,r,function(t){return e[t]}.bind(null,r));return a},n.n=function(e){var t=e&&e.__esModule?function(){return e["default"]}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/";var o=window["webpackJsonp"]=window["webpackJsonp"]||[],l=o.push.bind(o);o.push=t,o=o.slice();for(var c=0;c<o.length;c++)t(o[c]);var d=l;s.push([0,"chunk-vendors"]),a()})({0:function(e,t,a){e.exports=a("56d7")},"56d7":function(e,t,a){"use strict";a.r(t);a("cadf"),a("551c"),a("f751"),a("097d");var r=a("2b0e"),i=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{attrs:{id:"app"}},[a("div",{directives:[{name:"show",rawName:"v-show",value:e.error,expression:"error"}]},[e._v("\n    "+e._s(e.error)+"\n  ")]),1==e.loading?a("div",{staticClass:"overlay"},[a("i",{staticClass:"fa fa-refresh fa-spin"})]):e._e(),a("div",{attrs:{id:"main-box"}},[a("Calendar",{attrs:{dates:e.dates}})],1),a("Form"),a("Item")],1)},s=[],n=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",[a("div",{staticClass:"calendar"},[a("div",{staticClass:"calendar-header"},[a("button",{staticClass:"btn btn-app chevron-left",on:{click:e.subtractWeek}},[a("i",{staticClass:"fa fa-arrow-left"}),e._v("Vor\n          ")]),a("button",{staticClass:"btn btn-app",on:{click:e.gotoToday}},[a("i",{staticClass:"fa fa-home"}),e._v("Heute\n          ")]),a("h3",[e._v(e._s(e.$date(e.firstDayOfWeek).format("DD."))+" - "+e._s(e.$date(e.lastDayOfWeek).format("DD. MMMM YYYY")))]),a("button",{staticClass:"btn btn-app chevron-right",on:{click:e.addWeek}},[a("i",{staticClass:"fa fa-arrow-right"}),e._v("Weiter\n          ")])]),a("table",{staticClass:"table_1"},[a("thead",[a("tr",e._l(e.daysInWeek,(function(t,r){return a("td",{key:r,class:{"bg-orange":1==e.isToday(t)}},[e._v("\n              "+e._s(e.$date(t).format("DD. dd"))+"\n            ")])})),0)]),a("tbody",[a("tr",e._l(e.daysInWeek,(function(t,r){return a("td",{key:r},e._l(e.getEintrag(t),(function(r,i){return a("div",{key:i,staticClass:"eintrag",on:{click:function(t){return e.openEintrag(r)}}},[a("div",{staticClass:"title margin-b-s"},[e._v(e._s(r.title))]),a("div",{staticClass:"text-green margin-b-s"},[1==r.vegetarisch?a("div",[a("i",{staticClass:"fas fa-seedling width-2rem"}),e._v(" Vegetarisch")]):e._e(),1==r.vegan?a("div",[a("i",{staticClass:"fas fa-leaf width-2rem"}),e._v(" Vegan")]):e._e(),1==r.laktosefrei?a("div",[a("i",{staticClass:"fas fa-wine-bottle width-2rem"}),e._v(" Laktosefrei")]):e._e(),1==r.glutenfrei?a("div",[a("i",{staticClass:"fab fa-pagelines width-2rem"}),e._v(" Glutenfrei")]):e._e(),1==r.bio?a("div",[a("i",{staticClass:"fas fa-leaf width-2rem"}),e._v(" Bio")]):e._e(),1==r.regional?a("div",[a("i",{staticClass:"fas fa-tractor width-2rem"}),e._v(" Regional")]):e._e()]),e.showBuchenBtn(t)?a("button",{staticClass:"btn btn-gruen ",class:{"btn-orange":r.booked},on:{click:function(t){return t.stopPropagation(),e.orderEintrag(r)}}},[r.booked?a("span",[a("i",{staticClass:"fas fa-toggle-on"}),e._v(" Bestellt")]):e._e(),r.booked?e._e():a("span",[a("i",{staticClass:"fas fa-toggle-off"}),e._v(" Bestellen")])]):a("div",[r.booked?a("button",{staticClass:"btn btn-orange"},[a("i",{staticClass:"fas fa-toggle-on"}),e._v(" Bestellt")]):e._e()])])})),0)})),0),a("tr",e._l(e.daysInWeek,(function(t,r){return a("td",{key:r},[a("button",{staticClass:"btn width-100p",on:{click:function(a){return e.openForm(t)}}},[a("i",{staticClass:"fas fa-plus-circle"}),e._v(" Hinzufügen")])])})),0)])])])])},o=[],l=(a("ac6a"),{name:"Calendar",props:{dates:Array},data:function(){return{today:this.$date(),thisWeek:!1,prevDays:globals.prevDays}},created:function(){this.thisWeek=this.today,this.changedDate(),this.prevDays=parseInt(this.prevDays);var e=this;EventBus.$on("calender--reload",(function(t){e.changedDate()}))},computed:{firstDayOfWeek:function(){return this.thisWeek.startOf("week")},lastDayOfWeek:function(){return this.thisWeek.endOf("week")},daysInWeek:function(){for(var e=[],t=this.firstDayOfWeek,a=0;a<7;a++)e.push([t]),t=t.add(1,"day");return e}},methods:{showBuchenBtn:function(e){var t=this.today.add(this.prevDays,"day");return!!t.isBefore(e)},isToday:function(e){return!!this.today.isSame(e,"day")},subtractWeek:function(){this.thisWeek=this.thisWeek.subtract(1,"week"),this.changedDate()},addWeek:function(){this.thisWeek=this.thisWeek.add(1,"week"),this.changedDate()},gotoToday:function(){this.thisWeek=this.today,this.changedDate()},changedDate:function(){EventBus.$emit("calendar--changedDate",{von:this.firstDayOfWeek.unix(),bis:this.lastDayOfWeek.unix()})},openForm:function(e){EventBus.$emit("form--open",{item:{date:e}})},getEintrag:function(e){if(this.dates.length<=0)return"";e=this.$date(e).format("YYYY-MM-DD");var t=[];return this.dates.forEach((function(a){e==a.date&&t.push(a)})),t},openEintrag:function(e){EventBus.$emit("item--open",{item:e})},orderEintrag:function(e){if(!e.id)return!1;EventBus.$emit("item--order",{item:e})}}}),c=l,d=a("2877"),f=Object(d["a"])(c,n,o,!1,null,null,null),u=f.exports,m=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{directives:[{name:"show",rawName:"v-show",value:e.modalActive,expression:"modalActive"}],staticClass:"form-modal ",on:{click:function(t){return t.target!==t.currentTarget?null:e.handlerCloseModal(t)}}},[a("div",{staticClass:"form form-style-2 form-modal-content"},[a("div",{staticClass:"form-modal-close",on:{click:e.handlerCloseModal}},[a("i",{staticClass:"fa fa-times"})]),a("div",{directives:[{name:"show",rawName:"v-show",value:e.error,expression:"error"}],staticClass:"form-modal-error"},[a("b",[e._v("Folgende Fehler sind aufgetreten:")]),a("ul",[a("li",[e._v(e._s(e.error))])])]),a("br"),a("ul",{staticClass:"noListStyle"},[a("li",[a("label",[e._v("Tag")]),a("strong",[e._v(e._s(e.$date(e.form.date).format("DD.MM.YYYY")))])]),a("li",[a("label",[e._v("Title")]),a("input",{directives:[{name:"model",rawName:"v-model",value:e.form.title,expression:"form.title"}],attrs:{type:"text"},domProps:{value:e.form.title},on:{input:function(t){t.target.composing||e.$set(e.form,"title",t.target.value)}}})]),a("li",[a("label",[e._v("Preis Normal")]),a("input",{directives:[{name:"model",rawName:"v-model",value:e.form.preis_default,expression:"form.preis_default"}],attrs:{type:"text"},domProps:{value:e.form.preis_default},on:{input:function(t){t.target.composing||e.$set(e.form,"preis_default",t.target.value)}}})]),a("li",[a("label",[e._v("Preis Schüler")]),a("input",{directives:[{name:"model",rawName:"v-model",value:e.form.preis_schueler,expression:"form.preis_schueler"}],attrs:{type:"text"},domProps:{value:e.form.preis_schueler},on:{input:function(t){t.target.composing||e.$set(e.form,"preis_schueler",t.target.value)}}})]),a("li",[a("label",[e._v("Vegetarisch")]),a("input",{directives:[{name:"model",rawName:"v-model",value:e.form.vegetarisch,expression:"form.vegetarisch"}],attrs:{type:"checkbox","true-value":"1","false-value":"0"},domProps:{checked:Array.isArray(e.form.vegetarisch)?e._i(e.form.vegetarisch,null)>-1:e._q(e.form.vegetarisch,"1")},on:{change:function(t){var a=e.form.vegetarisch,r=t.target,i=r.checked?"1":"0";if(Array.isArray(a)){var s=null,n=e._i(a,s);r.checked?n<0&&e.$set(e.form,"vegetarisch",a.concat([s])):n>-1&&e.$set(e.form,"vegetarisch",a.slice(0,n).concat(a.slice(n+1)))}else e.$set(e.form,"vegetarisch",i)}}})]),a("li",[a("label",[e._v("Vegan")]),a("input",{directives:[{name:"model",rawName:"v-model",value:e.form.vegan,expression:"form.vegan"}],attrs:{type:"checkbox","true-value":"1","false-value":"0"},domProps:{checked:Array.isArray(e.form.vegan)?e._i(e.form.vegan,null)>-1:e._q(e.form.vegan,"1")},on:{change:function(t){var a=e.form.vegan,r=t.target,i=r.checked?"1":"0";if(Array.isArray(a)){var s=null,n=e._i(a,s);r.checked?n<0&&e.$set(e.form,"vegan",a.concat([s])):n>-1&&e.$set(e.form,"vegan",a.slice(0,n).concat(a.slice(n+1)))}else e.$set(e.form,"vegan",i)}}})]),a("li",[a("label",[e._v("Laktosefrei")]),a("input",{directives:[{name:"model",rawName:"v-model",value:e.form.laktosefrei,expression:"form.laktosefrei"}],attrs:{type:"checkbox","true-value":"1","false-value":"0"},domProps:{checked:Array.isArray(e.form.laktosefrei)?e._i(e.form.laktosefrei,null)>-1:e._q(e.form.laktosefrei,"1")},on:{change:function(t){var a=e.form.laktosefrei,r=t.target,i=r.checked?"1":"0";if(Array.isArray(a)){var s=null,n=e._i(a,s);r.checked?n<0&&e.$set(e.form,"laktosefrei",a.concat([s])):n>-1&&e.$set(e.form,"laktosefrei",a.slice(0,n).concat(a.slice(n+1)))}else e.$set(e.form,"laktosefrei",i)}}})]),a("li",[a("label",[e._v("Glutenfrei")]),a("input",{directives:[{name:"model",rawName:"v-model",value:e.form.glutenfrei,expression:"form.glutenfrei"}],attrs:{type:"checkbox","true-value":"1","false-value":"0"},domProps:{checked:Array.isArray(e.form.glutenfrei)?e._i(e.form.glutenfrei,null)>-1:e._q(e.form.glutenfrei,"1")},on:{change:function(t){var a=e.form.glutenfrei,r=t.target,i=r.checked?"1":"0";if(Array.isArray(a)){var s=null,n=e._i(a,s);r.checked?n<0&&e.$set(e.form,"glutenfrei",a.concat([s])):n>-1&&e.$set(e.form,"glutenfrei",a.slice(0,n).concat(a.slice(n+1)))}else e.$set(e.form,"glutenfrei",i)}}})]),a("li",[a("label",[e._v("Bio")]),a("input",{directives:[{name:"model",rawName:"v-model",value:e.form.bio,expression:"form.bio"}],attrs:{type:"checkbox","true-value":"1","false-value":"0"},domProps:{checked:Array.isArray(e.form.bio)?e._i(e.form.bio,null)>-1:e._q(e.form.bio,"1")},on:{change:function(t){var a=e.form.bio,r=t.target,i=r.checked?"1":"0";if(Array.isArray(a)){var s=null,n=e._i(a,s);r.checked?n<0&&e.$set(e.form,"bio",a.concat([s])):n>-1&&e.$set(e.form,"bio",a.slice(0,n).concat(a.slice(n+1)))}else e.$set(e.form,"bio",i)}}})]),a("li",[a("label",[e._v("Regional")]),a("input",{directives:[{name:"model",rawName:"v-model",value:e.form.regional,expression:"form.regional"}],attrs:{type:"checkbox","true-value":"1","false-value":"0"},domProps:{checked:Array.isArray(e.form.regional)?e._i(e.form.regional,null)>-1:e._q(e.form.regional,"1")},on:{change:function(t){var a=e.form.regional,r=t.target,i=r.checked?"1":"0";if(Array.isArray(a)){var s=null,n=e._i(a,s);r.checked?n<0&&e.$set(e.form,"regional",a.concat([s])):n>-1&&e.$set(e.form,"regional",a.slice(0,n).concat(a.slice(n+1)))}else e.$set(e.form,"regional",i)}}})]),a("li",[a("label",[e._v("Beschreibung")]),a("textarea",{directives:[{name:"model",rawName:"v-model",value:e.descClean,expression:"descClean"}],domProps:{value:e.descClean},on:{input:function(t){t.target.composing||(e.descClean=t.target.value)}}})])]),a("br"),a("button",{staticClass:"btn width-100p",on:{click:e.submitForm}},[a("i",{staticClass:"fa fa-save"}),e._v(" Speichern")])])])},v=[],h={name:"Form",props:{dates:Array},data:function(){return{modalActive:!1,error:!1,form:{date:!1,preis_schueler:"",preis_default:"",title:"",desc:"",vegetarisch:!1,vegan:!1,laktosefrei:!1,glutenfrei:!1,bio:!1,regional:!1}}},created:function(){var e=this;EventBus.$on("form--open",(function(t){t.item.date&&(e.form=t.item,e.modalActive=!0)})),EventBus.$on("form--close",(function(t){e.handlerCloseModal()}))},computed:{descClean:{get:function(){return this.form.desc?this.form.desc.replaceAll("<br />",""):""},set:function(e){return this.form.desc=e,e}}},methods:{handlerCloseModal:function(){this.modalActive=!1},submitForm:function(){var e=this;this.form.date=this.$date(this.form.date).format("YYYY-MM-DD"),EventBus.$emit("form--submit",{form:e.form})}}},p=h,g=Object(d["a"])(p,m,v,!1,null,null,null),_=g.exports,b=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{directives:[{name:"show",rawName:"v-show",value:e.modalActive,expression:"modalActive"}],staticClass:"form-modal",on:{click:function(t){return t.target!==t.currentTarget?null:e.handlerCloseModal(t)}}},[a("div",{staticClass:"form form-style-2 form-modal-content width-40vw"},[a("div",{staticClass:"form-modal-close",on:{click:e.handlerCloseModal}},[a("i",{staticClass:"fa fa-times"})]),a("br"),a("div",{staticClass:"text-big-s text-grey margin-b-s"},[e._v(e._s(e.$date(e.item.date).format("dddd DD.MM.YYYY")))]),a("div",{staticClass:"text-big-m margin-b-l"},[e._v(e._s(e.item.title))]),a("div",{staticClass:"margin-b-l text-green flex-row-wrap"},[1==e.item.vegetarisch?a("div",{staticClass:"flex-b-50"},[a("i",{staticClass:"fas fa-seedling width-2rem"}),e._v(" Vegetarisch")]):e._e(),1==e.item.vegan?a("div",{staticClass:"flex-b-50"},[a("i",{staticClass:"fas fa-leaf width-2rem"}),e._v(" Vegan")]):e._e(),1==e.item.laktosefrei?a("div",{staticClass:"flex-b-50"},[a("i",{staticClass:"fas fa-wine-bottle width-2rem "}),e._v(" Laktosefrei")]):e._e(),1==e.item.glutenfrei?a("div",{staticClass:"flex-b-50"},[a("i",{staticClass:"fab fa-pagelines width-2rem"}),e._v(" Glutenfrei")]):e._e(),1==e.item.bio?a("div",{staticClass:"flex-b-50"},[a("i",{staticClass:"fas fa-leaf width-2rem"}),e._v(" Bio")]):e._e(),1==e.item.regional?a("div",{staticClass:"flex-b-50"},[a("i",{staticClass:"fas fa-tractor width-2rem"}),e._v(" Regional")]):e._e()]),a("div",{staticClass:"margin-b-m"},[a("div",{directives:[{name:"show",rawName:"v-show",value:e.item.preis_default,expression:"item.preis_default"}]},[a("label",[e._v("Bedienstete:")]),e._v(" "+e._s(e.replaceFloat(e.item.preis_default))+" €")]),a("div",{directives:[{name:"show",rawName:"v-show",value:e.item.preis_schueler,expression:"item.preis_schueler"}]},[a("label",[e._v("Schüler:")]),e._v(" "+e._s(e.replaceFloat(e.item.preis_schueler))+" €")])]),a("div",{domProps:{innerHTML:e._s(e.item.desc)}},[e._v(e._s(e.item.desc))]),a("div",{staticClass:"margin-t-l padding-b-l"},[a("hr"),e.item.booked_all?a("div",[a("h3",{staticClass:"text-orange"},[e._v("Gebuchte Essen")]),a("div",{staticClass:"flex-row"},[a("div",{staticClass:"flex-1 margin-r-l"},[a("div",{staticClass:"margin-b-m"},[a("label",[e._v("Summe:")]),e._v(" "+e._s(e.item.booked_all.summe)+"\n            ")])]),a("div",{staticClass:"flex-1"},[a("div",[a("label",[e._v("Schüler:")]),e._v("\n              "+e._s(e.item.booked_all.schueler)+"\n            ")]),a("div",[a("label",[e._v("Eltern:")]),e._v("\n              "+e._s(e.item.booked_all.eltern)+"\n            ")]),a("div",[a("label",[e._v("Lehrer:")]),e._v("\n              "+e._s(e.item.booked_all.lehrer)+"\n            ")]),a("div",[a("label",[e._v("Mitarbeiter:")]),e._v("\n              "+e._s(e.item.booked_all.none)+"\n            ")])])]),a("br"),a("h4",[e._v("Benutzerliste")]),a("ul",{staticClass:"noListStyle"},e._l(e.item.booked_all.list,(function(t,r){return a("li",{key:r,staticClass:"flex-row"},[a("div",{staticClass:"flex-2"},[e._v(e._s(t[1]))]),a("div",{staticClass:"flex-1 text-small"},[e._v(e._s(t[2]))]),a("div",{staticClass:"flex-1 text-small"},[e._v(e._s(t[3]))])])})),0)]):e._e(),a("hr"),a("button",{staticClass:"btn margin-r-s",on:{click:function(t){return e.openForm(e.item)}}},[a("i",{staticClass:"fa fa-edit"}),e._v(" Bearbeiten")]),a("button",{directives:[{name:"show",rawName:"v-show",value:!e.deleteBtn,expression:"!deleteBtn"}],staticClass:"btn",on:{click:e.handlerClickDelete}},[a("i",{staticClass:"fa fa-trash"}),e._v("Löschen")]),a("button",{directives:[{name:"show",rawName:"v-show",value:e.deleteBtn,expression:"deleteBtn"}],staticClass:"btn btn-red",on:{click:function(t){return e.handlerClickDeleteSecond(e.item)}}},[e._v("Endgültig Entfernen!")])])])])},k=[],y=(a("c5f6"),a("5df2"),a("a481"),{name:"Item",props:{dates:Array},data:function(){return{modalActive:!1,deleteBtn:!1,error:!1,item:{}}},created:function(){var e=this;EventBus.$on("item--open",(function(t){t.item&&(e.item=t.item,e.modalActive=!0)}))},computed:{},methods:{handlerClickDelete:function(){this.deleteBtn=!0},handlerClickDeleteSecond:function(e){return!!e.id&&(EventBus.$emit("item--delete",{item:e}),this.handlerCloseModal(),!1)},openForm:function(e){return!!e&&(EventBus.$emit("form--open",{item:e}),this.handlerCloseModal(),!1)},replaceFloat:function(e){return!!e&&Number.parseFloat(e).toFixed(2).replace(".",",")},handlerCloseModal:function(){this.modalActive=!1,this.deleteBtn=!1}}}),C=y,w=Object(d["a"])(C,b,k,!1,null,null,null),x=w.exports,$=a("bc3a").default,D={name:"app",components:{Calendar:u,Form:_,Item:x},data:function(){return{loading:!1,error:!1,dates:[]}},created:function(){var e=this,t=this;EventBus.$on("calendar--changedDate",(function(a){e.showFirstDayWeek=a.von,e.showLastDayWeek=a.bis,t.ajaxGet("index.php?page=mensaSpeiseplan&action=getWeek",{von:e.showFirstDayWeek,bis:e.showLastDayWeek},(function(e,t){e.data&&1!=e.data.error?t.dates=e.data:t.dates=[]}))}),(function(){console.log("error")})),EventBus.$on("form--submit",(function(e){if(!e.form.date||!e.form.title)return!1;t.ajaxPost("rest.php/SetMensaMeal",{data:e.form},{},(function(e,t){t.error=!1,1==e.data.error&&e.data.msg?t.error=e.data.msg:1==e.data.done&&(EventBus.$emit("calender--reload",{}),EventBus.$emit("form--close",{}))}))})),EventBus.$on("item--delete",(function(e){if(!e.item||!e.item.id)return!1;console.log(e.item),t.ajaxPost("rest.php/SetMensaMeal/delete",{data:e.item},{},(function(e,t){t.error=!1,1==e.data.error&&e.data.msg?t.error=e.data.msg:1==e.data.done&&EventBus.$emit("calender--reload",{})}))})),EventBus.$on("item--order",(function(e){if(!e.item||!e.item.id)return!1;t.ajaxPost("rest.php/SetMensaOrder",{data:e.item},{},(function(t,a){a.error=!1,1==t.data.error&&t.data.msg?a.error=t.data.msg:1==t.data.done&&(e.item.booked=t.data.booked)}))}))},methods:{ajaxGet:function(e,t,a,r,i){this.loading=!0;var s=this;$.get(e,{params:t}).then((function(e){a&&"function"===typeof a&&a(e,s)})).catch((function(e){e&&"function"===typeof r&&r(e)})).finally((function(){i&&"function"===typeof i&&i(),s.loading=!1}))},ajaxPost:function(e,t,a,r,i,s){this.loading=!0;var n=this;$.post(e,t,{params:a}).then((function(e){r&&"function"===typeof r&&r(e,n)})).catch((function(e){e&&"function"===typeof i&&i(e)})).finally((function(){s&&"function"===typeof s&&s(),n.loading=!1}))}}},B=D,A=Object(d["a"])(B,i,s,!1,null,null,null),E=A.exports,M=a("5a0c"),W=a.n(M);a("6210");window.EventBus=new r["a"],W.a.locale("de"),Object.defineProperties(r["a"].prototype,{$date:{get:function(){return W.a}}}),r["a"].config.productionTip=!1;var O=!1;O=O||{objekt:!1},new r["a"]({render:function(e){return e(E)}}).$mount("#app")}});
//# sourceMappingURL=app.js.map