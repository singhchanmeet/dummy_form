from django.db import models

# Create your models here.
class Dummyform(models.Model):
    name = models.TextField()
    dob = models.DateField()
    contact = models.IntegerField()
    address = models.TextField()
    category = models.CharField(max_length=20)
    image = models.FileField(upload_to='photographs')

    def __str__(self):
        return self.name
    
    class Meta:
        verbose_name_plural = 'Form'
        db_table = 'contact_forms'