![alt text](https://i.ibb.co/MpgKPQq/image-2021-07-06-181358.png)

Ce projet est un projet personnel qui avait pour but de m'entraîner,
La version 1 ne possède que trois modules

- YeeLight (Lumière)
- Daikin (Climatisation)
- Foscam (Caméra ip)

# Gérez vos appareils depuis une interface minimaliste et optimisée 🎨

![alt text](https://i.ibb.co/58xgXh7/image-2021-07-06-182927.png)

```
Par défault, trois comptes sont généré lors du déploiement du projet, chacun possèdent un mot de passe identique :

12345678

Libre à vous d'ajouter des utilisateurs ou de modifier leurs mots de passes (hashés !) dans la base de donnée
```



![alt text](https://i.ibb.co/vZh42n3/image-2021-07-06-183600.png)



# Avant de basculer le projet en mode production, lancez le fichier python :


```
python3 deploy.py
```

Et indiquez l'url de votre projet, par exemple si vous l'hébergez localement sur un serveur, 
http://ipduserveur
Ou si vous avez un dns
https://domaine.com

Vous pouvez désormais basculer le fichier en mode production avec 

```
yarn
yarn run prod
```

**Vous pouvez désormais automatiser les actions avec la climatisation et la lumière**

Attention ⚠️ :

https://www.jdsoftvera.com/how-to-add-laravel-task-schedule-on-windows/

Et il faut configurer Cron pour Linux.
