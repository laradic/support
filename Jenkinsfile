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

//noinspection GroovyAssignabilityCheck

pipeline {
    agent any
    node('something') {
        stages {
            stage('Checkout Sources') {
                steps {
                    checkout scm
                }
            }
            stage('Prepare files') {

                steps {
                    sh 'cp build.properties build.bak.properties'

                    sh 'rm build.properties'
                    sh 'cat build.bak.properties | sed \'s/local/jenkins/g\' > build.properties'
                    sh 'rm build.bak.properties'

                    // Remove vendor/composer.lock data to allow clean re-install
                    sh('rm -rf vendor composer.lock')
                }
            }
        }
    }
}
//node {
//    stage('Prepare')
//    checkout(scm)
//    //git credentialsId: 'radic-default-credentials', url: 'radic.nl:laradic/support'
//
//    // Replaces the env=local with env=jenkins inside the build.properties file.
//    // Which is used by Phing to determine what to run
//    sh('cp build.properties build.bak.properties')
//    sh('rm build.properties')
//    sh('cat build.bak.properties | sed \'s/local/jenkins/g\' > build.properties')
//    sh('rm build.bak.properties')
//
//    // Remove vendor/composer.lock data to allow clean re-install
//    sh('rm -rf vendor composer.lock')
//
//    stage('Build')
//
//    // Install dependencies
//    sh('composer install')
//
//
//
//    stage('Test')
//    sh('phing -buildfile build.xml')
//
//
//    stage('Publish Results')
//    step([$class: 'hudson.plugins.checkstyle.CheckStylePublisher', pattern: 'build/logs/checkstyle.xml'])
//    step([$class: 'hudson.plugins.pmd.PmdPublisher', pattern: 'build/logs/pmd.xml'])
//    step([$class: 'org.jenkinsci.plugins.cloverphp.CloverPHPPublisher', xmlLocation: 'build/logs/clover.xml', reportDir: 'build/coverage'])
//
//
//}
//
