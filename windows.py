import os
import sys
import fileinput

tempFile = open("resources/views/home.blade.php", "r+")

for line in fileinput.input("resources/views/home.blade.php"):
    tempFile.write(line.replace(".test", ".localhost"))
tempFile.close()
