self.webpackHotUpdateextensions(179,{939:(t,e,i)=>{"use strict";var s=i(931),n=i(828);window.EventBus=new s.default,new s.default({el:"#app",render:function(t){return t(n.Z)}})},849:(t,e,i)=>{"use strict";i.d(e,{Z:()=>s});const s={components:{},props:{item:Array},data:function(){return{}},created:function(){},methods:{handlerToggleActive:function(t){1==this.item.access[t]?this.item.access[t]=0:this.item.access[t]=1},handlerSubmit:function(){if(!this.item.title)return!1;this.deleteItem=!1,EventBus.$emit("item-form--submit",{item:this.item})},handlerBack:function(){this.deleteItem=!1,this.pagesOpen=!1,EventBus.$emit("show--set",{show:"items"})}}}}},(function(t){"use strict";t.h=()=>"d671d1d8571ad4bc5fb6"}));