# Workflow

This is the workflow used originally to develop the theme, which might be useful for future developers of this theme:

## Use Git!

In theory, it would be possible for you to change the contents on the live site. It is also possible to change the CSS online by using the SCSS source files and compiling them directly to the site. It would be a better practice, though, to download and keep version tracking of the repository, so that it remains possible for future developers to do changes to the site.

## Suggested alternative 1

Recommended. This alternative might be one of the easiest, yet allowing a wide gamut of changes.

1. Download the repository, currently available at https://github.com/autotel/aole-theme-2019.
2. Copy the site into a shadow (shadow is a special staging feature available to this domain)
  * read the shadow documentation https://seravo.com/docs/deployment/shadows/
  * connect via SSH into the server
  * perform a shadow-reset according to this manual
  * change the site instance into the shadow that you are using
3. Connect via FTP to that shadow (make *very* sure that you are actually connected to the shadow and not the production). Whether you are connected to a shadow or not, is determined by the connection port. Make some tiny changes first to make sure that you are connected to the shadow, if you are not comfortable.
4. Set the FTP to automatically sync the `./data/wordpress/htdocs/wp-content/themes/Aole2019` to the `./dist` folder of the theme repository. In this way, any change that you perform, gets reflected in the shadow site.
5. Open the repository folder with your favourite editor.
### If you need to edit the stylesheet
6. Install node js if you don't have it, to compile SCSS into CSS. Possibly other ways to compile SCSS could work too.
  * You'll probably won't need this info, but the source of the scss is `./src/scss` and the destination is `./dist/css/main.css`
7. Using the console, perform an `npm install` at the root folder of the repository
8. Run `npm run dev` and cross your fingers. Now the scss compiler should compile whenever you make a change to the SCSS.

## Suggested alternative 2

If you will only edit the CSS, you can save the website locally, and change the stylesheet SRC to your local CSS compiled copy. Then perform steps 6 to 8 of the alternative 1.
