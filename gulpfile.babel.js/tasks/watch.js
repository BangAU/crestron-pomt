/*
 * @title Watch
 * @description A task to start the server and watch for changes.
 */

// Dependencies
import gulp from 'gulp';
import { series } from 'gulp';

// Tasks
import { styles } from './styles';
import { scripts } from './scripts';
import { copy } from './copy';

// Config
import { paths } from "../config";

function watchFiles() {
  gulp.watch([paths.styles.watch, paths.styles.modules], styles);
  gulp.watch([paths.scripts.watch, paths.scripts.modules], scripts);
  gulp.watch([paths.copy.watch, paths.copy.watch], copy);
}

export const watch = series(
  watchFiles
);
