#!/usr/bin/env bash

"$(dirname "$0")/glotpress-export.sh" "$@" \
	> /tmp/glotpress-export.log \
	2>&1
