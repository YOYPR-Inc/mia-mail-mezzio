# mia-mail-mezzio

1. Copiar Rutas
```php
    /** EMAILs Templates  */
    $app->route('/mia-mail-admin/list', [\Mia\Mail\Handler\FetchTemplatesHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia-mail.list');
    $app->route('/mia-mail-admin/save', [\Mia\Mail\Handler\SaveTemplateHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia-mail.save');
    $app->route('/mia-mail-admin/send-preview', [\Mia\Mail\Handler\SendgridHandler::class, \Mia\Mail\Handler\SendPreviewHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia-mail.send-preview');
```