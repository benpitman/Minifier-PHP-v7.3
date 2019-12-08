#!/usr/bin/env bash

die ()
{
    (( $errors )) && printf '\e[31;1mError:\e[0m %s\n' "$@"
}

warn ()
{
    (( $warnings )) && printf '\e[33;1mWarning:\e[0m %s\n' "$@"
}

inform ()
{
    (( $informs )) && printf '\e[34;1mInfo:\e[0m %s\n' "$@"
}

showHelp ()
{
    cat << ____HELP

    Usage: minify -i FILE [-a] [-h] [-i FILE] [-l LANG] [-n PATTERN] [-o FILE] [-p PATTERN] [-q[q]]

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
                If no file is provided, it will output to the terminal.

        -p PATTERN [-p PATTERN] ...
                Tells the minifier to run these patterns.
                If none provided, all patterns will be run for given language LANG.

        -q      Disables output of informs.

        -qq     Disabled output of warnings.

        -qqq    Disables output of errors.

    NOTES:
        Any errors, please report them to me at my GitHub page at /benpitman.

    Copyright © Ben Pitman

____HELP

    exit 0
}

language=
getPatternList=0
informs=1
warnings=1
errors=1

for arg in "$@"; do
    if [[ "$arg" == -qqq ]]; then
        errors=0
    fi
    if [[ "$arg" =~ -qqq? ]]; then
        warnings=0
    fi
    if [[ "$arg" =~ -qq? ]]; then
        informs=0
    fi
done

while getopts ":a :h :i: :l: :n: :o: :p: :q" arg; do
    case $arg in
        (a) {
            getPatternList=1
        };;
        (h) {
            showHelp
        };;
        (i) {
            if [[ ! -e "$OPTARG" ]]; then
                die "$OPTARG is not a file"
            elif [[ ! -r "$OPTARG" ]]; then
                die "$OPTARG is not readable"
            elif [[ ! -s "$OPTARG" ]]; then
                die "$OPTARG is empty"
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
                warn "$OPTARG is not a file. Attempting to create."

                createErrors=$( touch "$OPTARG" 2>&1 )

                if [[ -n "$createErrors" ]]; then
                    die "$createErrors"
                fi

                inform "File '$OPTARG' created"
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

if [[ -z "$language" ]]; then
    warn "No language provided. Defaulting to Any"
fi
if (( ${#patterns[0]} == 0 )); then
    warn "No patterns provided. Defaulting to all."
fi
