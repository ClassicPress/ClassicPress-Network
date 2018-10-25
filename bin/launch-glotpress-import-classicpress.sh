#!/usr/bin/env bash

"$(dirname "$0")/glotpress-import-classicpress.sh" "$@" \
	> /tmp/glotpress-import-classicpress.log \
	2>&1
