#!/usr/bin/env sh
set -eu

if [ ! -f .env.local ] && [ -f .env.example ]; then
  cp .env.example .env.local
fi
