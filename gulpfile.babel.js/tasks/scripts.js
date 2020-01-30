/*
 * @title Scripts
 * @description A task to concatenate and compress js files via webpack.
 */

// Dependencies
import { src, dest, series } from 'gulp';
import gulp from 'gulp';
import source from 'vinyl-source-stream';
import buffer from 'vinyl-buffer';
import browserify from 'browserify';
import watchify from 'watchify';
import babel from 'babelify';

// Config
import { paths } from "../config";

// Task
export function esTranspile() {
    var bundler = watchify(browserify(paths.scripts.src, { debug: true }).transform(babel));
    return bundler.bundle()
    .on('error', function(err) { console.error(err); this.emit('end'); })
    .pipe(source('app.js'))
    .pipe(buffer())
    .pipe(gulp.dest(paths.scripts.dest));
}

export const scripts = series(esTranspile);
