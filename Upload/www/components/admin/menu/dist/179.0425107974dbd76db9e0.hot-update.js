self.webpackHotUpdatemenu(179,{3097:(e,t,i)=>{"use strict";i.d(t,{Z:()=>n});const n={components:{},props:{item:Array,pages:Array,items:Array},data:function(){return{deleteItem:!1,pagesOpen:!1,parentOpen:!1,accessOpen:!1}},created:function(){},methods:{handlerToggleActive:function(e){console.log("1.",this.item.access.admin),console.log("2.",this.item.access[e])},handlerAccessOpen:function(){this.accessOpen?this.accessOpen=!1:this.accessOpen=!0},handlerParentOpen:function(){this.parentOpen?this.parentOpen=!1:this.parentOpen=!0},handlerParentSelect:function(e){e.id&&e.title&&(this.item.parent_id=e.id,this.item.parent_title=e.title),this.parentOpen=!1},handlerPagesSelect:function(e){if(!e.title||!e.url)return!1;this.item.page=e.url.page,this.item.params=JSON.stringify(e.url.params),this.pagesOpen=!1},handlerPagesOpen:function(){this.pagesOpen?this.pagesOpen=!1:this.pagesOpen=!0},handlerSubmit:function(){if(!this.item.title)return!1;this.deleteItem=!1,EventBus.$emit("item-form--submit",{item:this.item})},handlerBack:function(){this.deleteItem=!1,this.pagesOpen=!1,EventBus.$emit("show--set",{show:"items"})},handlerDelete:function(e){if(!e.id)return!1;this.deleteItem=e,this.pagesOpen=!1},handlerDeleteSure:function(){if(!this.item.id)return!1;this.deleteItem=!1,this.pagesOpen=!1,EventBus.$emit("item-form--delete",{item:this.item})}}}}},(function(e){"use strict";e.h=()=>"80b26994d0c46ff6782a"}));