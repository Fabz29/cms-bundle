**Fbaz29CmsBundle** is a **Symfony Bundle** allows a typical user to modify their website directly from the front-end 
interface

Require
------------

####kms/froala-editor-bundle

```
require kms/froala-editor-bundle
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
 ID for select the DOM element and Symfony doesn't allow to customize the id in form element and the bundle
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
```
require fabz29/cms-bundle
```

#### Step 2 : Add the bundle to your AppKernel.php

``` php
// config/AppKernel.php

Fabz29\CmsBundle\Fabz29CmsBundle::class => ['all' => true],
```

#### Step 3 : Configure the bundle

``` yaml
// config/packages/fabz29_cms.yaml
parameters:
    fabz29_cms:
        roles_allowed: ['ROLE_ADMIN']
```

``` yaml
// config/packages/routing.yml
fabz29_cms:
    resource: "@Fabz29CmsBundle/Controller/"
    type: annotation
```

#### Step 4 : Enable manager in Twig

``` yaml
// config/services.yml
twig:
    globals:
        block_manager: '@fabz29_cms.block.manager'
```

``` yaml
// config/services.yml
Fabz29\CmsBundle\Manager\BlockManager:
    arguments:
        $params: '%fabz29_cms%'
```

How to use it
-------------

- in your database at fabz29_cms_block table : 
Add the html in rich_content field in the fabz29_cms_block table in your data base and set the key_name field

- in your twig template where the fuc* you want : 
    ``` twig
    {{ block_manager.render('%your_key_name%')|raw }}
    ```

## TODO
- Add some tests (with <img>, <video> and more html tags)
- optimize the assets (css, js) (today the assets are duplicated by the number of manager call by)

## License

The bundle is developped by Fabien Zanetti and can be used only by himself. 
Copyright Fabien Zanetti. All Rights reserved