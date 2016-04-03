# A base package for Neos CMS projects

[![Latest Stable Version](https://poser.pugx.org/shel/neosbase/v/stable)](https://packagist.org/packages/shel/neosbase)
[![Total Downloads](https://poser.pugx.org/shel/neosbase/downloads)](https://packagist.org/packages/shel/neosbase)
[![License](https://poser.pugx.org/shel/neosbase/license)](https://packagist.org/packages/shel/neosbase)

This package works as starting point for Neos CMS projects.
It provides good defaults needed in many projects and can be combined
with other packages to quickly setup a new website.

## Features

### NodeTypes

* `Shel.NeosBase:MetaMenuMixin` can be added as super type to `TYPO3.Neos:Document` to mark pages to be shown with the `Shel.NeosBase:MetaMenu` ts object. For example in a site footer.
* `Shel.NeosBase:RootPage` is a good starting point for a website which can have additional properties for the whole website. Change the type of your root node to this to use it.

### Surf deployment helper

* `NeosApplication` - simplifies Surf deployments by providing some good defaults.

### Form elements

* `Shel.NeosBase:Honeypot` is a hidden form element which catches spam bots.

### Viewhelpers

* `EmbedViewHelper` allows to embed file content via fluid, for example svg files.
* `FlattenViewHelper` renders an two-dimensional array as simple string for sending form data via mail.

### Validators

* `IsEmptyValidator` - for the included HoneyPot form element. 

### Basic TypoScript for page rendering

* Adds additional configurable meta tags in the page header (f.e. css, author, ie compatibility, viewport, favicon, etc...). See `Page.ts2` for details.
* Configurable live reload script when you are developing. See `Settings.yaml` for the configuration.
* Script tag to load js bundle. See `Page.ts2` for details.
