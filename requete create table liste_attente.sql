DROP TABLE IF EXISTS liste_attente;

create table liste_attente(
id_activite int,
creneau int,
id_adherent int,
date_inscription DATETIME,
primary key(id_activite, creneau, id_adherent)
);

alter table liste_attente
add constraint fk_attente_activite foreign key (id_activite) REFERENCES activite(id_activite),
add constraint fk_attente_creneau foreign key (creneau) REFERENCES creneau(num_creneau),
add constraint fk_attente_adherent foreign key (id_adherent) REFERENCES adherent(id_adherent)
