#!/usr/bin/env bash

source .env

declare -a urlList

urlList[1]="https://shop.coles.com.au/a/a-vic-metro-burwood-east/product/nan-optipro--ha-gold-formula-stage-2"
urlName[1]="nan-stage-2.html"

urlList[2]="https://shop.coles.com.au/a/a-vic-metro-burwood-east/product/dettol-foam-hand-wash-refill-rose-cherry"
urlName[2]="dettol-foam-cherry.html"

HEADLESS_EXECUABLE="${HEADLESS_BIN} --headless --disable-gpu --dump-dom --virtual-time-budget=99999999 --run-all-compositor-stages-before-draw" # https://liduan.net > ab

for i in "${!urlList[@]}"
do
    eval "${HEADLESS_EXECUABLE} ${urlList[$i]} > ${urlName[$i]}"
done








