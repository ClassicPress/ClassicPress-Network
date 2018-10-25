#!/usr/bin/env bash

# exit on error
set -e

wp --version

user="$1"
[ -z "$user" ] && user=localdev
pass="$2"
[ -z "$pass" ] && pass=localdev

echo "Will create administrative user '$user' with password '$pass'."
echo -n 'Press Enter to continue, Ctrl+C to exit ... '
read i

wp user create "$user" "$user@example.com" --role=administrator --user_pass="$pass"
wp super-admin add "$user"
wp site list --field=url --format=csv | while read url; do
	wp user set-role "$user" administrator --url="$url"
done
