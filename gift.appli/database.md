box2presta;
+-----------+--------------+------+-----+---------+-------+
| Field     | Type         | Null | Key | Default | Extra |
+-----------+--------------+------+-----+---------+-------+
| box_id    | varchar(128) | NO   |     | NULL    |       |
| presta_id | varchar(128) | NO   |     | NULL    |       |
| quantite  | int(11)      | NO   |     | NULL    |       |
+-----------+--------------+------+-----+---------+-------+
box;
+-------------+---------------+------+-----+---------------------+-------+
| Field       | Type          | Null | Key | Default             | Extra |
+-------------+---------------+------+-----+---------------------+-------+
| id          | varchar(128)  | NO   |     | NULL                |       |
| token       | varchar(64)   | NO   |     | NULL                |       |
| libelle     | varchar(128)  | NO   |     | NULL                |       |
| description | text          | YES  |     | NULL                |       |
| montant     | decimal(12,2) | YES  |     | 0.00                |       |
| kdo         | tinyint(4)    | NO   |     | 0                   |       |
| message_kdo | text          | YES  |     | ''                  |       |
| statut      | int(11)       | NO   |     | 1                   |       |
| created_at  | datetime      | YES  |     | 0000-00-00 00:00:00 |       |
| updated_at  | datetime      | YES  |     | NULL                |       |
| createur_id | varchar(128)  | YES  |     | NULL                |       |
+-------------+---------------+------+-----+---------------------+-------+
catégorie
+-------------+--------------+------+-----+---------+----------------+
| Field       | Type         | Null | Key | Default | Extra          |
+-------------+--------------+------+-----+---------+----------------+
| id          | int(11)      | NO   | PRI | NULL    | auto_increment |
| libelle     | varchar(128) | NO   |     | NULL    |                |
| description | text         | YES  |     | NULL    |                |
+-------------+--------------+------+-----+---------+----------------+
prestation
+-------------+---------------+------+-----+---------+-------+
| Field       | Type          | Null | Key | Default | Extra |
+-------------+---------------+------+-----+---------+-------+
| id          | varchar(128)  | NO   |     | NULL    |       |
| libelle     | varchar(128)  | NO   |     | NULL    |       |
| description | text          | NO   |     | NULL    |       |
| url         | varchar(256)  | YES  |     | NULL    |       |
| unite       | varchar(128)  | YES  |     | NULL    |       |
| tarif       | decimal(10,2) | NO   |     | NULL    |       |
| img         | varchar(128)  | NO   |     | NULL    |       |
| cat_id      | int(11)       | NO   |     | NULL    |       |
+-------------+---------------+------+-----+---------+-------+
user
+----------+--------------+------+-----+---------+-------+
| Field    | Type         | Null | Key | Default | Extra |
+----------+--------------+------+-----+---------+-------+
| id       | varchar(40)  | NO   | PRI | NULL    |       |
| user_id  | varchar(128) | YES  | UNI | NULL    |       |
| password | varchar(256) | YES  |     | NULL    |       |
| role     | tinyint(4)   | YES  |     | NULL    |       |
+----------+--------------+------+-----+---------+-------+
