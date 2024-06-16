### Exercice 1
[Schéma UML de la base de donnée](./umldb.jpg)  
  
Modèles a créer: Box, Prestation, User, Catégorie  
Relations a créer: Box belongsToMany Prestation, User hasMany Box, Catégorie hasMany Prestation.  
  
Types des clées primaires:  
- box varchar(128)  
- categorie int(11)  
- prestation varchar(128)  
