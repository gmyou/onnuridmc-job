# onnuridmc-job

## User Assistants on Eclipse
Preferences > PHP > Editor > Templates
`New...`
* `last_query`
```php
echo "<pre>"; $$this->db->last_query(); echo "</pre>";
```
* `pre_print`
```php
echo "<pre>";
print_r( ${cursor} );
echo "</pre>";
```
