import Vue from 'vue';
import App from './App.vue';

Vue.config.productionTip = false


var globals = false;
globals = globals || {
  objekt:  false
};

new Vue({
  el: '#app-widget-raumplan-mynext',
  render: h => h(App),
});