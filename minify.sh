#!/usr/bin/env bash

die ()
{
    (( $_errors )) && printf '\e[31;1mError:\e[0m %s\n' "$@" 1>&2
    exit 1;
}

warn ()
{
    (( $_warnings )) && printf '\e[33;1mWarning:\e[0m %s\n' "$@" 1>&2
}

inform ()
{
    (( $_informs )) && printf '\e[34;1mInfo:\e[0m %s\n' "$@" 1>&2
}

showHelp ()
{
    cat << ____HELP

    Usage: minify [-a [-d]] [-h] [-i FILE] [-l LANG] [-n PATTERN] [-o FILE] [-p PATTERN] [-q[q[q]]] [-r]

        -a      Runs minification with all available patterns.
                If -l provided, it will run patterns for given language LANG.
                If -d provided, it will just print the patterns and exit.

        -d      Disables the minification. Used in conjunction with -a.

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

        -q      Disables output of informs.

        -qq     Disabled output of warnings.

        -qqq    Disables output of errors.

        -r      Replaces the input FILE with the minified version. (Test first.)

    NOTES:
        Any errors, please report them to me at my GitHub page at /benpitman.

    Copyright © Ben Pitman

____HELP

    exit 0
}

(( ${#@} )) || showHelp

declare -g -- _language=
declare -g -- _getPatternList=0
declare -g -- _informs=1
declare -g -- _warnings=1
declare -g -- _errors=1
declare -g -- _inputFile=
declare -g -- _outputFile=
declare -g -- _minify=1
declare -ag -- _patterns=()
declare -ag -- _notPatterns=()

for arg in "$@"; do
    if [[ "$arg" == -qqq ]]; then
        _errors=0
    fi
    if [[ "$arg" =~ -qqq? ]]; then
        _warnings=0
    fi
    if [[ "$arg" =~ -qq? ]]; then
        _informs=0
    fi
done

while getopts ":a :h :i: :l: :n: :o: :p: :q :!" arg; do
    case $arg in
        (a) {
            _getPatternList=1
            _minify=0
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

            _inputFile="$OPTARG"
        };;
        (l) {
            _language="$OPTARG"
        };;
        (n) {
            _notPatterns+=("$OPTARG")
        };;
        (o) {
            [[ "$OPTARG" == "-" ]] && continue

            if [[ ! -e "$OPTARG" ]]; then
                warn "$OPTARG is not a file. Attempting to create."

                createErrors=$( touch "$OPTARG" 2>&1 )

                if [[ -n "$createErrors" ]]; then
                    die "$createErrors"
                fi

                inform "File '$OPTARG' created"
            fi


            if [[ ! -w "$OPTARG" ]]; then
                die "$OPTARG is not writeable"
            fi

            _outputFile="$OPTARG"
        };;
        (p) {
            _patterns+=("$OPTARG")
        };;
        (\?) {
            die "Invalid option -$OPTARG"
        };;
        (\:) {
            die "Option -$OPTARG requires a parameter"
        };;
    esac
done
unset arg;

if (( $_minify )) && [[ -z "$_inputFile" ]]; then
    die "Input file missing"
fi

if [[ -z "$_language" ]]; then
    inform "No language provided. Defaulting to Any"
fi

patterns=( "${_patterns[@]}" )
for pattern in "${pattterns[@]}"; do
    for notPattern in "${_notPatterns[@]}"; do
        [[ "$pattern" == "$notPattern" ]] && continue 2
    done

    _patterns+=($pattern)
done
unset pattern patterns notPattern

php -f "index.php" -- "$function" "$_inputFile" "$_language" "${_patterns[@]}"
