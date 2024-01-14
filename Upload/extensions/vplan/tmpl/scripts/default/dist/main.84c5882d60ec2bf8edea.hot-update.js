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

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => (__WEBPACK_DEFAULT_EXPORT__)\n/* harmony export */ });\n/* harmony import */ var _mixins_Error_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./mixins/Error.vue */ \"./src/mixins/Error.vue\");\n/* harmony import */ var _mixins_Spinner_vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./mixins/Spinner.vue */ \"./src/mixins/Spinner.vue\");\nfunction _typeof(obj) { \"@babel/helpers - typeof\"; if (typeof Symbol === \"function\" && typeof Symbol.iterator === \"symbol\") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === \"function\" && obj.constructor === Symbol && obj !== Symbol.prototype ? \"symbol\" : typeof obj; }; } return _typeof(obj); }\n\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\nvar axios = (__webpack_require__(/*! axios */ \"./node_modules/axios/index.js\")[\"default\"]);\n\n\n\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({\n  components: {\n    Error: _mixins_Error_vue__WEBPACK_IMPORTED_MODULE_0__[\"default\"],\n    Spinner: _mixins_Spinner_vue__WEBPACK_IMPORTED_MODULE_1__[\"default\"]\n  },\n  data: function data() {\n    return {\n      apiURL: globals.apiURL,\n      error: '',\n      loading: false,\n      list: false,\n      // from AJAX\n      indexList: false,\n      sort: {\n        column: 'stunde',\n        order: true\n      },\n      searchColumns: ['klasse', 'stunde', 'user_neu', 'user_alt', 'fach_alt', 'fach_neu', 'raum_alt', 'raum_neu', 'info_1', 'info_2', 'info_3'],\n      searchString: '',\n      renderComponent: true\n    };\n  },\n  created: function created() {\n    this.loadList();\n  },\n  computed: {\n    vlist: function vlist() {\n      var _this = this;\n\n      if (this.indexList >= 0 && this.list[this.indexList] && this.list[this.indexList].data) {\n        var data = this.list[this.indexList].data;\n\n        if (data.length > 0) {\n          // SUCHE\n          if (this.searchString != '') {\n            var split = this.searchString.toLowerCase().split(' ');\n            var search_temp = [];\n            var search_result = [];\n            this.searchColumns.forEach(function (col) {\n              search_temp = data.filter(function (item) {\n                if (item[col]) {\n                  return split.every(function (v) {\n                    return item[col].toLowerCase().includes(v);\n                  });\n                }\n              });\n\n              if (search_temp.length > 0) {\n                search_result = Object.assign(search_result, search_temp);\n              }\n            });\n            data = search_result;\n          } // SORTIERUNG\n\n\n          if (this.sort.column) {\n            if (typeof this.sort.column === 'string') {\n              if (this.sort.column == 'date') {\n                if (this.sort.order) {\n                  return data.sort(function (a, b) {\n                    var aa = a[_this.sort.column].split(' ');\n\n                    var bb = b[_this.sort.column].split(' ');\n\n                    var date1 = new Date(aa[0].split('.')[2], aa[0].split('.')[1] - 1, aa[0].split('.')[0], aa[1].split(':')[0], aa[1].split(':')[1]);\n                    var date2 = new Date(bb[0].split('.')[2], bb[0].split('.')[1] - 1, bb[0].split('.')[0], bb[1].split(':')[0], bb[1].split(':')[1]);\n                    return date1 - date2;\n                  });\n                } else {\n                  return data.sort(function (a, b) {\n                    var aa = a[_this.sort.column].split(' ');\n\n                    var bb = b[_this.sort.column].split(' ');\n\n                    var date1 = new Date(aa[0].split('.')[2], aa[0].split('.')[1] - 1, aa[0].split('.')[0], aa[1].split(':')[0], aa[1].split(':')[1]);\n                    var date2 = new Date(bb[0].split('.')[2], bb[0].split('.')[1] - 1, bb[0].split('.')[0], bb[1].split(':')[0], bb[1].split(':')[1]);\n                    return date2 - date1;\n                  });\n                }\n              } else {\n                if (this.sort.order) {\n                  return data.sort(function (a, b) {\n                    if (!isNaN(a[_this.sort.column])) {\n                      return a[_this.sort.column] - b[_this.sort.column];\n                    } else {\n                      return a[_this.sort.column].localeCompare(b[_this.sort.column]);\n                    }\n                  });\n                } else {\n                  return data.sort(function (a, b) {\n                    if (b[_this.sort.column] && a[_this.sort.column]) {\n                      if (!isNaN(a[_this.sort.column])) {\n                        return b[_this.sort.column] - a[_this.sort.column];\n                      } else {\n                        return b[_this.sort.column].localeCompare(a[_this.sort.column]);\n                      }\n                    }\n                  });\n                }\n              }\n            } else if (_typeof(this.sort.column) === 'object') {\n              if (this.sort.order) {\n                return data.sort(function (a, b) {\n                  return a[_this.sort.column[0]][_this.sort.column[1]].localeCompare(b[_this.sort.column[0]][_this.sort.column[1]]);\n                });\n              } else {\n                return data.sort(function (a, b) {\n                  return b[_this.sort.column[0]][_this.sort.column[1]].localeCompare(a[_this.sort.column[0]][_this.sort.column[0]]);\n                });\n              }\n            }\n          }\n\n          return data;\n        }\n      }\n\n      return [];\n    }\n  },\n  mounted: function mounted() {},\n\n  /*\n  watch: {\n     sort: {\n      handler: function (val, oldVal) {\n         console.log(val.order , oldVal.order);\n        if (val.order != oldVal.order) {\n          console.log('watch');\n        }\n      },\n      deep: true\n    }\n  },\n  */\n  methods: {\n    /*\n    forceRerender() {\n      // Removing my-component from the DOM\n      this.renderComponent = false;\n       this.$nextTick(() => {\n        // Adding the component back in\n        this.renderComponent = true;\n      });\n    },\n    */\n    handlerSort: function handlerSort(column) {\n      if (column) {\n        this.sort.column = column;\n        console.log('hand', this.sort.order);\n\n        if (this.sort.order == true) {\n          this.sort.order = false;\n        } else {\n          this.sort.order = true;\n        } //this.forceRerender();\n\n      }\n    },\n    handlerDate: function handlerDate(item, index) {\n      //console.log(index, item);\n      this.indexList = index;\n    },\n    loadList: function loadList() {\n      this.loading = true;\n      var that = this;\n      axios.get(this.apiURL + '/getList').then(function (response) {\n        if (response.data) {\n          if (response.data.error) {\n            that.error = '' + response.data.msg;\n          } else {\n            that.list = response.data;\n            that.indexList = 0;\n          }\n        } else {\n          that.error = 'Fehler beim Laden. 01';\n        }\n      })[\"catch\"](function () {\n        that.error = 'Fehler beim Laden. 02';\n      })[\"finally\"](function () {\n        // always executed\n        that.loading = false;\n      });\n    }\n  }\n});\n\n//# sourceURL=webpack://extensions/./src/App.vue?./node_modules/babel-loader/lib/index.js!./node_modules/vue-loader/lib/index.js??vue-loader-options");

/***/ })

},
/******/ function(__webpack_require__) { // webpackRuntimeModules
/******/ /* webpack/runtime/getFullHash */
/******/ (() => {
/******/ 	__webpack_require__.h = () => ("e83e197742e8759decac")
/******/ })();
/******/ 
/******/ }
);