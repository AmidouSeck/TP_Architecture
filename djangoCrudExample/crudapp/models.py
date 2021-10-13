from django.db import models

# Create your models here.

class Utilisateur(models.Model):
    prenom = models.CharField("First name", max_length=255, blank = True, null = True)
    nom = models.CharField("Last name", max_length=255, blank = True, null = True)
    nom_utilisateur = models.CharField(max_length=20, blank = True, null = True)
    mot_de_passe = models.TextField(blank=True, null=True)
    
    def __str__(self):
        return self.prenom
