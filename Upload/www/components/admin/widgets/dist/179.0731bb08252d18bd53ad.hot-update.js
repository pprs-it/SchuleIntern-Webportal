self.webpackHotUpdateextensions(179,{761:(e,t,i)=>{"use strict";i.d(t,{Z:()=>s});var n=i(586),r=i(912),a=i(932),o=i(559).default;const s={components:{Error:n.Z,Spinner:r.Z,Form:a.Z},data:function(){return{selfURL:globals.selfURL,error:!1,loading:!1,tab:"list",list:!1,form:!1}},created:function(){var e=this;this.loadList(),EventBus.$on("item-form--submit",(function(t){if(!t.item.uniqid)return!1;e.loading=!0;var i=e,n=new FormData;n.append("id",t.item.id||!1),n.append("uniqid",t.item.uniqid||""),n.append("position",t.item.position||""),n.append("access",JSON.stringify(t.item.access)||""),o.post(e.selfURL+"&task=item-submit&id="+t.item.id,n).then((function(e){e.data?1!=e.data.error?(i.loadItems(i.openMenu),i.show="items"):i.error=e.data.msg:i.error="Fehler beim Laden. 01"})).catch((function(e){i.error="Fehler beim Laden. 02"})).finally((function(){i.loading=!1}))}))},methods:{handlerToggleAccess:function(e){console.log(this.form.access),1==this.form.access[e]?this.form.access[e]=0:this.form.access[e]=1},handlerFormShow:function(e){this.form=e,this.tab="form"},loadList:function(){this.loading=!0;var e=this;o.get(this.selfURL+"&task=api-list").then((function(t){t.data?e.list=t.data:e.error="Fehler beim Laden. 01"})).catch((function(){e.error="Fehler beim Laden. 02"})).finally((function(){e.loading=!1}))},handlerToggleActive:function(e){if(!e.uniqid)return!1;this.error=!1;var t=new FormData;t.append("uniqid",e.uniqid),t.append("position",e.position),t.append("access",e.access),this.loading=!0;var i=this;o.post(this.selfURL+"&task=api-toggle-active",t,{headers:{"Content-Type":"multipart/form-data"}}).then((function(e){e.data?1==e.data.error?i.error=e.data.msg:(i.error=!1,i.loadList()):i.error="Fehler beim Aktivieren. 01"})).catch((function(){i.error="Fehler beim Aktivieren. 02"})).finally((function(){}))}}}}},(function(e){"use strict";e.h=()=>"d2f2d835c6142fb36382"}));