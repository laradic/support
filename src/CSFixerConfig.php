<?php
namespace Laradic\Support;

use PhpCsFixer\Config;

class CSFixerConfig extends Config
{
    protected $header;

    public function __construct($header = null)
    {
        parent::__construct('Laradic coding standard');
        $this->header = $header;
    }

    public function getRules()
    {
        $this->setRiskyAllowed(false);
        $rules = [
            'psr0' => false,
            '@PSR2' => true,
            'blank_line_after_namespace' => true,
            'braces' => true,
            'class_definition' => true,
            'elseif' => true,
            'function_declaration' => true,
            'indentation_type' => true,
            'line_ending' => true,
            'lowercase_constants' => true,
            'lowercase_keywords' => true,
            'method_argument_space' => [
                'ensure_fully_multiline' => true, ],
            'no_break_comment' => true,
            'no_closing_tag' => true,
            'no_spaces_after_function_name' => true,
//            'no_spaces_inside_parenthesis' => true,

            'not_operator_with_space'=>true, // Logical NOT operators (!) should have leading and trailing whitespaces.
            'not_operator_with_successor_space'=>true, // Logical NOT operators (!) should have one trailing whitespace.
            'no_trailing_whitespace' => true,
            'no_trailing_whitespace_in_comment' => true,
            'single_blank_line_at_eof' => true,
            'single_class_element_per_statement' => [
                'elements' => ['property'],
            ],
            'single_import_per_statement' => true,
            'single_line_after_imports' => true,
            'switch_case_semicolon_to_colon' => true,
            'switch_case_space' => true,
            'visibility_required' => true,
            'encoding' => true,
            'full_opening_tag' => true,
        ];

        return $rules;
    }
}

