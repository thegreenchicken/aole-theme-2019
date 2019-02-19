# Editing CSS

It is possible to edit the CSS directly, but this will make it impossible for future developers to build on top of your work, and presumably it will be harder than actually compiling SCSS. You will need to setup a SCSS compilation workflow. As a starting point, please refer to the "developers-workflow" document here.

## How to know what to edit?

Provided that the last developer compiled the SCSS using source map, you can easily know what source file to edit in order to make a specific change.
* Visit the website online
* Inspect the element that you want to edit (right click>inspect)
* Find the property that needs changing. There should be an indication of what SCSS source file defined that property.
