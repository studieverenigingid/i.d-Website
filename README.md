# i.d-Website
The Wordpress theme for id.tudelft.nl

## Contents
- Wordpress template files
- Other Wordpress theme files (`style.css` and `functions.php`)
- source folder (`/src`) with the JS, SASS, images (like the logo)
- gulpfile to compile source to static files
- package.json to install the dependencies with for gulp

## Branches
For now there’s only a master branch, but as soon as we have a test server, we should probably make a `develop`-branch and start using the [gitflow branching model](http://nvie.com/posts/a-successful-git-branching-model/).

## Contributing

### Development environment
Want to contribute? Setup your development environment:

1. Assuming you’ve cloned this repo and installed [Node with npm](https://nodejs.org/en/) and [gulp](http://gulpjs.com/), run `npm install`
2. Run `gulp` to compile, concat and copy the files to `static/` and have it updated when you change something in `src/` - for the rest of our Gulp setup, see `CONTRIBUTING.md`
