pipeline {
    agent any

    environment {
        // Nombre del servidor SonarQube configurado en Jenkins
        SONARQUBE_SERVER = 'Proyecto_web'
        SONAR_HOST_URL = 'http://10.30.212.42:9000'
        // Agregar sonar-scanner al PATH
        PATH = "/sonar-scanner-6.2.1.4610-linux-x64/bin:$PATH"
    }

    stages {
        stage('Checkout') {
            steps {
                // Clonar el código fuente desde el repositorio
                checkout scm
            }
        }
        
        stage('SonarQube Analysis') {
            steps {
                // Configurar el entorno de SonarQube
                withSonarQubeEnv("${SONARQUBE_SERVER}") {
                    // Utilizar el token de autenticación de forma segura
                    withCredentials([string(credentialsId: 'sonar_token', variable: 'SONAR_AUTH_TOKEN')]) {
                        // Ejecutar el análisis con SonarScanner
                        sh '''
                            sonar-scanner \
                            -Dsonar.projectKey=Proyecto_web \
                            -Dsonar.sources=. \
                            -Dsonar.host.url=${SONAR_HOST_URL} \
                            -Dsonar.token=${SONAR_AUTH_TOKEN} \
                            -Dsonar.php.version=8.0
                        '''
                    }
                }
            }
        }
        
        stage('Quality Gate') {
            steps {
                // Esperar el resultado del Quality Gate
                timeout(time: 1, unit: 'HOURS') {
                    waitForQualityGate abortPipeline: true
                }
            }
        }
    }
}
