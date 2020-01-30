/*
 * @title Server
 * @description A task to initialise a local server.
 */
// Dependencies
import browserSync from 'browser-sync';
import php from 'gulp-connect-php';
// Config
import { paths } from "../config";
// Task
// const server = browserSync.create();
export function serve(cb) {
  php.server({
    base: paths.dest,
  }, function (){
    browserSync.init({
      proxy:"127.0.0.1:8000",
      baseDir: [ paths.dest ],
      notify: false
    });
    cb();
  });
}

export function reload(cb) {
  browserSync.reload();
  cb();
}
