self.webpackHotUpdatemenu(179,{5761:(e,t,n)=>{"use strict";n.d(t,{Z:()=>d});var i=n(5586),a=n(3228),o=n(4837),r=n(3802),s=n(4559).default;const d={components:{Error:i.Z,Menu:a.Z,ItemsCats:o.Z,ItemForm:r.Z},data:function(){return{selfURL:globals.selfURL,error:!1,loading:!1,show:"",itemOpen:!1,pages:globals.pages,list:!1,items:!1}},created:function(){var e=this;this.loadExtensions(),EventBus.$on("show--set",(function(t){if(!t.show)return!1;e.show=t.show})),EventBus.$on("menu--open",(function(t){if(!t.item.id)return!1;e.loadItems(t.item)})),EventBus.$on("item-form--open",(function(t){t.item&&t.item.id?e.itemOpen=t.item:e.itemOpen={},t.parent&&(e.itemOpen.parent_id=t.parent.id,e.itemOpen.parent_title=t.parent.title),e.show="form"})),EventBus.$on("item-form--sort",(function(t){if(!t.items)return!1;e.loading=!0;var n=e,i=new FormData;i.append("items",JSON.stringify(t.items)),s.post(e.selfURL+"&task=item-sort",i).then((function(e){e.data?1!=e.data.error||(n.error=e.data.msg):n.error="Fehler beim Laden. 01"})).catch((function(e){n.error="Fehler beim Laden. 02"})).finally((function(){n.loading=!1}))})),EventBus.$on("item-form--submit",(function(t){if(!t.item.title)return!1;e.loading=!0;var n=e,i=new FormData;i.append("id",t.item.id||!1),i.append("title",t.item.title||""),i.append("icon",t.item.icon||""),i.append("params",t.item.params||""),i.append("pageurl",t.item.page||""),i.append("parent_id",t.item.parent_id||0),i.append("access",JSON.encode(t.item.access)||""),s.post(e.selfURL+"&task=item-submit&id="+t.item.id,i).then((function(e){e.data?1!=e.data.error?(n.loadItems(n.openMenu),n.show="items"):n.error=e.data.msg:n.error="Fehler beim Laden. 01"})).catch((function(e){n.error="Fehler beim Laden. 02"})).finally((function(){n.loading=!1}))})),EventBus.$on("item-form--delete",(function(t){if(!t.item.id)return!1;e.loading=!0;var n=e,i=new FormData;i.append("id",t.item.id||!1),s.post(e.selfURL+"&task=item-delete&id="+t.item.id,i).then((function(e){e.data?n.loadItems(n.openMenu):n.error="Fehler beim Laden. 01"})).catch((function(e){n.error="Fehler beim Laden. 02"})).finally((function(){n.loading=!1}))})),EventBus.$on("item-form--active",(function(t){if(!t.item.id)return!1;e.loading=!0;var n=e,i=new FormData;i.append("id",t.item.id||!1),i.append("active",t.item.active),s.post(e.selfURL+"&task=item-active&id="+t.item.id,i).then((function(e){e.data?t.item.active=e.data.active:n.error="Fehler beim Laden. 01"})).catch((function(e){n.error="Fehler beim Laden. 02"})).finally((function(){n.loading=!1}))}))},methods:{loadItems:function(e){if(!e.alias)return!1;this.loading=!0;var t=this;s.get(this.selfURL+"&task=api-items&id="+e.alias).then((function(n){n.data?(t.items=n.data,t.show="items",t.openMenu=e):t.error="Fehler beim Laden. 01"})).catch((function(){t.error="Fehler beim Laden. 02"})).finally((function(){t.loading=!1}))},loadExtensions:function(){this.loading=!0;var e=this;s.get(this.selfURL+"&task=api-all").then((function(t){t.data?(e.list=t.data,e.show="menu"):e.error="Fehler beim Laden. 01"})).catch((function(){e.error="Fehler beim Laden. 02"})).finally((function(){e.loading=!1}))}}}}},(function(e){"use strict";e.h=()=>"216a171def6f24abb9bc"}));