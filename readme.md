#文件上传注意事项

1. 需要关闭php的错误提示，避免影响 JSON 数据的解析
1. 文件大小收到 PHP 配置文件 `php.ini` 中 `upload_max_filesize` 的限制 
2. 文件大小收到 MySQL 配置文件中 `max_allowed_packet` 的限制