self.webpackHotUpdateextensions(179,{761:(t,e,i)=>{"use strict";i.d(e,{Z:()=>o});var r=i(586),n=i(912),a=i(559).default;const o={components:{Error:r.Z,Spinner:n.Z},data:function(){return{selfURL:globals.selfURL,error:!1,loading:!1,tab:"list",list:!1,form:!1}},created:function(){this.loadList()},methods:{handlerToggleAccess:function(t){console.log(this.form.access),1==this.form.access[t]?this.form.access[t]=0:this.form.access[t]=1},handlerFormShow:function(t){this.form=t,this.tab="form"},loadList:function(){this.loading=!0;var t=this;a.get(this.selfURL+"&task=api-list").then((function(e){e.data?t.list=e.data:t.error="Fehler beim Laden. 01"})).catch((function(){t.error="Fehler beim Laden. 02"})).finally((function(){t.loading=!1}))},handlerToggleActive:function(t){if(!t.uniqid)return!1;this.error=!1;var e=new FormData;e.append("uniqid",t.uniqid),e.append("position",t.position),e.append("access",t.access),this.loading=!0;var i=this;a.post(this.selfURL+"&task=api-toggle-active",e,{headers:{"Content-Type":"multipart/form-data"}}).then((function(t){t.data?1==t.data.error?i.error=t.data.msg:(i.error=!1,i.loadList()):i.error="Fehler beim Aktivieren. 01"})).catch((function(){i.error="Fehler beim Aktivieren. 02"})).finally((function(){}))}}}}},(function(t){"use strict";t.h=()=>"114071c0d9fa9210b770"}));