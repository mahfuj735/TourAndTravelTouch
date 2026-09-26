/*
 | Tour And Travel Touch — Backend Configuration
 | ==============================================
 | Production backend (InfinityFree): https://tourandtraveltouch.great-site.net
 |
 | Behaviour:
 |  - When the site is served from the backend host itself (InfinityFree)
 |    or localhost, BACKEND_URL is '' so all calls stay same-origin
 |    (cookies + session work reliably, no CORS issues).
 |  - When served from GitHub Pages, it falls back to the absolute
 |    InfinityFree URL for API calls.
 |
 |  No trailing slash!
 */
(function () {
  var PROD_BACKEND = 'https://tourandtraveltouch.great-site.net';
  var host = (typeof window !== 'undefined' && window.location) ? window.location.hostname : '';
  var sameOriginHosts = ['tourandtraveltouch.great-site.net', 'localhost', '127.0.0.1'];

  var backend = '';
  if (sameOriginHosts.indexOf(host) === -1) {
    backend = PROD_BACKEND;
  }

  if (typeof window !== 'undefined') {
    window.BACKEND_URL = backend;
  }
  if (typeof globalThis !== 'undefined') {
    try { globalThis.BACKEND_URL = backend; } catch (e) {}
  }
  // Legacy global for existing inline scripts: `const API = typeof BACKEND_URL !== 'undefined' ? BACKEND_URL : ''`
  if (typeof BACKEND_URL === 'undefined') {
    // eslint-disable-next-line no-global-assign, no-undef
    BACKEND_URL = backend;
  }
})();
