<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<IfModule mod_mime.c>
AddType text/css .css
AddType application/x-javascript .js
AddType text/html .html .htm
AddType text/richtext .rtf .rtx
AddType image/svg+xml .svg .svgz
AddType text/plain .txt
AddType text/xsd .xsd
AddType text/xsl .xsl
AddType text/xml .xml
AddType video/asf .asf .asx .wax .wmv .wmx
AddType video/avi .avi
AddType image/bmp .bmp
AddType application/java .class
AddType video/divx .divx
AddType application/msword .doc .docx
AddType application/x-msdownload .exe
AddType image/gif .gif
AddType application/x-gzip .gz .gzip
AddType image/x-icon .ico
AddType image/jpeg .jpg .jpeg .jpe
AddType application/vnd.ms-access .mdb
AddType audio/midi .mid .midi
AddType video/quicktime .mov .qt
AddType audio/mpeg .mp3 .m4a
AddType video/mp4 .mp4 .m4v
AddType video/mpeg .mpeg .mpg .mpe
AddType application/vnd.ms-project .mpp
AddType application/vnd.oasis.opendocument.database .odb
AddType application/vnd.oasis.opendocument.chart .odc
AddType application/vnd.oasis.opendocument.formula .odf
AddType application/vnd.oasis.opendocument.graphics .odg
AddType application/vnd.oasis.opendocument.presentation .odp
AddType application/vnd.oasis.opendocument.spreadsheet .ods
AddType application/vnd.oasis.opendocument.text .odt
AddType audio/ogg .ogg
AddType application/pdf .pdf
AddType image/png .png
AddType application/vnd.ms-powerpoint .pot .pps .ppt .pptx
AddType audio/x-realaudio .ra .ram
AddType application/x-shockwave-flash .swf
AddType application/x-tar .tar
AddType image/tiff .tif .tiff
AddType audio/wav .wav
AddType audio/wma .wma
AddType application/vnd.ms-write .wri
AddType application/vnd.ms-excel .xla .xls .xlsx .xlt .xlw
AddType application/zip .zip
AddType font/x-woff .woff
</IfModule>

<IfModule mod_deflate.c>
# Insert filters
AddOutputFilterByType DEFLATE text/plain
AddOutputFilterByType DEFLATE text/html
AddOutputFilterByType DEFLATE text/xml
AddOutputFilterByType DEFLATE text/css
AddOutputFilterByType DEFLATE application/xml
AddOutputFilterByType DEFLATE application/xhtml+xml
AddOutputFilterByType DEFLATE application/rss+xml
AddOutputFilterByType DEFLATE application/javascript
AddOutputFilterByType DEFLATE application/x-javascript
AddOutputFilterByType DEFLATE application/x-httpd-php
AddOutputFilterByType DEFLATE application/x-httpd-fastphp
AddOutputFilterByType DEFLATE image/svg+xml

# Drop problematic browsers
BrowserMatch ^Mozilla/4 gzip-only-text/html
BrowserMatch ^Mozilla/4\.0[678] no-gzip
BrowserMatch \bMSI[E] !no-gzip !gzip-only-text/html

# Make sure proxies do not deliver the wrong content
Header append Vary User-Agent env=!dont-vary
</IfModule>

<IfModule mod_gzip.c>
mod_gzip_on         Yes
mod_gzip_dechunk    Yes
mod_gzip_item_include file		\.(html?|txt|css|js|php|pl)$
mod_gzip_item_include mime		^text\.*
mod_gzip_item_include mime		^application/x-javascript.*
mod_gzip_item_exclude mime		^image\.*
mod_gzip_item_exclude rspheader	^Content-Encoding:.*gzip.*
</IfModule>

<ifModule mod_headers.c>
<FilesMatch "\.(html|htm)$">
	Header set Cache-Control "max-age=43200"
</FilesMatch>
<FilesMatch "\.(js|css|txt)$">
	Header set Cache-Control "max-age=604800"
</FilesMatch>
<FilesMatch "\.(flv|swf|ico|gif|jpg|jpeg|png)$">
	Header set Cache-Control "max-age=2592000"
</FilesMatch>
#	<FilesMatch "\.(pl|php|cgi|spl|scgi|fcgi)$">
#		Header unset Cache-Control
#	</FilesMatch>
</IfModule>

<ifModule mod_expires.c>
	<FilesMatch "\.(ico|jpg|jpeg|png|gif|swf)$">
		ExpiresActive On
		ExpiresDefault "access plus 2 weeks"
	</FilesMatch>
</IfModule>