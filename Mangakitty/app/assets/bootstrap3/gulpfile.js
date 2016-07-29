var gulp        = require('gulp'),
    less        = require('gulp-less'),
    rename      = require('gulp-rename'),
    livereload  = require('gulp-livereload'), // Livereload plugin needed: https://chrome.google.com/webstore/detail/livereload/jnihajbhpnppcggbcgedagnkighmdlei
    embedlr     = require("gulp-embedlr"),
    tinylr      = require('tiny-lr'),
    through     = require('through2'),
    server      = tinylr();

// LiveReload port. Change it only if there's a conflict
var lvr_port = 35729;

var taskListDef = [];
var taskListDev = [];

// SOURCES CONFIG 
var source = {
  bootstrap: {
    main:  'less/bootstrap.less',
    dir:   ['less/'],
    watch: ['less/**/*.less']
  },
  plan: {
    main:  'less/plan.less',
    dir:   ['less/'],
    watch: ['less/**/*.less']
  }
};

// BUILD TARGET CONFIG 
var build = {
  bootstrap: 'assets/css/'
};

// THEMES CONFIG (only dev mode)
var Themes = {
  'amethyst':  '#9B59B6',
  'carrot': '#E67E22',
  'greensea': '#16A085',
  'belizehole':  '#2980B9',
};



//---------------
// TASKS
//---------------


// DEFAULT TASK

createDefaultTaskForBootstrap('bootstrap');
createDefaultTaskForBootstrap('bootstrap:min', true);
createDefaultTaskForPlan('plan');
createDefaultTaskForPlan('plan:min', true);

function createDefaultTaskForBootstrap(taskName, minified) {
  // by default, do not compress source
  minified = minified || false;
  var fileName = 'bootstrap' + (minified?'.min':'') + '.css';
  
  createDefaultTask(taskName, fileName, source.bootstrap, minified);
}

function createDefaultTaskForPlan(taskName, minified) {
  // by default, do not compress source
  minified = minified || false;
  var fileName = 'plan' + (minified?'.min':'') + '.css';
  
  createDefaultTask(taskName, fileName, source.plan, minified);
}

function createDefaultTask(taskName, fileName, source, minified) {

  // dont allow to push same task twice
  if(taskListDef[taskName]) throw "Can't create duplicated task";


  gulp.task(taskName, function() {
      return gulp.src(source.main)
          .pipe(less({
              paths: source.dir,
              compress: minified
          }))
          .on("error", handleError)
          .pipe(rename(fileName))
          .pipe(gulp.dest(build.bootstrap))
          .pipe( livereload( server ));
  });
  
  taskListDef.push(taskName);

}

// DEV TASK CREATION

createDevTaskForBootstrap('bootstrap:amethyst', 'amethyst');
createDevTaskForBootstrap('bootstrap:amethyst:min', 'amethyst', true);
createDevTaskForBootstrap('bootstrap:carrot', 'carrot');
createDevTaskForBootstrap('bootstrap:carrot:min', 'carrot', true);
createDevTaskForBootstrap('bootstrap:greensea', 'greensea');
createDevTaskForBootstrap('bootstrap:greensea:min', 'greensea', true);
createDevTaskForBootstrap('bootstrap:belizehole', 'belizehole');
createDevTaskForBootstrap('bootstrap:belizehole:min', 'belizehole', true);

createDevTaskForPlan('plan:amethyst', 'amethyst');
createDevTaskForPlan('plan:amethyst:min', 'amethyst', true);
createDevTaskForPlan('plan:carrot', 'carrot');
createDevTaskForPlan('plan:carrot:min', 'carrot', true);
createDevTaskForPlan('plan:greensea', 'greensea');
createDevTaskForPlan('plan:greensea:min', 'greensea', true);
createDevTaskForPlan('plan:belizehole', 'belizehole');
createDevTaskForPlan('plan:belizehole:min', 'belizehole', true);


// HELPERS

function createDevTaskForBootstrap(taskName, themeName, minified) {
  // by default, do not compress source
  minified = minified || false;
  var themeStylesheet = 'bootstrap.'+ themeName + (minified?'.min':'') + '.css';

  createDevTask(taskName, themeName, themeStylesheet, source.bootstrap, minified);
}

function createDevTaskForPlan(taskName, themeName, minified) {
  // by default, do not compress source
  minified = minified || false;
  var themeStylesheet = 'plan.'+ themeName + (minified?'.min':'') + '.css';

  createDevTask(taskName, themeName, themeStylesheet, source.plan, minified);
}

function createDevTask(taskName, themeName, themeStylesheet, source, minified) {

  // dont allow to push same task twice
  if(taskListDev[taskName]) throw "Can't create duplicated task";

  var themeColor = Themes[themeName];
  if(!themeColor) throw "Can't read given theme color.";

  var newVar = { '@link-color': themeColor, '@brand-primary': themeColor };

  gulp.task(taskName, function() {
      return gulp.src(source.main)
          .pipe( modifyVars( newVar ) )
          .pipe(less({
              paths: [source.dir],
              compress: minified
          }))
          .on("error", handleError)
          .pipe(rename(themeStylesheet))
          .pipe(gulp.dest(build.bootstrap))
          .pipe( livereload( server ));
  });

  taskListDev.push(taskName);
}

// Simulate browser version of LESS.modifyVars
function modifyVars(opts) {
  var variables = '';
  for(var p in opts) {
    variables += p + ': ' + opts[p] + ';';
  }
  return through.obj(function (file, enc, cb) {
    if(file.isBuffer()){
      try {

        file.contents = new Buffer(file.contents + '\n' + variables);

      } catch(e) {
        this.emit('error', e);
      }
    }

    this.push(file);
    cb();

  });
}

//---------------
// WATCH
//---------------

createWatch('watch',     taskListDef);
createWatch('watch:dev', taskListDev);

// Rerun the task when a file changes
function createWatch(taskName, taskList) {

  gulp.task(taskName, function() {
    try {
        server.listen(
          lvr_port,
          function (err) {
            if (err) { return console.log(err); }
            gulp.watch(source.bootstrap.watch, taskList);
        });
    }
    catch(e) {
      console.log(e);
    }

  });

}

//---------------
// START TASKS
//---------------

gulp.task('default', taskListDef.concat('watch'));

gulp.task('dev', taskListDev.concat('default', 'watch:dev'));


// Error handler
function handleError(err) {
  console.log(err.toString());
  this.emit('end');
}

