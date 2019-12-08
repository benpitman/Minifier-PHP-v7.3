#!/usr/bin/env bash

showHelp ()
{
    cat << ____HELP

    Usage: minify -i FILE [-a] [-h] [-l LANG] [-o FILE] [(-p PATTERN | -n PATTERN)]

        -a      Gets all available patterns.
                If -l provided, will return patterns for given language LANG.

        -h      Displays this help text and exits.

        -i FILE
                The input file to be minified.

        -l LANG
                Runs all patterns provided by -p for the given language LANG.
                If no language provided, the minifier will run global patterns.

        -n PATTERN [-n PATTERN] ...
                Tells the minifier not to run these patterns.
                Overrides any PATTERN provided by -p.

        -o FILE
                The output file to save the minified version to.

        -p PATTERN [-p PATTERN] ...
                Tells the minifier to run these patterns
                If none provided, all patterns will be run for given language LANG.

    NOTES:
        Any errors, please report them to me at my GitHub page at /benpitman.

    Copyright © Ben Pitman

____HELP

    exit 0
}

getPatternList=0;

while getopts ":a :h :i: :l: :n: :o: :p:" arg; do
    case $arg in
        (a) {
            getPatternList=1
        };;
        (h) {
            showHelp
        };;
        (i) {
            if [[ ! -s "$OPTARG" ]]; then
                die "$OPTARG is not a file"
            elif [[ ! -r "$OPTARG" ]]; then
                die "$OPTARG is not readable"
            fi

            inputFile="$OPTARG"
        };;
        (l) {
            language="$OPTARG"
        };;
        (n) {
            notPatterns+=("$OPTARG")
        };;
        (o) {
            if [[ ! -e "$OPTARG" ]]; then
                die "$OPTARG is not a file"
            elif [[ ! -w "$OPTARG" ]]; then
                die "$OPTARG is not writeable"
            fi

            outputFile="$OPTARG"
        };;
        (p) {
            patterns+=("$OPTARG")
        };;
        (\?) {
            die "Invalid option -$OPTARG"
        };;
        (\:) {
            die "Option -$OPTARG requires a parameter"
        };;
    esac
done
shift $((OPTIND -1))
