/*
 * @title Config
 */

// Paths
export const paths = {
  styles: {
    src: 'components/styles/index.scss',
    watch: 'components/styles/**/*.scss',
    modules: 'components/modules/**/*.scss',
    dest: 'css',
    lint: 'components/styles/**/*.s+(a|c)ss'
  },
  scripts: {
    src: 'components/scripts/app.js',
    watch: 'components/scripts/**/*.js',
    modules: 'components/modules/**/*.js',
    dest: 'js',
  },
  copy: {
    src: 'components/fonts/**/*',
    watch: 'components/fonts/**/*',
    dest: 'css',
  },
};
