
node {
    stage('Prepare')
    checkout(scm)
    //git credentialsId: 'radic-default-credentials', url: 'radic.nl:laradic/support'

    sh('rm build.properties')
    sh('echo "jenkins" >> build.properties')
    sh('phing -buildfile build.xml')


}


