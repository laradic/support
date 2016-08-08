<!---
title: Dotenv
subtitle: Utilities
author: Robin Radic
-->

The `Dotenv` class extends the `Dotenv` from `vlucas` and adds a method to retreive the `.env` variables as array.

### Example
```php
$vars = \Laradic\Support\Dotenv::getEnvFile(base_path());
```
