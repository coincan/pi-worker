#!/usr/bin/env bash

cd "$(dirname "$0")"

cans down
git checkout release
cans run compoer update
cans up -d


