from django.contrib.auth.hashers import make_password

password = make_password('1234')

print(password)