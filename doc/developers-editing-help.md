# Editing help files
Help files are bundled with the repository, including resources.

## creating a new MD (text) help file
This help guide can load and parse MD files. Create the new MD file, then edit `index.html` to add a link to that file.
This guide is a single-page application, so the links are not directly to the MD file, but the address the md file with a hash.

`./index.html#operation=md;src=<md file, relative to ./doc>`

example:
```html
<a href="./index.html#operation=md;src=authors.md">
  Authors
</a>
```
## creating a new interactive image help file

(Be merciful about the usability; this was developed in a very short time.)

* Add the picture that you want to document in the `./res` folder or a subdirectory inside that folder
* Edit the menu at index.html. Add a link to `#operation=annotate;editable=false;json=<some json name>.json;img=<name of your picture, relative to ./doc/res>;`, replacing the text between <'s and >'s according to your situation.
* Visit that link, and replace the `editable=false` with `editable=true`. Press enter or refresh. The appearance of the page should've changed.
* Make the annotations
  * Drag in different parts of the picture to create annotation areas.
  * Click with mouse middle wheel in the white rectangle at the bottom-left corner of said areas to append text to them.
  * Drag the small square outside the area to resize it.
  * Press the `X` button to delete an area. Sometimes they stop responding, in which case you can save and re-open
  * You can save during the process, and open multiple tabs with the same content, as a strategy to prevent loosing work.
* Press the `save` button at the top, and save that JSON file at the `./res` folder or a subdirectory inside.
  * Note: This JSON file is what the `json=<some json name>.json;` address part refers to. They need to match. The path is relative to `./src/res`
* Test that it works as intended.
  * If you can't figure out where a problem is coming from, look at the existing contents as an example.
