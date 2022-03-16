##Installation
```composer require twin-elements/form-extensions```

in `/config/packages/routes.yaml`
```
filemanager_image:
    resource: "@TwinElementsFormExtensionsBundle/Controller/FileManagerImageController.php"
    prefix: /admin
    type: annotation
    requirements:
        _locale: '%app_locales%'
    defaults:
        _locale: '%locale%'
        _admin_locale: '%admin_locale%'
    options: { i18n: false }
```
in `assets/admin/cropper.js` add

`import 'twin-elements/forms/resources/image-cropper-js';`


in `webpack.config.js`

add ```const twinElementsFormScripts = path.resolve(__dirname, 'vendor/twin-elements/form-extensions/src/Resources/private/')```

add `.addEntry('cropper', './assets/admin/cropper.js')` to admin config in `webpack.config.js`

add path aliases to admin config
```
adminConfig.resolve.alias['twin-elements/forms/resources'] = twinElementsFormScripts;
adminConfig.resolve.alias['root-dir'] = rootDir;
```
