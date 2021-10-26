/* eslint-env browser */
/* globals AFPA_DIST_PATH */

/** Dynamically set absolute public path from current protocol and host */
if (AFPA_DIST_PATH) {
  __webpack_public_path__ = AFPA_DIST_PATH; // eslint-disable-line no-undef, camelcase
}
