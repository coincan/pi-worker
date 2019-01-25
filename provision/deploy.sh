#!/usr/bin/env bash

cd "$(dirname "$0")"

cans down
git checkout master
cans run compoer install
cans up -d


