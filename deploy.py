import os
import sys
import fileinput

tempFile = open("resources/views/home.blade.php", "r+")

host = str(
    input(
        "Enter your host : (It can be an ip:port, ip etc.. but set the http:// or https before) : "
    )
)

for line in fileinput.input("resources/views/home.blade.php"):
    tempFile.write(line.replace("http://smarthome.localhost", host))
tempFile.close()
