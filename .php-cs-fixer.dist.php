<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/core/zm/src',
        __DIR__ . '/core/zm/tests',
    ])
    ->exclude(['vendor', 'cache']);

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        '@PHP74Migration' => true,
        'declare_strict_types' => true,
        'array_syntax' => ['syntax' => 'short'],
        'binary_operator_spaces' => ['default' => 'single_space'],
        'concat_space' => ['spacing' => 'one'],
        'no_unused_imports' => true,
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'phpdoc_align' => ['align' => 'left'],
        'phpdoc_separation' => true,
        'phpdoc_trim' => true,
        'single_quote' => true,
        'trailing_comma_in_multiline' => ['elements' => ['arrays', 'arguments', 'parameters']],
        'no_extra_blank_lines' => true,
        'no_whitespace_in_blank_line' => true,
        'method_chaining_indentation' => true,
        'class_attributes_separation' => ['elements' => ['method' => 'one', 'property' => 'one']],
    ])
    ->setFinder($finder)
    ->setCacheFile(__DIR__ . '/.php-cs-fixer.cache');
