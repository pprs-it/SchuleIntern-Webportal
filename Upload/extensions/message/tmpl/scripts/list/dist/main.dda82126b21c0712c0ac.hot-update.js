"use strict";
/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
self["webpackHotUpdateextensions"]("main",{

/***/ "./node_modules/babel-loader/lib/index.js!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/App.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/App.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => (__WEBPACK_DEFAULT_EXPORT__)\n/* harmony export */ });\n/* harmony import */ var _mixins_User_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./mixins/User.vue */ \"./src/mixins/User.vue\");\n/* harmony import */ var _mixins_AjaxError_vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./mixins/AjaxError.vue */ \"./src/mixins/AjaxError.vue\");\n/* harmony import */ var _mixins_AjaxSpinner_vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./mixins/AjaxSpinner.vue */ \"./src/mixins/AjaxSpinner.vue\");\n/* harmony import */ var _mixins_Modal_vue__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./mixins/Modal.vue */ \"./src/mixins/Modal.vue\");\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\nvar axios = (__webpack_require__(/*! axios */ \"./node_modules/axios/index.js\")[\"default\"]);\n\n\n\n\n\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({\n  components: {\n    User: _mixins_User_vue__WEBPACK_IMPORTED_MODULE_0__[\"default\"],\n    AjaxError: _mixins_AjaxError_vue__WEBPACK_IMPORTED_MODULE_1__[\"default\"],\n    AjaxSpinner: _mixins_AjaxSpinner_vue__WEBPACK_IMPORTED_MODULE_2__[\"default\"],\n    Modal: _mixins_Modal_vue__WEBPACK_IMPORTED_MODULE_3__[\"default\"]\n  },\n  data: function data() {\n    return {\n      apiURL: globals.apiURL,\n      error: false,\n      loading: false,\n      folders: false,\n      // from AJAX\n      messages: false,\n      // from AJAX\n      message: false // from AJAX\n\n    };\n  },\n  created: function created() {\n    this.loadFolders();\n  },\n  mounted: function mounted() {\n    /*\n        EventBus.$on('item-submit', data => {\n          //console.log(data)\n           const formData = new FormData();\n          formData.append('id', data.id);\n          formData.append('einheiten', data.einheiten);\n           this.loading = true;\n          var that = this;\n          axios.post( this.apiURL+'/orderSlot', formData, {\n              headers: {\n                'Content-Type': 'multipart/form-data'\n              }\n            })\n            .then(function(response){\n              if ( response.data ) {\n                //that.list = response.data;\n                //console.log(response.data.error);\n                if (response.data.error == false) {\n                  that.loadList();\n                  that.selectedItem = false;\n                } else {\n                  that.error = ''+response.data.msg;\n                }\n              } else {\n                that.error = 'Fehler beim Laden. 01';\n              }\n            })\n            .catch(function(){\n              that.error = 'Fehler beim Laden. 02';\n            })\n            .finally(function () {\n              // always executed\n              that.loading = false;\n            });\n         });\n    */\n  },\n  methods: {\n    handlerOpenMessage: function handlerOpenMessage(message) {\n      console.log(message);\n\n      if (!message.id) {\n        return false;\n      }\n\n      this.loading = true;\n      var that = this;\n      axios.get(this.apiURL + '/getMessage/' + message.id).then(function (response) {\n        if (response.data) {\n          if (!response.data.error) {\n            that.message = response.data; //console.log(response.data);\n          } else {\n            that.error = '' + response.data.msg;\n          }\n        } else {\n          that.error = 'Fehler beim Laden. 01';\n        }\n      })[\"catch\"](function () {\n        that.error = 'Fehler beim Laden. 02';\n      })[\"finally\"](function () {\n        // always executed\n        that.loading = false;\n      });\n    },\n    handlerOpenFolder: function handlerOpenFolder(folder) {\n      if (!folder) {\n        return false;\n      }\n\n      this.loading = true;\n      var that = this;\n      axios.get(this.apiURL + '/getMessages/' + folder).then(function (response) {\n        if (response.data) {\n          if (!response.data.error) {\n            that.messages = response.data; //console.log(response.data);\n          } else {\n            that.error = '' + response.data.msg;\n          }\n        } else {\n          that.error = 'Fehler beim Laden. 01';\n        }\n      })[\"catch\"](function () {\n        that.error = 'Fehler beim Laden. 02';\n      })[\"finally\"](function () {\n        // always executed\n        that.loading = false;\n      });\n    },\n    loadFolders: function loadFolders() {\n      this.loading = true;\n      var that = this;\n      axios.get(this.apiURL + '/getMyFolders').then(function (response) {\n        if (response.data) {\n          if (!response.data.error) {\n            that.folders = response.data; //console.log(response.data);\n\n            that.handlerOpenFolder('posteingang');\n          } else {\n            that.error = '' + response.data.msg;\n          }\n        } else {\n          that.error = 'Fehler beim Laden. 01';\n        }\n      })[\"catch\"](function () {\n        that.error = 'Fehler beim Laden. 02';\n      })[\"finally\"](function () {\n        // always executed\n        that.loading = false;\n      });\n    }\n  }\n});\n\n//# sourceURL=webpack://extensions/./src/App.vue?./node_modules/babel-loader/lib/index.js!./node_modules/vue-loader/lib/index.js??vue-loader-options");

/***/ })

},
/******/ function(__webpack_require__) { // webpackRuntimeModules
/******/ /* webpack/runtime/getFullHash */
/******/ (() => {
/******/ 	__webpack_require__.h = () => ("46aef457ac4d1d363c40")
/******/ })();
/******/ 
/******/ }
);