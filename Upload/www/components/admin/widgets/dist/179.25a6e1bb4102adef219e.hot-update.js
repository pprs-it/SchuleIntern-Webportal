self.webpackHotUpdateextensions(179,{62:(t,s,i)=>{"use strict";i.r(s),i.d(s,{render:()=>e,staticRenderFns:()=>a});var e=function(){var t=this,s=t.$createElement,i=t._self._c||s;return i("div",[i("Error",{attrs:{error:t.error}}),t._v(" "),i("Spinner",{attrs:{loading:t.loading}}),t._v(" "),"form"==t.tab?i("div",{staticClass:"padding-t-l"},[i("Form",{attrs:{item:t.form}}),t._v("\n\n    "+t._s(t.form)+"\n  ")],1):t._e(),t._v(" "),"list"==t.tab?i("div",[t._m(0),t._v(" "),t._l(t.list,(function(s,e){return i("div",{key:e,staticClass:"padding-t-l"},[i("h4",[i("i",{staticClass:"fa fas fa-plug"}),t._v(" "+t._s(s.title))]),t._v(" "),i("table",{staticClass:"si-table"},[t._m(1,!0),t._v(" "),i("tbody",t._l(s.widgets,(function(s,e){return i("tr",{key:e,staticClass:"line-oddEven"},[i("td",[i("a",{staticClass:"clickable",on:{click:function(i){return t.handlerFormShow(s)}}},[t._v(t._s(s.title)+" "),i("div",{staticClass:"text-small text-grey"},[t._v(t._s(s.uniqid))])])]),t._v(" "),i("td",[i("span",{staticClass:"text-grey"},[t._v(t._s(s.position))])]),t._v(" "),i("td",[t._v("\n            "+t._s(s.access)+"\n            "),s.access.admin?i("button",{staticClass:"si-btn si-btn-light si-btn-small margin-r-s"},[t._v(" Admin")]):t._e()]),t._v(" "),i("td",[1==s.status?i("button",{staticClass:"si-btn si-btn-light text-green",on:{click:function(i){return t.handlerToggleActive(s)}}},[i("i",{staticClass:"fas fa-toggle-on"})]):t._e(),t._v(" "),0==s.status?i("button",{staticClass:"si-btn si-btn-light",on:{click:function(i){return t.handlerToggleActive(s)}}},[i("i",{staticClass:"fas fa-toggle-off"})]):t._e()])])})),0)])])}))],2):t._e()],1)},a=[function(){var t=this,s=t.$createElement,i=t._self._c||s;return i("h3",[i("i",{staticClass:"fa fas fa-chart-pie"}),t._v(" Verfügbare Widgets")])},function(){var t=this,s=t.$createElement,i=t._self._c||s;return i("thead",[i("tr",[i("td",[t._v("Name")]),t._v(" "),i("td",[t._v("Position")]),t._v(" "),i("td",[t._v("Sichtbarkeit")]),t._v(" "),i("td",[t._v("Aktiviert")])])])}];e._withStripped=!0}},(function(t){"use strict";t.h=()=>"2af3882e73085989d5ed"}));