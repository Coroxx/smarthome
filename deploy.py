import os
import sys
import fileinput

tempFile = open("resources/views/home.blade.php", "r+")

host = str(input('Enter your host : (It can be an ip:port, ip etc..) : '))

for line in fileinput.input("resources/views/home.blade.php"):
    tempFile.write(line.replace("yourhost.local", host))
tempFile.close()
