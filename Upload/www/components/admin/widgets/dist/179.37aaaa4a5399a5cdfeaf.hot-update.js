self.webpackHotUpdateextensions(179,{141:(s,t,a)=>{"use strict";a.r(t),a.d(t,{render:()=>e,staticRenderFns:()=>i});var e=function(){var s=this,t=s.$createElement,a=s._self._c||t;return a("div",{staticClass:"width-55vw"},[a("div",{staticClass:"flex-row"},[a("div",{staticClass:"flex-1"},[a("button",{staticClass:"si-btn si-btn-light",on:{click:s.handlerBack}},[s._v(" Zurück")])])]),s._v(" "),s._m(0),s._v(" "),a("div",{staticClass:"si-form"},[a("ul",[a("li",[a("label",[s._v("Name")]),s._v(" "),a("input",{staticClass:"readonly",attrs:{type:"text",readonly:""},domProps:{value:s.item.title}})]),s._v(" "),a("li",[a("label",[s._v("UniqID")]),s._v(" "),a("input",{attrs:{type:"text",readonly:""},domProps:{value:s.item.uniqid}})]),s._v(" "),a("li",[a("label",[s._v("Position")]),s._v(" "),a("input",{attrs:{type:"text",readonly:""},domProps:{value:s.item.position}})]),s._v(" "),a("li",{staticClass:"line-oddEven padding-t-m padding-b-m"},[a("label",{staticClass:"width-12rem padding-l-l"},[s._v("Sichtbarkeit")]),s._v(" "),s.item.access?a("div",{staticClass:"blockInline"},[a("button",{staticClass:"si-btn margin-r-s",class:{"si-btn-active":1==s.item.access.admin},on:{click:function(t){return s.handlerToggleAccess("admin")}}},[1==s.item.access.admin?a("i",{staticClass:"fas fa-toggle-on"}):s._e(),s._v(" "),0==s.item.access.admin?a("i",{staticClass:"fas fa-toggle-off"}):s._e(),s._v(" Admin")]),s._v(" "),a("button",{staticClass:"si-btn margin-r-s",class:{"si-btn-active":1==s.item.access.adminGroup},on:{click:function(t){return s.handlerToggleAccess("adminGroup")}}},[1==s.item.access.adminGroup?a("i",{staticClass:"fas fa-toggle-on"}):s._e(),s._v(" "),0==s.item.access.adminGroup?a("i",{staticClass:"fas fa-toggle-off"}):s._e(),s._v(" Moduladmin")]),s._v(" "),a("br"),s._v(" "),a("button",{staticClass:"si-btn margin-r-s",class:{"si-btn-active":1==s.item.access.teacher},on:{click:function(t){return s.handlerToggleAccess("teacher")}}},[1==s.item.access.teacher?a("i",{staticClass:"fas fa-toggle-on"}):s._e(),s._v(" "),0==s.item.access.teacher?a("i",{staticClass:"fas fa-toggle-off"}):s._e(),s._v(" Lehrer")]),s._v(" "),a("button",{staticClass:"si-btn margin-r-s",class:{"si-btn-active":1==s.item.access.pupil},on:{click:function(t){return s.handlerToggleAccess("pupil")}}},[1==s.item.access.pupil?a("i",{staticClass:"fas fa-toggle-on"}):s._e(),s._v(" "),0==s.item.access.pupil?a("i",{staticClass:"fas fa-toggle-off"}):s._e(),s._v(" Schüler")]),s._v(" "),a("button",{staticClass:"si-btn margin-r-s",class:{"si-btn-active":1==s.item.access.parents},on:{click:function(t){return s.handlerToggleAccess("parents")}}},[1==s.item.access.parents?a("i",{staticClass:"fas fa-toggle-on"}):s._e(),s._v(" "),0==s.item.access.parents?a("i",{staticClass:"fas fa-toggle-off"}):s._e(),s._v(" Eltern")]),s._v(" "),a("button",{staticClass:"si-btn margin-r-s",class:{"si-btn-active":1==s.item.access.other},on:{click:function(t){return s.handlerToggleAccess("other")}}},[1==s.item.access.other?a("i",{staticClass:"fas fa-toggle-on"}):s._e(),s._v(" "),0==s.item.access.other?a("i",{staticClass:"fas fa-toggle-off"}):s._e(),s._v(" Sonstige")])]):s._e()]),s._v(" "),a("li",[a("br"),s._v(" "),a("button",{staticClass:"si-btn",on:{click:s.handlerSubmit}},[a("i",{staticClass:"fas fa-mouse-pointer"}),s._v(" Speichern")])])])])])},i=[function(){var s=this,t=s.$createElement,a=s._self._c||t;return a("h3",[a("i",{staticClass:"fa fas fa-chart-pie"}),s._v(" Widget Bearbeiten")])}];e._withStripped=!0}},(function(s){"use strict";s.h=()=>"52e0f406949c9b0842b0"}));