#!/bin/bash

themes_path="/usr/share/texmf/tex/latex/beamer/base/themes/theme"
filename="$1"
output_directory="./change_themes"

# Needs the .tex file as the command-line argument
if [[ -z "$filename" ]]; then
    echo "Needs a command-line argument";
    exit;
fi

# Create the output directory if needed
if ! [[ -d "$output_directory" ]]; then
    mkdir -p "$output_directory";
fi

for theme in $themes_path/*.sty; do
    theme_name="$(echo "$(basename "$theme")" | sed -re 's/beamertheme(.*)\.sty/\1/')"
    sed -r "s/usetheme\{(.*)\}/usetheme{$theme_name}/" "$filename" > "$output_directory/$filename"
    pdflatex -output-directory="$output_directory" "$output_directory/$filename"
    pdf_fname="$(basename "$filename" ".tex").pdf"
    pdf_fname_new="${theme_name}_${pdf_fname}"
    mv "$output_directory/$pdf_fname" "$output_directory/$pdf_fname_new"
done
