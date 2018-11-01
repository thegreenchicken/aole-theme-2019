# aole 2018 worpress theme

having node js installed, cd to the root of this project (same directory as this readme) and run `npm install`. After this, get the scss to auto-compile using the `npm run sass` command.
* The stylesheets are compiled from the contents inside the src folder, into the dist/css folder.
* it is possible to add compilation of js files into this pipeline.

The rules for this template are the following:
* the generated html has to be as css-agnostic as possible, meaning that applying any aesthetic by coding the html is avoided. The styling and positions are as much as possible attained using CSS; within reason. In this way, it is easier for future developers to tweak things
* It is also possible to use javascript to prevent tailoring html to the styling
* In order to be able to style in different ways posts of different types, the css class contains information about the post type, etc. so that the CSS can tailor custom behaviours.
* Re-use styles and scss variables as much as possible, encouraging consistency.
* have only one CSS `@media` query, when the screen is small enough. Try to make the content flexible for the rest of the width size range 

The agnostic html structure is as follows:

```
┌────────────────────────────────────────┐   
│   Client-body                          │   
│                                        │   
│    ░░░░░░░main-container ░░░░░░░░░░    │   --> header.php
│   ┌────────────────────────────────┐   │   
│   │  section-container section-<name>-container  
│   ┌────────────────────────────────┐   │   
│   │  item-<name>-container         │   │   
│   │                                │   │   (example of a single-content
│   │  ..depending on the content    │   │   section)
│   │  type, this receives different │   │   
│   │  properties                    │   │   
│   └────────────────────────────────┘   │   
│   │  /end section-container        │   │   
│   └────────────────────────────────┘   │   
│    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░    │   
│   ┌────────────────────────────────┐   │   
│   │  section-container section-<name>-container     
│   ┌────────────────────────────────┐   │   
│   │  items-wrapper items-<name>-wrapper   (example of a section
│   │  ┌───────┐ ┌───────┐ ┌───────┐ │   │   containing a list of 
│   │  │item-  │ │item-  │ │item-  │ │   │   elements, such as an index)
│   │  │<name>-│ │<name>-│ │<name>-│ │   │   
│   │  │cont.. │ │cont.. │ │cont.. │ │   │   
│   │  └───────┘ └───────┘ └───────┘ │   │   
│   └────────────────────────────────┘   │   
│   │  /end section-container        │   │   
│   └────────────────────────────────┘   │   
│    ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░    │   
│   ┌────────────────────────────────┐   │   --> footer.php  
│   │  section-container             │   │   
│   ┌────────────────────────────────┐   │   
│   │  item-footer-container         │   │     
│   └────────────────────────────────┘   │   
│   │  /end section-container        │   │   
│   └────────────────────────────────┘   │   
│    ░░░/end main-container░░░░░░░░░░    │ 
│                                        │   
└────────────────────────────────────────┘   
```
  
# Blank slate

# Aleksi Tapale foundationpress
# Foundation press


# Primitive
https://github.com/taniarascia/primitive

Primitive is a minimalist Sass boilerplate and CSS framework that provides helpful, browser-consistent styling for buttons, forms, tables, lists, and typography.

## Getting Started

- **Quick start** - [Download the stylesheet](https://taniarascia.github.io/primitive/css/main.css).
- **Sass integration** - Clone the repo: `git clone https://github.com/taniarascia/primitive.git`.

Simply run `npm run sass` to run a Sass watch on the entire project.

## Documentation

All documentation can be found at [https://taniarascia.github.io/primitive](https://taniarascia.github.io/primitive).

## Todo:

_9/8/18_

- [x] Add source maps
- [x] Add minification
- [ ] Add autoprefixing
- [x] Change documentation page to remove Gulp

## License

The code is open source and available under the [MIT License](LICENSE.md).

Built and maintained by [Tania Rascia](https://www.taniarascia.com)
