node {
    stage('Prepare')
    checkout(scm)
    //git credentialsId: 'radic-default-credentials', url: 'radic.nl:laradic/support'

    // Replaces the env=local with env=jenkins inside the build.properties file.
    // Which is used by Phing to determine what to run
    sh('cp build.properties build.bak.properties')
    sh('rm build.properties')
    sh('cat build.bak.properties | sed \'s/local/jenkins/g\' > build.properties')
    sh('rm build.bak.properties')

    // Remove vendor/composer.lock data to allow clean re-install
    sh('rm -rf vendor composer.lock')

    stage('Build')

    // Install dependencies
    sh('composer install')


    stage('Test')
    sh('phing -buildfile build.xml')


    stage('Publish Results')
    step([$class: 'hudson.plugins.checkstyle.CheckStylePublisher', pattern: 'build/logs/checkstyle.xml'])
    step([$class: 'hudson.plugins.pmd.PmdPublisher', pattern: 'build/logs/pmd.xml'])
    step([$class: 'org.jenkinsci.plugins.cloverphp.CloverPHPPublisher', xmlLocation: 'build/logs/clover.xml', reportDir: 'build/coverage'])

    hipchatSend('Done')

}


