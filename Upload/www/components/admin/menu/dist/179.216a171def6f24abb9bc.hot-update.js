self.webpackHotUpdatemenu(179,{5761:(e,t,i)=>{"use strict";i.d(t,{Z:()=>d});var n=i(5586),a=i(3228),r=i(4837),o=i(3802),s=i(4559).default;const d={components:{Error:n.Z,Menu:a.Z,ItemsCats:r.Z,ItemForm:o.Z},data:function(){return{selfURL:globals.selfURL,error:!1,loading:!1,show:"",itemOpen:!1,pages:globals.pages,list:!1,items:!1}},created:function(){var e=this;this.loadExtensions(),EventBus.$on("show--set",(function(t){if(!t.show)return!1;e.show=t.show})),EventBus.$on("menu--open",(function(t){if(!t.item.id)return!1;e.loadItems(t.item)})),EventBus.$on("item-form--open",(function(t){t.item&&t.item.id?e.itemOpen=t.item:e.itemOpen={},t.parent&&(e.itemOpen.parent_id=t.parent.id,e.itemOpen.parent_title=t.parent.title),e.show="form"})),EventBus.$on("item-form--sort",(function(t){if(!t.items)return!1;e.loading=!0;var i=e,n=new FormData;n.append("items",JSON.stringify(t.items)),s.post(e.selfURL+"&task=item-sort",n).then((function(e){e.data?1!=e.data.error||(i.error=e.data.msg):i.error="Fehler beim Laden. 01"})).catch((function(e){i.error="Fehler beim Laden. 02"})).finally((function(){i.loading=!1}))})),EventBus.$on("item-form--submit",(function(t){if(!t.item.title)return!1;e.loading=!0;var i=e,n=new FormData;n.append("id",t.item.id||!1),n.append("title",t.item.title||""),n.append("icon",t.item.icon||""),n.append("params",t.item.params||""),n.append("pageurl",t.item.page||""),n.append("parent_id",t.item.parent_id||0),n.append("access",JSON.stringify(t.item.access)||""),s.post(e.selfURL+"&task=item-submit&id="+t.item.id,n).then((function(e){e.data?1!=e.data.error?(i.loadItems(i.openMenu),i.show="items"):i.error=e.data.msg:i.error="Fehler beim Laden. 01"})).catch((function(e){i.error="Fehler beim Laden. 02"})).finally((function(){i.loading=!1}))})),EventBus.$on("item-form--delete",(function(t){if(!t.item.id)return!1;e.loading=!0;var i=e,n=new FormData;n.append("id",t.item.id||!1),s.post(e.selfURL+"&task=item-delete&id="+t.item.id,n).then((function(e){e.data?i.loadItems(i.openMenu):i.error="Fehler beim Laden. 01"})).catch((function(e){i.error="Fehler beim Laden. 02"})).finally((function(){i.loading=!1}))})),EventBus.$on("item-form--active",(function(t){if(!t.item.id)return!1;e.loading=!0;var i=e,n=new FormData;n.append("id",t.item.id||!1),n.append("active",t.item.active),s.post(e.selfURL+"&task=item-active&id="+t.item.id,n).then((function(e){e.data?t.item.active=e.data.active:i.error="Fehler beim Laden. 01"})).catch((function(e){i.error="Fehler beim Laden. 02"})).finally((function(){i.loading=!1}))}))},methods:{loadItems:function(e){if(!e.alias)return!1;this.loading=!0;var t=this;s.get(this.selfURL+"&task=api-items&id="+e.alias).then((function(i){i.data?(t.items=i.data,t.show="items",t.openMenu=e):t.error="Fehler beim Laden. 01"})).catch((function(){t.error="Fehler beim Laden. 02"})).finally((function(){t.loading=!1}))},loadExtensions:function(){this.loading=!0;var e=this;s.get(this.selfURL+"&task=api-all").then((function(t){t.data?(e.list=t.data,e.show="menu"):e.error="Fehler beim Laden. 01"})).catch((function(){e.error="Fehler beim Laden. 02"})).finally((function(){e.loading=!1}))}}}}},(function(e){"use strict";e.h=()=>"ceb084c4dd9c3bff4a13"}));