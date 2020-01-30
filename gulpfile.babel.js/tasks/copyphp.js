import { src, dest } from 'gulp';
import changed from "gulp-changed";

// Config
import { paths } from "../config";

// Task
export function copyphp() {
  return src(paths.copyphp.src)
    .pipe(changed(paths.copyphp.dest))
    .pipe(dest(paths.copyphp.dest))
}
