def phing = tool name: 'phing', type: 'hudson.plugins.phing.PhingInstallation'

node {
    stage('Prepare')
    checkout(scm)
    //git credentialsId: 'radic-default-credentials', url: 'radic.nl:laradic/support'

    sh('rm build.properties')
    sh('echo "jenkins" >> build.properties')

    stage('Running phing')
    sh("${phing} -buildfile build.xml")


}


