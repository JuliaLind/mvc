#!/usr/bin/env bash


url="https://docs.google.com/spreadsheets/d/1mAhEYKpoaI4_vegkrLgcMzAgaI-PrFlM/gviz/tq?tqx=out:csv&sheet"

for target in book; do
    printf "%s\\n" "$target"
    curl --silent "$url=$target" > "$target.csv"
done

ls -l -- *.csv
file -- *.csv
