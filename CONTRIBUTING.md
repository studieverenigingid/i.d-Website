# Contributing

## Getting started
Want to contribute? Setup your development environment:

1. Assuming you’ve cloned this repo and installed
[Node with npm](https://nodejs.org/en/) and [gulp](http://gulpjs.com/),
run `npm install`
2. Run `gulp` to compile, concat and copy the files to `static/` and have it
updated when you change something in `src/` - for more on the Gulp setup, see below

## Gulp

### While developing
While developing you’ll probably want to have gulp compile and then watch your
resources. Just run `gulp` for that.
Do you run into problems with images not being updated? Stop `gulp` and run
`gulp clear`, which clears the image cache, making sure running `gulp` again
will replace all images in `static/` (or it should, anyway)

### To production
When we push the code to production, we’ll run `gulp build`, which does the
following:

1. Concat, compile and copy the SASS and JS to `static/`, as well as compress the images and copy those as well as any fonts to `static/`.
2. In addition to that, it autoprefixes the CSS for the last two versions of browsers (maybe there’s a more useful coverage, we’ll have to look into that).
3. It also uglifies both the JS and CSS.
4. It does NOT create sourcemaps, which it does do in the dev version of the commands.


## Styleguide

### General

1. Tabs (because Floris got convinced by
	[this answer](http://softwareengineering.stackexchange.com/a/72) and Nils
	already was convinced
2. Never id’s as selectors, almost always classes (selecting elements like
	`footer` is scary, except when you do the basic styling of for example
	`input`s) (and elements are not needed when you use a class, so don’t you
	dare to write something like `footer.nice-footer`)
3. Rules shorter than 80 chars are preferred but not obligatory
4. Remove trailing whitespaces (use a plugin if you need)
5. Add a newline to the end of file

### Git and commiting

1. Try to write descriptive commit messages; e.g. not what file was updated but
why
2. Try to keep commits small, so reverting commits actually works and doesn’t
break later commits
3. Did you fuck up (I know you did, I did too)? Try
[this](http://sethrobertson.github.io/GitFixUm/fixup.html)

### JS

1. Function names are in camelCase
2. Classes used for binding with JS are prefixed with `js-` and written with
dashes

### SASS

1. Selectors with more than three levels are forbidden (because three is a nice
	number, maybe it should be two)
2. If you go down levels, use nesting (and if a selector has nothing in it, you
	probably shouldn’t be nesting)
3. Also use nesting when you use pseudo-selectors (`:hover` and `:before` and
	the like)
3. Don’t use prefixes, we have autoprefixer
4. Use 0, not none
5. One selector per line
6. Use BEM (Block, Element, Modifier) – example: `.btn` defines the precense of
	a shadow, the font, etc., `.btn--default` defines the colours for the default
	button, `btn--education` the colours for the button when used in an education
	context (for example in the onderwijsbriefje), `.btn__icon` defines the
	styling for an icon within the button
