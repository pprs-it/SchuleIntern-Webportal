self.webpackHotUpdateextensions(179,{761:(t,e,i)=>{"use strict";i.d(e,{Z:()=>o});var a=i(586),n=i(912),s=i(559).default;const o={components:{Error:a.Z,Spinner:n.Z},data:function(){return{selfURL:globals.selfURL,error:!1,loading:!1,tab:"list",list:!1,item:!1}},created:function(){this.loadList()},methods:{handlerToggleAccess:function(t){this.item.access.admin="a",1==this.item.access.admin?this.item.access.admin=0:(console.log("wft"),console.log(this.item.access.admin),this.item.access.admin="a")},handlerFormShow:function(t){this.item=t,this.tab="form"},loadList:function(){this.loading=!0;var t=this;s.get(this.selfURL+"&task=api-list").then((function(e){e.data?t.list=e.data:t.error="Fehler beim Laden. 01"})).catch((function(){t.error="Fehler beim Laden. 02"})).finally((function(){t.loading=!1}))},handlerToggleActive:function(t){if(!t.uniqid)return!1;this.error=!1;var e=new FormData;e.append("uniqid",t.uniqid),e.append("position",t.position),e.append("access",t.access),this.loading=!0;var i=this;s.post(this.selfURL+"&task=api-toggle-active",e,{headers:{"Content-Type":"multipart/form-data"}}).then((function(t){t.data?1==t.data.error?i.error=t.data.msg:(i.error=!1,i.loadList()):i.error="Fehler beim Aktivieren. 01"})).catch((function(){i.error="Fehler beim Aktivieren. 02"})).finally((function(){}))}}}}},(function(t){"use strict";t.h=()=>"5a97174c4bc3cbab6640"}));