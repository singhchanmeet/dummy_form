from django.shortcuts import render, HttpResponse
from . models import Dummyform

# Create your views here.

def index(request):
    if request.method == 'POST':
        name = request.POST.get('name')
        dob = request.POST.get('dob')
        contact = request.POST.get('contact')
        address = request.POST.get('address')
        category = request.POST.get('category')
        image = request.FILES['image']
        newform = Dummyform(name=name, dob=dob, contact=contact, address=address, category=category, image=image)
        newform.save()
        return HttpResponse('Okay bhai')
    else:
        return render(request, 'index.html')