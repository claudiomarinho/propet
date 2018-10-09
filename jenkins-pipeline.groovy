node('maven') {
    stage('Lendo Arquivos') {
        echo 'building app :)'
        openshiftBuild(buildConfig: 'propet', showBuildLogs: 'true')
    }
    stage('Verificando') {
        echo 'dummy verification....'
    }
    stage('Aprovacao Coordenador') {
        input 'Aprovacao Coordenador'
        openshiftDeploy(deploymentConfig: 'propet')
    }
    stage('Efetuando Deploy') {
       echo 'fake stage...'
       sleep 5 
    }
}
