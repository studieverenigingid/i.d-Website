# Contributing

## Getting started
Want to contribute? Setup your development environment:

1. Assuming you’ve cloned this repo and installed [Node with npm](https://nodejs.org/en/) and [gulp](http://gulpjs.com/), run `npm install`
2. Run `gulp` to compile, concat and copy the files to `static/` and have it updated when you change something in `src/` - for the rest of our Gulp setup, see below

## Gulp

### While developing
While developing you’ll probably want to have gulp compile and then watch your resources. Just run `gulp` for that.
Do you run into problems with images not being updated? Stop `gulp` and run `gulp clear`, which clears the image cache, making sure running `gulp` again will replace all images in `static/` (or it should, anyway)

### To production
When we push the code to production, we’ll run `gulp build`, which does the following:

1. Concat, compile and copy the SASS and JS to `static/`, as well as compress the images and copy those as well as any fonts to `static/`.
2. In addition to that, it autoprefixes the CSS for the last two versions of browsers (maybe there’s a more useful coverage, we’ll have to look into that).
3. It also uglifies both the JS and CSS.
4. It does NOT create sourcemaps, which it does do in the dev version of the commands.
