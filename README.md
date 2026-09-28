# QueueFlow
Système de gestion automatisée des files d'attente virtuelles.

## Présentation
QueueFlow est une application web conçue pour moderniser et automatiser la gestion des files d'attente.
La solution permet aux utilisateurs de réserver leur place à distance, de suivre leur progression dans la file et d'obtenir une estimation de leur temps d'attente, tout en permettant aux agents de gérer les services et les files d'attente.
L'objectif est de réduire les temps d'attente physiques et d'améliorer l'organisation et la fluidité des services.

## Objectif
Les files d'attente traditionnelles peuvent entraîner des déplacements inutiles, des temps d'attente importants et une organisation difficile des flux de personnes.
QueueFlow propose une solution numérique permettant de gérer ces flux de manière plus organisée grâce à l'automatisation, au suivi de la file et aux notifications.

La solution vise notamment à permettre aux utilisateurs de :
- réserver leur place à distance ;
- suivre leur position dans la file ;
- consulter leur temps d'attente estimé ;
- recevoir des notifications lorsque leur tour approche ;
- valider leur ticket à l'aide d'un QR code.

## Fonctionnalités

 ### Utilisateur

- Création et gestion du compte
- consultation des services disponibles
- gestion d'une file d'attente (consulter/rejoindre)
- Obtention d'un ticket -Télecharger le ticket/ supprimer- (position + temps estimé + Qrcode)
- Réception de notifications (consulter/marquer comme lue/supprimer)

 ### Agent de service

- Gestion des services (ajout/suppression/consultation/modification)
- Gestion des files d'attente (ajout/suppression/consultation/modification)
- Gestion des notifications
- Gestion des accès (générer un ticket+ Qrcode)

  ## Fonctionnement

### Parcours utilisateur

1. L'utilisateur crée un compte ou se connecte à son compte.
2. Il consulte les services disponibles.
3. Il sélectionne une file d'attente et peut la rejoindre.
4. Un ticket lui est attribué avec sa position, son temps d'attente estimé et un QR code.
5. L'utilisateur peut consulter, télécharger ou supprimer son ticket.
6. Il reçoit des notifications concernant l'évolution de son tour. (pos<=3 -> votre tour s'approche. / pos=1 -> c'est votre tour)
7. Il peut consulter, marquer comme lue ou supprimer ses notifications.

### Parcours agent

1. L'agent se connecte à son compte.
2. Son compte étant préalablement enregistré dans le système, il accède directement à son espace dédié.
3. Il peut gérer les services et les files d'attente.
4. Il assure le suivi et la gestion des files d'attente.

  ## Base de données
QueueFlow repose sur une base de données relationnelle permettant de gérer
les utilisateurs, les agents, les services, les files d'attente,
les tickets et les notifications.

 ### Structure de la base de données
<img width="867" height="272" alt="image" src="https://github.com/user-attachments/assets/4838a59d-8327-455d-bc16-5bedc8c043d4" />*

 ### Diagramme de classes
<img width="857" height="479" alt="image" src="https://github.com/user-attachments/assets/aab97f6d-1b32-4308-8199-19e9423b22b7" />

## Technologies utilisées

- **PHP**
- **Laravel**
- **MySQL**
- **HTML / CSS**
- **Blade**
- **Git / GitHub**

## Projet et contribution

Projet académique réalisé en équipe dans le cadre de la formation
Business Information Systems à ESPRIT.

En tant que chef de projet, j'ai assuré la coordination technique du projet
ainsi que la mise en cohérence et le perfectionnement des différentes
fonctionnalités de l'application.

J'ai notamment pris en charge et développé à partir de zéro :
- le système automatisé de gestion et de planification des files d'attente 
- le système de tickets et de génération des QR codes 
- le système de notifications 
- les tableaux de bord et les interfaces de gestion 
- la gestion des services et des files d'attente 
- la conception et l'intégration de la base de données.

## Démonstration

 ### Parcours agent
https://github.com/user-attachments/assets/36d55a1c-10da-44f0-822a-b52a5c0a6099

 ### Parcours utilisateur
https://github.com/user-attachments/assets/5b4a2968-ae5a-4b90-bff6-29849d2ead74

 ### Déroulement de la file d'attente

Le déroulement de la file d'attente peut s'effectuer selon deux modes :

-  **Mode manuel :** l'agent utilise le bouton « Appeler le suivant »
  afin de faire avancer la file d'attente manuellement.

-  **Mode automatique :** une fois le temps d'attente estimé écoulé,
  le système appelle automatiquement le ticket suivant.

## État du projet

Projet fonctionnel développé dans le cadre de la formation.

L'application est actuellement exécutée en environnement local et n'est pas encore déployée en ligne.

## Documentation

Pour plus de détails sur l'analyse, la conception et la réalisation
du projet :
[Consulter la présentation complète du projet](https://canva.link/ihrflhujjfnw8m7)
