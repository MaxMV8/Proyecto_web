pipeline {
    agent any
    stages {
        stage('SonarQube Analysis') {
            steps {
                withSonarQubeEnv('SonarQube') {
                    sh '''
                        sonar-scanner \
                        -Dsonar.projectKey=Proyecto_web \
                        -Dsonar.sources=/sonar-scanner-6.2.1.4610-linux-x64/bin:$PATH \
                        -Dsonar.host.url=http://localhost:9000 \
                        -Dsonar.login=sonar_token
                    '''
                }
            }
        }
    }
}
