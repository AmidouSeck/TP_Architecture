from django import forms
from .models import Utilisateur

class UtlisateurForm(forms.ModelForm):
    class Meta:
        model = Utilisateur
        fields = "__all__"