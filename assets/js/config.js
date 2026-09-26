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
  // Free-stack backend (Render). Update if your Render service URL differs:
  // Render dashboard → service → URL at top.
  var PROD_BACKEND = 'https://tourandtraveltouch-backend.onrender.com';
  var host = (typeof window !== 'undefined' && window.location) ? window.location.hostname : '';
  // Same-origin (relative URLs) when served from Render itself or localhost —
  // cookies/sessions work reliably. Absolute URL only for GitHub Pages preview.
  var backend = '';
  var isRenderHost = host !== '' && host.slice(-13) === '.onrender.com';
  if (host === 'localhost' || host === '127.0.0.1' || isRenderHost) {
    backend = '';
  } else {
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
