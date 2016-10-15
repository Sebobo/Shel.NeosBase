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

### Form elements

* `Shel.NeosBase:Honeypot` is a hidden form element which catches spam bots.

### Viewhelpers

* `EmbedViewHelper` allows to embed file content via fluid, for example svg files.
* `FlattenViewHelper` renders an two-dimensional array as simple string for sending form data via mail.   
* `TagViewHelper` renders a tag with defined attributes. Instead of writing something like this in your node templates `<div{attributes ->f:format.raw()}>` you can now write `<snb:tag attributes="{attributes}" tag="div">`    

To use them, add the following to your fluid template:

    {namespace snb=Shel\NeosBase\ViewHelpers}  
    
Or when you want autocompletion add instead the following to the beginning of your template:

    <html xmlns="http://www.w3.org/1999/xhtml" lang="en"
          xmlns:snb="https://xsd.helzle.it/ns/Shel/NeosBase/ViewHelpers">
          
Afterwards alt-click on the schema url and tell PhpStorm to fetch the schema from the external resource. 
    
#### Fluid viewhelper schemas 

For autocompletion you can add the viewhelper schema to PhpStorm.
The schema is in the package folder at `Documentation/Schema.xsd`.

To rebuild the Fluid viewhelper schema for this package run this:

    ./flow documentation:generatexsd --phpNamespace "Shel\NeosBase\ViewHelpers" --targetFile Packages/Plugins/Shel.NeosBase/Documentation/Schema.xsd --xsdNamespace "https://helzle.it/ns/Shel/NeosBase/ViewHelpers"

### Validators

* `IsEmptyValidator` - for the included HoneyPot form element. 

### Enhanced TypoScript for page rendering

#### Page rendering

This package uses the alternative page rendering described in the [Neos documentation](http://neos.readthedocs.org/en/stable/HowTos/SelectingPageTemplate.html#using-a-defaultpage-prototype).
The basic prototype to extend from is `Shel.NeosBase:DefaultPage`. 
Read the Neos documentation about how to add your own page layouts. 
 
#### Additional html head parts 

Adds additional configurable meta tags in the page header (f.e. css, author, ie compatibility, viewport, favicon, etc...). 
See the prototype `Shel.NeosBase:DefaultPage` for details.

#### Additional html body parts

Also included is a configurable live reload script when you are developing your stylesheets. 
See `Settings.yaml` for the configuration.

To easily include your javascript bundle see the ts path `body.javascripts.bundle`.

#### TypoScript objects

* `Shel.NeosBase:Navigation` is a menu to be used for the main site navigation
* `Shel.NeosBase:MetaMenu` is a menu which renders all documents marked with the `Show in meta menu` property, provided by the `Shel.NeosBase:MetaMenuMixin`.
* `Shel.NeosBase:SiteLogo` is a configurable helper to render the site logo including the link to the homepage
* `Shel.NeosBase:LinkTag`, `Shel.NeosBase:ScriptTag`, `Shel.NeosBase:MetaTag`, `Shel.NeosBase:StyleSheetTag` make it easier to add custom tags to document 

