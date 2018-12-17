#!/usr/bin/env bash

# Exit on error
set -e

# Show commands executed
set -x

pushd /home/forge/classicpress.net/
	wp \
		--url=https://translate.classicpress.net \
		glotpress language-pack-endpoint \
		core
popd
