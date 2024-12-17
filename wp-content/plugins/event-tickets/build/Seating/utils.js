/******/ (function(modules) { // webpackBootstrap
/******/ 	// install a JSONP callback for chunk loading
/******/ 	function webpackJsonpCallback(data) {
/******/ 		var chunkIds = data[0];
/******/ 		var moreModules = data[1];
/******/ 		var executeModules = data[2];
/******/
/******/ 		// add "moreModules" to the modules object,
/******/ 		// then flag all "chunkIds" as loaded and fire callback
/******/ 		var moduleId, chunkId, i = 0, resolves = [];
/******/ 		for(;i < chunkIds.length; i++) {
/******/ 			chunkId = chunkIds[i];
/******/ 			if(Object.prototype.hasOwnProperty.call(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 				resolves.push(installedChunks[chunkId][0]);
/******/ 			}
/******/ 			installedChunks[chunkId] = 0;
/******/ 		}
/******/ 		for(moduleId in moreModules) {
/******/ 			if(Object.prototype.hasOwnProperty.call(moreModules, moduleId)) {
/******/ 				modules[moduleId] = moreModules[moduleId];
/******/ 			}
/******/ 		}
/******/ 		if(parentJsonpFunction) parentJsonpFunction(data);
/******/
/******/ 		while(resolves.length) {
/******/ 			resolves.shift()();
/******/ 		}
/******/
/******/ 		// add entry modules from loaded chunk to deferred list
/******/ 		deferredModules.push.apply(deferredModules, executeModules || []);
/******/
/******/ 		// run deferred modules when all chunks ready
/******/ 		return checkDeferredModules();
/******/ 	};
/******/ 	function checkDeferredModules() {
/******/ 		var result;
/******/ 		for(var i = 0; i < deferredModules.length; i++) {
/******/ 			var deferredModule = deferredModules[i];
/******/ 			var fulfilled = true;
/******/ 			for(var j = 1; j < deferredModule.length; j++) {
/******/ 				var depId = deferredModule[j];
/******/ 				if(installedChunks[depId] !== 0) fulfilled = false;
/******/ 			}
/******/ 			if(fulfilled) {
/******/ 				deferredModules.splice(i--, 1);
/******/ 				result = __webpack_require__(__webpack_require__.s = deferredModule[0]);
/******/ 			}
/******/ 		}
/******/
/******/ 		return result;
/******/ 	}
/******/
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// object to store loaded and loading chunks
/******/ 	// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 	// Promise = chunk loading, 0 = chunk loaded
/******/ 	var installedChunks = {
/******/ 		16: 0
/******/ 	};
/******/
/******/ 	var deferredModules = [];
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	var jsonpArray = window["webpackJsonp"] = window["webpackJsonp"] || [];
/******/ 	var oldJsonpFunction = jsonpArray.push.bind(jsonpArray);
/******/ 	jsonpArray.push = webpackJsonpCallback;
/******/ 	jsonpArray = jsonpArray.slice();
/******/ 	for(var i = 0; i < jsonpArray.length; i++) webpackJsonpCallback(jsonpArray[i]);
/******/ 	var parentJsonpFunction = oldJsonpFunction;
/******/
/******/
/******/ 	// add entry module to deferred list
/******/ 	deferredModules.push(["BOpU",0]);
/******/ 	// run deferred modules when ready
/******/ 	return checkDeferredModules();
/******/ })
/************************************************************************/
/******/ ({

/***/ "BOpU":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getLink", function() { return getLink; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getLocalizedString", function() { return getLocalizedString; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "createHtmlComponentFromTemplateString", function() { return createHtmlComponentFromTemplateString; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "createHtmlComponentFromTemplateElement", function() { return createHtmlComponentFromTemplateElement; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "onReady", function() { return onReady; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "redirectTo", function() { return redirectTo; });
/* harmony import */ var _babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__("lSNA");
/* harmony import */ var _babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0__);

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _babel_runtime_helpers_defineProperty__WEBPACK_IMPORTED_MODULE_0___default()(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
/**
 * Returns a link pulled from the scoped window object.
 *
 * @param {string} link The slug of the link to return.
 *
 * @return {string} The link URL, or an empty string if it does not exist.
 */
function getLink(link) {
  var _window, _window$tec, _window$tec$tickets, _window$tec$tickets$s, _window$tec$tickets$s2, _window$tec$tickets$s3;
  return ((_window = window) === null || _window === void 0 ? void 0 : (_window$tec = _window.tec) === null || _window$tec === void 0 ? void 0 : (_window$tec$tickets = _window$tec.tickets) === null || _window$tec$tickets === void 0 ? void 0 : (_window$tec$tickets$s = _window$tec$tickets.seating) === null || _window$tec$tickets$s === void 0 ? void 0 : (_window$tec$tickets$s2 = _window$tec$tickets$s.utils) === null || _window$tec$tickets$s2 === void 0 ? void 0 : (_window$tec$tickets$s3 = _window$tec$tickets$s2.links) === null || _window$tec$tickets$s3 === void 0 ? void 0 : _window$tec$tickets$s3[link]) || '';
}

/**
 * Returns a localized string pulled from the scoped window object.
 *
 * @param {string}      slug  The slug of the string to return.
 * @param {string|null} group Optional, the group of the string to return.
 *
 * @return {string} The localized string, or an empty string if it does not exist.
 */
function getLocalizedString(slug, group) {
  var _window3, _window3$tec, _window3$tec$tickets, _window3$tec$tickets$, _window3$tec$tickets$2, _window3$tec$tickets$3;
  if (group) {
    var _window2, _window2$tec, _window2$tec$tickets, _window2$tec$tickets$, _window2$tec$tickets$2, _window2$tec$tickets$3, _window2$tec$tickets$4;
    return ((_window2 = window) === null || _window2 === void 0 ? void 0 : (_window2$tec = _window2.tec) === null || _window2$tec === void 0 ? void 0 : (_window2$tec$tickets = _window2$tec.tickets) === null || _window2$tec$tickets === void 0 ? void 0 : (_window2$tec$tickets$ = _window2$tec$tickets.seating) === null || _window2$tec$tickets$ === void 0 ? void 0 : (_window2$tec$tickets$2 = _window2$tec$tickets$.utils) === null || _window2$tec$tickets$2 === void 0 ? void 0 : (_window2$tec$tickets$3 = _window2$tec$tickets$2.localizedStrings) === null || _window2$tec$tickets$3 === void 0 ? void 0 : (_window2$tec$tickets$4 = _window2$tec$tickets$3[group]) === null || _window2$tec$tickets$4 === void 0 ? void 0 : _window2$tec$tickets$4[slug]) || '';
  }
  return ((_window3 = window) === null || _window3 === void 0 ? void 0 : (_window3$tec = _window3.tec) === null || _window3$tec === void 0 ? void 0 : (_window3$tec$tickets = _window3$tec.tickets) === null || _window3$tec$tickets === void 0 ? void 0 : (_window3$tec$tickets$ = _window3$tec$tickets.seating) === null || _window3$tec$tickets$ === void 0 ? void 0 : (_window3$tec$tickets$2 = _window3$tec$tickets$.utils) === null || _window3$tec$tickets$2 === void 0 ? void 0 : (_window3$tec$tickets$3 = _window3$tec$tickets$2.localizedStrings) === null || _window3$tec$tickets$3 === void 0 ? void 0 : _window3$tec$tickets$3[slug]) || '';
}

/**
 * Creates an HTMl Element from an HTML template and replaces the placeholders with the props.
 *
 * Resist the temptation to add complex logic to the template.
 * If you need something more elaborate, use React.
 *
 * @since 5.16.0
 *
 * @param {string} htmlTemplate The HTML template to use. Properties placeholder have the form `{propertyName}`.
 * @param {Object} props        The props to replace in the template.
 *
 * @return {HTMLElement} The HTML Element.
 */
function createHtmlComponentFromTemplateString(htmlTemplate, props) {
  const html = htmlTemplate.replace(/{(\w*)}/g, function (match, key) {
    return (props === null || props === void 0 ? void 0 : props[key]) || '';
  });
  const template = document.createElement('template');
  template.innerHTML = html.trim();
  return template.content.children[0];
}

/**
 * Creates an HTMl Element from a template and replaces the placeholders with the props.
 *
 * The function will replace each occurrence of `{key}` with the value of the `key` property in the props object.
 * If the key is not found, it will be replaced with an empty string.
 *
 * @since 5.16.0
 *
 * @param {string} templateId The ID of the template to use.
 * @param {Object} props      The props to replace in the template.
 * @return {HTMLElement|null} The HTML Element, or `null` if the template is not found.
 */
function createHtmlComponentFromTemplateElement(templateId, props) {
  const template = document.getElementById(templateId);
  if (!template) {
    return null;
  }
  return createHtmlComponentFromTemplateString(template.innerHTML, props);
}

/**
 * Calls a callback when the DOM is ready.
 *
 * @since 5.16.0
 *
 * @param {function} domReadyCallback The callback to call when the DOM is ready.
 *
 * @return {void}
 */
const onReady = domReadyCallback => {
  if (document.readyState !== 'loading') {
    domReadyCallback();
  } else {
    document.addEventListener('DOMContentLoaded', domReadyCallback);
  }
};

/**
 * Redirects to a URL.
 *
 * @since 5.16.0
 *
 * @param {string} url The URL to relocate to.
 * @param {boolean} [newTab=false] Whether to open the URL in a new tab.
 *
 * @return {void}
 */
function redirectTo(url) {
  let newTab = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
  if (newTab) {
    window.open(url, '_blank', 'noopener,noreferrer');
  } else {
    window.location.href = url;
  }
}
window.tec = window.tec || {};
window.tec.tickets.seating = window.tec.tickets.seating || {};
window.tec.tickets.seating.utils = _objectSpread(_objectSpread({}, window.tec.tickets.seating.utils || {}), {}, {
  getLink,
  getLocalizedString,
  createHtmlComponentFromTemplateString,
  createHtmlComponentFromTemplateElement,
  onReady,
  redirectTo
});

/***/ })

/******/ });