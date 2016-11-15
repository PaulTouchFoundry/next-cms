/* ==========================================================================
   Polyfills
   ========================================================================== */

/* HTML5 Shiv | 3.7.3-pre | https://github.com/aFarkas/html5shiv */
!function(e,t){function n(e,t){var n=e.createElement("p"),r=e.getElementsByTagName("head")[0]||e.documentElement;return n.innerHTML="x<style>"+t+"</style>",r.insertBefore(n.lastChild,r.firstChild)}function r(){var e=E.elements;return"string"==typeof e?e.split(" "):e}function a(e,t){var n=E.elements;"string"!=typeof n&&(n=n.join(" ")),"string"!=typeof e&&(e=e.join(" ")),E.elements=n+" "+e,m(t)}function o(e){var t=y[e[g]];return t||(t={},v++,e[g]=v,y[v]=t),t}function c(e,n,r){if(n||(n=t),s)return n.createElement(e);r||(r=o(n));var a;return a=r.cache[e]?r.cache[e].cloneNode():p.test(e)?(r.cache[e]=r.createElem(e)).cloneNode():r.createElem(e),!a.canHaveChildren||h.test(e)||a.tagUrn?a:r.frag.appendChild(a)}function i(e,n){if(e||(e=t),s)return e.createDocumentFragment();n=n||o(e);for(var a=n.frag.cloneNode(),c=0,i=r(),l=i.length;l>c;c++)a.createElement(i[c]);return a}function l(e,t){t.cache||(t.cache={},t.createElem=e.createElement,t.createFrag=e.createDocumentFragment,t.frag=t.createFrag()),e.createElement=function(n){return E.shivMethods?c(n,e,t):t.createElem(n)},e.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+r().join().replace(/[\w\-:]+/g,function(e){return t.createElem(e),t.frag.createElement(e),'c("'+e+'")'})+");return n}")(E,t.frag)}function m(e){e||(e=t);var r=o(e);return!E.shivCSS||u||r.hasCSS||(r.hasCSS=!!n(e,"article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")),s||l(e,r),e}var u,s,d="3.7.3-pre",f=e.html5||{},h=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,p=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,g="_html5shiv",v=0,y={};!function(){try{var e=t.createElement("a");e.innerHTML="<xyz></xyz>",u="hidden"in e,s=1==e.childNodes.length||function(){t.createElement("a");var e=t.createDocumentFragment();return"undefined"==typeof e.cloneNode||"undefined"==typeof e.createDocumentFragment||"undefined"==typeof e.createElement}()}catch(n){u=!0,s=!0}}();var E={elements:f.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output picture progress section summary template time video",version:d,shivCSS:f.shivCSS!==!1,supportsUnknownElements:s,shivMethods:f.shivMethods!==!1,type:"default",shivDocument:m,createElement:c,createDocumentFragment:i,addElements:a};e.html5=E,m(t),"object"==typeof module&&module.exports&&(module.exports=E)}("undefined"!=typeof window?window:this,document);

/* matchMedia | https://github.com/paulirish/matchMedia.js */
window.matchMedia||(window.matchMedia=function(){"use strict";var e=window.styleMedia||window.media;if(!e){var t=document.createElement("style"),i=document.getElementsByTagName("script")[0],n=null;t.type="text/css",t.id="matchmediajs-test",i.parentNode.insertBefore(t,i),n="getComputedStyle"in window&&window.getComputedStyle(t,null)||t.currentStyle,e={matchMedium:function(e){var i="@media "+e+"{ #matchmediajs-test { width: 1px; } }";return t.styleSheet?t.styleSheet.cssText=i:t.textContent=i,"1px"===n.width}}}return function(t){return{matches:e.matchMedium(t||"all"),media:t||"all"}}}());

/* Respond.js | 1.4.2 | https://github.com/scottjehl/Respond */
!function(e){"use strict";function t(){E(!0)}var a={};e.respond=a,a.update=function(){};var n=[],r=function(){var t=!1;try{t=new e.XMLHttpRequest}catch(a){t=new e.ActiveXObject("Microsoft.XMLHTTP")}return function(){return t}}(),s=function(e,t){var a=r();a&&(a.open("GET",e,!0),a.onreadystatechange=function(){4!==a.readyState||200!==a.status&&304!==a.status||t(a.responseText)},4!==a.readyState&&a.send(null))},i=function(e){return e.replace(a.regex.minmaxwh,"").match(a.regex.other)};if(a.ajax=s,a.queue=n,a.unsupportedmq=i,a.regex={media:/@media[^\{]+\{([^\{\}]*\{[^\}\{]*\})+/gi,keyframes:/@(?:\-(?:o|moz|webkit)\-)?keyframes[^\{]+\{(?:[^\{\}]*\{[^\}\{]*\})+[^\}]*\}/gi,comments:/\/\*[^*]*\*+([^/][^*]*\*+)*\//gi,urls:/(url\()['"]?([^\/\)'"][^:\)'"]+)['"]?(\))/g,findStyles:/@media *([^\{]+)\{([\S\s]+?)$/,only:/(only\s+)?([a-zA-Z]+)\s?/,minw:/\(\s*min\-width\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/,maxw:/\(\s*max\-width\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/,minmaxwh:/\(\s*m(in|ax)\-(height|width)\s*:\s*(\s*[0-9\.]+)(px|em)\s*\)/gi,other:/\([^\)]*\)/g},a.mediaQueriesSupported=e.matchMedia&&null!==e.matchMedia("only all")&&e.matchMedia("only all").matches,!a.mediaQueriesSupported){var o,l,m,h=e.document,d=h.documentElement,u=[],c=[],p=[],f={},g=30,x=h.getElementsByTagName("head")[0]||d,y=h.getElementsByTagName("base")[0],v=x.getElementsByTagName("link"),w=function(){var e,t=h.createElement("div"),a=h.body,n=d.style.fontSize,r=a&&a.style.fontSize,s=!1;return t.style.cssText="position:absolute;font-size:1em;width:1em",a||(a=s=h.createElement("body"),a.style.background="none"),d.style.fontSize="100%",a.style.fontSize="100%",a.appendChild(t),s&&d.insertBefore(a,d.firstChild),e=t.offsetWidth,s?d.removeChild(a):a.removeChild(t),d.style.fontSize=n,r&&(a.style.fontSize=r),e=m=parseFloat(e)},E=function(t){var a="clientWidth",n=d[a],r="CSS1Compat"===h.compatMode&&n||h.body[a]||n,s={},i=v[v.length-1],f=(new Date).getTime();if(t&&o&&g>f-o)return e.clearTimeout(l),void(l=e.setTimeout(E,g));o=f;for(var y in u)if(u.hasOwnProperty(y)){var S=u[y],T=S.minw,$=S.maxw,z=null===T,b=null===$,C="em";T&&(T=parseFloat(T)*(T.indexOf(C)>-1?m||w():1)),$&&($=parseFloat($)*($.indexOf(C)>-1?m||w():1)),S.hasquery&&(z&&b||!(z||r>=T)||!(b||$>=r))||(s[S.media]||(s[S.media]=[]),s[S.media].push(c[S.rules]))}for(var R in p)p.hasOwnProperty(R)&&p[R]&&p[R].parentNode===x&&x.removeChild(p[R]);p.length=0;for(var O in s)if(s.hasOwnProperty(O)){var M=h.createElement("style"),k=s[O].join("\n");M.type="text/css",M.media=O,x.insertBefore(M,i.nextSibling),M.styleSheet?M.styleSheet.cssText=k:M.appendChild(h.createTextNode(k)),p.push(M)}},S=function(e,t,n){var r=e.replace(a.regex.comments,"").replace(a.regex.keyframes,"").match(a.regex.media),s=r&&r.length||0;t=t.substring(0,t.lastIndexOf("/"));var o=function(e){return e.replace(a.regex.urls,"$1"+t+"$2$3")},l=!s&&n;t.length&&(t+="/"),l&&(s=1);for(var m=0;s>m;m++){var h,d,p,f;l?(h=n,c.push(o(e))):(h=r[m].match(a.regex.findStyles)&&RegExp.$1,c.push(RegExp.$2&&o(RegExp.$2))),p=h.split(","),f=p.length;for(var g=0;f>g;g++)d=p[g],i(d)||u.push({media:d.split("(")[0].match(a.regex.only)&&RegExp.$2||"all",rules:c.length-1,hasquery:d.indexOf("(")>-1,minw:d.match(a.regex.minw)&&parseFloat(RegExp.$1)+(RegExp.$2||""),maxw:d.match(a.regex.maxw)&&parseFloat(RegExp.$1)+(RegExp.$2||"")})}E()},T=function(){if(n.length){var t=n.shift();s(t.href,function(a){S(a,t.href,t.media),f[t.href]=!0,e.setTimeout(function(){T()},0)})}},$=function(){for(var t=0;t<v.length;t++){var a=v[t],r=a.href,s=a.media,i=a.rel&&"stylesheet"===a.rel.toLowerCase();r&&i&&!f[r]&&(a.styleSheet&&a.styleSheet.rawCssText?(S(a.styleSheet.rawCssText,r,s),f[r]=!0):(!/^([a-zA-Z:]*\/\/)/.test(r)&&!y||r.replace(RegExp.$1,"").split("/")[0]===e.location.host)&&("//"===r.substring(0,2)&&(r=e.location.protocol+r),n.push({href:r,media:s})))}T()};$(),a.update=$,a.getEmValue=w,e.addEventListener?e.addEventListener("resize",t,!1):e.attachEvent&&e.attachEvent("onresize",t)}}(this);