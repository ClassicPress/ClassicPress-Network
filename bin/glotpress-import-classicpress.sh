#!/usr/bin/env bash

# Exit on error
set -e

# Show commands executed
set -x

# Update the ClassicPress repository
# Note: this repository must already exist!
pushd /tmp/classicpress
	git reset --hard
	git fetch origin
	git checkout origin/develop -B develop
popd

# Generate and import the dev .pot file
php /tmp/classicpress/tools/i18n/makepot.php generic \
	/tmp/classicpress/src \
	/tmp/classicpress-core.pot

pushd /home/forge/classicpress.net/
	wp glotpress import-originals \
		core \
		/tmp/classicpress-core.pot \
		--url=https://translate.classicpress.net/
popd

# TODO: Generate and import the stable .pot file
