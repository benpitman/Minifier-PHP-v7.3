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

parsePatterns ()
{
    local -- pattern
    local -- npIndex

    local -a -- patterns=( "${_patterns[@]}" )
    _inPlace=()

    for pattern in "${pattterns[@]}"; do
        for npIndex in ${!_notPatterns[@]}; do
            if [[ "$pattern" == "${_notPatterns[$npIndex]}" ]]; then
                unset _notPatterns[$npIndex]
                continue 2
            fi
        done

        _patterns+=($pattern)
    done
}

setMinify ()
{
    (( _attributes |= $_minify ))
}

unsetMinify ()
{
    (( _attributes ^= $_minify ))
}

setAllPatterns ()
{
    (( _attributes |= $_allPatterns ))
}

unsetAllPatterns ()
{
    (( _attributes ^= $_allPatterns ))
}

setInPlace ()
{
    (( _attributes |= $_inPlace ))
}

unsetInPlace ()
{
    (( _attributes ^= $_inPlace ))
}

(( ${#@} )) || showHelp

declare -gr -- _minify=1
declare -gr -- _allPatterns=2
declare -gr -- _inPlace=4

declare -g -- _attributes=0
declare -g -- _errors=1
declare -g -- _informs=1
declare -g -- _inputFile=
declare -g -- _language=
declare -g -- _outputFile=
declare -g -- _warnings=1

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

setMinify

while getopts ":a :d :h :i: :l: :n: :o: :p: :q :r" arg; do
    case $arg in
        (a) {
            setAllPatterns
        };;
        (d) {
            unsetMinify
        };;
        (h) {
            showHelp
        };;
        (i) {
            [[ -e "$OPTARG" ]] || die "$OPTARG is not a file"
            [[ -r "$OPTARG" ]] || die "$OPTARG is not readable"
            [[ -s "$OPTARG" ]] || die "$OPTARG is empty"

            _inputFile="$OPTARG"
        };;
        (l) {
            _language="${OPTARG,,}"
        };;
        (n) {
            _notPatterns+=("${OPTARG,,}")
        };;
        (o) {
            [[ "$OPTARG" == "-" ]] && continue

            if [[ ! -e "$OPTARG" ]]; then
                warn "$OPTARG is not a file. Attempting to create."

                createErrors=$( touch "$OPTARG" 2>&1 )

                [[ -n "$createErrors" ]] || die "$createErrors"

                inform "File '$OPTARG' created"
            fi

            [[ -w "$OPTARG" ]] || die "$OPTARG is not writeable"

            _outputFile="$OPTARG"
        };;
        (p) {
            _patterns+=("${OPTARG,,}")
        };;
        (r) {
            setInPlace
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

if (( $_attributes & $_minify )) && [[ -z "$_inputFile" ]]; then
    die "Input file missing"
fi

if [[ -z "$_language" ]]; then
    inform "No language provided. Defaulting to Any"
fi

if (( $_inPlace )); then
    [[ -z "$_inputFile" ]] && die "No input file provided"
    _outputFile="$_inputFile"
fi

parsePatterns

php -f "index.php" -- "$_attributes" "$_inputFile" "$_language" "$_outputFile" "${_patterns[@]}"
