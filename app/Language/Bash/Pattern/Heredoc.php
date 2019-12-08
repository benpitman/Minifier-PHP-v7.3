<?php

    namespace App\Language\Bash\Pattern;

    use App\Template\ARegex;

    final class Heredoc extends ARegex
    {
        protected static $pattern = '/.+?\<{3}(\w+?)(.|[\n\r])+?^\1.*$[\n\r]*/';
    }
