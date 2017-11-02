<?php
/**
 * Part of the Laradic PHP Packages.
 *
 * Copyright (c) 2017. Robin Radic.
 *
 * The license can be found in the package and online at https://laradic.mit-license.org.
 *
 * @copyright Copyright 2017 (c) Robin Radic
 * @license https://laradic.mit-license.org The MIT License
 */
namespace Laradic\Tests\Support\Fixtures;

use Laradic\Support\Arr;

trait ProvidesInheritedMergeData {

    protected function getProjectResult()
    {
        return Arr::merge($this->projectDefault, $this->project);
    }

    protected function getRevisionResult($projectResult = null)
    {
        if(null === $projectResult){
            $projectResult = $this->getProjectResult();
        }
        return Arr::inheritedMerge(
            $projectResult,
            $this->revisionInherits,
            $this->revisionDefault,
            $this->revision
        );
    }

    protected function getDocumentResult($revisionResult = null)
    {
        if(null === $revisionResult){
            $revisionResult = $this->getRevisionResult($this->getProjectResult());
        }
        return Arr::inheritedMerge(
            $revisionResult,
            $this->documentInherits,
            $this->documentDefault,
            $this->document
        );
    }

    protected $projectDefault = [
        'disk'        => null,
        'description' => '',
        'default'     => 'auto',
        'index'       => 'index',
        'extensions'  => [ 'md', 'markdown', 'html' ],
        'view'        => 'codex::document',
        'processors'  => [
            'enabled'  => [ 'projectDefault' ],
            'disabled' => [],
        ],
    ];

    protected $project = [
        'display_name' => 'Codex',
        'description'  => 'Codex is a file-based documentation system build with Laravel 5.3',
        'processors'   => [
            'enabled'    => [ 'project' ],
            'attributes' => [
                'tags' => [
                    [ 'open' => '<!--*', 'close' => '--*>' ], // html, markdown
                    [ 'open' => '---', 'close' => '---' ], // markdown (frontmatter)
                    [ 'open' => '\/\*', 'close' => '\*\/' ], // codex v1 style
                ],
            ],
            'toc'        => [
                'header_link_show' => true,
            ],
        ],
    ];

    protected $projectExpectedResult = [
        'display_name' => 'Codex',
        'description'  => 'Codex is a file-based documentation system build with Laravel 5.3',
        'disk'         => null,
        'default'      => 'auto',
        'index'        => 'index',
        'extensions'   => [ 'md', 'markdown', 'html' ],
        'view'         => 'codex::document',
        'processors'   => [
            'enabled'    => [ 'projectDefault', 'project' ],
            'disabled'   => [],
            'attributes' => [
                'tags' => [
                    [ 'open' => '<!--*', 'close' => '--*>' ], // html, markdown
                    [ 'open' => '---', 'close' => '---' ], // markdown (frontmatter)
                    [ 'open' => '\/\*', 'close' => '\*\/' ], // codex v1 style
                ],
            ],
            'toc'        => [
                'header_link_show' => true,
            ],
        ],

    ];

    protected $revisionDefault = [
        'menus' => null,

        'processors' => [
            'enabled' => [ 'revisionDefault' ], //
        ],
    ];

    protected $revisionInherits = [
        'index',
        'processors',
        'view',
    ];

    protected $revision = [
        'foo'        => 'bar',
        'processors' => [
            'enabled'  => [ 'revision' ],
            'disabled' => [ 'revision' ],
        ],
        'menus'      => [
            'navigation' => [
                'side'  => 'right',
                'items' => [
                    [ 'title' => 'Home', 'type' => 'page', 'page' => 'home' ],
                    [ 'title' => 'Intro', 'type' => 'page', 'page' => 'intro' ],
                    [ 'title' => 'Blog', 'type' => 'blog' ],
                    [
                        'title'    => 'Categories',
                        'type'     => 'parent',
                        'children' => [
                            [ 'title' => 'General', 'type' => 'blog-category', 'category' => 'general' ],
                            [ 'title' => 'PHP', 'type' => 'blog-category', 'category' => 'php' ],
                            [ 'title' => 'Jenkins', 'type' => 'blog-category', 'category' => 'jenkins' ],
                        ],
                    ],
                ],
            ],
        ],

    ];

    protected $revisionExpectedResult = [
        'foo'        => 'bar',
        'index'      => 'index',
        'view'       => 'codex::document',
        'processors' => [
            'enabled'    => [ 'revisionDefault', 'projectDefault', 'project', 'revision' ],
            'disabled'   => [ 'revision' ],
            'attributes' => [
                'tags' => [
                    [ 'open' => '<!--*', 'close' => '--*>' ], // html, markdown
                    [ 'open' => '---', 'close' => '---' ], // markdown (frontmatter)
                    [ 'open' => '\/\*', 'close' => '\*\/' ], // codex v1 style
                ],
            ],
            'toc'        => [
                'header_link_show' => true,
            ],
        ],
        'menus'      => [
            'navigation' => [
                'side'  => 'right',
                'items' => [
                    [ 'title' => 'Home', 'type' => 'page', 'page' => 'home' ],
                    [ 'title' => 'Intro', 'type' => 'page', 'page' => 'intro' ],
                    [ 'title' => 'Blog', 'type' => 'blog' ],
                    [
                        'title'    => 'Categories',
                        'type'     => 'parent',
                        'children' => [
                            [ 'title' => 'General', 'type' => 'blog-category', 'category' => 'general' ],
                            [ 'title' => 'PHP', 'type' => 'blog-category', 'category' => 'php' ],
                            [ 'title' => 'Jenkins', 'type' => 'blog-category', 'category' => 'jenkins' ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    protected $documentDefault = [
        'author'     => '',
        'title'      => '',
        'subtitle'   => '',
        'cache'      => true,
        'processors' => [
            'enabled'  => [ 'documentDefault', 'revisionDefault', 'projectDefault', 'project', 'revision' ],
            'disabled' => [ 'documentDefault' ],
        ],
    ];

    protected $documentInherits = [
        'menus.navigation.side',
        'processors',
        'view',
    ];

    protected $document = [
        'title'      => 'Merge Test',
        'path'       => 'index',
        'processors' => [
            'enabled'  => [ 'document' ],
            'disabled' => [ 'document', ],
        ],
    ];

    protected $documentExpectedResult = [

        'author'     => '',
        'title'      => 'Merge Test',
        'subtitle'   => '',
        'cache'      => true,
        'path'       => 'index',
        'view'       => 'codex::document',
        'processors' => [
            'enabled'    => [ 'documentDefault', 'revisionDefault', 'projectDefault', 'project', 'revision', 'document' ],
            'disabled'   => [ 'documentDefault', 'revision', 'document' ],
            'attributes' => [
                'tags' => [
                    [ 'open' => '<!--*', 'close' => '--*>' ], // html, markdown
                    [ 'open' => '---', 'close' => '---' ], // markdown (frontmatter)
                    [ 'open' => '\/\*', 'close' => '\*\/' ], // codex v1 style
                ],
            ],
            'toc'        => [
                'header_link_show' => true,
            ],
        ],
        'menus'      => [
            'navigation' => [
                'side' => 'right',
            ],
        ],

    ];


}
