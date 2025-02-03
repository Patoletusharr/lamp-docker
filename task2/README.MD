
# Task 2: Kubernetes Deployment & Management for LAMP Stack#
## Objective
This task involves deploying and managing a LAMP stack (Linux, Apache, MySQL, PHP) web application within a Kubernetes cluster. The stack consists of:

Nginx with PHP-FPM as the front-end service.
MySQL as the back-end database service.
Deployed both services, ensure their connectivity, enable horizontal scaling, and set up high availability with rolling updates. Secured sql service using Secrets, and its data will be persisted using Persistent Volumes.

## Folder Structure
```bash
task2/
├── configmaps/
│   └── nginx-configmap.yaml          # ConfigMap for Nginx configuration
├── deployments/
│   ├── mysql-statefulset.yaml        # StatefulSet for MySQL
│   └── nginx-php-deployment.yaml     # Deployment for Nginx + PHP
├── hpas/
│   ├── mysql-hpa.yaml                # HPA for MySQL
│   └── nginx-php-hpa.yaml            # HPA for Nginx + PHP
├── persistent-volumes/
│   ├── mysql-pv.yaml                 # PersistentVolume for MySQL
│   └── mysql-pvc.yaml                # PersistentVolumeClaim for MySQL
├── secrets/
│   └── mysql-secret.yaml             # Secret for MySQL credentials
└── services/
    ├── mysql-service.yaml            # MySQL service
    └── nginx-php-service.yaml        # Nginx + PHP service

```
## Setup Info
### Step 1: Kubernetes Cluster Setup
To check if KOPS cluster is running:
```bash
kubectl get nodes
```
### Step 2: Deploy MySQL Service
#### PersistentVolume (PV) and PersistentVolumeClaim (PVC)
These files set up persistent storage for MySQL. The mysql-pv.yaml file defines the volume, and the mysql-pvc.yaml claims the storage for use by the MySQL pod.

Apply the PV and PVC:

```bash
kubectl apply -f persistent-volumes/mysql-pv.yaml
kubectl apply -f persistent-volumes/mysql-pvc.yaml
```
MySQL StatefulSet
The mysql-statefulset.yaml file deploys the MySQL service as a StatefulSet, ensuring that MySQL is highly available and persistent.

Apply the StatefulSet:

```bash
kubectl apply -f deployments/mysql-statefulset.yaml
```
#### MySQL Service
The mysql-service.yaml file exposes MySQL internally in the cluster, making it accessible to the Nginx + PHP service.

Apply the MySQL service:

```bash
kubectl apply -f services/mysql-service.yaml
```
### Step 3: Deploy Nginx + PHP Front-End Service
#### Nginx + PHP Deployment
The nginx-php-deployment.yaml file deploys Nginx with PHP-FPM. It also configures environment variables to connect to the MySQL service and mounts the required ConfigMaps for Nginx and PHP files.

Apply the deployment:

```bash

kubectl apply -f deployments/nginx-php-deployment.yaml
```
#### Nginx + PHP Service
The nginx-php-service.yaml file exposes the Nginx + PHP front-end service to the outside world using a LoadBalancer or NodePort.

Apply the service:

```bash
kubectl apply -f services/nginx-php-service.yaml
```
### Step 4: Database Connection
Ensured that the front-end (Nginx + PHP) service is configured to connect to the MySQL service via environment variables (such as DB_HOST, DB_NAME, DB_USER, and DB_PASSWORD).

These environment variables are passed securely using Secrets and ConfigMaps.

The mysql-secret.yaml file stores MySQL credentials securely.

Apply the Secret:

```bash
kubectl apply -f secrets/mysql-secret.yaml
```
### Step 5: Scaling the Application
#### Horizontal Pod Autoscaler (HPA) for MySQL
The mysql-hpa.yaml file sets up an HPA based on MySQL’s CPU or memory usage to scale MySQL pods dynamically.

Apply the HPA:

```bash
kubectl apply -f hpas/mysql-hpa.yaml
```
#### Horizontal Pod Autoscaler (HPA) for Nginx + PHP
The nginx-php-hpa.yaml file sets up an HPA for the Nginx + PHP front-end service to scale based on resource metrics.

Apply the HPA:

```bash
kubectl apply -f hpas/nginx-php-hpa.yaml
```
### Step 6: High Availability and Rolling Updates
Both the MySQL StatefulSet and Nginx + PHP Deployment are set up with high availability in mind.

Use replica counts to ensure multiple pods are deployed for both services.

The Rolling Update Strategy is implemented in the deployment YAML files for zero-downtime updates.

### Step 7: Access the Application
#### Access Nginx + PHP Service
After deploying the services, find the external IP or NodePort of the Nginx + PHP service:

```bash
kubectl get svc nginx-php-service
```

Using a LoadBalancer, the external IP will be shown.

```bash
a32c710e8ee72495592b14db211d5e0f-1967401462.ap-south-1.elb.amazonaws.com
```

Application displays the "Connected successfully to MySQL!" message, confirming that the front-end can connect to the MySQL database.
```
    
