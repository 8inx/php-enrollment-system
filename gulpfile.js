const { watch, series, src, dest } = require("gulp");
const browserSync = require("browser-sync").create();
const sass = require("gulp-sass")(require("sass"));
const postcss = require("gulp-postcss");
const imagemin = require("gulp-imagemin");
const merge = require("merge-stream");
const concat = require("gulp-concat");
const del = require("del");
const googleWebFonts = require("gulp-google-webfonts");

// css task
function cssTask() {
  return src(["./src/scss/**/*.scss"])
    .pipe(sass())
    .pipe(postcss([require("tailwindcss")]))
    .pipe(dest("dist/css"));
}

// js task
function jsTask() {
  return src(["./src/js/**/*.js"]).pipe(dest("dist/js"));
}

// image task
function imageTask() {
  return src(["src/img/*"]).pipe(imagemin()).pipe(dest("dist/img"));
}

// vendor Tasks
function modules() {
  // google-fonts
  const webfonts = src("./font.list")
    .pipe(googleWebFonts())
    .pipe(dest("vendor/googleFonts"));

  // fontawesome
  const fontawesome = src(["./node_modules/@fortawesome/**/*.scss"])
    .pipe(sass())
    .pipe(postcss([]))
    .pipe(concat("all.css"))
    .pipe(dest("vendor/fontawesome/css"));

  const fontawesomeIcon = src([
    "node_modules/@fortawesome/fontawesome-free/webfonts/*",
  ]).pipe(dest("vendor/fontawesome/webfonts"));

  // jquery
  const jquery = src(["./node_modules/jquery/dist/**/*.js"]).pipe(
    dest("vendor/jquery")
  );

  // jqueryValidation
  const jqueryValidation = src([
    "./node_modules/jquery-validation/dist/**/*.js",
  ]).pipe(dest("vendor/jquery-validation"));

  // jqueryModal
  const jqueryModal = src([
    "./node_modules/jquery-modal/*.min.js",
    "./node_modules/jquery-modal/*.min.css",
  ]).pipe(dest("vendor/jquery-modal"));

  // datatable
  const dataTables = src([
    "./node_modules/datatables.net/js/*.js",
    "./node_modules/datatables.net-dt/js/*.js",
  ]).pipe(dest("./vendor/datatables"));

  // tabledit
  const tableEdit = src(["./node_modules/jquery-tabledit/*.js"]).pipe(
    dest("./vendor/tabledit")
  );

  const chartJs = src("./node_modules/chart.js/dist/*.js").pipe(
    dest("./vendor/chart.js")
  );

  //nprogress
  const nprogress = src([
    "./node_modules/nprogress/*.css",
    "./node_modules/nprogress/*.js",
  ]).pipe(dest("vendor/nprogress"));

  return merge(
    webfonts,
    fontawesome,
    fontawesomeIcon,
    jquery,
    jqueryValidation,
    jqueryModal,
    dataTables,
    tableEdit,
    chartJs,
    nprogress
  );
}

// browserSync
function browserSyncServe(cb) {
  browserSync.init({
    proxy: "127.0.0.1/enrollv2",
    port: 8080,
    open: false,
    notify: false,
  });
  cb();
}

function browserSyncReload(cb) {
  browserSync.reload();
  cb();
}

// watch
function watchTask() {
  watch(["public/**/*.php"], series(cssTask, browserSyncReload));
  watch(["src/**/*.scss"], series(cssTask, browserSyncReload));
  watch(["src/**/*.js"], series(jsTask, browserSyncReload));
}

// Clean vendor
function clean() {
  return del(["./vendor/", "./dist/"]);
}

function cleanDist() {
  return del(["./dist/"]);
}

function cleanVendor() {
  return del(["./vendor/"]);
}

const build = series(cssTask, jsTask, imageTask, modules);
const dev = series(build, browserSyncServe, watchTask);

const vendor = series(cleanVendor, modules);
const dist = series(cleanDist, cssTask, jsTask, imageTask);

exports.default = build;
exports.watch = dev;
exports.build = build;
exports.dist = dist;
exports.vendor = vendor;
exports.clean = clean;
exports.cleanDist = cleanDist;
exports.cleanVendor = cleanVendor;
