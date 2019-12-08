<?php

    namespace App\Language\Any\Pattern;

    use App\Template\ARegex;

    final class CommentInline extends ARegex
    {
        protected static $pattern = '/\s+#(?!\!)[^"\']+?$/';
    }
