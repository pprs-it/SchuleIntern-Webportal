self.webpackHotUpdateextensions(179,{62:(s,t,a)=>{"use strict";a.r(t),a.d(t,{render:()=>e,staticRenderFns:()=>i});var e=function(){var s=this,t=s.$createElement,a=s._self._c||t;return a("div",[a("Error",{attrs:{error:s.error}}),s._v(" "),a("Spinner",{attrs:{loading:s.loading}}),s._v(" "),s._m(0),s._v(" "),a("br"),a("br"),s._v(" "),s._l(s.list,(function(t,e){return a("div",{key:e},[a("h4",[a("i",{staticClass:"fa fas fa-plug"}),s._v(" "+s._s(t.title))]),s._v(" "),a("table",{staticClass:"si-table"},[s._m(1,!0),s._v(" "),a("tbody",s._l(t.widgets,(function(t,e){return a("tr",{key:e,staticClass:"line-oddEven"},[a("td",[s._v(s._s(t.title)+" "),a("div",{staticClass:"text-small text-grey"},[s._v(s._s(t.uniqid))])]),s._v(" "),a("td",[a("span",{staticClass:"text-grey"},[s._v(s._s(t.position))])]),s._v(" "),a("td",[s._v("\n"+s._s(t.access)+"\n            "),t.access?a("div",{staticClass:"blockInline"},[a("button",{staticClass:"si-btn margin-r-s",class:{"si-btn-active":1==t.access.admin},on:{click:function(a){return s.handlerToggleAccess(t,"admin")}}},[1==t.access.admin?a("i",{staticClass:"fas fa-toggle-on"}):s._e(),s._v(" "),0==t.access.admin?a("i",{staticClass:"fas fa-toggle-off"}):s._e(),s._v(" Admin")]),s._v(" "),a("button",{staticClass:"si-btn margin-r-s",class:{"si-btn-active":1==t.access.adminGroup},on:{click:function(t){return s.handlerToggleAccess("adminGroup")}}},[1==t.access.adminGroup?a("i",{staticClass:"fas fa-toggle-on"}):s._e(),s._v(" "),0==t.access.adminGroup?a("i",{staticClass:"fas fa-toggle-off"}):s._e(),s._v(" Moduladmin")]),s._v(" "),a("br"),s._v(" "),a("button",{staticClass:"si-btn margin-r-s",class:{"si-btn-active":1==t.access.teacher},on:{click:function(t){return s.handlerToggleAccess("teacher")}}},[1==t.access.teacher?a("i",{staticClass:"fas fa-toggle-on"}):s._e(),s._v(" "),0==t.access.teacher?a("i",{staticClass:"fas fa-toggle-off"}):s._e(),s._v(" Lehrer")]),s._v(" "),a("button",{staticClass:"si-btn margin-r-s",class:{"si-btn-active":1==t.access.pupil},on:{click:function(t){return s.handlerToggleAccess("pupil")}}},[1==t.access.pupil?a("i",{staticClass:"fas fa-toggle-on"}):s._e(),s._v(" "),0==t.access.pupil?a("i",{staticClass:"fas fa-toggle-off"}):s._e(),s._v(" Schüler")]),s._v(" "),a("button",{staticClass:"si-btn margin-r-s",class:{"si-btn-active":1==t.access.parents},on:{click:function(t){return s.handlerToggleAccess("parents")}}},[1==t.access.parents?a("i",{staticClass:"fas fa-toggle-on"}):s._e(),s._v(" "),0==t.access.parents?a("i",{staticClass:"fas fa-toggle-off"}):s._e(),s._v(" Eltern")]),s._v(" "),a("button",{staticClass:"si-btn margin-r-s",class:{"si-btn-active":1==t.access.other},on:{click:function(t){return s.handlerToggleAccess("other")}}},[1==t.access.other?a("i",{staticClass:"fas fa-toggle-on"}):s._e(),s._v(" "),0==t.access.other?a("i",{staticClass:"fas fa-toggle-off"}):s._e(),s._v(" Sonstige")])]):s._e()]),s._v(" "),a("td",[1==t.status?a("button",{staticClass:"si-btn si-btn-light text-green",on:{click:function(a){return s.handlerToggleActive(t)}}},[a("i",{staticClass:"fas fa-toggle-on"})]):s._e(),s._v(" "),0==t.status?a("button",{staticClass:"si-btn si-btn-light",on:{click:function(a){return s.handlerToggleActive(t)}}},[a("i",{staticClass:"fas fa-toggle-off"})]):s._e()])])})),0)])])}))],2)},i=[function(){var s=this,t=s.$createElement,a=s._self._c||t;return a("h3",[a("i",{staticClass:"fa fas fa-chart-pie"}),s._v(" Verfügbare Widgets")])},function(){var s=this,t=s.$createElement,a=s._self._c||t;return a("thead",[a("tr",[a("td",[s._v("Name")]),s._v(" "),a("td",[s._v("Position")]),s._v(" "),a("td",[s._v("Sichtbarkeit")]),s._v(" "),a("td",[s._v("Aktiviert")])])])}];e._withStripped=!0}},(function(s){"use strict";s.h=()=>"35b19eeb65cfe1563362"}));