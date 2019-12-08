<?php

    namespace App\Language\Any\Pattern;

    use App\Template\ARegex;

    final class CommentInline extends ARegex
    {
        protected static $description = "Removes all words after a '#' if not succeeded by a quotation symbol";
        protected static $pattern = '/\s+#(?!\!)[^"\']+?$/';
    }
