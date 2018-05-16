**LwbCmsBundle** is a **Symfony Bundle** allowing the management of 
the manageable pages in an ergonomic way

Require
------------

####kms/froala-editor-bundle

``` yaml
// composer.json

"kms/froala-editor-bundle": "dev-master",
```

####Configuration froala editor

``` yaml
// app/config.yml

kms_froala_editor:
    language: "fr"
    serialNumber: "XXXX-XXXX-XXXX"
    includeJQuery: false
    includeCodeMirror: false
    includeFontAwesome: true
    includeJS: true
    includeCSS: true
    imageUploadFolder: "/froala"
    # Disable autosave
    saveInterval: 0
    pluginsDisabled: ['spellChecker']
    imageDefaultWidth: 0
    htmlDoNotWrapTags: ['img']
    # do not add <p> tag automatically
    htmlUntouched: true
```

####Override the vendor
Unfortunately, in the case you use several editor. You can't load fraola editor because it use an 
 ID for select the element and Symfony doesn't allow to customize the id in form element and the bundle
 doesn't allow to configure this element. So you have to override the template in the javascript with that
 
``` twig
// vendor\kms\froala-editor-bundle\Resources\views\Form\froala_widget.html.twig

{# add the class .froala-editor #}
$( document ).ready( function () { $( ".froala-editor" ).froalaEditor({
```

Also use AJAX to offset this issue doesn't work because of too many ajax request !


Installation
------------

####Step 1 : 
* Just install it manually like a copy paste.

#### Step 2 : Add the bundle to your AppKernel.php

``` php
// app/AppKernel.php

public function registerBundles()
{
  $bundles = array(
    // ...
        new Lwb\CmsBundle\LwbCmsBundle(),
  );
}
```

#### Step 3 : Configure the bundle

``` yaml
// app/config/parameters.yml
parameters:
    lwb_cms:
        # add cdn bootstrap
        include_bootstrap: false
        roles_allowed: ['ROLE_SUPER_ADMIN', 'ROLE_AGENT']
```

``` yaml
// app/config/services.yml
imports:
    - { resource: "@LwbCmsBundle/Resources/config/services.yml" }
```

#### Step 4 : Enable manager in Twig

``` yaml
// app/config/config.yml
twig:
    globals:
        block_manager: '@lwb_cms.block.manager'
```

``` yaml
// app/config/services.yml
imports:
    - { resource: "@LwbCmsBundle/Resources/config/services.yml" }
```

How to use it
-------------

- in your database at lwb_cms_block table : 
Add the html in rich_content field in the lwb_cms_block table in your data base and set the key_name field

- in your twig template where the fuc* you want : 
    ``` twig
    {{ block_manager.render('%your_key_name%')|raw }}
    ```

## TODO
- Add some tests (with <img>, <video> and more html tags)
- Enable the installation by composer
- optimize the assets (css, js) (today the assets are duplicated by the number of manager call by)

## License

The bundle is developped by Lorweb and can be used only by Lorweb. 
Copyright Lorweb. All Rights reserved