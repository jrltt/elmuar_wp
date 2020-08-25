var gulp = require("gulp");
var gulpLoadPlugins = require("gulp-load-plugins");
var browserSync = require("browser-sync").create();
var $ = gulpLoadPlugins();
var del = require("del");
var themeFolder = "wp-content/themes/elmuar/";

// catch errors and display them in the console
var onError = (err) => console.log(`Error -> ${err}`);

function styles() {
  return gulp
    .src(themeFolder + "sass/*.scss")
    .pipe($.plumber({ errorHandler: onError }))
    .pipe($.sourcemaps.init())
    .pipe(
      $.sass
        .sync({
          outputStyle: "compressed",
          precision: 10,
          includePaths: ["."],
        })
        .on("error", $.sass.logError)
    )
    .pipe($.sourcemaps.write("."))
    .pipe(gulp.dest(themeFolder))
    .pipe(browserSync.stream());
}

exports.styles = styles;

function scripts() {
  return gulp
    .src(themeFolder + "js/**/*.js")
    .pipe($.plumber({ errorHandler: onError }))
    .pipe($.sourcemaps.init())
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest(".tmp/scripts"))
    .pipe(browserSync.stream());
}

exports.scripts = scripts;

function lint(options) {
  return gulp
    .src(themeFolder + "js/**/*.js")
    .pipe(browserSync.stream())
    .pipe($.eslint(options))
    .pipe($.eslint.format())
    .pipe($.if(!browserSync.active, $.eslint.failAfterError()));
}

const js = gulp.series(lint, scripts);
exports.js = js;

function minifyHtml() {
  return gulp
    .src(themeFolder + "*.html")
    .pipe($.useref({ searchPath: [".tmp", "app", "."] }))
    .pipe($.if("*.js", $.uglify()))
    .pipe($.if("*.css", $.cssnano()))
    .pipe($.if("*.html", $.htmlmin({ collapseWhitespace: true })))
    .pipe(gulp.dest("dist"));
}

const html = gulp.series(styles, js, minifyHtml);
exports.html = html;

function images() {
  return gulp
    .src(themeFolder + "images/**/*")
    .pipe(
      $.cache(
        $.imagemin({
          progressive: true,
          interlaced: true,
          // don't remove IDs from SVGs, they are often used
          // as hooks for embedding and styling
          svgoPlugins: [{ cleanupIDs: false }],
        })
      )
    )
    .pipe(gulp.dest("dist/images"));
}

exports.images = images;

// gulp.task('extras', () => {
//   return gulp.src([
//     'app/*.*',
//     '!app/*.html'
//   ], {
//     dot: true
//   }).pipe(gulp.dest('dist'));
// });

// Clean assets
function clean() {
  return del([".tmp", "dist"]);
}

function watchFiles() {
  gulp.watch(themeFolder + "sass/**/*.scss", styles);
  gulp.watch(themeFolder + "js/**/*.js", js);
  gulp.watch(
    [
      themeFolder + "*.html",
      themeFolder + "**/*.php",
      themeFolder + "images/**/*",
    ],
    browserSyncReload
  );
}

// BrowserSync Reload
function browserSyncReload(done) {
  browserSync.reload();
  done();
}

function serve(done) {
  browserSync.init({
    notify: false,
    proxy: "http://elmuar.test/",
  });
  done();
}

const watch = gulp.parallel(watchFiles, serve);
exports.watch = watch;

// gulp.task('serve:dist', () => {
//   browserSync({
//     notify: false,
//     port: 9000,
//     server: {
//       baseDir: ['dist']
//     }
//   });
// });

// gulp.task('build', ['lint', 'html', 'images', 'extras'], () => {
//   return gulp.src('dist/**/*').pipe($.size({title: 'build', gzip: true}));
// });

const build = gulp.series(clean, gulp.parallel(styles, images, js, html));
exports.build = build;

exports.default = gulp.parallel([styles, scripts, lint]);
