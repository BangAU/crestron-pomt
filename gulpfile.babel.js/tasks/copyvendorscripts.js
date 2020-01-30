import { src, dest } from 'gulp';
import changed from "gulp-changed";

// Config
import { paths } from "../config";

// Task
export function copyvendorscripts() {
  return src(paths.copyvendorscripts.src)
    .pipe(changed(paths.copyvendorscripts.dest))
    .pipe(dest(paths.copyvendorscripts.dest))
}
