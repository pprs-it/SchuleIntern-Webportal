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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/App.vue?vue&type=template&id=7ba5bd90&":
/*!*******************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./src/App.vue?vue&type=template&id=7ba5bd90& ***!
  \*******************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"render\": () => (/* binding */ render),\n/* harmony export */   \"staticRenderFns\": () => (/* binding */ staticRenderFns)\n/* harmony export */ });\nvar render = function () {\n  var _vm = this\n  var _h = _vm.$createElement\n  var _c = _vm._self._c || _h\n  return _c(\n    \"div\",\n    [\n      _c(\"AjaxSpinner\", { attrs: { loading: _vm.loading } }),\n      _vm._v(\" \"),\n      _c(\"AjaxError\", { attrs: { error: _vm.error } }),\n      _vm._v(\" \"),\n      _c(\"Modal\", { attrs: { data: _vm.selectedItem } }),\n      _vm._v(\" \"),\n      _c(\n        \"ul\",\n        { staticClass: \"page-submenue\" },\n        [\n          _c(\n            \"li\",\n            {\n              staticClass: \"item\",\n              on: {\n                click: function ($event) {\n                  return _vm.handlerOpenFolder(\"posteingang\")\n                },\n              },\n            },\n            [_vm._v(\"Posteingang\")]\n          ),\n          _vm._v(\" \"),\n          _c(\n            \"li\",\n            {\n              staticClass: \"item\",\n              on: {\n                click: function ($event) {\n                  return _vm.handlerOpenFolder(\"gesendet\")\n                },\n              },\n            },\n            [_vm._v(\"Gesendete\")]\n          ),\n          _vm._v(\" \"),\n          _c(\n            \"li\",\n            {\n              staticClass: \"item\",\n              on: {\n                click: function ($event) {\n                  return _vm.handlerOpenFolder(\"papierkorb\")\n                },\n              },\n            },\n            [_vm._v(\"Papierkorb\")]\n          ),\n          _vm._v(\" \"),\n          _c(\n            \"li\",\n            {\n              staticClass: \"item\",\n              on: {\n                click: function ($event) {\n                  return _vm.handlerOpenFolder(\"archiv\")\n                },\n              },\n            },\n            [_vm._v(\"Archiv\")]\n          ),\n          _vm._v(\" \"),\n          _vm._l(_vm.folders, function (item, index) {\n            return _c(\n              \"li\",\n              {\n                key: index,\n                staticClass: \"item\",\n                on: {\n                  click: function ($event) {\n                    return _vm.handlerOpenFolder(\"anderer\")\n                  },\n                },\n              },\n              [_c(\"span\", [_vm._v(_vm._s(item.folderName))])]\n            )\n          }),\n        ],\n        2\n      ),\n      _vm._v(\" \"),\n      _c(\"div\", { staticClass: \"box\" }, [\n        _c(\"div\", { staticClass: \"box-body\" }, [\n          _c(\"div\", { staticClass: \"si-table-fixedHeader\" }, [\n            _c(\"table\", { staticClass: \"si-table si-table-style-allLeft \" }, [\n              _vm._m(0),\n              _vm._v(\" \"),\n              _c(\n                \"tbody\",\n                _vm._l(_vm.messages, function (item, index) {\n                  return _c(\n                    \"tr\",\n                    {\n                      key: index,\n                      on: {\n                        click: function ($event) {\n                          return _vm.handlerOpenMessage(item)\n                        },\n                      },\n                    },\n                    [\n                      _c(\"td\", [\n                        item.isRead == 1\n                          ? _c(\"i\", { staticClass: \"fa fa-envelope-open\" })\n                          : _c(\"i\", { staticClass: \"fa fa-envelope\" }),\n                      ]),\n                      _vm._v(\" \"),\n                      _c(\"td\", [\n                        item.priority == \"HIGH\"\n                          ? _c(\"i\", { staticClass: \"fa fa-arrow-up text-red\" })\n                          : _vm._e(),\n                        _vm._v(\" \"),\n                        item.priority == \"LOW\"\n                          ? _c(\"i\", {\n                              staticClass: \"fa fa-arrow-down text-green\",\n                            })\n                          : _vm._e(),\n                      ]),\n                      _vm._v(\" \"),\n                      _c(\n                        \"td\",\n                        [\n                          item.from\n                            ? _c(\"User\", {\n                                attrs: { size: \"line\", data: item.from },\n                              })\n                            : _vm._e(),\n                        ],\n                        1\n                      ),\n                      _vm._v(\" \"),\n                      _c(\"td\", [_vm._v(_vm._s(item.subject))]),\n                      _vm._v(\" \"),\n                      _c(\"td\", [\n                        item.attachments\n                          ? _c(\"i\", {\n                              staticClass: \"fa fa-file\",\n                              attrs: { title: \"Anhänge\" },\n                            })\n                          : _vm._e(),\n                      ]),\n                      _vm._v(\" \"),\n                      _c(\"td\", [_vm._v(_vm._s(item.time))]),\n                    ]\n                  )\n                }),\n                0\n              ),\n            ]),\n          ]),\n          _vm._v(\" \"),\n          _vm.message\n            ? _c(\"div\", [\n                _c(\"ul\", [\n                  _c(\"li\", [\n                    _c(\"label\", [_vm._v(\"Von\")]),\n                    _vm._v(\n                      \"\\n            \" +\n                        _vm._s(_vm.message.text) +\n                        \"\\n          \"\n                    ),\n                  ]),\n                  _vm._v(\" \"),\n                  _c(\"li\", {}, [\n                    _c(\"label\", [_vm._v(\"Betreff\")]),\n                    _vm._v(\n                      \"\\n            \" +\n                        _vm._s(_vm.message.subject) +\n                        \" - \" +\n                        _vm._s(_vm.message.time) +\n                        \"\\n          \"\n                    ),\n                  ]),\n                  _vm._v(\" \"),\n                  _c(\"li\", [\n                    _c(\"label\", [_vm._v(\"Empfänger\")]),\n                    _vm._v(\n                      \"\\n            \" +\n                        _vm._s(_vm.message.recipients) +\n                        \"\\n          \"\n                    ),\n                  ]),\n                  _vm._v(\" \"),\n                  _c(\"li\", [\n                    _c(\"label\", [_vm._v(\"Kopieempfänger\")]),\n                    _vm._v(\n                      \"\\n            \" +\n                        _vm._s(_vm.message.text) +\n                        \"\\n          \"\n                    ),\n                  ]),\n                ]),\n                _vm._v(\" \"),\n                _c(\"div\", [\n                  _vm._v(\n                    \"\\n          \" + _vm._s(_vm.message.text) + \"\\n        \"\n                  ),\n                ]),\n                _vm._v(\" \"),\n                _c(\"div\", [\n                  _vm._v(\n                    \"\\n          \" + _vm._s(_vm.message.groupID) + \"\\n        \"\n                  ),\n                ]),\n              ])\n            : _vm._e(),\n        ]),\n      ]),\n    ],\n    1\n  )\n}\nvar staticRenderFns = [\n  function () {\n    var _vm = this\n    var _h = _vm.$createElement\n    var _c = _vm._self._c || _h\n    return _c(\"thead\", [\n      _c(\"tr\", [\n        _c(\"th\"),\n        _vm._v(\" \"),\n        _c(\"th\"),\n        _vm._v(\" \"),\n        _c(\"th\", [_vm._v(\"Absender\")]),\n        _vm._v(\" \"),\n        _c(\"th\", [_vm._v(\"Betreff\")]),\n        _vm._v(\" \"),\n        _c(\"th\", [_vm._v(\"Anhänge\")]),\n        _vm._v(\" \"),\n        _c(\"th\", [_vm._v(\"Empfangen\")]),\n      ]),\n    ])\n  },\n]\nrender._withStripped = true\n\n\n\n//# sourceURL=webpack://extensions/./src/App.vue?./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options");

/***/ })

},
/******/ function(__webpack_require__) { // webpackRuntimeModules
/******/ /* webpack/runtime/getFullHash */
/******/ (() => {
/******/ 	__webpack_require__.h = () => ("f23736bd8a9c2fac636d")
/******/ })();
/******/ 
/******/ }
);