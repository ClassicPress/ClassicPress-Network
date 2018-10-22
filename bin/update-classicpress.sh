#!/usr/bin/env bash

# exit on error
set -e

build_dir="$1"

if [ ! -f "$build_dir/wp-includes/version.php" ]; then
	echo "Usage: $0 classicpress-build-dir/"
	exit 1
fi

( cd "$build_dir"; ls ) | grep -v wp-content | while read f; do
	rm -rfv "$(dirname "$0")/../$f"
	cp -var "$build_dir/$f" "$(dirname "$0")/../$f"
done

( cd "$build_dir"; find wp-content/ -type f ) | grep -v 'themes/twenty' | while read f; do
	cp -va "$build_dir/$f" "$(dirname "$0")/../$f"
done
