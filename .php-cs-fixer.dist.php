<?php

declare(strict_types=1);

/*
 * Configuration de PHP-CS-Fixer pour GestionClub.
 * Documentation des règles : https://cs.symfony.com/
 */

$finder = (new PhpCsFixer\Finder())
    ->in([
        __DIR__.'/src',
        __DIR__.'/inc',
        __DIR__.'/public',
    ])
    ->exclude([
        'vendor',
        'node_modules',
    ]);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'declare_strict_types' => true,
        'array_syntax' => ['syntax' => 'short'],
        'binary_operator_spaces' => ['default' => 'single_space'],
        'blank_line_after_opening_tag' => true,
        'concat_space' => ['spacing' => 'none'],
        'no_unused_imports' => true,
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'single_quote' => true,
        'trailing_comma_in_multiline' => ['elements' => ['arrays']],
        'visibility_required' => ['elements' => ['property', 'method', 'const']],
        'yoda_style' => false,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder);
