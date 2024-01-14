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

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"default\": () => (__WEBPACK_DEFAULT_EXPORT__)\n/* harmony export */ });\n/* harmony import */ var _mixins_Error_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./mixins/Error.vue */ \"./src/mixins/Error.vue\");\n/* harmony import */ var _mixins_Spinner_vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./mixins/Spinner.vue */ \"./src/mixins/Spinner.vue\");\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\n//\nvar axios = (__webpack_require__(/*! axios */ \"./node_modules/axios/index.js\")[\"default\"]);\n\n\n\n/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({\n  components: {\n    Error: _mixins_Error_vue__WEBPACK_IMPORTED_MODULE_0__[\"default\"],\n    Spinner: _mixins_Spinner_vue__WEBPACK_IMPORTED_MODULE_1__[\"default\"]\n  },\n  data: function data() {\n    return {\n      apiURL: globals.apiURL,\n      error: '',\n      loading: false,\n      list: false,\n      // from AJAX\n      indexList: false,\n      sort: {\n        column: 'stunde',\n        order: true\n      },\n      searchColumns: ['klasse', 'stunde', 'user_neu', 'user_alt', 'fach_alt', 'fach_neu', 'raum', 'info'],\n      searchString: '',\n      renderComponent: true\n    };\n  },\n  created: function created() {\n    this.loadList();\n  },\n  computed: {\n    vlist: function vlist() {\n      var _this = this;\n\n      if (this.indexList >= 0 && this.list[this.indexList] && this.list[this.indexList].data) {\n        var data = this.list[this.indexList].data;\n\n        if (data.length > 0) {\n          // SUCHE\n          if (this.searchString != '') {\n            var split = this.searchString.toLowerCase().split(' ');\n            var search_temp = [];\n            var search_result = [];\n            this.searchColumns.forEach(function (col) {\n              search_temp = data.filter(function (item) {\n                return split.every(function (v) {\n                  return item[col].toLowerCase().includes(v);\n                });\n              });\n\n              if (search_temp.length > 0) {\n                search_result = Object.assign(search_result, search_temp);\n              }\n            });\n            data = search_result;\n          } // SORTIERUNG\n\n\n          if (this.sort.column) {\n            if (this.sort.order) {\n              return data.sort(function (a, b) {\n                return a[_this.sort.column].localeCompare(b[_this.sort.column]);\n              });\n            } else {\n              return data.sort(function (a, b) {\n                return b[_this.sort.column].localeCompare(a[_this.sort.column]);\n              });\n            }\n          }\n\n          return data;\n        }\n      }\n\n      return [];\n    }\n  },\n  mounted: function mounted() {},\n\n  /*\n  watch: {\n     sort: {\n      handler: function (val, oldVal) {\n         console.log(val.order , oldVal.order);\n        if (val.order != oldVal.order) {\n          console.log('watch');\n        }\n      },\n      deep: true\n    }\n  },\n  */\n  methods: {\n    /*\n    forceRerender() {\n      // Removing my-component from the DOM\n      this.renderComponent = false;\n       this.$nextTick(() => {\n        // Adding the component back in\n        this.renderComponent = true;\n      });\n    },\n    */\n    handlerSort: function handlerSort(column) {\n      if (column) {\n        this.sort.column = column;\n        console.log('hand', this.sort.order);\n\n        if (this.sort.order == true) {\n          this.sort.order = false;\n        } else {\n          this.sort.order = true;\n        } //this.forceRerender();\n\n      }\n    },\n    handlerDate: function handlerDate(item, index) {\n      //console.log(index, item);\n      this.indexList = index;\n    },\n    loadList: function loadList() {\n      this.loading = true;\n      var that = this;\n      axios.get(this.apiURL + '/getList').then(function (response) {\n        if (response.data) {\n          if (response.data.error) {\n            that.error = '' + response.data.msg;\n          } else {\n            that.list = response.data;\n            that.indexList = 0;\n          }\n        } else {\n          that.error = 'Fehler beim Laden. 01';\n        }\n      })[\"catch\"](function () {\n        that.error = 'Fehler beim Laden. 02';\n      })[\"finally\"](function () {\n        // always executed\n        that.loading = false;\n      });\n    }\n  }\n});\n\n//# sourceURL=webpack://extensions/./src/App.vue?./node_modules/babel-loader/lib/index.js!./node_modules/vue-loader/lib/index.js??vue-loader-options");

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/App.vue?vue&type=template&id=7ba5bd90&":
/*!*******************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/App.vue?vue&type=template&id=7ba5bd90& ***!
  \*******************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"render\": () => (/* binding */ render),\n/* harmony export */   \"staticRenderFns\": () => (/* binding */ staticRenderFns)\n/* harmony export */ });\nvar render = function () {\n  var _vm = this\n  var _h = _vm.$createElement\n  var _c = _vm._self._c || _h\n  return _c(\n    \"div\",\n    [\n      _c(\"Error\", { attrs: { error: _vm.error } }),\n      _vm._v(\" \"),\n      _c(\"Spinner\", { attrs: { loading: _vm.loading } }),\n      _vm._v(\" \"),\n      _c(\"div\", { staticClass: \"flex-row head\" }, [\n        _c(\"input\", {\n          directives: [\n            {\n              name: \"model\",\n              rawName: \"v-model\",\n              value: _vm.searchString,\n              expression: \"searchString\",\n            },\n          ],\n          staticClass: \"si-input blockInline margin-r-m\",\n          attrs: { type: \"search\", placeholder: \"Suche...\" },\n          domProps: { value: _vm.searchString },\n          on: {\n            input: function ($event) {\n              if ($event.target.composing) {\n                return\n              }\n              _vm.searchString = $event.target.value\n            },\n          },\n        }),\n        _vm._v(\" \"),\n        _vm.list && _vm.list.length >= 1\n          ? _c(\n              \"div\",\n              {\n                staticClass:\n                  \"si-btn-multiple flex-row-nowrap mobile-margin-t-m\",\n              },\n              _vm._l(_vm.list, function (item, index) {\n                return _c(\n                  \"button\",\n                  {\n                    key: index,\n                    staticClass: \"si-btn margin-r-s\",\n                    class: { \"si-btn-active\": index == _vm.indexList },\n                    on: {\n                      click: function ($event) {\n                        return _vm.handlerDate(item, index)\n                      },\n                    },\n                  },\n                  [\n                    index == 0 ? _c(\"span\", [_vm._v(\"Heute - \")]) : _vm._e(),\n                    _vm._v(\" \"),\n                    index == 1 ? _c(\"span\", [_vm._v(\"Morgen - \")]) : _vm._e(),\n                    _vm._v(\"\\n        \" + _vm._s(item.date) + \"\\n      \"),\n                  ]\n                )\n              }),\n              0\n            )\n          : _vm._e(),\n      ]),\n      _vm._v(\" \"),\n      _vm.list && _vm.list[_vm.indexList].day.text\n        ? _c(\"div\", {\n            staticClass: \"margin-t-m\",\n            domProps: { innerHTML: _vm._s(_vm.list[_vm.indexList].day.text) },\n          })\n        : _vm._e(),\n      _vm._v(\" \"),\n      _vm.vlist && _vm.vlist.length >= 1\n        ? _c(\"table\", { staticClass: \"si-table\" }, [\n            _c(\"thead\", [\n              _c(\"tr\", [\n                _c(\n                  \"th\",\n                  {\n                    staticClass: \"curser-sort\",\n                    on: {\n                      click: function ($event) {\n                        return _vm.handlerSort(\"klasse\")\n                      },\n                    },\n                  },\n                  [_vm._v(\"Klasse(n)\")]\n                ),\n                _vm._v(\" \"),\n                _c(\n                  \"th\",\n                  {\n                    staticClass: \"curser-sort\",\n                    on: {\n                      click: function ($event) {\n                        return _vm.handlerSort(\"stunde\")\n                      },\n                    },\n                  },\n                  [_vm._v(\"Stunde\")]\n                ),\n                _vm._v(\" \"),\n                _c(\n                  \"th\",\n                  {\n                    staticClass: \"curser-sort\",\n                    on: {\n                      click: function ($event) {\n                        return _vm.handlerSort(\"user_neu\")\n                      },\n                    },\n                  },\n                  [_vm._v(\"Vertreter\")]\n                ),\n                _vm._v(\" \"),\n                _c(\n                  \"th\",\n                  {\n                    staticClass: \"curser-sort\",\n                    on: {\n                      click: function ($event) {\n                        return _vm.handlerSort(\"fach_neu\")\n                      },\n                    },\n                  },\n                  [_vm._v(\"Fach\")]\n                ),\n                _vm._v(\" \"),\n                _c(\n                  \"th\",\n                  {\n                    staticClass: \"curser-sort\",\n                    on: {\n                      click: function ($event) {\n                        return _vm.handlerSort(\"raum_neu\")\n                      },\n                    },\n                  },\n                  [_vm._v(\"Raum\")]\n                ),\n                _vm._v(\" \"),\n                _c(\n                  \"th\",\n                  {\n                    staticClass: \"curser-sort\",\n                    on: {\n                      click: function ($event) {\n                        return _vm.handlerSort(\"fach_alt\")\n                      },\n                    },\n                  },\n                  [_vm._v(\"(Fach)\")]\n                ),\n                _vm._v(\" \"),\n                _c(\n                  \"th\",\n                  {\n                    staticClass: \"curser-sort\",\n                    on: {\n                      click: function ($event) {\n                        return _vm.handlerSort(\"user_alt\")\n                      },\n                    },\n                  },\n                  [_vm._v(\"(Lehrer)\")]\n                ),\n                _vm._v(\" \"),\n                _c(\n                  \"th\",\n                  {\n                    staticClass: \"curser-sort\",\n                    on: {\n                      click: function ($event) {\n                        return _vm.handlerSort(\"raum_alt\")\n                      },\n                    },\n                  },\n                  [_vm._v(\"(Raum)\")]\n                ),\n                _vm._v(\" \"),\n                _c(\n                  \"th\",\n                  {\n                    staticClass: \"curser-sort\",\n                    on: {\n                      click: function ($event) {\n                        return _vm.handlerSort(\"info_1\")\n                      },\n                    },\n                  },\n                  [_vm._v(\"Info\")]\n                ),\n                _vm._v(\" \"),\n                _c(\n                  \"th\",\n                  {\n                    staticClass: \"curser-sort\",\n                    on: {\n                      click: function ($event) {\n                        return _vm.handlerSort(\"info_2\")\n                      },\n                    },\n                  },\n                  [_vm._v(\"Info\")]\n                ),\n                _vm._v(\" \"),\n                _c(\n                  \"th\",\n                  {\n                    staticClass: \"curser-sort\",\n                    on: {\n                      click: function ($event) {\n                        return _vm.handlerSort(\"info_3\")\n                      },\n                    },\n                  },\n                  [_vm._v(\"Info\")]\n                ),\n              ]),\n            ]),\n            _vm._v(\" \"),\n            _c(\n              \"tbody\",\n              [\n                _vm._l(_vm.vlist, function (item, index) {\n                  return _c(\"tr\", { key: index }, [\n                    _c(\"td\", [_vm._v(_vm._s(item.klasse))]),\n                    _vm._v(\" \"),\n                    _c(\"td\", [_vm._v(_vm._s(item.stunde))]),\n                    _vm._v(\" \"),\n                    _c(\"td\", [_vm._v(_vm._s(item.user_neu))]),\n                    _vm._v(\" \"),\n                    _c(\"td\", [_vm._v(_vm._s(item.fach_neu))]),\n                    _vm._v(\" \"),\n                    _c(\"td\", [_vm._v(_vm._s(item.raum_neu))]),\n                    _vm._v(\" \"),\n                    _c(\"td\", [\n                      _c(\"span\", { staticClass: \"text-grey text-line\" }, [\n                        _vm._v(_vm._s(item.fach_alt)),\n                      ]),\n                    ]),\n                    _vm._v(\" \"),\n                    _c(\"td\", [\n                      _c(\"span\", { staticClass: \"text-grey text-line\" }, [\n                        _vm._v(_vm._s(item.user_alt)),\n                      ]),\n                    ]),\n                    _vm._v(\" \"),\n                    _c(\"td\", [_vm._v(_vm._s(item.raum_alt))]),\n                    _vm._v(\" \"),\n                    _c(\"td\", [_vm._v(_vm._s(item.info_1))]),\n                    _vm._v(\" \"),\n                    _c(\"td\", [_vm._v(_vm._s(item.info_2))]),\n                    _vm._v(\" \"),\n                    _c(\"td\", [_vm._v(_vm._s(item.info_3))]),\n                  ])\n                }),\n                _vm._v(\" \"),\n                _vm.vlist.length == 0\n                  ? _c(\"tr\", [\n                      _c(\"td\", { attrs: { colspan: \"8\" } }, [\n                        _vm._v(\" - keine Inhalte vorhanden -\"),\n                      ]),\n                    ])\n                  : _vm._e(),\n              ],\n              2\n            ),\n          ])\n        : _vm._e(),\n    ],\n    1\n  )\n}\nvar staticRenderFns = []\nrender._withStripped = true\n\n\n\n//# sourceURL=webpack://extensions/./src/App.vue?./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options");

/***/ })

},
/******/ function(__webpack_require__) { // webpackRuntimeModules
/******/ /* webpack/runtime/getFullHash */
/******/ (() => {
/******/ 	__webpack_require__.h = () => ("ce4d583ecd47936c2612")
/******/ })();
/******/ 
/******/ }
);